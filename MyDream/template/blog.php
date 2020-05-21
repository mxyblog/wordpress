<?php get_header(); ?>
 <!-- 幻灯片调用begin -->		
			<?php if (md_get_option('slider')) { ?>
				<?php if ( is_home() ) :
						get_template_part( 'inc/slider' );
					endif;
				?>	
			<?php } ?>
 <!-- 幻灯片调用end -->				
	<div id="primary" class="content-area">
		<!--文章提取规则begin-->
			<?php	
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				$notcat = explode(',',md_get_option('not_cat_n'));
				$args = array(
					'category__not_in' => $notcat,	 //排除不在首页显示的分类
					'ignore_sticky_posts' => 0,      //是否显示文章置顶，0显示 1不显示
					'paged' => $paged
				);	
				query_posts( $args );
			?>	
		<!--文章提取规则end-->
		<!--文章提取begin-->
			<?php if(have_posts()):while (have_posts()) : the_post();?>
				<?php get_template_part( 'template/content', get_post_format() );?>
				<?php get_template_part('ad/ad', 'archive'); ?>				
			<?php endwhile; ?>	
			<?php endif; ?>	
		<!--文章提取end-->	
		
		<?php md_pagenav(); ?>  <!--面包屑导航 -->
	</div>	
<?php get_sidebar(); ?>
<?php get_footer(); ?>