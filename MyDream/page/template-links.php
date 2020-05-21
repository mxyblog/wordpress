<?php
/*
Template Name: 友情链接
*/
?>
<?php get_header(); ?>

<style type="text/css">
.linkcat {padding: 0 0 10px 0;}
.link-all {max-width: 100%;	width: auto;height: auto; overflow: hidden;}
.link-all a img {max-width: 100%;width: auto;height: auto;margin: 0 auto;}
.link-all a {background: #fff;text-align: center;padding: 5px;display: block;white-space: nowrap;word-wrap: normal;text-overflow: ellipsis;overflow: hidden;border: 1px solid #ddd;border-radius: 2px;transition-duration: .5s;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);margin:-5px 5px 8px 5px}
.cx7 {float: left;min-height: 1px;padding: 2px;margin:0 auto;transition-duration: .5s;}
@media screen and (min-width:280px) {
	.cx7 {width: 50%;}
}
@media screen and (min-width:550px) {
	.cx7 {width: 33.33333333%;}
}
@media screen and (min-width:700px) {
	.cx7 {width: 25%;}
}
@media screen and (min-width:900px) {
	.cx7 {width: 20%;}
}
@media screen and (min-width:1024px) {
	.cx7 {width: 14.2857%;}
}
</style>
<div id="primary" class="single-area">
<main id="main" role="main">

	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">				
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
					<div class="single-content">
						<?php the_content(); ?>
						<?php edit_post_link('编辑', '<span class="edit-link">', '</span>' ); ?>
					</div> <!-- .single-content -->
					<ul>
						<?php wp_list_bookmarks('title_li=&before=<span class="cx7"><span class="link-all">&after=</span></span>&categorize=1&show_images=1&orderby=rating&order=DESC&category_orderby=description&category='.md_get_option('link_cat')); ?>
					</ul>
				<div class="clear"></div>
			</div><!-- .entry-content -->			
		</article><!-- #page -->		

	<?php endwhile; ?>	
	
	<?php comments_template( '', true ); ?>	

</main>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>