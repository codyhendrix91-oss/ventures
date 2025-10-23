<?php
/**
 * Archive template for Domains
 * File name MUST be: archive-domains.php (plural to match CPT)
 */
get_header();

// Query vars
$search = isset($_GET['s'])   ? sanitize_text_field($_GET['s']) : '';
$sort   = isset($_GET['sort'])? sanitize_text_field($_GET['sort']) : 'alpha';
$cat    = isset($_GET['cat']) ? absint($_GET['cat']) : 0;
$paged  = max(1, get_query_var('paged'), get_query_var('page'));

// Base args
$args = [
  'post_type'      => 'domains',
  'posts_per_page' => 24,
  'paged'          => $paged,
  's'              => $search,
  'orderby'        => ($sort === 'new') ? 'date' : 'title',
  'order'          => ($sort === 'new') ? 'DESC' : 'ASC',
  // Hide sold names like the shortcodes do (remove this block if you want to show sold)
  'meta_query' => [
    'relation' => 'OR',
    [
      'key'     => 'svm_status',
      'value'   => 'sold',
      'compare' => '!=',
    ],
    [
      'key'     => 'svm_status',
      'compare' => 'NOT EXISTS',
    ],
  ],
];

// Category filter (optional)
if ($cat) {
  $args['tax_query'] = [[
    'taxonomy' => 'domain_category',
    'field'    => 'term_id',
    'terms'    => $cat,
  ]];
}

$q = new WP_Query($args);
?>

<main class="svm-archive">
  <section class="svm-hero-archive">
    <div class="svm-hero-archive__inner">
      <h1>Our Premium Domains</h1>
      <p class="svm-hero-subtitle">Explore our curated portfolio of high-value domain names, available for acquisition.</p>
    </div>
  </section>

  <section class="svm-explorer">
    <div class="svm-grid">
      <!-- Controls -->
      <form method="get" class="svm-controls">
        <div class="svm-controls-top">
          <input type="text" name="s" placeholder="Search domains..." value="<?php echo esc_attr($search); ?>" class="svm-search-input">
          <select name="sort" class="svm-sort-select">
            <option value="alpha" <?php selected($sort,'alpha'); ?>>Alphabetical</option>
            <option value="new"   <?php selected($sort,'new'); ?>>Newest</option>
          </select>
          <button type="submit" class="svm-apply-btn">Apply</button>
        </div>

        <!-- Category chips -->
        <div class="svm-chips">
          <?php
          $terms = get_terms(['taxonomy'=>'domain_category','hide_empty'=>false]);
          if ($terms && !is_wp_error($terms)):
            foreach($terms as $term): ?>
              <label class="svm-chip <?php echo ($cat===$term->term_id)?'is-active':''; ?>">
                <input type="radio" name="cat" value="<?php echo $term->term_id; ?>" <?php checked($cat,$term->term_id); ?> onchange="this.form.submit();">
                <span><?php echo esc_html($term->name); ?></span>
              </label>
            <?php endforeach;
          endif; ?>
          <label class="svm-chip <?php echo ($cat===0)?'is-active':''; ?>">
            <input type="radio" name="cat" value="0" <?php checked($cat,0); ?> onchange="this.form.submit();">
            <span>All</span>
          </label>
        </div>
      </form>

      <!-- Cards -->
      <?php
      if ($q->have_posts()):
        while ($q->have_posts()): $q->the_post();
          echo svm_render_domain_card(get_the_ID());
        endwhile;
      else:
        echo '<p style="grid-column:1/-1;text-align:center;padding:40px;color:#666;">No domains found.</p>';
      endif;
      wp_reset_postdata();
      ?>
    </div>

    <div class="svm-pager">
      <?php
        echo paginate_links([
          'total'   => $q->max_num_pages,
          'current' => $paged,
          // preserve filters across pages
          'add_args'=> array_filter([
            's'    => $search ?: null,
            'sort' => ($sort && $sort !== 'alpha') ? $sort : null,
            'cat'  => $cat ?: null,
          ]),
        ]);
      ?>
    </div>
  </section>

  <!-- Compact Purple About Section -->
  <section class="svm-purple-about">
    <div class="svm-purple-about-inner">
      <p>At S Ventures, we've spent the past two decades quietly acquiring premium digital real estate – the kind of domain names that define industries and ignite ideas. Our portfolio was born from our own ventures, spanning cutting-edge software and AI platforms to e-commerce brands, home services, finance, and beyond. Along the way, we learned a truth every founder faces: not every idea takes off. Sometimes even the perfect brand name ends up on the shelf while the project behind it never quite gets wheels.</p>
      
      <p>Rather than let these powerful names collect dust, we're opening them up to the world. S Ventures offers our curated domain portfolio for sale or lease – even for equity or revenue-sharing partnerships with the right startups. In other words, we're giving other visionaries the chance to turn our unused brands into the next big thing. Why let a brilliant name sit idle when it could become someone's game-changing identity? If we're not using a domain for our own project, we'd love to see it bring your venture to life.</p>
    </div>
  </section>
</main>

<style>
/* Sleeker Archive Hero - Matches Homepage Style */
.svm-hero-archive {
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);
  padding: 100px 20px 80px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.svm-hero-archive::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at 50% 50%, rgba(46, 252, 134, 0.03) 0%, transparent 70%);
  pointer-events: none;
}

.svm-hero-archive__inner {
  max-width: 1000px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.svm-hero-archive h1 {
  font-size: 64px;
  font-weight: 600;
  color: #fff;
  margin: 0 0 20px;
  font-family: 'Colour Brown', sans-serif;
  line-height: 1.1;
  letter-spacing: -0.02em;
}

.svm-hero-subtitle {
  font-size: 20px;
  color: rgba(255, 255, 255, 0.8);
  margin: 0;
  font-weight: 400;
  line-height: 1.5;
  max-width: 700px;
  margin: 0 auto;
}

/* Controls Styling */
.svm-controls {
  grid-column: 1/-1;
  margin-bottom: 40px;
}

.svm-controls-top {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  justify-content: center;
  margin-bottom: 28px;
}

.svm-search-input {
  padding: 13px 18px;
  border: 1px solid #e0e0e0;
  border-radius: 10px;
  min-width: 300px;
  font-size: 15px;
  font-family: var(--font-secondary);
  transition: all 0.2s ease;
  background: #fff;
}

.svm-search-input:focus {
  outline: none;
  border-color: var(--color-bright);
  box-shadow: 0 0 0 3px rgba(46, 252, 134, 0.1);
}

.svm-search-input::placeholder {
  color: #999;
}

.svm-sort-select {
  padding: 13px 18px;
  border: 1px solid #e0e0e0;
  border-radius: 10px;
  font-size: 15px;
  font-family: var(--font-secondary);
  background: #fff;
  cursor: pointer;
  transition: all 0.2s ease;
  min-width: 160px;
}

.svm-sort-select:focus {
  outline: none;
  border-color: var(--color-bright);
  box-shadow: 0 0 0 3px rgba(46, 252, 134, 0.1);
}

.svm-apply-btn {
  padding: 11px 32px;
  border: none;
  border-radius: 50px;
  background: linear-gradient(135deg, #2efc86 0%, #25d876 50%, #1ec770 100%);
  color: var(--color-dark);
  font-weight: 600;
  font-size: 15px;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(46, 252, 134, 0.25);
}

.svm-apply-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(46, 252, 134, 0.35);
}

/* Category Chips - Enhanced with Modern Gradient */
.svm-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  justify-content: center;
}

.svm-chip {
  padding: 10px 20px;
  border: 2px solid #e0e0e0;
  border-radius: 28px;
  cursor: pointer;
  background: #fff;
  color: #555;
  font-weight: 500;
  font-size: 14px;
  display: inline-flex;
  align-items: center;
  transition: all 0.25s ease;
  user-select: none;
  position: relative;
}

.svm-chip input {
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

.svm-chip:hover {
  border-color: var(--color-bright);
  background: rgba(46, 252, 134, 0.08);
  color: var(--color-dark);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.svm-chip.is-active,
.svm-chip input:checked + span {
  background: linear-gradient(135deg, #2efc86 0%, #25d876 50%, #1ec770 100%);
  color: var(--color-dark);
  font-weight: 600;
  border-color: var(--color-bright);
  box-shadow: 0 4px 12px rgba(46, 252, 134, 0.3);
  transform: translateY(-1px);
}

/* When using label with input inside */
.svm-chip:has(input:checked) {
  background: linear-gradient(135deg, #2efc86 0%, #25d876 50%, #1ec770 100%);
  color: var(--color-dark);
  font-weight: 600;
  border-color: var(--color-bright);
  box-shadow: 0 4px 12px rgba(46, 252, 134, 0.3);
  transform: translateY(-1px);
}

/* Compact Purple About Section - Full Width, Single Column */
.svm-purple-about {
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);
  padding: 30px 20px;
  position: relative;
  overflow: hidden;
}

.svm-purple-about::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at 30% 50%, rgba(46, 252, 134, 0.04) 0%, transparent 60%);
  pointer-events: none;
}

.svm-purple-about-inner {
  max-width: 1400px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.svm-purple-about-inner p {
  color: rgba(255, 255, 255, 0.85);
  font-size: 13px;
  line-height: 1.65;
  margin: 0 0 14px;
  font-family: var(--font-secondary);
  font-weight: 400;
  letter-spacing: 0.01em;
}

.svm-purple-about-inner p:last-child {
  margin-bottom: 0;
}

/* Responsive */
@media (max-width: 1024px) {
  .svm-hero-archive h1 {
    font-size: 52px;
  }
  
  .svm-hero-subtitle {
    font-size: 18px;
  }
}

@media (max-width: 768px) {
  .svm-hero-archive {
    padding: 70px 20px 60px;
  }
  
  .svm-hero-archive h1 {
    font-size: 38px;
  }
  
  .svm-hero-subtitle {
    font-size: 16px;
  }
  
  .svm-controls-top {
    flex-direction: column;
  }
  
  .svm-search-input {
    min-width: 100%;
  }
  
  .svm-sort-select,
  .svm-apply-btn {
    width: 100%;
  }
  
  .svm-chips {
    gap: 10px;
  }
  
  .svm-chip {
    padding: 9px 16px;
    font-size: 13px;
  }
  
  .svm-purple-about {
    padding: 25px 20px;
  }
  
  .svm-purple-about-inner p {
    font-size: 12px;
    line-height: 1.6;
    margin-bottom: 12px;
  }
}

@media (max-width: 480px) {
  .svm-hero-archive h1 {
    font-size: 32px;
  }
  
  .svm-hero-subtitle {
    font-size: 15px;
  }
}
</style>

<?php get_footer(); ?>