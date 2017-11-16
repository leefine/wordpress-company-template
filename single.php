<?php get_header();
 
while ( have_posts() ) : the_post();?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
			<div class="thumbnail">
				<?php the_post_thumbnail(); ?>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>			
					<div class="entry-meta">
						<?php echo '<span class="posted-on" title="'.get_the_date().' '.get_the_time().'">';
	echo the_time();
	echo '</span>';	
?>
<span class="comments-link"><i class="fa fa-comment"></i> 
<?php if (!post_password_required() && ( comments_open() || get_comments_number() ) ) {	
	comments_popup_link(' 0',' 1',' %');
}
?>
</span>
<span class="comments-link"><i class="fa fa-eye"></i> 
<?php $views=(int)get_post_meta(get_the_id(), 'views', true);echo $views;?></span>
					</div>			
				</header>
			</div>
	<?php endif; ?>
	<div class="content-wrap">	
	<?php if (false==has_post_thumbnail() ) : ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>			
				<div class="entry-meta">
						<?php echo '<span class="posted-on" title="'.get_the_date().' '.get_the_time().'">';
	echo the_time();
	echo '</span>';	?>
				</div>			
		</header>
	<?php endif; ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<div class="st-post-tags">
			<?php the_tags('','',''); ?>
		 </div>
	</div> 
</article>	

<?php       
        if(!update_post_meta(get_the_ID(), 'views', ($views+1)))add_post_meta(get_the_ID(), 'views', 1, true);
	if ( comments_open() || get_comments_number() ) comments_template();

endwhile;
get_footer(); ?>
