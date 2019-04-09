<?php 
foreach ( glob( get_template_directory() . '/inc/*.php' ) as $filename ) {
  require $filename;
}
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails');
function post_thumbnail_src(){
    global $post;
	if( $values = get_post_custom_values("thumb") ) {
		$values = get_post_custom_values("thumb");
		$post_thumbnail_src = $values [0];
	} elseif( has_post_thumbnail() ){    
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$post_thumbnail_src = $thumbnail_src [0];
    } else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$post_thumbnail_src = $matches [1] [0];  
		if(empty($post_thumbnail_src)){
			$random = mt_rand(1, 10);
			echo get_bloginfo('template_url');
			echo '/images/thumbnail.jpg';
			//echo '/images/pic/'.$random.'.jpg';
		}
	};
	echo $post_thumbnail_src;
}
function simple_setup() {
    register_nav_menu( 'simple', __( '菜单 Primary Menu', 'simple' ) );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );
    add_filter( 'pre_option_link_manager_enabled', '__return_true' );
    add_theme_support( 'post-formats', array(
        'status',
    ) );
}
add_action( 'after_setup_theme', 'simple_setup' );
function link_to_menu_editor( $args ){
    if ( ! current_user_can( 'manage_options' ) ){
        return;
    }
    extract( $args );
    $link = $link_before
        . '<a href="' .admin_url( 'nav-menus.php' ) . '">' . $before . 'Add a menu 添加菜单' . $after . '</a>'
        . $link_after;
    if ( FALSE !== stripos( $items_wrap, '<ul' )
        or FALSE !== stripos( $items_wrap, '<ol' )
    )
    {
        $link = "<li>$link</li>";
    }
    $output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
    if ( ! empty ( $container ) )
    {
        $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
    }
    if ( $echo )
    {
        echo $output;
    }
    return $output;
}
function paging_nav() {
	global $wp_query;
	$pages = $wp_query->max_num_pages;
	if ( $pages >= 2 ):
	$big = 999999999;
	$paginate = paginate_links( array(
		'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'	=> '?paged=%#%',
		'current'	=> max( 1, get_query_var('paged') ),
		'total'		=> $wp_query->max_num_pages,
		'end_size'	=> 13,
		'type'		=> 'array'
	) );
	echo '<ul class="pagination">';
	foreach ($paginate as $value) {
	echo '<li>'.$value.'</li>';
	}
	echo '</ul>';
	endif;
}
function get_ssl_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cn.gravatar.com", $avatar);
    return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');
function down_show_down($content) {
	if(is_single())
	{
		$down_start=get_post_meta(get_the_ID(), 'down_start', true);
		$down_url=get_post_meta(get_the_ID(), 'down_url', true);
		$down_demo=get_post_meta(get_the_ID(), 'down_demo', true);
		if($down_url)
		{
		$demo_content .= '<a href="'.$down_demo.'" target="_blank"><i class="fa fa-external-link"></i>预览地址</a>';
		}
		if($down_start)
		{
			$content .= '';
			$content .= '<div class="downBox"><ul class="downul clearfix"><li><a href="'.$down_url.'" target="_blank"><i class="fa fa-download"></i>下载地址</a></li><li class="middleli">'.$demo_content.'</li><li><a href="'.get_bloginfo('url').'"><i class="fa fa-home"></i>返回首页</a></li></ul></div>';
		}
	}
	return $content;
}
add_action('the_content','down_show_down');
function share_show($content)
{
	if(is_single())
	{
                $id=$_GET['id'];
                $title = get_post($id)->post_title;
		        $share_start=get_post_meta(get_the_ID(), 'share_start', true);
                $share_speed=get_post_meta(get_the_ID(), 'share_speed', true);
		
    if($share_start)
		{
			$content .= '<br />';
			$content .= '<div class="share-zan">
					<div class="share clearfix">
						<ul class="share-icon clearfix">
							<li><a href="http://www.jiathis.com/send/?webid=tsina&url=<?php the_permalink();?>&title=<?php the_title();?>&uid=$uid "></a></li>
							<li><a href="http://www.jiathis.com/send/?webid=weixin&url=<?php the_permalink();?>&title=<?php the_title();?>&uid=$uid "></a></li>
							<li><a href="http://www.jiathis.com/send/?webid=qzone&url=<?php the_permalink();?>&title=<?php the_title();?>&uid=$uid "></a></li>
							<li><a href="http://www.jiathis.com/send/?webid=cqq&url=<?php the_permalink();?>&title=<?php the_title();?>&uid=$uid "></a></li>
							<li><a href="http://www.jiathis.com/send/?webid=renren&url=<?php the_permalink();?>&title=<?php the_title();?>&uid=$uid "></a></li>
							<li><a href="http://www.jiathis.com/send/?webid=tqq&url=<?php the_permalink();?>&title=<?php the_title();?>&uid=$uid "></a></li>
						</ul>
					</div>
				</div>';
		}
	}
	return $content;
}
add_action('the_content','share_show');

//修改wordpress默认头像
add_filter( 'avatar_defaults', 'newgravatar' );
function newgravatar ($avatar_defaults) {
    $myavatar = get_bloginfo('template_directory') . '/images/kide.jpg';
    $avatar_defaults[$myavatar] = "自定义头像";
    return $avatar_defaults;
}

//获取访问量
function custom_the_views($post_id, $echo=true, $views='') {
    $count_key = 'views';  
    $count = get_post_meta($post_id, $count_key, true);  
    if ($count == '') {  
        delete_post_meta($post_id, $count_key);  
        add_post_meta($post_id, $count_key, '0');  
        $count = '0';  
    }  
    if ($echo)  
        echo number_format_i18n($count) . $views;  
    else  
        return number_format_i18n($count) . $views;  
}  
function set_post_views() {  
    global $post;  
    $post_id = $post->ID;  
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

//自定义后台登陆   
function custom_login() {   
	echo '<link rel="shortcut icon"  href="' . get_bloginfo('template_directory') . '/custom_login/custom_favicon.ico" />';
	echo '<link rel="stylesheet" tyssspe="text/css" href="' . get_bloginfo('template_directory') . '/custom_login/custom_login.css" />'; 
	echo '<script src="' . get_bloginfo('template_directory') . '/custom_login/custom_login.js"></script>'; 
}   
add_action('login_head', 'custom_login');

/**
 * 让 WordPress 只搜索文章的标题
*/
function __search_by_title_only( $search, &$wp_query ){
    global $wpdb;
    if ( empty( $search ) )
        return $search; // skip processing - no search term in query
    $q = $wp_query->query_vars;    
    $n = ! empty( $q['exact'] ) ? '' : '%';
 
    $search =
    $searchand = '';
    foreach ( (array) $q['search_terms'] as $term ) {
        $term = esc_sql( like_escape( $term ) );
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }
    if ( ! empty( $search ) ) {
        $search = " AND ({$search}) ";
        if ( ! is_user_logged_in() )
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }
    return $search;
}
add_filter( 'posts_search', '__search_by_title_only', 500, 2 );

//自定义评论列表模板
function simple_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li class="comment" id="li-comment-<?php comment_ID(); ?>">
   		<div class="media">
   			<div class="media-left">
        		<?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 48); } ?>
   			</div>
   			<div class="media-body">
   				<?php printf(__('<p class="author_name">%s</p>'), get_comment_author_link()); ?>
		        <?php if ($comment->comment_approved == '0') : ?>
		            <em>评论等待审核...</em><br />
				<?php endif; ?>
				<?php comment_text(); ?>
   			</div>
   		</div>
   		<div class="comment-metadata">
   			<span class="comment-pub-time">
   				<?php echo get_comment_time('Y-m-d H:i'); ?>
   			</span>
   			<span class="comment-btn-reply">
 				<i class="fa fa-reply"></i> <?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?> 
   			</span>
   		</div>

<?php
}
?>