<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

<?php
/**
 * Back to Top
 */
?>
<div id="top"></div>

<div id="content-top"></div>

<div class="back-to-top-sticky hide-for-print" data-sticky-container>
  <div class="back-to-top" data-sticky data-stick-to="bottom" data-sticky-on="small" data-top-anchor="content-top:top" data-btm-anchor="footer:top" data-margin-bottom="0">
	<div class="grid-container">
		<div class="back-to-top-grid grid-x align-right" data-smooth-scroll>
		  <a href="#top">
			<span class="button-tooltip" data-show-on="medium" data-tooltip data-click-open="false" data-position="top" data-alignment="right" title="Back to Top">
			  <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 88 56">
				<title>Up</title>
				<path fill-rule="evenodd" d="M86.9419643,11.328125 C86.9419643,9.35639881 86.2537202,7.68229167 84.8772321,6.30580357 L80.6919643,2.12053571 C79.2782738,0.706845238 77.5855655,0 75.6138393,0 C73.6049107,0 71.9308036,0.706845238 70.5915179,2.12053571 L43.4709821,29.1852679 L16.3504464,2.12053571 C15.0111607,0.706845238 13.3370536,0 11.328125,0 C9.31919643,0 7.64508929,0.706845238 6.30580357,2.12053571 L2.12053571,6.30580357 C0.706845238,7.64508929 0,9.31919643 0,11.328125 C0,13.2998512 0.706845238,14.9925595 2.12053571,16.40625 L38.4486607,52.734375 C39.8251488,54.1108631 41.499256,54.7991071 43.4709821,54.7991071 C45.405506,54.7991071 47.0982143,54.1108631 48.5491071,52.734375 L84.8214286,16.40625 C86.235119,14.9925595 86.9419643,13.2998512 86.9419643,11.328125 Z" transform="matrix(1 0 0 -1 .771 55.389)"/>
			  </svg>
			  <span class="show-for-sr"> Back to top</span>
			</span>
		  </a>
		</div>
	  </div>
	</div>
  </div>
</div>

<?php
/**
 * Footer
 */
?>
<footer id="footer" class="footer">
  <div class="section-spacing">
	<div class="grid-container">
	  <div class="grid-x grid-padding-x grid-padding-y align-center-middle">
		<div class="cell medium-shrink medium-order-2">
		  <nav aria-label="Privacy menu">
			<?php foundationpress_privacy_nav(); ?>
		  </nav>
		</div>
		<div class="cell medium-auto medium-offset-1 text-center medium-order-1">
		  &copy; <?php echo date( 'Y', strtotime( '+3 months' ) ); ?> <?php bloginfo( 'name' ); ?>
		</div>
	  </div>
	</div>
  </div>
</footer>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
	</div><!-- Close off-canvas content -->
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
