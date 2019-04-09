<section id="footer">
	<div class="body_container">
		<div class="foot-log">
			<?php
			echo wp_kses_post( sprintf(
				__( 'Copyright &copy; %s %s . Design by %s . 托管于 %s . %s', 'chopstack' ),
				date_i18n( __( 'Y', 'chopstack' ) ),
				'<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a>',
				'<a href="https://chopstack.com/" target="_blank">Cho</a>',
				'<a href="http://www.qcloud.com/redirect.php?redirect=1001&cps_key=0b0e06dd05f09da942d4716011136602" target="_blank">腾讯云</a>',
				'<a href="http://www.miitbeian.gov.cn/" target="_blank">鄂ICP备15017787号-1</a>'
			) );
			?>
		</div>
		<div class="footer-links hidden-if-2min">
			<?php if ( has_nav_menu( 'footer_links' ) ) : ?>
				<nav class="footer-links-navigation">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer_links',
						'container'      => '',
						'menu_class'     => 'footer-links-menu',
						'menu_id'        => 'footer-links-menu',
						'fallback_cb'    => '',
					) );
					?>
				</nav>
			<?php endif; ?>
		</div>
	</div>
</section>

<script data-no-instant>InstantClick.init();</script>

<?php wp_footer(); ?>
</body>
</html>