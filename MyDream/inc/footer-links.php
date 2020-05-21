<?php if ( is_front_page()){ ?>
	<div id="links">
		<ul>
		<?php wp_list_bookmarks('title_li=&before=<span class="lx7"><span class="link-f">&after=</span></span>&categorize=1&show_images=0&orderby=rating&order=DESC&category='.md_get_option('link_f_cat')); ?>
		<?php if ( md_get_option('link_url') == '' ) { ?>
			<?php } else { ?>
				<span class="lx7">
					<span class="link-f">
						<li><a href="<?php echo get_permalink( md_get_option('link_url') ); ?>" target="_blank" title="全部链接">更多链接<i class="icon-li"></i></a></li>
					</span>
				</span>
			<?php } ?>
		</ul>
		<div class="clear"></div>
	</div>
<?php } ?>