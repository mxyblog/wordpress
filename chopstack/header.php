<?php
/**
 * 主题顶部
 *
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php get_template_part('inc/add-title') ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.mrju.cn/new-ico.png" rel="shortcut icon">
	<?php get_template_part('inc/add-header') ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<section id="header">
	<div class="body_container">
		<div class="header-inner clearfix">
			<div class="site-name">
				<a href="<?php bloginfo('url'); ?>">
				<div id="logo">
					<?php bloginfo( 'name' ); ?>
				</div>
				</a>
			</div>
			<div id="nav-menu" class="hidden-if-min">
				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<nav id="site-navigation" class="mixed_site_nav_wrap site_nav_wrap">
						<?php
						wp_nav_menu( array(
							'theme_location'  => 'primary',
							'container' => '',
							'menu_id'         => 'primary-menu',
							'menu_class'      => 'primary-menu sm sm-base',
						) );
						?>
					</nav><!-- 菜单 -->
				<?php endif; ?>
			</div>
			<form id="search" class="hidden-if-min" action="<?php echo home_url();?>">
                    <input id="search_value" name="s" class="textInput" type="search" placeholder="Search...">
			</form>
		</div>
	</div>
</section>