<?php
/**
 *
 * 心情纪事（首页文章无图模式）
 * 
 */
?>

<article class="post-box pure-u-1 pure-u-sm-1-2 pure-u-md-1-3">
	<div class="post">
		<div class="post-text post-text-full">
			<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</h2>
			<div class="post-content">
				<?php the_content(''); ?>
			</div>
			<div class="post-meta">
				<?php the_time('Y-m-d'); ?>
				<span class="separator">/</span>
				<?php comments_popup_link(__('0 评论'), __('1 评论'), __('%  评论')); ?>
			</div>
		</div>
	</div>
</article>