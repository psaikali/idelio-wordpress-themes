<?php

/**
 * Page titles
 */
function ay_page_title() {
	if (is_home()) {
		if (get_option('page_for_posts', true)) {
			$title = get_the_title(get_option('page_for_posts', true));
		} else {
			$title = __('Dernières actualités', 'ayiha');
		}
	} elseif (is_archive()) {
		$title = get_the_archive_title();
	} elseif (is_search()) {
		$title = sprintf(__('Recherche de <em>%s</em>', 'ayiha'), get_search_query());
	} elseif (is_404()) {
		$title = __('Page introuvable', 'ayiha');
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
		if (is_search() || is_404()) return;
		
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
			wp_kses_post(nl2br($subtitle))
		);
	}
}


/**
 * Get page background image
 */
function ay_get_page_background_image($post_id = null, $return_if_none = true) {
	if (!$post_id) {
		if (is_home() || is_archive() || is_category() || is_author()) {
			$image = get_the_post_thumbnail_url(get_option('page_for_posts', true), 'full');
		} else {
			$image = get_the_post_thumbnail_url(null, 'full');
		}

		if (empty($image) || strlen($image) == 0) {
			return ($return_if_none) ? ay_asset_image('default_background.jpg') : false;
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
					add_filter('ay_featured_pages_intro_text', 'ay_prefooter_change_features_pages_section_title');
					get_template_part('templates/content-blocks/featured-pages');
					remove_filter('ay_featured_pages_intro_text', 'ay_prefooter_change_features_pages_section_title');
				}
			}
		}
		
		$post = $old_post;
	}
}