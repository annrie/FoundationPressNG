<?php
/**
 * ACF Option Pages
 *
 * PHP Version >=7.0
 *
 * @category FoundationPressNG
 * @package  FoundationPressNG
 * @author   annrie <blastspinner@gmail.com>
 * @license  MIT
 * @link     https://foundationpressng.phantomoon.com
 */

if ( ! function_exists( 'foundationpress_sidebar_widgets' ) ) :
	function foundationpress_sidebar_widgets() {
		register_sidebar(
			array(
				'id'            => 'sidebar-1',
				'name'          => __( 'Sidebar widgets', 'foundationpress' ),
				'description'   => __( 'Drag widgets to this sidebar container.', 'foundationpress' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="h3">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'id'            => 'sidebar-2',
				'name'          => __( 'Secondary Sidebar widgets', 'foundationpress' ),
				'description'   => __( 'Drag widgets to this sidebar container', 'foundationpress' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title ' => '<h2 class="h3">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'id'            => 'footer-1',
				'name'          => __( 'Footer widgets1', 'foundationpress' ),
				'description'   => __( 'Drag widgets to this footer container', 'foundationpress' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="h3">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'id'            => 'footer-2',
				'name'          => __( 'Footer widgets2', 'foundationpress' ),
				'description'   => __( 'Drag widgets to this footer container', 'foundationpress' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="h3">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'id'            => 'footer-3',
				'name'          => __( 'Footer widgets3', 'foundationpress' ),
				'description'   => __( 'Drag widgets to this footer container', 'foundationpress' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="h3">',
				'after_title'   => '</h2>',
			)
		);
	}

	add_action( 'widgets_init', 'foundationpress_sidebar_widgets' );
endif;
