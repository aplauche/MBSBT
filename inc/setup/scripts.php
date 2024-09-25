<?php
/**
 * Enqueue scripts and styles.
 *
 * @package mbsbt
 */

namespace MBSBT\inc\setup;

/**
 * Enqueue scripts and styles.
 *
 * @author mbsbt
 */
function scripts() {
	$asset_file_path = \MBSBT\ROOT_URL . '/build/js/index.asset.php';

	if ( is_readable( $asset_file_path ) ) {
		$asset_file = include $asset_file_path;
	} else {
		$asset_file = [
			'version'      => '0.1.0',
			'dependencies' => [ 'wp-polyfill' ],
		];
	}

	// Register styles & scripts.
	wp_enqueue_style( 'mbsbt-styles', \MBSBT\ROOT_URL . '/build/css/main.css', [], $asset_file['version'] );
	wp_enqueue_script( 'mbsbt-scripts', \MBSBT\ROOT_URL . '/build/js/index.js', $asset_file['dependencies'], $asset_file['version'], true );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\scripts' );
