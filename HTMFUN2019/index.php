
<?php get_header();
if(is_home() && is_sticky() && !is_paged() ):
$args = array(
    'posts_per_page' => -1,
    'post__in'  => get_option( 'sticky_posts' )
);
$sticky_posts = new WP_Query( $args );
while ( $sticky_posts->have_posts() ) : $sticky_posts->the_post();?>

<div class="bannner-area pt-85 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 ">
                <div class="banner" style="background-image:url(<?php echo post_thumbnail_src(); ?>)">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-text d-flex justify-content-center">
                    <div class="banner-text-wrap">
                        <div class="title-text mb-4">
                            <h2 class="wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1s">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                        </div>
                        <p class="wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1s">
                            <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120,"..."); ?>
                        </p>
                        <div class="btn-read wow fadeInUp animated" data-wow-delay="1.3s" data-wow-duration="1s">
                            <a href="<?php the_permalink(); ?>">
                                阅读更多
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endwhile; wp_reset_query();?>
<?php endif?>

<div class="main-content-area pt-100 clearfix">
    <div class="container">
        <div class="row">
            <div id="post_<?php the_ID(); ?>" class="col-lg-10 col-md-10 offset-md-2 offset-lg-2">
                <div class="blog-list">
                    <?php while(have_posts()) : the_post(); ?>
                    <?php if(!is_sticky()){?>
                        <div class="list-block wow fadeIn" data-wow-duration="2s">
                            <span> <?php the_time('Y年n月j日 l') ;?> </span>
                            <h2>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <p>
                                <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120,"..."); ?>
                            </p>
                            <div class="btn-read">
                                <a href="<?php the_permalink(); ?>">
                                    阅读更多
                                </a>
                            </div>
                        </div>
                    <?php } endwhile;?>

                </div>
            </div>
        </div>
    </div>
</div>







<div class="pagination-area mt-5 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-11 offset-lg-1">
                <div class="post-pagination d-flex justify-content-between clearfix">
                    <p>
                        <?php previous_posts_link(__('上一页')) ?>
                    </p>
                    <p class="ml-auto">
                        <?php next_posts_link(__('下一页')) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>