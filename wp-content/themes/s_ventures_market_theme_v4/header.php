<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <style>
.header--builder {
  background: #0f173d;
  -webkit-font-smoothing: antialiased;
}
.header--builder .svm-menu {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: row;
}
.header--builder .svm-menu > li {
  display: flex;
  align-items: center;
  height: 100%;
  position: relative;
  padding: 0 20px 0 15px;
  cursor: pointer;
  border-bottom: 2px solid transparent;
}
.header--builder .svm-menu > li:hover,
.header--builder .svm-menu > li.current-menu-item {
  border-bottom-color: white;
}
.header--builder .svm-menu > li > a {
  font-family: Poppins, sans-serif;
  font-weight: 500;
  font-size: 14px;
  color: white;
  text-decoration: none;
  outline: none;
  margin: 0;
  padding: 0;
}
.header--builder .svm-menu .menu-item-has-children > a .caret {
  display: inline-block;
  width: 0;
  height: 0;
  margin-left: 6px;
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid white;
  transition: transform .2s ease;
}
.header--builder .svm-menu .menu-item-has-children.open > a .caret {
  transform: rotate(180deg);
}
  </style>
  <script>
document.addEventListener('DOMContentLoaded', function() {
  // Add carets to menu items with children
  const menuItems = document.querySelectorAll('.header--builder .menu-item-has-children > a');
  menuItems.forEach(function(link) {
    if (!link.querySelector('.caret')) {
      const caret = document.createElement('span');
      caret.className = 'caret';
      link.appendChild(caret);
    }
  });

  // Toggle dropdown on click
  menuItems.forEach(function(link) {
    link.addEventListener('click', function(e) {
      const parent = this.closest('.menu-item-has-children');
      parent.classList.toggle('open');
    });
  });
});
  </script>
</head>
<body <?php body_class(); ?>>

<header class="svm-header header--builder">
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