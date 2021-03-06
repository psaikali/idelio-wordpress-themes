<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
	// Enable features from Soil when plugin is activated
	// https://roots.io/plugins/soil/
	add_theme_support('soil-clean-up');
	add_theme_support('soil-nav-walker');
	add_theme_support('soil-nice-search');
	add_theme_support('soil-jquery-cdn');
	add_theme_support('soil-relative-urls');

	// Make theme available for translation
	// Community translations can be found at https://github.com/roots/sage-translations
	load_theme_textdomain('ayiha', get_template_directory() . '/lang');

	// Enable plugins to manage the document title
	// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
	add_theme_support('title-tag');

	// Register wp_nav_menu() menus
	// http://codex.wordpress.org/Function_Reference/register_nav_menus
	register_nav_menus([
		'primary_navigation' => __('Nav principale', 'ayiha'),
		'secondary_navigation' => __('Nav secondaire', 'ayiha'),
		'utility_navigation' => __('Nav utilitaire', 'ayiha'),
		'footer_navigation' => __('Nav footer', 'ayiha'),
	]);

	// Enable post thumbnails
	// http://codex.wordpress.org/Post_Thumbnails
	// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
	// http://codex.wordpress.org/Function_Reference/add_image_size
	add_theme_support('post-thumbnails');
	add_post_type_support('page', 'excerpt');

	// Enable post formats
	// http://codex.wordpress.org/Post_Formats
	//add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

	// Enable HTML5 markup support
	// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
	add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

	// Use main stylesheet for visual editor
	// To add custom styles edit /assets/styles/layouts/_tinymce.scss
	add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
	register_sidebar([
		'name'					=> __('Primary', 'ayiha'),
		'id'					=> 'sidebar-primary',
		'before_widget' 		=> '<section class="widget %1$s %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3>',
		'after_title'	 => '</h3>'
	]);

	register_sidebar([
		'name'					=> __('Footer', 'ayiha'),
		'id'						=> 'sidebar-footer',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3>',
		'after_title'	 => '</h3>'
	]);
}
//add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
	static $display;

	isset($display) || $display = in_array(true, [
		// The sidebar will BE displayed if ANY of the following return true.
		// @link https://codex.wordpress.org/Conditional_Tags
		// is_404(),
		// is_front_page(),
		// is_page_template('template-custom.php'),
	]);

	return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
	wp_enqueue_style('google/fonts', 'https://fonts.googleapis.com/css?family=Roboto:400,400i,500,700|Palanquin+Dark', false, null);
	wp_enqueue_style('fa/font-base', 'https://use.fontawesome.com/releases/v5.0.9/css/fontawesome.css', false, null);
	wp_enqueue_style('fa/font-set', 'https://use.fontawesome.com/releases/v5.0.9/css/solid.css', false, null);
	wp_enqueue_style('ayiha/css', Assets\asset_path('styles/main.css?v=' . 1), false, null);

	wp_enqueue_script('slick/slider', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', ['jquery'], null, true);
	wp_enqueue_script('ayiha/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);