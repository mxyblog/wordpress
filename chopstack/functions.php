<?php
/**
 *
 * 添加其他功能-function.php
 *
 */

function chopstack_setup() {
    // 添加文章形式
    add_theme_support( 'post-formats', array( 'status' ) );

    // 添加文章特色图
    add_theme_support( 'post-thumbnails' );

    //添加菜单
    register_nav_menus( array(
        'primary'      => esc_html__( '菜单', 'chopstack' ),
        'footer_links' => esc_html__( '底部链接', 'chopstack' ),
    ) );

}
add_action( 'after_setup_theme', 'chopstack_setup' );

// 加载主题js以及css
function chopstack_enqueue_scripts() {
    // Theme style
    wp_enqueue_style( 'chopstack-style', get_stylesheet_uri(), array() , filemtime(get_stylesheet_directory().'/style.css'));

    // Pure-custom style
    wp_enqueue_style( 'pure-custom', get_template_directory_uri() . '/static/pure-custom.css', '', '0.6.0' );

    // instantclick-Scripts
    wp_enqueue_script( 'instantclick', get_template_directory_uri() . '/static/instantclick.min.js', '', true );
}
add_action( 'wp_enqueue_scripts', 'chopstack_enqueue_scripts' );

// wp-clean-up插件集成
require get_template_directory() . '/inc/wp-clean-up/wp-clean-up.php';

/**
功能说明: WordPress缩略图
更新时间：2016-11-11
**/
function chopstack_is_has_image(){
    global $post;
    if( has_post_thumbnail() ) return true;
    $content = $post->post_content;
    preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
    if(!empty($strResult[1])) return true;
    return false;
}
/**
功能说明: 获取缩略图地址
更新时间：2016-11-11
**/
function get_post_thumbnail(){
    global $post;
    if( has_post_thumbnail() ){
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
        return $timthumb_src[0];
    } else {
        $content = $post->post_content;
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
        $n = count($strResult[1]);
        if ($n > 0) {
            return $strResult[1][0];
        } else {
            return false;
        }
    }
}

// 七牛云储存
function QiNiuCDN(){
    function Rewrite_URI($html){
        /* 前面是需要用到七牛的域名,后面是需要加速的静态文件类型，使用分隔符 | 隔开即可 */
        $pattern ='/https:\/\/(\.|)mrju\.cn\/wp-([^"\']*?)\.(jpg|js|css|gif|png|jpeg)/i';
        /* 七牛CDN空间地址,请自行替换成实际空间地址 */
        $replacement = 'https://cdn.mrju.cn/wp-$2.$3';
	$html = preg_replace($pattern, $replacement,$html);
	return $html;
	}
    if(!is_admin()){
        ob_start("Rewrite_URI");
    }
}
add_action('init', 'QiNiuCDN');

// 自定义登录页面的LOGO链接为首页链接
add_filter('login_headerurl', create_function(false, "return get_bloginfo('url');"));

// 增加链接管理
add_filter('pre_option_link_manager_enabled', '__return_true');

// 评论邮件
add_action('comment_post','comment_mail_notify');
/* comment_mail_notify v1.0 by willin kan. (所有回复都发邮件) */
function comment_mail_notify($comment_id) {
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if (($parent_id != '') && ($spam_confirmed != 'spam')) {
        $wp_email = 'no-reply@' . preg_replace('#^www.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
        $message = '
    <table cellpadding="0" cellspacing="0" class="email-container" align="center" width="550" style="font-size: 15px; font-weight: normal; line-height: 22px; text-align: left; border: 1px solid rgb(177, 213, 245); width: 550px;">
<tbody><tr>
<td>
<table cellpadding="0" cellspacing="0" class="padding" width="100%" style="padding-left: 40px; padding-right: 40px; padding-top: 30px; padding-bottom: 35px;">
<tbody>
<tr class="logo">
<td align="center">
<table class="logo" style="margin-bottom: 10px;">
<tbody>
<tr>
<td>
<span style="font-size: 22px;padding: 10px 20px;margin-bottom: 5%;color: #65c5ff;border: 1px solid;box-shadow: 0 5px 20px -10px;border-radius: 2px;display: inline-block;">' . get_option("blogname") . '</span>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr class="content">
<td>
<hr style="height: 1px;border: 0;width: 100%;background: #eee;margin: 15px 0;display: inline-block;">
<p>Hi ' . trim(get_comment($parent_id)->comment_author) . '!<br>你发表在 "' . get_the_title($comment->comment_post_ID) . '" 里的评论：</p>
<p style="background: #eee;padding: 1em;text-indent: 2em;line-height: 30px;">' . trim(get_comment($parent_id)->comment_content) . '</p>
<p>'. $comment->comment_author .' 给您的评论答复：</p>
<p style="background: #eee;padding: 1em;text-indent: 2em;line-height: 30px;">' . trim($comment->comment_content) . '</p>
</td>
</tr>
<tr>
<td align="center">
<table cellpadding="12" border="0" style="font-family: Lato, \'Lucida Sans\', \'Lucida Grande\', SegoeUI, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: bold; line-height: 25px; color: #444444; text-align: left;">
<tbody><tr>
<td style="text-align: center;">
<a target="_blank" style="color: #fff;background: #65c5ff;box-shadow: 0 5px 20px -10px #44b0f1;border: 1px solid #44b0f1;width: 200px;font-size: 14px;padding: 10px 0;border-radius: 2px;margin: 10% 0 5%;text-align:center;display: inline-block;text-decoration: none;" href="' . htmlspecialchars(get_comment_link($parent_id)) . '">现在就去回复</a>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>

<table border="0" cellpadding="0" cellspacing="0" align="center" class="footer" style="max-width: 550px; font-family: Lato, \'Lucida Sans\', \'Lucida Grande\', SegoeUI, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 22px; color: #444444; text-align: left; padding: 20px 0; font-weight: normal;">
<tbody><tr>
<td align="center" style="text-align: center; font-size: 12px; line-height: 18px; color: rgb(163, 163, 163); padding: 5px 0px;">
</td>
</tr>
<tr>
<td style="text-align: center; font-weight: normal; font-size: 12px; line-height: 18px; color: rgb(163, 163, 163); padding: 5px 0px;">
<p>请不要回复此邮件，因为它是自动发送的。</p>
<p>© '.date("Y").' <a name="footer_copyright" href="' . home_url() . '" style="color: rgb(43, 136, 217); text-decoration: underline;" target="_blank">' . get_option("blogname") . '</a></p>
</td>
</tr>
</tbody>
</table>';
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
    }
}

// 禁止WordPress头部加载s.w.org
function remove_dns_prefetch( $hints, $relation_type ) {
if ( 'dns-prefetch' === $relation_type ) {
return array_diff( wp_dependencies_unique_hosts(), $hints );
}
return $hints;
}

add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );

// 精简 wp_head & 去除无用函数 & 半角转全角
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_filter('the_content', 'wptexturize');
remove_filter('the_content', 'capital_P_dangit', 11);
remove_filter('the_title', 'capital_P_dangit', 11);
remove_filter('wp_title', 'capital_P_dangit', 11);
remove_filter('comment_text', 'capital_P_dangit', 31);

// 评论链接跳转&新窗口打开
function add_redirect_comment_link($text = '') {
    $text = str_replace("href='", "href='" . get_option('home') . "/?r=", $text);
    $text = preg_replace('/<a (.+?)>/i', "<a $1 target='_blank'>", $text);
    return $text;
}

function redirect_comment_link() {
    $redirect = $_GET['r'];
    if ($redirect) {
        if (strpos($_SERVER['HTTP_REFERER'], get_option('home')) !== false) {
            header("Location: $redirect");
            exit;
        } else {
            header("Location: " . bloginfo('url') . "/");
            exit;
        }
    }
}

add_action('init', 'redirect_comment_link');
add_filter('get_comment_author_link', 'add_redirect_comment_link', 5);

// @父评论
add_filter('comment_text', 'comment_add_at_parent');

function comment_add_at_parent($comment_text) {
    $comment_ID = get_comment_ID();
    $comment = get_comment($comment_ID);
    if ($comment->comment_parent) {
        $parent_comment = get_comment($comment->comment_parent);
        $comment_text = '<a href="#comment-' . $comment->comment_parent . '">@' . $parent_comment->comment_author . '</a> ' . $comment_text;
    }
    return $comment_text;
}

//禁用REST API/移除wp-json链接
add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

//替换Gravatar头像库
function chopstack_get_ssl_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "secure.gravatar.com", $avatar);
    return $avatar;
}
add_filter('get_avatar', 'chopstack_get_ssl_avatar');

// 评论框信息上调
function recover_comment_fields($comment_fields){
    $comment = array_shift($comment_fields);
    $comment_fields =  array_merge($comment_fields ,array('comment' => $comment));
    return $comment_fields;
}
add_filter('comment_form_fields','recover_comment_fields');

// 取当前主题下表情图片路径
function custom_smilie9s_src($old, $img) {
    return get_stylesheet_directory_uri() . '/static/smilies/' . $img;
}

function init_smilie9s() {
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
    
//移除WordPress4.2版本更新所带来的Emoji前后台钩子同时挂上主题自带的表情路径
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

add_filter('smilies_src', 'custom_smilie9s_src', 10, 2);
}

add_action('init', 'init_smilie9s', 5);

// 机器评论验证
function chopstack_robot_comment(){
  if ( !$_POST['no-robot'] && !is_user_logged_in()) {
     wp_die('请勾选评论验证按钮后再发表。');
  }
}

add_action('pre_comment_on_post', 'chopstack_robot_comment');

// 纯英文评论拦截
function chopstack_comment_post( $incoming_comment ) {
  if(!preg_match('/[一-龥]/u', $incoming_comment['comment_content'])){
    wp_die('写点汉字吧，博主外语很捉急。');
  }
  return( $incoming_comment );
}

add_filter('preprocess_comment', 'chopstack_comment_post');

// 友情链接
function get_the_link_items($id = null){
    $bookmarks = get_bookmarks('orderby=date&category=' . $id);
    $output    = '';
    if (!empty($bookmarks)) {
        $output .= '<div class="links-catalog">' . count($bookmarks) . ' items in collection</div><div class="pure-g">';
        foreach ($bookmarks as $bookmark) {
            $output .= '<div class="pure-u-1-2 pure-u-sm-1-3 pure-u-md-1-4"><div class="links-inner"><div class="links-content">'. get_avatar($bookmark->link_notes,64) . '
            <div class="links-name"><a href="' . $bookmark->link_url . '" target="_blank" >' . $bookmark->link_name . '</a></div></div></div></div>';
        }
        $output .= '</div>';
    }
    return $output;
}

function get_link_items(){
    $linkcats = get_terms('link_category');
    if (!empty($linkcats)) {
        foreach ($linkcats as $linkcat) {
            $result .= '
            <h3 class="catalog-title">' . $linkcat->name . '</h3><div class="catalog-description">' . $linkcat->description . '</div>
            ';
            $result .= get_the_link_items($linkcat->term_id);
        }
    } else {
        $result = get_the_link_items();
    }
    return $result;
}

// 文章引用
function chopstack_insert_posts( $atts, $content = null ){
    extract( shortcode_atts( array(
        'ids' => ''
    ),
        $atts ) );
    global $post;
    $content = '';
    $postids =  explode(',', $ids);
    $inset_posts = get_posts(array('post__in'=>$postids));
    foreach ($inset_posts as $key => $post) {
        setup_postdata( $post );
        $content .=  '
            <div class="wp-embed-post">
                <a href="'. get_permalink() .'" target="_blank" class="wp-embed-post-img hidden-if-3min" style="background-image:url(' . get_post_thumbnail() . ')"></a>
                    <a href="'. get_permalink() .'" target="_blank"><span class="wp-embed-post-title">' . get_the_title() . '</span></a><em class="wp-embed-post-excerpt">'.wp_trim_words( get_the_content(), 60, '...' ).'</em>
                    <div class="wp-embed-post-meta">
                        <span>' . get_the_time('Y年n月j日') . '</span>
                        <a target="_blank" href="' . get_permalink() . '#comments"> 评论 ' . get_comments_number(). '</a>
                    </div>
            </div>        ';
    }
    wp_reset_postdata();
    return $content;
}
add_shortcode('chopstack_insert_post', 'chopstack_insert_posts');

// 后台文本编辑器增加按钮
function download($atts, $content = null) {
    return '<i class="icon-download"></i><a class="download" href="'.$content.'" rel="external" target="_blank" title="下载地址">下载地址</a>';}

    add_shortcode("download", "download"); 

    add_action('after_wp_tiny_mce', 'bolo_after_wp_tiny_mce');

    function bolo_after_wp_tiny_mce($mce_settings) {
    ?>  
        <script type="text/javascript">  
            QTags.addButton( 'download', '下载按钮', "[download]下载地址[/download]" );
            QTags.addButton('hr', '横线', "<hr />\n");//添加横线
            QTags.addButton('h3', 'H3标签', "<h3>", "</h3>\n"); //添加标题3
            QTags.addButton('h4', 'H4标签', "<h4>", "</h4>\n"); //添加标题4
            QTags.addButton('sb', '上标', "<sup>", "</sup>");
            QTags.addButton('xb', '下标', "<sub>", "</sub>");
            QTags.addButton('shsj', '首行缩进', "&nbsp;&nbsp;");
            QTags.addButton('hc', '回车', "<br />");
            QTags.addButton('jz', '居中', "<center>", "</center>");
            QTags.addButton('mark', '黄字', "<mark>", "</mark>");
            QTags.addButton('xhx', '下划线', "<u>", "</u>");
            QTags.addButton('pre', '代码', "<pre>", "</pre>\n"); //添加代码
            QTags.addButton('embed', '文章引用', "[chopstack_insert_post ids=文章id]");
        function bolo_QTnextpage_arg1() {
        }  
        </script>
    <?php 
}

//压缩html代码 
function wp_compress_html(){
    function wp_compress_html_main ($buffer){
        $initial=strlen($buffer);
        $buffer=explode("<!--wp-compress-html-->", $buffer);
        $count=count ($buffer);
        for ($i = 0; $i <= $count; $i++){
            if (stristr($buffer[$i], '<!--wp-compress-html no compression-->')) {
                $buffer[$i]=(str_replace("<!--wp-compress-html no compression-->", " ", $buffer[$i]));
            } else {
                $buffer[$i]=(str_replace("\t", " ", $buffer[$i]));
                $buffer[$i]=(str_replace("\n\n", "\n", $buffer[$i]));
                $buffer[$i]=(str_replace("\n", "", $buffer[$i]));
                $buffer[$i]=(str_replace("\r", "", $buffer[$i]));
                while (stristr($buffer[$i], '  ')) {
                    $buffer[$i]=(str_replace("  ", " ", $buffer[$i]));
                }
            }
            $buffer_out.=$buffer[$i];
        }
        $final=strlen($buffer_out);   
        $savings=($initial-$final)/$initial*100;   
        $savings=round($savings, 2);   
        $buffer_out.="\n<!--压缩前的大小: $initial bytes; 压缩后的大小: $final bytes; 节约：$savings% -->";   
    return $buffer_out;
}
ob_start("wp_compress_html_main");
}
add_action('get_header', 'wp_compress_html');

//文章内的代码高亮不压缩
function unCompress($content) {
    if(preg_match_all('/(crayon-|<\/pre>)/i', $content, $matches)) {
        $content = '<!--wp-compress-html--><!--wp-compress-html no compression-->'.$content;
        $content.= '<!--wp-compress-html no compression--><!--wp-compress-html-->';
    }
    return $content;
}
add_filter( "the_content", "unCompress");

//移除wp-embed.min.js
function stop_loading_wp_embed_and_jquery() {
    if (!is_admin()) {
        wp_deregister_script('wp-embed');
    }
}
add_action('init', 'stop_loading_wp_embed_and_jquery');