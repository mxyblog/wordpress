<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="Cache-Control" content="no-transform" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<?php get_template_part( 'inc/seo' ); ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/css3-mediaqueries.js"></script>
<![endif]-->
<link rel="shortcut icon" href="<?php echo md_get_option('favicon'); ?>">
<?php if (md_get_option('ali_iconfont')) : ?>
	<link rel='stylesheet' id='iconfont-css'  href='<?php echo md_get_option('ali_iconfont_url'); ?>' type='text/css' media='all' />
<?php endif; ?>	
<?php echo md_get_option('tongji-head'); ?>
<?php echo md_get_option('ad-head-js'); ?>
<?php wp_head(); ?>
</head>

<body>
	<?php get_template_part('inc/menu');?>		
		<div class="breadcrumb">
			<?php md_crumbs(); ?>
		</div>
<div id="content">