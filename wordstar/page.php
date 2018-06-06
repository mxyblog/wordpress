<?php /** 
 * WordStar single page file
 *
 * @category WordPress
 * @package  WordStar
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/wordstar/
 *
 */
?>
<?php get_header(); ?>
<main id="main" class="site-main content-area single-post" role="main">
  <?php while ( have_posts() ) : the_post();
		get_template_part( 'content','page');
		comments_template( '', true ); 
	endwhile; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>