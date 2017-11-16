<?php get_header(); ?>

<div class="item-header"><br/><h3 class="aligncenter">新闻动态</h3><br/></div>
<div class="masonry clearfix"><?php get_post_homepage(1);?></div>

<div class="item-header"><br/><h3 class="aligncenter">产品服务</h3><br/></div>
<div  class="masonry clearfix"><?php get_post_homepage(5);?></div>

<div class="item-header"><br/><h3 class="aligncenter">成功案例</h3><br/></div>
<div class="masonry clearfix"><?php get_post_homepage(3);?></div>

<?php get_footer(); ?>