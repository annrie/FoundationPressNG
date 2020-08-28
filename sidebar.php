<?php
/**
 * The sidebar containing the main widget area
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<aside class="sidebar" id="side-nav">
	<div id="header-widget-area">
		<aside class="widget_search">
			<?php get_template_part( 'searchform' ); ?>
		</aside><!-- .widget_search end -->
			<?php if ( is_category() ) : ?>
				<aside class="rss_link">
					<a href="<?php echo get_category_feed_link( $cat ); ?>"><i class="fas fa-rss-square fa-2x"></i> RSS</a>
				</aside>
			<?php endif; ?>
	</div><!-- #header-widget-area end -->
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside>
