<?php
/**
 * Plugin Name: SVM Google Sheets Domain Sync - MEGA FIXED
 * Plugin URI: https://s.ventures
 * Description: Sync domain listings from Google Sheets - Supports BOTH uploaded logos AND synced logo URLs from /assets folder
 * Version: 5.0.0
 * Author: S.Ventures
 * Author URI: https://s.ventures
 */

if (!defined('ABSPATH')) exit;

class SVM_Google_Sheets_Sync_V4 {
    
    private $option_name = 'svm_sheets_settings';
    private $batch_size = 20;
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_post_svm_sync_now', array($this, 'manual_sync'));
        add_action('svm_auto_sync_domains', array($this, 'sync_domains_batch'));
        add_action('svm_process_sync_batch', array($this, 'process_sync_batch'));
        
        if (!wp_next_scheduled('svm_auto_sync_domains')) {
            wp_schedule_event(time(), 'sixhours', 'svm_auto_sync_domains');
        }
        
        add_filter('cron_schedules', array($this, 'add_cron_schedule'));
        add_action('admin_notices', array($this, 'admin_notices'));
        add_action('wp_ajax_svm_check_sync_progress', array($this, 'check_sync_progress'));
    }
    
    public function add_cron_schedule($schedules) {
        $schedules['sixhours'] = array(
            'interval' => 21600,
            'display' => __('Every 6 Hours')
        );
        return $schedules;
    }
    
    public function add_admin_menu() {
        add_submenu_page(
            'edit.php?post_type=domains',
            'Google Sheets Sync',
            '📊 Sheets Sync',
            'manage_options',
            'svm-sheets-sync',
            array($this, 'settings_page')
        );
    }
    
    public function register_settings() {
        register_setting('svm_sheets_settings', $this->option_name);
    }
    
    public function settings_page() {
        $settings = get_option($this->option_name, array());
        $last_sync = get_option('svm_last_sync_time');
        $last_sync_status = get_option('svm_last_sync_status');
        $sync_in_progress = get_option('svm_sync_in_progress');
        ?>
        <div class="wrap">
            <h1>🚀 Google Sheets Domain Sync - MEGA FIXED</h1>

            <div class="notice notice-success">
                <p><strong>✅ MEGA FIXED:</strong> Now supports BOTH uploaded media logos AND synced logo URLs!</p>
                <p><strong>Logo Priority:</strong> 1) Uploaded media logos (manual uploads take priority), 2) Google Sheets synced URLs, 3) /assets folder fallback</p>
            </div>
            
            <?php if ($sync_in_progress): ?>
            <div class="notice notice-warning">
                <p><strong>⏳ Sync in progress...</strong> Processing batch: <?php echo get_option('svm_current_batch', 0); ?> of <?php echo get_option('svm_total_batches', 0); ?></p>
            </div>
            <?php endif; ?>
            
            <?php if ($last_sync && !$sync_in_progress): ?>
            <div class="card" style="padding: 20px; background: #fff; border: 1px solid #ccc; margin: 20px 0;">
                <h2>✅ Last Sync Status</h2>
                <p>
                    <strong>Time:</strong> <?php echo date('F j, Y g:i a', $last_sync); ?><br>
                    <strong>Status:</strong> <?php echo $last_sync_status ?: 'Success'; ?><br>
                    <strong>Domains Processed:</strong> <?php echo get_option('svm_last_sync_count', 0); ?>
                </p>
            </div>
            <?php endif; ?>
            
            <form method="post" action="options.php" style="background: #fff; padding: 20px; border: 1px solid #ccc;">
                <?php settings_fields('svm_sheets_settings'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="sheet_url">Google Sheet CSV URL</label>
                        </th>
                        <td>
                            <input type="url" 
                                   name="<?php echo $this->option_name; ?>[sheet_url]" 
                                   id="sheet_url"
                                   value="<?php echo esc_attr($settings['sheet_url'] ?? ''); ?>"
                                   class="regular-text"
                                   placeholder="https://docs.google.com/spreadsheets/d/.../export?format=csv"
                            >
                            <p class="description">
                                Get the CSV export URL from your Google Sheet (File → Share → Publish to web → CSV)
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Logo Format</th>
                        <td>
                            <p><strong>Important:</strong> In your Google Sheet, the "Logo URL" column should contain URLs pointing to your /assets/ folder:</p>
                            <code>https://s.ventures/wp-content/themes/s_ventures_market_theme_v4/assets/domainname_logo.webp</code>
                            <p class="description">Replace "domainname" with the actual domain name (use underscores for dots). Logos will NOT be uploaded to WordPress media library.</p>
                        </td>
                    </tr>
                </table>
                
                <?php submit_button('Save Settings'); ?>
            </form>
            
            <?php if (!empty($settings['sheet_url'])): ?>
            <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" style="margin-top: 20px;">
                <input type="hidden" name="action" value="svm_sync_now">
                <?php wp_nonce_field('svm_sync_now'); ?>
                <?php submit_button('Sync Domains Now', 'primary', 'submit', false); ?>
            </form>
            <?php endif; ?>
        </div>
        
        <?php if ($sync_in_progress): ?>
        <script>
        // Auto-refresh every 5 seconds while syncing
        setTimeout(function() {
            location.reload();
        }, 5000);
        </script>
        <?php endif; ?>
        <?php
    }
    
    public function admin_notices() {
        if (isset($_GET['svm_sync']) && $_GET['svm_sync'] === 'started') {
            echo '<div class="notice notice-info is-dismissible"><p>Domain sync started! Processing in batches...</p></div>';
        }
    }
    
    public function manual_sync() {
        check_admin_referer('svm_sync_now');
        
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }
        
        $this->sync_domains_batch();
        
        wp_redirect(admin_url('edit.php?post_type=domains&page=svm-sheets-sync&svm_sync=started'));
        exit;
    }
    
    public function sync_domains_batch() {
        $settings = get_option($this->option_name);
        $sheet_url = $settings['sheet_url'] ?? '';
        
        if (empty($sheet_url)) {
            update_option('svm_last_sync_status', 'Error: No sheet URL configured');
            return;
        }
        
        $response = wp_remote_get($sheet_url, array(
            'timeout' => 30,
            'sslverify' => false
        ));
        
        if (is_wp_error($response)) {
            update_option('svm_last_sync_status', 'Error: ' . $response->get_error_message());
            return;
        }
        
        $csv_data = wp_remote_retrieve_body($response);
        $rows = array_map('str_getcsv', explode("\n", $csv_data));
        $headers = array_shift($rows);
        
        update_option('svm_sync_data', array(
            'headers' => $headers,
            'rows' => $rows
        ));
        update_option('svm_sync_in_progress', true);
        update_option('svm_current_batch', 0);
        update_option('svm_total_batches', ceil(count($rows) / $this->batch_size));
        
        $this->process_sync_batch();
    }
    
    public function process_sync_batch() {
        $data = get_option('svm_sync_data');
        if (!$data) {
            update_option('svm_sync_in_progress', false);
            return;
        }
        
        $headers = $data['headers'];
        $all_rows = $data['rows'];
        $current_batch = get_option('svm_current_batch', 0);
        $total_batches = get_option('svm_total_batches', 1);
        
        $start = $current_batch * $this->batch_size;
        $rows = array_slice($all_rows, $start, $this->batch_size);
        
        $processed_count = 0;
        
        foreach ($rows as $row) {
            if (empty($row) || count($row) < 2) continue;
            
            $data_row = array_combine($headers, array_pad($row, count($headers), ''));
            
            $domain_name = trim($data_row['Domain Name'] ?? '');
            if (empty($domain_name)) continue;
            
            $existing = get_posts(array(
                'post_type' => 'domains',
                'title' => $domain_name,
                'posts_per_page' => 1,
                'post_status' => 'any'
            ));
            
            $post_id = !empty($existing) ? $existing[0]->ID : 0;
            
            $post_data = array(
                'post_title' => $domain_name,
                'post_type' => 'domains',
                'post_status' => 'publish',
            );
            
            if ($post_id) {
                $post_data['ID'] = $post_id;
                wp_update_post($post_data);
            } else {
                $post_id = wp_insert_post($post_data);
            }
            
            if ($post_id) {
                update_post_meta($post_id, 'svm_price', floatval($data_row['Price'] ?? 0));
                update_post_meta($post_id, 'svm_description', wp_kses_post($data_row['Description'] ?? ''));
                update_post_meta($post_id, 'svm_status', strtolower($data_row['Status'] ?? 'available'));
                
                // Handle categories
                $categories_string = $data_row['Categories'] ?? '';
                if (!empty($categories_string)) {
                    $category_names = array_map('trim', explode(',', $categories_string));
                    $category_ids = array();
                    
                    foreach ($category_names as $cat_name) {
                        if (empty($cat_name)) continue;
                        
                        $term = get_term_by('name', $cat_name, 'domain_category');
                        if (!$term) {
                            $term = wp_insert_term($cat_name, 'domain_category');
                            if (!is_wp_error($term)) {
                                $category_ids[] = $term['term_id'];
                            }
                        } else {
                            $category_ids[] = $term->term_id;
                        }
                    }
                    
                    if (!empty($category_ids)) {
                        wp_set_object_terms($post_id, $category_ids, 'domain_category');
                    }
                }
                
                // FIXED: Support BOTH uploaded logos AND synced logo URLs
                $logo_url = $data_row['Logo URL'] ?? '';
                if (!empty($logo_url)) {
                    // Store the synced logo URL from Google Sheets
                    update_post_meta($post_id, 'svm_logo_url', $logo_url);
                    // DO NOT delete svm_logo_id - keep uploaded logos intact!
                    // If user manually uploaded a logo, it will take priority over synced URL
                }
                
                $processed_count++;
            }
        }
        
        $current_batch++;
        update_option('svm_current_batch', $current_batch);
        
        if ($current_batch >= $total_batches) {
            update_option('svm_sync_in_progress', false);
            update_option('svm_last_sync_time', time());
            update_option('svm_last_sync_status', 'Success - ' . (($current_batch) * $processed_count) . ' domains processed');
            update_option('svm_last_sync_count', ($current_batch) * $processed_count);
            delete_option('svm_sync_data');
            delete_option('svm_current_batch');
            delete_option('svm_total_batches');
        } else {
            wp_schedule_single_event(time() + 10, 'svm_process_sync_batch');
        }
    }
    
    public function check_sync_progress() {
        $progress = array(
            'in_progress' => get_option('svm_sync_in_progress', false),
            'current_batch' => get_option('svm_current_batch', 0),
            'total_batches' => get_option('svm_total_batches', 0)
        );
        wp_send_json_success($progress);
    }
}

new SVM_Google_Sheets_Sync_V4();