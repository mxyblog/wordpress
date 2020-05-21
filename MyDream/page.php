<?php get_header(); ?>
<div id="primary" class="single-area">
	<main id="main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">				
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
						<div class="single-content">
							<!-- 文章内容 -->
							<?php the_content(); ?>
							<?php edit_post_link('编辑', '<span class="edit-link">', '</span>' ); ?>
						</div> <!-- .single-content -->
					<div class="clear"></div>
				</div><!-- .entry-content -->			
			</article><!-- #page -->	
		<?php endwhile; ?>		
		<?php comments_template( '', true ); ?>	
	</main>
</div>
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>