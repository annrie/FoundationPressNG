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

if ( ! function_exists( 'foundationpress_gutenberg_support' ) ) :
	function foundationpress_gutenberg_support() {

		// Add foundation color palette to the editor
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary Color', 'foundationpress' ),
					'slug'  => 'primary',
					'color' => '#1779ba',
				),
				array(
					'name'  => __( 'Secondary Color', 'foundationpress' ),
					'slug'  => 'secondary',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'Success Color', 'foundationpress' ),
					'slug'  => 'success',
					'color' => '#3adb76',
				),
				array(
					'name'  => __( 'Warning color', 'foundationpress' ),
					'slug'  => 'warning',
					'color' => '#ffae00',
				),
				array(
					'name'  => __( 'Alert color', 'foundationpress' ),
					'slug'  => 'alert',
					'color' => '#cc4b37',
				),
			)
		);

	}

	add_action( 'after_setup_theme', 'foundationpress_gutenberg_support' );

// Big thanks to EBISUCOM (https://github.com/ebisucom/wordpress-note-lp) for the creative ideas
// front and editor both style
function mytheme_both() {
    wp_enqueue_style(
        'landing-stylesheet',
        get_stylesheet_directory_uri() . '/dist/assets/css/' . foundationpress_asset_path( 'style-both.css' ),
        array(),
        filemtime( get_theme_file_path( '/dist/assets/css/style-both.css' ) ),
        'all'
    );
    }
    add_action( 'enqueue_block_assets', 'mytheme_both');


// block style
function myjs_enqueue() {
    wp_enqueue_script( 'myjs-style', get_stylesheet_directory_uri() . '/dist/assets/js/' . foundationpress_asset_path( 'mystyle.js'), array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ), filemtime( get_theme_file_path( '/dist/assets/js/mystyle.js' ) ), true);
    }
add_action( 'enqueue_block_editor_assets', 'myjs_enqueue' );

// landing old style
function lp_custom() {
    if ( is_page( 'lp:custom' ) ) {
        wp_enqueue_style(
            'lp-custom-style',
            get_stylesheet_directory_uri() . '/dist/assets/css/' . foundationpress_asset_path( 'lp-custom.css' ),
            array(),
            filemtime( get_theme_file_path( '/dist/assets/css/lp-custom.css' ) ),
            'all'
        );
    }
}
add_action( 'wp_enqueue_scripts', 'lp_custom');

// landing gutnberg style
function lp_guten_front() {
    if ( is_page( 'lp:gutenberg' ) ) {
        wp_enqueue_style(
            'lp-guten-front-style',
            get_stylesheet_directory_uri() . '/dist/assets/css/' . foundationpress_asset_path( 'lp-guten-front.css' ),
            array(),
            filemtime( get_theme_file_path( '/dist/assets/css/lp-guten-front.css' ) ),
            'all'
        );
    }
}
add_action( 'wp_enqueue_scripts', 'lp_guten_front');

function lp_guten_both() {
    global $post;
    if ( 'lp:gutenberg' === $post->post_title ) {
        wp_enqueue_style(
                'lp-guten-both-style',
                get_stylesheet_directory_uri() . '/dist/assets/css/' . foundationpress_asset_path( 'lp-guten-both.css' ),
                array(),
                filemtime( get_theme_file_path( '/dist/assets/css/lp-guten-both.css' ) ),
                'all'
            );
    }
}
add_action( 'enqueue_block_assets', 'lp_guten_both');

function lp_guten_editor() {
    global $post;
    if ( 'lp:gutenberg' === $post->post_title ) {
        wp_enqueue_script(
                'lp-guten',
                get_stylesheet_directory_uri() . '/dist/assets/js/' . foundationpress_asset_path( 'lp-guten.js'),
                array(),
                filemtime( get_theme_file_path( '/dist/assets/js/lp-guten.js' ) ),
                true
            );
    }
}
add_action( 'enqueue_block_editor_assets', 'lp_guten_editor' );

endif;
