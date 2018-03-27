<?php

/***
 * Returns first page matching a page-template.php file
 */
function ay_get_page_per_template($template) {
	$transient_name = 'ay_page_template_' . $template;

	if (false === ($result = get_transient($transient_name))) {
		$args = array(
			'post_type'  => 'page',
			'meta_query' => array(
				array(
					'key' => '_wp_page_template',
					'value' => $template,
					'compare' => '='
				)
			),
		);
		$page = get_posts($args);

		if (is_array($page) && !empty($page)) {
			$result = array(
				'ID' => $page[0]->ID,
				'title' => $page[0]->post_title,
				'link' => get_permalink($page[0]->ID)
			);

			set_transient($transient_name, $result, 43200);

			return $result;
		}

		return false;
	}

	return $result;
}


/**
 * Get current site slug
 */
function ay_site_slug($name) {
	if ($name) {
		return apply_filters('ay_site_name', 'Ayiha');
	}

	return apply_filters('ay_site_slug', 'ayiha');
}



/**
 * Get image from assets directory
 */
function ay_asset_image($image = 'ayiha_logo.svg') {
	return get_template_directory_uri() . '/dist/images/ayiha_logo.svg';
}


/**
 * Debug
 */
function debug_log($log, $var_dump = false) {
	if (true === WP_DEBUG) {
		error_log('--------------------------------- /!\\' . ay_site_slug() . '/!\ --------------------------------- ');
		if (!$var_dump) {
			if ( is_array( $log ) || is_object( $log ) ) error_log( print_r( $log, true ) );
			else error_log( $log );
		} else {
			ob_start();
			var_dump($log);
			error_log(ob_get_contents());
			ob_end_clean();
		}
		error_log('--------------------------------- /!\\' . ay_site_slug() . '/!\ --------------------------------- ');
	}
}


/**
 * Pretty print
 */
function pp($arr, $admin = false, $echo = true) {
	$output = '';

	$id = "debug-pp-" . rand(0, 1000);

	$extra_class = ($admin) ? 'admin' : '';

	if ($admin && current_user_can('manage_options')) {
		$output .= "<a class='debug-pp-link-debug' href='#" . $id . "'>debug</a>";
		$output .= "<a class='debug-pp-link-close' href='#'>x</a>";
	}

	if (($admin && current_user_can('manage_options')) || !$admin) {
		$output .= "<pre style='text-align:left;' class='debug-pp " . $extra_class . "' id='" . $id . "'><code>";
		$output .= print_r($arr, true);
		$output .= "</code></pre>";
	}

	if ($echo) {
		echo $output;
	} else {
		return $output;
	}
}