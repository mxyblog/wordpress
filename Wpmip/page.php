<?php defined( 'ABSPATH' )  or exit; get_header(); ?>
<div id="container">
	<div class="page">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h2 class="page_title"><?php the_title(); ?></h2>
		<div class="page_content">
			<p><?php the_content(); ?></p>
		</div>
	</div>
</div>
<?php endwhile; else: ?><?php endif; ?>
<div class="clear"></div>
<?php get_footer(); ?>