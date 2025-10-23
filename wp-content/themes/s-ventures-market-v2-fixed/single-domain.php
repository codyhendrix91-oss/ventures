<?php
get_header(); the_post(); echo '<h1>'.get_the_title().'</h1>'; echo do_shortcode('[fluentform id="1"]'); get_footer(); ?>