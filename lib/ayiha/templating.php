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

	if (!$post_id) {
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
	if (!$post_id) {
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


/**
 * Pre-footer : display pages blocks from homepage
 */
function ay_pre_footer() {
	if (is_page_template('template-homepage.php')) return;

	$homepage = ay_get_page_per_template('template-homepage.php');

	if ($homepage) {
		global $post;

		$homepage_id = $homepage['ID'];
		$old_post = $post;

		$post = get_post($homepage_id);
		setup_postdata($post);

		if (have_rows('blocks', $homepage_id)) {
			$found = false;

			while (have_rows('blocks', $homepage_id) || !$found) { the_row();
				if (get_row_layout() == 'featured_pages') {
					$found = true;
					add_filter('ay_featured_pages_intro_text', '__return_false');
					get_template_part('templates/content-blocks/featured-pages');
					remove_filter('ay_featured_pages_intro_text', '__return_false');
				}
			}
		}
		
		$post = $old_post;
	}
}


/**
 * Replace variables in copyright text
 */
function ay_replace_vars_in_footer($content) {
	return str_replace('%year%', date('Y'), $content);
}
add_filter('ay_copyright_text', 'ay_replace_vars_in_footer');