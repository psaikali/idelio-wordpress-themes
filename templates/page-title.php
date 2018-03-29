<section id="page-title">
	<?php if (function_exists('yoast_breadcrumb')) {
		yoast_breadcrumb('<nav class="breadcrumbs">', '</nav>');
	} ?>
	<?php ay_page_title(); ?>
	<?php ay_page_subtitle(); ?>
</section>