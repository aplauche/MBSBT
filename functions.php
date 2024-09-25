<?php

namespace MBSBT;

// Define a global path and url.
define( 'MBSBT\ROOT_PATH', trailingslashit( get_template_directory() ) );
define( 'MBSBT\ROOT_URL', trailingslashit( get_template_directory_uri() ) );

 /**
 * Get all the include files for the theme.
 *
 * @author MBSBT
 */
function include_inc_files() {
	$files = [
		'inc/functions/', // Custom functions that act independently of the theme templates.
		'inc/block-editor/', // Customize blocks and block editor behavior.
		'inc/setup/', // Theme setup.
	];

	foreach ( $files as $include ) {
		$include = trailingslashit( get_template_directory() ) . $include;

		// Allows inclusion of individual files or all .php files in a directory.
		if ( is_dir( $include ) ) {
			foreach ( glob( $include . '*.php' ) as $file ) {
				require $file;
			}
		} else {
			require $include;
		}
	}
}

include_inc_files();