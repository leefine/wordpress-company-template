<?php get_header(); ?>
		
<div class="masonry clearfix">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('template-parts/content'); ?>
			<?php endwhile; ?>			
		<?php endif; ?>
</div>
			
		<?php pingraphy_the_posts_navigation(); ?>	
<?php get_footer(); ?>