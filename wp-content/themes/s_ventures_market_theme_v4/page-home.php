<?php
/**
 * Template Name: Home Page
 * Description: Complete homepage redesign inspired by MediaOptions - Elementor Compatible
 */
get_header();
?>

<style>
/* Home Hero Section */
.home-hero {
  background: linear-gradient(135deg, #1a1d35 0%, #0a0e27 100%);
  padding: calc(62px + 100px) 20px 100px;
  position: relative;
  overflow: hidden;
}

.home-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 50%, rgba(0, 217, 255, 0.08) 0%, transparent 70%);
  pointer-events: none;
}

.home-hero__inner {
  max-width: 1200px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
  text-align: center;
}

.home-hero h1 {
  font-size: clamp(42px, 7vw, 68px);
  font-weight: 700;
  color: #fff;
  margin: 0 0 32px;
  line-height: 1.1;
  letter-spacing: -0.02em;
  font-family: 'Colour Brown', sans-serif;
}

.home-hero__intro {
  max-width: 900px;
  margin: 0 auto 48px;
  padding: 0 20px;
}

.home-hero__intro p {
  font-size: 19px;
  line-height: 1.7;
  color: rgba(255, 255, 255, 0.9);
  margin: 0 0 20px;
}

.home-hero__intro p:last-child {
  margin-bottom: 0;
}

.home-hero__tagline {
  font-size: clamp(24px, 4vw, 32px);
  font-weight: 600;
  color: #fff;
  margin: 48px 0 24px;
  font-family: 'Colour Brown', sans-serif;
}

.home-hero__tagline-sub {
  font-size: 18px;
  color: rgba(255, 255, 255, 0.85);
  margin: 0 0 40px;
}

.home-hero__cta {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 18px 42px;
  background: linear-gradient(135deg, #00d9ff 0%, #00b8d9 100%);
  color: #fff;
  border-radius: 50px;
  font-size: 18px;
  font-weight: 700;
  font-family: 'Colour Brown', sans-serif;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 8px 28px rgba(0, 217, 255, 0.35);
}

.home-hero__cta:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 36px rgba(0, 217, 255, 0.5);
}

.home-hero__cta svg {
  width: 20px;
  height: 20px;
}

/* Featured Domains Section */
.home-domains {
  background: #f9fafb;
  padding: 100px 20px;
}

.home-domains__inner {
  max-width: 1400px;
  margin: 0 auto;
}

.home-domains__header {
  text-align: center;
  margin-bottom: 60px;
}

.home-domains__header h2 {
  font-size: clamp(36px, 5vw, 48px);
  font-weight: 700;
  color: #1a1d35;
  margin: 0 0 16px;
  font-family: 'Colour Brown', sans-serif;
}

.home-domains__header p {
  font-size: 18px;
  color: #6b7280;
  margin: 0;
}

.home-domains__grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 28px;
  margin-bottom: 50px;
}

.home-domains__cta {
  text-align: center;
}

.home-domains__btn {
  display: inline-block;
  padding: 16px 40px;
  background: linear-gradient(135deg, #00d9ff 0%, #00b8d9 100%);
  color: #fff;
  border-radius: 50px;
  font-size: 17px;
  font-weight: 600;
  font-family: 'Colour Brown', sans-serif;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 4px 16px rgba(0, 217, 255, 0.3);
}

.home-domains__btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(0, 217, 255, 0.45);
}

/* Blog Section */
.home-blog {
  background: #fff;
  padding: 100px 20px;
}

.home-blog__inner {
  max-width: 1400px;
  margin: 0 auto;
}

.home-blog__header {
  text-align: center;
  margin-bottom: 60px;
}

.home-blog__header h2 {
  font-size: clamp(36px, 5vw, 48px);
  font-weight: 700;
  color: #1a1d35;
  margin: 0 0 16px;
  font-family: 'Colour Brown', sans-serif;
}

.home-blog__header p {
  font-size: 18px;
  color: #6b7280;
  margin: 0;
}

.home-blog__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
  margin-bottom: 50px;
}

.home-blog-card {
  background: #fff;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
}

.home-blog-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
}

.home-blog-card__image {
  width: 100%;
  height: 220px;
  object-fit: cover;
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);
}

.home-blog-card__content {
  padding: 28px;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.home-blog-card__meta {
  display: flex;
  gap: 12px;
  align-items: center;
  margin-bottom: 16px;
  font-size: 13px;
  color: #4b5563;
}

.home-blog-card__category {
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

.home-blog-card h3 {
  font-size: 20px;
  font-weight: 700;
  color: #2B234A;
  margin: 0 0 12px;
  line-height: 1.3;
  font-family: 'Colour Brown', sans-serif;
}

.home-blog-card h3 a {
  color: #2B234A;
  text-decoration: none;
}

.home-blog-card h3 a:hover {
  color: #1ec770;
}

.home-blog-card__excerpt {
  font-size: 15px;
  line-height: 1.6;
  color: #4b5563;
  margin: 0 0 20px;
  flex: 1;
}

.home-blog-card__link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: #1ec770;
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  transition: gap 0.2s ease;
}

.home-blog-card__link:hover {
  gap: 12px;
}

.home-blog-card__link svg {
  width: 16px;
  height: 16px;
}

.home-blog__cta {
  text-align: center;
}

.home-blog__btn {
  display: inline-block;
  padding: 16px 40px;
  background: #fff;
  color: #1a1d35;
  border: 2px solid #e5e7eb;
  border-radius: 50px;
  font-size: 17px;
  font-weight: 600;
  font-family: 'Colour Brown', sans-serif;
  text-decoration: none;
  transition: all 0.3s ease;
}

.home-blog__btn:hover {
  border-color: #00d9ff;
  background: rgba(0, 217, 255, 0.05);
  transform: translateY(-2px);
}

/* Elementor Content Section */
.home-elementor-content {
  background: #fff;
}

/* Responsive */
@media (max-width: 1024px) {
  .home-blog__grid {
    grid-template-columns: 1fr;
    gap: 24px;
  }
}

@media (max-width: 768px) {
  .home-hero {
    padding: calc(62px + 70px) 20px 70px;
  }
  
  .home-domains,
  .home-blog {
    padding: 70px 20px;
  }
  
  .home-domains__header,
  .home-blog__header {
    margin-bottom: 40px;
  }
}
</style>

<?php
// Check if page has Elementor content
$has_elementor = class_exists('\Elementor\Plugin') && \Elementor\Plugin::instance()->documents->get(get_the_ID())->is_built_with_elementor();

if ($has_elementor):
  // If built with Elementor, show only Elementor content
  while (have_posts()): the_post();
    ?>
    <div class="home-elementor-content">
      <?php the_content(); ?>
    </div>
    <?php
  endwhile;
else:
  // Show default custom homepage sections
  ?>
  <!-- Hero Section -->
  <section class="home-hero">
    <div class="home-hero__inner">
      <h1>The One-Stop Shop for Startup Ventures</h1>
      
      <div class="home-hero__intro">
        <p>S Ventures has been providing internet services for 20+ years, but we're not like your run-of-the-mill domain broker. We didn't hoard domain names from the '90s waiting for a pay-day. We're not holding domains with no intention to use, keeping others from building out their dream project. We acquired every one of our domains at a premium for our own projects, or ventures we have invested in over the years.</p>
        
        <p>Having been successful two decades building online brands, including a web design & digital marketing agency among our portfolio of 100+ active brands, Startup Ventures was born. Not only are we looking to buy premium domain names for future ventures and help broker domains for others, we are offering a portfolio of premium domains, our network of entrepreneurs and venture capital, and learned experiences, we have taken a new approach to domain brokering and sales.</p>
        
        <p>While we are happy to sell domain names at fair-market value and be on your way, our goal is to partner with you from the very beginning, the domain name, and provide you with options for creatively structured deals and a team of developers, designers and a suite of software and tools we are confident every startup needs should you be interested.</p>
      </div>
      
      <h2 class="home-hero__tagline">Your Next Venture Starts Here</h2>
      <p class="home-hero__tagline-sub">Explore our curated portfolio of premium domains</p>
      
      <a href="<?php echo get_post_type_archive_link('domains'); ?>" class="home-hero__cta">
        Browse Premium Domains
        <svg viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
      </a>
    </div>
  </section>

  <!-- Featured Domains Section - Top 24 by Price -->
  <section class="home-domains">
    <div class="home-domains__inner">
      <div class="home-domains__header">
        <h2>Featured Premium Domains</h2>
        <p>Hand-selected from our portfolio to give your brand an instant edge</p>
      </div>
      
      <div class="home-domains__grid">
        <?php
        // Get top 24 domains by highest price, randomized
        $featured_args = array(
          'post_type' => 'domains',
          'posts_per_page' => 24,
          'meta_key' => 'svm_price',
          'orderby' => 'meta_value_num',
          'order' => 'DESC',
          'meta_query' => array(
            'relation' => 'AND',
            array(
              'key' => 'svm_price',
              'value' => 0,
              'compare' => '>',
              'type' => 'NUMERIC'
            ),
            array(
              'relation' => 'OR',
              array('key' => 'svm_status', 'value' => 'sold', 'compare' => '!='),
              array('key' => 'svm_status', 'compare' => 'NOT EXISTS')
            )
          )
        );
        
        $featured_query = new WP_Query($featured_args);
        
        if ($featured_query->have_posts()):
          // Get all posts into array and shuffle
          $domain_posts = array();
          while ($featured_query->have_posts()) {
            $featured_query->the_post();
            $domain_posts[] = get_the_ID();
          }
          shuffle($domain_posts);
          
          // Display shuffled domains
          foreach ($domain_posts as $domain_id):
            echo svm_render_domain_card($domain_id);
          endforeach;
          
          wp_reset_postdata();
        else:
          echo '<p style="grid-column: 1/-1; text-align: center; color: #6b7280;">No featured domains available at this time.</p>';
        endif;
        ?>
      </div>
      
      <div class="home-domains__cta">
        <a href="<?php echo get_post_type_archive_link('domains'); ?>" class="home-domains__btn">View All Available Domains</a>
      </div>
    </div>
  </section>

  <!-- Featured Blog Posts Section -->
  <section class="home-blog">
    <div class="home-blog__inner">
      <div class="home-blog__header">
        <h2>Insights & Resources</h2>
        <p>Expert advice on domain investing and building successful ventures</p>
      </div>
      
      <div class="home-blog__grid">
        <?php
        $blog_args = array(
          'post_type' => 'post',
          'posts_per_page' => 3,
          'orderby' => 'date',
          'order' => 'DESC'
        );
        
        $blog_query = new WP_Query($blog_args);
        
        if ($blog_query->have_posts()):
          while ($blog_query->have_posts()): $blog_query->the_post();
            $categories = get_the_category();
            $primary_cat = !empty($categories) ? $categories[0] : null;
        ?>
          <article class="home-blog-card">
            <?php if (has_post_thumbnail()): ?>
              <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" alt="<?php the_title_attribute(); ?>" class="home-blog-card__image">
            <?php else: ?>
              <div class="home-blog-card__image"></div>
            <?php endif; ?>
            
            <div class="home-blog-card__content">
              <div class="home-blog-card__meta">
                <?php if ($primary_cat): ?>
                  <span class="home-blog-card__category"><?php echo esc_html($primary_cat->name); ?></span>
                <?php endif; ?>
                <span><?php echo get_the_date('M j, Y'); ?></span>
              </div>
              
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              
              <p class="home-blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
              
              <a href="<?php the_permalink(); ?>" class="home-blog-card__link">
                Read More
                <svg viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
              </a>
            </div>
          </article>
        <?php
          endwhile;
          wp_reset_postdata();
        else:
          echo '<p style="grid-column: 1/-1; text-align: center; color: #6b7280;">No blog posts available yet.</p>';
        endif;
        ?>
      </div>
      
      <?php if ($blog_query->post_count > 0): ?>
      <div class="home-blog__cta">
        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="home-blog__btn">View All Articles</a>
      </div>
      <?php endif; ?>
    </div>
  </section>
  <?php
endif; // End custom content
?>


<?php get_footer(); ?>