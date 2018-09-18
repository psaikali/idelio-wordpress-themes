<?php $container_class = apply_filters( 'ay_header_container_class', 'container-fluid' ); ?>

<?php if ( ! has_nav_menu( 'utility_navigation' ) && ! has_nav_menu( 'secondary_navigation' ) ) {
	return; 
} ?>
<aside id="utility-bar">
	<div class="<?php echo esc_attr( $container_class ); ?>">
		<nav class="utility-navigation">
		<?php if (has_nav_menu('utility_navigation')) {
			wp_nav_menu(['theme_location' => 'utility_navigation', 'menu_class' => 'menu', 'container' => false]);
		} ?>
		</nav>
	
		<nav class="secondary-navigation">
		<?php if (has_nav_menu('secondary_navigation')) {
			wp_nav_menu(['theme_location' => 'secondary_navigation', 'menu_class' => 'menu', 'container' => false]);
		} ?>
		</nav>
	</div>
</aside>