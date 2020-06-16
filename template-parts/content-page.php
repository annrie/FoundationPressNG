<?php
/**
 * The default template for displaying page content
 *
 * @package FoundationPressNG
 * @since   FoundationPressNG 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> aria-labelledby="entry-title">
	<header>
		<h1 id="entry-title" class="entry-title"><?php the_title(); ?></h1>
		<?php foundationpress_entry_meta(); ?>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
		<?php
		wp_link_pages(
			array(
				'before' => '<nav id="page-nav" aria-label="Page navigation"><p>' . __( 'Pages:', 'foundationpress' ),
				'after'  => '</p></nav>',
			)
		);
		?>
	</div>
		<?php
		$tag = get_the_tags(); if ( $tag ) {
			?>
	<footer>
			<p><?php the_tags(); ?></p>
</footer>
					<?php
		}
		?>
</article>
