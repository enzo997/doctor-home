<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
define('THEME_IMAGES', get_template_directory_uri().'/images');
define('DF_IMAGE',  get_template_directory_uri(). '/images/default');
define('THEME_PATH', get_template_directory());

// require THEME_PATH.'/templates-parts/item-dich-vu.php';

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
require get_template_directory() . '/function/function.php';
function pp_style() {
    wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'pp_style' );

add_action( 'after_setup_theme', 'pp_setup' );
function pp_setup() {
    load_theme_textdomain( 'pp' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'thumb-xs', 60 );
    add_image_size( 'thumb-sm', 270 );
    add_image_size( 'thumb-md', 370 );
    add_image_size( 'thumb-lg', 570 );
    add_image_size( 'thumb-xl', 870 );
    add_image_size( 'thumb-hd', 1920 );


    add_image_size( 'thumb_350x215', 350, 215, true );
    add_image_size( 'thumb_350x300', 350, 300, true );
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'pp' )
    ));
    //define( 'DISALLOW_FILE_EDIT', true );
}
function webp_upload_mimes( $existing_mimes ) {
	// add webp to the list of mime types
	$existing_mimes['webp'] = 'image/webp';

	// return the array back to the function with our added mime type
	return $existing_mimes;
}
add_filter( 'mime_types', 'webp_upload_mimes' );

@ini_set( 'upload_max_size' , '20M' );
@ini_set( 'post_max_size', '20M');
@ini_set( 'max_execution_time', '300' );


// Local JSON acf
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf-field';
    return $path;
}
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-field';
    return $paths;
}