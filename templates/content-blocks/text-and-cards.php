<?php $cards_count = count(get_sub_field('cards')); ?>
<section class="content-block text-cards container">
	<?php if (get_sub_field('text_first')) { ?>
		<div class="text">
			<?php echo wpautop(do_shortcode(get_sub_field('intro_text'))); ?>
		</div>
	<?php } ?>
	
	<?php if (have_rows('cards')) { ?>
		<div class="cards has-<?php echo $cards_count; ?>-cards">
		<?php while (have_rows('cards')) { the_row();
			$icon = get_sub_field('icon'); ?>
			
			<article class="card">
				<?php if ($icon) { ?>
					<figure class="icon">
						<img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
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