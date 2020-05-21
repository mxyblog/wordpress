<?php get_header(); ?>
	<div id="primary" class="single-area">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>				
				<!-- 文章内容 -->
				<?php get_template_part( 'template/content', get_post_format() ); ?>
				<?php get_template_part( 'inc/copyright' ); ?>
				<?php get_template_part( 'inc/related-img' ); ?>

				<!-- 上下文 -->
				<nav class="nav-single">
					<?php
						if (get_previous_post( TRUE )) { previous_post_link( '%link','<span class="meta-nav"><span class="post-nav"><i class="iconfont icon-chevronleft"></i> 旧一篇</span><br/>%title</span>', TRUE ); } else { echo "<span class='meta-nav'><span class='post-nav'>没有了<br/></span>已是最后文章</span>"; }
						if (get_next_post( TRUE )) { next_post_link( '%link', '<span class="meta-nav"><span class="post-nav">新一篇 <i class="iconfont icon-chevronright"></i></span><br/>%title</span>', TRUE ); } else { echo "<span class='meta-nav'><span class='post-nav'>没有了<br/></span>已是最新文章</span>"; }
					?>
					<div class="clear"></div>
				</nav>
				
				<!-- 文章评论 -->
				<?php comments_template( '', true ); ?>				
			<?php endwhile; ?>
		</main>
		
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>