
<?php
/**
 * S.Ventures Market v3 (Fluent) Functions
 */

add_action('after_setup_theme', function(){
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('customize-selective-refresh-widgets');
  add_theme_support('automatic-feed-links');
  add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption'));
  add_theme_support('custom-logo');
  add_theme_support('custom-header');
  add_theme_support('custom-background');
  add_theme_support('static-front-page'); // enables "Your homepage displays"
});

add_action('wp_enqueue_scripts', function(){
  wp_enqueue_style('s-ventures-style', get_stylesheet_uri(), [], '3.0.0');
});

// Register Domain CPT
add_action('init', function(){
  register_post_type('domain', [
    'labels' => ['name'=>'Domains','singular_name'=>'Domain'],
    'public' => true,
    'supports' => ['title','editor','thumbnail','excerpt'],
    'has_archive' => true,
    'rewrite' => ['slug'=>'domains'],
    'show_in_rest'=>true,
  ]);
});

// Meta fields for domains
function svm_domain_meta_fields(){
  return [
    'svm_price'=>'Price (USD)',
    'svm_status'=>'Status',
    'svm_tld'=>'TLD',
    'svm_length'=>'Length',
    'svm_age'=>'Age',
    'svm_backlinks'=>'Backlinks',
    'svm_traffic'=>'Traffic'
  ];
}

add_action('add_meta_boxes', function(){
  add_meta_box('svm_meta','Domain Details', function($post){
    foreach(svm_domain_meta_fields() as $k=>$label){
      $val = get_post_meta($post->ID,$k,true);
      echo '<p><label>'.$label.'<br><input type="text" name="'.$k.'" value="'.esc_attr($val).'" /></label></p>';
    }
  }, 'domain');
});

add_action('save_post_domain', function($post_id){
  if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
  foreach(svm_domain_meta_fields() as $k=>$label){
    if(isset($_POST[$k])) update_post_meta($post_id,$k,sanitize_text_field($_POST[$k]));
  }
});

// Admin settings for API keys
add_action('admin_menu', function(){
  add_options_page('S.Ventures Settings','S.Ventures','manage_options','svm-settings','svm_settings_page');
});

function svm_settings_page(){
  if(isset($_POST['svm_ipapi_key'])){
    update_option('svm_ipapi_key',sanitize_text_field($_POST['svm_ipapi_key']));
    update_option('svm_escrow_email',sanitize_text_field($_POST['svm_escrow_email']));
    echo '<div class="updated"><p>Saved</p></div>';
  }
  $ip = get_option('svm_ipapi_key','');
  $esc = get_option('svm_escrow_email','');
  echo '<div class="wrap"><h1>S.Ventures Settings</h1><form method="post">';
  echo '<p><label>ipapi.co API Key<br><input type="text" name="svm_ipapi_key" value="'.esc_attr($ip).'" size="50"></label></p>';
  echo '<p><label>Escrow.com Email<br><input type="text" name="svm_escrow_email" value="'.esc_attr($esc).'" size="50"></label></p>';
  echo '<p><input type="submit" class="button button-primary" value="Save"></p></form></div>';
}

// Hook into Fluent Forms submission for enrichment
add_action('fluentform_before_insert_submission', function($insertData, $formData){
  $ip = $_SERVER['REMOTE_ADDR'];
  $api = get_option('svm_ipapi_key');
  if($api){
    $url = "https://ipapi.co/".$ip."/json/?key=".$api;
    $resp = wp_remote_get($url);
    if(!is_wp_error($resp)){
      $body = json_decode(wp_remote_retrieve_body($resp),true);
      $insertData['parsed']['ip_enrichment'] = maybe_serialize($body);
    }
  }
  return $insertData;
}, 10, 2);
