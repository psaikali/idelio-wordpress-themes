<?php // Variables

$background = get_field('background');
$illustration = get_field('illustration');
$main_text = get_field('main_text');
$promo_text = get_field('promo_text');

?>

<section id="hero">
	<div class="container">
		<div class="main-text">
			<?php echo wpautop(do_shortcode($main_text)); ?>

			<div class="buttons">
				<?php if (have_rows('buttons')) {
					while (have_rows('buttons')) {
						the_row();
						if (have_rows('main_button')) {
							while (have_rows('main_button')) {
								the_row(); ?>
								<a href="<?php echo esc_url(get_sub_field('link')); ?>" class="button first"><?php the_sub_field('label'); ?></a>
							<?php }
						}
						if (have_rows('secondary_link')) {
							while (have_rows('secondary_link')) {
								the_row(); ?>
								<a href="<?php echo esc_url(get_sub_field('link')); ?>" class="link second"><?php the_sub_field('label'); ?></a>
							<?php }
						}
					}
				} ?>
			</div>
		</div>

		<?php if ($illustration) { ?>
		<figure class="illustration">
			<img src="<?php echo $illustration['url']; ?>" alt="<?php echo $illustration['alt']; ?>" />
		</figure>
		<?php } ?>
		
		<?php if (strlen(trim($promo_text)) > 0) { ?>
		<aside class="promo-text">
			<?php echo wpautop(do_shortcode($promo_text)); ?>
		</aside>	
		<?php } ?>
	</div>
</section>