<?php

/**
 * Page titles
 */
function ay_title() {
	if (is_home()) {
		if (get_option('page_for_posts', true)) {
			return get_the_title(get_option('page_for_posts', true));
		} else {
			return __('Latest Posts', 'ayiha');
		}
	} elseif (is_archive()) {
		return get_the_archive_title();
	} elseif (is_search()) {
		return sprintf(__('Search Results for %s', 'ayiha'), get_search_query());
	} elseif (is_404()) {
		return __('Not Found', 'ayiha');
	} else {
		return get_the_title();
	}
}


/**
 * Display icon before menu items
 */
function ay_display_icon_in_menu_items($items, $args) {
	foreach ($items as &$item) {
		$icon = get_field('icon', $item);
		
		if ($icon) {
			$item->title = sprintf(
				'<i class="icon fa-%1$s"></i><span>%2$s</span>',
				$icon,
				$item->title
			);
		}
	}
	
	return $items;
}
add_filter('wp_nav_menu_objects', 'ay_display_icon_in_menu_items', 10, 2);


/**
 * Get page background image
 */
function ay_get_page_background_image() {
	if (is_home() || is_archive() || is_category() || is_author()) {
		$image = get_the_post_thumbnail_url(get_option('page_for_posts', true), 'full');
	} else {
		$image = get_the_post_thumbnail_url(null, 'full');
	}

	if (empty($image) || strlen($image) == 0) {
		return ay_asset_image('default_background.jpg');
	}

	return $image;
}