<?php
/**
 * Blog Archive Template
 * Shows list of all blog posts
 */
get_header();

// Get current category if on category page
$current_cat = (is_category()) ? get_queried_object() : null;
$paged = max(1, get_query_var('paged'));
?>

<main class="blog-archive">
  <!-- Hero Section -->
  <section class="blog-hero">
    <div class="blog-hero__inner">
      <?php if ($current_cat): ?>
        <h1><?php echo esc_html($current_cat->name); ?></h1>
        <?php if ($current_cat->description): ?>
          <p class="blog-hero__subtitle"><?php echo esc_html($current_cat->description); ?></p>
        <?php endif; ?>
      <?php else: ?>
        <h1>Insights & Resources</h1>
        <p class="blog-hero__subtitle">Expert advice on domain investing, startup branding, and building successful ventures from our 20+ years of experience.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- Blog Content -->
  <section class="blog-content">
    <div class="blog-content__inner">
      
      <!-- Category Filter -->
      <div class="blog-categories">
        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="category-chip <?php echo (!is_category()) ? 'active' : ''; ?>">All Posts</a>
        <?php
        $categories = get_categories(['hide_empty' => true]);
        foreach($categories as $cat):
          $is_active = ($current_cat && $current_cat->term_id === $cat->term_id) ? 'active' : '';
        ?>
          <a href="<?php echo get_category_link($cat->term_id); ?>" class="category-chip <?php echo $is_active; ?>">
            <?php echo esc_html($cat->name); ?>
          </a>
        <?php endforeach; ?>
      </div>
      
      <?php
      // Get posts
      $args = [
        'post_type' => 'post',
        'posts_per_page' => 9,
        'paged' => $paged,
      ];
      
      if ($current_cat) {
        $args['cat'] = $current_cat->term_id;
      }
      
      $blog_query = new WP_Query($args);
      
      if ($blog_query->have_posts()):
        $post_count = 0;
        
        // Featured Post (first post only on page 1)
        if ($paged === 1 && $blog_query->have_posts()):
          $blog_query->the_post();
          $post_count++;
          $categories = get_the_category();
          $primary_cat = !empty($categories) ? $categories[0] : null;
      ?>
      
      <!-- Featured Post -->
      <article class="featured-post">
        <?php if (has_post_thumbnail()): ?>
          <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title_attribute(); ?>" class="featured-post__image">
        <?php else: ?>
          <div class="featured-post__image" style="background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);"></div>
        <?php endif; ?>
        
        <div class="featured-post__content">
          <span class="featured-badge">
            <svg viewBox="0 0 20 20" fill="currentColor">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            Featured
          </span>
          
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          
          <div class="featured-post__meta">
            <?php if ($primary_cat): ?>
              <span class="blog-card__category"><?php echo esc_html($primary_cat->name); ?></span>
              <span>•</span>
            <?php endif; ?>
            <span><?php echo get_the_date('F j, Y'); ?></span>
            <span>•</span>
            <span><?php echo svm_reading_time(); ?> min read</span>
          </div>
          
          <p class="featured-post__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
          
          <a href="<?php the_permalink(); ?>" class="featured-post__link">
            Read Article
            <svg viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
          </a>
        </div>
      </article>
      
      <?php endif; ?>
      
      <!-- Blog Grid -->
      <div class="blog-grid">
        <?php
        while ($blog_query->have_posts()):
          $blog_query->the_post();
          $post_count++;
          $categories = get_the_category();
          $primary_cat = !empty($categories) ? $categories[0] : null;
        ?>
        
        <article class="blog-card">
          <?php if (has_post_thumbnail()): ?>
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" alt="<?php the_title_attribute(); ?>" class="blog-card__image">
          <?php else: ?>
            <div class="blog-card__image" style="background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);"></div>
          <?php endif; ?>
          
          <div class="blog-card__content">
            <div class="blog-card__meta">
              <?php if ($primary_cat): ?>
                <span class="blog-card__category"><?php echo esc_html($primary_cat->name); ?></span>
              <?php endif; ?>
              <span class="blog-card__date">
                <svg viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                <?php echo get_the_date('M j, Y'); ?>
              </span>
            </div>
            
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            
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
      <?php if ($blog_query->max_num_pages > 1): ?>
      <div class="blog-pagination">
        <?php
        echo paginate_links([
          'total' => $blog_query->max_num_pages,
          'current' => $paged,
          'prev_text' => '← Previous',
          'next_text' => 'Next →',
          'type' => 'list',
        ]);
        ?>
      </div>
      <?php endif; ?>
      
      <?php else: ?>
        <p style="text-align:center; padding:60px 20px; color:#666;">No posts found. Start writing!</p>
      <?php endif; wp_reset_postdata(); ?>
      
    </div>
  </section>

  <!-- Purple About Section -->
  <section class="svm-purple-about">
    <div class="svm-purple-about-inner">
      <p>At S Ventures, we've spent the past two decades quietly acquiring premium digital real estate – the kind of domain names that define industries and ignite ideas. Our portfolio was born from our own ventures, spanning cutting-edge software and AI platforms to e-commerce brands, home services, finance, and beyond. Along the way, we learned a truth every founder faces: not every idea takes off. Sometimes even the perfect brand name ends up on the shelf while the project behind it never quite gets wheels.</p>
      
      <p>Rather than let these powerful names collect dust, we're opening them up to the world. S Ventures offers our curated domain portfolio for sale or lease – even for equity or revenue-sharing partnerships with the right startups. In other words, we're giving other visionaries the chance to turn our unused brands into the next big thing. Why let a brilliant name sit idle when it could become someone's game-changing identity? If we're not using a domain for our own project, we'd love to see it bring your venture to life.</p>
    </div>
  </section>
</main>

<style>
/* Blog Archive Styles */
.blog-hero {
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);
  padding: 100px 20px 70px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.blog-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 50%, rgba(46, 252, 134, 0.05) 0%, transparent 70%);
  pointer-events: none;
}

.blog-hero__inner {
  max-width: 900px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.blog-hero h1 {
  font-size: 52px;
  font-weight: 700;
  color: #fff;
  margin: 0 0 20px;
  line-height: 1.1;
  letter-spacing: -0.02em;
  font-family: 'Colour Brown', sans-serif;
}

.blog-hero__subtitle {
  font-size: 20px;
  color: rgba(255, 255, 255, 0.9);
  margin: 0;
  line-height: 1.6;
}

.blog-content {
  padding: 70px 20px;
  background: #f9fafb;
}

.blog-content__inner {
  max-width: 1200px;
  margin: 0 auto;
}

/* Category Filter */
.blog-categories {
  display: flex;
  gap: 12px;
  justify-content: center;
  flex-wrap: wrap;
  margin-bottom: 50px;
}

.category-chip {
  padding: 10px 24px;
  border: 2px solid #e0e0e0;
  border-radius: 28px;
  background: #fff;
  color: #374151;
  font-weight: 500;
  font-size: 14px;
  text-decoration: none;
  transition: all 0.25s ease;
}

.category-chip:hover {
  border-color: #2efc86;
  background: rgba(46, 252, 134, 0.08);
  color: #2B234A;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.category-chip.active {
  background: linear-gradient(135deg, #2efc86 0%, #25d876 50%, #1ec770 100%);
  color: #2B234A;
  font-weight: 600;
  border-color: #2efc86;
  box-shadow: 0 4px 12px rgba(46, 252, 134, 0.3);
}

/* Featured Post */
.featured-post {
  background: #fff;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
  margin-bottom: 50px;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0;
}

.featured-post__image {
  width: 100%;
  height: 100%;
  min-height: 400px;
  object-fit: cover;
}

.featured-post__content {
  padding: 48px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.featured-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 14px;
  background: linear-gradient(135deg, #2efc86 0%, #25d876 100%);
  color: #2B234A;
  border-radius: 20px;
  font-weight: 700;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 20px;
  width: fit-content;
}

.featured-badge svg {
  width: 14px;
  height: 14px;
}

.featured-post h2 {
  font-size: 32px;
  font-weight: 700;
  color: #2B234A;
  margin: 0 0 16px;
  line-height: 1.2;
  font-family: 'Colour Brown', sans-serif;
}

.featured-post h2 a {
  color: #2B234A;
  text-decoration: none;
}

.featured-post h2 a:hover {
  color: #1ec770;
}

.featured-post__meta {
  display: flex;
  gap: 12px;
  align-items: center;
  margin-bottom: 20px;
  font-size: 14px;
  color: #4b5563;
}

.featured-post__excerpt {
  font-size: 17px;
  line-height: 1.7;
  color: #4b5563;
  margin: 0 0 28px;
}

.featured-post__link {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 14px 32px;
  background: linear-gradient(135deg, #2efc86 0%, #25d876 50%, #1ec770 100%);
  color: #2B234A;
  border-radius: 50px;
  font-size: 16px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 4px 16px rgba(46, 252, 134, 0.3);
  width: fit-content;
}

.featured-post__link:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(46, 252, 134, 0.45);
}

.featured-post__link svg {
  width: 18px;
  height: 18px;
}

/* Blog Grid */
.blog-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 32px;
}

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

.blog-card h2 {
  font-size: 22px;
  font-weight: 700;
  color: #2B234A;
  margin: 0 0 12px;
  line-height: 1.3;
  font-family: 'Colour Brown', sans-serif;
}

.blog-card h2 a {
  color: #2B234A;
  text-decoration: none;
}

.blog-card h2 a:hover {
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

/* Pagination */
.blog-pagination {
  margin-top: 60px;
}

.blog-pagination ul {
  display: flex;
  justify-content: center;
  gap: 8px;
  list-style: none;
  padding: 0;
  margin: 0;
}

.blog-pagination li {
  margin: 0;
}

.blog-pagination a,
.blog-pagination span {
  display: block;
  padding: 10px 18px;
  background: #fff;
  color: #2B234A;
  border: 2px solid #e0e0e0;
  border-radius: 10px;
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  transition: all 0.2s ease;
}

.blog-pagination a:hover {
  border-color: #2efc86;
  background: rgba(46, 252, 134, 0.08);
}

.blog-pagination .current {
  background: linear-gradient(135deg, #2efc86 0%, #25d876 100%);
  border-color: #2efc86;
  color: #2B234A;
}

/* Responsive */
@media (max-width: 1024px) {
  .blog-hero h1 { font-size: 42px; }
  .blog-grid { grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); }
  .featured-post { grid-template-columns: 1fr; }
  .featured-post__image { min-height: 300px; }
  .featured-post__content { padding: 36px; }
}

@media (max-width: 768px) {
  .blog-hero { padding: 70px 20px 50px; }
  .blog-hero h1 { font-size: 34px; }
  .blog-hero__subtitle { font-size: 17px; }
  .blog-content { padding: 50px 20px; }
  .blog-categories { margin-bottom: 40px; }
  .blog-grid { grid-template-columns: 1fr; gap: 24px; }
  .featured-post__content { padding: 28px; }
  .featured-post h2 { font-size: 26px; }
  .featured-post__excerpt { font-size: 16px; }
}
</style>

<?php get_footer(); ?>