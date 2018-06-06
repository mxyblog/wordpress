<?php
/**
 * 404-未找到相关文章
 *
 */
?>

<!DOCTYPE html>
<html>
<head>
<title><?php wp_title('-', true, 'right'); echo get_option('blogname'); if (is_home ()) echo get_option('blogdescription'); if ($paged > 1) echo '-Page ', $paged; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width">
<style>
body{margin:0;padding:0;font-family:TIBch,'Classic Grotesque W01','Helvetica Neue',Arial,'Hiragino Sans GB',STHeiti,'Microsoft YaHei','WenQuanYi Micro Hei',SimSun,sans-serif}
a,button.submit{color:#6E7173;text-decoration:none;-webkit-transition:all .1s ease-in;-moz-transition:all .1s ease-in;-o-transition:all .1s ease-in;transition:all .1s ease-in}
a:active,a:hover{color:#6E7173}
.body404{position:absolute;height:100%;width:100%;background:#fff;background-size:auto 100%;text-shadow:1px 1px 0 #fff}
.site-name404{margin:0 auto;text-align:center;letter-spacing:2px;font:400 200px/1 “Helvetica Neue”,Helvetica,Arial}
.site-name404 h1{margin:0 0 10px;font-size:50px;line-height:1.2}
.title404 span{font-size:15px;width:2px}
.site-name404 i{font-style:normal}
.title404 p{font-size:20px;line-height:1.5;margin:0;color:#444}
.info404{position:absolute;top:50%;text-align:center;width:100%;margin-top:-160px}
#footer404{margin-top:30px;font-size:10px}
.index404{margin-top:24px;display:inline-block;padding:14px 27px 14px 29px;color:#fff;white-space:nowrap;text-align:center;cursor:pointer;background:#000;line-height:14px;letter-spacing:1px;font-size:14px;-moz-user-select:-moz-none;-webkit-user-select:none;-ms-user-select:none;-o-user-select:none;user-select:none;text-shadow:none}
.index404:hover{background-color:#444;color:#fff}
</style>
</head>
<body>
<div class="body404">
    <div class="info404">
        <header id="header404" class="clearfix">
        <div class="site-name404">
            <i>404</i>
        </div>
        </header>
        <section>
        <div class="title404">
            <p>
                请求的页面不存在
            </p>
        </div>
        <a href="<?php bloginfo('url'); ?>" real="nofollow" class="index404">返回首页</a>
        </section>
        <footer id="footer404">© <?php bloginfo( 'name' ); ?></footer>
    </div>
</div>
</body>
</html>