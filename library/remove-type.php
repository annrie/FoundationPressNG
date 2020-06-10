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

?>

<?php
add_action(
	'template_redirect',
	function () {
		ob_start(
			function ( $tag ) {
				$tag = str_replace( array( 'type="text/javascript"', "type='text/javascript'" ), '', $tag );

				return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
			}
		);
	}
);
