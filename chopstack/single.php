<?php
/**
 * 主题文章正文模版
 *
 */

get_header(); ?>

<section id="layout">
	<?php if ( has_post_thumbnail() ) : ?>
		<div style="background:#f5f5f5 url('<?php echo get_post_thumbnail();?>') center;background-size:cover;" class="neck-cover">
		</div>
	<?php else : ?>
		<style>
		.post-layout{margin-top:7em;}
		.page .primary-menu li a, .single .primary-menu li a{color:#000!important;}
		#logo{color:#000!important;}
		#logo:hover{color:#6E7173!important;}
		.current-menu-item, .current-menu-parent, .current-post-ancestor, .current-post-parent {border-bottom: 2px solid #000!important;}
		.post-date,.post-header-title{color:#333!important;}
		</style>
	<?php endif; ?>
	<div class="post-layout">
		<div class="body_container">
			<div class="pure-g">
				<div class="hidden-if-min pure-u-sm-1-16 pure-u-md-1-6">
					<div class="post-aside">
					</div>
				</div>
				<div class="pure-u-1 pure-u-sm-7-8 pure-u-md-2-3 post-body">
					<div class="post">
						<div class="post-title-position-box">
							<div class="post-date">
								<?php the_time('m-d'); ?>
							</div>
							<h1 class="post-header-title"><?php the_title(); ?></h1>
						</div>
						<article id="post-<?php the_ID(); ?>" class="post-content">
					        <?php if (have_posts()) while (have_posts()) {
					            the_post();
					            the_content();
					        }; ?>
				        </article>
						<div class="tags">
							<?php the_tags(''); ?>
						</div>
						<?php comments_template( '/comments.php' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
