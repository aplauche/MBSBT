<?php
/**
 * Register custom block category(ies).
 *
 * @package mbsbt
 */

 namespace MBSBT\inc\blockEditor;
/**
 * Register_custom_category
 *
 * @param array $categories block categories.
 * @return array $categories block categories.
 * @author mbsbt
 */
function register_custom_category( $categories ) {
	$custom_block_category = [
		'slug'  => __( 'custom', 'mbsbt' ),
		'title' => __( 'Bespoke Blocks', 'mbsbt' ),
	];

	array_unshift( $categories, $custom_block_category );
  return $categories;
}

add_filter( 'block_categories_all', __NAMESPACE__ . '\register_custom_category', 10, 1 );
