<?php
/*
Template Name: 无标题模版
*/
$page_side_bar = snape_option('page_side_bar');
$page_side_bar = (empty($page_side_bar)) ? 'right_side' : $page_side_bar;
$background_color = snape_option('background_color');
$background_image = snape_option('background_image');
$page_banner_image = snape_option('page_banner_image');
$page_banner_single_color = snape_option('page_banner_single_color');
get_header(); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<div class="post-section blog-post" style="<?php echo (!snape_option('background_image')) ? 'background:' . $background_color  :'background-image: url('. $background_image .');' ; ?>">
    <div class="container">
        <div class="row">
        	<?php if($page_side_bar == 'left_side'){ ?>
				<aside id="widget-area" class="col-md-4 hidden-xs hidden-sm scrollspy">
					<div id="sidebar">
						<?php dynamic_sidebar('sidebar_tool'); ?>
					</div>
				</aside>
			<?php } ?>
            <section id="main" class='<?php echo ($page_side_bar == 'single') ? 'col-md-12' : 'col-md-8'; ?>'>
                <article>
                    <div class="post-inner post-border clearfix">
                        <div class="post-content"><?php the_content(); ?></div>
						<?php if(snape_option('page_like_donate')||snape_option('page_share')) {?>
						<div class="entry-footer clearfix">
							<div class="post-like-donate text-center clearfix" id="post-like-donate">
							<?php if ( snape_option( 'page_like_donate' )==1 ) : ?>
				   			<a href="<?php echo snape_option('donate_links'); ?>" class="Donate"><i class="fa fa-bitcoin"></i> 打赏</a>
				   			<?php endif; ?>
							<?php if ( snape_option( 'page_share' )==1 ) : ?>
							<a href="javascript:;"  class="Share"><i class="fa fa-share-alt"></i> 分享</a>
								<?php require_once( get_template_directory() . '/inc/share.php'); ?>
							<?php endif; ?>
				    		</div>
						</div>
						<?php }?>
					</div>
					<?php if ( snape_option( 'page_cc' )==1 ) : ?>
					<div class="hentry copyright text-center clearfix">
						<img alt="知识共享许可协议" src="<?php echo get_template_directory_uri(); ?>/images/licenses.png">
						<h5>本作品采用 <a rel="license nofollow" target="_blank" href="http://creativecommons.org/licenses/by-sa/4.0/">知识共享署名-相同方式共享 4.0 国际许可协议</a> 进行许可</h5>
					</div>
					<?php endif; ?>
					<?php comments_template(); ?>
				</article>
			<?php endif; ?>
			</section>
			<?php if($page_side_bar == 'right_side'){ ?>
				<aside id="widget-area" class="col-md-4 hidden-xs hidden-sm scrollspy">
					<div id="sidebar">
						<?php dynamic_sidebar('sidebar_tool'); ?>
					</div>
				</aside>
			<?php } ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>