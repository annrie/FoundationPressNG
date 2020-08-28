<?php
/**
 * ACF Option Pages
 *
 * PHP Version >=7.0
 *
 * @category FoundationPressNG
 * @package  FoundationPressNG
 * @author   annrie <blastspinner@gmail.com>
 * @license  MIT
 * @link     https://foundationpressng.phantomoon.com
 */

/**
 * Big thanks to Jon Brockett (https://github.com/jonbrockett/FoundationPress) for the creative ideas
 */

if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title' => 'Site Settings',
			'menu_title' => 'Site Settings',
			'menu_slug'  => 'site-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Header Settings',
			'menu_title'  => 'Header',
			'parent_slug' => 'site-settings',
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Footer Settings',
			'menu_title'  => 'Footer',
			'parent_slug' => 'site-settings',
		)
	);

}
