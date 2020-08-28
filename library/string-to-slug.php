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
function to_slug( $text ) {
	// replace non letter or digits by -
	$text = preg_replace( '~[^\pL\d]+~u', '-', $text );

	// transliterate
	$text = iconv( 'utf-8', 'us-ascii//TRANSLIT', $text );

	// remove unwanted characters
	$text = preg_replace( '~[^-\w]+~', '', $text );

	// trim
	$text = trim( $text, '-' );

	// remove duplicated - symbols
	$text = preg_replace( '~-+~', '-', $text );

	// lowercase
	$text = strtolower( $text );

	if ( empty( $text ) ) {
		return 'n-a';
	}

	return $text;
}
