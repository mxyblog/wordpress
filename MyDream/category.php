<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="page">
		<div class="catepory-title">
			<div class="entry-header"><h1>分类：《<?php printf( '%s', single_cat_title( '', false ) ); ?>》</h1></div>	
			<?php if ( category_description() ) :  ?>
				<div class="catepory-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
		</div>
		<main id="main" class="site-main" role="main">		 
			<?php if(have_posts()):while (have_posts()) : the_post();?>			
			<?php get_template_part( 'template/content', get_post_format() ); ?>
			<?php get_template_part('ad/ad', 'archive'); ?>
			<?php endwhile; ?>
				<?php else : ?>	
					<div class="page">
						<div class="single-content">
							<p>该分类暂未添加文章！</p>
							<p>可以尝试使用下面的搜索功能，查找您喜欢的文章！</p>
							<?php get_search_form(); ?>							
						</div>
					</div>		
					<?php get_template_part( 'inc/related-img' ); ?>
			<?php endif; ?>
		</main>
	</div>	
	<?php md_pagenav(); ?>		
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>


