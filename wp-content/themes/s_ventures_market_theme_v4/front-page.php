<?php
/**
 * Front Page Template - COMPLETELY REDESIGNED
 * Clean white hero, short text, modern spacing
 */
get_header();
?>

<style>
/* REDESIGNED HERO - CLEAN WHITE WITH PURPLE ACCENTS */
.home-hero-redesigned {
  background: #ffffff;
  padding: calc(62px + 70px) 40px 80px;
  position: relative;
  overflow: hidden;
}

.home-hero-redesigned::before {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  width: 50%;
  height: 100%;
  background: linear-gradient(135deg, rgba(43, 35, 74, 0.03) 0%, rgba(0, 217, 255, 0.02) 100%);
  border-radius: 0 0 0 100%;
  pointer-events: none;
}

.home-hero__inner-redesigned {
  max-width: 1200px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.home-hero__content-redesigned {
  max-width: 700px;
  text-align: left;
}

.home-hero-redesigned h1 {
  font-size: clamp(44px, 6vw, 68px);
  font-weight: 700;
  color: #1a1d35;
  margin: 0 0 32px;
  line-height: 1.1;
  letter-spacing: -0.02em;
  font-family: 'Poppins', sans-serif;
}

.home-hero-redesigned h1 .gradient-text {
  background: linear-gradient(135deg, #2B234A 0%, #00d9ff 50%, #2efc86 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.home-hero__intro-redesigned {
  margin: 0 0 40px;
}

.home-hero__intro-redesigned p {
  font-size: 16px;
  line-height: 1.2;
  color: #4b5563;
  margin: 0 0 20px;
}

.home-hero__intro-redesigned p:last-child {
  margin-bottom: 0;
}

.home-hero__stats-redesigned {
  display: flex;
  gap: 40px;
  margin: 48px 0;
  flex-wrap: wrap;
}

.home-stat-redesigned {
  display: flex;
  flex-direction: column;
}

.home-stat-number {
  font-size: 48px;
  font-weight: 700;
  color: #2B234A;
  line-height: 1;
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #2B234A 0%, #00d9ff 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.home-stat-label {
  font-size: 14px;
  color: #6b7280;
  font-weight: 500;
  margin-top: 8px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.home-hero__cta-wrapper {
  display: flex;
  align-items: center;
  gap: 0;
  margin: 0;
}

.home-hero__cta-redesigned {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 14px 36px;
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);
  color: #fff;
  border-radius: 50px;
  font-size: 17px;
  font-weight: 600;
  font-family: 'Poppins', sans-serif;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 8px 28px rgba(43, 35, 74, 0.25);
}

.home-hero__cta-redesigned:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 36px rgba(43, 35, 74, 0.35);
  background: linear-gradient(135deg, #3d3158 0%, #2B234A 100%);
}

.home-hero__cta-redesigned svg {
  width: 20px;
  height: 20px;
}

/* Featured Domains Section */
.home-domains-redesigned {
  background: #f9fafb;
  padding: 100px 40px;
}

.home-domains__inner-redesigned {
  max-width: 1400px;
  margin: 0 auto;
}

.home-domains__header-redesigned {
  text-align: center;
  margin-bottom: 60px;
}

.home-domains__header-redesigned h2 {
  font-size: clamp(36px, 5vw, 48px);
  font-weight: 700;
  color: #1a1d35;
  margin: 0 0 16px;
  font-family: 'Poppins', sans-serif;
  letter-spacing: -0.02em;
}

.home-domains__header-redesigned p {
  font-size: 18px;
  color: #6b7280;
  margin: 0;
}

.home-domains__grid-redesigned {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 28px;
  margin-bottom: 50px;
}

@media (max-width: 1200px) {
  .home-domains__grid-redesigned {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 900px) {
  .home-domains__grid-redesigned {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 600px) {
  .home-domains__grid-redesigned {
    grid-template-columns: 1fr;
  }
}

.home-domains__cta-redesigned {
  text-align: center;
}

.home-domains__btn-redesigned {
  display: inline-block;
  padding: 16px 40px;
  background: #fff;
  color: #1a1d35;
  border: 2px solid #e5e7eb;
  border-radius: 50px;
  font-size: 17px;
  font-weight: 600;
  font-family: 'Poppins', sans-serif;
  text-decoration: none;
  transition: all 0.3s ease;
}

.home-domains__btn-redesigned:hover {
  border-color: #2B234A;
  background: rgba(43, 35, 74, 0.05);
  transform: translateY(-2px);
}

/* Blog Section */
.home-blog-redesigned {
  background: #fff;
  padding: 100px 40px;
}

.home-blog__inner-redesigned {
  max-width: 1400px;
  margin: 0 auto;
}

.home-blog__header-redesigned {
  text-align: center;
  margin-bottom: 60px;
}

.home-blog__header-redesigned h2 {
  font-size: clamp(36px, 5vw, 48px);
  font-weight: 700;
  color: #1a1d35;
  margin: 0 0 16px;
  font-family: 'Poppins', sans-serif;
  letter-spacing: -0.02em;
}

.home-blog__header-redesigned p {
  font-size: 18px;
  color: #6b7280;
  margin: 0;
}

.home-blog__grid-redesigned {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
  margin-bottom: 50px;
}

.home-blog-card-redesigned {
  background: #fff;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  border: 1px solid #f3f4f6;
}

.home-blog-card-redesigned:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
  border-color: rgba(43, 35, 74, 0.2);
}

.home-blog-card__image-redesigned {
  width: 100%;
  height: auto;
  min-height: 220px;
  aspect-ratio: 16/9;
  object-fit: contain;
  background: #f9fafb;
  display: block;
}

.home-blog-card__content-redesigned {
  padding: 28px;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.home-blog-card__meta-redesigned {
  display: flex;
  gap: 12px;
  align-items: center;
  margin-bottom: 16px;
  font-size: 13px;
  color: #4b5563;
}

.home-blog-card__category-redesigned {
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

.home-blog-card-redesigned h3 {
  font-size: 20px;
  font-weight: 700;
  color: #2B234A;
  margin: 0 0 12px;
  line-height: 1.3;
  font-family: 'Poppins', sans-serif;
  letter-spacing: -0.01em;
}

.home-blog-card-redesigned h3 a {
  color: #2B234A;
  text-decoration: none;
}

.home-blog-card-redesigned h3 a:hover {
  color: #00d9ff;
}

.home-blog-card__excerpt-redesigned {
  font-size: 15px;
  line-height: 1.6;
  color: #4b5563;
  margin: 0 0 20px;
  flex: 1;
}

.home-blog-card__link-redesigned {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: #2B234A;
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  transition: gap 0.2s ease;
}

.home-blog-card__link-redesigned:hover {
  gap: 12px;
  color: #00d9ff;
}

.home-blog-card__link-redesigned svg {
  width: 16px;
  height: 16px;
}

.home-blog__cta-redesigned {
  text-align: center;
}

.home-blog__btn-redesigned {
  display: inline-block;
  padding: 16px 40px;
  background: #fff;
  color: #1a1d35;
  border: 2px solid #e5e7eb;
  border-radius: 50px;
  font-size: 17px;
  font-weight: 600;
  font-family: 'Poppins', sans-serif;
  text-decoration: none;
  transition: all 0.3s ease;
}

.home-blog__btn-redesigned:hover {
  border-color: #2B234A;
  background: rgba(43, 35, 74, 0.05);
  transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 1024px) {
  .home-blog__grid-redesigned {
    grid-template-columns: 1fr;
    gap: 24px;
  }
  
  .home-hero__stats-redesigned {
    gap: 30px;
  }
}

@media (max-width: 768px) {
  .home-hero-redesigned {
    padding: calc(62px + 50px) 20px 70px;
  }
  
  .home-hero__content-redesigned {
    max-width: 100%;
  }
  
  .home-hero__intro-redesigned p {
    font-size: 16px;
    line-height: 1.2;
  }
  
  .home-hero__stats-redesigned {
    gap: 24px;
  }
  
  .home-stat-number {
    font-size: 38px;
  }
  
  .home-domains-redesigned,
  .home-blog-redesigned {
    padding: 70px 20px;
  }
  
  .home-domains__header-redesigned,
  .home-blog__header-redesigned {
    margin-bottom: 40px;
  }
}
</style>

<!-- REDESIGNED HERO - Clean White with Purple Accents -->
<section class="home-hero-redesigned">
  <div class="home-hero__inner-redesigned">
    <div class="home-hero__content-redesigned">
      <h1>
        <span class="gradient-text">The All-in-One Startup Launchpad</span>
      </h1>

      <div class="home-hero__intro-redesigned">
        <p>The passion project of entrepreneurs who've spent their careers turning domain names into real business opportunities, S Ventures brings together 20 years of startup experience, venture capital insight, and brand strategy under one platform. Our collection represents the same premium digital assets that have launched and scaled more than 100 active ventures across industries today.</p>

        <p>Now, we use that experience to buy, sell, and help startups and investors secure domain names that define their vision—while providing access to the proven strategies, insights, and tools that make it real and continue to power our own success. S Ventures is the crossroads where a domain name ends and a digital brand begins.</p>
      </div>
      
      <!-- Stats -->
      <div class="home-hero__stats-redesigned">
        <div class="home-stat-redesigned">
          <div class="home-stat-number">20+</div>
          <div class="home-stat-label">Years Experience</div>
        </div>
        <div class="home-stat-redesigned">
          <div class="home-stat-number">100+</div>
          <div class="home-stat-label">Active Brands</div>
        </div>
        <div class="home-stat-redesigned">
          <div class="home-stat-number">$10M+</div>
          <div class="home-stat-label">Portfolio Value</div>
        </div>
      </div>
      
      <!-- CTA -->
      <div class="home-hero__cta-wrapper">
        <a href="<?php echo get_post_type_archive_link('domains'); ?>" class="home-hero__cta-redesigned">
          Browse Premium Domains
          <svg viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Featured Domains Section - Top 16 Randomized -->
<section class="home-domains-redesigned">
  <div class="home-domains__inner-redesigned">
    <div class="home-domains__header-redesigned">
      <h2>Featured Premium Domains</h2>
      <p>Hand-selected from our portfolio to give your brand an instant edge</p>
    </div>
    
    <div class="home-domains__grid-redesigned">
      <?php
      $featured_args = array(
        'post_type' => 'domains',
        'posts_per_page' => 16,
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
        $domain_posts = array();
        while ($featured_query->have_posts()) {
          $featured_query->the_post();
          $domain_posts[] = get_the_ID();
        }
        shuffle($domain_posts);
        
        foreach ($domain_posts as $domain_id):
          if (function_exists('svm_render_domain_card')) {
            echo svm_render_domain_card($domain_id);
          }
        endforeach;
        
        wp_reset_postdata();
      else:
        echo '<p style="grid-column: 1/-1; text-align: center; color: #6b7280;">No featured domains available at this time.</p>';
      endif;
      ?>
    </div>
    
    <div class="home-domains__cta-redesigned">
      <a href="<?php echo get_post_type_archive_link('domains'); ?>" class="home-domains__btn-redesigned">View All Available Domains</a>
    </div>
  </div>
</section>

<!-- Featured Blog Posts Section -->
<section class="home-blog-redesigned">
  <div class="home-blog__inner-redesigned">
    <div class="home-blog__header-redesigned">
      <h2>Insights & Resources</h2>
      <p>Expert advice on domain investing and building successful ventures</p>
    </div>
    
    <div class="home-blog__grid-redesigned">
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
        <article class="home-blog-card-redesigned">
          <?php if (has_post_thumbnail()): ?>
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" alt="<?php the_title_attribute(); ?>" class="home-blog-card__image-redesigned">
          <?php else: ?>
            <div class="home-blog-card__image-redesigned"></div>
          <?php endif; ?>
          
          <div class="home-blog-card__content-redesigned">
            <div class="home-blog-card__meta-redesigned">
              <?php if ($primary_cat): ?>
                <span class="home-blog-card__category-redesigned"><?php echo esc_html($primary_cat->name); ?></span>
              <?php endif; ?>
              <span><?php echo get_the_date('M j, Y'); ?></span>
            </div>
            
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            
            <p class="home-blog-card__excerpt-redesigned"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
            
            <a href="<?php the_permalink(); ?>" class="home-blog-card__link-redesigned">
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
    <div class="home-blog__cta-redesigned">
      <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="home-blog__btn-redesigned">View All Articles</a>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>