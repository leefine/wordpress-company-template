<?php get_header(); ?>
			<?php while ( have_posts() ) : the_post();  ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( has_post_thumbnail() ){ ?><div class="thumbnail"><?php the_post_thumbnail(); ?></div><?php }  ?>
<div class="content-wrap">
		<header class="entry-header"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></header>
		<div class="entry-content">
			
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pingraphy' ),
					'after'  => '</div>',
				) );
			?>
		</div>
	</div>	
</article>
<?php
endwhile;  ?>		
<?php get_footer(); ?>