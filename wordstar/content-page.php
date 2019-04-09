<?php /**
 * WordStar page content file
 *
 * @category WordPress
 * @package  WordStar
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/wordstar/
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-content'); ?> <?php echo esc_html(wordstar_semantics( 'page' )); ?>>
  <header class="entry-header">
    <?php the_title('<h1 class="entry-title p-name" itemprop="name headline">', '</h1>');?>
  </header>
  <?php  wordstar_post_thumbnail('wordstar-post-wide');  ?>
  
  <div class="entry-meta">
    <?php wordstar_entry_meta(); ?>
  </div>
  <div class="entry-content e-content" itemprop="description text">
    <?php
                /* translators: %s: Name of current post */
                the_content(sprintf(__('Continue reading %s', 'wordstar'), the_title('<span class="screen-reader-text">', '</span>', false)));
                wp_link_pages(
                    array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'wordstar') . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . __('Page', 'wordstar') . ' </span>%',
                    'separator'   => '<span class="screen-reader-text">, </span>',
                    ) 
                );
            ?>
    <div class="clear"></div>
  </div>
</article>