<?php
function kgato_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus( array(
		'primary' 	=> __( 'Main Menu', 'kgato' ),
		'footer' => __('Footer Menu', 'kgato')
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'post-formats', array(		
		'image',
		'video','status'
	) );
}

add_action( 'after_setup_theme', 'kgato_setup' );

function loadscripts() {
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css');
	wp_enqueue_style( 'nivo-slider', get_template_directory_uri() .  '/css/nivo-slider.css');
	wp_enqueue_style( 'kgato-style', get_stylesheet_uri());	
	wp_enqueue_script( 'nivo-slider', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery'));
	wp_enqueue_script( 'dft-script', get_template_directory_uri() . '/js/script.js');
	wp_localize_script( 'kgato-custom-script', 'AdminAjaxURL', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	if ( is_singular() && comments_open() && get_option('thread_comments') )wp_enqueue_script('comment-reply');
}
add_action( 'wp_enqueue_scripts', 'loadscripts' );


function pingraphy_the_posts_navigation() {	
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	the_posts_pagination(array(
				'prev_text'=> '<i class="fa fa-angle-double-left"></i>',
				'next_text'=> '<i class="fa fa-angle-double-right"></i>',
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'pingraphy' ) . ' </span>',
	) ); 
}
 
function close_wp_revisions_to_keep($num, $post ) { return 0;}
add_filter( 'wp_revisions_to_keep', 'close_wp_revisions_to_keep', 10, 2);
function pingraphy_excerpt_length($length) {return 50;}
add_filter('excerpt_length','pingraphy_excerpt_length',50);
function pingraphy_excerpt_more($more){return '...';}
add_filter('excerpt_more','pingraphy_excerpt_more');
function custom_loginlogo_url($url) {return home_url();}
add_filter('login_headerurl','custom_loginlogo_url');
function close_revisions($num, $post) {return 0;}
add_filter('wp_revisions_to_keep', 'close_revisions', 10, 2 );
function new_from_name($email){return get_option('blogname');}
add_filter('wp_mail_from_name', 'new_from_name');
function new_from_email($email) {return 'service@kgato.com';}
add_filter('wp_mail_from','new_from_email');

function add_editor_buttons($buttons) {
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'cleanup';
	$buttons[] = 'styleselect';
	$buttons[] = 'hr';
	$buttons[] = 'del';
	$buttons[] = 'sub';
	$buttons[] = 'sup';
	$buttons[] = 'copy';
	$buttons[] = 'paste';
	$buttons[] = 'cut';
	$buttons[] = 'undo';
	$buttons[] = 'image';
	$buttons[] = 'anchor';
	$buttons[] = 'backcolor';
	$buttons[] = 'wp_page';
	$buttons[] = 'charmap';
	return $buttons;
}
add_filter("mce_buttons_3", "add_editor_buttons");

function disable_emojis_tinymce( $plugins ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
}

function remove_open_sans() {    
	wp_deregister_style( 'open-sans' );    
	wp_register_style( 'open-sans', false );    
	wp_enqueue_style('open-sans','');
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'show_admin_bar', '__return_false' );
}
add_action('init', 'remove_open_sans');

function my_custom_login() { ?>
<style type="text/css">.login form{padding:20px !important;}.login form .input, .login input[type="text"]{font-size:20px !important;} .login{background:#f1f1f1 url("<?php echo get_template_directory_uri();?>/images/bg/bg<?php echo rand(1,12) ?>.jpg") no-repeat scroll 0 0 / cover ; } .login h1{background-color:#aa1801;} #login h1 a { background-image:url(<?php echo home_url();?>/logo.png) !important;background-size: 175px auto;width:320px;height:50px;margin-bottom: 0; } .login form{margin-top: 0;} 
.login #nav{ padding:10px 10px 10px 25px; margin:0px;background-color: #fff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.13);} .login #backtoblog{padding:10px 10px 15px 25px; margin:0px;background-color: #fff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.13);} .mobile #login #backtoblog, .mobile #login #nav{margin-left:0px;}  @media screen and (max-width: 500px) {.mobile #login {padding:0px}  #login{margin:auto;padding:0px;width: 100%;}} </style>
<?php 
}
add_action('login_head', 'my_custom_login');

function add_security_question() { 
?>
<p><label>验证码: <br/><input type="text" name="vcode" class="input"  maxlength="5" size="5" style="width:80px"/><img src="<?php echo get_template_directory_uri();?>/vcode.php" /></label></p>
<?php 
}      
add_action('register_form', 'add_security_question' );
add_filter('login_form', 'add_security_question');

add_filter('wp_authenticate_user', 'login_validate', 10, 2);
function login_validate($user, $username='', $password=''){
session_start();
    if (isset($_POST['wp-submit'])){
        if(!($_POST['vcode'] == $_SESSION['VCODE'])){
            remove_filter('authenticate', 'login_validate', 20, 3);
            $error = new WP_Error();
            $error->add('incorrect_password', '<strong>错误</strong>：验证码不正确。');
            return $error;
        }
    }
    return $user;
}

add_action('register_post', 'register_validate',10, 3);
function register_validate($sanitized_user_login, $user_email, $errors) {
session_start();
        if(!($_POST['vcode'] == $_SESSION['VCODE'])){
          return $errors->add( 'prooffail', '<strong>错误</strong>：验证信息不正确。');	
        }    
}

function annointed_admin_bar_remove() {  
global $wp_admin_bar;  
$wp_admin_bar->remove_menu('wp-logo');  
}  
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);


function specail_time($from){
	$diff = (int) abs(time()- $from);
	if ($diff < 360) {		
		$time = '刚刚';
	}
	elseif ($diff <= 3600) {
		$mins = round($diff / 60);
		$time=$mins.'分钟前';
	}
	elseif ($diff <= 86400) {
		$hours = round($diff / 3600);
		$time=$hours.'小时前';
	}
	elseif ($diff <= 259200) {
		$cd=date("Y-m-d",$from);
		if(date("Y-m-d",strtotime("-1 day"))==$cd) $time= '昨天 '.get_the_time('G:i'); 
		elseif(date("Y-m-d",strtotime("-2 day"))==$cd) $time= '前天 '.get_the_time('G:i'); 
		else $time =date(get_option('date_format'), $from);
	}
	else{
		$time =date(get_option('date_format'), $from);
	}
	return $time;
}

function Bing_filter_time(){	
	return specail_time(get_the_time('U'));
}
add_filter('the_time','Bing_filter_time');

add_filter('pre_site_transient_update_themes',  create_function('$a', "return null;")); // 关闭主题提示
remove_action('admin_init', '_maybe_update_themes');  // 禁止 WordPress 更新主题
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10);
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );   
 
 
function get_cat_child($pid){
	 $categories=get_categories('child_of='.$pid);
	 if(sizeof($categories)==0)return array($pid);
	 $children=array();
	 foreach ($categories as $cat) {
	 	$children[]=$cat->cat_ID;
	 }
	 return $children;
}

 
function get_cat_child_self($cid){
  $cat_IDs=get_cat_child($cid);
  $cat_IDs[]=$cid;
  return $cat_IDs;
} 
 
function get_post_hot(){
	$args = array('meta_key'=> '_thumbnail_id',
		'post_type'=>'post',
		'posts_per_page' => 5, 
		'offset' => 0,		
		/*'date_query' => array(array('after'  => '20 day ago')),*/
		'orderby' => 'comment_count meta_value_num',
		'meta_key'=> 'views',
		'order'   => 'DESC');

  	$cat_ID = get_query_var('cat');
  	if (isset($cat_ID) && !empty($cat_ID)&&$cat_ID!="") $args["category__in"]=get_cat_child_self($cat_ID);
	global $wp_query;  
	$post_query = new WP_Query($args );
 if ( $post_query->have_posts() ) {
	?>
	<div class="theme-default index-hot-news">
	<div id="slider-hot-news" class="nivoSlider">
	<?php while ($post_query->have_posts()) : $post_query->the_post(); if (has_post_thumbnail(get_the_id())) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php echo mb_strimwidth(get_the_title(),0,50,'...','UTF-8');?>"><?php the_post_thumbnail('large');?>"</a>
	<?php endif; endwhile;wp_reset_postdata();?>
	</div></div>
<?php }
}

function get_post_homepage($catid){
	$args = array('meta_key'=> '_thumbnail_id',
		'post_type'=>'post',
		'posts_per_page' =>4, 
		'offset' => 0,
		'orderby' => 'date',
		'order'   => 'DESC'
		);
  	$args["category__in"]=get_cat_child_self($catid);
	global $wp_query;  
	$post_query = new WP_Query($args );
  	while ($post_query->have_posts()) : $post_query->the_post();
  	  	?>
<article id="post-<?php the_ID(); ?>"
<?php  echo 'class="item has-post-thumbnail"','><div class="thumbnail"><a href="',the_permalink(),'">',the_post_thumbnail('medium'),"</a></div>";
?>
<div class="item-text"><header class="entry-header"><?php the_title('<h2 class="entry-title"><a href="'.esc_url(get_permalink() ).'">','</a></h2>'); 
 ?>
</header><div class="item-description"><div class="entry-content"><?php echo the_excerpt();?></div></div>
</div>
</article>
<?php endwhile;wp_reset_postdata();
}

function cmp_breadcrumbs() {
	$delimiter = '»'; // 分隔符
	$before = '<span class="current">'; // 在当前链接前插入
	$after = '</span>'; // 在当前链接后插入
	if ( !is_home() && !is_front_page() || is_paged() ) {
		global $post;
		$homeLink = home_url();
		echo ' <a  href="' . $homeLink . '">' . __( '<i class="fa fa-home"></i>' , 'cmp' ) . '</a> ' . $delimiter . ' ';
		if ( is_category() ) { // 分类 存档
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0){
				$cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a ', $cat_code );
			}
			echo $before . '' . single_cat_title('', false) . '' . $after;
		} elseif ( is_single() && !is_attachment() ) { // 文章
			if ( get_post_type() != 'post' ) { // 自定义文章类型
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a  href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else { // 文章 post
				$cat = get_the_category(); $cat = $cat[0];
				$cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a ', $cat_code );
				echo $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_page() && !$post->post_parent ) { // 页面
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) { // 父级页面
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_search() ) { // 搜索结果
			echo $before ;
			echo '搜索:', get_search_query();
			echo  $after;
		} 
		if ( get_query_var('paged') ) { // 分页
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo sprintf( __( '( Page %s )', 'cmp' ), get_query_var('paged') );
		}
	}
}