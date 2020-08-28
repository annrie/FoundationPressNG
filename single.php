<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since   FoundationPress 1.0.0
 */

get_header(); ?>

<?php
if ( ! has_block( 'image' ) ) :
?>
<?php get_template_part( 'template-parts/featured-image' ); ?>
<?php
endif;
?>
<div class="main-container">
	<div class="main-grid">
		<main id="main" class="main-content mymain" role="main" tabindex="-1">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
        <?php get_template_part( 'template-parts/content', '' ); ?>
				<?php the_post_navigation(); ?>
				<?php comments_template(); ?>
			<?php endwhile; ?>
		</main>
		<?php get_sidebar(); ?>
		<?php get_template_part( 'back_to_top' ); ?>
	</div>
</div>
<?php
get_footer();
