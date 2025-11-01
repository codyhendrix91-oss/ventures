<?php
/**
 * Archive template for Domains - SUPER FIXED VERSION
 * - Filters out number categories dynamically
 * - Filters out multi-category combinations
 * - Only shows clean individual categories
 * - Works even before database cleanup
 */
get_header();

$search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'alpha';
$cat = isset($_GET['cat']) ? absint($_GET['cat']) : 0;
$paged = max(1, get_query_var('paged'), get_query_var('page'));

$args = [
  'post_type' => 'domains',
  'posts_per_page' => 24,
  'paged' => $paged,
  's' => $search,
  'orderby' => ($sort === 'new') ? 'date' : 'title',
  'order' => ($sort === 'new') ? 'DESC' : 'ASC',
  'meta_query' => [
    'relation' => 'OR',
    ['key' => 'svm_status', 'value' => 'sold', 'compare' => '!='],
    ['key' => 'svm_status', 'compare' => 'NOT EXISTS'],
  ],
];

if ($cat) {
  $args['tax_query'] = [['taxonomy' => 'domain_category', 'field' => 'term_id', 'terms' => $cat]];
}

$q = new WP_Query($args);
?>

<main class="svm-archive-v8">
  <!-- Hero Section -->
  <section class="svm-archive-hero-v8">
    <div class="svm-archive-hero-content">
      <h1>Premium <span class="svm-gradient-text">Domain Marketplace</span></h1>
      <p>Explore our exclusive portfolio of hand-selected premium domains. Each name is carefully curated to give brands an instant competitive edge.</p>
    </div>
  </section>

  <!-- Main Content -->
  <section class="svm-archive-body-v8">
    <div class="svm-archive-inner-v8">
      
      <!-- Search Bar -->
      <form method="get" class="svm-search-wrapper-v8">
        <div class="svm-search-container-v8">
          <svg viewBox="0 0 20 20" fill="currentColor" class="svm-search-icon-v8">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
          </svg>
          <input type="text" name="s" placeholder="Search premium domains..." value="<?php echo esc_attr($search); ?>" class="svm-search-input-v8">
        </div>
        <select name="sort" class="svm-sort-select-v8">
          <option value="alpha" <?php selected($sort,'alpha'); ?>>A-Z</option>
          <option value="new" <?php selected($sort,'new'); ?>>Newest</option>
        </select>
        <button type="submit" class="svm-search-btn-v8">Search</button>
      </form>

      <!-- Category Filters - SUPER FIXED: Filters out bad categories dynamically -->
      <div class="svm-filters-v8">
        <label class="svm-filter-chip-v8 <?php echo ($cat===0)?'active':''; ?>">
          <input type="radio" name="cat" value="0" <?php checked($cat,0); ?> onchange="location.href='<?php echo add_query_arg(['cat'=>0,'s'=>$search,'sort'=>$sort], get_post_type_archive_link('domains')); ?>';">
          <span>All Domains</span>
        </label>
        <?php
        // Get ALL categories
        $all_terms = get_terms([
            'taxonomy' => 'domain_category',
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC'
        ]);
        
        // Filter to ONLY good categories
        $clean_terms = array();
        if ($all_terms && !is_wp_error($all_terms)):
          foreach($all_terms as $term):
            $is_bad = false;
            
            // Skip if it's a number
            if (is_numeric($term->name)) {
              $is_bad = true;
            }
            
            // Skip if it contains commas (multi-category)
            if (strpos($term->name, ',') !== false) {
              $is_bad = true;
            }
            
            // Skip if it's a complex multi-category with multiple &
            if (strpos($term->name, '&') !== false) {
              $parts = explode('&', $term->name);
              // Allow single & like "Tech & Software" but not multiple
              if (count($parts) > 2 || strpos($term->name, ',') !== false) {
                $is_bad = true;
              }
            }
            
            // Only add if it's a good category
            if (!$is_bad && $term->count > 0) {
              $clean_terms[] = $term;
            }
          endforeach;
        endif;
        
        // Display only clean categories
        foreach($clean_terms as $term):
          $is_active = ($cat===$term->term_id) ? 'active' : '';
          $url = add_query_arg(['cat'=>$term->term_id,'s'=>$search,'sort'=>$sort], get_post_type_archive_link('domains'));
        ?>
          <label class="svm-filter-chip-v8 <?php echo $is_active; ?>">
            <input type="radio" name="cat" value="<?php echo $term->term_id; ?>" <?php checked($cat,$term->term_id); ?> onchange="location.href='<?php echo esc_url($url); ?>';">
            <span><?php echo esc_html($term->name); ?></span>
          </label>
        <?php endforeach; ?>
      </div>

      <!-- Domain Grid -->
      <div class="svm-domains-grid-v8">
        <?php
        if ($q->have_posts()):
          while ($q->have_posts()): $q->the_post();
            if (function_exists('svm_render_domain_card')) {
              echo svm_render_domain_card(get_the_ID());
            }
          endwhile;
        else:
          ?>
          <div class="svm-no-results-v8">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8"/>
              <path d="m21 21-4.35-4.35"/>
            </svg>
            <h3>No domains found</h3>
            <p>Try adjusting your search or browse all categories</p>
            <a href="<?php echo get_post_type_archive_link('domains'); ?>" class="svm-reset-btn-v8">View All Domains</a>
          </div>
          <?php
        endif;
        wp_reset_postdata();
        ?>
      </div>

      <!-- Pagination -->
      <?php if ($q->max_num_pages > 1): ?>
      <nav class="svm-pagination-v8">
        <?php
          echo paginate_links([
            'total' => $q->max_num_pages,
            'current' => $paged,
            'add_args' => array_filter([
              's' => $search ?: null,
              'sort' => ($sort && $sort !== 'alpha') ? $sort : null,
              'cat' => $cat ?: null,
            ]),
            'prev_text' => '<svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span>Previous</span>',
            'next_text' => '<span>Next</span><svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>',
            'type' => 'list',
          ]);
        ?>
      </nav>
      <?php endif; ?>
    </div>
  </section>

  <!-- Purple About -->
</main>

<style>
/* SUPER FIXED Archive Styles */

.svm-archive-v8 {
  background:#f9fafb;
  min-height:100vh;
}

/* Hero Section */
.svm-archive-hero-v8 {
  background:linear-gradient(135deg,#1a1d35 0%,#0a0e27 100%);
  padding:calc(var(--header-height) + 90px) 24px 90px;
  text-align:center;
  position:relative;
  overflow:hidden;
}

.svm-archive-hero-v8::before {
  content:'';
  position:absolute;
  inset:0;
  background:radial-gradient(circle at 50% 50%,rgba(0,217,255,0.1) 0%,transparent 70%);
  pointer-events:none;
}

.svm-archive-hero-content {
  max-width:1000px;
  margin:0 auto;
  position:relative;
  z-index:1;
}

.svm-archive-hero-content h1 {
  font-size:clamp(40px,6.5vw,68px);
  font-weight:700;
  color:#fff;
  margin:0 0 24px;
  font-family:'Colour Brown',sans-serif;
  line-height:1.1;
  letter-spacing:-0.02em;
}

.svm-gradient-text {
  background:linear-gradient(135deg,#00d9ff 0%,#2efc86 100%);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
}

.svm-archive-hero-content p {
  font-size:clamp(17px,2.5vw,20px);
  color:rgba(255,255,255,0.9);
  margin:0 auto;
  line-height:1.7;
  max-width:750px;
}

/* Main Content */
.svm-archive-body-v8 {
  background:#f9fafb;
  padding:90px 24px 120px;
}

.svm-archive-inner-v8 {
  max-width:1400px;
  margin:0 auto;
}

/* Search Wrapper */
.svm-search-wrapper-v8 {
  display:flex;
  gap:14px;
  flex-wrap:wrap;
  margin-bottom:50px;
  background:#fff;
  padding:28px;
  border-radius:20px;
  box-shadow:0 8px 32px rgba(0,0,0,0.08);
}

.svm-search-container-v8 {
  position:relative;
  flex:1;
  min-width:320px;
}

.svm-search-icon-v8 {
  position:absolute;
  left:20px;
  top:50%;
  transform:translateY(-50%);
  width:22px;
  height:22px;
  color:#9ca3af;
  pointer-events:none;
}

.svm-search-input-v8 {
  width:100%;
  padding:18px 24px 18px 54px;
  border:2px solid #e5e7eb;
  border-radius:14px;
  font-size:16px;
  transition:all .2s ease;
  background:#fff;
  color:#1a1d35;
  font-family:var(--font-secondary);
}

.svm-search-input-v8::placeholder {
  color:#9ca3af;
}

.svm-search-input-v8:focus {
  outline:none;
  border-color:#00d9ff;
  background:#fff;
  box-shadow:0 0 0 4px rgba(0,217,255,0.1);
}

.svm-sort-select-v8 {
  padding:18px 24px;
  border:2px solid #e5e7eb;
  border-radius:14px;
  font-size:16px;
  background:#fff;
  color:#1a1d35;
  cursor:pointer;
  transition:all .2s ease;
  min-width:160px;
  font-family:var(--font-secondary);
}

.svm-sort-select-v8:focus {
  outline:none;
  border-color:#00d9ff;
  box-shadow:0 0 0 4px rgba(0,217,255,0.1);
}

.svm-search-btn-v8 {
  padding:18px 38px;
  background:linear-gradient(135deg,#00d9ff 0%,#00b8d9 100%);
  color:#fff;
  border:none;
  border-radius:14px;
  font-size:16px;
  font-weight:700;
  font-family:'Colour Brown',sans-serif;
  cursor:pointer;
  transition:all .3s ease;
  box-shadow:0 4px 20px rgba(0,217,255,0.35);
  white-space:nowrap;
}

.svm-search-btn-v8:hover {
  transform:translateY(-2px);
  box-shadow:0 6px 28px rgba(0,217,255,0.5);
}

/* Filter Chips - SUPER FIXED */
.svm-filters-v8 {
  display:flex;
  flex-wrap:wrap;
  gap:14px;
  justify-content:center;
  margin-bottom:60px;
  padding:28px;
  background:#fff;
  border-radius:20px;
  box-shadow:0 8px 32px rgba(0,0,0,0.08);
}

.svm-filter-chip-v8 {
  padding:13px 26px;
  border:2px solid #e5e7eb;
  border-radius:30px;
  cursor:pointer;
  background:#fff;
  color:#4b5563;
  font-weight:500;
  font-size:15px;
  font-family:'Colour Brown',sans-serif;
  display:inline-flex;
  align-items:center;
  transition:all .25s cubic-bezier(0.4, 0, 0.2, 1);
  user-select:none;
}

.svm-filter-chip-v8 input {
  position:absolute;
  opacity:0;
  width:0;
  height:0;
}

.svm-filter-chip-v8:hover {
  border-color:#00d9ff;
  background:rgba(0,217,255,0.08);
  transform:translateY(-2px);
  color:#1a1d35;
  box-shadow:0 4px 16px rgba(0,217,255,0.15);
}

.svm-filter-chip-v8.active {
  background:linear-gradient(135deg,#00d9ff 0%,#00b8d9 100%);
  color:#fff;
  font-weight:700;
  border-color:#00d9ff;
  box-shadow:0 4px 20px rgba(0,217,255,0.4);
  transform:translateY(-2px);
}

/* Domain Grid */
.svm-domains-grid-v8 {
  display:grid;
  gap:30px;
  grid-template-columns:repeat(auto-fill,minmax(290px,1fr));
}

/* No Results */
.svm-no-results-v8 {
  grid-column:1/-1;
  text-align:center;
  padding:120px 20px;
  color:#6b7280;
}

.svm-no-results-v8 svg {
  width:80px;
  height:80px;
  margin:0 auto 28px;
  color:#d1d5db;
}

.svm-no-results-v8 h3 {
  font-size:30px;
  font-weight:700;
  color:#1a1d35;
  margin:0 0 14px;
  font-family:'Colour Brown',sans-serif;
}

.svm-no-results-v8 p {
  font-size:18px;
  color:#6b7280;
  margin:0 0 32px;
}

.svm-reset-btn-v8 {
  display:inline-block;
  padding:14px 32px;
  background:linear-gradient(135deg,#00d9ff 0%,#00b8d9 100%);
  color:#fff;
  border-radius:28px;
  font-weight:600;
  text-decoration:none;
  transition:all .3s ease;
  box-shadow:0 4px 16px rgba(0,217,255,0.3);
  font-family:'Colour Brown',sans-serif;
}

.svm-reset-btn-v8:hover {
  transform:translateY(-2px);
  box-shadow:0 6px 24px rgba(0,217,255,0.45);
}

/* Pagination */
.svm-pagination-v8 {
  display:flex;
  justify-content:center;
  margin-top:80px;
}

.svm-pagination-v8 ul {
  display:flex;
  gap:10px;
  list-style:none;
  padding:0;
  margin:0;
  align-items:center;
}

.svm-pagination-v8 li {
  margin:0;
}

.svm-pagination-v8 a,
.svm-pagination-v8 span {
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:10px;
  padding:13px 22px;
  background:#fff;
  color:#1a1d35;
  border:2px solid #e5e7eb;
  border-radius:14px;
  font-weight:600;
  font-size:15px;
  font-family:'Colour Brown',sans-serif;
  text-decoration:none;
  transition:all .2s ease;
  min-width:52px;
  min-height:52px;
}

.svm-pagination-v8 a svg {
  width:18px;
  height:18px;
}

.svm-pagination-v8 a:hover {
  border-color:#00d9ff;
  background:rgba(0,217,255,0.08);
  transform:translateY(-2px);
  box-shadow:0 4px 16px rgba(0,0,0,0.06);
}

.svm-pagination-v8 .current {
  background:linear-gradient(135deg,#00d9ff 0%,#00b8d9 100%);
  border-color:#00d9ff;
  color:#fff;
  box-shadow:0 4px 16px rgba(0,217,255,0.35);
}

.svm-pagination-v8 .dots {
  border:none;
  background:transparent;
  color:#9ca3af;
}

/* Responsive */
@media (max-width:768px) {
  .svm-archive-hero-v8 {
    padding:calc(var(--header-height) + 70px) 20px 70px;
  }
  
  .svm-archive-body-v8 {
    padding:70px 20px 90px;
  }
  
  .svm-search-wrapper-v8 {
    flex-direction:column;
    padding:24px;
  }
  
  .svm-search-container-v8 {
    min-width:100%;
  }
  
  .svm-sort-select-v8,
  .svm-search-btn-v8 {
    width:100%;
  }
  
  .svm-filters-v8 {
    padding:24px;
  }
  
  .svm-domains-grid-v8 {
    grid-template-columns:1fr;
  }
  
  .svm-pagination-v8 ul {
    flex-wrap:wrap;
    justify-content:center;
  }
}
</style>

<?php get_footer(); ?>