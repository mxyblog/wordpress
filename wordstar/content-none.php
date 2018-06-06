<?php /** 
 * WordStar content none file
 *
 * @category WordPress
 * @package  WordStar
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/wordstar/
 *
 */
 ?>

<section class="no-results not-found">
  <article id="post-0" class="post no-results not-found">
    <header class="page-header entry-header">
      <h1 class="page-title entry-title p-entry-title">
        <?php esc_html_e('Nothing Found', 'wordstar'); ?>
      </h1>
    </header>
    <div class="page-content entry-content e-entry-content">
      <?php if (wordstar_is_home_page() && current_user_can('publish_posts') ) : ?>
      <p><?php echo esc_html__('Ready to publish your first post? ', 'wordstar').'<a href="'.esc_url(admin_url('post-new.php')).'">'.esc_html__('Get started here.', 'wordstar').'</a>'; ?></p>
      <?php elseif (is_search() ) : ?>
      <p>
        <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wordstar'); ?>
      </p>
      <div class="search-form-wrap">
        <?php get_search_form(); ?>
      </div>
      <?php else : ?>
      <p>
        <?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wordstar'); ?>
      </p>
      <div class="search-form-wrap">
        <?php get_search_form(); ?>
      </div>
      <?php endif; ?>
    </div>
  </article>
</section>
