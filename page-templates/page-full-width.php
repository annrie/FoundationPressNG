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

<?php if ( has_post_thumbnail() ) : ?>
    <figure>
<?php get_template_part( 'template-parts/featured-image' ); ?>
    </figure>
<?php endif; ?>
<div class="main-container">
	<div class="main-grid">
		<main class="main-content-full-width" tabindex="-1">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				<?php comments_template(); ?>
			<?php endwhile; ?>
		</main>
	</div>
</div>
<?php
get_footer();
