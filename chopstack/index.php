<?php
/**
 * 主模板文件
 *
 */

get_header(); ?>

<section id="layout">
	<main class="body_container">
		<div class="pure-g">
			<div class="post-cols">
				<div id="list_container">

					<?php
					if ( have_posts() ) :

						/* 首页文章列表排版 */
						$i = 1;
						while ( have_posts() ) : the_post(); ?>

							<?php if ( 1 === $i ) : ?>
									<?php get_template_part( 'template-parts/content', 'first-post' ); ?>
							<?php else : ?>
									<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
							<?php endif; ?>

							<?php
							$i++;
						endwhile;

						the_posts_navigation( array(
							'prev_text' => esc_html__( '下一页', 'chopstack' ),
							'next_text' => esc_html__( '上一页', 'chopstack' ),
						) );

					endif; ?>

				</div>
			</div>
		</div>
	</main><!-- #main -->
<style>
#logo{color:#000!important;}
#logo:hover{color:#6E7173!important;}
.current-menu-item,.current-menu-parent,.current-post-ancestor,.current-post-parent{border-bottom:2px solid #000}
</style>
</section>

<?php
get_footer();