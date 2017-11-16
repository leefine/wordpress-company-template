<?php get_header(); 

	if ( have_posts() ) :
		echo '<div class="masonry clearfix">';
		while(have_posts()):the_post();get_template_part( 'template-parts/content');endwhile;
	endif; 
	echo '</div>';
	pingraphy_the_posts_navigation(); 

get_footer(); ?>
