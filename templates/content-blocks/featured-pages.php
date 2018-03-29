<section class="content-block featured-pages">
	<?php if (apply_filters('ay_featured_pages_enable_intro_text', true)) { ?>
	<div class="container">
		<header class="section-title">
			<?php echo apply_filters('ay_featured_pages_intro_text', wpautop(do_shortcode(get_sub_field('intro_text')))); ?>
		</header>
	</div>
	<?php } ?>

	<?php if ($pages = get_sub_field('pages')) { ?>
		<div class="pages has-<?php echo count($pages); ?>-pages">
		<?php foreach ($pages as $page_id) { $page = get_post($page_id); ?>
			<a href="<?php echo get_permalink($page_id); ?>">
				<div class="background-image" style="background-image:url('<?php echo ay_get_page_background_image($page_id); ?>');"></div>
				<header>
					<h4><?php echo $page->post_title; ?></h4>
					<?php ay_page_subtitle($page_id); ?>
				</header>
				<footer>
					<span class="link"><?php _e('En savoir plus', 'ayiha'); ?></span>
				</footer>
			</a>
		<?php } ?>
		</div>
	<?php } ?>
</section>