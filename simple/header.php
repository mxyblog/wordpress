<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php $options=get_option('options'); ?>

    <title><?php if ( is_home() ) {bloginfo('name');}    
    elseif ( is_category() ) {single_cat_title(); echo " 丨 "; bloginfo('name');}       
    elseif (is_single() || is_page() ) {single_post_title(); echo " 丨 "; bloginfo('name');}      
    elseif (is_search() ) {echo "搜索结果"; echo " 丨 "; bloginfo('name');}   
    elseif ( is_author() ) {_e('会员');_e(trim(wp_title('',0)));_e('的个人中心 - ');bloginfo('name'); }    
    elseif (is_404() ) {echo '404-页面未找到!';}       
    else {wp_title('',true);} ?> </title>
    <meta name="HandheldFriendly" content="True" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
	<?php if ($options['favicon']) {
		echo '<link rel="shortcut icon" href="'.$options['favicon'].'">';
	}else{
		echo '<link rel="shortcut icon" href="'.get_bloginfo('template_url').'/images/favicon.ico">';
	}
	?>

    <link rel="stylesheet" type="text/css" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css">  
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>"/>
	
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<meta name="keywords" content="<?php echo $options['keywords']; ?>" />
	<meta name="description" content="<?php echo $options['description']; ?>" />
	<?php wp_head(); ?>
</head>
<body>
<!-- 搜索框 -->
<form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>">
	<span class="search-close">&times;</span>
	<label>
		<input type="search" class="search-field" placeholder="请输入关键字搜索" value="" name="s" autocomplete="off">
	</label>
	<input type="submit" class="search-submit" value="搜索">
</form>

<!-- banner -->
<div class="banner" style="background: url(<?php echo $options['banner'];?>);">
	<!-- 菜单按钮 -->
	<!-- <div class="menu menuicon hidden-xs">
		<i class="fa fa-bars"></i>
	</div> -->
	<!-- header -->
	<div class="header container">
		<!--个人信息-->
		<div class="row">
			<div class="col-md-12">
				<div class="personInfo">
					<div class="logo">
					    <?php if ($options['logo']) :?>
						    <a href="<?php bloginfo('url');?>"><img src="<?php echo $options['logo'];?>" alt="logo"></a>
						<?php else :?>
						    <a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url')?>/images/logo.jpg" alt="logo"></a>
						<?php endif ;?>
					</div>
					<div class="logoTheme">
						<h1><?php if ($options['headerh1']):?><?php echo $options['headerh1'];?><?php else :?>专注于web开发<?php endif;?></h1>
						<h3><?php if ($options['headerh3']):?><?php echo $options['headerh3'];?><?php else :?><?php endif;?></h1>
					</div>
				</div>				
			</div>
		</div>
	</div> 
</div>