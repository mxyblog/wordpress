<div id="related-img">
<!--如果存在tag标签，列出tag相关文章 --> 
<?php 
$post_tags=wp_get_post_tags($post->ID); 
$i=1; 
if($post_tags) { 
foreach($post_tags as $tag) $tag_list[] .= $tag->term_id; 
$args = array( 
'tag__in' => $tag_list, 
'category__not_in' => array(NULL), // 不包括的分类ID,可以把NULL换成分类ID 
'post__not_in' => array($post->ID), 
'showposts' => 0, // 显示相关文章数量 
'caller_get_posts' => 1, 
'orderby' => 'rand' 
); 
query_posts($args); 
if(have_posts()):while (have_posts()&&$i<=8) : the_post(); update_post_caches($posts); ?> 
	<div class="r4">
		<div class="related-site">
			<figure class="related-site-img">
				<?php get_thumbnail(300,180) ?>
			 </figure>
			<div class="related-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
		</div>
	</div>
<?php $i++;endwhile;wp_reset_query();endif; ?> 
<?php }?> 

<!-- 如果tag相关文章少于10篇，那么继续以分类作为相关因素列出相关文章 -->
<?php if($i<=8): 
$cats = wp_get_post_categories($post->ID); 
if($cats){ 
$cat = get_category( $cats[0] ); 
$first_cat = $cat->cat_ID; 
$first_tag = $tag_list;
$args = array( 
'category__in' => array($first_cat), 
'tag__not_in' => array($first_tag),
'post__not_in' => array($post->ID), 
'showposts' => 0, 
'caller_get_posts' => 1, 
'orderby' => 'rand' 
); 
query_posts($args); 
if(have_posts()): while (have_posts()&&$i<=8) : the_post(); update_post_caches($posts); ?> 
	<div class="r4">
		<div class="related-site">
			<figure class="related-site-img">
				<?php get_thumbnail(300,180) ?>
			 </figure>
			<div class="related-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
		</div>
	</div>	
<?php $i++;endwhile;wp_reset_query();endif; ?> 
<?php } endif;?> 

<!-- 如果上面两种相关都还不够10篇文章，再随机挑几篇凑成10篇 -->
<?php if($i<=8){?> 
<?php query_posts('showposts=8&orderby=rand');while(have_posts()&&$i<=8):the_post(); ?> 
	<div class="r4">
		<div class="related-site">
			<figure class="related-site-img">
				<?php get_thumbnail(300,180) ?>
			 </figure>
			<div class="related-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
		</div>
	</div>
<?php $i++;endwhile;wp_reset_query();?> 
<?php } ?>
<div class="clear"></div>
</div>