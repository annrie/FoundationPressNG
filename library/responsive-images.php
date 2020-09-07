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

// Add additional image sizes
add_image_size( 'xsmall', 640 );
add_image_size( 'medium_large', 768 );
add_image_size( 'large_wide', 1200 );
add_image_size( 'xlarge', 1536 );
add_image_size( 'xxlarge', 2048 );

// Remove medium large srcset image
// add_filter(
// 'intermediate_image_sizes',
// function ( $sizes ) {
// return array_diff( $sizes, array( 'medium_large' ) );
// }
// );

// Adjust media library to new sizes
function ajust_media_library( $response, $attachment, $meta ) {
	if ( ! empty( $response ) ) {
		$sizes = array(
            'xsmall',
            'medium_large',
            'large_wide',
            'xlarge', // WP default
            'xxlarge', // WP default
        );
    $scount    = count($size) > 0;
		while ( $scount ) {
			$cur_size = array_pop( $sizes );
			if ( isset( $response['sizes'][ $cur_size ] ) ) {
				$response['sizes']['medium'] = $response['sizes'][ $cur_size ];
        }
		}
}
    return $response;
}

add_filter( 'wp_prepare_attachment_for_js', 'ajust_media_library', 999, 3 );

// Register the new image sizes for use in the add media modal in wp-admin
function foundationpress_custom_sizes( $sizes ) {
	// Unset WP Default sizes so they can be reordered with new custom sizes
	// unset( $sizes['thumbnail'] );
	unset( $sizes['medium'] );
	unset( $sizes['large'] );
	unset( $sizes['full'] );

	return array_merge(
		$sizes,
		array(
            'xsmall'       => __( 'Xsmall' ),
            'medium'       => __( 'Medium' ),
            'medium_large' => __( 'MediumLarge' ),
            'large'        => __( 'Large' ),
            'large_wide'   => __( 'LargeWide' ),
            'xlarge'       => __( 'XLarge' ),
            'xxlarge'      => __( 'XXLarge' ),
            'full'         => __( 'Full' ),
		)
	);
}
add_filter( 'image_size_names_choose', 'foundationpress_custom_sizes' );

// Add custom image sizes attribute to enhance responsive image functionality for content images
function foundationpress_adjust_image_sizes_attr( $sizes, $size ) {
	// Actual width of image
	$width = $size[0];

	// Full width page template
	if ( is_page_template( 'page-templates/page-full-width.php' ) ) {
		if ( 1200 < $width ) {
			$sizes = '(max-width: 1199px) 98vw, 1200px';
		} else {
			$sizes = '(max-width: 1199px) 98vw, ' . $width . 'px';
		}
	} else { // Default 3/4 column post/page layout
		if ( 770 < $width ) {
			$sizes = '(max-width: 639px) 98vw, (max-width: 1199px) 64vw, 770px';
		} else {
			$sizes = '(max-width: 639px) 98vw, (max-width: 1199px) 64vw, ' . $width . 'px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'foundationpress_adjust_image_sizes_attr', 10, 2 );

// Remove inline width and height attributes for post thumbnails
function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
	if ( ! strpos( $html, 'attachment-shop_single' ) ) {
		$html = preg_replace( '/^(width|height)=\"\d*\"\s/', '', $html );
	}
	return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );
