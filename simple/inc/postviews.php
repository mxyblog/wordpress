<?php
//显示浏览次数
function the_views() {
	$post_views			= get_post_views(get_the_ID());
	$post_feed_views	= get_post_feed_views(get_the_ID());

	if(is_single()){	//因为累加的过程在 footer，所以显示的时候先+1
		$post_views = $post_views+1;
	}
		$views = $post_views + $post_feed_views;
		echo $views;
		
}
function get_post_views($post_id){
	$post_views = wp_cache_get($post_id,'views');
	if($post_views === false){
		$post_views = get_post_meta($post_id, "views",true);
		if(!$post_views) $post_views = 0;
	}
	return $post_views;
}

function get_post_feed_views($post_id){
	$post_feed_views = wp_cache_get($post_id,'feed_views');
	if($post_feed_views === false){
		$post_feed_views = get_post_meta($post_id, "feed_views",true);
		if(!$post_feed_views) $post_feed_views = 0;
	}
	return $post_feed_views;
}

add_action('wp_footer','post_view_footer');
function post_view_footer(){

	if(is_single()){ //只统计日志的浏览次数
		$post_views = get_post_views(get_the_ID())+1;
		if(wp_using_ext_object_cache()){
			wp_cache_set(get_the_ID(),$post_views,'views');
			if($post_views%10 == 0){
				update_post_meta(get_the_ID(), 'views', $post_views);   
			}
		}else{
			update_post_meta(get_the_ID(), 'views', $post_views);
		}
	}
}

add_action('init', 'feed_post_views_init', 6);
function feed_post_views_init(){

	$feed_post_id = (isset($_GET['feed_post_id'])) ? intval($_GET['feed_post_id']):false;

	if($feed_post_id && get_post($feed_post_id)){

		$post_feed_views = get_post_feed_views($feed_post_id)+1;

		if(wp_using_ext_object_cache()){
			wp_cache_set($feed_post_id,$post_feed_views,'feed_views');
			if($post_feed_views%10 == 0){
				update_post_meta($feed_post_id, 'feed_views', $post_feed_views);
			}
		}else{
			update_post_meta($feed_post_id, 'feed_views', $post_feed_views);
		}

		$post_views = get_post_views($feed_post_id);
		$views = $post_views + $post_feed_views;

		header("Content-Type: image/png");
		$im = @imagecreate(84, 24)
			or die("Cannot Initialize new GD image stream");
		$background_color = imagecolorallocate($im, 0, 0, 0);
		$text_color = imagecolorallocate($im, 233, 14, 91);
		imagestring($im, 2, 5, 5,  $views.' VIEWS', $text_color);

		imagepng($im);
		imagedestroy($im);
		exit;
	}
}

if(is_admin()){
	add_filter('manage_posts_columns', 'postviews_admin_add_column');
	function postviews_admin_add_column($columns){
		$columns['views'] = '浏览';
		return $columns;
	}
	add_action('manage_posts_custom_column','postviews_admin_show',10,2);
	function postviews_admin_show($column_name,$id){
		if ($column_name != 'views') return;
		echo "<span style='color:red;'>".get_post_views($id)."</span> | ".get_post_feed_views($id)."";
	}
}