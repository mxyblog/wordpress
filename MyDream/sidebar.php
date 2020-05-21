<div id="sidebar" class="widget-area">
	<?php wp_reset_query(); if ( is_home() ) : ?>
		<?php dynamic_sidebar( 'sidebar-h-t' ); ?>
		<div class="sidebar-roll">
			<?php dynamic_sidebar( 'sidebar-h-r' ); ?>
		</div>
		<?php dynamic_sidebar( 'sidebar-h-b' ); ?>
	<?php endif; ?>

	<?php if (is_single() || is_page() ) : ?>
		<?php dynamic_sidebar( 'sidebar-s-t' ); ?>
		<div class="sidebar-roll">
			<?php dynamic_sidebar( 'sidebar-s-r' ); ?>
		</div>
		<?php dynamic_sidebar( 'sidebar-s-b' ); ?>
	<?php endif; ?>

	<?php if ( is_archive() || is_search() || is_404() ) : ?>
		<?php dynamic_sidebar( 'sidebar-a-t' ); ?>
		<div class="sidebar-roll">
			<?php dynamic_sidebar( 'sidebar-a-r' ); ?>
		</div>
		<?php dynamic_sidebar( 'sidebar-a-b' ); ?>
	<?php endif; ?>
</div>

<div class="clear"></div>