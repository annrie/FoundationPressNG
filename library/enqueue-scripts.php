<?php
/**
 * Enqueue all styles and scripts
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 *
 * @package FoundationPressNG
 * @since   FoundationPressNG 1.0.0
 */

// Check to see if rev-manifest exists for CSS and JS static asset revisioning
// https://github.com/sindresorhus/gulp-rev/blob/master/integration.md

if ( ! function_exists( 'foundationpress_asset_path' ) ) :
	function foundationpress_asset_path( $filename ) {
		$filename_split = explode( '.', $filename );
		$dir            = end( $filename_split );
		$manifest_path  = dirname( dirname( __FILE__ ) ) . '/dist/assets/' . $dir . '/rev-manifest.json';

		if ( file_exists( $manifest_path ) ) {
			$manifest = json_decode( wp_remote_retrieve_body( $manifest_path ), true );
		} else {
			$manifest = array();
		}

		if ( array_key_exists( $filename, array( $manifest ) ) ) {
			return $manifest[ $filename ];
		}
		return $filename;
	}
endif;

if ( ! function_exists( 'foundationpress_scripts' ) ) :
	function foundationpress_scripts() {
    // Enqueue the main Stylesheet.
		wp_enqueue_style( 'main-stylesheet', get_stylesheet_directory_uri() . '/dist/assets/css/' . foundationpress_asset_path( 'app.css' ), array(), filemtime( get_theme_file_path( '/dist/assets/css/app.css' ) ), 'all' );

		// Deregister the jquery version bundled with WordPress.
		wp_deregister_script( 'jquery' );

		// CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header.
		wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), '3.2.1', false );

		// Deregister the jquery-migrate version bundled with WordPress.
		wp_deregister_script( 'jquery-migrate' );

		// CDN hosted jQuery migrate for compatibility with jQuery 3.x
		wp_register_script( 'jquery-migrate', '//code.jquery.com/jquery-migrate-3.0.1.min.js', array( 'jquery' ), '3.0.1', false );

		// Enqueue jQuery migrate. Uncomment the line below to enable.
		// wp_enqueue_script( 'jquery-migrate' );

		// Enqueue Foundation scripts
		wp_enqueue_script( 'foundation', get_stylesheet_directory_uri() . '/dist/assets/js/' . foundationpress_asset_path( 'app.js' ), array( 'jquery' ), '2.10.7', true );

		// Enqueue FontAwesome from CDN. Uncomment the line below if you need FontAwesome.
    wp_enqueue_script( 'fontawesome', '//kit.fontawesome.com/1da9fe040f.js', array(), '6', true );

    // Google map api
    // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NoExplicitVersion
    wp_enqueue_script( 'googlemapapi', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyC1ok--EfDe-1tYrqFco5G9GqG6CRaIzKU', array(), '', true );

    wp_enqueue_script( 'fontawesome', '//kit.fontawesome.com/1da9fe040f.js', array(), '6', true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
    }

    add_filter('script_loader_tag', 'add_defer', 10, 2);
    function add_defer( $tag, $handle ) {
    if ( 'fontawesome' !== $handle ) {
        return $tag;
    }
    return str_replace( ' src=', ' defer  crossorigin="anonymous" src=', $tag );
    }
}
add_action( 'wp_enqueue_scripts', 'foundationpress_scripts' );

/* enqueue_block_editor_assets is only available on the editor screen, and is not loaded on the actual page. If you set it to enqueue_block_assets, it will be loaded in the actual page. */
add_action(
'enqueue_block_editor_assets',
function() {
    $custom_css_url = '/dist/assets/css/editor.css';
    wp_enqueue_style( 'my-block', get_stylesheet_directory_uri() . $custom_css_url, array( 'wp-block-library' ), array(), false, true );
}
);
endif;
