<div id="copyright">
	<?php echo get_avatar( get_the_author_meta('email'), '72' ); ?>
	<ul class="spostinfo">
		<li>原文链接：<a target="_blank" rel="nofollow" href="<?php echo $copy ?>" ><?php the_permalink() ?></a></li>		
		<li>版权声明：本站原创文章，于<?php echo timeago(get_gmt_from_date(get_the_time('Y-m-d G:i:s'))); ?>，由<?php the_author_posts_link(); ?>发表。</li>
		<li>转载请注明：<a href="<?php the_permalink() ?>" rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?> <?php bloginfo('name');?></a></li>		
	</ul>
</div>
