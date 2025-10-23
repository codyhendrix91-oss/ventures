<?php
/**
 * page.php - Default Page Template v6
 */
get_header(); ?>
<main id="site-content" role="main">
  <?php
  while (have_posts()): the_post();
    // No wrapper so Elementor sections can go full-bleed (svm-hero / svm-explorer)
    the_content();
  endwhile;
  ?>
</main>
<?php get_footer(); ?>