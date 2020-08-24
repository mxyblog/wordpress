<?php
register_nav_menus(array(
    'top' => '顶部菜单'
));

include 'category_image.php';
include 'do.php';
/**********************************************************************
                            引入后台框架
**********************************************************************/
require_once get_template_directory() .'/inc/cs-framework/cs-framework.php';
define( 'CS_ACTIVE_FRAMEWORK', true ); // default true
define( 'CS_ACTIVE_METABOX', false ); // default true
define( 'CS_ACTIVE_TAXONOMY', false ); // default true
define( 'CS_ACTIVE_SHORTCODE', false ); // default true
define( 'CS_ACTIVE_CUSTOMIZE', false ); // default true
/**********************************************************************
                            引入熊掌号
**********************************************************************/
require_once get_template_directory() .'/inc/xzh.func.php';
/**********************************************************************
                            特色图
**********************************************************************/
add_theme_support( "post-thumbnails" );
add_filter( 'add_image_size', create_function( '', 'return 1;' ) );
add_filter( 'create_fun_core', create_function( '', 'return 1;' ) );
/**********************************************************************
							去除多余代码
**********************************************************************/
add_filter('show_admin_bar', '__return_false');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'locale_stylesheet');
remove_action('wp_head', 'noindex', 1);
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_footer', 'wp_print_footer_scripts');
remove_action('publish_future_post', 'check_and_publish_future_post', 10, 1);
remove_action('template_redirect', 'wp_shortlink_header', 11, 0);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
remove_filter('oembed_response_data', 'get_oembed_response_data_rich', 10, 4);
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');
add_shortcode('reply', 'reply_to_read');
add_filter('pre_site_transient_update_core',create_function('$a',"return null;")); // 关闭核心提示
add_filter('pre_site_transient_update_plugins',create_function('$a',"return null;")); // 关闭插件提示
add_filter('pre_site_transient_update_themes',create_function('$a',"return null;")); // 关闭主题提示
remove_action('admin_init','_maybe_update_core');// 禁止 WordPress 检查更新
remove_action('admin_init','_maybe_update_plugins');// 禁止 WordPress 更新插件
remove_action('admin_init','_maybe_update_themes'); // 禁止 WordPress 更新主题
//禁用文章自动保存
add_action('wp_print_scripts','disable_autosave');
function disable_autosave(){
  	wp_deregister_script('autosave');
}
//禁用文章修订版本
add_filter( 'wp_revisions_to_keep', 'specs_wp_revisions_to_keep', 10, 2 );
function specs_wp_revisions_to_keep( $num, $post ) {
  	return 0;
}
// 阻止站内文章互相Pingback
function theme_noself_ping( &$links ) {
    $home = get_theme_mod( 'home' );
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action('pre_ping','theme_noself_ping');
/**********************************************************************
							静态文件
**********************************************************************/
add_action( 'wp_enqueue_scripts', 'SuStatic' );
function SuStatic() {
	wp_register_script( 'owlcarousel', get_template_directory_uri() . '/static/js/owl.carousel.min.js', array(), true );
	wp_register_script( 'wow', get_template_directory_uri() . '/static/js/wow.min.js', array(), true );
	wp_register_script( 'main', get_template_directory_uri() . '/static/js/main.js', array(), true );
    wp_register_script( 'comment-reply', get_template_directory_uri() . '/static/js/comment-reply.min.js', array(), true );
	wp_register_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/static/js/theia-sticky-sidebar.min.js', array(), true );
    wp_register_script( 'lightbox', get_template_directory_uri() . '/static/js/lightbox.js', array(), true );
	wp_register_script( 'rocket-loader', get_template_directory_uri() . '/static/js/rocket-loader.min.js', array(), true );


    if ( !is_admin() ) {
        wp_enqueue_style( 'bootstrap' );
        wp_enqueue_style( 'animate' );
        wp_enqueue_style( 'lightbox' );
        wp_enqueue_style( 'styles' );
        wp_enqueue_style( 'styleMin' );
        wp_enqueue_style( 'style' );
        wp_enqueue_script( 'owlcarousel' );
		wp_enqueue_script( 'theia-sticky-sidebar' );
		wp_enqueue_script( 'wow' );
        wp_enqueue_script( 'lightbox' );
		wp_enqueue_script( 'main' );
		if (is_single()) {
			wp_enqueue_script( 'comment-reply' );
		}
		wp_enqueue_script( 'rocket-loader' );

	}
    wp_enqueue_style( 'iconfont', get_template_directory_uri() . '/static/css/iconfont.css');
    wp_enqueue_style( 'styleMin', get_template_directory_uri() . '/static/css/style.min.css');
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/static/css/bootstrap.min.css');
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/static/css/animate.css');
    wp_enqueue_style( 'lightbox', get_template_directory_uri() . '/static/css/lightbox.css');
    wp_enqueue_style( 'styles', get_template_directory_uri() . '/static/css/style.css');
    wp_enqueue_style( 'style', get_stylesheet_uri());
    wp_localize_script( 'main', 'stayma_url',
        array(
            "url_ajax" => admin_url("admin-ajax.php")
        )
    );
}	

/**********************************************************************
							评论模板
**********************************************************************/
function wpmee_comment($comment, $args, $depth) {
    global $post;
    $commentcountText='';
    $GLOBALS['comment'] = $comment;

?>
<div <?php comment_class($GLOBALS['wow_comments']); ?> class="comment even thread-even depth-1" id="comment-<?php comment_ID() ?>">
    <div class="comments-details">
        <div class="author-image">
            <img alt='' src='<?php echo get_avatar_url( $comment ); ?>' class='avatar avatar-50 photo' height='50' width='50' />
        </div>
        <div class="comment-text">
            <div class="c-title">
                <h4>
                    <?php comment_author_link() ?>
                </h4>
            </div>
            <div class="c-content">
                    <?php comment_text() ?>
					<?php if ( $comment->comment_approved == '0' ) : ?>
					<font style="color:#C00; font-style:inherit; margin: 0px 0 15px 0;display: block;">您的评论正在等待审核中...</font>
	            	<?php endif; ?>
            </div>
            <div class="reply">
                <span>
                    <?php echo get_comment_time('Y-m-d H:i') ?>
                </span>
                    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => "@TA"))) ?>
            </div>
        </div>
    </div>
<?php }
function wpmee_end_comment() {
    echo '</div>';
};

/**********************************************************************
                            邮件通知
**********************************************************************/
function sirius_comment_approved($comment) {
    if(is_email($comment->comment_author_email)) {
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
        $to = trim($comment->comment_author_email);
        $post_link = get_permalink($comment->comment_post_ID);
        $subject = '[通知]您的留言已经通过审核';
        $message = '
            <div style="background:#ececec;width: 100%;padding: 50px 0;text-align:center;">
            <div style="background:#fff;width:750px;text-align:left;position:relative;margin:0 auto;font-size:14px;line-height:1.5;">
                    <div style="zoom:1;padding:25px 40px;background:#518bcb; border-bottom:1px solid #467ec3;">
                        <h1 style="color:#fff; font-size:25px;line-height:30px; margin:0;"><a href="' . get_option('home') . '" style="text-decoration: none;color: #FFF;">' . htmlspecialchars_decode(get_option('blogname'), ENT_QUOTES) . '</a></h1>
                    </div>
                <div style="padding:35px 40px 30px;">
                    <h2 style="font-size:18px;margin:5px 0;">Hi ' . trim($comment->comment_author) . ':</h2>
                    <p style="color:#313131;line-height:20px;font-size:15px;margin:20px 0;">您有一条留言通过了管理员的审核并显示在文章页面，摘要信息请见下表。</p>
                        <table cellspacing="0" style="font-size:14px;text-align:center;border:1px solid #ccc;table-layout:fixed;width:500px;">
                            <thead>
                                <tr>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf;" width="280px;">文章</th>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf;" width="270px;">内容</th>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf;" width="110px;" >操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">《' . get_the_title($comment->comment_post_ID) . '》</td>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">'. trim($comment->comment_content) . '</td>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><a href="'.get_comment_link( $comment->comment_ID ).'" style="color:#1E5494;text-decoration:none;vertical-align:middle;" target="_blank">查看留言</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                    <div style="font-size:13px;color:#a0a0a0;padding-top:10px">该邮件由系统自动发出，如果不是您本人操作，请忽略此邮件。</div>
                    <div class="qmSysSign" style="padding-top:20px;font-size:12px;color:#a0a0a0;">
                        <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0;">' . htmlspecialchars_decode(get_option('blogname'), ENT_QUOTES) . '</p>
                        <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0;"><span style="border-bottom:1px dashed #ccc;" t="5" times="">' . date("Y年m月d日",time()) . '</span></p>
                    </div>
                </div>
            </div>
        </div>';
        $from = "From: \"" . htmlspecialchars_decode(get_option('blogname'), ENT_QUOTES) . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
    }
}
function comment_mail_notify($comment_id) {
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if (($parent_id != '') && ($spam_confirmed != 'spam')) {
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '[通知]您的留言有了新的回复';
        $message = '
            <div style="background:#ececec;width: 100%;padding: 50px 0;text-align:center;">
            <div style="background:#fff;width:750px;text-align:left;position:relative;margin:0 auto;font-size:14px;line-height:1.5;">
                    <div style="zoom:1;padding:25px 40px;background:#518bcb; border-bottom:1px solid #467ec3;">
                        <h1 style="color:#fff; font-size:25px;line-height:30px; margin:0;"><a href="' . get_option('home') . '" style="text-decoration: none;color: #FFF;">' . htmlspecialchars_decode(get_option('blogname'), ENT_QUOTES) . '</a></h1>
                    </div>
                <div style="padding:35px 40px 30px;">
                    <h2 style="font-size:18px;margin:5px 0;">Hi ' . trim(get_comment($parent_id)->comment_author) . ':</h2>
                    <p style="color:#313131;line-height:20px;font-size:15px;margin:20px 0;">您有一条留言有了新的回复，摘要信息请见下表。</p>
                        <table cellspacing="0" style="font-size:14px;text-align:center;border:1px solid #ccc;table-layout:fixed;width:500px;">
                            <thead>
                                <tr>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf;" width="235px;">原文</th>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf;" width="235px;">回复</th>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf;" width="100px;">作者</th>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf;" width="90px;" >操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">' . trim(get_comment($parent_id)->comment_content) . '</td>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">'. trim($comment->comment_content) . '</td>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">' . trim($comment->comment_author) . '</td>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><a href="'.get_comment_link( $comment->comment_ID ).'" style="color:#1E5494;text-decoration:none;vertical-align:middle;" target="_blank">查看回复</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                    <div style="font-size:13px;color:#a0a0a0;padding-top:10px">该邮件由系统自动发出，如果不是您本人操作，请忽略此邮件。</div>
                    <div class="qmSysSign" style="padding-top:20px;font-size:12px;color:#a0a0a0;">
                        <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0;">' . htmlspecialchars_decode(get_option('blogname'), ENT_QUOTES) . '</p>
                        <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0;"><span style="border-bottom:1px dashed #ccc;" t="5" times="">' . date("Y年m月d日",time()) . '</span></p>
                    </div>
                </div>
            </div>
        </div>';
        $from = "From: \"" . htmlspecialchars_decode(get_option('blogname'), ENT_QUOTES) . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
    }
}
add_action('comment_post', 'comment_mail_notify');

/**********************************************************************
                            回复可见
**********************************************************************/

function reply_to_read($atts, $content = null) {
    extract(shortcode_atts(array(
        "notice" => '<div class="need_reply"><a href="#commentBox">此处内容隐藏，评论回复可见！</a></div>'
    ) , $atts));
    $email = null;
    $user_ID = (int)wp_get_current_user()->ID;
    if ($user_ID > 0) {
        $email = get_userdata($user_ID)->user_email;
        //对博主直接显示内容
        $admin_email = ''; //博主Email
        if ($email == $admin_email) {
            return $content;
        }
    } else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {
        $email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]);
    } else {
        return $notice;
    }
    if (empty($email)) {
        return $notice;
    }
    global $wpdb;
    $post_id = get_the_ID();
    $query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
    if ($wpdb->get_results($query)) {
        return do_shortcode($content);
    } else {
        return $notice;
    }
}
add_shortcode('need_reply', 'reply_to_read');

/**********************************************************************
                            阅读次数
**********************************************************************/
function get_post_views ($post_id) {  
   
    $count_key = 'views';  
    $count = get_post_meta($post_id, $count_key, true);  
   
    if ($count == '') {  
        delete_post_meta($post_id, $count_key);  
        add_post_meta($post_id, $count_key, '0');  
        $count = '0';  
    }  
   
    echo number_format_i18n($count);  
   
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
/**********************************************************************
                            特色图
**********************************************************************/
function post_thumbnail_src(){
    global $post;
    $post_thumbnail_src='';
    if( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
        $post_thumbnail_src = $thumbnail_src[0];
    } else {
        $post_thumbnail_src = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        if(!empty($matches[1][0])){
            $post_thumbnail_src = $matches[1][0];   //获取该图片 src
        }else{
            $post_thumbnail_src = false;
        }
    };
    return $post_thumbnail_src;
}
/**********************************************************************
                            QQ信息获取
**********************************************************************/
add_action( 'init', 'ajax_qq_info' );
function ajax_qq_info() {
    if( $_GET['action'] == 'ajax_qq_info' && 'GET' == $_SERVER['REQUEST_METHOD'] ) {
        $qqNum = isset($_GET['qqNum']) ? addslashes(trim($_GET['qqNum'])) : '';
        $infos = file_get_contents('http://r.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?g_tk=1518561325&uins='.$qqNum);
        $infos = iconv("GB2312", "UTF-8", $infos);
        $pattern = '/portraitCallBack\((.*)\)/is';
        preg_match($pattern, $infos, $result);
        echo $result[1];
        die();
    }   
}

/**********************************************************************
                            主人登录时间
**********************************************************************/
add_action( 'wp_login', 'set_last_login' );
function set_last_login( $login ) {
    $time_old = get_user_meta( 1, 'last_login' )[0];
    if (!empty($time_old)) update_user_meta( 1, 'last_login_old', $time_old + 8*3600 );
    update_user_meta( 1, 'last_login', time() );
}
function last_login() {
    $time = get_user_meta( 1, 'last_login' )[0];
    $time = (int) substr($time, 0, 10);  
    $int = time() - $time;
    $str = '';
    if ($int <= 60) {
        $str = sprintf('刚刚', $int);
    } elseif ($int < 3600) {
        $str = sprintf('%d分钟前', floor($int / 60));
    } elseif ($int < 86400) {
        $str = sprintf('%d小时前', floor($int / 3600));
    } elseif ($int < 2592000) {
        $str = sprintf('%d天前', floor($int / 86400));
    } else {
        $str = date('Y-m-d H:i:s', $time);
    }

    // if (is_user_logged_in()) {
    //     echo '上次登录日期 '.date('Y.m.d H:i', get_user_meta( 1, 'last_login_old' )[0]).'';
    //     echo '<li class="item active">本次登录已记录 '.date('Y.m.d H:i', $time + 8*3600).'</li>';
    // } else {
        echo '主人翁在'.$str.'来过。';
    // }
}


/**
 * 外部链接自动加nofollow
 */
add_filter( 'the_content', 'link_nofollow');
function link_nofollow( $content ) {
    $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
    if( preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER) ) {
        if( ! empty($matches) ) {
            $srcUrl = get_option( 'siteurl' );
            for ( $i=0; $i < count($matches); $i++ ){
                $tag = $matches[$i][0];
                $tag2 = $matches[$i][0];
                $url = $matches[$i][0];
                $noFollow = '';
                $pattern = '/target\s*=\s*"\s*_blank\s*"/';
                preg_match( $pattern, $tag2, $match, PREG_OFFSET_CAPTURE );
                if( count($match) < 1 ) $noFollow .= ' target="_blank" ';
                $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
                preg_match( $pattern, $tag2, $match, PREG_OFFSET_CAPTURE );
                if( count($match) < 1 ) $noFollow .= ' rel="nofollow" ';
                $pos = strpos( $url, $srcUrl );
                if ( $pos === false ) {
                    $tag = rtrim ( $tag, '>' );
                    $tag .= $noFollow.'>';
                    $content = str_replace( $tag2, $tag, $content );
                }
            }
        }
    }

    $content = str_replace( ']]>', ']]>', $content );
    return $content;
}
/**
 * 图片自动alt标签
 */
add_filter('the_content', 'auto_images_alt');
function auto_images_alt($content) {
    global $post;
    $pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
    $replacement = '<a$1href=$2$3.$4$5 alt="'.$post->post_title.'" title="'.$post->post_title.'"$6>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
/**
 * 搜索结果排除页面
 */
add_filter('pre_get_posts','wpjam_exclude_page_from_search');
function wpjam_exclude_page_from_search($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}


/**********************************************************************
                            点赞
**********************************************************************/
add_action('wp_ajax_nopriv_bigfa_like', 'bigfa_like');
add_action('wp_ajax_bigfa_like', 'bigfa_like');
function bigfa_like(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
    $bigfa_raters = get_post_meta($id,'bigfa_ding',true);
    $expire = time() + 99999999;
    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
    setcookie('bigfa_ding_'.$id,$id,$expire,'/',$domain,false);
    if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
        update_post_meta($id, 'bigfa_ding', 1);
    }
    else {
            update_post_meta($id, 'bigfa_ding', ($bigfa_raters + 1));
        }
    echo get_post_meta($id,'bigfa_ding',true);
    }
    die;
}
/**********************************************************************
                            文章目录
**********************************************************************/
function article_index() {
    $content = get_post(get_the_ID())->post_content;
    $matches = array();
    $ul_li = '';
    $r = "/<h3>([^<]+)<\/h3>/im";
    if(preg_match_all($r, $content, $matches)) {
        foreach($matches[1] as $num => $title) {
        $ul_li .= '<li><a href="#title-'.$num.'" title="'.$title.'">'.$title."</a></li>\n";
        }
        $content1 = "\n<div id=\"article-index\" class=\"article-index d-none d-lg-block d-xl-block\">
        <div class=\"theiaStickySidebar\">
        <ul id=\"index-ul\" class=\"index-ul\">\n" . $ul_li . "</ul>
        </div>
        </div>\n";
        }
        echo $content1;
}

function article_index_h($content) {
    $matches = array();
    $r = "/<h3>([^<]+)<\/h3>/im";
    if(preg_match_all($r, $content, $matches)) {
        foreach($matches[1] as $num => $title) {
            $content = str_replace($matches[0][$num], '<h3 id="title-'.$num.'">'.$title.'</h3>', $content);
        }
    }
    return $content;
}
add_filter( "the_content", "article_index_h" );


/**********************************************************************
                            图片灯箱添加
**********************************************************************/

add_filter('the_content', 'pirobox_gall_replace');
function pirobox_gall_replace ($content){ 
    global $post;
    $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
    $replacement = '<a$1href=$2$3.$4$5 rel="lightbox"$6>$7</a>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
} 

/**********************************************************************
                            维护模式
**********************************************************************/
if( cs_get_option( 'plus_weihu' ) ) add_action( 'get_header', 'wp_maintenance_mode' );
function wp_maintenance_mode() {
    if( !current_user_can( 'edit_themes' ) || !is_user_logged_in() )
        wp_die(
            ''.cs_get_option( 'plus_maintenance_notice' ).'',
            ''.cs_get_option( 'plus_maintenance_title' ).'',
            array( 'response' => '503' )
        );
}
/**********************************************************************
                        修改原始登录入口
**********************************************************************/
if ( cs_get_option( 'plus_hide_login' ) )
    add_action('login_enqueue_scripts','login_protection');
function login_protection() {
    if( $_GET[''.cs_get_option('plus_login_prefix').''] != ''.cs_get_option('plus_login_suffix').'' )
        header('Location: '.cs_get_option('plus_login_link').'');
}
/**********************************************************************
                    过滤HTTP 1.0的登录POST请求
**********************************************************************/
if ( cs_get_option( 'plus_login_http' ) ) 
    add_action( 'login_init','wlp_filter_http' );
function wlp_filter_http() {
    if( preg_match('/1\.0/',$_SERVER['SERVER_PROTOCOL']) ) { 
        wlp_forbidden();
    }
}
/**********************************************************************
                    SMTP发邮件
**********************************************************************/
if ( cs_get_option( 'plus_site_smtp' ) ) add_action( 'phpmailer_init', 'mail_smtp' );
function mail_smtp( $phpmailer ) {
    $phpmailer->IsSMTP();
    $phpmailer->FromName = cs_get_option( 'plus_smtp_name' );
    $phpmailer->From = cs_get_option( 'plus_smtp_email' );
    $phpmailer->Host = cs_get_option( 'plus_smtp_server' );
    $phpmailer->Port = cs_get_option( 'plus_smtp_port' );
    $phpmailer->SMTPSecure = '';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Username = cs_get_option( 'plus_smtp_email' );
    $phpmailer->Password = cs_get_option( 'plus_smtp_password' );
}
/**********************************************************************
                    百度主动推送
**********************************************************************/
if ( cs_get_option('plus_baidu_submit') ) {
    date_default_timezone_set('Asia/Shanghai');
    add_action( 'publish_post', 'publish_bd_submit', 999 );
}
function publish_bd_submit( $post_ID ) {
    global $post;
    $bd_submit_enabled = true;
    $bd_submit_site = cs_get_option('plus_baidu_link');
    $bd_submit_token = cs_get_option('plus_baidu_key');
    $api = "http://data.zz.baidu.com/urls?site=".$bd_submit_site."&token=".$bd_submit_token;
    if( $post->post_status != "publish" ) {
        $url = get_permalink($post_ID);
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $url,
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain')
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        $time = time();
        $file =  THEME_DIR .'/baiduSubmit.txt'; //生成日志文件
        if( date('Y-m-d', filemtime($file)) != date('Y-m-d') ) {
            $handle = fopen($file,"w");
        }
        else {
            $handle = fopen($file,"a");
        }
        $resultMessage = "";
        if( $result['message'] ) {
           $resultMessage = date('Y-m-d G:i:s',$time)."\n提交失败：".$result['message'].":\n网址：".$url."\n\n";
        }
        if( $result['success'] ){
            $resultMessage = date('Y-m-d G:i:s',$time)."\n提交成功：".":".$url."\n\n";
        }
        fwrite($handle, $resultMessage);
        fclose($handle);
    }
}

/**********************************************************************
                            自定义登陆页面
**********************************************************************/
function uazoh_custom_login_page() {
    echo'<style type="text/css">#login form {-webkit-box-shadow:0 2px 5px 0 rgba(146,146,146,.1);-moz-box-shadow:0 2px 5px 0 rgba(146,146,146,.1);box-shadow:0 8px 25px 0 rgba(146,146,146,0.21);}#login form .forgetmenot{float:none}
    #login form p.submit{padding: 20px 0 0;}#login form p.submit .button-primary{float:none;background-color: #494949;font-weight: bold;color: #fff;width: 100%;height: 40px;border-width: 0;border-color:none}#login form input{box-shadow:none!important;outline:none!important}</style>';
    }
    add_action('login_head', 'uazoh_custom_login_page');
/**********************************************************************
                    根据上传时间重命名文件
**********************************************************************/
if (cs_get_option( 'plus_upload_filter' )){
    add_filter('wp_handle_upload_prefilter', 'custom_upload_filter' );
        function custom_upload_filter( $file ){
            $info = pathinfo($file['name']);
            $ext = $info['extension'];
            $filedate = date('YmdHis').rand(10,99);//为了避免时间重复，再加一段2位的随机数
            $file['name'] = $filedate.'.'.$ext;
            return $file;
        }
    }
/**********************************************************************
                    搜索结果排除所有页面
**********************************************************************/
function search_filter_page($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','search_filter_page');
/**********************************************************************
                    评论头像
**********************************************************************/
if( !cs_get_option('gravatar_url') || cs_get_option('gravatar_url') == 'ssl' ){
    add_filter('get_avatar', '_get_ssl2_avatar');
}else if( cs_get_option('gravatar_url') == 'duoshuo' ){
    add_filter('get_avatar', '_duoshuo_get_avatar', 10, 3);
}

//官方Gravatar头像调用ssl头像链接
function _get_ssl2_avatar($avatar) {
    $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2&d=mm" class="avatar avatar-$2" height="50" width="50">',$avatar);
    return $avatar;
}

//多说官方Gravatar头像调用
function _duoshuo_get_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cn.gravatar.com", $avatar);
    return $avatar;
}



/**********************************************************************
                    SEO优化
**********************************************************************/



//add meta boxes
add_action('add_meta_boxes','web589_post_meta_box');
function web589_post_meta_box(){
    add_meta_box('web589_post_meta_box','自定义SEO设置','Web589Meta_postmeta_form','post','normal','low');
    add_meta_box('web589_post_meta_box','自定义SEO设置','Web589Meta_postmeta_form','page','normal','low');
}


//add meta form
function Web589Meta_postmeta_form(){
    include_once('inc/singular-form.php');
}


//save meta
add_action('save_post','Web589Meta_save_post_meta');
function Web589Meta_save_post_meta($id){
    if( isset($_POST['meta_save']) && $_POST['meta_save']=='on'){
        $title='title';
        $keywords='keywords';
        $description='description';
        $metas='code';      
        $val=array(
            $title=>$_POST[$title],
            $keywords=>$_POST[$keywords],
            $description=>$_POST[$description],
            $metas=>$_POST[$metas],
        );
        update_post_meta($id,'_web589_singular_meta',$val);
    }
}


//datas
function Web589Meta_datas(){
    $datas=array(
        'singular'=>array(
            '_aioseop_title',
            '_aioseop_keywords',
            '_aioseop_description',
            '_web589_head_code'
        ),
    );
    return $datas;
}


//add cat metabox
add_action('edit_category_form','web589_cat_meta_box');
function web589_cat_meta_box(){
    if( isset($_GET['tag_ID']) && $_GET['tag_ID']!=0 && $_GET['taxonomy']=='category' ) include_once('inc/cat-form.php');
}
add_action('edit_category','web589_save_cat_meta');
function web589_save_cat_meta(){    
    if( isset($_POST['action']) && isset($_POST['taxonomy']) && $_POST['action']=='editedtag' && $_POST['taxonomy']=='category' ){
        update_option('cat_meta_key_'.$_POST['tag_ID'],array('page_title'=>$_POST['cat_page_title'],'description'=>$_POST['cat_description'],'metakey'=>$_POST['cat_keywords'],'metas'=>$_POST['cat_metas']));
    }
}

//add tag metabox
add_action('edit_tag_form','web589_tag_meta_box');
function web589_tag_meta_box(){
    if( $_GET['taxonomy']=='post_tag' && $_GET['tag_ID']!=0 ) include_once('inc/tag-form.php');
}
add_action('admin_init','web589_save_tag_meta');
function web589_save_tag_meta(){    
    if( isset($_POST['action']) && isset($_POST['taxonomy']) && $_POST['action']=='editedtag' && $_POST['taxonomy']=='post_tag' ){
        update_option('tag_meta_key_'.$_POST['tag_ID'],array('page_title'=>$_POST['tag_page_title'],'description'=>$_POST['tag_description'],'metakey'=>$_POST['tag_keywords'],'metas'=>$_POST['tag_metas']));
    }
}


//add meta action
add_action('wp_head','web589_meta_action');
function web589_meta_action(){
    $data=Web589Meta_datas();
    
    $pages=get_query_var('page');
    if( (is_single() || is_page()) && $pages<2 ){
        $id=get_the_ID();
        $switch=get_option('aioseop_options');
        $tag = '';
        $tags=get_the_tags();
        if( $tags ){
            foreach($tags as $val){
                $tag.=','.$val->name;
            }
        }
        $tag=ltrim($tag,',');
        $meta=get_post_meta($id,'_web589_singular_meta',true);
        $key_meta= isset($meta['keywords']) ? $meta['keywords'] : '';
        $des_meta=isset($meta['description']) ? $meta['description'] : '';
        $pts=get_post($id);
        $pt=preg_replace('/\s+/','',strip_tags($pts->post_content));
        $num = cs_get_option('web589_auto_description_num') ? (int) cs_get_option('web589_auto_description_num') : 0;
        $excerpt=mb_strimwidth($pt,0,$num, '', get_bloginfo( 'charset' ) );
        
        if( empty($key_meta) && cs_get_option('web589_auto_keywords')  && isset($tag) ) $keywords=$tag;
        else $keywords=$key_meta;
        if( empty($des_meta) && cs_get_option('web589_auto_description') ) $description=$excerpt;
        else $description=$des_meta;
        if($keywords){  
            echo '<meta name="keywords" content="'.$keywords.'" />';
            echo "\n";
        }
        if($description){   
            echo '<meta name="description" content="'.esc_attr($description).'" />';
            echo "\n";
        }
    } 
    
    if( (is_home() || is_front_page()) && !is_paged() ){
        $val=get_option('aioseop_options');
        $keywords=cs_get_option('aiosp_home_keywords');
        $description=cs_get_option('aiosp_home_description');
        $metas=cs_get_option('aiosp_home_metas');
        if($keywords){  
            echo '<meta name="keywords" content="'.$keywords.'" />';
            echo "\n";
        }
        if($description){
            echo '<meta name="description" content="'.esc_attr(stripslashes($description)).'" />';
            echo "\n";
        }   
    }
    
    if(is_category() && !is_paged()){
        $cat_id=get_query_var('cat');
        $val=get_option('cat_meta_key_'.$cat_id);
        $keywords=$val['metakey'];
        $description=$val['description'];
        $metas=$val['metas'];
        if($keywords){
            echo '<meta name="keywords" content="'.$keywords.'" />';
            echo "\n";
        }
        if($description){
            echo '<meta name="description" content="'.esc_attr(stripslashes($description)).'" />';
            echo "\n";
        }
    }

    if( is_tax('special') && !is_paged() ){
        $queried_object = get_queried_object(); 
        $term_id = $queried_object->term_id;
        $term_description = get_term_meta( $term_id, 'suxing_term_description', true );
        $keywords   = get_term_meta( $term_id, 'suxing_term_keywords', true );
        $description   = ( isset( $term_description ) && !empty( $term_description ) ? $term_description : $queried_object->description );
        if($keywords){
            echo '<meta name="keywords" content="'.$keywords.'" />';
            echo "\n";
        }
        if($description){
            echo '<meta name="description" content="'.esc_attr(stripslashes($description)).'" />';
            echo "\n";
        }
    }
    
    if(is_tag() && !is_paged()){
        $tag_id=get_query_var('tag_id');
        $val=get_option('tag_meta_key_'.$tag_id);
        $keywords=$val['metakey'];
        $description=$val['description'];
        $metas=$val['metas'];
        if($keywords){
            echo '<meta name="keywords" content="'.$keywords.'" />';
            echo "\n";
        }
        if($description){
            echo '<meta name="description" content="'.esc_attr(stripslashes($description)).'" />';
            echo "\n";
        }   
    }   
}

//wp title filter
add_filter( 'wp_title', 'dxseo_title_filter', 10, 2 );
function dxseo_title_filter( $title, $sep ){
    global $paged, $page, $post;
    $option = get_option( 'aioseop_options' );
    $data = Web589Meta_datas();
    $sep = cs_get_option('dxseo_title_sep') ? cs_get_option('dxseo_title_sep'): ' - ';
    if( is_single() || is_page() ){
        $meta=get_post_meta($post->ID,'_web589_singular_meta',true);
        $title = ( isset($meta['title']) && !empty($meta['title']) ) ? $meta['title'] : get_the_title( $post->ID );
    }
    else if( is_home() || is_front_page() ){
        $title = ( cs_get_option('aiosp_home_title') && !empty(cs_get_option('aiosp_home_title') )) ? cs_get_option('aiosp_home_title') : get_bloginfo('name').$sep.get_bloginfo('description');
    }
    else if(is_category()){
        $cat_id=get_query_var('cat');
        $val=get_option('cat_meta_key_'.$cat_id);
        $title = ( isset($val['page_title']) && !empty($val['page_title']) ) ? $val['page_title'] : get_cat_name($cat_id);
    }
    else if(is_tag()){
        $tag_id=get_query_var('tag_id');
        $val=get_option('tag_meta_key_'.$tag_id);
        $title = ( isset($val['page_title']) && !empty($val['page_title']) ) ? $val['page_title'] : single_tag_title( '', false );
    }
    else if( is_tax('special') ){
        $queried_object = get_queried_object(); 
        $term_id = $queried_object->term_id;
        $term_title = get_term_meta( $term_id, 'suxing_term_title', true );
        $title = ( isset( $term_title ) && !empty( $term_title ) ? $term_title : $queried_object->name );
    }
    else if( is_author() && ! is_post_type_archive() ){
        $author = get_queried_object();
        if ( $author ) {
            $title = $author->display_name;
        }
    }
    else if( is_search() ) {
        $title = "搜索结果：".get_query_var( 's' );
    }
    else if ( is_404() ) {
        $title = __( 'Page not found' );
    }
    
    if( cs_get_option('dxseo_title_suffix') && cs_get_option('dxseo_title_suffix')  && !is_home() && !is_front_page() )
        $title .= $sep.get_bloginfo( 'name' );
    if ( ( $paged >= 2 || $page >= 2 ) && cs_get_option('dxseo_title_paged') && cs_get_option('dxseo_title_paged')  )
        $title = $title.$sep.sprintf( '第 %s 页', max( $paged, $page ) );
    $tailed = isset($option['dxseo_title_tail']) ? $option['dxseo_title_tail'] : '';
    return $title.$tailed;
}


//add wp_head action
add_action('wp_head','web589_custom_code');
function web589_custom_code(){
    if( is_single() || is_page() ){
        $meta=get_post_meta(get_the_ID(),'_web589_singular_meta',true);
        if( isset($meta['code']) && $meta['code'] ){
            echo $meta['code']."\n";
        }
    }
    if( is_home() || is_front_page() ){
        $val=get_option('aioseop_options');
        $metas=cs_get_option('aiosp_home_metas');
        if( isset($metas) && $metas ){
            echo stripslashes($metas);
            echo "\n";  
        }
    }
    if(is_category()){
        $cat_id=get_query_var('cat');
        $val=get_option('cat_meta_key_'.$cat_id);
        $metas=$val['metas'];
        if( isset( $metas ) && $metas){
            echo stripslashes($metas);
            echo "\n";  
        }
    }
    if(is_tag()){
        $tag_id=get_query_var('tag_id');
        $val=get_option('tag_meta_key_'.$tag_id);
        $metas=$val['metas'];
        if( isset($metas) && $metas ){
            echo stripslashes($metas);
            echo "\n";  
        }
    }
}

//new special

add_action( 'special_edit_form_fields', 'suxing_edit_term_seo_field' );

function suxing_edit_term_seo_field( $term ) {

    $title   = get_term_meta( $term->term_id, 'suxing_term_title', true );
    $keywords   = get_term_meta( $term->term_id, 'suxing_term_keywords', true );
    $description   = get_term_meta( $term->term_id, 'suxing_term_description', true );

    ?>

        <tr class="form-field suxing-term-seo-wrap">
            <th scope="row"><label for="suxing-term-title">SEO自定义标题</label></th>
            <td>
                <input type="text" name="suxing_term_title" id="suxing-term-title" value="<?php echo esc_attr( $title ); ?>" />
            </td>
        </tr>

        <tr class="form-field suxing-term-seo-wrap">
            <th scope="row"><label for="suxing-term-keywords">SEO自定义关键词</label></th>
            <td>
                <input type="text" name="suxing_term_keywords" id="suxing-term-keywords" value="<?php echo esc_attr( $keywords ); ?>" />
            </td>
        </tr>

        <tr class="form-field suxing-term-seo-wrap">
            <th scope="row"><label for="suxing-term-description">SEO自定义描述</label></th>
            <td>
                <textarea name="suxing_term_description" id="suxing-term-description"><?php echo esc_attr( $description ); ?></textarea>
            </td>
        </tr>


    <?php echo wp_nonce_field( basename( __FILE__ ), 'suxing_term_seo_nonce' );
}

add_action( 'create_special', 'suxing_save_term_seo' );
add_action( 'edit_special',   'suxing_save_term_seo' );

function suxing_save_term_seo( $term_id ) {
    if ( ! isset( $_POST['suxing_term_seo_nonce'] ) || ! wp_verify_nonce( $_POST['suxing_term_seo_nonce'], basename( __FILE__ ) ) )
        return;

    $title = isset( $_POST['suxing_term_title'] ) ? $_POST['suxing_term_title'] : '';
    $keywords = isset( $_POST['suxing_term_keywords'] ) ? $_POST['suxing_term_keywords'] : '';
    $description = isset( $_POST['suxing_term_description'] ) ? $_POST['suxing_term_description'] : '';

    if ( '' === $title ) {
        delete_term_meta( $term_id, 'suxing_term_title' );
    } else {
        update_term_meta( $term_id, 'suxing_term_title', $title );
    }
    if ( '' === $keywords ) {
        delete_term_meta( $term_id, 'suxing_term_keywords' );
    } else {
        update_term_meta( $term_id, 'suxing_term_keywords', $keywords );
    }
    if ( '' === $description ) {
        delete_term_meta( $term_id, 'suxing_term_description' );
    } else {
        update_term_meta( $term_id, 'suxing_term_description', $description );
    }
}

