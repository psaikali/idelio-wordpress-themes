<?php

/**
 * Load ayiya parent theme stylesheet + child theme stylesheet
 */
function ay_enqueue_styles(){
	wp_enqueue_style( 'ayiya-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/css/child.css' );
}
add_action('wp_enqueue_scripts', 'ay_enqueue_styles');


/**
 * Add child theme body class
 */
function ay_child_body_class($classes) {
	$classes[] = 'idelio';

	return $classes;
}
add_filter('body_class', 'ay_child_body_class');


/**
 * Change site name
 */
function ay_change_site_name($name) {
	return 'idelio';
}
add_filter( 'ay_site_name', 'ay_change_site_name' );


/**
 * Change site slug
 */
function ay_change_site_slug($name) {
	return 'idelio';
}
add_filter( 'ay_site_slug', 'ay_change_site_slug' );


/**
 * Change header container classes
 */
function ay_header_container_classes( $class ) {
	return 'container';
}
add_filter( 'ay_header_container_class', 'ay_header_container_classes' );


/**
 * Load ACF json data
 */
function ay_acf_change_json_load_point( $path ) {
	$path[] = get_template_directory() . '/acf-json';
	$path[] = get_stylesheet_directory() . '/acf-json';
	return array_unique( $path );
}
add_filter( 'acf/settings/load_json', 'ay_acf_change_json_load_point' );