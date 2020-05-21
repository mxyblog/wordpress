<?php get_header(); ?>
	
<div id="primary" class="content-area">

	<article id="post" class="post">
		<header class="entry-header">
			<?php if ( !have_posts() ) : ?>
				<h1>没有找到有关【<?php echo htmlspecialchars($s); ?>】的内容</h1>	
				<?php else: ?>
				<h1>有关【<?php echo htmlspecialchars($s); ?>】的内容</h1>
			<?php endif; ?>
		</header>
	</article>		
		
		
	<main id="main" class="site-main" role="main">
			<?php if(have_posts()):while (have_posts()) : the_post();?>
			
			<?php get_template_part( 'template/content', get_post_format() ); ?>
			<?php endwhile; ?>
			<?php endif; ?>
	</main>
	<?php md_pagenav(); ?>		
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>