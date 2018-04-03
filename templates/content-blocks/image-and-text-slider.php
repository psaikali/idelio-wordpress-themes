<?php $slides_count = count(get_sub_field('slides')); ?>
<section class="content-block image-and-text container">
	<div class="container">
		<header class="section-title">
			<?php echo wpautop(do_shortcode(get_sub_field('intro_text'))); ?>
		</header>
	</div>

	<div class="slider-container">
		<?php if ($slides_count > 1) { ?>
		<nav class="arrows"></nav>
		<?php } ?>
		
		<div class="slides <?php echo ($slides_count > 1) ? 'multiple' : 'single'; ?>">
			<?php if (have_rows('slides')) { $s = 0;
				while (have_rows('slides')) { the_row();
					$background_image = get_sub_field('background_image'); ?>

					<article class="slide slide-<?php echo ++$s; ?>">
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
	</div>
</section>