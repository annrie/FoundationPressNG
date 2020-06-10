<?php
/**
 * The default template for displaying page content
 *
 * @package FoundationPressNG
 * @since   FoundationPressNG 1.0.0
 */

?>

<?php
// If a featured image is set, insert into layout and use Interchange
// to select the optimal image size per named media query.
if ( has_post_thumbnail( $post->ID ) ) :
?>
	<header class="featured-hero" data-interchange="[<?php the_thumbnail_bg( 'xsmall' ); ?>, xsmall],[<?php the_thumbnail_bg( 'small' ); ?>, small], [<?php the_thumbnail_bg( 'medium' ); ?>, medium], [<?php the_thumbnail_bg( 'large' ); ?>, large], [<?php the_thumbnail_bg( 'xlarge' ); ?>, xlarge],[<?php the_thumbnail_bg( 'medium' ); ?>, small-retina], [<?php the_thumbnail_bg( 'large' ); ?>, medium-retina], [<?php the_thumbnail_bg( 'xlarge' ); ?>, large-retina], [<?php the_thumbnail_bg( 'full' ); ?>, xlarge-retina]"></header>
	<?php
		endif;
