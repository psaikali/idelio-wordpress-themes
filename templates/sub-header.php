<aside id="utility-bar">
	<div class="container-fluid">
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