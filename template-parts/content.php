<?php
/**
 * The default template for displaying page content
 *
 * @package FoundationPressNG
 * @since   FoundationPressNG 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
	<?php
	if ( is_single() ) :
		?>
	aria-labelledby="entry-title"
		<?php
else :
	?>
	aria-labelledby="entry-title-<?php the_ID(); ?>"
	<?php
endif;
?>
>
	<header>
	<?php
	if ( is_single() ) {
		the_title( '<h1 id="entry-title" class="entry-title">', '</h1>' );
	} else {
		the_title( '<h2 id="entry-title-' . the_ID() . '" class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	}
	?>
		<?php foundationpress_entry_meta(); ?>
	</header>
	<div class="entry-content">
<?php if ( has_post_thumbnail() ) : ?>
			<div class="grid-x grid-margin-x">
				<div class="small-12 cell text-center">
					<?php the_post_thumbnail( 'fp-small', array('class' => 'thumbnail') ); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php the_content(); ?>
		<?php
		edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' );
		?>
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
		$tag = get_the_tags();
		if ( $tag ) {
			?>
	<footer>
			<p>
					<?php
					the_tags( '<i class="fas fa-tags" aria-hidden="true"></i>', '' );
					?>
			</p>
</footer>
			<?php
		}
		?>
</article>
