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
<?php
if ( is_page( array( 2410, 2412, 2414, 2416, 2418, 2544, 2805, 3136, 3314, 3395, 3467 ) ) ) :
		get_template_part( 'twitter-timeline-machaki' );
	elseif ( is_page( array( 2808, 'html', 'auto_validate', 'css', 'framework', 'epub' ) ) ) :
		get_template_part( 'twitter-timeline-zurb' );
	endif;
	?>
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside>
