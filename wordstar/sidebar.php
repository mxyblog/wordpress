<?php /**
 * WordStar Sidebar file
 *
 * @category WordPress
 * @package  WordStar
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/wordstar/
 *
 */ 
if ( wordstar_active_sidebars() ) : ?>
<aside id="secondary" class="sidebar widget-area" role="complementary">
  <?php
	dynamic_sidebar('wordstar-social-widget');
	dynamic_sidebar('wordstar-sidebar'); 
?>
</aside>
<?php endif; ?>