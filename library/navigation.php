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

register_nav_menus(
	array(
		'top-bar-r'   => esc_html__( 'Right Top Bar', 'foundationpress' ),
		'mobile-nav'  => esc_html__( 'Mobile', 'foundationpress' ),
		'privacy-nav' => esc_html__( 'Privacy', 'foundationpress' ),
	)
);


/**
 * Desktop navigation - right top bar
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
if ( ! function_exists( 'foundationpress_top_bar_r' ) ) {
	function foundationpress_top_bar_r() {
		wp_nav_menu(
			array(
				'container'      => false,
				'menu_class'     => 'dropdown menu desktop-menu',
				'items_wrap'     => '<ul id="%1$s" class="%2$s" data-dropdown-menu>%3$s</ul>',
				'theme_location' => 'top-bar-r',
				'depth'          => 3,
				'fallback_cb'    => false,
				'walker'         => new Foundationpress_Top_Bar_Walker(),
			)
		);
	}
}


/**
 * Mobile navigation - topbar (default) or offcanvas
 */
if ( ! function_exists( 'foundationpress_mobile_nav' ) ) {
	function foundationpress_mobile_nav() {
		wp_nav_menu(
			array(
				'container'      => false,                         // Remove nav container
				'menu'           => __( 'mobile-nav', 'foundationpress' ),
				'menu_class'     => 'vertical menu',
				'theme_location' => 'mobile-nav',
				'items_wrap'     => '<ul id="%1$s" class="%2$s" data-drilldown data-parent-link="true" data-submenu-toggle="true">%3$s</ul>',
				'fallback_cb'    => false,
				'walker'         => new Foundationpress_Mobile_Walker(),
			)
		);
	}
}


/**
 * Privacy navigation
 */
if ( ! function_exists( 'foundationpress_privacy_nav' ) ) {
	function foundationpress_privacy_nav() {
		wp_nav_menu(
			array(
				'container'      => false,
				'menu_class'     => 'vertical menu accordion-menu',
				'items_wrap'     => '<ul id="%1$s" class="%2$s nested privacy-menu align-center">%3$s</ul>',
				'theme_location' => 'privacy-nav',
				'depth'          => 3,
				'fallback_cb'    => false,
			)
		);
	}
}


/**
 * Add support for buttons in the top-bar menu:
 * 1) In WordPress admin, go to Apperance -> Menus.
 * 2) Click 'Screen Options' from the top panel and enable 'CSS CLasses' and 'Link Relationship (XFN)'
 * 3) On your menu item, type 'has-form' in the CSS-classes field. Type 'button' in the XFN field
 * 4) Save Menu. Your menu item will now appear as a button in your top-menu
*/
if ( ! function_exists( 'foundationpress_add_menuclass' ) ) {
	function foundationpress_add_menuclass( $ulclass ) {
		$find    = array( '/<a rel="button"/', '/<a title=".*?" rel="button"/' );
		$replace = array( '<a rel="button" class="button"', '<a rel="button" class="button"' );

		return preg_replace( $find, $replace, $ulclass, 1 );
	}
	add_filter( 'wp_nav_menu', 'foundationpress_add_menuclass' );
}
