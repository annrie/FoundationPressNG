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

if (! function_exists('foundationpress_theme_support')) :
function foundationpress_theme_support()
{       // Add language support
    load_theme_textdomain('foundationpress', get_template_directory() . '/languages');

    // Switch default core markup for search form, comment form, and comments to output valid HTML5
    add_theme_support(
        'html5',
        array(
            'style',
            'script',
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'navigation-widgets',
        )
    );

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Add post thumbnail support: http://codex.wordpress.org/Post_Thumbnails
    add_theme_support('post-thumbnails');

    // RSS thingy
    add_theme_support('automatic-feed-links');

    // Add post formats support: http://codex.wordpress.org/Post_Formats
    add_theme_support('post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ));

    $args = array(
      'flex-width'    => true,
      'width'         => 1200,
      'flex-width'    => true,
      'height'        => 200,
      'default-image' => get_template_directory_uri() . '/dist/assets/images/top/phantomoon_main.jpg',
    );
    add_theme_support('custom-header', $args);

    $defaults = array(
      'default-color'          => '',
      'default-image'          => '',
      'default-repeat'         => '',
      'default-position-x'     => '',
      'default-attachment'     => '',
      'wp-head-callback'       => '_custom_background_cb',
      'admin-head-callback'    => '',
      'admin-preview-callback' => ''
    );
    add_theme_support('custom-background', $defaults);

    // Additional theme support for woocommerce 3.0.+
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    add_theme_support('editor-styles');
    add_editor_style(get_stylesheet_directory_uri() . '/dist/assets/css/editor.css');

    // Add foundation.css as editor style https://codex.wordpress.org/Editor_Style
    // add_editor_style( 'dist/assets/css/' . foundationpress_asset_path( 'editor.css' ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // グーテンベルク由来のCSS(theme.min.css)
    add_theme_support('wp-block-styles');

    // ピクセル以外の単位を有効化
    add_theme_support('custom-units');

    // 埋め込みコンテンスのレスポンシブ化
    add_theme_support('responsive-embeds');

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for custom line height controls.
    add_theme_support('custom-line-height');

    // Add support for experimental link color control.
    add_theme_support('link-color');

    // Add support for experimental cover block spacing.
    add_theme_support('custom-spacing');
}

add_action('after_setup_theme', 'foundationpress_theme_support');
endif;
