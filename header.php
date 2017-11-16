<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<header id="masthead" class="clearfix site-header " role="banner">
<div class="clearfix inner">
	<?php if( has_nav_menu('primary'))  : ?><a class="toggle-mobile-menu" href="#"><i class="fa fa-bars"></i></a><nav class="main-navigation"></nav><div class="navigation-full"  role="navigation"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'clearfix' ) ); ?></div><?php endif; ?>	
	<div class="site-branding"><div class="site-title logo"><a href="<?php echo esc_url(home_url() ); ?>"><img id="site-logo" src="<?php echo esc_url(home_url()); ?>/logo.png"/></a>
	</div></div> 
	<div class="search-style-one"><a id="trigger-overlay"><i class="fa fa-search"></i></a><div class="overlay overlay-slideleft"><div class="search-row"><form method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" _lpchecked="1"><a ahref="#" class="overlay-close"><i class="fa fa-times"></i></a><input type="text" name="s" id="s" value="<?php echo get_search_query(); ?>" placeholder="请输入关键字" /></form>
	</div></div></div>
</div>
</header> 

<div id="content" class="site-content<?php echo $class; ?>"><div class="inner clearfix">
<?php
echo '<header class="breadcrumbs">';
cmp_breadcrumbs();
echo '</header>';
if(is_home()){ get_post_hot();}
if(is_category()){ get_post_hot();}
?>

