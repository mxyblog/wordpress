<?php defined( 'ABSPATH' )  or exit; get_header(); ?>
<div id="container">
	<div id="posts">
		<div class="page_title"><?php echo '&quot;'.wp_specialchars($s).'&quot;的搜索结果';  ?></div>
		<div id="posts-list">
		<?php $i = 1;  if (have_posts()) :  while (have_posts()) : the_post();  if(($i == 1)) : ?>
				
			<div class="top-entry">
				<div class="top-entry-img-wrapper">
					<a target="_blank" class="top-entry-img" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
						<h2 class="entry-title"><?php the_title(); ?></h2>
					</a>
				</div>
				<a target="_blank" class="top-entry-title" href="<?php the_permalink() ?>"><h2><?php the_title(); ?></h2></a>
				<div class="top-entry-content">
					<?php custom_excerpt(100); ?>
				</div>
			</div>
			<div class="clear"></div>
					
		<?php else: ?>
			<div class="entry">
				<div class="entry-thumb">
					<a target="_blank" href="<?php the_permalink() ?>"><mip-img class="mip-img" alt="<?php the_title(); ?>" src="<?php post_thumbnail(); ?>"></mip-img></a>
				</div>
				<div class="entry-body">
					<h2 class="entry-title"><a target="_blank" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<div class="entry-meta">
                        <span class="entry-category-icon"><?php $category = get_the_category();if($category[0]){echo '<a target="_blank" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></span>
                        <span class="entry-views-icon"><?php echo get_post_views($post -> ID) ?></span>
					</div>
					<div class="entry-content">
						<?php custom_excerpt(100); ?>
					</div>
				</div>
			</div>
		<?php endif;$i++; ?>
		<?php endwhile; endif; ?>
		</div>
		<?php t_nav($query_string); ?>
	</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>