<?php get_header(); ?>
<div class="articleDetail container">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="articleContent">
				<!-- 标题 -->
				<div class="title"><?php the_title();?></div>
				<!-- 访问量 ...-->
				<div class="secTitleBar">
					<ul>
						<li>分类：<?php the_category(’, ‘) ?></li>
						<li>发表：<?php echo get_the_time('Y-m-d') ?></li>
						<li>围观(<?php if(function_exists('custom_the_views') ) custom_the_views($post->ID); ?>)</li>
						<!-- 获得评论数函数默认是wordpress自带的 -->
						<li><a href="#comments">评论(<?php echo number_format_i18n( get_comments_number() );?>)</a></li>
					</ul>
				</div>
				<!-- 内容 -->
				<div class="articleCon post_content">
					<?php the_content();?>
				</div>
				<!-- 标签 -->
				<div class="articleTagsBox">
					<ul><?php the_tags('<span>标签：</span> ', '  ' , ''); ?></ul>
				</div>
				<!-- 评论 -->
				<div class="post_content">
					<?php comments_template( '', true ); ?>
			    </div>
			</div>
		</div>
	</div>
    <?php endwhile; endif;?>
</div>
<?php get_footer(); ?>