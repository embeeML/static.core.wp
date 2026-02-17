<?php
/**
 * The main template file
 *
 * @package StaticCore
 * @since StaticCore 1.0.0
 */

get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
get_template_part( 'entry' );
comments_template();
endwhile; endif;
get_template_part( 'nav', 'below' );
get_footer();