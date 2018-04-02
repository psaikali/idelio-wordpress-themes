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


/**
 * Pre-footer : change pre-footer featured pages title
 */
function ay_prefooter_change_features_pages_section_title($title) {
	return sprintf(
		'<h5 class="h3">%1$s</h5>',
		__('Nos autres <strong>services</strong>', 'ayiha')
	);
}

/**
 * Replace variables in copyright text
 */
function ay_replace_vars_in_footer($content) {
	return str_replace('%year%', date('Y'), $content);
}
add_filter('ay_copyright_text', 'ay_replace_vars_in_footer');


/**
 * Display icon before menu items
 */
function ay_display_icon_in_menu_items($items, $args) {
	foreach ($items as &$item) {
		$icon = get_field('icon', $item);
		
		if ($icon) {
			$item->title = sprintf(
				'<i class="icon far fa-%1$s"></i><span>%2$s</span>',
				$icon,
				$item->title
			);
		}
	}
	
	return $items;
}
add_filter('wp_nav_menu_objects', 'ay_display_icon_in_menu_items', 10, 2);


/**
 * Add extra code in <head>
 */
function ay_custom_code_in_head() {
	echo get_field('extra_html_head', 'option');
}
add_action('wp_head', 'ay_custom_code_in_head');


/**
 * Add extra code in <footer>
 */
function ay_custom_code_in_footer() {
	echo get_field('extra_html_footer', 'option');
}
add_action('wp_footer', 'ay_custom_code_in_footer');


/**
 * Add extra code in <footer>
 */
function ay_custom_code_css_in_head() {
	printf(
		'<style>%1$s</style>',
		get_field('extra_css', 'option')
	);
}
add_action('wp_head', 'ay_custom_code_css_in_head');