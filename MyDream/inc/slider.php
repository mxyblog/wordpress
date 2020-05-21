<style>
    .swiper-container {
		float:left;
        width: 100%;
        height:<?php echo md_get_option('slider_height'); ?>px;
		max-width: 1200px;
		border:1px solid #ddd;
		border-radius: 2px;
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
		margin-bottom:15px;	
		background-color: #ffffff;
     }
    .swiper-slide {	
        text-align: center;
        font-size: 18px;
		width: 100%;
        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;		
    }
	.swiper-slide-image	{
		width:70.3%;
		left: 0;
		top:0;
		position: absolute;
	}
	.swiper-slide .swiper-slide-image img{
		width:100%;
		height:calc(<?php echo md_get_option('slider_height'); ?>px - 2px);
		display: block;
	}
	.swiper-slide .swiper-slide-text {
		display: block;
		width:29.7%;
		position: absolute;
		top: 0;
		right: 0;
		margin-top: 10px;
		padding: 0 20px;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		font:15px "Trebuchet MS",Helvetica,Arial,'PingFang SC','Hiragino Sans GB','STHeiti Light','Microsoft YaHei',SimHei,'WenQuanYi Micro Hei',sans-serif;
		text-align:left;
		line-height:180%
	}
	.swiper-slide .swiper-slide-text  h2{
		font-size:16px;
		border-bottom:2px solid #104040;
		margin:0px -10px 10px;
		padding:5px;
		line-height:180%;
		text-align:center
	}
	@media only screen and (max-width: 780px) {
		.swiper-slide .swiper-slide-text {display: none;}
		.swiper-slide-image{width:100%;}
	}
</style>



<div id="slider" class="swiper-container">	
		<div class="swiper-wrapper">
			<!-- 自定义栏目幻灯片show -->
			<?php if (md_get_option(slider_content)== 'show') { ?>
				<?php			
					$args = array(
						'meta_key' => 'show',
						'ignore_sticky_posts' => 1,
						'posts_per_page' => md_get_option('slider_n'),
						'orderby'=> md_get_option('slider_orderby'),				
					);
					query_posts($args);
				?>		
				<?php while (have_posts()) : the_post();$do_not_duplicate[] = $post->ID; ?>
				<?php $image = get_post_meta($post->ID, 'show', true); ?>
				
					<div class="swiper-slide">
						<div class="swiper-slide-image">
							<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" /></a>
						</div>
						<div class="swiper-slide-text">
							<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></a></h2>
							<p>
								<a href="<?php the_permalink(); ?>" target="_blank" rel="bookmark"><?php if (has_excerpt('')){ echo wp_trim_words( get_the_excerpt(), 120, '...' ); } else { echo wp_trim_words( get_the_content(), 120, '...' ); } ?></a>
							</p>
						</div> 
					</div>	
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
			<?php } ?>
			
			<!-- 随机幻灯片-->
			<?php if (md_get_option(slider_content)== 'rand') { ?>
				<?php	
					$cat = explode(',',md_get_option('cat_in'));
					$args = array(
						'cat' => $cat,
						'ignore_sticky_posts' => 1,
						'posts_per_page' => md_get_option('slider_n'),
						'orderby'=> md_get_option('slider_orderby'),				
					);
					query_posts($args);
				?>		
				<?php while (have_posts()) : the_post();$do_not_duplicate[] = $post->ID; ?>				
					<div class="swiper-slide">
						<div class="swiper-slide-image">
							<!--<?php get_thumbnail(840,md_get_option('slider_height'))-4?>-->
							<?php							
								global $post; 
								$content = $post->post_content; 
								preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER); 
								$n = count($strResult[1]); 
								if ($n > 0){ // 如果文章内包含有图片，就用第一张图片做为缩略图 
								echo '<a href="'.get_permalink().'"> <img src="'.$strResult[1][0].'" alt="'.$post->post_title .'" /></a>'; 
								} 
								else { // 如果文章内没有图片，则用默认的图片 
								$random = mt_rand(1, 25);
										echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a>';
								} 						
							?>							
						</div>
						<div class="swiper-slide-text">
							<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></a></h2>
							<p>
								<a href="<?php the_permalink(); ?>" target="_blank" rel="bookmark"><?php if (has_excerpt('')){ echo wp_trim_words( get_the_excerpt(), 120, '...' ); } else { echo wp_trim_words( get_the_content(), 120, '...' ); } ?></a>
							</p>
						</div> 
					</div>		
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
			<?php } ?>
		
			<!-- 自定义幻灯片 -->
			<?php if (md_get_option(slider_content)== 'custom') { ?>					
					<div class="swiper-slide">
					<?php if (md_get_option('slider_img1')<>""){?>
						<div class="swiper-slide-image">
							<a href="<?php echo md_get_option('slider_url1') ?>" rel="bookmark"><img src="<?php echo md_get_option('slider_img1') ?>" alt="<?php echo md_get_option('slider_title1') ?>" /></a>							
						</div>
						<div class="swiper-slide-text">
							<h2><a href="<?php echo md_get_option('slider_url1') ?>" rel="bookmark"><?php echo md_get_option('slider_title1') ?></a></h2>
							<p>
								<a href="<?php echo md_get_option('slider_url1') ?>" rel="bookmark"><?php echo md_get_option('slider_describe1') ?></a>
							</p>
						</div> 
					</div>	
					<?php } ?>
					
					<?php if (md_get_option('slider_img2')<>""){?>					
					<div class="swiper-slide">
						<div class="swiper-slide-image">
							<a href="<?php echo md_get_option('slider_url2') ?>" rel="bookmark"><img src="<?php echo md_get_option('slider_img2') ?>" alt="<?php echo md_get_option('slider_title2') ?>" /></a>							
						</div>
						<div class="swiper-slide-text">
							<h2><a href="<?php echo md_get_option('slider_url2') ?>" rel="bookmark"><?php echo md_get_option('slider_title2') ?></a></h2>
							<p>
								<a href="<?php echo md_get_option('slider_url2') ?>" rel="bookmark"><?php echo md_get_option('slider_describe2') ?></a>
							</p>
						</div> 
					</div>	
					<?php } ?>
					
					<?php if (md_get_option('slider_img3')<>""){?>
					<div class="swiper-slide">
						<div class="swiper-slide-image">
							<a href="<?php echo md_get_option('slider_url3') ?>" rel="bookmark"><img src="<?php echo md_get_option('slider_img3') ?>" alt="<?php echo md_get_option('slider_title3') ?>" /></a>							
						</div>
						<div class="swiper-slide-text">
							<h2><a href="<?php echo md_get_option('slider_url3') ?>" rel="bookmark"><?php echo md_get_option('slider_title3') ?></a></h2>
							<p>
								<a href="<?php echo md_get_option('slider_url3') ?>" rel="bookmark"><?php echo md_get_option('slider_describe3') ?></a>
							</p>
						</div> 
					</div>	
					<?php } ?>

					<?php if (md_get_option('slider_img4')<>""){?>
					<div class="swiper-slide">
						<div class="swiper-slide-image">
							<a href="<?php echo md_get_option('slider_url4') ?>" rel="bookmark"><img src="<?php echo md_get_option('slider_img4') ?>" alt="<?php echo md_get_option('slider_title4') ?>" /></a>							
						</div>
						<div class="swiper-slide-text">
							<h2><a href="<?php echo md_get_option('slider_url4') ?>" rel="bookmark"><?php echo md_get_option('slider_title4') ?></a></h2>
							<p>
								<a href="<?php echo md_get_option('slider_url4') ?>" rel="bookmark"><?php echo md_get_option('slider_describe4') ?></a>
							</p>
						</div> 
					</div>
					<?php } ?>
			<?php } ?>	
		</div>

        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
</div>

<script src="<?php echo get_template_directory_uri(); ?>/inc/slider/swipe.jquery.min.js"></script>
   <script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        loop: true, /**循环**/
		autoplayDisableOnInteraction: false,
		direction: '<?php echo md_get_option('slider_direction'); ?>',	/**切换方向**/	
		speed: <?php echo md_get_option('slider_speed'); ?>,  /**幻灯片切换时间**/
		autoplay: <?php echo md_get_option('slider_autoplay'); ?>, /**设置，自动播放开启，并设置停留时间**/
        paginationClickable: true, /**导航可以点击**/
		effect: '<?php echo md_get_option('slider_effect'); ?>', /**切换效果**/	
		
		<?php if (md_get_option('slider_effect') == "fade"){?>
		/**切换效果fade设置**/
		fade: {crossFade: true,}
		<?php }?>
		
		<?php if (md_get_option('slider_effect') == "cube"){?>
		/**切换效果cube设置**/
		cube: {
			slideShadows: false,
			shadow: false,
			shadowOffset: 20,
			shadowScale: 0.8
		}
		<?php }?>		
    });
</script>

