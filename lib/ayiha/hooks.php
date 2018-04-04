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
	return ' &hellip; <br><a class="link read-more" href="' . get_permalink() . '">' . __('Lire la suite', 'ayiha') . '</a>';
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
				'<i class="icon fas fa-%1$s"></i><span>%2$s</span>',
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


/**
 * Admin CSS for more understandable flexible content
 */
function ay_custom_css_in_admin() { ?>
<style>
.acf-fc-popup{
	width:80%;
	max-width:1200px;
	height:80%;
	max-height:1200px;
	top: 10% !important;
	left: 10% !important;
	bottom: 10% !important;
	right: 10% !important;
	border-radius:0;
	position: fixed !important;
	background: none !important;
	padding:0;
	box-sizing:border-box;
}
.acf-fc-popup *{
	box-sizing:border-box;
}
.acf-fc-popup::before, .acf-fc-popup::after {
	border-color:transparent !important;
}
.acf-fc-popup:before{
	top: -100% !important;
	right: 0 !important;
	bottom: 0 !important;
	left: -100% !important;
	position: fixed;
	background: rgba(0,0,0,0.8);
	height: 200vh;
	width: 200vw;
	margin: 0 !important;
	padding: 0;
	content: "";
}
.acf-fc-popup ul{
	overflow:auto;
	height:100%;
	width:100%;
	background:#f4f4f4;
	border:#ccc;
	padding:15px;
	position:relative;
	box-shadow:0 0 8px rgba(0, 0, 0, 0.5);
	padding-top: 100px !important;
}
.acf-fc-popup ul:before{
	position: absolute;
	top: 31px;
	content: "Ajouter un bloc de contenu";
	font-size: 23px;
	font-weight: 400;
	color: #333;
	left: 30px;
}
.acf-fc-popup ul:after{
	position: absolute;
	top: 62px;
	content: "Selectionnez le type de bloc de contenu à ajouter sur la page.";
	font-size: 14px;
	color: #666;
	left: 30px;
	font-style: italic;
}
.acf-fc-popup ul li{
	width: 33.33333%;
	padding: 1%;
	float: left;
}
@media only screen and (max-width:960px){
	.acf-fc-popup ul li{
		width: 50%;
    }
}
@media only screen and (max-width:782px){
	.acf-fc-popup{
		width:95%;
		height:88%;
	}
	.acf-fc-popup ul li{
		width: 100%;
    }
}
.acf-fc-popup ul li a {
	border:3px solid #ddd;
	background:#fff;
	padding:15px;
	color:#333;
	text-align: center;
	text-transform: uppercase;
}
.acf-fc-popup ul li a:hover {
	border-color:#fff;
}
.acf-fc-popup ul li a[data-layout]:before {
	content:"";
	display: block;
	height:0;
	width:100%;
	padding-bottom:50%;
	background: #333;
	position: relative;
	margin-bottom: .5rem;
	background-size: cover !important;
	border:1px solid #ddd;
}
.acf-fc-popup ul li a[data-layout=simple_content]:before {
	background:url('<?php echo get_template_directory_uri(); ?>/dist/images/admin-content-block-simple-content.jpg') center center;
}
.acf-fc-popup ul li a[data-layout=text_and_cards]:before {
	background:url('<?php echo get_template_directory_uri(); ?>/dist/images/admin-content-block-text-cards.jpg') center center;
}
.acf-fc-popup ul li a[data-layout=featured_pages]:before {
	background:url('<?php echo get_template_directory_uri(); ?>/dist/images/admin-content-block-featured-pages.jpg') center center;
}
.acf-fc-popup ul li a[data-layout=pricing_table]:before {
	background:url('<?php echo get_template_directory_uri(); ?>/dist/images/admin-content-block-pricing-table.jpg') center center;
}
.acf-fc-popup ul li a[data-layout=image_and_text_slider]:before {
	background:url('<?php echo get_template_directory_uri(); ?>/dist/images/admin-content-block-slider.jpg') center center;
}
</style>
<?php }
add_action('admin_head', 'ay_custom_css_in_admin');