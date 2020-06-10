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
			if ( is_single() && ( in_category( 'blog' ) || in_category( 'web' ) || in_category( 'information' ) || in_category( 'machaki' ) ) ) :
				get_template_part( 'header_ogp' );
			endif;
			?>
	<?php if ( is_single() ) : ?>
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<link rel="alternate" hreflang="ja" href="<?php the_permalink(); ?>">
			<?php endwhile; ?>
		<?php endif; ?>
		<?php
		elseif ( is_home() || is_front_page() ) :
			?>
		<link rel="alternate" hreflang="ja" href="<?php echo home_url(); ?>">
	<?php endif; ?>
		<?php wp_head(); ?>
</head>
    <body <?php body_class(); ?>>
    <?php
    if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
    }
    ?>
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
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/dist/assets/images/icons/logo.png" alt="不安と月ロゴ">
							<span>
								<?php if ( ! is_front_page() ) : ?>
										<?php bloginfo( 'name' ); ?>
								<?php endif; ?>
							</span></a>
					</div>
					</div>
					<nav id="menu" class="top-bar-right" aria-label="Main menu" tabindex="-1">
						<?php foundationpress_top_bar_r(); ?>
						<ul class="social-icons fa-ul fa-pull-right hide-for-small-only hide-for-xsmall-only">
								<li><a href="https://twitter.com/muraie_jin" rel="external nofollow"><i class="fab fa-twitter-square fa-2x"></i></a></li>
								<li><a href="https://www.facebook.com/muraiejin" rel="external nofollow"><i class="fab fa-facebook fa-2x"></i></a></li>
						</ul>
					</nav>
						<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
								<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
						<?php endif; ?>
				</section>
				</header>
		</div>
	<div class="container">
		<?php if ( ! is_front_page() ) : ?>
			<div class="breadcrumbs">
				<?php
				if ( function_exists( 'bcn_display' ) ) {
						bcn_display();
				}
				?>
			</div>
			<?php
			endif;
