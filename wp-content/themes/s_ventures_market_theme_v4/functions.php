<?php
/**
 * S.Ventures Market Theme v6 – Complete Working Version
 * Enhanced with domainnames.com best practices
 */
if ( ! defined('ABSPATH') ) { exit; }

/* -------------------------------------------------------
 * Fix FluentForm Translation Loading Error
 * -----------------------------------------------------*/
add_filter('doing_it_wrong_trigger_error', function($trigger, $function) {
    if ($function === '_load_textdomain_just_in_time' && strpos($function, 'fluentform') !== false) {
        return false;
    }
    return $trigger;
}, 10, 2);

/* -------------------------------------------------------
 * SEO - Product Schema for Domains
 * -----------------------------------------------------*/
add_action('wp_head', function() {
    if (is_singular('domains')) {
        global $post;
        $domain_name = get_the_title();
        $status = get_post_meta($post->ID, 'svm_status', true);
        $logo_id = get_post_meta($post->ID, 'svm_logo_id', true);
        $logo_url = '';
        if ($logo_id) {
            $logo_url = wp_get_attachment_url($logo_id);
        }
        
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $domain_name,
            'description' => "Premium domain name $domain_name available for purchase. Contact us for pricing details.",
            'brand' => array(
                '@type' => 'Brand',
                'name' => 'S.Ventures'
            ),
            'offers' => array(
                '@type' => 'Offer',
                'url' => get_permalink(),
                'priceCurrency' => 'USD',
                'availability' => $status === 'sold' ? 'https://schema.org/OutOfStock' : 'https://schema.org/InStock',
                'priceSpecification' => array(
                    '@type' => 'PriceSpecification',
                    'price' => 'Contact for price'
                ),
                'seller' => array(
                    '@type' => 'Organization',
                    'name' => 'S.Ventures'
                )
            )
        );
        
        if ($logo_url) {
            $schema['image'] = $logo_url;
        }
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }
}, 99);

add_action('wp_footer', function() {
    if (is_front_page()) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'S Ventures',
            'alternateName' => 'S.Ventures',
            'url' => home_url(),
            'logo' => get_stylesheet_directory_uri() . '/assets/SVentures_fixed_cleaned.svg',
            'description' => 'Premium domain portfolio for startups and entrepreneurs. 20+ years of experience in domain investing, branding, and venture development.',
            'email' => 'info@s.ventures',
            'address' => array(
                '@type' => 'PostalAddress',
                'addressLocality' => 'Houston',
                'addressRegion' => 'TX',
                'addressCountry' => 'US'
            ),
            'contactPoint' => array(
                '@type' => 'ContactPoint',
                'telephone' => '+1-281-726-1751',
                'contactType' => 'Customer Service',
                'availableLanguage' => 'English'
            )
        );
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }
}, 20);

/* -------------------------------------------------------
 * Header Styling - Conditional Dark/Light Modes
 * -----------------------------------------------------*/
add_filter('body_class', function($classes) {
    // Pages with white backgrounds keep the light header
    // All other pages get the dark header
    $white_pages = array(
        'page-template-front-page',
        'single-domains',
        'page-template-page-newsletter',
    );

    $has_white_bg = false;
    foreach ($white_pages as $page_class) {
        if (in_array($page_class, $classes)) {
            $has_white_bg = true;
            break;
        }
    }

    // Also check if it's the front page or single post type
    if (is_front_page() || is_singular('domains')) {
        $has_white_bg = true;
    }

    // If not a white background page, add dark header class
    if (!$has_white_bg) {
        $classes[] = 'header-dark';
    }

    return $classes;
});

/* -------------------------------------------------------
 * Assets
 * -----------------------------------------------------*/
add_action('wp_enqueue_scripts', function () {
    $style_path = get_stylesheet_directory() . '/style.css';
    $style_ver = file_exists($style_path) ? filemtime($style_path) : null;
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), $style_ver);

    wp_enqueue_style(
        'svm-font-colour-brown',
        'https://fonts.googleapis.com/css2?family=Colour+Brown:wght@600;700&display=swap',
        array(),
        null
    );

    $css = <<<CSS
:root{
    --color-hero:#1a1d35;
    --color-dark:#0a0e27;
    --color-accent:#00d9ff;
    --color-green:#2efc86;
    --color-text:#fff;
    --font-primary:'Colour Brown',sans-serif;
    --font-secondary:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;
}
body{margin:0;font-family:var(--font-secondary);background:#fff;color:#111827;}
CSS;

    wp_register_style('svm-inline', false);
    wp_enqueue_style('svm-inline');
    wp_add_inline_style('svm-inline', $css);

    wp_register_script('svm-global', false, array(), null, true);
    wp_enqueue_script('svm-global');

    wp_localize_script('svm-global', 'svmAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('svm_nonce')
    ));

$js = <<<JS
(function(){
document.addEventListener('DOMContentLoaded', function () {
    var header = document.querySelector('.svm-header');
    var btn = document.querySelector('.svm-menu-toggle');
    if (btn && header) btn.addEventListener('click', function(){
        header.classList.toggle('active');
    });

    var heroTitle = document.querySelector('.svm-hero .elementor-heading-title') || document.querySelector('.svm-hero h1');
    if (heroTitle) {
        var update = function(){
            heroTitle.style.setProperty('--translateY', (window.scrollY * 0.15) + 'px');
        };
        window.addEventListener('scroll', update, {passive:true});
        update();
    }

    var chips = document.querySelectorAll('.svm-chip');
    chips.forEach(function(chip){
        chip.addEventListener('click', function(){
            var inp = this.querySelector('input');
            if (inp) inp.checked = true;
            var form = this.closest('form');
            if (form) form.submit();
        });
    });
});
})();
JS;

    wp_add_inline_script('svm-global', $js);
});

// Header scroll effect
add_action('wp_enqueue_scripts', function() {
    $scroll_js = <<<JS
(function(){
document.addEventListener('DOMContentLoaded', function() {
  var header = document.querySelector('.svm-header');
  if (!header) return;
  
  window.addEventListener('scroll', function() {
    var currentScroll = window.pageYOffset;
    if (currentScroll > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  }, { passive: true });
});
})();
JS;

    wp_add_inline_script('svm-global', $scroll_js);
}, 11);

/* -------------------------------------------------------
 * Menus - UPDATED WITH FOOTER MENUS
 * -----------------------------------------------------*/
add_action('after_setup_theme', function () {
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu', 'sventures'),
        'footer_company' => __('Footer - Company', 'sventures'),
        'footer_resources' => __('Footer - Resources', 'sventures'),
        'footer_legal' => __('Footer - Legal', 'sventures')
    ));
});

/* -------------------------------------------------------
 * CPT: Domains
 * -----------------------------------------------------*/
add_action('init', function () {
    register_post_type('domains', array(
        'labels' => array(
            'name' => 'Domains',
            'singular_name' => 'Domain',
            'add_new' => 'Add New Domain',
            'add_new_item' => 'Add New Domain',
            'edit_item' => 'Edit Domain',
            'new_item' => 'New Domain',
            'view_item' => 'View Domain',
            'search_items' => 'Search Domains',
            'not_found' => 'No domains found',
            'not_found_in_trash' => 'No domains found in trash'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'domains',
            'with_front' => false,
            'feeds' => true,
            'pages' => true
        ),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-site-alt3',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'taxonomies' => array('domain_category'),
        'show_in_rest' => true,
        'rest_base' => 'domains',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'exclude_from_search' => false,
        'can_export' => true,
        'delete_with_user' => false,
        '_builtin' => false,
        '_edit_link' => 'post.php?post=%d'
    ));

    register_taxonomy('domain_category', array('domains'), array(
        'labels' => array(
            'name' => 'Domain Categories',
            'singular_name' => 'Domain Category',
            'search_items' => 'Search Categories',
            'all_items' => 'All Categories',
            'parent_item' => 'Parent Category',
            'parent_item_colon' => 'Parent Category:',
            'edit_item' => 'Edit Category',
            'update_item' => 'Update Category',
            'add_new_item' => 'Add New Category',
            'new_item_name' => 'New Category Name',
            'menu_name' => 'Categories'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => array(
            'slug' => 'domain-category',
            'with_front' => false,
            'hierarchical' => true
        ),
        'show_in_rest' => true,
        'rest_base' => 'domain-categories',
        'rest_controller_class' => 'WP_REST_Terms_Controller'
    ));
});

// Force Yoast to recognize domains
add_filter('wpseo_accessible_post_types', 'svm_add_domains_to_yoast');
function svm_add_domains_to_yoast($post_types) {
    $post_types[] = 'domains';
    return $post_types;
}

add_filter('wpseo_robots', 'svm_force_index_domains', 999);
function svm_force_index_domains($robots) {
    if (is_singular('domains')) {
        return 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1';
    }
    return $robots;
}

add_action('wp_head', 'svm_remove_noindex_from_domains', 1);
function svm_remove_noindex_from_domains() {
    if (is_singular('domains')) {
        remove_action('wp_head', 'wp_no_robots');
        remove_action('wp_head', 'noindex', 1);
    }
}

add_action('init', 'svm_ensure_domains_searchable', 999);
function svm_ensure_domains_searchable() {
    global $wp_post_types;
    
    if (isset($wp_post_types['domains'])) {
        $wp_post_types['domains']->public = true;
        $wp_post_types['domains']->publicly_queryable = true;
        $wp_post_types['domains']->exclude_from_search = false;
        $wp_post_types['domains']->show_in_nav_menus = true;
    }
}

/* -------------------------------------------------------
 * Domain cards + shortcodes
 * -----------------------------------------------------*/

/**
 * MEGA FIXED: Render domain card with proper logo priority system
 * Priority 1: Uploaded media logos (svm_logo_id)
 * Priority 2: Google Sheets synced URL (svm_logo_url)
 * Priority 3: Assets folder WebP/PNG fallback
 */
function svm_render_domain_card($id) {
    $title = get_the_title($id);
    $link = get_permalink($id);
    $logo = '';
    $fallback_logo = '';

    // PRIORITY 1: Check for uploaded media logo
    $logo_id = get_post_meta($id, 'svm_logo_id', true);
    if (is_numeric($logo_id) && $logo_id > 0) {
        // User uploaded a logo via WordPress media library - USE THIS FIRST
        $uploaded_logo = wp_get_attachment_image_url((int)$logo_id, 'medium');
        if ($uploaded_logo) {
            $logo = $uploaded_logo;
        }
    }

    // PRIORITY 2: Check for custom logo URL from Google Sheets sync
    if (empty($logo)) {
        $custom_logo = get_post_meta($id, 'svm_logo_url', true);
        if (!empty($custom_logo)) {
            $logo = $custom_logo;
        }
    }

    // PRIORITY 3: Fallback to assets folder logo
    if (empty($logo)) {
        $domain_parts = str_replace('.', '_', $title);
        $theme_url = get_stylesheet_directory_uri();
        $theme_path = get_stylesheet_directory();
        $assets_dir = $theme_path . '/assets/';

        // Build comprehensive list of possible filenames
        $possible_names = array(
            $domain_parts,  // Exact as entered
            ucfirst(strtolower($domain_parts)),  // Ucfirst lowercase
            strtolower($domain_parts),  // All lowercase
            ucwords(str_replace('_', ' ', $domain_parts))  // Title case with spaces
        );

        // Add title case version with underscores
        $possible_names[] = str_replace(' ', '_', $possible_names[3]);

        $found_logo = false;

        // Try each possible filename with both extensions
        foreach ($possible_names as $base_name) {
            $base_name = str_replace(' ', '_', $base_name); // Ensure underscores

            // Try webp
            if (file_exists($assets_dir . $base_name . '_logo.webp')) {
                $logo = $theme_url . '/assets/' . $base_name . '_logo.webp';
                $found_logo = true;
                break;
            }

            // Try png
            if (file_exists($assets_dir . $base_name . '_logo.png')) {
                $logo = $theme_url . '/assets/' . $base_name . '_logo.png';
                $found_logo = true;
                break;
            }
        }

        // Last resort: case-insensitive glob search
        if (!$found_logo && is_dir($assets_dir)) {
            $search_base = strtolower(str_replace('.', '_', $title));
            $all_logos = glob($assets_dir . '*_logo.{webp,png}', GLOB_BRACE);

            if ($all_logos) {
                foreach ($all_logos as $logo_path) {
                    $filename = basename($logo_path);
                    $file_base = strtolower(pathinfo($filename, PATHINFO_FILENAME));

                    if ($file_base === $search_base . '_logo') {
                        $logo = $theme_url . '/assets/' . $filename;
                        $found_logo = true;
                        break;
                    }
                }
            }
        }

        // If still no logo, use a placeholder
        if (!$found_logo) {
            $logo = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="400" height="200" viewBox="0 0 400 200"%3E%3Crect fill="%23f3f4f6" width="400" height="200"/%3E%3Ctext x="50%25" y="50%25" dominant-baseline="middle" text-anchor="middle" font-family="system-ui" font-size="20" fill="%239ca3af"%3E' . esc_attr($title) . '%3C/text%3E%3C/svg%3E';
        }
    }

    ob_start();
    ?>
    <article class="svm-card">
        <?php if ($logo): ?>
            <div class="svm-card__logo-wrapper">
                <img class="svm-card__logo"
                     src="<?php echo esc_url($logo); ?>"
                     <?php if ($fallback_logo): ?>onerror="this.src='<?php echo esc_url($fallback_logo); ?>'; this.onerror=null;"<?php endif; ?>
                     loading="lazy"
                     alt="<?php echo esc_attr($title); ?> logo">
            </div>
        <?php endif; ?>
        <h3 class="svm-card__title"><?php echo esc_html($title); ?></h3>
        <a class="svm-card__cta" href="<?php echo esc_url($link); ?>">View Domain</a>
    </article>
    <?php
    return ob_get_clean();
}


add_shortcode('svm_market_explorer', function () {
    $q = new WP_Query(array(
        'post_type'=>'domains',
        'posts_per_page'=>24,
        'orderby'=>'title','order'=>'ASC',
        'meta_query'=>array(
            'relation'=>'OR',
            array('key'=>'svm_status','value'=>'sold','compare'=>'!='),
            array('key'=>'svm_status','compare'=>'NOT EXISTS')
        )
    ));

    ob_start();
    ?>
    <section class="svm-explorer"><div class="svm-grid">
        <?php
        if ($q->have_posts()) {
            while ($q->have_posts()) {
                $q->the_post();
                echo svm_render_domain_card(get_the_ID());
            }
        } else {
            echo '<p style="grid-column:1/-1;text-align:center;">No domains available right now.</p>';
        }
        wp_reset_postdata();
        ?>
    </div></section>
    <?php
    return ob_get_clean();
});

add_shortcode('svm_market_brief', function () {
    $q = new WP_Query(array(
        'post_type'=>'domains',
        'posts_per_page'=>12,
        'orderby'=>'title','order'=>'ASC',
        'meta_query'=>array(
            'relation'=>'OR',
            array('key'=>'svm_status','value'=>'sold','compare'=>'!='),
            array('key'=>'svm_status','compare'=>'NOT EXISTS')
        )
    ));

    ob_start();
    ?>
    <section class="svm-explorer"><div class="svm-grid">
        <?php
        if ($q->have_posts()) {
            while ($q->have_posts()) {
                $q->the_post();
                echo svm_render_domain_card(get_the_ID());
            }
        } else {
            echo '<p style="grid-column:1/-1;text-align:center;">No domains available right now.</p>';
        }
        wp_reset_postdata();
        ?>
    </div>
    <div class="svm-pager"><a href="<?php echo esc_url(home_url('/domains')); ?>" class="svm-pagebtn svm-pagebtn--lg">View more available names</a></div>
    </section>
    <?php
    return ob_get_clean();
});

add_shortcode('svm_logo', function () {
    $logo_url = get_stylesheet_directory_uri() . '/assets/SVentures_fixed_cleaned.svg';
    return '<img src="'.esc_url($logo_url).'" alt="S.Ventures - Premium Domain Portfolio" class="svm-site-logo" width="140" height="52" />';
});

add_filter('upload_mimes', function($m){
    $m['svg'] = 'image/svg+xml';
    return $m;
});

/* -------------------------------------------------------
 * Domain Metabox
 * -----------------------------------------------------*/
add_action('add_meta_boxes', function () {
    add_meta_box('svm_domain_fields', 'SVM Domain Fields', function($post){
        wp_nonce_field('svm_domain_save','svm_domain_nonce');

        $fields = array(
            'svm_price' => get_post_meta($post->ID,'svm_price',true) ?: get_post_meta($post->ID,'_svm_price',true),
            'svm_status' => get_post_meta($post->ID,'svm_status',true) ?: get_post_meta($post->ID,'_svm_status',true),
            'svm_logo_id' => get_post_meta($post->ID,'svm_logo_id',true),
            'svm_stripe_price_id' => get_post_meta($post->ID,'svm_stripe_price_id',true) ?: get_post_meta($post->ID,'_svm_stripe_price_id',true),
            'svm_auto_escrow' => get_post_meta($post->ID,'svm_auto_escrow',true),
        );
        
        $logo_url = '';
        if ($fields['svm_logo_id']) {
            $logo_url = wp_get_attachment_url($fields['svm_logo_id']);
        }
        ?>
        <style>
            .svm-metabox-row{ margin-bottom:15px; }
            .svm-metabox-row label{ display:block; margin-bottom:5px; font-weight:600; }
            .svm-metabox-row input[type="text"],
            .svm-metabox-row input[type="number"],
            .svm-metabox-row select{ width:100%; max-width:400px; }
            .svm-logo-preview{ margin-top:10px; max-width:200px; max-height:100px; border:1px solid #ddd; padding:10px; background:#f9f9f9; }
            .svm-logo-preview img{ max-width:100%; height:auto; }
            .button.svm-upload-logo{ margin-top:5px; }
            .button.svm-remove-logo{ margin-top:5px; margin-left:5px; }
            .svm-helper-text{ font-size:12px; color:#666; margin-top:5px; font-style:italic; }
        </style>

        <div class="svm-metabox-row">
            <label>Domain Logo</label>
            <input type="hidden" name="svm_logo_id" id="svm_logo_id" value="<?php echo esc_attr($fields['svm_logo_id']); ?>">
            <button type="button" class="button svm-upload-logo">
                <?php echo $logo_url ? 'Change Logo' : 'Upload Logo'; ?>
            </button>
            <?php if ($logo_url): ?>
                <button type="button" class="button svm-remove-logo">Remove Logo</button>
            <?php endif; ?>
            <div class="svm-logo-preview" <?php echo $logo_url ? '' : 'style="display:none;"'; ?>>
                <img src="<?php echo esc_url($logo_url); ?>" alt="Logo Preview">
            </div>
        </div>

        <div class="svm-metabox-row">
            <label>Price (USD)</label>
            <input type="number" name="svm_price" value="<?php echo esc_attr($fields['svm_price']); ?>" min="1" step="1">
            <p class="svm-helper-text">Enter the asking price in USD</p>
        </div>

        <div class="svm-metabox-row">
            <label>Status</label>
            <select name="svm_status">
                <?php foreach(array('available','sold','pending') as $st): ?>
                    <option value="<?php echo esc_attr($st); ?>" <?php selected($fields['svm_status'],$st); ?>><?php echo ucfirst($st); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="svm-metabox-row">
            <label>
                <input type="checkbox" name="svm_auto_escrow" value="1" <?php checked($fields['svm_auto_escrow'], '1'); ?>>
                Enable Auto-Generated Escrow.com Link
            </label>
        </div>

        <div class="svm-metabox-row">
            <label>Stripe Price ID</label>
            <input type="text" name="svm_stripe_price_id" value="<?php echo esc_attr($fields['svm_stripe_price_id']); ?>" readonly style="background:#f0f0f0;">
            <p class="svm-helper-text">Auto-generated when you save with a price</p>
        </div>

        <script>
        jQuery(document).ready(function($){
            var mediaUploader;
            
            $('.svm-upload-logo').on('click', function(e) {
                e.preventDefault();
                
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                
                mediaUploader = wp.media({
                    title: 'Choose Domain Logo',
                    button: { text: 'Use this image' },
                    multiple: false,
                    library: { type: 'image' }
                });
                
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#svm_logo_id').val(attachment.id);
                    $('.svm-logo-preview img').attr('src', attachment.url);
                    $('.svm-logo-preview').show();
                    $('.svm-upload-logo').text('Change Logo');
                    if ($('.svm-remove-logo').length === 0) {
                        $('.svm-upload-logo').after('<button type="button" class="button svm-remove-logo" style="margin-left:5px;">Remove Logo</button>');
                    }
                });
                
                mediaUploader.open();
            });
            
            $(document).on('click', '.svm-remove-logo', function(e) {
                e.preventDefault();
                $('#svm_logo_id').val('');
                $('.svm-logo-preview').hide();
                $('.svm-upload-logo').text('Upload Logo');
                $(this).remove();
            });
        });
        </script>
        <?php
    }, 'domains', 'normal', 'high');
});

add_action('save_post_domains', function($post_id){
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['svm_domain_nonce']) || !wp_verify_nonce($_POST['svm_domain_nonce'],'svm_domain_save')) return;
    if (!current_user_can('edit_post',$post_id)) return;

    if (isset($_POST['svm_logo_id'])) {
        update_post_meta($post_id, 'svm_logo_id', absint($_POST['svm_logo_id']));
    }

    if (isset($_POST['svm_price'])) {
        update_post_meta($post_id, 'svm_price', absint($_POST['svm_price']));
    }

    if (isset($_POST['svm_status'])) {
        update_post_meta($post_id, 'svm_status', sanitize_text_field($_POST['svm_status']));
    }

    $auto_escrow = isset($_POST['svm_auto_escrow']) ? '1' : '0';
    update_post_meta($post_id, 'svm_auto_escrow', $auto_escrow);

    if (isset($_POST['svm_stripe_price_id'])) {
        update_post_meta($post_id, 'svm_stripe_price_id', sanitize_text_field($_POST['svm_stripe_price_id']));
    }

    $secret = defined('SVM_STRIPE_SECRET') ? SVM_STRIPE_SECRET : '';
    $price = (int) get_post_meta($post_id,'svm_price',true);
    if ($secret && $price && !get_post_meta($post_id,'svm_stripe_price_id',true)) {
        $c = svm_stripe_create_product_and_price($secret, get_the_title($post_id), $price);
        if (!empty($c['price_id'])) update_post_meta($post_id,'svm_stripe_price_id',$c['price_id']);
    }
});

/* -------------------------------------------------------
 * Stripe
 * -----------------------------------------------------*/
function svm_stripe_create_product_and_price($secret,$name,$usd){
    $headers = array('Authorization' => 'Bearer '.$secret);

    $p = wp_remote_post('https://api.stripe.com/v1/products', array(
        'headers'=>$headers,
        'body'=>array('name'=>$name)
    ));
    $prod = json_decode(wp_remote_retrieve_body($p), true);

    $pr = wp_remote_post('https://api.stripe.com/v1/prices', array(
        'headers'=>$headers,
        'body'=>array(
            'unit_amount'=>$usd*100,
            'currency'=>'usd',
            'product'=> isset($prod['id']) ? $prod['id'] : ''
        )
    ));
    $price = json_decode(wp_remote_retrieve_body($pr), true);

    return array(
        'product_id'=> isset($prod['id']) ? $prod['id'] : '',
        'price_id' => isset($price['id']) ? $price['id'] : ''
    );
}

add_action('wp_ajax_svm_create_checkout','svm_ajax_create_checkout');
add_action('wp_ajax_nopriv_svm_create_checkout','svm_ajax_create_checkout');

function svm_ajax_create_checkout(){
    $id = (int)($_POST['post_id'] ?? 0);
    $pid = get_post_meta($id,'svm_stripe_price_id',true);
    $secret = defined('SVM_STRIPE_SECRET') ? SVM_STRIPE_SECRET : '';

    if (!$id || !$pid || !$secret) {
        wp_send_json_error(array('message'=>'Checkout unavailable'));
    }

    $res = wp_remote_post('https://api.stripe.com/v1/checkout/sessions', array(
        'headers'=>array('Authorization'=>'Bearer '.$secret),
        'body'=>array(
            'mode'=>'payment',
            'line_items[0][price]'=>$pid,
            'line_items[0][quantity]'=>1,
            'success_url'=>home_url('/?checkout=success'),
            'cancel_url'=>get_permalink($id)
        )
    ));

    $data = json_decode(wp_remote_retrieve_body($res), true);

    if (empty($data['url'])) {
        wp_send_json_error(array('message'=>'Stripe error'));
    }

    wp_send_json_success(array('redirect'=>$data['url']));
}

/* -------------------------------------------------------
 * EMAIL VERIFICATION
 * -----------------------------------------------------*/
add_action('wp_ajax_svm_submit_lead','svm_submit_lead');
add_action('wp_ajax_nopriv_svm_submit_lead','svm_submit_lead');

function svm_submit_lead(){
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');
    
    if (!isset($_POST['_ajax_nonce']) || !wp_verify_nonce($_POST['_ajax_nonce'], 'svm_nonce')) {
        wp_send_json_error(array('message'=>'Security check failed'));
    }

    $id = (int)($_POST['post_id'] ?? 0);
    $name = sanitize_text_field($_POST['full_name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');

    if (!$id || !$name || !$email) {
        wp_send_json_error(array('message'=>'Missing required fields'));
    }

    $company = sanitize_text_field($_POST['company'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $budget = sanitize_text_field($_POST['budget'] ?? '');
    $msg = sanitize_textarea_field($_POST['message'] ?? '');
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $ref = $_SERVER['HTTP_REFERER'] ?? '';

    $geo = array();
    $ipapi_key = defined('SVM_IPAPI_KEY') ? SVM_IPAPI_KEY : '';
    if ($ipapi_key && $ip) {
        $g = wp_remote_get("https://api.ipapi.com/api/{$ip}?access_key={$ipapi_key}");
    } else {
        $g = wp_remote_get("https://ipapi.co/{$ip}/json/");
    }
    if (!is_wp_error($g)) {
        $geo = json_decode(wp_remote_retrieve_body($g), true);
    }

    $token = wp_generate_password(32, false);
    $expiry = time() + (15 * 60);

    $lead_data = array(
        'post_id' => $id,
        'name' => $name,
        'email' => $email,
        'company' => $company,
        'phone' => $phone,
        'budget' => $budget,
        'message' => $msg,
        'ip' => $ip,
        'ua' => $ua,
        'ref' => $ref,
        'geo' => $geo,
        'expiry' => $expiry
    );

    set_transient('svm_lead_' . $token, $lead_data, 900);

    $domain_name = get_the_title($id);
    $verify_url = add_query_arg(array(
        'svm_verify' => $token,
        'post_id' => $id
    ), get_permalink($id));

    $subject = 'Verify your email - ' . $domain_name . ' Inquiry';
    
    $message = "Hi {$name},\n\n";
    $message .= "Thank you for your interest in {$domain_name}!\n\n";
    $message .= "Please verify your email address by clicking the link below:\n\n";
    $message .= $verify_url . "\n\n";
    $message .= "This link will expire in 15 minutes.\n\n";
    $message .= "Once verified, you'll be able to view the pricing and purchase options.\n\n";
    $message .= "Best regards,\nS.Ventures Team";

    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    $email_sent = wp_mail($email, $subject, $message, $headers);

    if (!$email_sent) {
        wp_send_json_error(array('message'=>'Failed to send verification email'));
    }

    wp_send_json_success(array(
        'message' => 'Verification email sent! Please check your inbox.',
        'email' => $email
    ));
}

add_action('template_redirect', 'svm_handle_email_verification');

function svm_handle_email_verification() {
    if (!isset($_GET['svm_verify']) || !isset($_GET['post_id'])) {
        return;
    }

    $token = sanitize_text_field($_GET['svm_verify']);
    $post_id = (int)$_GET['post_id'];

    $lead_data = get_transient('svm_lead_' . $token);

    if (!$lead_data || $lead_data['expiry'] < time()) {
        wp_redirect(add_query_arg('verification', 'expired', get_permalink($post_id)));
        exit;
    }

    if ($lead_data['post_id'] !== $post_id) {
        wp_redirect(home_url());
        exit;
    }

    $content = "Domain: ".get_the_title($post_id)."\n" .
               "Name: {$lead_data['name']}\nEmail: {$lead_data['email']}\n" .
               "Company: {$lead_data['company']}\nPhone: {$lead_data['phone']}\n" .
               "Budget: {$lead_data['budget']}\n" .
               "Message: {$lead_data['message']}\n" .
               "IP: {$lead_data['ip']}\nUA: {$lead_data['ua']}\n" .
               "Ref: {$lead_data['ref']}\nGeo: ".wp_json_encode($lead_data['geo']);

    wp_insert_comment(array(
        'comment_post_ID' => $post_id,
        'comment_author' => $lead_data['name'],
        'comment_author_email' => $lead_data['email'],
        'comment_content' => $content,
        'comment_type' => 'svm_lead',
        'comment_approved' => 0
    ));

    $to = 'info@s.ventures';
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    @wp_mail($to, 'New Domain Lead (Verified): '.get_the_title($post_id), $content, $headers);

    svm_send_to_hubspot($lead_data);

    delete_transient('svm_lead_' . $token);

    if (!session_id()) session_start();

    if (!isset($_SESSION['svm_verified']) || !is_array($_SESSION['svm_verified'])) {
        $_SESSION['svm_verified'] = array();
    }
    $_SESSION['svm_verified'][$post_id] = 1;
    
    setcookie('svm_v_'.$post_id, '1', time() + 60*60*24*30, COOKIEPATH ?: '/', COOKIE_DOMAIN ?: '', is_ssl(), true);

    wp_redirect(add_query_arg('verified', $post_id, get_permalink($post_id)));
    exit;
}

/* -------------------------------------------------------
 * HubSpot
 * -----------------------------------------------------*/
function svm_send_to_hubspot($lead_data) {
    if (!defined('HUBSPOT_ACCESS_TOKEN')) {
        return false;
    }
    
    $token = HUBSPOT_ACCESS_TOKEN;
    $owner_id = '160341265';
    
    $contact_data = array(
        'properties' => array(
            'email' => $lead_data['email'],
            'firstname' => $lead_data['name'],
            'phone' => $lead_data['phone'],
            'company' => $lead_data['company'],
            'lifecyclestage' => 'lead',
            'hs_lead_status' => 'NEW',
            'hubspot_owner_id' => $owner_id
        )
    );
    
    $notes = "Domain Interest: " . get_the_title($lead_data['post_id']) . "\n";
    if (!empty($lead_data['budget'])) {
        $notes .= "Budget: $" . $lead_data['budget'] . "\n";
    }
    if (!empty($lead_data['message'])) {
        $notes .= "Message: " . $lead_data['message'] . "\n";
    }
    $contact_data['properties']['hs_content_membership_notes'] = $notes;
    
    if (!empty($lead_data['geo'])) {
        if (!empty($lead_data['geo']['city'])) {
            $contact_data['properties']['city'] = $lead_data['geo']['city'];
        }
        if (!empty($lead_data['geo']['region'])) {
            $contact_data['properties']['state'] = $lead_data['geo']['region'];
        }
        if (!empty($lead_data['geo']['country'])) {
            $contact_data['properties']['country'] = $lead_data['geo']['country'];
        }
    }
    
    $response = wp_remote_post('https://api.hubapi.com/crm/v3/objects/contacts', array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json'
        ),
        'body' => wp_json_encode($contact_data),
        'timeout' => 15
    ));
    
    if (is_wp_error($response)) {
        return false;
    }
    
    $status = wp_remote_retrieve_response_code($response);
    
    if ($status === 201 || $status === 200) {
        return true;
    }
    
    return false;
}

/* -------------------------------------------------------
 * Blog Functions
 * -----------------------------------------------------*/
function svm_reading_time() {
  $content = get_post_field('post_content', get_the_ID());
  $word_count = str_word_count(strip_tags($content));
  $reading_time = ceil($word_count / 200);
  return $reading_time;
}

add_theme_support('post-thumbnails');
set_post_thumbnail_size(1200, 630, true);
add_image_size('blog-featured', 1200, 630, true);
add_image_size('blog-card', 800, 500, true);

// Elementor support for blog posts and pages
add_action('after_setup_theme', function() {
    add_theme_support('elementor');

    // Enable Elementor for specific post types
    add_post_type_support('post', 'elementor');
    add_post_type_support('page', 'elementor');
    add_post_type_support('domains', 'elementor');
});

// Fix Elementor canvas template (removes header/footer when using Elementor full-width)
add_filter('template_include', function($template) {
    if (class_exists('\Elementor\Plugin')) {
        $document = \Elementor\Plugin::$instance->documents->get(get_the_ID());
        if ($document && $document->is_built_with_elementor()) {
            $page_template = get_post_meta(get_the_ID(), '_wp_page_template', true);
            if ('elementor_canvas' === $page_template) {
                return ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';
            }
            if ('elementor_header_footer' === $page_template) {
                return ELEMENTOR_PATH . '/modules/page-templates/templates/header-footer.php';
            }
        }
    }
    return $template;
});

function svm_custom_excerpt_length($length) {
    if (is_home() || is_archive()) {
        return 25;
    }
    return $length;
}
add_filter('excerpt_length', 'svm_custom_excerpt_length');

function svm_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'svm_excerpt_more');

/* -------------------------------------------------------
 * Newsletter Signup Form - Re.Ventures
 * -----------------------------------------------------*/

/**
 * Render newsletter signup form
 * Integrates with GoHighLevel (GHL)
 */
function svm_newsletter_form($inline = false) {
    // Get GHL form action URL from WordPress options (can be set in Settings)
    $ghl_form_action = get_option('svm_ghl_form_action', '');

    $wrapper_class = $inline ? 'svm-newsletter--inline' : 'svm-newsletter--footer';

    ob_start();
    ?>
    <div class="svm-newsletter <?php echo esc_attr($wrapper_class); ?>">
        <div class="svm-newsletter__inner">
            <div class="svm-newsletter__content">
                <p class="svm-newsletter__text">
                    Subscribe to <strong>Re.Ventures</strong> — because you deserve better than recycled LinkedIn advice, made up X stories and founders patting themselves on the back.
                </p>
            </div>

            <div class="svm-newsletter__form-wrapper">
                <form class="svm-newsletter__form"
                      action="<?php echo esc_url($ghl_form_action); ?>"
                      method="POST"
                      data-ghl-form="newsletter">

                    <div class="svm-newsletter__input-group">
                        <!-- Honeypot field (hidden from users, bots will fill it) -->
                        <input type="text"
                               name="website"
                               style="position:absolute;left:-9999px;width:1px;height:1px;"
                               tabindex="-1"
                               autocomplete="off"
                               aria-hidden="true">

                        <!-- Timestamp to prevent too-fast submissions -->
                        <input type="hidden" name="form_timestamp" value="<?php echo time(); ?>">

                        <input type="email"
                               name="email"
                               class="svm-newsletter__input"
                               placeholder="Enter your email address"
                               required
                               aria-label="Email address">

                        <button type="submit" class="svm-newsletter__button">
                            <span class="button-text">Subscribe</span>
                            <span class="button-icon">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 8h14M9 2l6 6-6 6"/>
                                </svg>
                            </span>
                        </button>
                    </div>

                    <!-- Success/Error Messages -->
                    <div class="svm-newsletter__message" style="display: none;"></div>
                </form>
            </div>
        </div>
    </div>

    <style>
    /* Newsletter Form Styles */
    .svm-newsletter {
        background: #ffffff;
        border-top: 1px solid #e8e9ea;
        border-bottom: 1px solid #e8e9ea;
    }

    .svm-newsletter--footer {
        margin: 0;
        padding: 50px 20px;
    }

    .svm-newsletter--inline {
        margin: 60px 0;
        padding: 40px 20px;
        border-radius: 8px;
        border: 1px solid #e8e9ea;
    }

    .svm-newsletter__inner {
        max-width: 900px;
        margin: 0 auto;
    }

    .svm-newsletter__content {
        text-align: center;
        margin-bottom: 32px;
    }

    .svm-newsletter__text {
        font-size: 18px;
        line-height: 1.6;
        color: #374151;
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    .svm-newsletter__text strong {
        color: #7c3aed;
        font-weight: 700;
    }

    .svm-newsletter__form-wrapper {
        max-width: 600px;
        margin: 0 auto;
    }

    .svm-newsletter__input-group {
        display: flex;
        gap: 12px;
        align-items: stretch;
        border: 2px solid #e8e9ea;
        border-radius: 8px;
        padding: 6px;
        background: #f8f9fa;
        transition: border-color 0.3s ease;
    }

    .svm-newsletter__input-group:focus-within {
        border-color: #7c3aed;
        background: #ffffff;
    }

    .svm-newsletter__input {
        flex: 1;
        border: none;
        background: transparent;
        padding: 14px 16px;
        font-size: 16px;
        color: #1a1d35;
        outline: none;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    .svm-newsletter__input::placeholder {
        color: #9ca3af;
    }

    .svm-newsletter__button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        color: #ffffff;
        border: none;
        border-radius: 6px;
        padding: 14px 28px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        font-family: 'Colour Brown', sans-serif;
        white-space: nowrap;
    }

    .svm-newsletter__button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(124, 58, 237, 0.3);
    }

    .svm-newsletter__button:active {
        transform: translateY(0);
    }

    .button-icon {
        display: inline-flex;
        transition: transform 0.3s ease;
    }

    .svm-newsletter__button:hover .button-icon {
        transform: translateX(3px);
    }

    .svm-newsletter__message {
        margin-top: 16px;
        padding: 12px 16px;
        border-radius: 6px;
        font-size: 14px;
        text-align: center;
    }

    .svm-newsletter__message--success {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #10b981;
    }

    .svm-newsletter__message--error {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #ef4444;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .svm-newsletter--footer {
            padding: 40px 20px;
        }

        .svm-newsletter--inline {
            margin: 40px 0;
            padding: 30px 16px;
        }

        .svm-newsletter__text {
            font-size: 16px;
        }

        .svm-newsletter__input-group {
            flex-direction: column;
            gap: 8px;
        }

        .svm-newsletter__button {
            width: 100%;
            justify-content: center;
        }
    }
    </style>

    <script>
    // Basic form handling - can be enhanced with GHL webhook
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('[data-ghl-form="newsletter"]');

        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                // If no GHL action URL is set, handle with AJAX
                const actionUrl = this.getAttribute('action');

                if (!actionUrl || actionUrl === '') {
                    e.preventDefault();

                    const email = this.querySelector('input[name="email"]').value;
                    const messageEl = this.querySelector('.svm-newsletter__message');

                    // Send to WordPress AJAX endpoint (you can connect this to GHL via webhook)
                    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            action: 'svm_newsletter_signup',
                            email: email,
                            nonce: '<?php echo wp_create_nonce('svm_newsletter_nonce'); ?>'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        messageEl.style.display = 'block';
                        if (data.success) {
                            messageEl.className = 'svm-newsletter__message svm-newsletter__message--success';
                            messageEl.textContent = data.data.message || 'Thanks for subscribing!';
                            form.reset();
                        } else {
                            messageEl.className = 'svm-newsletter__message svm-newsletter__message--error';
                            messageEl.textContent = data.data.message || 'Something went wrong. Please try again.';
                        }

                        setTimeout(() => {
                            messageEl.style.display = 'none';
                        }, 5000);
                    })
                    .catch(error => {
                        messageEl.style.display = 'block';
                        messageEl.className = 'svm-newsletter__message svm-newsletter__message--error';
                        messageEl.textContent = 'Something went wrong. Please try again.';
                    });
                }
                // If GHL action URL is set, form will submit normally to GHL
            });
        });
    });
    </script>
    <?php
    return ob_get_clean();
}

/**
 * Send email to GoHighLevel via Webhook OR PIT Token
 * Supports both methods - tries PIT token first, then webhook
 */
function svm_send_to_ghl($email, $debug = false) {
    $ghl_pit_token = get_option('svm_ghl_pit_token', '');
    $ghl_location_id = get_option('svm_ghl_location_id', '');
    $ghl_webhook_url = get_option('svm_ghl_webhook_url', '');

    // Method 1: Try PIT Token + API (if configured)
    if (!empty($ghl_pit_token) && !empty($ghl_location_id)) {
        return svm_send_to_ghl_api($email, $ghl_pit_token, $ghl_location_id, $debug);
    }

    // Method 2: Try Webhook (if configured)
    if (!empty($ghl_webhook_url)) {
        return svm_send_to_ghl_webhook($email, $ghl_webhook_url, $debug);
    }

    // No method configured
    if ($debug) {
        return array(
            'success' => false,
            'error' => 'No integration method configured (need either PIT token + Location ID, or Webhook URL)'
        );
    }
    return false;
}

/**
 * Send via PIT Token to GHL API
 */
function svm_send_to_ghl_api($email, $pit_token, $location_id, $debug = false) {
    $api_url = 'https://services.leadconnectorhq.com/contacts/';

    $body_data = array(
        'email' => $email,
        'locationId' => $location_id,
        'tags' => array('newsletter'),
        'source' => 'website_newsletter'
    );

    $args = array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $pit_token,
            'Content-Type' => 'application/json',
            'Version' => '2021-07-28'
        ),
        'body' => json_encode($body_data),
        'timeout' => 15,
        'method' => 'POST'
    );

    $response = wp_remote_post($api_url, $args);

    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        error_log('GHL API (PIT) WP Error: ' . $error_message);

        if ($debug) {
            return array(
                'success' => false,
                'method' => 'PIT Token API',
                'error' => 'WordPress HTTP Error: ' . $error_message
            );
        }
        return false;
    }

    $response_code = wp_remote_retrieve_response_code($response);
    $response_body = wp_remote_retrieve_body($response);

    error_log('GHL API (PIT) Response Code: ' . $response_code);
    error_log('GHL API (PIT) Response Body: ' . $response_body);

    if ($response_code === 200 || $response_code === 201) {
        if ($debug) {
            return array(
                'success' => true,
                'method' => 'PIT Token API',
                'response_code' => $response_code,
                'response_body' => $response_body
            );
        }
        return true;
    }

    if ($debug) {
        return array(
            'success' => false,
            'method' => 'PIT Token API',
            'error' => 'API returned error code',
            'response_code' => $response_code,
            'response_body' => $response_body,
            'request_url' => $api_url,
            'request_body' => $body_data
        );
    }

    return false;
}

/**
 * Send via Webhook to GHL
 */
function svm_send_to_ghl_webhook($email, $webhook_url, $debug = false) {
    $body_data = array(
        'email' => $email,
        'tag' => 'newsletter',
        'source' => 'website_newsletter',
        'subscribed_date' => current_time('mysql'),
        'website' => home_url()
    );

    $args = array(
        'headers' => array(
            'Content-Type' => 'application/json'
        ),
        'body' => json_encode($body_data),
        'timeout' => 15,
        'method' => 'POST'
    );

    $response = wp_remote_post($webhook_url, $args);

    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        error_log('GHL Webhook WP Error: ' . $error_message);

        if ($debug) {
            return array(
                'success' => false,
                'method' => 'Webhook',
                'error' => 'WordPress HTTP Error: ' . $error_message
            );
        }
        return false;
    }

    $response_code = wp_remote_retrieve_response_code($response);
    $response_body = wp_remote_retrieve_body($response);

    error_log('GHL Webhook Response Code: ' . $response_code);
    error_log('GHL Webhook Response Body: ' . $response_body);

    if ($response_code === 200 || $response_code === 201 || $response_code === 202) {
        if ($debug) {
            return array(
                'success' => true,
                'method' => 'Webhook',
                'response_code' => $response_code,
                'response_body' => $response_body
            );
        }
        return true;
    }

    if ($debug) {
        return array(
            'success' => false,
            'method' => 'Webhook',
            'error' => 'Webhook returned error code',
            'response_code' => $response_code,
            'response_body' => $response_body,
            'webhook_url' => $webhook_url,
            'request_body' => $body_data
        );
    }

    return false;
}

/**
 * AJAX handler for newsletter signups
 * This stores emails in WordPress database and syncs to GoHighLevel
 */
add_action('wp_ajax_svm_newsletter_signup', 'svm_handle_newsletter_signup');
add_action('wp_ajax_nopriv_svm_newsletter_signup', 'svm_handle_newsletter_signup');

function svm_handle_newsletter_signup() {
    check_ajax_referer('svm_newsletter_nonce', 'nonce');

    // SPAM PROTECTION 1: Honeypot field check
    if (!empty($_POST['website'])) {
        // Bot filled the honeypot field - reject silently
        wp_send_json_success(array('message' => 'Thanks for subscribing!'));
        exit;
    }

    // SPAM PROTECTION 2: Time-based check (form must be open at least 3 seconds)
    if (isset($_POST['form_timestamp'])) {
        $form_time = intval($_POST['form_timestamp']);
        $current_time = time();
        $time_diff = $current_time - $form_time;

        if ($time_diff < 3) {
            // Form submitted too fast - likely a bot
            wp_send_json_success(array('message' => 'Thanks for subscribing!'));
            exit;
        }
    }

    $email = sanitize_email($_POST['email']);

    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address.'));
    }

    // SPAM PROTECTION 3: Block suspicious email patterns
    $email_parts = explode('@', $email);

    // Check for suspicious patterns in email username
    if (preg_match('/\d{3,}/', $email_parts[0])) {
        // Email has 3+ consecutive numbers in username - likely spam
        wp_send_json_success(array('message' => 'Thanks for subscribing!'));
        exit;
    }

    // Check for random character patterns (common in spam)
    if (preg_match('/[a-z]{2}\d+[a-z]{2}\d+/i', $email_parts[0])) {
        // Pattern like "ab123cd456" - likely spam
        wp_send_json_success(array('message' => 'Thanks for subscribing!'));
        exit;
    }

    // SPAM PROTECTION 4: Rate limiting by IP
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $transient_key = 'newsletter_ip_' . md5($user_ip);
    $recent_submissions = get_transient($transient_key);

    if ($recent_submissions && $recent_submissions >= 3) {
        wp_send_json_error(array('message' => 'Too many requests. Please try again later.'));
        exit;
    }

    // Increment submission count (expires in 1 hour)
    set_transient($transient_key, ($recent_submissions ? $recent_submissions + 1 : 1), HOUR_IN_SECONDS);

    // Store in WordPress database
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';

    // Create table if doesn't exist
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        subscribed_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        status varchar(20) DEFAULT 'active' NOT NULL,
        PRIMARY KEY  (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // Insert email
    $result = $wpdb->insert(
        $table_name,
        array(
            'email' => $email,
            'subscribed_date' => current_time('mysql'),
            'status' => 'active'
        ),
        array('%s', '%s', '%s')
    );

    if ($result) {
        // Send to GoHighLevel
        $ghl_success = svm_send_to_ghl($email);

        if ($ghl_success) {
            wp_send_json_success(array('message' => 'Thanks for subscribing! Check your inbox.'));
        } else {
            // Still success in WordPress, but GHL failed (email saved locally)
            wp_send_json_success(array('message' => 'Thanks for subscribing!'));
        }
    } else {
        // Check if email already exists
        if ($wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE email = %s", $email)) > 0) {
            wp_send_json_error(array('message' => 'This email is already subscribed.'));
        }
        wp_send_json_error(array('message' => 'Something went wrong. Please try again.'));
    }
}

/**
 * Shortcode for inline newsletter form (for blog posts)
 */
add_shortcode('newsletter', 'svm_newsletter_shortcode');
add_shortcode('newsletter_signup', 'svm_newsletter_shortcode');

function svm_newsletter_shortcode($atts) {
    return svm_newsletter_form(true);
}

/* -------------------------------------------------------
 * Sell Domain Form Handler
 * -----------------------------------------------------*/
add_action('wp_ajax_submit_domain_sell', 'svm_handle_sell_domain_form');
add_action('wp_ajax_nopriv_submit_domain_sell', 'svm_handle_sell_domain_form');

function svm_handle_sell_domain_form() {
    // Verify nonce for security
    if (!isset($_POST['sell_domain_nonce']) || !wp_verify_nonce($_POST['sell_domain_nonce'], 'sell_domain_form')) {
        wp_send_json_error(array('message' => 'Security check failed'));
    }

    // Honeypot spam check
    if (!empty($_POST['website'])) {
        // Bot filled the honeypot - reject silently
        wp_send_json_success(array('message' => 'Thank you! We have received your submission and will be in touch soon.'));
        exit;
    }

    // Get and sanitize form data
    $first_name = sanitize_text_field($_POST['first_name'] ?? '');
    $last_name = sanitize_text_field($_POST['last_name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $domain_name = sanitize_text_field($_POST['domain_name'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    // Validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($domain_name)) {
        wp_send_json_error(array('message' => 'Please fill in all required fields'));
    }

    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address'));
    }

    // Rate limiting by IP
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $transient_key = 'sell_domain_ip_' . md5($user_ip);
    $recent_submissions = get_transient($transient_key);

    if ($recent_submissions && $recent_submissions >= 3) {
        wp_send_json_error(array('message' => 'Too many requests. Please try again later.'));
        exit;
    }

    // Increment submission count (expires in 1 hour)
    set_transient($transient_key, ($recent_submissions ? $recent_submissions + 1 : 1), HOUR_IN_SECONDS);

    // Get additional information
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $ref = $_SERVER['HTTP_REFERER'] ?? '';

    // Store as a comment/lead for tracking
    $content = "DOMAIN SELL INQUIRY\n\n" .
               "Domain: {$domain_name}\n" .
               "Name: {$first_name} {$last_name}\n" .
               "Email: {$email}\n" .
               "Phone: {$phone}\n" .
               "Message: {$message}\n\n" .
               "IP: {$ip}\n" .
               "User Agent: {$ua}\n" .
               "Referrer: {$ref}";

    // Insert as a custom comment type for tracking
    wp_insert_comment(array(
        'comment_post_ID' => 0,
        'comment_author' => $first_name . ' ' . $last_name,
        'comment_author_email' => $email,
        'comment_content' => $content,
        'comment_type' => 'svm_sell_domain',
        'comment_approved' => 0
    ));

    // Send email notification to admin
    $to = 'info@s.ventures';
    $subject = 'New Domain Sell Inquiry: ' . $domain_name;
    $email_message = "You have received a new domain sell inquiry.\n\n" .
                     "Domain: {$domain_name}\n" .
                     "Name: {$first_name} {$last_name}\n" .
                     "Email: {$email}\n" .
                     "Phone: {$phone}\n\n" .
                     "Message:\n{$message}\n\n" .
                     "---\n" .
                     "IP Address: {$ip}\n" .
                     "User Agent: {$ua}";

    $headers = array('Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email);

    wp_mail($to, $subject, $email_message, $headers);

    // Send confirmation email to submitter
    $confirmation_subject = 'Thank you for your domain submission - S Ventures';
    $confirmation_message = "Hi {$first_name},\n\n" .
                           "Thank you for submitting {$domain_name} for our review.\n\n" .
                           "We have received your information and will evaluate your domain within 1-2 business days. " .
                           "If we are interested in acquiring your domain, we will reach out with an offer.\n\n" .
                           "What happens next:\n" .
                           "- Our team will review your domain\n" .
                           "- You will hear back from us within 1-2 business days\n" .
                           "- If we are interested, we will send you a straightforward offer\n\n" .
                           "Thank you for considering S Ventures.\n\n" .
                           "Best regards,\n" .
                           "The S Ventures Team\n\n" .
                           "---\n" .
                           "S Ventures\n" .
                           "https://s.ventures\n" .
                           "info@s.ventures";

    wp_mail($email, $confirmation_subject, $confirmation_message, array('Content-Type: text/plain; charset=UTF-8'));

    wp_send_json_success(array(
        'message' => 'Thank you! We have received your submission and will be in touch soon.'
    ));
}

/**
 * Newsletter form now displays directly in footer.php before footer section
 * No need for wp_footer hook
 */

/**
 * Add Settings Page for GHL Integration
 */
add_action('admin_menu', 'svm_newsletter_settings_menu');

function svm_newsletter_settings_menu() {
    add_submenu_page(
        'options-general.php',
        'Newsletter Settings',
        'Newsletter (GHL)',
        'manage_options',
        'svm-newsletter-settings',
        'svm_newsletter_settings_page'
    );
}

function svm_newsletter_settings_page() {
    // Save settings
    if (isset($_POST['svm_save_ghl_settings'])) {
        check_admin_referer('svm_ghl_settings');

        update_option('svm_ghl_pit_token', sanitize_text_field($_POST['svm_ghl_pit_token']));
        update_option('svm_ghl_location_id', sanitize_text_field($_POST['svm_ghl_location_id']));
        update_option('svm_ghl_webhook_url', esc_url_raw($_POST['svm_ghl_webhook_url']));

        echo '<div class="notice notice-success"><p>Settings saved! Newsletter signups will now sync to GoHighLevel.</p></div>';
    }

    // Test connection
    if (isset($_POST['svm_test_ghl'])) {
        check_admin_referer('svm_test_ghl');

        $test_email = 'test@example.com';
        $result = svm_send_to_ghl($test_email, true); // Debug mode

        if (is_array($result) && isset($result['success'])) {
            if ($result['success']) {
                $method = isset($result['method']) ? $result['method'] : 'Unknown';
                echo '<div class="notice notice-success"><p>✅ Connection successful using ' . esc_html($method) . '! Test contact created in GHL.</p></div>';
            } else {
                // Show detailed error
                echo '<div class="notice notice-error">';
                $method = isset($result['method']) ? $result['method'] : 'Unknown';
                echo '<p><strong>❌ Connection failed (' . esc_html($method) . ')</strong></p>';
                echo '<p><strong>Error:</strong> ' . esc_html($result['error']) . '</p>';

                if (isset($result['response_code'])) {
                    echo '<p><strong>Response Code:</strong> ' . esc_html($result['response_code']) . '</p>';
                }

                if (isset($result['response_body'])) {
                    echo '<p><strong>Response Body:</strong></p>';
                    echo '<pre style="background: #f5f5f5; padding: 10px; overflow-x: auto;">' . esc_html($result['response_body']) . '</pre>';
                }

                if (isset($result['request_url'])) {
                    echo '<p><strong>Request URL:</strong> ' . esc_html($result['request_url']) . '</p>';
                }

                if (isset($result['request_body'])) {
                    echo '<p><strong>Request Body:</strong></p>';
                    echo '<pre style="background: #f5f5f5; padding: 10px; overflow-x: auto;">' . esc_html(json_encode($result['request_body'], JSON_PRETTY_PRINT)) . '</pre>';
                }
                echo '</div>';
            }
        }
    }

    $pit_token = get_option('svm_ghl_pit_token', '');
    $location_id = get_option('svm_ghl_location_id', '');
    $webhook_url = get_option('svm_ghl_webhook_url', '');

    ?>
    <div class="wrap">
        <h1>Newsletter Settings (GoHighLevel)</h1>

        <div class="card" style="max-width: 800px; padding: 20px; margin: 20px 0; background: #d1f4ff; border-left: 4px solid #0073aa;">
            <h2 style="margin-top: 0;">✨ Two Integration Methods Available</h2>
            <p><strong>Choose ONE of these methods:</strong></p>
            <ul style="margin-left: 20px;">
                <li><strong>Method 1 (Recommended):</strong> PIT Token - Use your Private Integration Token</li>
                <li><strong>Method 2 (If webhooks work):</strong> Webhook - Use workflow webhook URL</li>
            </ul>
            <p>The system will automatically try PIT token first, then webhook.</p>
        </div>

        <div class="card" style="max-width: 800px; padding: 20px; margin: 20px 0;">
            <h2>Integration Configuration</h2>

            <form method="post" action="">
                <?php wp_nonce_field('svm_ghl_settings'); ?>

                <h3 style="border-bottom: 2px solid #0073aa; padding-bottom: 10px;">Method 1: PIT Token (Private Integration)</h3>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="svm_ghl_pit_token">PIT Token</label>
                        </th>
                        <td>
                            <input type="text"
                                   name="svm_ghl_pit_token"
                                   id="svm_ghl_pit_token"
                                   value="<?php echo esc_attr($pit_token); ?>"
                                   class="large-text"
                                   placeholder="pit-xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx">
                            <p class="description">Your Private Integration Token from Settings → Integrations → Private Applications</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="svm_ghl_location_id">Location ID</label>
                        </th>
                        <td>
                            <input type="text"
                                   name="svm_ghl_location_id"
                                   id="svm_ghl_location_id"
                                   value="<?php echo esc_attr($location_id); ?>"
                                   class="large-text"
                                   placeholder="E8nPU6ugwWwvvBrTLtN1">
                            <p class="description">Your GHL Location ID</p>
                        </td>
                    </tr>
                </table>

                <h3 style="border-bottom: 2px solid #0073aa; padding-bottom: 10px; margin-top: 30px;">Method 2: Webhook (Alternative)</h3>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="svm_ghl_webhook_url">Webhook URL</label>
                        </th>
                        <td>
                            <input type="url"
                                   name="svm_ghl_webhook_url"
                                   id="svm_ghl_webhook_url"
                                   value="<?php echo esc_attr($webhook_url); ?>"
                                   class="large-text"
                                   placeholder="https://services.leadconnectorhq.com/hooks/...">
                            <p class="description">Your GoHighLevel workflow webhook URL (if you have one)</p>
                        </td>
                    </tr>
                </table>

                <p class="submit">
                    <input type="submit"
                           name="svm_save_ghl_settings"
                           class="button button-primary"
                           value="Save Settings">
                </p>
            </form>

            <?php if (!empty($pit_token) || !empty($webhook_url)): ?>
            <hr style="margin: 30px 0;">
            <h3>Test Connection</h3>
            <p>Click below to test if your GHL connection is working properly.</p>
            <form method="post" action="">
                <?php wp_nonce_field('svm_test_ghl'); ?>
                <p class="submit">
                    <input type="submit"
                           name="svm_test_ghl"
                           class="button button-secondary"
                           value="Test GHL Connection">
                </p>
            </form>
            <?php endif; ?>
        </div>

        <div class="card" style="max-width: 800px; padding: 20px; margin: 20px 0; background: #f0f6fc; border-left: 4px solid #0073aa;">
            <h3>📊 Current Subscribers</h3>
            <?php
            global $wpdb;
            $table_name = $wpdb->prefix . 'newsletter_subscribers';
            $count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE status = 'active'");
            ?>
            <p><strong><?php echo $count; ?></strong> active subscribers stored in WordPress database.</p>
        </div>

        <div class="card" style="max-width: 800px; padding: 20px; margin: 20px 0;">
            <h3>ℹ️ How It Works</h3>
            <ul style="list-style: disc; margin-left: 20px;">
                <li>Newsletter form appears on all pages <strong>except single domain pages</strong></li>
                <li>Shortcode: <code>[newsletter]</code> for blog posts</li>
                <li>Emails are stored in WordPress database</li>
                <li>Emails are synced to GHL with "newsletter" tag</li>
                <li>Duplicate emails are prevented</li>
            </ul>
        </div>
    </div>
    <?php
}

/* -------------------------------------------------------
 * Domain View Tracking + Analytics Dashboard
 * -----------------------------------------------------*/
add_action('wp_footer', 'svm_track_domain_view', 98);
function svm_track_domain_view() {
    if (!is_singular('domains')) {
        return;
    }
    
    $post_id = get_the_ID();
    $view_count = (int) get_post_meta($post_id, 'svm_view_count', true);
    update_post_meta($post_id, 'svm_view_count', $view_count + 1);
    update_post_meta($post_id, 'svm_last_viewed', current_time('mysql'));
}

add_filter('manage_domains_posts_columns', 'svm_add_analytics_columns');
function svm_add_analytics_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['views'] = '👁️ Views';
            $new_columns['last_viewed'] = '🕗 Last Viewed';
        }
    }
    return $new_columns;
}

add_action('manage_domains_posts_custom_column', 'svm_show_analytics_columns', 10, 2);
function svm_show_analytics_columns($column, $post_id) {
    if ($column === 'views') {
        $views = get_post_meta($post_id, 'svm_view_count', true) ?: 0;
        echo '<strong style="color: #00d9ff;">' . number_format($views) . '</strong>';
    }
    
    if ($column === 'last_viewed') {
        $last = get_post_meta($post_id, 'svm_last_viewed', true);
        if ($last) {
            $time_ago = human_time_diff(strtotime($last), current_time('timestamp'));
            echo '<span style="color: #666;">' . $time_ago . ' ago</span>';
        } else {
            echo '<span style="color: #999;">Never</span>';
        }
    }
}

add_filter('manage_edit-domains_sortable_columns', 'svm_sortable_analytics_columns');
function svm_sortable_analytics_columns($columns) {
    $columns['views'] = 'svm_view_count';
    $columns['last_viewed'] = 'svm_last_viewed';
    return $columns;
}

add_action('pre_get_posts', 'svm_analytics_column_orderby');
function svm_analytics_column_orderby($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }
    
    $orderby = $query->get('orderby');
    
    if ('svm_view_count' === $orderby) {
        $query->set('meta_key', 'svm_view_count');
        $query->set('orderby', 'meta_value_num');
    }
    
    if ('svm_last_viewed' === $orderby) {
        $query->set('meta_key', 'svm_last_viewed');
        $query->set('orderby', 'meta_value');
    }
}

add_action('wp_dashboard_setup', 'svm_performance_dashboard_widget');
function svm_performance_dashboard_widget() {
    wp_add_dashboard_widget(
        'svm_domain_performance',
        '📊 Domain Portfolio Performance',
        'svm_render_performance_widget'
    );
}

function svm_render_performance_widget() {
    $top_domains = get_posts(array(
        'post_type' => 'domains',
        'posts_per_page' => 10,
        'orderby' => 'meta_value_num',
        'meta_key' => 'svm_view_count',
        'order' => 'DESC',
        'post_status' => 'publish'
    ));
    
    $all_domains = get_posts(array(
        'post_type' => 'domains',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'fields' => 'ids'
    ));
    
    $total_views = 0;
    $total_value = 0;
    
    foreach ($all_domains as $domain_id) {
        $views = (int) get_post_meta($domain_id, 'svm_view_count', true);
        $price = (int) get_post_meta($domain_id, 'svm_price', true);
        $total_views += $views;
        $total_value += $price;
    }
    
    ?>
    <style>
        .svm-dashboard{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif}
        .svm-stats-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:15px;margin-bottom:25px}
        .svm-stat-box{background:linear-gradient(135deg,#1a1d35 0%,#0a0e27 100%);padding:20px;border-radius:10px;text-align:center;color:#fff}
        .svm-stat-value{font-size:32px;font-weight:700;margin-bottom:5px;background:linear-gradient(135deg,#00d9ff 0%,#2efc86 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
        .svm-stat-label{font-size:12px;opacity:.9;text-transform:uppercase;letter-spacing:.5px}
        .svm-top-domains{margin-top:20px}
        .svm-top-domains h3{margin:0 0 15px;font-size:16px;color:#1a1d35}
        .svm-domain-row{display:flex;justify-content:space-between;padding:10px;border-bottom:1px solid #f0f0f0;align-items:center}
        .svm-domain-row:hover{background:#f8f9fa}
        .svm-domain-name{font-weight:600;color:#1a1d35}
        .svm-domain-views{background:linear-gradient(135deg,#00d9ff 0%,#00b8d9 100%);color:#fff;padding:4px 12px;border-radius:12px;font-size:12px;font-weight:700}
        .svm-dashboard-cta{margin-top:20px;padding-top:20px;border-top:2px solid #f0f0f0;text-align:center}
        .svm-dashboard-btn{display:inline-block;padding:10px 24px;background:linear-gradient(135deg,#00d9ff 0%,#00b8d9 100%);color:#fff;text-decoration:none;border-radius:6px;font-weight:600;transition:transform .2s}
        .svm-dashboard-btn:hover{transform:translateY(-2px);color:#fff}
    </style>
    
    <div class="svm-dashboard">
        <div class="svm-stats-grid">
            <div class="svm-stat-box">
                <div class="svm-stat-value"><?php echo count($all_domains); ?></div>
                <div class="svm-stat-label">Total Domains</div>
            </div>
            <div class="svm-stat-box">
                <div class="svm-stat-value"><?php echo number_format($total_views); ?></div>
                <div class="svm-stat-label">Total Views</div>
            </div>
            <div class="svm-stat-box">
                <div class="svm-stat-value">$<?php echo number_format($total_value); ?></div>
                <div class="svm-stat-label">Portfolio Value</div>
            </div>
        </div>
        
        <div class="svm-top-domains">
            <h3>🔥 Top Performing Domains</h3>
            <?php foreach ($top_domains as $domain): 
                $views = get_post_meta($domain->ID, 'svm_view_count', true) ?: 0;
            ?>
                <div class="svm-domain-row">
                    <span class="svm-domain-name"><?php echo esc_html($domain->post_title); ?></span>
                    <span class="svm-domain-views"><?php echo number_format($views); ?> views</span>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="svm-dashboard-cta">
            <a href="<?php echo admin_url('edit.php?post_type=domains'); ?>" class="svm-dashboard-btn">
                View All Domains →
            </a>
        </div>
    </div>
    <?php
}

// Auto-generate meta descriptions for domains
add_filter('wpseo_metadesc', 'svm_auto_domain_meta_description', 10, 2);
function svm_auto_domain_meta_description($metadesc, $presentation) {
    if (is_singular('domains') && empty($metadesc)) {
        $domain_name = get_the_title();
        
        $categories = get_the_terms(get_the_ID(), 'domain_category');
        $cat_names = $categories ? wp_list_pluck($categories, 'name') : array();
        $industry = !empty($cat_names) ? implode(', ', array_slice($cat_names, 0, 2)) : 'business';
        
        $metadesc = "Acquire {$domain_name} - A premium, brandable domain perfect for {$industry} startups. Instant brand authority, memorable name, strong SEO. Contact us for pricing information.";
    }
    return $metadesc;
}

// NOTE: Purple section removed from global hook - now only appears in page templates
// This prevents duplicate purple sections

/**
 * Add Description Meta Box to Domain Editor
 */
add_action('add_meta_boxes', 'svm_add_description_metabox');
function svm_add_description_metabox() {
    add_meta_box(
        'svm_domain_description',
        '📝 Domain Description (Shows on Page)',
        'svm_render_description_metabox',
        'domains',
        'normal',
        'high'
    );
}

function svm_render_description_metabox($post) {
    wp_nonce_field('svm_description_save', 'svm_description_nonce');
    
    $description = get_post_meta($post->ID, 'svm_description', true);
    
    ?>
    <style>
        .svm-description-help {
            background: #e7f3ff;
            border-left: 4px solid #00d9ff;
            padding: 12px;
            margin-bottom: 15px;
            font-size: 13px;
        }
        .svm-description-help strong {
            color: #1a1d35;
        }
        #svm_description {
            width: 100%;
            height: 200px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }
        .svm-char-count {
            margin-top: 8px;
            font-size: 12px;
            color: #666;
        }
    </style>
    
    <div class="svm-description-help">
        <strong>💡 This description appears on the domain page between the hero and FAQ sections.</strong>
        <br>
        • Write 2-4 paragraphs about why this domain is valuable
        <br>
        • Highlight the industry, use cases, and branding benefits
        <br>
        • This field syncs FROM Google Sheets (description column)
        <br>
        • You can edit here manually, but Google Sheets sync will overwrite on next sync
    </div>
    
    <textarea 
        id="svm_description" 
        name="svm_description" 
        placeholder="Example:

Example.com is a premium domain name perfect for modern startups and established businesses looking to make a bold statement in the technology sector. 

This short, memorable .com provides instant brand authority and trust with customers, investors, and partners. The name conveys innovation, reliability, and forward-thinking - essential qualities for any company looking to compete in today's digital landscape.

With increasing demand for premium domain names, Example.com represents not just a web address, but a strategic business asset that will appreciate in value while serving as the cornerstone of your digital presence.

Whether you're launching a SaaS platform, building an e-commerce empire, or establishing a consulting brand, Example.com gives you the professional edge you need to succeed."><?php echo esc_textarea($description); ?></textarea>
    
    <div class="svm-char-count">
        <span id="char-count">0</span> characters | 
        <span id="word-count">0</span> words
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        function updateCounts() {
            var text = $('#svm_description').val();
            var chars = text.length;
            var words = text.trim().split(/\s+/).filter(function(word) {
                return word.length > 0;
            }).length;
            
            $('#char-count').text(chars);
            $('#word-count').text(words);
        }
        
        $('#svm_description').on('input', updateCounts);
        updateCounts();
    });
    </script>
    <?php
}

// Save description meta box
add_action('save_post_domains', 'svm_save_description_metabox');
function svm_save_description_metabox($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['svm_description_nonce']) || !wp_verify_nonce($_POST['svm_description_nonce'], 'svm_description_save')) return;
    if (!current_user_can('edit_post', $post_id)) return;
    
    if (isset($_POST['svm_description'])) {
        update_post_meta($post_id, 'svm_description', wp_kses_post($_POST['svm_description']));
    }
}

// Add column to domains list in admin
add_filter('manage_domains_posts_columns', 'svm_add_description_column');
function svm_add_description_column($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['description_status'] = '📝 Description';
        }
    }
    return $new_columns;
}

add_action('manage_domains_posts_custom_column', 'svm_show_description_column', 10, 2);
function svm_show_description_column($column, $post_id) {
    if ($column === 'description_status') {
        $description = get_post_meta($post_id, 'svm_description', true);
        if (!empty($description)) {
            $word_count = str_word_count($description);
            echo '<span style="color: #2efc86; font-weight: 600;">✓ ' . $word_count . ' words</span>';
        } else {
            echo '<span style="color: #dc2626;">✗ No description</span>';
        }
    }
}
/* -------------------------------------------------------
 * FORCE PNG LOGOS - Disable WebP conversion for domain logos
 * -----------------------------------------------------*/
add_filter('wp_generate_attachment_metadata', function($metadata, $attachment_id) {
    // Only apply to domain logo attachments
    $parent_post_id = wp_get_post_parent_id($attachment_id);
    if ($parent_post_id && get_post_type($parent_post_id) === 'domains') {
        // Disable WebP conversion for this image
        add_filter('wp_upload_image_mime_transforms', '__return_empty_array', 100);
    }
    return $metadata;
}, 10, 2);

// Disable WebP conversion globally for PNG files (optional - use with caution)
add_filter('wp_upload_image_mime_transforms', function($transforms) {
    // Remove WebP transformation for PNG files
    if (isset($transforms['image/png'])) {
        unset($transforms['image/png']);
    }
    return $transforms;
}, 10, 1);

// Force original file URL for domain logos
add_filter('wp_get_attachment_url', function($url, $attachment_id) {
    // Check if this is a domain logo
    $parent_id = wp_get_post_parent_id($attachment_id);
    if ($parent_id && get_post_type($parent_id) === 'domains') {
        // Get the original file path
        $file = get_attached_file($attachment_id);
        if ($file && file_exists($file)) {
            $upload_dir = wp_upload_dir();
            $url = str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $file);
        }
    }
    return $url;
}, 10, 2);