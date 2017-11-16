<?php get_header(); ?>
<div id="primary" class="content-area">
<article class="error-404 not-found"><div class="content-wrap">
		<header class="page-header"><h1 class="page-title">对不起，您访问的页面不存在，请尝试下面的操作！</h1></header>
		<div class="page-content">
			<p>1.请您使用关键字搜索吧!</p>
			<?php get_search_form(); ?>
			<br/>
			<p>2.或者请访问下面的导航目录吧！</p>
			<?php wp_nav_menu( array('theme_location' => 'primary', 'menu_id' => '404notfound-menu', 'menu_class' => '' ) ); ?>
		</div>
</div></article>
</div>
<?php get_sidebar();
	get_footer(); ?>
