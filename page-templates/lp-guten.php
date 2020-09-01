<?php
/*
Template Name: LP GUTEN
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage FoundationPressNG
 * @since FoundationPressNG 1.0
*/

get_header(); ?>

<?php do_action( 'foundationpress_before_content' ); ?>


<main class="main-content-full-width mymain myblocks" tabindex="-1">

<?php
    if ( have_posts() ) :
    while ( have_posts() ) :
    the_post();
?>

<?php the_content(); ?>

<?php
    endwhile;
    endif;
    ?>

</main>
<?php do_action( 'foundationpress_after_content' ); ?>
		<?php get_template_part( 'back_to_top' ); ?>
<?php
get_footer();
