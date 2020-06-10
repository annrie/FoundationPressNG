<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since   FoundationPress 1.0.0
 */

?>
<!doctype html>
	<html class="no-js" <?php language_attributes(); ?> >
		<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
			<meta charset="<?php bloginfo( 'charset' ); ?>" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
		<?php
		/**
		 * Skip Links
		 */
		?>
		<nav id="skip-links" class="skip-links show-on-focus" aria-label="Skip links" data-smooth-scroll>
			<a class="screen-reader-text" href="#main">Skip to content</a>
			<a class="screen-reader-text" href="#menu">Skip to navigation</a>
		</nav>
			<?php
			if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) :
				?>
				<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
		<?php endif; ?>
				<?php
				// Front top frame
				if ( is_page_template( 'page-templates/front.php' ) ) {
					echo '<div class="top-frame grid-frame grid-y">';
				}
				?>
			<?php
			/**
			 * Site Header
			 */
			?>
		<div class="header-sticky-container" data-sticky-container>
			<header id="header" class="site-header sticky" data-sticky data-options="marginTop:0;" data-sticky-on="small">
					<?php
						/**
						 * Mobile Menu
						 */
					?>
				<section class="site-title-bar title-bar" arial-label="Mobile navigation" <?php foundationpress_title_bar_responsive_toggle(); ?> data-hide-for="large">
					<div class="title-bar-left">
						<div class="grid-x grid-padding-x">
							<div class="cell auto">
								<span class="site-mobile-title title-bar-title">
									<a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>">
										<?php bloginfo( 'name' ); ?>
									</a>
								</span>
							</div>
							<div class="cell shrink">
								<button aria-label="<?php _e( 'Main Menu', 'foundationpress' ); ?>" class="menu-icon" type="button" data-toggle="<?php foundationpress_mobile_menu_id(); ?>"></button>
							</div>
						</div>
					</div>
				</section>
					<?php
					/**
					 * Desktop/Tablet Menu
					 */
					?>
				<section class="site-navigation top-bar" aria-label="Site navigation" id="<?php foundationpress_mobile_menu_id(); ?>">
					<div class="top-bar-left">
						<div class="site-desktop-title top-bar-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</div>
					</div>
					<nav id="menu" class="top-bar-right" aria-label="Main menu" tabindex="-1">
						<?php foundationpress_top_bar_r(); ?>

						<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
								<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
						<?php endif; ?>
					</nav>
				</section>
			</header>
		</div>
