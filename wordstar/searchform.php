<?php /**
 * WordStar search form file
 *
 * @category WordPress
 * @package  WordStar
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/wordstar/
 *
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
  <meta itemprop="target" content="<?php echo esc_url(home_url('/?s={search} '));?>"/>
  <span class="screen-reader-text"><?php echo esc_html_x('Search for:', 'label', 'wordstar'); ?></span> <i class="fa fa-search"></i>
  <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search &hellip;',  'placeholder', 'wordstar'); ?>" value="<?php echo get_search_query();?>" name="s" title="<?php echo esc_attr('Search', 'wordstar'); ?>" required itemprop="query-input">
  <button type="submit" class="search-submit"> <span ><?php echo esc_html_x('Search', 'submit button', 'wordstar'); ?></span> </button>
</form>