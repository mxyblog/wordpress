<?php
/**
 * Template Name: 文章归档
 *
 */

get_header(); ?>

<section id="layout" class="main-load">
	<?php if ( has_post_thumbnail() ) : ?>
		<div style="background:#f5f5f5 url('<?php echo get_post_thumbnail();?>') center;background-size:cover;" class="neck-cover">
		</div>
	<?php else : ?>
		<style>
		.post-layout{margin-top:7em;}
		.page .primary-menu li a, .single .primary-menu li a{color:#000!important;}
		#logo{color:#000!important;}
		#logo:hover{color:#6E7173!important;}
		.current-menu-item, .current-menu-parent, .current-post-ancestor, .current-post-parent {border-bottom: 2px solid #000!important;}
		.post-date,.post-header-title{color:#333!important;}
		</style>
	<?php endif; ?>
	<div class="post-layout">
		<div class="body_container">
			<div class="pure-g">
				<div class="hidden-if-min pure-u-sm-1-16 pure-u-md-1-6">
					<div class="post-aside">
					</div>
				</div>
				<div class="pure-u-1 pure-u-sm-7-8 pure-u-md-2-3 post-body">
					<div class="post">
						<div class="post-title-position-box">
							<h1 class="post-header-title"><?php the_title(); ?></h1>
						</div>
						<article id="post-<?php the_ID(); ?>" class="post-content">
							<!-- 文章归档 -->
							<div class="archives">
					            <div class="archives_tags">
					                <h3>标签云</h3>
					                    <?php wp_tag_cloud(); ?>
					            </div>
					            <div class="archives-content">
					                <?php
					                $the_query = new WP_Query('posts_per_page=-1&ignore_sticky_posts=1'); //update: 加上忽略置顶文章
					                $year = 0;
					                $mon = 0;
					                $i = 0;
					                $j = 0;
					                $all = array();
					                $output = '<div class="archives-list">';
					                while ($the_query->have_posts()) : $the_query->the_post();
					                    $year_tmp = get_the_time('Y');
					                    $mon_tmp = get_the_time('n');
					                    //var_dump($year_tmp);
					                    $y = $year;
					                    $m = $mon;
					                    if ($mon != $mon_tmp && $mon > 0)
					                        $output .= '</div></div>';
					                    if ($year != $year_tmp) {
					                        $year = $year_tmp;
					                        $all[$year] = array();
					                    }

					                    if ($mon != $mon_tmp) {
					                        $mon = $mon_tmp;
					                        array_push($all[$year], $mon);
					                        $output .= "<div class='archives-title' id='arti-$year-$mon'><h3>$year-$mon<a class='articles-all-month' href='/date/$year/$mon'>查看当月全部文章</a></h3><div class='archives-$mon' data-date='$year-$mon'>"; //输出月份
					                    }
					                    $output .= '<a href="' . get_permalink() . '"><span class="time">' . get_the_time('n-d') . '</span>' . get_the_title() . '<i>' . get_comments_number() .' 则留言</i></a>'; //输出文章日期和标题
					                endwhile;
					                wp_reset_postdata();
					                $output .= '</div></div></div>';
					                echo $output;
					                ?>
					            </div>
					        </div>
				        </article>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();