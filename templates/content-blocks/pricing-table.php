<?php $plans_count = count(get_sub_field('plans')); ?>
<section class="content-block pricing-table">
	<div class="container">
		<div class="container">
			<header class="section-title">
				<?php echo wpautop(do_shortcode(get_sub_field('intro_text'))); ?>
			</header>
		</div>

		<?php if (have_rows('plans')) { ?>
			<div class="plans has-<?php echo $plans_count; ?>-plans">
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
								<i class="icon fas fa-<?php echo (get_sub_field('included')) ? 'check-circle yes' : 'times-circle no'; ?>"></i>
								<span><?php echo get_sub_field('name'); ?></span>
							</li>
							<?php } ?>
						</ul>
						<?php }
						
						if (have_rows('button')) {
							while (have_rows('button')) { the_row(); 
								if (get_sub_field('link') != '') { ?>
								<a href="<?php echo esc_url(get_sub_field('link')); ?>" class="button"><?php echo get_sub_field('label'); ?></a>
							<?php }
							}
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