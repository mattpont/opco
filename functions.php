<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define('CB_THEME_DIR', WP_CONTENT_DIR . '/themes/opco');

require_once CB_THEME_DIR . '/inc/cb-theme.php';
require_once CB_THEME_DIR . '/inc/cb-finder.php';
require_once CB_THEME_DIR . '/inc/cb-help.php';
require_once CB_THEME_DIR . '/inc/cb-refer.php';

/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";
	
	$css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_styles );

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version );
	//wp_enqueue_script( 'jquery' );
	
	$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_scripts );
	
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $js_version, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'bootstrap-select', "https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css", array(), $css_version );
	wp_enqueue_script( 'bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js", array("child-understrap-scripts"), $js_version, true );
	wp_enqueue_script( 'popper', "https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js", array("child-understrap-scripts"), $js_version, true );
	wp_enqueue_script( 'bootstrap-select', "https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js", array("child-understrap-scripts"), $js_version, true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'opco', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );

/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );

add_filter( 'gform_submit_button', 'add_custom_css_classes', 10, 2 );
add_filter( 'gform_next_button', 'add_custom_css_classes', 10, 2 );
add_filter( 'gform_previous_button', 'add_custom_css_classes', 10, 2 );
function add_custom_css_classes( $button, $form ) {
    $fragment = WP_HTML_Processor::create_fragment( $button );
    $fragment->next_token();
    $fragment->add_class( 'btn' );
    $fragment->add_class( 'btn-primary' );
    $fragment->add_class( 'd-block' );
    $fragment->add_class( 'rounded-pill' );
    $fragment->add_class( 'w-100' );
    $fragment->remove_class( 'gform_button' );
    $fragment->remove_class( 'button' );
    $fragment->remove_class( 'gform-button--width-full' );
    return $fragment->get_updated_html();
}

add_filter('query_vars', 'add_my_var');
function add_my_var($public_query_vars) {
    $public_query_vars[] = 'company';
    return $public_query_vars;
}

function enqueue_autocomplete_script() {
    // Enqueue jQuery UI for autocomplete functionality
    wp_enqueue_script('jquery-ui-autocomplete');
    
    // Enqueue custom JavaScript for autocomplete
    wp_enqueue_script(
        'division-autocomplete',
        get_stylesheet_directory_uri() . '/js/division-autocomplete.js', // Update the path as needed
        ['jquery', 'jquery-ui-autocomplete'],
        '1.0',
        true
    );

    // Localize script to pass AJAX URL to JavaScript
    wp_localize_script('division-autocomplete', 'autocomplete_data', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_autocomplete_script');

function fetch_division_terms() {
    if (!isset($_GET['term'])) {
        wp_send_json_error('No search term provided.');
    }

    $search_term = sanitize_text_field($_GET['term']);

    $terms = get_terms([
        'taxonomy' => 'division',
        'name__like' => $search_term,
        'hide_empty' => false,
        'number' => 10,
    ]);

    if (is_wp_error($terms)) {
        wp_send_json_error($terms->get_error_message());
    }

    $results = [];
    foreach ($terms as $term) {
        $results[] = [
            'id' => $term->slug, // Send the term slug as 'id'
            'label' => $term->name, // Send the term name as 'label'
            'value' => $term->name, // Autocomplete's default 'value'
        ];
    }

    wp_send_json_success($results);
}
add_action('wp_ajax_fetch_division_terms', 'fetch_division_terms');
add_action('wp_ajax_nopriv_fetch_division_terms', 'fetch_division_terms');