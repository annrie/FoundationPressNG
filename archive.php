<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FoundationPress
 * @since   FoundationPress 1.0.0
 */

get_header(); ?>

<div class="main-container">
	<div class="main-grid">
		<main id="main" class="main-content" role="main" tabindex="-1">
		<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php the_category_image(); ?>
			<h1 class="page-title">
			<?php
			if ( is_category() ) {
				echo '<small>カテゴリー</small>「' . single_cat_title( '', false ) . '」<small>の投稿一覧</small>';
			} elseif ( is_tag() ) {
					echo '<small>タグ</small>「' . single_tag_title( '', false ) . '」<small>の投稿一覧</small>';
			} elseif ( is_day() ) {
					echo '「' . get_the_date( 'Y年n月j日' ) . '」<small>の投稿一覧</small>';
			} elseif ( is_month() ) {
					echo '「' . get_the_date( 'Y年n月' ) . '」<small>の投稿一覧</small>';
			} elseif ( is_year() ) {
					echo '「' . get_the_date( 'Y年' ) . '」<small>の投稿一覧</small>';
			} elseif ( is_tax() ) {
					echo '「' . single_term_title( '', false ) . '」<small>の投稿一覧</small>';
			} elseif ( is_search() ) {
					echo '「' . get_search_query() . '」<small>の投稿一覧</small>';
			} elseif ( is_author() ) {
					echo esc_html( get_the_author_meta( 'display_name', get_query_var( 'author' ) ) );
			} else {
					echo 'Blog';
			}
			?>
			</h1>
		</header>

			<?php /* Start the Loop */ ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<?php get_template_part( 'template-parts/content', 'archive', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; // End have_posts() check. ?>

			<?php /* Display navigation to next/previous pages when applicable */ ?>
			<?php
			if ( function_exists( 'foundationpress_pagination' ) ) :
				foundationpress_pagination();
			elseif ( is_paged() ) :
				?>
				<nav id="post-nav" aria-label="Post navigation">
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
