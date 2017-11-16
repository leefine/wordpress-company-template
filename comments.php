<?php if ( post_password_required() ) return;?>
<div id="comments" class="comments-area">
	<div class="comment-form-wrap">
	<?php 	 $comment_args = array( 'title_reply'=>'我要评论',
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<p class="comment-form-author"><input placeholder="Name'.( $req ? '*' : '' ).'" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" /></p>',
			'email'  => '<p class="comment-form-email"><input placeholder="Email'.( $req ? '*' : '' ).'" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" />'.'</p>',
			'url' => '<p class="comment-form-url"><input placeholder="Website" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>' )),
			'comment_field' => '<p><textarea placeholder="你有什么看法呢" id="comment" name="comment" cols="45" rows="4" aria-required="true"></textarea>'.'</p>',
			'comment_notes_after' => '',
		);
		comment_form($comment_args);
	?>
	</div>
	<?php if ( have_comments() ) : ?><div class="comment-desc"><?php endif; ?>
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
		<?php echo '关于"' . get_the_title() . '"的评论('.get_comments_number().'条)';?>
		</h2>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'pingraphy' ); ?></h2>
			<div class="nav-links">
				<div class="nav-previous"><?php previous_comments_link( esc_html__( '<i class="fa fa-angle-double-left"></i> 最早评论', 'pingraphy' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( '最新评论 <i class="fa fa-angle-double-right"></i>', 'pingraphy' ) ); ?></div>
			</div>
		</nav>
		<?php endif;  ?>
		<ol class="comment-list">
			<?php wp_list_comments( array(
					'style'      => 'ol',
					'max_depth'  => '4',
					'avatar_size'=> 80,
					'reply_text' => '回复 <i class="fa fa-angle-double-down"></i>',
					'short_ping' => true
				) );
			?>
		</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'pingraphy' ); ?></h2>
			<div class="nav-links">
				<div class="nav-previous"><?php previous_comments_link( esc_html__( '<i class="fa fa-angle-double-left"></i> 最早评论', 'pingraphy' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( '最新评论 <i class="fa fa-angle-double-right"></i>', 'pingraphy' ) ); ?></div>
			</div>
		</nav>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :?>
		<p class="no-comments"><?php esc_html_e( '评论已关闭！', 'pingraphy' ); ?></p>
	<?php endif; ?>
	<?php if ( have_comments() ) : ?>
	</div>
	<?php endif; ?>
</div>