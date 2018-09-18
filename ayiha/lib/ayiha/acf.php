<?php

//===========================
//                           
//    ###     ####  #####  
//   ## ##   ##     ##     
//  ##   ##  ##     #####  
//  #######  ##     ##     
//  ##   ##   ####  ##     
//                           
//===========================

function ay_register_acf_options_page() {
	if (function_exists('acf_add_options_page')) {
		acf_add_options_page(array(
			'page_title' 	=> sprintf('Options spécifiques au site %1$s', ay_site_slug(true)),
			'menu_title'	=> sprintf('Options %1$s', ay_site_slug(true)),
			'menu_slug' 	=> 'ayiha-options',
			'capability'	=> 'manage_options',
			'position'		=> '41.1'
		));
	}
}
add_action('init', 'ay_register_acf_options_page');