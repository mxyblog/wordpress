<?php defined( 'ABSPATH' )  or exit; get_header(); ?>
<div id="container">
	<div id="posts">
		<div id="posts-list">
            <?php if(wp_is_mobile()){//只在移动端输出置顶文章 ?>
            <div class="entry-slide">
                <mip-carousel
                        autoplay
                        defer="5000"
                        layout="responsive"
                        width="1280"
                        height="600"
                        indicator
                        buttonController
                >
                    <?php
                    $query_post = array(
                        'posts_per_page' => 10,
                        'post__in' => get_option('sticky_posts'),
                        'caller_get_posts' => 1
                    );
                    query_posts($query_post);
                    while(have_posts()):the_post(); ?>
                        <div class="top-entry">
                            <div class="top-entry-img-wrapper">
                                <a class="top-entry-img" title="<?php the_title(); ?>" href="<?php the_permalink() ?>">
                                    <mip-img class="mip-img" alt="<?php the_title(); ?>" src="<?php post_thumbnail(1); ?>"></mip-img>
                                    <h2 class="entry-title"><?php the_title(); ?></h2>
                                </a>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_query();?>
                </mip-carousel></div>
        <div class="clear"></div>
    <?php }?>
            <?php query_posts('showposts=6&cat=-111'); ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="entry">
                    <div class="entry-thumb">
                        <a target="_blank" href="<?php the_permalink() ?>">
                            <mip-img class="mip-img" alt="<?php the_title(); ?>" src="<?php post_thumbnail(); ?>"></mip-img>
                        </a>
			        </div>
                    <div class="entry-body">
                        <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                        <div class="entry-meta">
                            <span class="entry-category-icon"><?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></span>
                            <span class="entry-views-icon"><?php echo get_post_views($post -> ID) ?></span>
                        </div>
                    </div>
		        </div>
            <?php endwhile;?>
        </div>
	<?php t_nav($query_string); ?>
</div>
<div class="clear"></div>
<?php get_footer(); ?>