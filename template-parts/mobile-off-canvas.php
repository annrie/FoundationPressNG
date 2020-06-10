<?php
/**
 * The default template for displaying page content
 *
 * @package FoundationPressNG
 * @since   FoundationPressNG 1.0.0
 */

?>

<nav class="mobile-off-canvas-menu off-canvas position-left" id="<?php foundationpress_mobile_menu_id(); ?>" data-off-canvas data-auto-focus="false" data-content-scroll="false" aria-label="Mobile menu">
<button class="close-button" aria-label="Close menu" type="button" data-close>
  <span aria-hidden="true">&times;</span>
</button>
	<?php foundationpress_mobile_nav(); ?>
</nav>

<div class="off-canvas-content" data-off-canvas-content>
