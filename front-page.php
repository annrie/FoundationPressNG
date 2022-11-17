<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @category WordPress
 * @package  FoundationPressNG
 * @author   annrie <info@phantomoon.com>
 * @license  MIT License
 * @link     https://codex.wordpress.org/Template_Hierarchy
 * @since    FoundationPressNG 1.0.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>
<div class="grid-x grid-padding-x align-right" id="top-hero">
	<div class="cell small-4 medium-3">
		<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	</div>
	<div class="cell small-6 medium-4 tablet-3">
		<h2 class="subheader"><?php bloginfo( 'description' ); ?></h2>
	</div>
	</div>

<div class="main-container">
	<div class="main-grid">
		<main class="main-content mymain" role="main" tabindex="-1">
			<div class="small-12 large-expand cell">
				<section id="latest-columns">
					<h1 id="latest-columns-title"><a href="<?php echo get_term_link( 'blog', 'category' ); ?>"><i class="fas fa-edit fa-lg margin-right-0" aria-hidden="true"></i> 新着コラム</a></h1>
						<span class="archive-link hide-for-small-only hide-for-xsmall-only"><a href="<?php echo get_term_link( 'blog', 'category' ); ?>"><i class="fas fa-arrow-right"></i> コラム一覧</a></span>

						<div class="grid-container">
							<div class="grid-x grid-padding-x clr small-up-1 medium-up-2">
								<?php
								$column_posts = new WP_Query( 'posts_per_page=10&category_name=blog,machaki' );
								if ( $column_posts->have_posts() ) :
									while ( $column_posts->have_posts() ) :
										$column_posts->the_post();
										?>
											<article class="cell callout">
												<h1 class="update-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
													<time class="entry-date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
														<div class="grid-x grid-margin-x">
															<div class="cell small-12 small-centered xsmall-centerd large-6 large-expand">
                                <?php
                                    if ( has_post_thumbnail() ) :
                                ?>
                                <a href="<?php the_permalink(); ?>">
                                    <figure>
                                    <?php
                                        the_post_thumbnail(
                                        'xsmall',
                                            array(
                                                'class' => 'thumbnail',
                                                'alt'   => the_title_attribute( 'echo=0' ),
                                                'title' => the_title_attribute( 'echo=0' ),
                                            )
                                        );
                                    ?>
                                    </figure>
                                </a>
                                <?php
                                endif;
                                ?>
															</div>
															<div class="cell small-12 large-6 flex-container flex-dir-column">
																<?php the_short_excerpt(); ?>
																	<span class="link-text align-self-bottom"><a href="<?php the_permalink(); ?>"><i class="fas fa-arrow-right"></i> 続きを読む</a></span>
															</div>
														</div>
											</article>
										<?php
									endwhile;
								endif;
								wp_reset_postdata();
								?>
							</div><!-- .grid-x end -->
						</div><!-- .grid-container end -->
				</section><!-- #latest-columns end -->

				<!-- biblio here -->
				<section id="machaki-pickup">
					<h1 id="machaki-group-title"><a href="machaki/"><i class="fas fa-university fa-2x" aria-hidden="true"></i>僭越図書館<span class="show-for-large"> - 山田正紀 Bibliography</span></a></h1>
					<div class="grid-x grid-padding-x small-up-1 large-up-2">
						<?php
						$machaki_posts = new WP_Query( 'posts_per_page=10&post_type=page&orderby=menu_order&order=asc&post_parent=2410' );
						if ( $machaki_posts->have_posts() ) :
							while ( $machaki_posts->have_posts() ) :
								$machaki_posts->the_post();
								?>
									<article class="cell">
										<h2 class="sub-title"><a href="<?php the_permalink(); ?>"><i class="fas fa-leaf fa-lg margin-right-1"></i><?php the_title(); ?></h2>
										<div>
                    <?php
                    if ( has_post_thumbnail() ) :
                    ?>
                        <a href="<?php the_permalink(); ?>">
                        <figure>
												<?php
													the_post_thumbnail(
														'small',
														array(
															'alt' => the_title_attribute( 'echo=0' ),
															'title' => the_title_attribute( 'echo=0' ),
														)
													);
												?>
                        </figure>
											</a>
                    <?php
                    endif;
                    ?>
										</div>
											<p><?php remove_filter( 'the_excerpt', 'wpautop' ); ?><?php the_pickup_excerpt(); ?></p>
										<div class="continue-button alignright">
											<a href="<?php the_permalink(); ?>"><i class="fas fa-space-shuttle"></i> 詳しく見る</a>
										</div>
									</article>
								<?php
									endwhile;
									endif;
									wp_reset_postdata();
						?>
					</div><!-- .grid-x .machaki-group end -->
				</section><!-- #machaki-pickup end -->

						<!-- <section id="contributed-story">
							<h2><a href="story/"><i class="fas fa-info-circle" aria-hidden="true"></i>寄稿記事一覧</a></h2>
								<div class="callout secondary">
									<?php
									$content = get_page_by_path( 'story' );
									$page    = get_post( $content );
									echo apply_filters( 'the_content', $page->post_content );
									?>
							</div>
						</section> -->
					</div>
</main>

	<?php get_sidebar( 'top' ); ?>

</div>
</div>
<?php
get_footer();
