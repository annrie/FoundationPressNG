<?php
/*
Template Name: Full Width
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage FoundationPressNG
 * @since FoundationPressNG 1.0
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
		<main class="main-content-full-width mymain" tabindex="-1">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				<?php the_post_navigation(); ?>
        <?php comments_template(); ?>
			<?php endwhile; ?>
		</main>
	</div>
		<?php get_template_part( 'back_to_top' ); ?>
</div>
<?php get_sidebar('full'); ?>
<?php
get_footer();
