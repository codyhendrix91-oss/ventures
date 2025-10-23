<?php
get_header(); echo '<h1>Domains</h1>'; if(have_posts()){ while(have_posts()){ the_post(); echo '<div>'.get_the_title().'</div>'; } } get_footer(); ?>