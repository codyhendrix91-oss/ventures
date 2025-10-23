<?php
get_header();
echo '<h1>Domains Marketplace</h1>';
if(have_posts()){
  echo '<div class="grid">';
  while(have_posts()){ the_post();
    $price = get_post_meta(get_the_ID(),'svm_price',true);
    echo '<div class="card"><a href="'.get_permalink().'">'.get_the_title().'</a>';
    echo '<div>Price: '.esc_html($price).'</div></div>';
  }
  echo '</div>';
}
get_footer();
