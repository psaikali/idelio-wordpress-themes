<?php

/**
 * Add <body> classes
 */
function ay_body_class($classes) {
	// Add page slug if it doesn't exist
	if (is_single() || is_page() && !is_front_page()) {
		if (!in_array(basename(get_permalink()), $classes)) {
			$classes[] = basename(get_permalink());
		}
	}

	// Add class if sidebar is active
	if (Roots\Sage\Setup\display_sidebar()) {
		$classes[] = 'sidebar-primary';
	}

	return $classes;
}
add_filter('body_class', 'ay_body_class');

/**
 * Clean up the_excerpt()
 */
function ay_excerpt_more() {
	return ' &hellip; <a href="' . get_permalink() . '">' . __('Lire la suite', 'ayiha') . '</a>';
}
add_filter('excerpt_more', 'ay_excerpt_more');


/**
 * Put Yoast SEO metabox below
 */
function ay_change_wpseo_metabox_priority() {
	return 'low';
}
add_filter('wpseo_metabox_prio', 'ay_change_wpseo_metabox_priority');