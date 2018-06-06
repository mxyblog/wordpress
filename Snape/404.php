<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Vtrois
 * @version 1.1
 */
$background_color = snape_option('background_color');
$background_image = snape_option('background_image');
get_header(); ?>
<div class="post-section blog-post" style="<?php echo (!snape_option('background_image')) ? 'background:' . $background_color  :'background-image: url('. $background_image .');' ; ?>">
    <div class="container">
        <div class="row">
            <section class="col-md-12">
	            <div class="hentry clearfix">
	                <div class="err-img text-center"><img src="<?php echo snape_option('error_image'); ?>"><br/><h1 class="post-notfound post-title-zw"><?php echo snape_option('error_text'); ?></h1></div>
	            </div>
            </section>
        </div>
    </div>
</div>
<?php get_footer(); ?>