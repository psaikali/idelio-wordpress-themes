<section class="content-block simple-content container">
	<div class="content-width size-<?php echo esc_attr(get_sub_field('content_width')); ?>">
		<?php echo apply_filters('the_content', get_sub_field('content')); ?>
	</div>
</section>