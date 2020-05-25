<?php
// Override WooCommerce default image sizes
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width'  => 150,
        'height' => 150,
        'crop'   => true,
    );
} );
add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
    return array(
        'width'  => 300,
        'height' => 0,
        'crop'   => false,
    );
} );
add_filter( 'woocommerce_get_image_size_single', function( $size ) {
    return array(
        'width'  => 1024,
        'height' => 0,
        'crop'   => false,
    );
} );
