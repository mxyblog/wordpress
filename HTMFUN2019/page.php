<?php get_header() ?>
<?php if( have_posts() ){ the_post();?>
        <div class="page-title-area pb-60 pt-85 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="page-title">
                            <h1>
                                <?php the_title(); ?>
                            </h1>
                            <span>
                                <?php the_time('Y年n月j日 l') ;?>
                            </span>
                            <small>
                                •
                            </small>
                            <span>
                                阅读次数 <?php get_post_views($post -> ID); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-100 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="post-text">
                          
						<?php the_content(); ?>
						
						<div class="post-footer">
							转载原创文章请注明，转载自：<a href="<?php bloginfo('url')?>"><?php bloginfo('name')?></a> » <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</div>	
                       </div>
                   		<?php }; ?>
                        <div class="comments-area pb-60 pt-60 clearfix">
							<?php comments_template(); ?>

                            <div class="navigation">
                                <div class="left">
                                </div>
                                <div class="right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php get_footer(); ?>