<?php defined( 'ABSPATH' )  or exit; get_header(); ?>
<div id="container">
	<div id="posts">
		<div class="page_title">正在显示 [ <?php single_cat_title(); ?> ] 分类下的文章</div>
		<div id="posts-list">
		<?php while (have_posts()) : the_post(); ?>

			<div class="entry">
				<div class="entry-thumb">
					<a href="<?php the_permalink() ?>"><mip-img class="mip-img" alt="<?php the_title(); ?>" src="<?php post_thumbnail(); ?>"></mip-img></a>
				</div>
				<div class="entry-body">
					<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<div class="entry-meta">
                        <span class="entry-category-icon"><?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></span>
                        <span class="entry-views-icon"><?php echo get_post_views($post -> ID) ?></span>
					</div>

				</div>
			</div>
		<?php endwhile; ?>
		</div>
		<?php t_nav($query_string); ?>
	</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>