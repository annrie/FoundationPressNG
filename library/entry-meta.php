<?php
/**
 * Entry meta information for posts
 *
 * @package FoundationPress
 * @since   FoundationPress 1.0.0
 */

if ( ! function_exists( 'foundationpress_entry_meta' ) ) :
	function foundationpress_entry_meta() {
		/* translators: %1$s: current date, %2$s: current time */
		echo '<time class="updated" datetime="' . get_the_time( 'c' ) . '">' . sprintf( __( '<i class="fas fa-calendar" aria-hidden="true"></i> %1$s at %2$s.', 'foundationpress' ), get_the_date(), get_the_time() ) . '</time>';
		if ( get_the_date() !== get_the_modified_date() ) :
			/* translators: %1$s: current date, %2$s: current time */
			echo ' <i class="fas fa-hand-point-right" aria-hidden="true" style="color:green;"></i> <time class="updated" datetime="' . get_the_modified_time( 'c' ) . '">' . sprintf( __( '<i class="fas fa-calendar-alt" aria-hidden="true"></i> %1$s  %2$s.', 'foundationpress' ), get_the_modified_date(), get_the_modified_time() ) . '</time>';
				endif;
		echo '<p class="byline author sr-only">' . __( 'Written by', 'foundationpress' ) . ' <a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" rel="author" class="fn">' . get_the_author() . '</a></p>';
	}
endif;
