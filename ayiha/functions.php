<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
	'lib/utils.php',					// Utilities function
	'lib/assets.php',					// Scripts and stylesheets
	'lib/setup.php',					// Theme setup
	'lib/wrapper.php',	 				// Theme wrapper class
	'lib/ayiha/hooks.php',				// Hooks
	'lib/ayiha/templating.php',	 		// Theme wrapper class
	'lib/ayiha/acf.php',	 			// Theme wrapper class
];

foreach ($sage_includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion', 'ayiha'), $file), E_USER_ERROR);
	}

	require_once $filepath;
}
unset($file, $filepath);
