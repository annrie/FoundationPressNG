<?php
/**
 * The default template for displaying page content
 *
 * @package FoundationPressNG
 * @since   FoundationPressNG 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('myblocks'); ?> aria-labelledby="entry-title">
	<header>
<!-- <?php if ( ! has_block( 'image') ) : ?>
	<?php if ( has_post_thumbnail() ) : ?>
			<div class="grid-x grid-margin-x">
				<div class="small-12 cell text-center">
        <figure class="myfigure">
            <?php the_post_thumbnail(); ?>
        </figure>
				</div>
    </div>

		<?php endif; ?>
		<?php endif; ?> -->
<?php the_category(); ?>
		<h1 id="entry-title" class="entry-title"><?php the_title(); ?></h1>

		<?php foundationpress_entry_meta(); ?>
	</header>
	<div class="entry-content">

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
