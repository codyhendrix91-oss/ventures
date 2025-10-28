<?php
/**
 * Single Blog Post Template - MediaOptions Style with Sidebar
 * Clean white background with 75-80% content width and sidebar
 */
get_header();

while (have_posts()): the_post();
  $categories = get_the_category();
  $primary_cat = !empty($categories) ? $categories[0] : null;
  $post_id = get_the_ID();
?>

<article class="blog-single">

  <!-- Main Container with White Background -->
  <div class="site-container">
    <div class="site-inner">

      <!-- Main Content Area (75-80% width) -->
      <main class="content-main">

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

        <!-- Title -->
        <h1 class="entry-title"><?php the_title(); ?></h1>

        <!-- Meta -->
        <div class="entry-meta">
          <?php if ($primary_cat): ?>
            <a href="<?php echo get_category_link($primary_cat->term_id); ?>" class="entry-category"><?php echo esc_html($primary_cat->name); ?></a>
          <?php endif; ?>
          <span class="entry-date">
            <svg viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
            </svg>
            <?php echo get_the_date('F j, Y'); ?>
          </span>
          <span class="entry-reading-time">
            <svg viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
            </svg>
            <?php echo svm_reading_time(); ?> min read
          </span>
        </div>

        <!-- Featured Image -->
        <?php if (has_post_thumbnail()): ?>
          <div class="entry-featured-image">
            <?php the_post_thumbnail('large', array('class' => 'entry-image')); ?>
          </div>
        <?php endif; ?>

        <!-- Post Content -->
        <?php
        // Check if Elementor is editing this post for content-specific styling
        $is_elementor = class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->db->is_built_with_elementor($post_id);
        ?>
        <div class="entry-content <?php echo $is_elementor ? 'has-elementor' : ''; ?>">
          <?php
          // Elementor will automatically handle its content when present
          the_content();
          ?>
        </div>

        <!-- Tags -->
        <?php if (has_tag()): ?>
        <div class="entry-tags">
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

      </main>

      <!-- Sidebar (20-25% width) -->
      <aside class="content-sidebar">

        <!-- Newsletter Signup Form -->
        <div class="sidebar-widget sidebar-newsletter" id="sidebar-newsletter-widget">
          <h3 class="widget-title">Subscribe to Our Newsletter</h3>
          <p class="widget-description">Get the latest insights on domain strategies and tech startup trends delivered to your inbox.</p>

          <?php if (function_exists('svm_newsletter_form')): ?>
            <?php echo svm_newsletter_form(true); ?>
          <?php else: ?>
            <!-- Fallback Newsletter Form -->
            <form class="newsletter-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
              <input type="hidden" name="action" value="svm_newsletter_signup">
              <input type="email" name="email" placeholder="Enter your email" required class="newsletter-input">
              <button type="submit" class="newsletter-button">Subscribe</button>
            </form>
          <?php endif; ?>
        </div>

        <!-- Recent Posts Widget -->
        <div class="sidebar-widget sidebar-recent-posts">
          <h3 class="widget-title">Recent Posts</h3>
          <?php
          $recent_posts = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 5,
            'post__not_in' => array($post_id),
          ));

          if ($recent_posts->have_posts()):
          ?>
          <ul class="recent-posts-list">
            <?php while ($recent_posts->have_posts()): $recent_posts->the_post(); ?>
              <li>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <span class="recent-post-date"><?php echo get_the_date('M j, Y'); ?></span>
              </li>
            <?php endwhile; wp_reset_postdata(); ?>
          </ul>
          <?php endif; ?>
        </div>

        <!-- Categories Widget -->
        <?php
        $post_categories = get_categories(array('hide_empty' => true));
        if (!empty($post_categories)):
        ?>
        <div class="sidebar-widget sidebar-categories">
          <h3 class="widget-title">Categories</h3>
          <ul class="categories-list">
            <?php foreach($post_categories as $category): ?>
              <li>
                <a href="<?php echo get_category_link($category->term_id); ?>">
                  <?php echo esc_html($category->name); ?>
                  <span class="category-count">(<?php echo $category->count; ?>)</span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

      </aside>

    </div>
  </div>

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
/* Blog Post Styles - MediaOptions Inspired with Sidebar */

/* Global Blog Container */
.blog-single {
  background: #ffffff;
  min-height: 100vh;
}

/* Site Container - MediaOptions Structure */
.site-container {
  background: #ffffff;
  padding: calc(var(--header-height) + 40px) 0 80px;
  min-height: calc(100vh - 400px);
}

.site-inner {
  max-width: 1200px;
  width: 100%;
  margin: 0 auto;
  padding: 0 20px;
  display: grid;
  grid-template-columns: 1fr 320px;
  gap: 60px;
  align-items: start;
}

/* Main Content Area - Takes 75-80% width */
.content-main {
  width: 100%;
  max-width: 100%;
}

/* Breadcrumbs */
.breadcrumbs {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 24px;
  font-size: 14px;
  color: #6b7280;
}

.breadcrumbs a {
  color: #374151;
  text-decoration: none;
  transition: color 0.2s ease;
}

.breadcrumbs a:hover {
  color: #2B234A;
}

.breadcrumbs span {
  color: #9ca3af;
}

/* Title */
.entry-title {
  font-size: clamp(32px, 5vw, 48px);
  font-weight: 700;
  color: #1a1d35;
  margin: 0 0 20px;
  line-height: 1.2;
  letter-spacing: -0.02em;
  font-family: 'Poppins', sans-serif;
}

/* Entry Meta */
.entry-meta {
  display: flex;
  align-items: center;
  gap: 16px;
  flex-wrap: wrap;
  margin-bottom: 32px;
  padding-bottom: 24px;
  border-bottom: 2px solid #f3f4f6;
  font-size: 14px;
  color: #6b7280;
}

.entry-category {
  display: inline-block;
  padding: 4px 14px;
  background: linear-gradient(135deg, rgba(43, 35, 74, 0.1) 0%, rgba(43, 35, 74, 0.05) 100%);
  color: #2B234A;
  border-radius: 12px;
  font-weight: 600;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  text-decoration: none;
  transition: all 0.2s ease;
}

.entry-category:hover {
  background: linear-gradient(135deg, rgba(43, 35, 74, 0.2) 0%, rgba(43, 35, 74, 0.1) 100%);
}

.entry-date,
.entry-reading-time {
  display: flex;
  align-items: center;
  gap: 6px;
}

.entry-meta svg {
  width: 16px;
  height: 16px;
  opacity: 0.6;
}

/* Featured Image - Full Width for All Posts (Uniform Display) */
.entry-featured-image {
  float: none;
  width: 100%;
  max-width: 100%;
  margin: 0 0 32px 0;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.entry-image {
  width: 100%;
  height: auto;
  display: block;
  object-fit: contain;
}

/* Entry Content - Typography */
.entry-content {
  font-size: 18px;
  line-height: 1.625;
  color: #1a1d35;
  font-family: Inter, sans-serif;
}

/* Elementor Content Fixes - Clear float and proper alignment */
.entry-content.has-elementor {
  clear: both;
}

.entry-content .elementor,
.entry-content .elementor-section-wrap,
.entry-content .elementor-element {
  clear: both;
  width: 100%;
}

/* Ensure Elementor sections don't inherit any problematic float behavior */
.entry-content.has-elementor > .elementor-section,
.entry-content.has-elementor > .elementor-element-populated {
  float: none !important;
  clear: both;
}

/* Reset Elementor container widths to full width */
.entry-content .elementor-section,
.entry-content .elementor-container {
  max-width: 100%;
}

/* Ensure Elementor inner sections respect the content area */
.entry-content .elementor-inner-section .elementor-container {
  max-width: 100%;
}

.entry-content h1,
.entry-content h2,
.entry-content h3,
.entry-content h4,
.entry-content h5,
.entry-content h6 {
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  color: #1a1d35;
  margin: 40px 0 20px;
  line-height: 1.3;
  letter-spacing: -0.02em;
}

.entry-content h1 { font-size: 42px; }
.entry-content h2 { font-size: 36px; }
.entry-content h3 { font-size: 28px; }
.entry-content h4 { font-size: 24px; }
.entry-content h5 { font-size: 20px; }
.entry-content h6 { font-size: 18px; }

.entry-content h2:first-child,
.entry-content h3:first-child,
.entry-content h4:first-child {
  margin-top: 0;
}

.entry-content p {
  margin: 0 0 24px;
}

.entry-content p:last-child {
  margin-bottom: 0;
}

.entry-content a {
  color: #00d9ff;
  text-decoration: underline;
  text-decoration-thickness: 2px;
  text-underline-offset: 3px;
  transition: all 0.2s ease;
}

.entry-content a:hover {
  color: #2B234A;
}

.entry-content strong {
  font-weight: 700;
  color: #1a1d35;
}

.entry-content ul,
.entry-content ol {
  margin: 24px 0;
  padding-left: 28px;
}

.entry-content li {
  margin: 12px 0;
  line-height: 1.7;
}

.entry-content blockquote {
  margin: 40px 0;
  padding: 24px 32px;
  border-left: 4px solid #00d9ff;
  background: linear-gradient(135deg, rgba(0, 217, 255, 0.05) 0%, rgba(0, 217, 255, 0.02) 100%);
  border-radius: 0 12px 12px 0;
  font-size: 21px;
  font-style: italic;
  color: #4b5563;
}

.entry-content img {
  max-width: 100%;
  height: auto;
  border-radius: 12px;
  margin: 32px 0;
}

.entry-content code {
  padding: 3px 8px;
  background: #f3f4f6;
  border-radius: 4px;
  font-family: 'Monaco', 'Courier New', monospace;
  font-size: 0.9em;
  color: #e11d48;
}

.entry-content pre {
  background: #1a1d35;
  color: #e5e7eb;
  padding: 24px;
  border-radius: 12px;
  overflow-x: auto;
  margin: 32px 0;
}

.entry-content pre code {
  background: none;
  padding: 0;
  color: #e5e7eb;
  font-size: 14px;
  line-height: 1.6;
}

/* CTA Sections - S.Ventures Branded Gradient */
.entry-content p.rs-content-cta {
  font-family: Inter, sans-serif;
  font-size: 28px;
  font-weight: 600;
  line-height: 1.4;
  color: #ffffff !important;
  background: linear-gradient(135deg, #00d9ff 0%, #2efc86 100%);
  padding: 32px 40px;
  margin: 40px 0;
  border-radius: 12px;
  text-align: center !important;
  clear: both;
  box-shadow: 0 8px 24px rgba(0, 217, 255, 0.25);
  transition: all 0.3s ease;
}

.entry-content p.rs-content-cta:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 32px rgba(0, 217, 255, 0.35);
}

.entry-content p.rs-content-cta-small {
  font-size: 22px;
  padding: 24px 32px;
}

.entry-content p.rs-content-cta a {
  color: #ffffff !important;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.2s ease;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.entry-content p.rs-content-cta a:hover {
  color: #ffffff !important;
  text-decoration: underline;
  text-underline-offset: 4px;
  text-decoration-thickness: 2px;
}

/* Tags */
.entry-tags {
  margin-top: 60px;
  padding-top: 40px;
  border-top: 2px solid #f3f4f6;
}

.entry-tags h3 {
  font-size: 18px;
  font-weight: 700;
  color: #2B234A;
  margin: 0 0 16px;
  font-family: 'Poppins', sans-serif;
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
  background: rgba(0, 217, 255, 0.15);
  color: #00d9ff;
  transform: translateY(-2px);
}

/* Sidebar - 20-25% width */
.content-sidebar {
  width: 100%;
  position: sticky;
  top: calc(var(--header-height) + 20px);
}

/* Sidebar Widgets */
.sidebar-widget {
  background: #ffffff;
  border: 2px solid #f3f4f6;
  border-radius: 12px;
  padding: 24px;
  margin-bottom: 24px;
  width: 100%;
  max-width: 100%;
  box-sizing: border-box;
  overflow: hidden;
}

.sidebar-widget:last-child {
  margin-bottom: 0;
}

.widget-title {
  font-size: 18px;
  font-weight: 700;
  color: #2B234A;
  margin: 0 0 12px;
  font-family: 'Poppins', sans-serif;
  text-align: left;
  line-height: 1.4;
}

.widget-description {
  font-size: 14px;
  line-height: 1.6;
  color: #6b7280;
  margin: 0 0 20px;
  text-align: left;
  font-family: 'Poppins', sans-serif;
}

/* Newsletter Form in Sidebar */
.sidebar-newsletter .newsletter-form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  width: 100%;
}

.sidebar-newsletter .newsletter-input {
  width: 100%;
  max-width: 100%;
  padding: 11px 14px;
  border: 2px solid #e5e7eb;
  border-radius: 8px;
  font-size: 14px;
  font-family: 'Poppins', sans-serif;
  transition: all 0.2s ease;
  box-sizing: border-box;
}

.sidebar-newsletter .newsletter-input:focus {
  outline: none;
  border-color: #2B234A;
  box-shadow: 0 0 0 3px rgba(43, 35, 74, 0.1);
}

.sidebar-newsletter .newsletter-button {
  width: 100%;
  max-width: 100%;
  padding: 11px 20px;
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);
  color: #ffffff;
  border: none;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  font-family: 'Poppins', sans-serif;
  cursor: pointer;
  transition: all 0.3s ease;
  box-sizing: border-box;
}

.sidebar-newsletter .newsletter-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(43, 35, 74, 0.3);
}

/* Override existing newsletter styles for sidebar - MAXIMUM SPECIFICITY FIX */
/* Using ID and multiple class selectors for highest specificity */
#sidebar-newsletter-widget .svm-newsletter,
.content-sidebar #sidebar-newsletter-widget .svm-newsletter,
aside.content-sidebar #sidebar-newsletter-widget .svm-newsletter {
  background: transparent !important;
  border: none !important;
  padding: 0 !important;
  margin: 0 !important;
  width: 100% !important;
  max-width: 100% !important;
  box-sizing: border-box !important;
  overflow: visible !important;
}

/* Fix inner container widths for narrow sidebar */
#sidebar-newsletter-widget .svm-newsletter__inner,
.content-sidebar #sidebar-newsletter-widget .svm-newsletter__inner,
aside.content-sidebar #sidebar-newsletter-widget .svm-newsletter__inner {
  max-width: 100% !important;
  width: 100% !important;
  box-sizing: border-box !important;
  margin: 0 !important;
  padding: 0 !important;
}

/* CRITICAL: Hide the duplicate newsletter text from the function completely */
/* The widget already has "Subscribe to Our Newsletter" title and description */
#sidebar-newsletter-widget .svm-newsletter__content,
.sidebar-newsletter .svm-newsletter__content,
.content-sidebar #sidebar-newsletter-widget .svm-newsletter__content,
.content-sidebar .sidebar-newsletter .svm-newsletter__content,
aside.content-sidebar #sidebar-newsletter-widget .svm-newsletter__content,
aside.content-sidebar .sidebar-newsletter .svm-newsletter__content,
#sidebar-newsletter-widget .svm-newsletter__content p,
.sidebar-newsletter .svm-newsletter__content p,
#sidebar-newsletter-widget .svm-newsletter__text,
.sidebar-newsletter .svm-newsletter__text,
.content-sidebar #sidebar-newsletter-widget .svm-newsletter__text,
aside.content-sidebar #sidebar-newsletter-widget .svm-newsletter__text {
  display: none !important;
  visibility: hidden !important;
  height: 0 !important;
  width: 0 !important;
  overflow: hidden !important;
  margin: 0 !important;
  padding: 0 !important;
  position: absolute !important;
  left: -9999px !important;
  opacity: 0 !important;
}

#sidebar-newsletter-widget .svm-newsletter__form-wrapper,
.content-sidebar #sidebar-newsletter-widget .svm-newsletter__form-wrapper,
aside.content-sidebar #sidebar-newsletter-widget .svm-newsletter__form-wrapper {
  max-width: 100% !important;
  width: 100% !important;
  box-sizing: border-box !important;
  margin: 0 !important;
  padding: 0 !important;
}

/* Ensure form itself is full width */
#sidebar-newsletter-widget .svm-newsletter__form,
.content-sidebar #sidebar-newsletter-widget .svm-newsletter__form,
aside.content-sidebar #sidebar-newsletter-widget .svm-newsletter__form {
  width: 100% !important;
  max-width: 100% !important;
  box-sizing: border-box !important;
  display: block !important;
}

/* Change input group to vertical layout for narrow sidebar */
#sidebar-newsletter-widget .svm-newsletter__input-group,
.content-sidebar #sidebar-newsletter-widget .svm-newsletter__input-group,
aside.content-sidebar #sidebar-newsletter-widget .svm-newsletter__input-group {
  display: flex !important;
  flex-direction: column !important;
  gap: 12px !important;
  padding: 0 !important;
  border: none !important;
  background: transparent !important;
  width: 100% !important;
  max-width: 100% !important;
  box-sizing: border-box !important;
  align-items: stretch !important;
  position: relative !important;
}

/* Email Input Field - Full Width and Visible */
#sidebar-newsletter-widget .svm-newsletter__input,
.content-sidebar #sidebar-newsletter-widget .svm-newsletter__input,
aside.content-sidebar #sidebar-newsletter-widget .svm-newsletter__input {
  width: 100% !important;
  max-width: 100% !important;
  min-width: 0 !important;
  flex: 0 0 auto !important;
  padding: 12px 14px !important;
  font-size: 14px !important;
  line-height: 1.5 !important;
  margin: 0 !important;
  box-sizing: border-box !important;
  border: 2px solid #e5e7eb !important;
  border-radius: 8px !important;
  background: #ffffff !important;
  color: #1a1d35 !important;
  font-family: 'Poppins', sans-serif !important;
  order: 1 !important;
  position: relative !important;
  z-index: 1 !important;
}

#sidebar-newsletter-widget .svm-newsletter__input:focus,
.content-sidebar #sidebar-newsletter-widget .svm-newsletter__input:focus,
aside.content-sidebar #sidebar-newsletter-widget .svm-newsletter__input:focus {
  border-color: #2B234A !important;
  outline: none !important;
  box-shadow: 0 0 0 3px rgba(43, 35, 74, 0.1) !important;
}

/* Submit Button - Below Input Field, Full Width */
#sidebar-newsletter-widget .svm-newsletter__button,
.content-sidebar #sidebar-newsletter-widget .svm-newsletter__button,
aside.content-sidebar #sidebar-newsletter-widget .svm-newsletter__button {
  width: 100% !important;
  max-width: 100% !important;
  min-width: 0 !important;
  flex: 0 0 auto !important;
  padding: 12px 20px !important;
  font-size: 14px !important;
  font-weight: 600 !important;
  line-height: 1.5 !important;
  box-sizing: border-box !important;
  justify-content: center !important;
  display: flex !important;
  align-items: center !important;
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%) !important;
  color: #ffffff !important;
  border: none !important;
  border-radius: 8px !important;
  cursor: pointer !important;
  font-family: 'Poppins', sans-serif !important;
  white-space: normal !important;
  order: 2 !important;
  position: relative !important;
  z-index: 1 !important;
  margin: 0 !important;
  gap: 8px !important;
  transition: all 0.3s ease !important;
}

#sidebar-newsletter-widget .svm-newsletter__button:hover,
.content-sidebar #sidebar-newsletter-widget .svm-newsletter__button:hover,
aside.content-sidebar #sidebar-newsletter-widget .svm-newsletter__button:hover {
  transform: translateY(-2px) !important;
  box-shadow: 0 4px 12px rgba(43, 35, 74, 0.3) !important;
}

/* Fix any icon/span elements in the button */
#sidebar-newsletter-widget .svm-newsletter__button .button-text,
#sidebar-newsletter-widget .svm-newsletter__button .button-icon,
.content-sidebar #sidebar-newsletter-widget .svm-newsletter__button .button-text,
.content-sidebar #sidebar-newsletter-widget .svm-newsletter__button .button-icon,
aside.content-sidebar #sidebar-newsletter-widget .svm-newsletter__button .button-text,
aside.content-sidebar #sidebar-newsletter-widget .svm-newsletter__button .button-icon {
  display: inline-flex !important;
  flex-shrink: 0 !important;
}

/* Success/Error message styling */
#sidebar-newsletter-widget .svm-newsletter__message,
.content-sidebar #sidebar-newsletter-widget .svm-newsletter__message,
aside.content-sidebar #sidebar-newsletter-widget .svm-newsletter__message {
  width: 100% !important;
  box-sizing: border-box !important;
  margin-top: 12px !important;
  padding: 12px !important;
  border-radius: 6px !important;
  font-size: 13px !important;
  order: 3 !important;
}

/* Recent Posts List */
.recent-posts-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.recent-posts-list li {
  padding: 12px 0;
  border-bottom: 1px solid #f3f4f6;
}

.recent-posts-list li:last-child {
  border-bottom: none;
  padding-bottom: 0;
}

.recent-posts-list li:first-child {
  padding-top: 0;
}

.recent-posts-list a {
  font-size: 14px;
  font-weight: 500;
  color: #374151;
  text-decoration: none;
  line-height: 1.5;
  display: block;
  margin-bottom: 4px;
  transition: color 0.2s ease;
}

.recent-posts-list a:hover {
  color: #2B234A;
}

.recent-post-date {
  font-size: 12px;
  color: #9ca3af;
}

/* Categories List */
.categories-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.categories-list li {
  padding: 10px 0;
  border-bottom: 1px solid #f3f4f6;
}

.categories-list li:last-child {
  border-bottom: none;
  padding-bottom: 0;
}

.categories-list li:first-child {
  padding-top: 0;
}

.categories-list a {
  font-size: 14px;
  font-weight: 500;
  color: #374151;
  text-decoration: none;
  display: flex;
  justify-content: space-between;
  align-items: center;
  transition: color 0.2s ease;
}

.categories-list a:hover {
  color: #2B234A;
}

.category-count {
  font-size: 12px;
  color: #9ca3af;
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
  font-family: 'Poppins', sans-serif;
  letter-spacing: -0.02em;
}

.related-posts__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}

/* Blog Cards */
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
  object-fit: contain;
  background: #f9fafb;
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
  background: linear-gradient(135deg, rgba(43, 35, 74, 0.1) 0%, rgba(43, 35, 74, 0.05) 100%);
  color: #2B234A;
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
  font-family: 'Poppins', sans-serif;
  letter-spacing: -0.01em;
}

.blog-card h3 a {
  color: #2B234A;
  text-decoration: none;
}

.blog-card h3 a:hover {
  color: #00d9ff;
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
  color: #2B234A;
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  transition: gap 0.2s ease, color 0.2s ease;
}

.blog-card__link:hover {
  gap: 12px;
  color: #00d9ff;
}

.blog-card__link svg {
  width: 16px;
  height: 16px;
}

/* Responsive */
@media (max-width: 992px) {
  .site-inner {
    grid-template-columns: 1fr;
    gap: 40px;
  }

  .content-sidebar {
    position: static;
    max-height: none;
  }
}

@media (max-width: 768px) {
  .site-container {
    padding: calc(var(--header-height) + 20px) 0 60px;
  }

  .site-inner {
    padding: 0 16px;
  }

  .entry-title {
    font-size: 32px;
  }

  .entry-content {
    font-size: 17px;
  }

  .entry-content h2 { font-size: 28px; }
  .entry-content h3 { font-size: 24px; }

  .related-posts {
    padding: 60px 20px;
  }

  .related-posts h2 {
    font-size: 28px;
  }

  .related-posts__grid {
    grid-template-columns: 1fr;
    gap: 24px;
  }
}
</style>

<?php endwhile; ?>

<?php get_footer(); ?>
