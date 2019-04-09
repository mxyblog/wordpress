<?php
/**
* WordPress Nginx FastCGI缓存清理代码(Nginx-Helper纯代码版) By 张戈博客
* 文章地址：https://zhang.ge/5112.html
* 转载请保留原文出处，谢谢合作！
*/

//初始化配置
$logSwitch  = 0;                  //配置日志开关，1为开启，0为关闭
$logFile    = '/tmp/purge.log';   //配置日志路径
$cache_path = '/tmp/wpcache';     //配置缓存路径

//清理所有缓存(仅管理员) 范例：http://www.domain.com/?purge=all
if ($_GET['purge'] == 'all' && is_user_logged_in()) {
    if( current_user_can( 'manage_options' )) 
    {
        delDirAndFile($cache_path, 0);
    }
}

//缓存清理选项
add_action('publish_post', 'Clean_By_Publish', 99);                   //文章发布、更新清理缓存
add_action('comment_post', 'Clean_By_Comments',99);                   //评论提交清理缓存(不需要可注释)
add_action('comment_unapproved_to_approved', 'Clean_By_Approved',99); //评论审核清理缓存(不需要可注释)

//文章发布清理缓存函数
function Clean_By_Publish($post_ID){
    $url = get_permalink($post_ID);

    cleanFastCGIcache($url);        //清理当前文章缓存
    cleanFastCGIcache(home_url().'/');  //清理首页缓存(不需要可注释此行)
        
    //清理文章所在分类缓存(不需要可注释以下5行)
    if ( $categories = wp_get_post_categories( $post_ID ) ) {
        foreach ( $categories as $category_id ) {
            cleanFastCGIcache(get_category_link( $category_id ));
        }
    }

    //清理文章相关标签页面缓存(不需要可注释以下5行)
    if ( $tags = get_the_tags( $post_ID ) ) {
        foreach ( $tags as $tag ) {
	    cleanFastCGIcache( get_tag_link( $tag->term_id ));
        }
    }
}

// 评论发布清理文章缓存
function Clean_By_Comments($comment_id){
    $comment  = get_comment($comment_id);
    $url      = get_permalink($comment->comment_post_ID);
    cleanFastCGIcache($url);
}

// 评论审核通过清理文章缓存
function Clean_By_Approved($comment)
{
    $url      = get_permalink($comment->comment_post_ID); 
    cleanFastCGIcache($url);
}

//日志记录
function purgeLog($msg)
{
    global $logFile, $logSwitch;
    if ($logSwitch == 0 ) return;
    date_default_timezone_set('Asia/Shanghai');
    file_put_contents($logFile, date('[Y-m-d H:i:s]: ') . $msg . PHP_EOL, FILE_APPEND);
    return $msg;
}

// 缓存文件删除函数
function cleanFastCGIcache($url) {
    $url_data  = parse_url($url);
    global $cache_path;
    if(!$url_data) {
        return purgeLog($url.' is a bad url!' );
    }

    $hash        = md5($url_data['scheme'].'GET'.$url_data['host'].$url_data['path']);
    $cache_path  = (substr($cache_path, -1) == '/') ? $cache_path : $cache_path.'/';
    $cached_file = $cache_path . substr($hash, -1) . '/' . substr($hash,-3,2) . '/' . $hash;
    
    if (!file_exists($cached_file)) {
        return purgeLog($url . " is currently not cached (checked for file: $cached_file)" );
    } else if (unlink($cached_file)) {
        return purgeLog( $url." *** CLeanUP *** (cache file: $cached_file)");
    } else {
        return purgeLog("- - An error occurred deleting the cache file. Check the server logs for a PHP warning." );
    }
}

/**
 * 删除目录及目录下所有文件或删除指定文件
 * 代码出自ThinkPHP：http://www.thinkphp.cn/code/1470.html
 * @param str $path   待删除目录路径
 * @param int $delDir 是否删除目录，1或true删除目录，0或false则只删除文件保留目录（包含子目录）
 * @return bool 返回删除状态
 */
function delDirAndFile($path, $delDir = FALSE) {
    $handle = opendir($path);
    if ($handle) {
        while (false !== ( $item = readdir($handle) )) {
            if ($item != "." && $item != "..")
                is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
        }
        closedir($handle);
        if ($delDir)
            return rmdir($path);
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
        }
    }
}

add_action('set_comment_cookies','coffin_set_cookies',10,3);
function coffin_set_cookies( $comment, $user, $cookies_consent){
   $cookies_consent = true;
   wp_set_comment_cookies($comment, $user, $cookies_consent);
}