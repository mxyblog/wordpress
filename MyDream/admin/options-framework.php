<?php

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/admin/' );

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Don't load if optionsframework_init is already defined
if (is_admin() && ! function_exists( 'optionsframework_init' ) ) :

function optionsframework_init() {

	//  If user can't edit theme options, exit
	if ( ! current_user_can( 'edit_theme_options' ) )
		return;

	// Loads the required Options Framework classes.
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-framework.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-framework-admin.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-interface.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-media-uploader.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-sanitization.php';

	// Instantiate the main plugin class.
	$options_framework = new Options_Framework;
	$options_framework->init();

	// Instantiate the options page.
	$options_framework_admin = new Options_Framework_Admin;
	$options_framework_admin->init();

	// Instantiate the media uploader class
	$options_framework_media_uploader = new Options_Framework_Media_Uploader;
	$options_framework_media_uploader->init();
	wp_enqueue_style( 'optionsframework', OPTIONS_FRAMEWORK_DIRECTORY.'css/optionsframework.css' );
}

add_action( 'init', 'optionsframework_init', 20 );

endif;


/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * Not in a class to support backwards compatibility in themes.
 */

if ( ! function_exists( 'md_get_option' ) ) :

function md_get_option( $name, $default = false ) {
	$config = get_option( 'optionsframework' );

	if ( ! isset( $config['id'] ) ) {
		return $default;
	}

	$options = get_option( $config['id'] );

	if ( isset( $options[$name] ) ) {
		return $options[$name];
	}

	return $default;
}

endif;


/*  Add custom script to theme options  */
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');
add_action('optionsframework_after','exampletheme_options_after', 100);
}

function exampletheme_options_after() { ?>
		<div id="scroll-a">
			<div class="scroll-t"><a href="#optionsframework-wrap" title="直达顶部">▲</a></div>
			<div class="scroll-b"><a href="#optionsframework-submit" title="直达底部">▼</a></div>
		</div>
<?php
}

/*
 * This is an example of how to override a default filter
 * for 'textarea' sanitization and $allowedposttags + embed and script.
 */
add_action('admin_init','optionscheck_change_santiziation', 100);

function optionscheck_change_santiziation() {
   remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
   add_filter( 'of_sanitize_textarea', create_function('$input', 'return $input;') );
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */
add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#logos').click(function() {
  		jQuery('#section-logo').fadeToggle(400);
	});

	if (jQuery('#logos:checked').val() !== undefined) {
		jQuery('#section-logo').show();
	}

});
</script>

<?php
}