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
						$icon = get_sub_field('icon');
						
						if ($icon) { ?>
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
						}
					} ?>
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
	
				<?php if ($pages = get_sub_field('pages')) {
					foreach ($pages as $page_id) { ?>
						<a href="echo get_permalink($p);">
							echo get_the_title($p);
						</a>
					<?php }
				} ?>
			</section>
		<?php }


		/**
		 * Pricing table
		 */
		else if (get_row_layout() == 'pricing_table') { ?>
			<section class="content-block pricing-table">
				<div class="container">
					the_sub_field('intro_text');

					if (have_rows('plans')) {
						while (have_rows('plans')) { the_row();
							if (get_sub_field('featured_plan') == 1) { 
								// echo 'true'; 
							} else { 
								// echo 'false'; 
							}
							
							the_sub_field('name_and_price');
							
							if (have_rows('features')) {
								while (have_rows('features')) { the_row();
									if (get_sub_field('included') == 1) { 
										// echo 'true'; 
									} else { 
										// echo 'false'; 
									}

									the_sub_field('name');
								}
							}
							
							if (have_rows('button')) {
								while (have_rows('button')) { the_row();
									the_sub_field('label');
									the_sub_field('link');
								}
							}
						}
					
					the_sub_field('pricing_table_after_text');
				</div>
			</section>
		<?php }


		/**
		 * Image and text (one, or slider of multiple)
		 */
		else if (get_row_layout() == 'image_and_text_slider') { ?>
			<section class="content-block image-and-text container">
			the_sub_field('intro_text');

			count(get_field('slides'))

			if (have_rows('slides')) {
				while (have_rows('slides')) { the_row();
					$background_image = get_sub_field('background_image');
					if ($background_image) {
						//echo '<img src="echo $background_image['url'];" alt="echo $background_image['alt'];" />';
					}

					the_sub_field('text_content');
				}
			}
		</section>
		<?php }
	}
}