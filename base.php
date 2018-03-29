<?php use Roots\Sage\Setup; use Roots\Sage\Wrapper; ?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<?php get_template_part('templates/head'); ?>
	<body <?php body_class(); ?>>
		<?php get_template_part('templates/sub-header'); ?>
		<?php get_template_part('templates/header'); ?>
	
		<main id="page" role="document">
			<?php include Wrapper\template_path(); ?>
		</main><!-- /#page -->
	
	<?php get_template_part('templates/footer');
	wp_footer(); ?>
	</body>
</html>
