<?php // Variables

$background = get_field('background');
$illustration = get_field('illustration');
$main_text = get_field('main_text');
$featured_pages = get_field('block_featured_pages');
$has_main_button = false;

?>

<section id="hero">
	<div class="container">
		<div class="main-text">
			<?php echo wpautop(do_shortcode($main_text)); ?>

			<div class="buttons">
				<?php if (have_rows('buttons')) {
					while (have_rows('buttons')) {
						the_row();
						if (have_rows('main_button')) {
							while (have_rows('main_button')) {
								the_row();

								if (strlen(get_sub_field('link')) > 0) {
									$has_main_button = true;
									?>
									<a href="<?php echo esc_url(get_sub_field('link')); ?>" class="button plain first"><?php the_sub_field('label'); ?></a>
								<?php }
							}
						}
						
						if (have_rows('secondary_link')) {
							while (have_rows('secondary_link')) {
								the_row(); 
								if (strlen(get_sub_field('link')) > 0) {
									if ($has_main_button) { ?>
									<span class="or"><?php _e('ou', 'ayiha'); ?></span>
									<?php } ?>
									<a href="<?php echo esc_url(get_sub_field('link')); ?>" class="link second"><?php the_sub_field('label'); ?></a>
								<?php }
							}
						}
					}
				} ?>
			</div>
		</div>

		<?php if ($illustration) { ?>
		<figure class="illustration">
			<img src="<?php echo $illustration['url']; ?>" alt="<?php echo $illustration['alt']; ?>" />
		</figure>
		<?php } ?>
	</div>
</section>

<?php if ( ! empty( $featured_pages ) ) { ?>
<section class="content-block featured-pages">
	<div class="container">
		<div class="pages has-<?php echo count( $featured_pages ); ?>-pages">
		<?php foreach ( $featured_pages as $page_id ) {
			$page = get_post( (int) $page_id ); ?>
			<a href="<?php echo get_permalink( $page_id ); ?>" class="page">
				<div class="page-content">
					<div class="background-image" style="background-image:url('<?php echo ay_get_page_background_image( $page_id ); ?>');"></div>
					<header>
						<h4><?php echo $page->post_title; ?></h4>
						<?php echo wpautop( wp_trim_words( $page->post_excerpt, 20 ) ); ?>
					</header>
					<footer>
						<span class="link"><?php _e('En savoir plus', 'ayiha'); ?></span>
					</footer>
				</div>
			</a>
		<?php } ?>
		</div>
	</div>
</section>
<?php } ?>