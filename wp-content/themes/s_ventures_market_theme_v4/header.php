<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="svm-header">
  <div class="svm-header__inner">
    <div class="svm-logo">
      <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="S.Ventures Home">
        <?php echo do_shortcode('[svm_logo]'); ?>
      </a>
    </div>
    <nav class="svm-nav">
      <?php wp_nav_menu([
        'theme_location'=>'primary_menu',
        'container'=>false,
        'menu_class'=>'svm-menu',
        'fallback_cb'=>''
      ]); ?>
    </nav>
    <button class="svm-menu-toggle" aria-label="Toggle Menu">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</header>