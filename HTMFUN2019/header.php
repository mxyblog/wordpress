<!DOCTYPE html>
<html lang="zh-CN">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0">
        <title><?php wp_title( ' - ', true, 'right' ); ?></title>
        <script type='text/javascript' src='<?php echo esc_url( get_template_directory_uri() ); ?>/static/js/jquery.min.js'>
        </script>
        <link rel="stylesheet" href="//at.alicdn.com/t/font_1020004_6ccjvpn7aax.css">
        <?php wp_head(); ?>
    </head>
    <style>
        <?php echo cs_get_option('plus_diy_css');?>
    </style>
    <body>
        <header class="head-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar navbar-dark box-shadow">
                            <div class="main-nav d-flex justify-content-between">
                                <a href="<?php bloginfo('url'); ?>" class="navbar-brand">
                                    <img src="<?php echo cs_get_option('plus_header_logo') ?>" alt="<?php bloginfo('name')?>" />
                                </a>
                                <a class="nav-button ml-auto">
                                    <span id="nav-icon3">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fixed-top main-menu">
                <div class="flex-center p-5">
                    <ul id="menu-htmFun" class="nav flex-column">
                        <?php
                            if ( has_nav_menu( 'top' ) ) :
                                wp_nav_menu( array(
                                'theme_location' => 'top',
                                    'container' => false,
                                    'items_wrap' => '%3$s',
                                    ) );
                            endif;?>
                    </ul>
                </div>
            </div>
        </header>