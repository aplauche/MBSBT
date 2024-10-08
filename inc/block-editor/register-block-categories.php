<?php
/**
 * Register custom block category(ies).
 *
 * @package mbsbt
 */

 namespace MBSBT\inc\blockEditor;
/**
 * Register_wds_category
 *
 * @param array $categories block categories.
 * @return array $categories block categories.
 * @author mbsbt
 */
function register_wds_category( $categories ) {
	$custom_block_category = [
		'slug'  => __( 'custom', 'mbsbt' ),
		'title' => __( 'Bespoke Blocks', 'mbsbt' ),
	];

	$categories_sorted    = [];
	$categories_sorted[0] = $custom_block_category;

	foreach ( $categories as $category ) {
		$categories_sorted[] = $category;
	}

	return $categories_sorted;
}

add_filter( 'block_categories_all', __NAMESPACE__ . '\register_wds_category', 10, 1 );
