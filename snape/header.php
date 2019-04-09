<?php
/**
 * The template for displaying the header
 *
 * @package Vtrois
 * @version 1.1
 */
?><!DOCTYPE HTML>
<html class="no-js">
    <head>
		<title><?php wp_title( '-', true, 'right' ); ?></title>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="<?php snape_description(); ?>" />
		<meta name="keywords" content="<?php snape_keywords();?>" />
		<?php wp_head(); ?>
        <?php wp_print_scripts('jquery'); ?>
		<?php if ( snape_option( 'site_bw' )==1 ) : ?>
		<style type="text/css">
        html{filter: grayscale(100%);-webkit-filter: grayscale(100%);-moz-filter: grayscale(100%);-ms-filter: grayscale(100%);-o-filter: grayscale(100%);filter: progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);filter: gray;-webkit-filter: grayscale(1); }
        </style>
		<?php endif; ?>
    </head>
    	<?php flush(); ?>
   <body data-spy="scroll" data-target=".scrollspy">
    <nav class="navbar navbar-default navbar-fixed bootsnav">
        <div class="top-search">
            <div class="container">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                            <input type="text" name='s' id='s' placeholder="Search…" class="form-control" placeholder="" x-webkit-speech>
                        </form>
                    <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                </ul>
            </div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <?php $site_logo = snape_option('site_logo'); if ( !empty( $site_logo ) ) {?>
                    <a class="navbar-brand" href="<?php echo get_option('home'); ?>" ><img class="logo" src="<?php echo $site_logo; ?>"></a>
                <?php }else{?>
                    <a class="navbar-brand title-noimg" href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a>
                <?php }?>
            </div>
                <?php wp_nav_menu(array('theme_location' => 'header_menu', 'container' => 'div', 'container_id' => 'navbar-menu','container_class' => 'collapse navbar-collapse', 'menu_class' => 'nav navbar-nav navbar-right','walker' => new wp_bootstrap_navwalker)); ?>
        </div>
    </nav>
    <div class="clearfix"></div>