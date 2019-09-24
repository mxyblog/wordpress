<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=10,IE=9,IE=8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<title><?php echo get_option('blogname'); if (is_home ()) echo '-'.get_option('blogdescription'); if ($paged > 1) echo '-Page ', $paged; ?></title>
<?php
$sr_1 = 0; $sr_2 = 0; $commenton = 0; 
if( dopt('d_sideroll_b') ){ 
    $sr_1 = dopt('d_sideroll_1');
    $sr_2 = dopt('d_sideroll_2');
}
if( is_singular() ){ 
    if( comments_open() ) $commenton = 1;
}
?>
<script>
window._deel = {name: '<?php bloginfo('name') ?>',url: '<?php echo get_bloginfo("template_url") ?>', ajaxpager: '<?php echo dopt('d_ajaxpager_b') ?>', commenton: <?php echo $commenton ?>, roll: [<?php echo $sr_1 ?>,<?php echo $sr_2 ?>]}
</script>
<?php 
wp_head(); 
if( dopt('d_headcode_b') ) echo dopt('d_headcode'); ?>
<!--[if lt IE 9]><script src="<?php bloginfo('template_url'); ?>/js/html5.js"></script><![endif]-->
</head>
<body <?php body_class(); ?>>

<header id="header" class="header">
<div class="container-inner">
<!--添加部分-->
<div class="g-logo pull-left"><a href="<?php echo site_url(); ?>">
<h1>		
<img alt="<?php bloginfo('name'); ?>" src="<?php echo dopt('d_logo')?dopt('d_logo'):bloginfo('template_url').'/img/logo.png';?>"></h1></a>
</div>

<div class="g_ad_top pull-right ">
<a href="<?php echo dopt('d_top_ad_url')? dopt('d_top_ad_url'):'https://promotion.aliyun.com/ntms/act/ambassador/sharetouser.html?userCode=coywfy8d&utm_source=coywfy8d'; ?>"><img src="<?php echo dopt('d_top_ad')? dopt('d_top_ad'):bloginfo('template_url').'/img/ad_top.jpg'; ?>"></a>
</div>
<!--添加部分-->
</div>

	<div id="nav-header" class="navbar">
		
		<ul class="nav">
			<?php echo str_replace("</ul></div>", "", preg_replace("/<div[^>]*><ul[^>]*>/", "", wp_nav_menu(array('theme_location' => 'nav', 'echo' => false)) )); ?>
<li style="float:right;">
                    <div class="toggle-search"><i class="fa fa-search"></i></div>
<div class="search-expand" style="display: none;"><div class="search-expand-inner"><form method="get" class="searchform themeform" onsubmit="location.href='<?php echo home_url('/search/'); ?>' + encodeURIComponent(this.s.value).replace(/%20/g, '+'); return false;" action="/"><div> <input type="ext" class="search" name="s" onblur="if(this.value=='')this.value='search...';" onfocus="if(this.value=='search...')this.value='';" value="search..."></div></form></div></div>
</li>
		</ul>
	</div>
	</div>
</header>
<section class="container"><div class="speedbar">
		<?php 
		if( dopt('d_sign_b') ){ 
			global $current_user; 
			get_currentuserinfo();
			$uid = $current_user->ID;
			$u_name = get_user_meta($uid,'nickname',true);
		?>
            <div class="pull-right">
				<?php if(is_user_logged_in()){echo '<i class="fa fa-user"></i> '.$u_name.' &nbsp; '; echo ' &nbsp; &nbsp; <i class="fa fa-power-off"></i> ';}else{echo '<i class="fa fa-user"></i> ';}; wp_loginout(); ?>
			</div>
		<?php } ?>
		<div class="toptip"><strong class="text-success"><i class="fa fa-volume-up"></i> </strong> <?php echo dopt('d_tui')?dopt('d_tui'):'欢迎使用yusi主题修改版，主题使用教程访问<a href="https://dedewp.com"> 陌小雨博客</a>'; ?></div>
	</div>
	<?php if( dopt('d_adsite_01_b') ) echo '<div class="banner banner-site">'.dopt('d_adsite_01').'</div>'; ?>