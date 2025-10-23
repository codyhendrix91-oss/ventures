<?php
/**
 * Single Blog Post Template
 */
get_header();

while (have_posts()): the_post();
  $categories = get_the_category();
  $primary_cat = !empty($categories) ? $categories[0] : null;
  $post_id = get_the_ID();
?>

<article class="blog-single">
  
  <!-- Hero with Featured Image -->
  <section class="post-hero">
    <?php if (has_post_thumbnail()): ?>
      <div class="post-hero__image" style="background-image: url('<?php echo get_the_post_thumbnail_url($post_id, 'full'); ?>');"></div>
    <?php endif; ?>
    
    <div class="post-hero__content">
      <div class="post-hero__inner">
        <!-- Breadcrumbs -->
        <nav class="breadcrumbs">
          <a href="<?php echo home_url(); ?>">Home</a>
          <span>›</span>
          <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>">Blog</a>
          <?php if ($primary_cat): ?>
            <span>›</span>
            <a href="<?php echo get_category_link($primary_cat->term_id); ?>"><?php echo esc_html($primary_cat->name); ?></a>
          <?php endif; ?>
        </nav>
        
        <!-- Category Badge -->
        <?php if ($primary_cat): ?>
          <a href="<?php echo get_category_link($primary_cat->term_id); ?>" class="post-category"><?php echo esc_html($primary_cat->name); ?></a>
        <?php endif; ?>
        
        <!-- Title -->
        <h1><?php the_title(); ?></h1>
        
        <!-- Meta -->
        <div class="post-meta">
          <span class="post-date">
            <svg viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
            </svg>
            <?php echo get_the_date('F j, Y'); ?>
          </span>
          <span>•</span>
          <span class="post-reading-time">
            <svg viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
            </svg>
            <?php echo svm_reading_time(); ?> min read
          </span>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Post Content -->
  <section class="post-content">
    <div class="post-content__inner">
      
      <!-- Main Content -->
      <div class="post-body">
        <?php the_content(); ?>
      </div>
      
      <!-- Tags -->
      <?php if (has_tag()): ?>
      <div class="post-tags">
        <h3>Tags</h3>
        <div class="tag-list">
          <?php
          $tags = get_the_tags();
          foreach($tags as $tag):
          ?>
            <a href="<?php echo get_tag_link($tag->term_id); ?>" class="tag-chip"><?php echo esc_html($tag->name); ?></a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
      
      <!-- Share Buttons -->
      <div class="post-share">
        <h3>Share This Article</h3>
        <div class="share-buttons">
          <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="share-btn share-btn--twitter" title="Share on Twitter">
            <svg viewBox="0 0 24 24" fill="currentColor">
              <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
            </svg>
          </a>
          <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="share-btn share-btn--linkedin" title="Share on LinkedIn">
            <svg viewBox="0 0 24 24" fill="currentColor">
              <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/>
              <circle cx="4" cy="4" r="2"/>
            </svg>
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="share-btn share-btn--facebook" title="Share on Facebook">
            <svg viewBox="0 0 24 24" fill="currentColor">
              <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
            </svg>
          </a>
          <button onclick="navigator.clipboard.writeText('<?php echo get_permalink(); ?>');alert('Link copied!');" class="share-btn share-btn--copy" title="Copy Link">
            <svg viewBox="0 0 24 24" fill="currentColor">
              <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/>
              <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71