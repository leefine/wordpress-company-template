<article id="post-<?php the_ID(); ?>"
<?php 
if(has_post_thumbnail()){
	echo 'class="item has-post-thumbnail"','><div class="thumbnail"><a href="',the_permalink(),'">',the_post_thumbnail('medium'),"</a></div>";
}
else{
	echo 'class="item no-post-thumbnail"','>';
} ?>
<div class="item-text"><header class="entry-header"><?php the_title('<h2 class="entry-title"><a href="'.esc_url(get_permalink() ).'">','</a></h2>'); 
 ?>
</header><div class="item-description"><div class="entry-content"><?php echo the_excerpt();?></div></div>
</div><footer class="entry-footer clearfix">
<?php 

$pfmt=get_post_type();
if($pfmt=='post'){
?>
<div class="entry-meta"><div class="entry-footer-right">
<span class="comments-link"><i class="fa fa-comment"></i> 
<?php if (!post_password_required() && ( comments_open() || get_comments_number() ) ) {	
	comments_popup_link(' 0',' 1',' %');
}
?>
</span><span class="comments-link"><i class="fa fa-eye"> </i> <?php echo (int)get_post_meta(get_the_id(), 'views', true);?></span>
</div></div>
<?php }

	echo '<span class="posted-on" title="'.get_the_date().' '.get_the_time().'">';
	echo the_time();
	echo '</span>';	

 ?></footer>
</article>