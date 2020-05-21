<?php
// 后台设置
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
require_once get_stylesheet_directory() . '/admin/options-framework.php';
// 评论模板
include ('inc/comment-template.php');
// 边栏小工具
require get_template_directory() . '/widget.php';
// 短代码设置
include ('inc/shortcode.php');
// 自定栏目定制
include ('inc/metabox.php');
// 特色+边栏调用
include ('inc/default.php');
//	添加菜单
register_nav_menus(
   array(
      'primary' => '网站导航',
      'header' => '页面导航',
   )
);

// 添加小工具
if (function_exists('register_sidebar')){
	register_sidebar( array(
		'name'          => '首页侧边栏（上）',
		'id'            => 'sidebar-h-t',
		'description'   => '显示在首页侧边栏上面',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><i class="iconfont icon-viewgrid"></i>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => '首页侧边栏（跟随）',
		'id'            => 'sidebar-h-r',
		'description'   => '显示在首页，并跟随滚动',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><i class="iconfont icon-viewgrid"></i>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => '首页侧边栏（下）',
		'id'            => 'sidebar-h-b',
		'description'   => '显示在首页侧边栏下面',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><i class="iconfont icon-viewgrid"></i>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => '正文侧边栏（上）',
		'id'            => 'sidebar-s-t',
		'description'   => '显示在正文、页面上面',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><i class="iconfont icon-viewgrid"></i>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => '正文侧边栏（跟随）',
		'id'            => 'sidebar-s-r',
		'description'   => '显示在正文、页面，并跟随滚动',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><i class="iconfont icon-viewgrid"></i>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => '正文侧边栏（下）',
		'id'            => 'sidebar-s-b',
		'description'   => '显示在正文、页面下面',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><i class="iconfont icon-viewgrid"></i>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => '分类归档侧边栏（上）',
		'id'            => 'sidebar-a-t',
		'description'   => '显示在归档页、搜索、404页上面 ',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><i class="iconfont icon-viewgrid"></i>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => '分类归档侧边栏（跟随）',
		'id'            => 'sidebar-a-r',
		'description'   => '显示在归档页、搜索、404页并跟随滚动 ',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><i class="iconfont icon-viewgrid"></i>',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => '分类归档侧边栏（下）',
		'id'            => 'sidebar-a-b',
		'description'   => '显示在归档页、搜索、404页下面 ',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="clear"></div></aside>',
		'before_title'  => '<h3 class="widget-title"><i class="iconfont icon-viewgrid"></i>',
		'after_title'   => '</h3>',
	) );
}

//	定义主题版本	
define( 'version', '1.8.1' );

//	加载scripts和css
function md_scripts() {	
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), version);	
	
	//如果开启阿里字体图标，自带的禁用
	if (! md_get_option('ali_iconfont')){		
			wp_enqueue_style( 'iconfont', get_template_directory_uri() . '/inc/fonts/iconfont.css', array(),version);
		}		
        wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '1.10.1', false );
		wp_enqueue_script( 'jquery.leanModal.min', get_template_directory_uri() . '/js/jquery.leanModal.min.js', array(), '1.11.4', false );
        wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array(), version, false );
		wp_enqueue_script( 'jquery-ias', get_template_directory_uri() . '/js/jquery-ias.js', array(), '2.2.1', true );	
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array(), version, true );
	//幻灯片	
	if ( is_home() || is_category() ){	
		wp_enqueue_style( 'swiper-css', get_template_directory_uri() . '/inc/slider/swiper.min.css', array(), '3.4.2');		
		}
	//FancyBox	
	if ( is_singular() ) {
		wp_enqueue_style( 'fancybox-css', get_template_directory_uri() . '/inc/fancybox/fancybox.css', array(),'2.1.5');
		wp_enqueue_script( 'fancybox-js', get_template_directory_uri() . '/inc/fancybox/fancybox.js', array(), '2.1.5', true );
		wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/inc/fancybox/jquery.mousewheel.js', array(), '3.0.6', true );
		wp_enqueue_script( 'comments-ajax-qt', get_template_directory_uri() . '/js/comments-ajax.js', array(), version, true);
		}
	}
add_action( 'wp_enqueue_scripts', 'md_scripts' ); 

//	自动缩略图
function get_thumbnail($width,$height) { 
global $post; 
$content = $post->post_content; 
// $soImages = '~<img [^>]* />~'; 
preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER); 
$n = count($strResult[1]); 
$m = substr_count($strResult[1][0], '/timthumb.php'); //判断图片是否已经用timthumb显示 
if ($n > 0){ // 如果文章内包含有图片，就用第一张图片做为缩略图 
if ($m ==1 ) { 
echo ''.preg_replace("/&h.*zc=1/","",$strResult[1][0]).'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1'; 
} else { //如果没有timthumb则补充 
echo '<a href="'.get_permalink().'"><img  src="'.get_bloginfo('template_url').'/timthumb.php?src='.$strResult[1][0].'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title .'"/></a>'; 
} 
} 
else { // 如果文章内没有图片，则用默认的图片 
$random = mt_rand(1, 25);
		echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a>';
} 
}

//分类取父分类
function md_category(){
$category = get_the_category();
if($category[0]){
	echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
	}
}

/* 头像改用CN、SSL链接 */
function md_get_avatar($avatar) {
	if(md_get_option('gravatar_source')=='default'){
    $avatar = '<img src="'.get_template_directory_uri().'/img/gravatar.png" class="avatar" width="50" height="50" />';
    }
	elseif(md_get_option('gravatar_source')=='ssl'){
    $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="50px" width="50px">',$avatar);
    }
	elseif(md_get_option('gravatar_source')=='cn'){
    $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="http://cn.gravatar.com/avatar/$1?s=$2&d=mm" class="avatar avatar-$2" height="$2" width="$2">',$avatar);    
	}
	return $avatar;
}
add_filter('get_avatar', 'md_get_avatar', 10, 3);	
	
// 显示全部设置
function all_settings_link() {
    add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
}
add_action('admin_menu', 'all_settings_link');


// 评论贴图
if (md_get_option('embed_img')) {
	add_action('comment_text', 'comments_embed_img', 2);
	}
function comments_embed_img($comment) {
	$size = auto;
	$comment = preg_replace(array('#(http://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#','#(https://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#'),'<img src="$1" alt="评论" style="width:'.$size.'; height:'.$size.'" />', $comment);
	return $comment;
}


// 禁止无中文留言
function refused_spam_comments( $comment_data ) {
	$pattern = '/[一-龥]/u';  
	if(!preg_match($pattern,$comment_data['comment_content'])) {
		err('评论必须含中文！');
	}
	return( $comment_data );
}
add_filter('preprocess_comment','refused_spam_comments');

// 评论链接新窗口
function commentauthor($comment_ID = 0) {
    $url    = get_comment_author_url( $comment_ID );
    $author = get_comment_author( $comment_ID );
    if ( empty( $url ) || 'http://' == $url )
		echo $author;
    else
		echo "<a href='$url' rel='external nofollow' target='_blank' class='url'>$author</a>";
}

// 彩色标签云
function colorCloud($text) {
	$text = preg_replace_callback('|<a (.+?)>|i', 'colorCloudCallback', $text);
	return $text;
}
function colorCloudCallback($matches) {
	$text = $matches[1];
	$color = dechex(rand(0,16777215));
	$pattern = '/style=(\'|\")(.*)(\'|\")/i';
	$text = preg_replace($pattern, "style=\"color:#{$color};$2;\"", $text);
	return "<a $text>";
}
add_filter('wp_tag_cloud', 'colorCloud', 1);

//	fancybox暗箱效果自动添加标签属性
add_filter('the_content', 'fancybox_gall_replace'); 
function fancybox_gall_replace ($content) {
global $post; 
$title = $post->post_title;
$pattern = "/<a(.*?)href=('|\")([^>]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")([^\>]*?)>/i";
$replacement = '<a$1href=$2$3$4$5$6 class="fancybox" data-fancybox-group="button"  title="'.$title.'">';
$content = preg_replace($pattern, $replacement, $content);
return $content;
}

// 屏蔽自带小工具
function unregister_default_wp_widgets() {
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);

//	移除头部多余信息	
function wpbeginner_remove_version(){
	return;
}
add_filter('the_generator', 'wpbeginner_remove_version');//wordpress的版本号
remove_action('wp_head', 'feed_links', 2);//包含文章和评论的feed
remove_action('wp_head','index_rel_link');//当前文章的索引
remove_action('wp_head', 'feed_links_extra', 3);// 额外的feed,例如category, tag页
remove_action('wp_head', 'start_post_rel_link', 10, 0);// 开始篇 
remove_action('wp_head', 'parent_post_rel_link', 10, 0);// 父篇 
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // 上、下篇. 
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//rel=pre
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );//rel=shortlink 
remove_action('wp_head', 'rel_canonical' );
remove_action('wp_head', 'wp_resource_hints', 2 ); //禁止WordPress头部加载s.w.org
add_filter('show_admin_bar', '__return_false'); //禁止WordPress头部adminbar
add_filter('pre_option_link_manager_enabled', '__return_true' );//添加友情链接设置
add_filter( 'wp_revisions_to_keep', 'specs_wp_revisions_to_keep', 10, 2 );//关闭文章修订
function specs_wp_revisions_to_keep( $num, $post ) {
    return 0;
}
add_action('wp_print_scripts','disable_autosave');//关闭自动保存
function disable_autosave(){  
    wp_deregister_script('autosave'); 
}
//表情
//取当前主题下images\smilies\下表情图片路径
function custom_gitsmilie_src($old, $img) {
    return get_stylesheet_directory_uri() . '/img/smilies/' . $img;
}
function init_gitsmilie() {
    global $wpsmiliestrans;
    //默认表情文本与表情图片的对应关系(可自定义修改)
    $wpsmiliestrans = array(
        ':mrgreen:' => 'icon_mrgreen.gif',
        ':neutral:' => 'icon_neutral.gif',
        ':twisted:' => 'icon_twisted.gif',
        ':arrow:' => 'icon_arrow.gif',
        ':shock:' => 'icon_eek.gif',
        ':smile:' => 'icon_smile.gif',
        ':???:' => 'icon_confused.gif',
        ':cool:' => 'icon_cool.gif',
        ':evil:' => 'icon_evil.gif',
        ':grin:' => 'icon_biggrin.gif',
        ':idea:' => 'icon_idea.gif',
        ':oops:' => 'icon_redface.gif',
        ':razz:' => 'icon_razz.gif',
        ':roll:' => 'icon_rolleyes.gif',
        ':wink:' => 'icon_wink.gif',
        ':cry:' => 'icon_cry.gif',
        ':eek:' => 'icon_surprised.gif',
        ':lol:' => 'icon_lol.gif',
        ':mad:' => 'icon_mad.gif',
        ':sad:' => 'icon_sad.gif',
        '8-)' => 'icon_cool.gif',
        '8-O' => 'icon_eek.gif',
        ':-(' => 'icon_sad.gif',
        ':-)' => 'icon_smile.gif',
        ':-?' => 'icon_confused.gif',
        ':-D' => 'icon_biggrin.gif',
        ':-P' => 'icon_razz.gif',
        ':-o' => 'icon_surprised.gif',
        ':-x' => 'icon_mad.gif',
        ':-|' => 'icon_neutral.gif',
        ';-)' => 'icon_wink.gif',
        '8O' => 'icon_eek.gif',
        ':(' => 'icon_sad.gif',
        ':)' => 'icon_smile.gif',
        ':?' => 'icon_confused.gif',
        ':D' => 'icon_biggrin.gif',
        ':P' => 'icon_razz.gif',
        ':o' => 'icon_surprised.gif',
        ':x' => 'icon_mad.gif',
        ':|' => 'icon_neutral.gif',
        ';)' => 'icon_wink.gif',
        ':!:' => 'icon_exclaim.gif',
        ':?:' => 'icon_question.gif',
    );
    //移除Emoji钩子同时挂上主题自带的表情路径
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('smilies_src', 'custom_gitsmilie_src', 10, 2);
}
add_action('init', 'init_gitsmilie', 5);

//评论@	
function comment_at( $comment_text, $comment = '') {
  if( $comment->comment_parent > 0) {
    $comment_text = '<span class="at">@<a href="#comment-' . $comment->comment_parent . '">'.get_comment_author( $comment->comment_parent ) . '</a></span> ' . $comment_text;
  }
  return $comment_text;
}
add_filter( 'comment_text' , 'comment_at', 20, 2);

//	禁止加载jquery
add_action( 'pre_get_posts', 'jquery_register' );
function jquery_register() {
	if ( !is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '1.10.1', false );
		wp_enqueue_script( 'jquery' );
	}
}

//	搜索结果排除所有页面
function search_filter_page($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts','search_filter_page');

//	去掉描述P标签
function deletehtml($description) {
	$description = trim($description);
	$description = strip_tags($description,"");
	return ($description);
}

//	编辑器增强
function enable_more_buttons($buttons) {
	$buttons[] = 'hr';
	$buttons[] = 'del';
	$buttons[] = 'sub';
	$buttons[] = 'sup';
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'cleanup';
	$buttons[] = 'styleselect';
	$buttons[] = 'wp_page';
	$buttons[] = 'anchor';
	$buttons[] = 'backcolor';
	return $buttons;
}
add_filter( "mce_buttons_2", "enable_more_buttons" );

// 后台编辑器文本模式添加短代码快捷输入按钮
function my_quicktags() {
    wp_enqueue_script('my_quicktags',get_stylesheet_directory_uri().'/js/my_quicktags.js',array('quicktags'));
}
add_action('admin_print_scripts', 'my_quicktags');

//	禁止代码标点转换
remove_filter( 'the_content', 'wptexturize' );


//	摘要去除短代码
function md_excerpt_delete_shortcode($excerpt){
	$r = "'\[button(.*?)+\](.*?)\[\/button]|\[toggle(.*?)+\](.*?)\[\/toggle]|\[callout(.*?)+\](.*?)\[\/callout]|\[infobg(.*?)+\](.*?)\[\/infobg]|\[tinl2v(.*?)+\](.*?)\[\/tinl2v]|\[tinr2v(.*?)+\](.*?)\[\/tinr2v]|\<pre(.*?)+\>(.*?)\<\/pre>|\[php(.*?)+\](.*?)\[\/php]|\[PHP(.*?)+\](.*?)\[\/PHP]|\[caption(.*?)+\](.*?)\[\/caption]'";
	return preg_replace($r, '', $excerpt);
}
add_filter( 'the_excerpt', 'md_excerpt_delete_shortcode', 999 );

// 分页
function md_pagenav() {
	if (md_get_option('scroll')) {	
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="nav-below">
			<div class="nav-next"><?php previous_posts_link(''); ?></div>
			<div class="nav-previous"><?php next_posts_link(''); ?></div>
		</nav>
	<?php endif;
}
	the_posts_pagination( array(
		'mid_size' => 2,
		'prev_text'          => '<i class="iconfont icon-chevronleft"></i>',
		'next_text'          => '<i class="iconfont icon-chevronright"></i>',
		'before_page_number' => '<span class="screen-reader-text">第 </span>',
		'after_page_number' => '<span class="screen-reader-text"> 页</span>',
	) );
}

// 时间
function timeago($ptime)
{
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if ($etime < 1) {
        return '刚刚';
    }
    $interval = array(
		12 * 30 * 24 * 60 * 60 => '年前', 
		30 * 24 * 60 * 60 => '个月前', 
		7 * 24 * 60 * 60 => '周前',
		24 * 60 * 60 => '天前',
		60 * 60 => '小时前',
		60 => '分钟前',
		1 => '秒前'
	);
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if (1 <= $d) {
            $r = round($d);
            return $r . $str;
        }
    }
}

if (md_get_option('upload_time')){
//wordpress上传文件重命名
function md_upload_filter($file) {
	date_default_timezone_set("Asia/Shanghai");
    $time = date("Ymdhis");
    $file['name'] = $time . "" . mt_rand(1, 100) . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'md_upload_filter');
}

// 面包屑导航
function md_crumbs() {
		if (is_home()) {
			if (md_get_option('bulletin')) {
				echo '<div class="bull">';
				echo '<i class="iconfont icon-bullhorn" aria-hidden="true"></i>';
				echo "</div>";
				get_template_part( 'inc/bulletin' );
			} else {
				echo '现在位置： ';
				echo '首页';
			}
		}	

		if (!is_home() && !is_front_page()) {
			echo '<a class="crumbs" title="返回首页" href="';
			echo home_url();
			echo '">';
			echo '首页';
			echo "</a>";
		}

		if (is_category()) {
			echo '<i class="iconfont icon-chevronright"></i>';
			echo get_category_parents( get_query_var('cat') , true , '<i class="iconfont icon-chevronright"></i>' );
			echo '文章 ';
		}

		if ( is_tax('notice') ) {
			echo '<i class="iconfont icon-chevronright"></i>';			
		}

		if (is_single()) {
			echo '<i class="iconfont icon-chevronright"></i>';
			echo the_category('<i class="iconfont icon-chevronright"></i>', 'multiple');
			if ( 'post' == get_post_type() ) {
				echo '<i class="iconfont icon-chevronright"></i>';
				echo '正文 ';
			}
			if (is_attachment() ) {	echo '附件 '; }
		}

		if (is_page() && !is_front_page()) {
			echo '<i class="iconfont icon-chevronright"></i>';
			echo the_title();
		}
		if (is_page() && is_front_page()) {
				echo '现在位置： ';
				echo '首页';
			}
	elseif (is_tag()) {echo '<i class="iconfont icon-chevronright"></i>';single_tag_title();echo '<i class="iconfont icon-chevronright"></i>文章 ';}
	elseif (is_day()) {echo '<i class="iconfont icon-chevronright"></i>';echo"发表于"; the_time('Y年m月d日'); echo'的文章';}
	elseif (is_month()) {echo '<i class="iconfont icon-chevronright"></i>';echo"发表于"; the_time('Y年m月'); echo'的文章';}
	elseif (is_year()) {echo '<i class="iconfont icon-chevronright"></i>';echo"发表于"; the_time('Y年'); echo'的文章';}
	elseif (is_author()) {echo '<i class="iconfont icon-chevronright"></i>';echo wp_title( ''); echo'发表的文章';}
	elseif (is_404()) {echo '<i class="iconfont icon-chevronright"></i>';echo"亲，你迷路了！"; echo'';}
}

// 禁用oembed/rest
function disable_embeds_init() {
	global $wp;
	$wp->public_query_vars = array_diff( $wp->public_query_vars, array(
		'embed',
	) );
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );
	add_filter( 'embed_oembed_discover', '__return_false' );
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
	add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
}

add_action( 'init', 'disable_embeds_init', 9999 );

remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );

function disable_embeds_tiny_mce_plugin( $plugins ) {
	return array_diff( $plugins, array( 'wpembed' ) );
}
function disable_embeds_rewrites( $rules ) {
	foreach ( $rules as $rule => $rewrite ) {
		if ( false !== strpos( $rewrite, 'embed=true' ) ) {
			unset( $rules[ $rule ] );
		}
	}
	return $rules;
}
function disable_embeds_remove_rewrite_rules() {
	add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );
function disable_embeds_flush_rewrite_rules() {
	remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );


// 安装插件提示
function showadminmessages() {
	$plugin_messages = array();
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	// 下载插件
	if(!is_plugin_active( 'wp-postviews/wp-postviews.php' )) {
		$plugin_messages[] = '主题部分功能需要安装并启用文章浏览统计插件 WP-PostViews 才能使用，您可以在插件安装页面搜索并安装，也可以到此<a href="https://wordpress.org/plugins/wp-postviews/">下载插件</a>';
	}
	if(count($plugin_messages) > 0) {
		echo '<div id="message" class="error">';
			foreach($plugin_messages as $message) {
				echo '<p><strong>'.$message.'</strong></p>';
			}
		echo '</div>';
	}
}
add_action('admin_notices', 'showadminmessages');

// 浏览总数
function all_view(){
global $wpdb;
$count=0;
$views= $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key='views'");
foreach($views as $key=>$value)
	{
		$meta_value=$value->meta_value;
		if($meta_value!=' '){
			$count+=(int)$meta_value;
		}
	}
return $count;
}

//导航菜单 Walker 对象 icon 字体优化
class description_walker extends Walker_Nav_Menu{
        function start_el(&$output, $item, $depth=0, $args=array(),$id=0){
                global $wp_query;
                $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
                $class_names = '';
                $classes = empty( $item->classes ) ? array() : (array) $item->classes;
                $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
                $class_names = ' class="'. esc_attr( $class_names ) . '"';
                $output.= $indent . '<li ' . $class_names .'>';
                $icon = ! empty( $item->attr_title ) ? esc_attr( $item->attr_title ) : '';
                $attributes = ! empty( $item->target )        ? ' target="' . esc_attr( $item->target     ) .'"' : '';    //链接目标
                $attributes.= ! empty( $item->xfn )           ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';    //链接关系网 也就是rel属性
                $attributes.= ! empty( $item->url )           ? ' href="'   . esc_attr( $item->url        ) .'"' : '';    //链接
                $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';   //图像描述
                if($depth != 0) $description = "";    //只在一级菜单输出图像描述，如果全部输出请注释本行
                $item_output = $args->before;
                $item_output.= '<a '. $attributes .'><i class="'. $icon .'"></i>';
                $item_output.= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $description;
                $item_output.= '</a>';
                $item_output.= $args->after;
                $output.= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
}
// 到此全部结束，后面额外加的为非法代码
?>
