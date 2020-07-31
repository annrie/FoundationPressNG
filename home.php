<?php
/**
 * The home template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package FoundationPress
 * @since   FoundationPress 1.0.0
 */

get_header(); ?>

<div class="main-container">
    <div class="main-grid">
    <main id="main" class="main-content mymain" role="main" tabindex="-1">
    <div class="grid-x grid-padding-x clr small-up-1 medium-up-2">
    <?php if ( have_posts() ) : ?>

    <?php /* Start the Loop */ ?>
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article class="cell callout myblocks small-centered">
                <?php
                    if ( has_post_thumbnail() ) :
                ?>
                <a href="<?php the_permalink(); ?>">
                    <figure>
                    <?php
                        the_post_thumbnail(
                        'fp-small',
                            array(
                                'class' => 'thumbnail',
                                'alt'   => the_title_attribute( 'echo=0' ),
                                'title' => the_title_attribute( 'echo=0' ),
                            )
                        );
                    ?>
                    </figure>
                </a>
                <?php else : ?>
                <figure>
                <img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="">
                </figure>
                <?php
                endif;
                ?>
            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        </article>
        <?php
    endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div><!-- .grid-x end -->
		<?php /* Display navigation to next/previous pages when applicable */ ?>
		<?php
		if ( function_exists( 'foundationpress_pagination' ) ) :
			foundationpress_pagination();
		elseif ( is_paged() ) :
			?>
			<nav id="post-nav">
				<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
				<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
			</nav>
		<?php endif; ?>
	</main>
	<?php get_sidebar(); ?>
<?php get_template_part( 'back-to-top' ); ?>
</div>
</div>

<?php
get_footer();
