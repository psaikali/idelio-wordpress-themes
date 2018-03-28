<?php // Variables

$logo_data = get_field('main_logo', 'option');
$logo = (isset($logo_data['url'])) ? $logo_data['url'] : null;
$logo_alt = sprintf('%1$s - %2$s', get_bloginfo('name'), get_bloginfo('description'));

?>

<section id="intro" style="background-image:url('<?php echo ay_get_page_background_image(); ?>');">
	<header id="masthead">
		<div class="container-fluid">
			<a class="logo" href="<?= esc_url(home_url('/')); ?>">
				<?php if ($logo) { ?>
				<img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr($logo_alt); ?>" />
				<?php } else { ?>
				<h2><?php bloginfo('name'); ?></h2>
				<?php } ?>
			</a>

			<nav class="primary-navigation">
				<?php if (has_nav_menu('primary_navigation')) { wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'menu', 'container' => false]); } ?>
			</nav>
		</div>
	</header>

	<?php if (is_page_template('template-homepage.php')) {
		get_template_part ('templates/home', 'hero');
	} else {
		get_template_part('templates/page', 'title');
	} ?>
</section>