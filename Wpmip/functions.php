<?php
defined( 'ABSPATH' )  or exit;
//reg thumbnails
if ( function_exists('add_theme_support') ){
	add_theme_support('post-thumbnails');
}

function wpcool_title(){ ?>
<?php if ( is_home() ) { ?>
	<title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?><?php if ($paged > 1) echo '-第 ', $paged, ' 页'; ?></title>
<?php } ?>
<?php if ( is_search() ) { ?>
	<title>搜索结果 - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_single() ) { ?>
	<title><?php echo trim(wp_title('',0)); ?><?php if (get_query_var('page')) { echo '-第'; echo get_query_var('page'); echo '页';}?> - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_page() ) { ?>
	<title><?php echo trim(wp_title('',0)); ?> - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_category() ) { ?>
	<title><?php single_cat_title(); ?> - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_author() ) { ?>
	<title><?php the_author_nickname(); ?> - <?php bloginfo('name'); ?></title>
<?php } ?>
<?php if ( is_tag() ) { ?>
	<title><?php  single_tag_title("", true); ?> - <?php bloginfo('name'); ?></title>
<?php } ?>
	<?php

}

function wpcool_copyright(){
	if(is_home()){
        echo '<link rel="canonical" href="'.get_bloginfo('url').'" />'."\n";
    }else
        if(is_tax() || is_tag() || is_category()){
            $term = get_queried_object();
            echo '<link rel="canonical" href="'.get_term_link( $term, $term->taxonomy ).'" />'."\n";
        }else
            if(is_page()){
                echo '<link rel="canonical" href="'.get_permalink().'" />'."\n";
            }else
                if(is_single()){
                    echo '<link rel="canonical" href="'.get_permalink().'" />'."\n";
                }
}

//echo thumbnail src
function post_thumbnail($type='0'){
	global $post;
	if( $values = get_post_custom_values("thumb") ) {	//输出自定义域图片地址
		$values = get_post_custom_values("thumb");
		$src = $values [0];
	} elseif( has_post_thumbnail() ){	//如果有特色缩略图，则输出缩略图地址
		$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$src = $thumbnail_src [0];
	} else {	//文章中获取
        $content = $post->post_content;  
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);  
        $n = count($strResult[1]);  
        if($n > 0){ // 提取首图
            $src = $strResult[1][0];
        }else { // null
			if($type){
			$src = ''.get_bloginfo('template_url').'/images/banner.jpg';
            }
			else{
            $src = ''.get_bloginfo('template_url').'/images/nopic.jpg';
            }
        } 
	};
		echo $src;
}

//页面导航
function t_nav($query_string){
	global $posts_per_page, $paged;
	$my_query = new WP_Query($query_string ."&posts_per_page=-1");
	$total_posts = $my_query->post_count;
	if(empty($paged))$paged = 1; 
	$prev = $paged - 1;
	$next = $paged + 1;
	$range = 2; // only edit this if you want to show more page-links
	$showitems = ($range * 2)+1;
	$pages = ceil($total_posts/$posts_per_page);
	if(1 != $pages){
		echo "<div class=\"prev-next\">";
		for ($i=2; $i <= $pages; $i++){
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
				echo ($paged == $i)? "<a class=\"prev\" href='".get_pagenum_link($prev)."'>« 上一页</a>": "";
				echo ($paged == $i)? "<span class=\"prev-next-page\">第".$i."页</span>": "";
			}
		}
		echo ($paged < $pages && $showitems >= 1) ? "<a href='".get_pagenum_link($next)."'>下一页 »</a>" :"";
		echo "</div>\n";
	}
}

//访问计数
function record_visitors(){
	if (is_singular()) {global $post;
	 $post_ID = $post->ID;
	  if($post_ID) 
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1))) 
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'record_visitors');  
function post_views($before = '(阅读 ', $after = ' 次)', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  if ($echo) echo $before, number_format($views), $after;
  else return $views;
};

//remove Google Fonts
function remove_open_sans() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
	wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );

//replace admin font
function Fanly_admin_lettering() {
	echo '<style type="text/css">
* { font-family: "Microsoft YaHei"; }
#activity-widget #the-comment-list .avatar { max-width: 50px; max-height: 50px; }
</style>';
}
add_action( 'admin_head', 'Fanly_admin_lettering' );

//移除头部多余信息
remove_action('wp_head','wp_generator');//禁止在head泄露wordpress版本号
remove_action('wp_head', 'feed_links', 2 );//移除包含文章和评论的feed
remove_action('wp_head', 'feed_links_extra', 3 );//移除额外的feed，例如category, tag页
remove_action('wp_head','rsd_link');//移除head中的rel="EditURI"
remove_action('wp_head','wlwmanifest_link');//移除head中的rel="wlwmanifest"
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//rel=pre
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );//rel=shortlink 
//remove_action('wp_head', 'rel_canonical' );

//禁止WordPress头部加载s.w.org
add_filter( 'emoji_svg_url', '__return_false' );

//WordPress Emoji禁用
remove_action( 'admin_print_scripts',	'print_emoji_detection_script');
remove_action( 'admin_print_styles',	'print_emoji_styles');
remove_action( 'wp_head',		'print_emoji_detection_script',	7);
remove_action( 'wp_print_styles',	'print_emoji_styles');
remove_filter( 'the_content_feed',	'wp_staticize_emoji');
remove_filter( 'comment_text_rss',	'wp_staticize_emoji');
remove_filter( 'wp_mail',		'wp_staticize_emoji_for_email');

//禁用 WordPress 4.4+ 的响应式图片功能
add_filter( 'max_srcset_image_width', create_function( '', 'return 1;' ) );

//屏蔽文章 Embed 功能
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
 
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10 );
remove_filter('oembed_response_data',   'get_oembed_response_data_rich',  10, 4);
 
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');


//禁用REST API
add_filter('rest_enabled', '_return_false');
add_filter('rest_jsonp_enabled', '_return_false');

//移除wp-json链接
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

// hide admin bar
add_filter('show_admin_bar', 'hide_admin_bar');
function hide_admin_bar($flag) {
	return false;
}

//views count
function get_post_views ($post_id,$text=' 人阅读') {
    $count_key = 'views';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        $count = '0';
    }
    echo number_format_i18n($count).$text;
}
function set_post_views () {
    global $post;
    $post_id = $post -> ID;
    $count_key = 'views';
    $count = get_post_meta($post_id, $count_key, true);
    if (is_single() || is_page()) {
        if ($count == '') {
            delete_post_meta($post_id, $count_key);
            add_post_meta($post_id, $count_key, '0');
        } else {
            update_post_meta($post_id, $count_key, $count + 1);
        }
    }
}
add_action('get_header', 'set_post_views');

//WordPress文章内容自动添加nofollow及_blank属性
add_filter( 'the_content', 'auto_add_url_parse');
function auto_add_url_parse( $content ) {
	$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
	if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
		if( !empty($matches) ) {
			$srcUrl = get_option('siteurl');
			for ($i=0; $i < count($matches); $i++){
				$tag = $matches[$i][0];
				$tag2 = $matches[$i][0];
				$url = $matches[$i][0];
 
				$noFollow = '';
 
				$pattern = '/target\s*=\s*"\s*_blank\s*"/';
				preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
				if( count($match) < 1 ){
					$noFollow .= ' target="_blank" ';
				}else{
					$target = '';//为文章中内链添加_blank
				}
 
				$pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
				preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
				if( count($match) < 1 ){
					$noFollow .= ' rel="nofollow" ';
				}elseif($noFollow ==''){
					$noFollow .= '';
				}

				$pos = strpos($url,$srcUrl);
				if ($pos === false) {
					$tag = rtrim ($tag,'>');
					$tag .= $noFollow.'>';
					$content = str_replace($tag2,$tag,$content);
				}elseif($target!==''){//为文章中内链添加_blank，匹配百度mip
					$tag = rtrim ($tag,'>');
					$tag .= ' target="_blank">';
					$content = str_replace($tag2,$tag,$content);
				}
			}
		}
	}
	$content = str_replace(']]>', ']]>', $content);
	return $content;
}

//自定义摘要控制
function custom_excerpt($len=100) {
	global $post;
	if ($post->post_excerpt) {
		$excerpt  = $post->post_excerpt;
	} else {
		if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
			$post_content = $result['1'];
		} else {
			$post_content_r = explode("\n",trim(strip_tags($post->post_content)));
			$post_content = $post_content_r['0'];
		}
		$excerpt = $post_content;  
	}
	echo mb_strimwidth($excerpt,0,$len,'...');
}

//WordPress文章内图片适配百度MIP规范
//last update 2018/11/15
add_filter('the_content', 'fanly_mip_images');
function fanly_mip_images($content){
	preg_match_all('/style="(.*?)"/', $content, $styles);
	if(!is_null($styles)) {
	    foreach($styles[1] as $index => $value){
	    $content = str_replace($styles[0][$index], '', $content);
	}
	}
	preg_match_all('/<img (.*?)\>/', $content, $images);

	if(!is_null($images)) {
		foreach($images[1] as $index => $value){
			$mip_img = str_replace('<img', '<mip-img', $images[0][$index]);
			$mip_img = str_replace('>', '></mip-img>', $mip_img);
			//以下代码可根据需要修改/删除
			$mip_img = preg_replace('/(width|height)="\d*"\s/', '', $mip_img );//移除图片width|height
			$mip_img = preg_replace('/ style=\".*?\"/', '',$mip_img);//移除图片style
			$mip_img = preg_replace('/ class=\".*?\"/', '',$mip_img);//移除图片class
			//以上代码可根据需要修改/删除
			$content = str_replace($images[0][$index], $mip_img, $content);
		}
	}
	return $content;
}

/* 
 * post related
 * ====================================================
*/
function wpcool_posts_related($title='', $limit, $model='text'){
    global $post;
    $exclude_id = $post->ID;
    $posttags = wp_get_post_tags($post->ID);
    $i = 0;
	$tag_list=array();
    echo '<div class="section_title '.$model.'"><span>'.$title.'</span></div><ul class="same-cat-post">';
    if($posttags){
	foreach ($posttags as $tag ){ 
        $tag_list[] .= $tag->term_id;}
        $post_tag = $tag_list[ mt_rand(0, count($tag_list) - 1) ];
        $args = array(
            'post_status' => 'publish',
            'tag__in' => array($post_tag),
            'post__not_in' => explode(',', $exclude_id), 
            'ignore_sticky_posts' => 1, 
            'showposts' => $limit,
            //'orderby' => 'comment_date',
            'ignore_sticky_posts' => 1
        );
        query_posts($args); 
        while( have_posts() ) { the_post();
            echo '<li><a data-type="mip" href="'.get_permalink().'">';
            echo get_the_title().'</a></li>';
            $exclude_id .= ',' . $post->ID; $i ++;
        };
        wp_reset_query();
    }
    if ( $i < $limit ) { 
        $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
        $args = array(
            'category__in' => explode(',', $cats), 
            'post__not_in' => explode(',', $exclude_id),
            'ignore_sticky_posts' => 1,
            //'orderby' => 'comment_date',
             'orderby' => 'rand',
            'posts_per_page' => $limit - $i
        );
        query_posts($args);
        while( have_posts() ) { the_post();
            echo '<li><a data-type="mip" href="'.get_permalink().'">';
            echo get_the_title().'</a></li>';
            $i ++;
        };
        wp_reset_query();
    }
    if ( $i == 0 ){
        echo '暂无相关内容！';
    }
    echo '</ul>';
}
//全部设置结束
?>
