<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="page">
		<header class="entry-header">
			<h1 class="entry-title">亲，我们貌似走错了地方了！</h1>	
		</header>			
		<div class="single-content">
			<p>
				<img src="<?php echo get_stylesheet_directory_uri();?>/img/404.jpg" alt="404页面未找到" class="aligncenter"></img>
			</p>
			<p>你找的东西，我翻遍了所有的箱子都未找到！</p>
			<p>可以尝试使用下面的搜索功能，查找您喜欢的文章！</p>
			<p style="width:700px"><?php get_search_form(); ?></p>		
		</div>		
	</div>
	<?php get_template_part( 'inc/related-img' ); ?>
</div>		
<?php get_sidebar(); ?>
<?php get_footer(); ?>