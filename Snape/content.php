<?php
/**
 * The default template for displaying content
 *
 * @package Vtrois
 * @version 1.1
 */
?>
<article class="hentry clearfix">
	<?php if ( snape_option( 'show_thumb' )==1 ) : ?>
	<div class="entry-thumb clearfix"> 
		<a href="<?php the_permalink() ?>"><?php snape_blog_thumbnail() ?></a>
	</div>	
	<?php endif; ?>
	<div class="post-inner">
		<header class="entry-header clearfix">
			<h1 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
			<div class="post-meta">
				<span class="pull-left">
				<a href="#"><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></a>
				</span>
				<span class="visible-lg visible-md visible-sm pull-left">
				<?php $category = get_the_category(); echo '<a href="' . get_category_link($category[0] -> term_id) . '"><i class="fa fa-folder-open-o"></i> ' . $category[0] -> cat_name . '</a>'; ?>
				<a href="<?php the_permalink() ?>#respond"><i class="fa fa-commenting-o"></i> <?php echo snape_comments_users($post->ID); ?>条评论</a>
				</span>
				<span class="pull-left">
				<a href="<?php the_permalink() ?>"><i class="fa fa-eye"></i> <?php echo snape_get_post_views(); ?>次浏览</a>
				<a href="<?php the_permalink() ?>"><i class="fa fa-thumbs-o-up"></i> <?php if( get_post_meta($post->ID,'love',true) ){ echo get_post_meta($post->ID,'love',true); } else { echo '0'; }?>人点赞</a>
				</span>
			</div>
		</header>
		<div class="entry-content clearfix">
		<p><?php echo wp_trim_words(get_the_excerpt(), 110); ?></p>
		</div>
	</div>
</article>