<?php defined( 'ABSPATH' )  or exit; get_header(); ?>
<div id="container">
	<div class="post">	
	<?php while (have_posts()) : the_post(); ?>
		<h1 id="post-title"><?php the_title(); ?></h1>
		<div id="post-category"><?php $category = get_the_category();if($category[0]){echo '<a target="_blank" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?><?php echo get_post_views($post -> ID) ?></div>
		<div class="post_content"><?php the_content(); ?></div>
		<div id="rating"></div>
		<div class="clear"></div>
		

		<div class="post_detail">
            <div class="section_title">
                <span>关于本文</span>
            </div>
			<ul>
				<li>本文作者：<a data-type="mip" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" title="由<?php echo get_the_author();?>发布" rel="author"><?php echo get_the_author();?></a></li>
				<li>所属分类：<a data-type="mip" href="https://zhangzifan.com/t/seo-qa" rel="category tag"><?php the_category(',') ?></a></li>
				<li>拥有标签：	<?php the_tags('',',','') ?></li>
                <li>发布时间：<span class="pub_time"><?php echo get_the_date(); ?></span></li>
			</ul><?php endwhile; ?>

			<ul class="entry-relate-links">
			    <?php
                $prev_post = get_previous_post();
                if (!empty( $prev_post )){
                	echo '<li><span>上一篇 &gt;：</span><a data-type="mip" href="'.get_permalink( $prev_post->ID ).'">'.$prev_post->post_title.'</a></li>';
                }?>
			    
                <?php
                $next_post = get_next_post();
                if (!empty( $next_post )){
                	echo '<li><span>下一篇 &gt;：</span><a data-type="mip" href="'.get_permalink( $next_post->ID ).'">'.$next_post->post_title.'</a></li>';
                }?>         

			</ul>
            <ul class="prev-next">
                 <?php
                $prev_post = get_previous_post();
                if (!empty( $prev_post )){
                	echo '<a rel="prev" href="'.get_permalink( $prev_post->ID ).'">« 上一篇文章</a>';
                }?>
                 <?php
                $next_post = get_next_post();
                if (!empty( $next_post )){
                	echo '<a rel="prev" href="'.get_permalink( $next_post->ID ).'">下一篇文章 »</a>';
                }?>         

			</ul>

		<?php 	wpcool_posts_related("猜你喜欢",'14','text');?>
		</div>

	</div>
</div>
<div class="clear"></div>

<?php get_footer(); ?>