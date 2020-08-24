<?php get_header();
    $category = get_the_category();
    $cat_ID = get_cat_ID($category[0]->cat_name);?>
<div class="page-header pb-100 pt-85 clearfix">
    <?php if(z_taxonomy_image_url()): ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="headerr-image">
                    <img src="<?php if(z_taxonomy_image_url()){  echo z_taxonomy_image_url(); }else{echo 'https://i.loli.net/2018/11/12/5be9035ec03af.jpg';} ?>" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="author-text">
                    <div class="single-author-d">
                        <div class="title">
                            <h2>
                                <?php single_cat_title(); ?>
                            </h2>
                            <p>
                                <?php echo category_description(); ?>
                            </p>
                            <strong>
                                共<?php echo get_category($cat_ID)->count;?>篇文章
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<div class="main-content-area clearfix ">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-10 offset-md-2 offset-lg-2">
                <div class="blog-list">
                     <?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
                        <div class="list-block wow fadeIn" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: fadeIn;">
                            <span><?php the_time('Y年n月j日 l') ;?></span>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
                            <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120,"..."); ?></p>
                            <div class="btn-read">
                                <a href="<?php the_permalink(); ?>">阅读更多</a>
                            </div>
                        </div>
                    <?php endwhile; ?>   
                    <?php else : ?>   
                        <p class="single_post_list">暂无内容，请阅读其他版块</p>  
                    <?php endif; ?>
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
<?php get_footer();?>