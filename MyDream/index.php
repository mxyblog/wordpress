<?php 
if (! md_get_option('layout') || (md_get_option("layout") == 'blog')) {
	get_template_part( 'template/blog');
}
?>



