<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class(); ?>>
		<?php if (strlen(trim(get_the_content())) > 0 && apply_filters('ay_allow_native_content', true)) { ?>
			<section class="content-block native-content container">
				<?php the_content(); ?>
			</section>
		<?php } ?>

		<?php if (have_rows('blocks')) {
			while (have_rows('blocks')) { the_row();
				$file_name = str_replace('_', '-', get_row_layout());
				$file_path = sprintf('templates/content-blocks/%1$s', $file_name);
				get_template_part($file_path);
			}
		} ?>
		<footer>
			<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'ayiha'), 'after' => '</p></nav>']); ?>
		</footer>
	</article>
<?php endwhile; ?>
