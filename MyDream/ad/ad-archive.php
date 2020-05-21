<?php if (md_get_option('ad-archive-show')) { ?>
	<?php if ($wp_query->current_post == 0) : ?>
		<?php if ( wp_is_mobile() ) { ?>
			<?php if ( md_get_option('ad-archive-m') ) { ?>
				<div class="ad-site">
					<div class="ad-archive-m">
						<?php echo stripslashes( md_get_option('ad-archive-m') ); ?>
					</div>	
				</div><?php } ?>			
			<?php } else { ?>
			
			<?php if ( md_get_option('ad-archive-p') ) { ?>
				<div class="ad-site">
						<div class="ad-archive-p">
							<?php echo stripslashes( md_get_option('ad-archive-p') ); ?>
						</div>
				</div>
				<?php } ?>
		<?php } ?>
	<?php endif; ?>
<?php } ?>





