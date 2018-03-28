<?php use Roots\Sage\Setup; use Roots\Sage\Wrapper; ?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<?php get_template_part('templates/head'); ?>
	<body <?php body_class(); ?>>
	<!--[if IE]>
		<div class="alert alert-warning">
		<?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'ayiha'); ?>
		</div>
	<![endif]-->
	<?php get_template_part('templates/sub-header'); ?>
	<?php get_template_part('templates/header'); ?>
	<main id="page" role="document">
		<?php include Wrapper\template_path(); ?>
	</main><!-- /.main -->
	<?php
		do_action('get_footer');
		get_template_part('templates/footer');
		wp_footer();
	?>
	</body>
</html>
