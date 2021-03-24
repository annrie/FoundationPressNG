<?php
/**
 * Clean up WordPress defaults
 *
 * @package FoundationPressNG
 * @since FoundationPressNG 1.0.0
 */

/**
 * Big thanks to Jon Brockett (https://github.com/jonbrockett/FoundationPress) for the creative ideas
 */
function foundationpress_add_woocommerce_support() {
	add_theme_support(
		'woocommerce',
		array(

			'product_grid' => array(
				'default_rows'    => 3,
				'min_rows'        => 2,
				'max_rows'        => 8,
				'default_columns' => 4,
				'min_columns'     => 2,
				'max_columns'     => 5,
			),
		)
	);
}
add_action( 'after_setup_theme', 'foundationpress_add_woocommerce_support' );
