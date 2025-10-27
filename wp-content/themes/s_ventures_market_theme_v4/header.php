<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <style>
/* Builder.io Header Styling - Light Mode (Default for white pages) */
.header--builder {
  background: rgba(255, 255, 255, 0.7) !important;
  backdrop-filter: saturate(180%) blur(20px);
  -webkit-backdrop-filter: saturate(180%) blur(20px);
  -webkit-font-smoothing: antialiased;
  border-bottom: 1px solid rgba(0, 0, 0, 0.08);
}
.header--builder .svm-header__inner {
  height: 100%;
}
.header--builder .svm-nav {
  height: 100%;
}
.header--builder .svm-menu {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: row;
  height: 100%;
  align-items: stretch;
  gap: 0;
}
.header--builder .svm-menu > li {
  display: flex;
  align-items: center;
  height: 100%;
  position: relative;
  margin: 0;
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.37, 0.01, 0, 0.98);
  border-bottom: 3px solid transparent;
}
.header--builder .svm-menu > li:hover {
  background-color: rgba(43, 35, 74, 0.06);
  border-bottom-color: #2B234A;
}
.header--builder .svm-menu > li.current-menu-item,
.header--builder .svm-menu > li.current_page_item {
  border-bottom-color: #2B234A;
}
.header--builder .svm-menu > li > a {
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  font-size: 14px;
  color: rgba(0, 0, 0, 0.87);
  text-decoration: none;
  outline: none;
  margin: 0;
  padding: 0 20px;
  display: flex;
  align-items: center;
  gap: 4px;
  height: 100%;
  width: 100%;
  transition: color 0.2s ease;
}
.header--builder .svm-menu > li > a:hover {
  color: rgba(0, 0, 0, 0.95);
}
.header--builder .svm-menu > li > a:focus {
  outline: none;
}
.header--builder .svm-menu > li > a::selection,
.header--builder .svm-menu > li > a *::selection {
  background: rgba(43, 35, 74, 0.15);
  color: inherit;
}
.header--builder .svm-menu .menu-item-has-children > a .caret {
  display: inline-block;
  width: 0;
  height: 0;
  margin-left: 4px;
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid currentColor;
  opacity: 0.6;
  transition: transform 0.2s ease;
}
.header--builder .svm-menu .menu-item-has-children.open > a .caret {
  transform: rotate(180deg);
}
.header--builder .svm-menu .sub-menu {
  position: absolute;
  top: 100%;
  left: 0;
  background: rgba(255, 255, 255, 0.98);
  backdrop-filter: saturate(180%) blur(20px);
  -webkit-backdrop-filter: saturate(180%) blur(20px);
  min-width: 220px;
  padding: 8px;
  border-radius: 8px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
  border: 1px solid rgba(0, 0, 0, 0.08);
  opacity: 0;
  visibility: hidden;
  transform: translateY(-8px);
  transition: all 0.2s ease;
  z-index: 1000;
  list-style: none;
}
.header--builder .svm-menu li:hover > .sub-menu {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}
.header--builder .svm-menu .sub-menu li {
  display: block;
  height: auto;
  border-bottom: none;
}
.header--builder .svm-menu .sub-menu li a {
  display: block;
  padding: 10px 16px;
  color: rgba(0, 0, 0, 0.87);
  font-size: 14px;
  font-weight: 500;
  border-radius: 6px;
  transition: all 0.15s ease;
  height: auto;
}
.header--builder .svm-menu .sub-menu li a:hover {
  background: rgba(43, 35, 74, 0.08);
  color: rgba(0, 0, 0, 0.95);
}

/* Dark Mode Header - For pages with dark backgrounds */
.header-dark .header--builder {
  background: rgba(26, 29, 53, 0.85) !important;
  backdrop-filter: saturate(180%) blur(20px);
  -webkit-backdrop-filter: saturate(180%) blur(20px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}
.header-dark .header--builder .svm-menu > li:hover {
  background-color: rgba(255, 255, 255, 0.08);
  border-bottom-color: rgba(255, 255, 255, 0.7);
}
.header-dark .header--builder .svm-menu > li.current-menu-item,
.header-dark .header--builder .svm-menu > li.current_page_item {
  border-bottom-color: rgba(255, 255, 255, 0.7);
}
.header-dark .header--builder .svm-menu > li > a {
  color: rgba(255, 255, 255, 0.95);
}
.header-dark .header--builder .svm-menu > li > a:hover {
  color: rgba(255, 255, 255, 1);
}
.header-dark .header--builder .svm-menu > li.current-menu-item > a,
.header-dark .header--builder .svm-menu > li.current_page_item > a {
  color: rgba(255, 255, 255, 1);
}
.header-dark .header--builder .svm-menu > li > a::selection,
.header-dark .header--builder .svm-menu > li > a *::selection {
  background: rgba(255, 255, 255, 0.2);
  color: inherit;
}
.header-dark .header--builder .svm-menu .sub-menu {
  background: rgba(26, 29, 53, 0.98);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}
.header-dark .header--builder .svm-menu .sub-menu li a {
  color: rgba(255, 255, 255, 0.95);
}
.header-dark .header--builder .svm-menu .sub-menu li a:hover {
  background: rgba(255, 255, 255, 0.1);
  color: rgba(255, 255, 255, 1);
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