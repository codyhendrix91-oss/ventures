<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <style>
/* Header: builder.io-like styling (header-only scope) */
:root{
  --sv-header-bg: #0f173d;
  --sv-header-pill-bg: rgba(255,255,255,0.06);
  --sv-header-pill-bg-hover: rgba(255,255,255,0.12);
  --sv-header-underline: #ffffff;
}
.header--builder {
  background: var(--sv-header-bg);
  -webkit-font-smoothing: antialiased; text-rendering: optimizeLegibility;
  font-family: "proxima-nova", ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
}
.header--builder .svm-menu > li > a{
  color:#fff; padding:10px 14px; border-radius: 999px; display:inline-flex; align-items:center; gap:8px;
  background: var(--sv-header-pill-bg); transition: background .2s ease, color .2s ease;
}
.header--builder .svm-menu > li > a:hover,
.header--builder .svm-menu > li.current-menu-item > a{
  background: var(--sv-header-pill-bg-hover);
}
.header--builder .svm-menu > li > a::after{
  content:""; display:block; height:2px; background: var(--sv-header-underline);
  transform: scaleX(0); transform-origin:left; transition: transform .2s ease; margin-top:6px; border-radius:2px;
}
.header--builder .svm-menu > li:hover > a::after,
.header--builder .svm-menu > li.current-menu-item > a::after{ transform: scaleX(1); }
.header--builder .svm-menu .menu-item-has-children > a .caret{
  display:inline-block; width:10px; height:10px; margin-left:4px;
  mask: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"><path d="M1 3l4 4 4-4" fill="none" stroke="%23fff" stroke-width="2"/></svg>') center/contain no-repeat;
  background:#fff; transition: transform .2s ease;
}
.header--builder .svm-menu .menu-item-has-children.open > a .caret{ transform: rotate(180deg); }
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