<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
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
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				<?php comments_template(); ?>
			<?php endwhile; ?>
		</main>
		<?php get_template_part( 'back-to-top' ); ?>
	</div>
</div>
<?php get_sidebar('full'); ?>
<?php
get_footer();
