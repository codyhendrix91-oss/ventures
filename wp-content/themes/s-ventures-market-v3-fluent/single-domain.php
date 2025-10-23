<?php
get_header();
the_post();
$price = get_post_meta(get_the_ID(),'svm_price',true);
echo '<h1>'.get_the_title().'</h1>';
echo '<p>'.get_the_content().'</p>';
echo '<p>Price hidden until verification.</p>';
echo do_shortcode('[fluentform id="1"]'); // use Fluent Forms
get_footer();
