<?php
/**
 * Diagnostic script to check Domain Transfer Instructions page status
 * Run this from the command line: php check-transfer-page.php
 */

// Load WordPress
require_once(__DIR__ . '/wp-load.php');

echo "\n=== Domain Transfer Instructions Page Diagnostic ===\n\n";

// Check if page exists
$pages = get_pages([
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-domain-transfer-instructions.php'
]);

if (empty($pages)) {
    echo "❌ ERROR: No page found with the 'Domain Transfer Instructions by Registrar' template assigned.\n\n";
    echo "To fix this:\n";
    echo "1. Go to WordPress Admin > Pages > Add New\n";
    echo "2. Create a page titled 'Domain Transfer Instructions by Registrar'\n";
    echo "3. In the Page Attributes box (right sidebar), select the template:\n";
    echo "   'Domain Transfer Instructions by Registrar'\n";
    echo "4. Publish the page\n\n";

    // Check if a page with similar title exists
    $similar_pages = get_pages([
        'post_status' => 'publish,draft,private',
    ]);

    foreach ($similar_pages as $page) {
        if (stripos($page->post_title, 'transfer') !== false || stripos($page->post_title, 'registrar') !== false) {
            $template = get_page_template_slug($page->ID);
            echo "Found similar page: '{$page->post_title}' (Status: {$page->post_status})\n";
            echo "  - URL: " . get_permalink($page->ID) . "\n";
            echo "  - Template: " . ($template ?: 'default') . "\n\n";
        }
    }
} else {
    foreach ($pages as $page) {
        echo "✓ Page found!\n\n";
        echo "Title: {$page->post_title}\n";
        echo "Status: {$page->post_status}\n";
        echo "URL: " . get_permalink($page->ID) . "\n";
        echo "Slug: {$page->post_name}\n";
        echo "Template: " . get_page_template_slug($page->ID) . "\n";
        echo "Last Modified: {$page->post_modified}\n\n";

        if ($page->post_status !== 'publish') {
            echo "⚠️  WARNING: Page is not published! Status is '{$page->post_status}'\n";
            echo "   Go to WordPress Admin and publish this page.\n\n";
        }

        // Check if the template file exists
        $template_file = get_template_directory() . '/page-domain-transfer-instructions.php';
        if (file_exists($template_file)) {
            echo "✓ Template file exists: {$template_file}\n";
            echo "  Last modified: " . date("Y-m-d H:i:s", filemtime($template_file)) . "\n\n";
        } else {
            echo "❌ ERROR: Template file does not exist!\n\n";
        }
    }
}

// Check active theme
$theme = wp_get_theme();
echo "Active Theme: {$theme->get('Name')} (Version: {$theme->get('Version')})\n";
echo "Theme Directory: " . get_template_directory() . "\n\n";

// Check for caching plugins
$active_plugins = get_option('active_plugins');
$caching_plugins = ['litespeed-cache', 'wp-super-cache', 'w3-total-cache', 'wp-rocket', 'cache-enabler'];
$found_cache = false;

foreach ($active_plugins as $plugin) {
    foreach ($caching_plugins as $cache_plugin) {
        if (strpos($plugin, $cache_plugin) !== false) {
            echo "⚠️  Caching plugin detected: {$plugin}\n";
            echo "   Make sure to clear the cache after making changes.\n";
            $found_cache = true;
        }
    }
}

if ($found_cache) {
    echo "\n";
}

echo "=== End of Diagnostic ===\n\n";
