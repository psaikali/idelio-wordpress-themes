<?php // Variables

$logo_data = get_field('footer_logo', 'option');
$logo = (isset($logo_data['url'])) ? $logo_data['url'] : null;
$logo_alt = sprintf('%1$s - %2$s', get_bloginfo('name'), get_bloginfo('description'));

?>

<aside id="pre-footer">
	<?php ay_pre_footer(); ?>
</aside>

<footer id="footer">
	<div class="container">
		<header>
			<a class="logo" href="<?= esc_url(home_url('/')); ?>">
				<?php if ($logo) { ?>
				<img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr($logo_alt); ?>" />
				<?php } else { ?>
				<h2><?php bloginfo('name'); ?></h2>
				<?php } ?>
			</a>
		</header>

		<div class="row">
			<div class="credits">
				<div class="about">
					<?php echo get_field('footer_text', 'option'); ?>
				</div>

				<div class="copyright">
					<?php echo apply_filters('ay_copyright_text', get_field('footer_copyright', 'option')); ?>
					<nav class="footer-navigation">
						<?php if (has_nav_menu('footer_navigation')) { wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'menu', 'container' => false]); } ?>
					</nav>
				</div>
			</div>

			<div class="widget">
				<?php echo get_field('footer_widget', 'option'); ?>
			</div>
		</div>
	</div>
</footer>
