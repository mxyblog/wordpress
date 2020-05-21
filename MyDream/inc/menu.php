<header id="masthead" class="site-header">
<div id="fix-header"></div>
<div id="menu-box">	
	<div id="main-menu">		
		<hgroup class="logo-sites">
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url('/') ); ?>"><img src="<?php echo md_get_option('logo'); ?>" alt="<?php bloginfo('name'); ?>" /></a>
				</h1>
		</hgroup>
		<?php if (md_get_option('login')) { ?> 
			<?php get_template_part( 'inc/user-profile' ); ?>
		<?php } ?>	
		<div id="sidr-close"><a href="#sidr-close" class="toggle-sidr-close">×</a></div>
		<a href="#sidr-main" id="navigation-toggle" class="bars"><i class="iconfont icon-viewheadline"></i></a>
			<div id="site-nav-wrap">
				<nav id="site-nav" class="main-nav">
					<?php
						wp_nav_menu( array(
							'theme_location'	=> 'primary',
							'menu_class'		=> 'down-menu nav-menu',
							'fallback_cb'		=> 'default_menu',
							'walker' => new description_walker()
						) ); 
					?>					

				</nav>
			</div>	
		</div>
		<div class="clear"></div>			
	</div>
</header>
<?php get_template_part( 'inc/login' ); ?>