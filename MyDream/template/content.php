<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>			
	<?php if ( ! is_single() ) : ?>
		<div class="art-desc">
			<h3 class="art-t">
				<?php the_title( sprintf( ' <a href="%s" rel="bookmark"  title="'.get_the_title().'" >', esc_url( get_permalink() ) ), '</a>' ); ?>
			</h3>
			
			<div class="more">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><i class="iconfont icon-import"></i></a>
				<?php if ( is_sticky() ) { ?><div class="sticky">置顶</div><?php } ?>	
			</div>
			<div class="clear"></div>
			
			<div style="min-height:150px;margin:20px">
				<div class="art-img"><?php get_thumbnail(300,180) ?></div>
				<span class="art-main"><?php if (has_excerpt()){ echo wp_trim_words( get_the_excerpt(), 200, '...' );} else { echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200,"..."); } ?></span>
			</div>		
			<div class="clear"></div>
		</div>
		
		<div class="art_ft">
			<div class="art-pub">
				<div class="views">
					<i class="iconfont icon-chartbar"></i> <?php if( function_exists( 'the_views' ) ) { the_views(); } ?>
				</div>
				
				<div class="cmnt">
					<?php comments_popup_link( '<i class="iconfont icon-messageprocessing"></i> 评论', '<i class="iconfont icon-messageprocessing"></i> 1 ', '<i class="iconfont icon-messageprocessing"></i> %' ); ?>
				</div>
			</div>
			
			<div class="art-info">
				<span class="archive"><i class="iconfont icon-archive" aria-hidden="true"></i> <?php md_category() ?></span>
				<span class="data"><i class="iconfont icon-calendartext"></i> <?php echo date('Y-m-d',get_the_time('U'));?></span>
				<span class="tag"><i class="iconfont icon-tagmultiple"></i> <?php the_tags('', '、', '');?></span>	
			</div>
		</div>
		<div class="clear"></div>			 
	<?php endif; ?>			
				
				
	<?php if ( is_single() ) : ?>	
		<header class="entry-header">							
			<div class="single-meta">				
				<span><i class="iconfont icon-calendartext"></i>&nbsp;<?php echo date('Y-m-d',get_the_time('U'));?></span>
				<span><i class="iconfont icon-chartbar"></i>&nbsp;<?php if( function_exists( 'the_views' ) ) { the_views(); } ?></span>	
				<span><?php comments_popup_link( '<i class="iconfont icon-messageprocessing"></i> 评论', '<i class="iconfont icon-messageprocessing"></i> 1 ', '<i class="iconfont icon-messageprocessing"></i> %' ); ?></span>
				<?php if ( current_user_can('level_10') ){ ?>
					<span><?php edit_post_link( '<i class="iconfont icon-tableedit"></i> 编辑', ' ', ''); ?></span>
				<?php } ?>	
			</div>
			<div class="clear"></div>	
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<div class="single-tag"><?php the_tags('<i class="iconfont icon-tagmultiple"></i>&nbsp;标签：', '&nbsp;&nbsp;', '');?></div>
				<div class="clear"></div>			
		</header>
			
		<div class="single-content">
			<?php if ( has_excerpt() ) { ?><span class="abstract"><span><i class="iconfont icon-file-text-o"></i>内容预览</span><div class="clear"></div><?php the_excerpt() ?></span><?php }?>
			<?php get_template_part('ad/ad', 'single'); ?>
			<?php the_content(); ?>
			<!-- 文章内分页 -->
				<?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span><i class="iconfont icon-chevronleft"></i></span>', 'nextpagelink' => "")); ?>			
				<?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
				<?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => '<span><i class="iconfont icon-chevronright"></i></span> ')); ?>					
		</div>
		<!-- 文章点赞分享 -->			
		<?php get_template_part( 'inc/social' ); ?>	
	<?php endif; ?>					
</article>
