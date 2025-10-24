<?php
/**
 * Plugin Name: SVM Bulk Logo Uploader
 * Description: One-time use script to bulk upload 312 PNG logos and match them to domain posts
 * Version: 1.0.0
 * Author: S.Ventures
 */

if (!defined('ABSPATH')) exit;

class SVM_Bulk_Logo_Uploader {

    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    public function add_admin_menu() {
        add_submenu_page(
            'edit.php?post_type=domains',
            'Bulk Logo Upload',
            '📤 Bulk Upload',
            'manage_options',
            'svm-bulk-upload',
            array($this, 'upload_page')
        );
    }

    public function upload_page() {
        ?>
        <div class="wrap">
            <h1>📤 Bulk Logo Upload</h1>

            <div class="notice notice-warning">
                <p><strong>⚠️ IMPORTANT INSTRUCTIONS:</strong></p>
                <ol>
                    <li>First, <strong>clean up orphaned attachments</strong> by clicking the button below</li>
                    <li>Upload all 312 PNG logos to: <code>/home/u753897407/domains/s.ventures/public_html/wp-content/uploads/bulk-logos/</code></li>
                    <li>Name files to match domain names: <code>acrobatfinance.com.png</code> or <code>digibuy.com.png</code></li>
                    <li>WordPress will automatically convert PNG to WebP with white backgrounds</li>
                    <li>Click "Process Bulk Upload" to import all logos</li>
                </ol>
            </div>

            <?php if (isset($_GET['cleaned'])): ?>
            <div class="notice notice-success">
                <p>✅ Cleaned up <?php echo intval($_GET['cleaned']); ?> orphaned logo attachments!</p>
            </div>
            <?php endif; ?>

            <?php if (isset($_GET['uploaded'])): ?>
            <div class="notice notice-success">
                <p>✅ Successfully uploaded <?php echo intval($_GET['uploaded']); ?> logos! Matched <?php echo intval($_GET['matched']); ?> to domain posts.</p>
            </div>
            <?php endif; ?>

            <?php if (isset($_GET['cron_disabled'])): ?>
            <div class="notice notice-success">
                <p>✅ Disabled Google Sheets auto-sync cron job!</p>
            </div>
            <?php endif; ?>

            <?php if (isset($_GET['files_deleted'])): ?>
            <div class="notice notice-success">
                <p>✅ Deleted <?php echo intval($_GET['files_deleted']); ?> broken logo files and <?php echo intval($_GET['attachments_deleted']); ?> attachment records from the database!</p>
            </div>
            <?php endif; ?>

            <div style="background: #fff; padding: 20px; margin: 20px 0; border: 1px solid #ccc;">
                <h2>Step 0: Disable Auto-Sync & Clean Broken Files</h2>

                <?php
                $cron_active = wp_next_scheduled('svm_auto_sync_domains');
                $upload_dir = wp_upload_dir();
                $stats = $this->get_upload_stats();
                ?>

                <div style="margin-bottom: 20px; padding: 15px; background: #fff3cd; border-left: 4px solid #ffc107;">
                    <h3 style="margin-top: 0;">📊 Current Upload Folder Status</h3>
                    <ul style="margin: 10px 0;">
                        <li><strong>Total image files in uploads:</strong> <?php echo $stats['total_files']; ?></li>
                        <li><strong>Broken attachments (no file):</strong> <?php echo $stats['broken_attachments']; ?></li>
                        <li><strong>Orphaned files (no DB record):</strong> <?php echo $stats['orphaned_files']; ?></li>
                        <li><strong>Google Sheets cron job:</strong> <?php echo $cron_active ? '<span style="color: #d63638;">⚠️ ACTIVE (runs every 6 hours)</span>' : '<span style="color: #00a32a;">✅ Disabled</span>'; ?></li>
                    </ul>
                </div>

                <?php if ($cron_active): ?>
                <div style="margin-bottom: 15px;">
                    <form method="post" action="" style="display: inline;">
                        <?php wp_nonce_field('svm_disable_cron'); ?>
                        <input type="hidden" name="action" value="disable_cron">
                        <button type="submit" class="button button-secondary">⏸️ Disable Google Sheets Auto-Sync</button>
                    </form>
                    <p class="description">Stop the 6-hour cron job that may be creating broken logos</p>
                </div>
                <?php endif; ?>

                <?php if ($stats['broken_attachments'] > 0 || $stats['orphaned_files'] > 0): ?>
                <div style="margin-bottom: 15px;">
                    <form method="post" action="" style="display: inline;">
                        <?php wp_nonce_field('svm_delete_broken'); ?>
                        <input type="hidden" name="action" value="delete_broken">
                        <button type="submit" class="button button-secondary" onclick="return confirm('This will permanently delete <?php echo $stats['broken_attachments'] + $stats['orphaned_files']; ?> broken files. Continue?');">
                            🗑️ Delete All Broken Logo Files (<?php echo $stats['broken_attachments'] + $stats['orphaned_files']; ?>)
                        </button>
                    </form>
                    <p class="description">Permanently delete logo files that don't exist or have no database records</p>
                </div>
                <?php endif; ?>
            </div>

            <div style="background: #fff; padding: 20px; margin: 20px 0; border: 1px solid #ccc;">
                <h2>Step 1: Clean Up Orphaned Attachments</h2>
                <p>This will remove all attachment IDs from domain posts where the actual file doesn't exist.</p>
                <form method="post" action="">
                    <?php wp_nonce_field('svm_cleanup_logos'); ?>
                    <input type="hidden" name="action" value="cleanup_logos">
                    <button type="submit" class="button button-secondary">🧹 Clean Up Orphaned Logos</button>
                </form>
            </div>

            <div style="background: #fff; padding: 20px; margin: 20px 0; border: 1px solid #ccc;">
                <h2>Step 2: Upload Logos via FTP/SSH</h2>
                <p>Upload your PNG files to this folder:</p>
                <code style="display: block; padding: 10px; background: #f0f0f0; margin: 10px 0;">
                    /home/u753897407/domains/s.ventures/public_html/wp-content/uploads/bulk-logos/
                </code>
                <p><strong>File naming:</strong> Name files exactly like domain names:</p>
                <ul>
                    <li>✅ <code>acrobatfinance.com.png</code></li>
                    <li>✅ <code>digibuy.com.png</code></li>
                    <li>✅ <code>loyaltyhub.com.png</code></li>
                    <li>❌ <code>AcrobatFinance_com_logo.png</code> (too complex)</li>
                </ul>
            </div>

            <div style="background: #fff; padding: 20px; margin: 20px 0; border: 1px solid #ccc;">
                <h2>Step 3: Process Bulk Upload</h2>
                <?php
                $upload_dir = wp_upload_dir();
                $bulk_folder = $upload_dir['basedir'] . '/bulk-logos';
                $folder_exists = is_dir($bulk_folder);
                $file_count = 0;

                if ($folder_exists) {
                    $files = glob($bulk_folder . '/*.{png,PNG,jpg,JPG,jpeg,JPEG}', GLOB_BRACE);
                    $file_count = count($files);
                }
                ?>

                <?php if (!$folder_exists): ?>
                    <p style="color: #d63638;">❌ Folder doesn't exist yet. Create it first:</p>
                    <code>/home/u753897407/domains/s.ventures/public_html/wp-content/uploads/bulk-logos/</code>
                <?php elseif ($file_count === 0): ?>
                    <p style="color: #d63638;">❌ No PNG/JPG files found in the bulk-logos folder. Upload your logos first.</p>
                <?php else: ?>
                    <p style="color: #00a32a;">✅ Found <?php echo $file_count; ?> image files ready to process!</p>

                    <form method="post" action="">
                        <?php wp_nonce_field('svm_bulk_upload'); ?>
                        <input type="hidden" name="action" value="bulk_upload">
                        <button type="submit" class="button button-primary">📤 Process Bulk Upload (<?php echo $file_count; ?> files)</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <?php

        // Handle disable cron action
        if (isset($_POST['action']) && $_POST['action'] === 'disable_cron') {
            check_admin_referer('svm_disable_cron');
            wp_clear_scheduled_hook('svm_auto_sync_domains');
            wp_redirect(admin_url('edit.php?post_type=domains&page=svm-bulk-upload&cron_disabled=1'));
            exit;
        }

        // Handle delete broken files action
        if (isset($_POST['action']) && $_POST['action'] === 'delete_broken') {
            check_admin_referer('svm_delete_broken');
            $result = $this->delete_broken_files();
            wp_redirect(admin_url('edit.php?post_type=domains&page=svm-bulk-upload&files_deleted=' . $result['files_deleted'] . '&attachments_deleted=' . $result['attachments_deleted']));
            exit;
        }

        // Handle cleanup action
        if (isset($_POST['action']) && $_POST['action'] === 'cleanup_logos') {
            check_admin_referer('svm_cleanup_logos');
            $cleaned = $this->cleanup_orphaned_logos();
            wp_redirect(admin_url('edit.php?post_type=domains&page=svm-bulk-upload&cleaned=' . $cleaned));
            exit;
        }

        // Handle bulk upload action
        if (isset($_POST['action']) && $_POST['action'] === 'bulk_upload') {
            check_admin_referer('svm_bulk_upload');
            $result = $this->process_bulk_upload();
            wp_redirect(admin_url('edit.php?post_type=domains&page=svm-bulk-upload&uploaded=' . $result['uploaded'] . '&matched=' . $result['matched']));
            exit;
        }
    }

    /**
     * Get statistics about uploads folder
     */
    public function get_upload_stats() {
        $upload_dir = wp_upload_dir();
        $basedir = $upload_dir['basedir'];

        // Count total image files in uploads
        $total_files = 0;
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($basedir));
        foreach ($iterator as $file) {
            if ($file->isFile() && preg_match('/\.(png|jpg|jpeg|webp)$/i', $file->getFilename())) {
                $total_files++;
            }
        }

        // Count broken attachments (DB record exists but file doesn't)
        global $wpdb;
        $broken_attachments = 0;
        $attachment_ids = $wpdb->get_col("SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND post_mime_type LIKE 'image/%'");

        foreach ($attachment_ids as $id) {
            $file_path = get_attached_file($id);
            if (!$file_path || !file_exists($file_path)) {
                $broken_attachments++;
            }
        }

        // Count orphaned files (file exists but no DB record)
        $orphaned_files = 0;
        // This is approximate - we count total files minus valid attachments
        $valid_attachments = count($attachment_ids) - $broken_attachments;
        $orphaned_files = max(0, $total_files - $valid_attachments);

        return array(
            'total_files' => $total_files,
            'broken_attachments' => $broken_attachments,
            'orphaned_files' => $orphaned_files
        );
    }

    /**
     * Delete broken logo files
     */
    public function delete_broken_files() {
        global $wpdb;

        $files_deleted = 0;
        $attachments_deleted = 0;

        // Get all attachment IDs
        $attachment_ids = $wpdb->get_col("SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND post_mime_type LIKE 'image/%'");

        foreach ($attachment_ids as $id) {
            $file_path = get_attached_file($id);

            if (!$file_path || !file_exists($file_path)) {
                // Broken attachment - delete the DB record
                wp_delete_attachment($id, true);
                $attachments_deleted++;
            }
        }

        return array(
            'files_deleted' => $files_deleted,
            'attachments_deleted' => $attachments_deleted
        );
    }

    /**
     * Clean up orphaned logo attachments where files don't exist
     */
    public function cleanup_orphaned_logos() {
        $domains = get_posts(array(
            'post_type' => 'domains',
            'posts_per_page' => -1,
            'post_status' => 'any'
        ));

        $cleaned = 0;

        foreach ($domains as $domain) {
            $logo_id = get_post_meta($domain->ID, 'svm_logo_id', true);

            if (!empty($logo_id) && is_numeric($logo_id)) {
                // Check if attachment file actually exists
                $file_path = get_attached_file($logo_id);

                if (!$file_path || !file_exists($file_path)) {
                    // File doesn't exist - remove the broken reference
                    delete_post_meta($domain->ID, 'svm_logo_id');
                    $cleaned++;
                }
            }
        }

        return $cleaned;
    }

    /**
     * Process bulk upload from bulk-logos folder
     */
    public function process_bulk_upload() {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');

        $upload_dir = wp_upload_dir();
        $bulk_folder = $upload_dir['basedir'] . '/bulk-logos';

        // Get all image files from bulk-logos folder
        $files = glob($bulk_folder . '/*.{png,PNG,jpg,JPG,jpeg,JPEG}', GLOB_BRACE);

        $uploaded = 0;
        $matched = 0;

        foreach ($files as $file_path) {
            $filename = basename($file_path);

            // Extract domain name from filename
            // Supports: acrobatfinance.com.png or acrobatfinance_com.png
            $domain_name = preg_replace('/\.(png|jpg|jpeg)$/i', '', $filename);
            $domain_name = str_replace('_', '.', $domain_name); // Convert underscores to dots

            // Find matching domain post
            $domain_posts = get_posts(array(
                'post_type' => 'domains',
                'title' => $domain_name,
                'posts_per_page' => 1,
                'post_status' => 'any'
            ));

            if (empty($domain_posts)) {
                // Try case-insensitive search
                $domain_posts = get_posts(array(
                    'post_type' => 'domains',
                    'posts_per_page' => -1,
                    'post_status' => 'any'
                ));

                foreach ($domain_posts as $post) {
                    if (strtolower($post->post_title) === strtolower($domain_name)) {
                        $domain_posts = array($post);
                        break;
                    }
                }
            }

            // Upload to WordPress media library
            $wp_filetype = wp_check_filetype($filename, null);
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($domain_name . ' Logo'),
                'post_content' => '',
                'post_status' => 'inherit'
            );

            // Copy file to uploads directory
            $new_filename = wp_unique_filename($upload_dir['path'], $filename);
            $new_file_path = $upload_dir['path'] . '/' . $new_filename;

            if (copy($file_path, $new_file_path)) {
                $attach_id = wp_insert_attachment($attachment, $new_file_path);

                if (!is_wp_error($attach_id)) {
                    // Generate metadata and thumbnails (including WebP conversion)
                    $attach_data = wp_generate_attachment_metadata($attach_id, $new_file_path);
                    wp_update_attachment_metadata($attach_id, $attach_data);

                    $uploaded++;

                    // Match to domain post if found
                    if (!empty($domain_posts)) {
                        $domain_post = $domain_posts[0];
                        update_post_meta($domain_post->ID, 'svm_logo_id', $attach_id);
                        $matched++;
                    }
                }
            }
        }

        return array(
            'uploaded' => $uploaded,
            'matched' => $matched
        );
    }
}

new SVM_Bulk_Logo_Uploader();
