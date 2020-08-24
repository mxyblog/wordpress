<?php get_header();
$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');?>
<?php if (have_posts()) {
    the_post();?>
<meta itemprop="name" content="<?php the_title();?>"/>
<meta itemprop="image" content="<?php echo post_thumbnail_src(); ?>" />
<meta name="description" itemprop="description" content="<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120,"..."); ?>" />
<div class="page-title-area pb-60 pt-85 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <?php if ($thumbnail_src[0]): ?>
                <div class="post-img" style="background-image: url(<?php echo $thumbnail_src[0]; ?>);"></div>
                <?php endif;?>
                <div class="page-title">
                    <h1>
                        <?php the_title();?>
                    </h1>
                    <span>
                       <?php the_category(',');?>
                    </span>
                    <small>
                        •
                    </small>
                    <span>
                        <?php the_time('Y年n月j日 l');?>
                    </span>
                    <small>
                        •
                    </small>
                    <span>
                        阅读次数 <?php get_post_views($post->ID);?>
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="clearfix">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto post-box">
                <div class="post-text">

                    <?php 
                    the_content();
                    article_index();?>
                    <div class="post-footer">
                        转载原创文章请注明，转载自：<a href="<?php bloginfo('url')?>"><?php bloginfo('name')?></a> » <a href="<?php the_permalink();?>"><?php the_title();?></a>
                    </div>
                    <div class="post-like">
                        <a href="javascript:;" data-action="ding" data-id="<?php the_ID();?>" class="favorite<?php if (isset($_COOKIE['bigfa_ding_' . $post->ID])) {
                                    echo ' done';
                                }
                                ?>">赞 <span class="count">(<?php if (get_post_meta($post->ID, 'bigfa_ding', true)) {
                                    echo get_post_meta($post->ID, 'bigfa_ding', true);
                                } else {
                                    echo '0';
                                }?>)
                                </span>
                            </a>
                    </div>
                </div>
                <!-- 文章分享 -->
                <div class="post-social d-none d-lg-block">
                    <div class="theiaStickySidebar">
                    <ul class="my-n2">
                        <li class="py-2"><span class="text-muted"><i class="iconfont icon-LTE"></i></span></li>
                        <li class="py-2"><a href="https://connect.qq.com/widget/shareqq/index.html?url=<?php the_permalink();?>&title=<?php the_title();?>&pics=<?php echo post_thumbnail_src(); ?>&summary=<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120,"..."); ?>" target="_blank" class="btn btn-light w-40 px-0 qq "><i class="iconfont icon-qq"></i></a></li>
                        <li class="py-2"><a href="https://service.weibo.com/share/share.php?url=<?php the_permalink();?>&type=button&language=zh_cn&title=【<?php the_title();?>】 <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 240,"..."); ?>&pic=<?php echo post_thumbnail_src(); ?>&searchPic=true#_loginLayer_1547704266365" target="_blank" class="btn btn-light w-40 px-0 weibo "><i class="iconfont icon-weibo"></i></a></li>
                        <li class="py-2"><a href="javascript:" data-img="http://qr.liantu.com/api.php?text=<?php the_permalink();?>&w=111" target="_blank" class="btn btn-light w-40 px-0 single-weixin weixin "><i class="iconfont icon-weixin"></i></a></li>
                        <li class="py-2"><a href="#comments" class="btn btn-light w-40 px-0"><i class="iconfont icon-comment1"></i></a></li>
                    </ul>
                 </div>
                </div>

                    <?php } ;?>

                <div class="comments-area pb-60 pt-60 clearfix" id="commentBox">
                    <?php comments_template();?>
                </div>
                <div class="related-list">
                    <div class="h5 mb-4">
                        <i class="text-xl text-primary iconfont icon-Knifefork pr-2">
                                </i>
                        您可能感兴趣的
                    </div>
                    <div class="post-list list-grid list-bordered my-n4">
                        <?php
                        $args       = array('numberposts' => 2, 'orderby' => 'rand', 'post_status' => 'publish');
                        $rand_posts = get_posts($args);
                        foreach ($rand_posts as $post): ?>
                        <div id="post-<?php the_ID(); ?>" class="list-item block item-regular py-4 post-<?php the_ID(); ?> post type-post status-publish format-standard hentry category-trip tag-1007 tag-1008">
                            <div class="list-content py-lg-1">
                                <div class="list-body ">
                                    <div class="h5 h-2x">
                                        <a href="<?php the_permalink();?>" class="list-title">
                                                    <?php the_title();?>
                                                </a>
                                    </div>
                                    <div class="d-none d-md-block text-sm text-secondary mt-3">
                                        <div class="h-2x">
                                            <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120, "..."); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-footer d-flex">
                                    <div class="text-xs text-muted">
                                        <span class="d-inline-block">
                                                    <?php the_category(',');?>
                                                </span>
                                        <i class="text-primary px-2">
                                                    •
                                                </i>
                                        <span class="d-inline-block">
                                                     <?php the_time('Y年n月j日 l');?>
                                                </span>
                                    </div>
                                    <div class="ml-auto text-xs text-muted ">
                                    </div>
                                </div>
                            </div>
                            <?php if (post_thumbnail_src()): ?>
                            <div class="media shadow col-3 col-lg-2">
                                <a href="<?php the_permalink();?>" class="media-content" style="background-image:url(<?php echo post_thumbnail_src(); ?>)">  </a>
                            </div>
                            <?php endif?>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php get_footer();?>