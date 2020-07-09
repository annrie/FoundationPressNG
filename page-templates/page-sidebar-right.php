<?php
/*
Template Name: Right Sidebar
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage FoundationPressNG
 * @since FoundationPressNG 1.0
*/

get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>
<div class="main-container">
	<div class="main-grid">
		<main id="main" class="main-content" tabindex="-1">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				<?php comments_template(); ?>
			<?php endwhile; ?>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();
