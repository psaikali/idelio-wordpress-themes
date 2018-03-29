<?php

/**
 * Page titles
 */
function ay_page_title() {
	if (is_home()) {
		if (get_option('page_for_posts', true)) {
			$title = get_the_title(get_option('page_for_posts', true));
		} else {
			$title = __('Latest Posts', 'ayiha');
		}
	} elseif (is_archive()) {
		$title = get_the_archive_title();
	} elseif (is_search()) {
		$title = sprintf(__('Recherche de <em>%s</em>', 'ayiha'), get_search_query());
	} elseif (is_404()) {
		$title = __('Not Found', 'ayiha');
	} else {
		$title = get_the_title();
	}

	if ($title) {
		printf(
			'<h1>%1$s</h1>',
			$title
		);
	}
}


/**
 * Page subtitle
 */
function ay_page_subtitle($post_id = null) {
	$subtitle = null;

	if (!post_id) {
		if (is_home() || is_archive() || is_category() || is_author()) {
			if (get_option('page_for_posts', true)) {
				$subtitle = get_field('subtitle', get_option('page_for_posts', true));
			}
		} else {
			$subtitle = get_field('subtitle');
		}
	} else {
		$subtitle = get_field('subtitle', $post_id);
	}

	if ($subtitle) {
		printf(
			'<p class="subtitle">%1$s</p>',
			wp_kses_post($subtitle)
		);
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
function ay_get_page_background_image($post_id = null) {
	if (!post_id) {
		if (is_home() || is_archive() || is_category() || is_author()) {
			$image = get_the_post_thumbnail_url(get_option('page_for_posts', true), 'full');
		} else {
			$image = get_the_post_thumbnail_url(null, 'full');
		}

		if (empty($image) || strlen($image) == 0) {
			return ay_asset_image('default_background.jpg');
		}
	} else {
		$image = get_the_post_thumbnail_url($post_id, 'full');
	}

	return esc_url($image);
}