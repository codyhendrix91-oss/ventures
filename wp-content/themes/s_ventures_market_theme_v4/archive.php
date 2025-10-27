<?php
/**
 * Blog Archive Template - Clean, Modern Design
 * Matches homepage aesthetic with card-based layout
 */
get_header();

$queried_object = get_queried_object();
$archive_title = '';
$archive_description = '';

if (is_category()) {
    $archive_title = single_cat_title('', false);
    $archive_description = category_description();
} elseif (is_tag()) {
    $archive_title = single_tag_title('', false);
    $archive_description = tag_description();
} elseif (is_author()) {
    $archive_title = get_the_author();
    $archive_description = get_the_author_meta('description');
} elseif (is_date()) {
    $archive_title = get_the_date('F Y');
} else {
    $archive_title = 'Blog';
    $archive_description = 'Expert insights on domain investing, branding, and building successful ventures';
}
?>

<style>
/* Blog Archive Styles - Matching Homepage Design */
.blog-archive {
  background: #f9fafb;
  min-height: 100vh;
}

.blog-archive__hero {
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);
  padding: calc(62px + 80px) 40px 80px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.blog-archive__hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 50%, rgba(0, 217, 255, 0.1) 0%, transparent 70%);
  pointer-events: none;
}

.blog-archive__hero-inner {
  max-width: 900px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.blog-archive__hero h1 {
  font-size: clamp(40px, 6vw, 56px);
  font-weight: 700;
  color: #fff;
  margin: 0 0 20px;
  font-family: 'Poppins', sans-serif;
  line-height: 1.1;
  letter-spacing: -0.02em;
}

.blog-archive__hero p {
  font-size: clamp(17px, 2.5vw, 19px);
  color: rgba(255, 255, 255, 0.9);
  margin: 0;
  line-height: 1.6;
}

.blog-archive__content {
  padding: 80px 40px;
  max-width: 1400px;
  margin: 0 auto;
}

.blog-archive__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
  margin-bottom: 60px;
}

/* Blog Card - Matching Homepage Design */
.blog-card {
  background: #fff;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  border: 1px solid #f3f4f6;
  text-decoration: none;
}

.blog-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
  border-color: rgba(43, 35, 74, 0.2);
}

.blog-card__image {
  width: 100%;
  height: 220px;
  object-fit: cover;
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);
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

.blog-card h2 {
  font-size: 20px;
  font-weight: 700;
  color: #2B234A;
  margin: 0 0 12px;
  line-height: 1.3;
  font-family: 'Poppins', sans-serif;
  letter-spacing: -0.01em;
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
  transition: gap 0.2s ease;
}

.blog-card:hover .blog-card__link {
  gap: 12px;
  color: #00d9ff;
}

.blog-card__link svg {
  width: 16px;
  height: 16px;
}

/* Pagination */
.blog-pagination {
  display: flex;
  justify-content: center;
  gap: 12px;
  margin-top: 60px;
}

.blog-pagination a,
.blog-pagination span {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 48px;
  height: 48px;
  padding: 0 16px;
  background: #fff;
  color: #1a1d35;
  border: 2px solid #e5e7eb;
  border-radius: 12px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.2s ease;
  font-family: 'Poppins', sans-serif;
}

.blog-pagination a:hover {
  border-color: #2B234A;
  background: rgba(43, 35, 74, 0.05);
  transform: translateY(-2px);
}

.blog-pagination .current {
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);
  color: #fff;
  border-color: #2B234A;
}

/* No Posts */
.blog-archive__empty {
  text-align: center;
  padding: 80px 20px;
  color: #6b7280;
}

.blog-archive__empty svg {
  width: 80px;
  height: 80px;
  margin: 0 auto 24px;
  color: #d1d5db;
}

.blog-archive__empty h2 {
  font-size: 28px;
  font-weight: 700;
  color: #1a1d35;
  margin: 0 0 12px;
  font-family: 'Poppins', sans-serif;
}

.blog-archive__empty p {
  font-size: 17px;
  color: #6b7280;
  margin: 0;
}

/* Responsive */
@media (max-width: 1024px) {
  .blog-archive__grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
  }
}

@media (max-width: 768px) {
  .blog-archive__hero {
    padding: calc(62px + 60px) 20px 60px;
  }

  .blog-archive__content {
    padding: 60px 20px;
  }

  .blog-archive__grid {
    grid-template-columns: 1fr;
  }
}
</style>

<!-- Hero Section -->
<section class="blog-archive">
  <div class="blog-archive__hero">
    <div class="blog-archive__hero-inner">
      <h1><?php echo esc_html($archive_title); ?></h1>
      <?php if ($archive_description): ?>
        <p><?php echo wp_kses_post($archive_description); ?></p>
      <?php endif; ?>
    </div>
  </div>

  <!-- Content -->
  <div class="blog-archive__content">
    <?php if (have_posts()): ?>
      <div class="blog-archive__grid">
        <?php while (have_posts()): the_post();
          $categories = get_the_category();
          $primary_cat = !empty($categories) ? $categories[0] : null;
        ?>
          <article class="blog-card">
            <?php if (has_post_thumbnail()): ?>
              <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>"
                   alt="<?php the_title_attribute(); ?>"
                   class="blog-card__image">
            <?php else: ?>
              <div class="blog-card__image"></div>
            <?php endif; ?>

            <div class="blog-card__content">
              <div class="blog-card__meta">
                <?php if ($primary_cat): ?>
                  <span class="blog-card__category"><?php echo esc_html($primary_cat->name); ?></span>
                <?php endif; ?>
                <span><?php echo get_the_date('M j, Y'); ?></span>
              </div>

              <h2><?php the_title(); ?></h2>

              <p class="blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>

              <a href="<?php the_permalink(); ?>" class="blog-card__link">
                Read More
                <svg viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
              </a>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

      <!-- Pagination -->
      <?php if (paginate_links()): ?>
        <nav class="blog-pagination">
          <?php echo paginate_links(array(
            'mid_size' => 2,
            'prev_text' => '← Prev',
            'next_text' => 'Next →',
          )); ?>
        </nav>
      <?php endif; ?>

    <?php else: ?>
      <div class="blog-archive__empty">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M9 12h6M9 16h6M12 3v18m0 0l-3-3m3 3l3-3"/>
        </svg>
        <h2>No Posts Found</h2>
        <p>Check back soon for new content!</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
