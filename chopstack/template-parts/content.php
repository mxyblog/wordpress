<?php
/**
 * 文章通用板式（首页有图模式）
 *
 */

?>
<article class="post-box pure-u-1 pure-u-sm-1-2 pure-u-md-1-3">
<div class="post">
	<a href="<?php the_permalink(); ?>" rel="nofollow" class="post-cover-box">
		<?php if ( has_post_thumbnail() ) : ?>
			<div style="background-image:url('<?php echo get_post_thumbnail();?>?imageView2/1/w/386/h/252/q/100')" class="post-cover"></div>
		<?php else : ?>
			<div style="background-image:url('<?php echo get_stylesheet_directory_uri() ?>/static/thumbnail.jpg')" class="post-cover"></div>
		<?php endif; ?>
	</a>
	<div class="post-text">
		<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<div class="post-content">
			<div class="p_part">
				<p>
					<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 70,"..."); ?>
				</p>
			</div>
		</div>
		<div class="post-meta">
			<?php the_time('Y-m-d'); ?>
			<span class="separator">/</span>
			<?php comments_popup_link(__('0 评论'), __('1 评论'), __('%  评论')); ?>
		</div>
	</div>
</div>
</article>