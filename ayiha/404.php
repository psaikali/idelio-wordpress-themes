<?php get_template_part('templates/page', 'header'); ?>

<section class="content-block native-content container">
	<div class="alert alert-warning">
		<?php _e('Aucune page ne correspond à votre demande.', 'ayiha'); ?>
	</div>
	
	<?php get_search_form(); ?>
</section>