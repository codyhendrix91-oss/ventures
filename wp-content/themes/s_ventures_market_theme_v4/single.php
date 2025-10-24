<?php
/**
 * Single Blog Post Template - 2025 Best Practices
 * Modern, readable design with white content background
 * Full Elementor support
 */
get_header();

while (have_posts()): the_post();
  $categories = get_the_category();
  $primary_cat = !empty($categories) ? $categories[0] : null;
  $post_id = get_the_ID();

  // Check if Elementor is being used for this post
  $elementor_mode = class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->documents->get($post_id)->is_built_with_elementor();
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

  <!-- Post Content - WHITE BACKGROUND -->
  <section class="post-content">
    <div class="post-content__inner">

      <!-- Main Content -->
      <div class="post-body">
        <?php
        // Render Elementor content if using Elementor, otherwise standard content
        if ($elementor_mode) {
          echo \Elementor\Plugin::$instance->frontend->get_builder_content($post_id);
        } else {
          the_content();
        }
        ?>
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
              <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/>
            </svg>
          </button>
        </div>
      </div>

    </div>
  </section>

  <!-- Related Posts -->
  <?php
  $related_args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post__not_in' => array($post_id),
    'orderby' => 'rand',
  );

  if ($primary_cat) {
    $related_args['category__in'] = array($primary_cat->term_id);
  }

  $related_query = new WP_Query($related_args);

  if ($related_query->have_posts()):
  ?>
  <section class="related-posts">
    <div class="related-posts__inner">
      <h2>Related Articles</h2>
      <div class="related-posts__grid">
        <?php
        while ($related_query->have_posts()): $related_query->the_post();
          $rel_cats = get_the_category();
          $rel_cat = !empty($rel_cats) ? $rel_cats[0] : null;
        ?>
          <article class="blog-card">
            <?php if (has_post_thumbnail()): ?>
              <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" alt="<?php the_title_attribute(); ?>" class="blog-card__image">
            <?php else: ?>
              <div class="blog-card__image" style="background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);"></div>
            <?php endif; ?>

            <div class="blog-card__content">
              <div class="blog-card__meta">
                <?php if ($rel_cat): ?>
                  <span class="blog-card__category"><?php echo esc_html($rel_cat->name); ?></span>
                <?php endif; ?>
                <span class="blog-card__date">
                  <svg viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                  </svg>
                  <?php echo get_the_date('M j, Y'); ?>
                </span>
              </div>

              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

              <p class="blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>

              <a href="<?php the_permalink(); ?>" class="blog-card__link">
                Read More
                <svg viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
              </a>
            </div>
          </article>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

</article>

<style>
/* 2025 Blog Post Styles - Modern & Readable */

/* Hero Section */
.post-hero {
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);
  padding: calc(70px + 80px) 20px 80px;
  position: relative;
  overflow: hidden;
}

.post-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 50%, rgba(46, 252, 134, 0.05) 0%, transparent 70%);
  pointer-events: none;
  z-index: 0;
}

.post-hero__image {
  position: absolute;
  inset: 0;
  background-size: cover;
  background-position: center;
  opacity: 0.15;
  z-index: 0;
}

.post-hero__content {
  position: relative;
  z-index: 1;
}

.post-hero__inner {
  max-width: 900px;
  margin: 0 auto;
  text-align: center;
}

/* Breadcrumbs */
.breadcrumbs {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  margin-bottom: 24px;
  font-size: 14px;
  color: rgba(255, 255, 255, 0.7);
}

.breadcrumbs a {
  color: rgba(255, 255, 255, 0.8);
  text-decoration: none;
  transition: color 0.2s ease;
}

.breadcrumbs a:hover {
  color: #2efc86;
}

.breadcrumbs span {
  color: rgba(255, 255, 255, 0.5);
}

/* Category Badge */
.post-category {
  display: inline-block;
  padding: 6px 16px;
  background: linear-gradient(135deg, #2efc86 0%, #25d876 100%);
  color: #2B234A;
  border-radius: 20px;
  font-weight: 700;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 20px;
  text-decoration: none;
  transition: all 0.2s ease;
}

.post-category:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(46, 252, 134, 0.4);
}

/* Title */
.post-hero h1 {
  font-size: clamp(32px, 6vw, 56px);
  font-weight: 700;
  color: #fff;
  margin: 0 0 24px;
  line-height: 1.15;
  letter-spacing: -0.02em;
  font-family: 'Colour Brown', sans-serif;
}

/* Meta Info */
.post-meta {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  font-size: 15px;
  color: rgba(255, 255, 255, 0.8);
  flex-wrap: wrap;
}

.post-meta span {
  display: flex;
  align-items: center;
  gap: 6px;
}

.post-meta svg {
  width: 16px;
  height: 16px;
  opacity: 0.8;
}

/* Content Section - WHITE BACKGROUND */
.post-content {
  background: #ffffff;
  padding: 80px 20px;
}

.post-content__inner {
  max-width: 800px;
  margin: 0 auto;
}

/* Post Body - Typography Optimized for 2025 */
.post-body {
  font-size: 19px;
  line-height: 1.8;
  color: #374151;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}

.post-body h1,
.post-body h2,
.post-body h3,
.post-body h4,
.post-body h5,
.post-body h6 {
  font-family: 'Colour Brown', sans-serif;
  font-weight: 700;
  color: #1a1d35;
  margin: 48px 0 24px;
  line-height: 1.3;
  letter-spacing: -0.02em;
}

.post-body h1 { font-size: 42px; }
.post-body h2 { font-size: 36px; }
.post-body h3 { font-size: 28px; }
.post-body h4 { font-size: 24px; }
.post-body h5 { font-size: 20px; }
.post-body h6 { font-size: 18px; }

.post-body h2:first-child,
.post-body h3:first-child,
.post-body h4:first-child {
  margin-top: 0;
}

.post-body p {
  margin: 0 0 24px;
}

.post-body p:last-child {
  margin-bottom: 0;
}

.post-body a {
  color: #1ec770;
  text-decoration: underline;
  text-decoration-thickness: 2px;
  text-underline-offset: 3px;
  transition: all 0.2s ease;
}

.post-body a:hover {
  color: #2efc86;
  text-decoration-thickness: 3px;
}

.post-body strong {
  font-weight: 700;
  color: #2B234A;
}

.post-body em {
  font-style: italic;
}

.post-body ul,
.post-body ol {
  margin: 24px 0;
  padding-left: 28px;
}

.post-body li {
  margin: 12px 0;
  line-height: 1.7;
}

.post-body blockquote {
  margin: 40px 0;
  padding: 24px 32px;
  border-left: 4px solid #2efc86;
  background: linear-gradient(135deg, rgba(46, 252, 134, 0.05) 0%, rgba(46, 252, 134, 0.02) 100%);
  border-radius: 0 12px 12px 0;
  font-size: 21px;
  font-style: italic;
  color: #4b5563;
}

.post-body img {
  max-width: 100%;
  height: auto;
  border-radius: 12px;
  margin: 32px 0;
}

.post-body code {
  padding: 3px 8px;
  background: #f3f4f6;
  border-radius: 4px;
  font-family: 'Monaco', 'Courier New', monospace;
  font-size: 0.9em;
  color: #e11d48;
}

.post-body pre {
  background: #1a1d35;
  color: #e5e7eb;
  padding: 24px;
  border-radius: 12px;
  overflow-x: auto;
  margin: 32px 0;
}

.post-body pre code {
  background: none;
  padding: 0;
  color: #e5e7eb;
  font-size: 14px;
  line-height: 1.6;
}

/* Tags */
.post-tags {
  margin-top: 60px;
  padding-top: 40px;
  border-top: 2px solid #f3f4f6;
}

.post-tags h3 {
  font-size: 18px;
  font-weight: 700;
  color: #2B234A;
  margin: 0 0 16px;
  font-family: 'Colour Brown', sans-serif;
}

.tag-list {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}

.tag-chip {
  padding: 8px 18px;
  background: #f3f4f6;
  color: #4b5563;
  border-radius: 20px;
  font-size: 14px;
  font-weight: 500;
  text-decoration: none;
  transition: all 0.2s ease;
}

.tag-chip:hover {
  background: rgba(46, 252, 134, 0.15);
  color: #1ec770;
  transform: translateY(-2px);
}

/* Share Buttons */
.post-share {
  margin-top: 40px;
  padding-top: 40px;
  border-top: 2px solid #f3f4f6;
}

.post-share h3 {
  font-size: 18px;
  font-weight: 700;
  color: #2B234A;
  margin: 0 0 16px;
  font-family: 'Colour Brown', sans-serif;
}

.share-buttons {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}

.share-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: #f3f4f6;
  color: #4b5563;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
  text-decoration: none;
}

.share-btn svg {
  width: 20px;
  height: 20px;
}

.share-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.share-btn--twitter:hover {
  background: #1DA1F2;
  color: #fff;
}

.share-btn--linkedin:hover {
  background: #0A66C2;
  color: #fff;
}

.share-btn--facebook:hover {
  background: #1877F2;
  color: #fff;
}

.share-btn--copy:hover {
  background: #2efc86;
  color: #2B234A;
}

/* Related Posts */
.related-posts {
  background: #f9fafb;
  padding: 80px 20px;
}

.related-posts__inner {
  max-width: 1200px;
  margin: 0 auto;
}

.related-posts h2 {
  font-size: 36px;
  font-weight: 700;
  color: #2B234A;
  margin: 0 0 40px;
  text-align: center;
  font-family: 'Colour Brown', sans-serif;
}

.related-posts__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}

/* Blog Cards (reused from archive) */
.blog-card {
  background: #fff;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
}

.blog-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
}

.blog-card__image {
  width: 100%;
  height: 220px;
  object-fit: cover;
}

.blog-card__content {
  padding: 28px;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.blog-card__meta {
  display: flex;
  gap: 12px;
  align-items: center;
  margin-bottom: 16px;
  font-size: 13px;
  color: #4b5563;
}

.blog-card__category {
  display: inline-block;
  padding: 4px 12px;
  background: linear-gradient(135deg, rgba(46, 252, 134, 0.15) 0%, rgba(46, 252, 134, 0.08) 100%);
  color: #1ec770;
  border-radius: 12px;
  font-weight: 600;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.blog-card__date {
  display: flex;
  align-items: center;
  gap: 6px;
}

.blog-card__date svg {
  width: 14px;
  height: 14px;
  opacity: 0.6;
}

.blog-card h3 {
  font-size: 22px;
  font-weight: 700;
  color: #2B234A;
  margin: 0 0 12px;
  line-height: 1.3;
  font-family: 'Colour Brown', sans-serif;
}

.blog-card h3 a {
  color: #2B234A;
  text-decoration: none;
}

.blog-card h3 a:hover {
  color: #1ec770;
}

.blog-card__excerpt {
  font-size: 15px;
  line-height: 1.6;
  color: #4b5563;
  margin: 0 0 20px;
  flex: 1;
}

.blog-card__link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: #1ec770;
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  transition: gap 0.2s ease;
}

.blog-card__link:hover {
  gap: 12px;
}

.blog-card__link svg {
  width: 16px;
  height: 16px;
}

/* Responsive */
@media (max-width: 1024px) {
  .related-posts__grid {
    grid-template-columns: 1fr;
    gap: 24px;
  }
}

@media (max-width: 768px) {
  .post-hero {
    padding: calc(70px + 60px) 20px 60px;
  }

  .post-hero h1 {
    font-size: 32px;
  }

  .post-content {
    padding: 60px 20px;
  }

  .post-body {
    font-size: 17px;
  }

  .post-body h2 { font-size: 28px; }
  .post-body h3 { font-size: 24px; }

  .post-body blockquote {
    font-size: 18px;
    padding: 20px 24px;
  }

  .related-posts {
    padding: 60px 20px;
  }

  .related-posts h2 {
    font-size: 28px;
  }
}
</style>

<?php endwhile; ?>

<!-- Purple About Section -->
<section class="svm-purple-about">
  <div class="svm-purple-about-inner">
    <p>At S Ventures, we've spent the past two decades quietly acquiring premium digital real estate – the kind of domain names that define industries and ignite ideas. Our portfolio was born from our own ventures, spanning cutting-edge software and AI platforms to e-commerce brands, home services, finance, and beyond.</p>
    <p>Rather than let these powerful names collect dust, we're opening them up to the world. S Ventures offers our curated domain portfolio for sale or lease – even for equity or revenue-sharing partnerships with the right startups.</p>
  </div>
</section>

<?php get_footer(); ?>
