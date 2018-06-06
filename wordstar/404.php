<?php /**
 * WordStar 404 Page File
 *
 * @category WordPress
 * @package  WordStar
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/wordstar/
 *
 */
get_header();?>

<main id="main" class="site-main content-area not-found-page" role="main">
  <article id="post-0" class="post error404 not-found fof-page">
    <header class="entry-header screen-reader-text">
      <h1 class="entry-title p-entry-title">
        <?php esc_html_e( 'Page Not Found', 'wordstar' ); ?>
      </h1>
    </header>
    <div class="entry-content e-entry-content">
      <h1 class="page-title"><?php echo esc_html_e('404', 'wordstar'); ?></h1>
      <h2 class="page-title"><?php echo esc_html_e('Oops! That page can&rsquo;t be found.', 'wordstar'); ?></h2>
      <p>
        <?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'wordstar'); ?>
      </p>
      <div class="search-form-wrap">
        <?php get_search_form(); ?>
      </div>
      <div class="clear"></div>
    </div>
  </article>
  <div class="clear"></div>
</main>
<?php get_footer(); ?>
