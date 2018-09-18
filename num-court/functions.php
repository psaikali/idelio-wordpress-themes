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
	$classes[] = 'numero-court';

	return $classes;
}
add_filter('body_class', 'ay_child_body_class');


/**
 * Change site name
 */
function ay_change_site_name($name) {
	return 'Numéro Court';
}
add_filter( 'ay_site_name', 'ay_change_site_name' );


/**
 * Change site slug
 */
function ay_change_site_slug($name) {
	return 'numcourt';
}
add_filter( 'ay_site_slug', 'ay_change_site_slug' );