<?php if (strlen(trim(get_the_content())) > 0 && apply_filters('ay_allow_native_content', false)) { ?>
	<section class="content-block native-content container">
		<?php the_content(); ?>
	</section>
<?php } ?>

<?php if (have_rows('blocks')) {
	while (have_rows('blocks')) { the_row();
		
		/**
		 * Simple content
		 */
		if (get_row_layout() == 'simple_content') { ?>
			<section class="content-block simple-content container">
				<div class="content-width <?php echo esc_attr(get_sub_field('content_width')); ?>">
					<?php echo apply_filters('the_content', get_sub_field('content')); ?>
				</div>
			</section>
		<?php }


		/**
		 * Text and cards
		 */
		else if (get_row_layout() == 'text_and_cards') { ?>
			<section class="content-block text-cards container">
				<?php if (get_sub_field('text_first')) { ?>
					<div class="text">
						<?php echo wpautop(do_shortcode(get_sub_field('intro_text'))); ?>
					</div>
				<?php } ?>
				
				<?php if (have_rows('cards')) { ?>
					<div class="cards has-<?php echo count(get_field('cards')); ?>-cards">
					<?php while (have_rows('cards')) { the_row();
						$icon = get_sub_field('icon'); ?>
						
						<article class="card">
							<?php if ($icon) { ?>
								<figure class="icon">
									<img src="echo $icon['url'];" alt="echo $icon['alt'];" />
								</figure>
							<?php } ?>
							
							<div class="card-content">
								<h4><?php echo get_sub_field('title'); ?></h4>
								<p><?php echo get_sub_field('paragraph'); ?></p>
							</div>

							<?php if (have_rows('button')) {
								while (have_rows('button')) { the_row(); ?>
									<a href="<?php echo esc_url(get_sub_field('link')); ?>" class="card-link"><?php echo get_sub_field('label'); ?></a>
								<?php }
							} ?>
						</article>

					<?php } ?>
					</div>
				<?php } ?>

				<?php if (!get_sub_field('text_first')) { ?>
					<div class="text">
						<?php echo wpautop(do_shortcode(get_sub_field('intro_text'))); ?>
					</div>
				<?php } ?>
			</section>
		<?php }


		/**
		 * Blocs of some featured pages
		 */
		else if (get_row_layout() == 'featured_pages') { ?>
			<section class="content-block featured-pages">
				<div class="container">
					<header class="section-title">
						<?php echo wpautop(do_shortcode(get_sub_field('intro_text'))); ?>
					</header>
				</div>
	
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
		<?php }


		/**
		 * Pricing table
		 */
		else if (get_row_layout() == 'pricing_table') { ?>
			<section class="content-block pricing-table">
				<div class="container">
					<div class="container">
						<header class="section-title">
							<?php echo wpautop(do_shortcode(get_sub_field('intro_text'))); ?>
						</header>
					</div>

					<?php if (have_rows('plans')) { ?>
						<div class="plans has-<?php echo count(get_field('plans')); ?>-plans">
							<?php while (have_rows('plans')) { the_row(); ?>
								<article class="plan <?php echo (get_sub_field('featured_plan')) ? 'featured' : ''; ?>">
									<header>
										<?php echo get_sub_field('name_and_price'); ?>
										<?php if (get_sub_field('featured_plan')) { ?><span class="featured-label"><?php _e('Le + populaire', 'ayiha'); ?></span><?php } ?>
									</header>
									
									<?php if (have_rows('features')) { ?>
									<ul class="features">
										<?php while (have_rows('features')) { the_row(); ?>
										<li>
											<i class="icon fa-<?php echo (get_sub_field('included')) ? 'check-circle' : 'times-circle'; ?>"></i>
											<span><?php echo get_sub_field('name'); ?></span>
										</li>
										<?php } ?>
									</ul>
									<?php }
									
									if (have_rows('button')) {
										while (have_rows('button')) { the_row(); ?>
											<a href="<?php echo esc_url(get_sub_field('link')); ?>" class="button"><?php echo get_sub_field('label'); ?></a>
										<?php }
									} ?>
								</article>
							<?php } ?>
						</div>
					<?php } ?>
					
					<footer class="after-text">
						<?php echo get_sub_field('pricing_table_after_text'); ?>
					</footer>
				</div>
			</section>
		<?php }


		/**
		 * Image and text (one, or slider of multiple)
		 */
		else if (get_row_layout() == 'image_and_text_slider') { ?>
			<section class="content-block image-and-text container">
				<div class="container">
					<header class="section-title">
						<?php echo wpautop(do_shortcode(get_sub_field('intro_text'))); ?>
					</header>
				</div>

				<div class="slides <?php echo (count(get_field('slides')) > 1) ? 'multiple' : 'single'; ?>">
					<?php if (have_rows('slides')) {
						while (have_rows('slides')) { the_row();
							$background_image = get_sub_field('background_image'); ?>

							<article class="slide">
								<figure class="slide-image <?php echo ($background_image) ? 'has-image' : 'no-image'; ?>">
								<?php if ($background_image) { ?>
									<img src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt']); ?>" />
								<?php } ?>
								</figure>
								<div class="slide-text">
									<?php echo wpautop(do_shortcode(get_sub_field('text_content'))); ?>
								</div>
							</article>
						<?php }
					} ?>
				</div>
		</section>
		<?php }
	}
}