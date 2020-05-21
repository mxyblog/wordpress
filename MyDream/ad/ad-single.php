<?php if (md_get_option('ad-single-show')) { ?>
		<?php if ( wp_is_mobile() ) { ?>
			<?php if ( md_get_option('ad-single-m') ) { ?>
				<div class="ad-site">
					<div class="ad-single-m">
						<?php echo stripslashes( md_get_option('ad-single-m') ); ?>
					</div>	
				</div><?php } ?>			
			<?php } else { ?>
			
			<?php if ( md_get_option('ad-single-p') ) { ?>
				<div class="ad-site">
					<div class="ad-single-p">
						<?php echo stripslashes( md_get_option('ad-single-p') ); ?>
					</div>
				</div><?php } ?>
		<?php } ?>
<?php } ?>