<?php get_template_part('templates/page', 'header'); ?>

<section class="content-block native-content container">
	<?php while (have_posts()) : the_post(); ?>
		<?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
	<?php endwhile; ?>

	<?php the_posts_navigation(); ?>
</section>