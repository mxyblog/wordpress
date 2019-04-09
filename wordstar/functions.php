<?php /**
 * WordStar Functions file
 *
 * @category WordPress
 * @package  WordStar
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/wordstar/
 *
 */
if (! isset($content_width) ) { $content_width = 1200;
}

// wordstar setup --------------->
add_action('after_setup_theme', 'wordstar_setup');
function wordstar_setup() 
{
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat' ));
    add_theme_support('html5', array('comment-form', 'comment-list', 'gallery', 'caption'    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(150, 150, true); 
    add_image_size('wordstar-post-medium', 400, 250, true);
    add_image_size('wordstar-post-big', 850, 300, true);
    add_image_size('wordstar-post-wide', 1200, 500, true);
    add_theme_support('custom-logo',
		 array(
			'height'      => 36,
			'width'       => 200,
			'flex-height' => true,
        ) 
    );
    add_theme_support("custom-header",
		 array(
			'width'        => 1600,
			'height'        => 100,
			'header-text' => true,
			'default-text-color'     => '1b52a7',
        )
    );
    add_theme_support( "custom-background", 
		 array( 'default-color' => 'EFEFEF',) 
    );
    add_editor_style(array());
    register_nav_menus(
        array(
        'primary' => __('Primary Menu', 'wordstar'),
        'footer'  => __('Footer Menu', 'wordstar'),
        ) 
    );
}// wordstar_setup

// wordstar setup --------------->
add_action('widgets_init', 'wordstar_widgets_init');
function wordstar_widgets_init() 
{
    register_sidebar(
        array(
        'name'          => __('Wordstar Widget Area', 'wordstar'),
        'id'            => 'wordstar-sidebar',
        'description'   => __('Add widgets here to appear in your sidebar.', 'wordstar'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '<div class="clear"></div></section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
        ) 
    );
	 register_sidebar(
        array(
        'name'          => __('Wordstar Social Widget Area', 'wordstar'),
        'id'            => 'wordstar-social-widget',
        'description'   => __('Create a custom Menu with your social profiles and add here as widget to appear in your sidebar.', 'wordstar'),
        'before_widget' => '<section id="%1$s" class="widget %2$s social-navigation">',
        'after_widget'  => '<div class="clear"></div></section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
        ) 
    );
}

// Adding scripts and CSS --------------->
add_action('wp_enqueue_scripts', 'wordstar_scripts');
function wordstar_scripts() 
{
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), null, 'all');
    wp_enqueue_style('wordstar-style', get_stylesheet_uri(), array(), null, 'all');
    wp_enqueue_style('wordstar-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), null, 'all');
        
    if(is_rtl()) {
        wp_enqueue_style('wordstar-rtl', get_template_directory_uri() . '/assets/css/rtl.css', array(), null, 'all');
    }
        
    if (is_singular() ) { wp_enqueue_script("comment-reply");   }
    wp_enqueue_script('html5shiv', get_template_directory_uri().'/assets/js/html5.js', array( 'jquery' ), null, false);
    wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');
    wp_enqueue_script('wordstar-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), null, true);
}

require get_template_directory() . '/inc/main-funtions.php';