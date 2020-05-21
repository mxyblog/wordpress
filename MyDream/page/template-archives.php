<?php
/*
Template Name: 文章归档
*/
?>
<?php get_header(); ?>

<style type="text/css">
#archives {position:relative;font: 15px "Microsoft YaHei",helvetica, Arial, Lucida Grande, Tahoma, sans-serif;color: #444;line-height: 180%;}
#archives p {padding-left:30px}
#archives h3 {font-size:20px;font-weight:400;margin-bottom:0;padding:0 15px;text-align:center;letter-spacing:5px;border-bottom:1px solid #ddd}
#archives ul {font-size:15px;margin:0 30px;padding:10px 0 20px 10px;list-style:none;border-left:1px solid #ddd}
#archives li {line-height:30px;position:relative}
#archives ul ul {margin:-15px 0 0 0;padding:15px 0 10px 0}
#archives ul ul li {padding:0 0 0 15px}
#archives ul ul li:before {position:absolute;top:10px;left:0;content:'';border-top:5px dashed transparent;border-bottom:5px dashed transparent;border-left:10px solid #ddd}
#expand_collapse {font-size:14px;line-height:24px;display:inline-block;padding:0 10px;text-decoration:none;color:#fff;background:#2f889a}
#expand_collapse:hover {background:#104040}
#archives em {font-size:14px;padding-left:5px;color:#777}
#archives .mon {font-size:16px;font-weight:700;padding-left:5px}
#archives .mon:after {position:absolute;top:15px;left:-10px;width:10px;height:1px;content:'';background:#ddd}
#archives .mon em {font-size:14px;font-weight:400}

.archives-meta{padding:20px}
.archives ol,ul{list-style: none;}
</style>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">				
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>				
					<div class="archives-meta">
						站点统计：共发表了<?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?> 篇文章&nbsp;&nbsp;
						<?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?>条留言&nbsp;&nbsp;
						浏览量：<?php echo all_view(); ?>&nbsp;&nbsp;
						最后更新：<?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y年n月j日', strtotime($last[0]->MAX_m));echo $last; ?>
					</div>
				</header><!-- .entry-header -->
				<div class="entry-content"><?php md_archives_list(); ?></div>
			</article><!-- #page -->
		<?php endwhile;?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>