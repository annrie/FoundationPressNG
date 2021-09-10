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

if (! function_exists('foundationpress_gutenberg_support')) :
    function foundationpress_gutenberg_support()
    {         // Custom background color.
        add_theme_support(
            'custom-background',
            array(
                'default-color' => 'fefefe',
            )
        );

        // Editor color palette.
        $black     = '#0a0a0a';
        $dark_gray = '#8a8a8a';
        $gray      = '#39414D';
        $green     = '#00b06b';
        $blue      = '#1971ff';
        $purple    = '#D1D1E4';
        $red       = '#ff4b00';
        $orange    = '#f6aa00';
        $yellow    = '#f2e700';
        $white     = '#fefefe';
        // Add foundation color palette to the editor
        add_theme_support(
            'editor-color-palette',
            array(
                array(
                    'name'  => esc_html__('Primary Color', 'foundationpress'),
                    'slug'  => 'primary',
                    'color' => '#1779ba',
                ),
                array(
                    'name'  => esc_html__('Secondary Color', 'foundationpress'),
                    'slug'  => 'secondary',
                    'color' => '#767676',
                ),
                array(
                    'name'  => esc_html__('Success Color', 'foundationpress'),
                    'slug'  => 'success',
                    'color' => '#3adb76',
                ),
                array(
                    'name'  => esc_html__('Warning color', 'foundationpress'),
                    'slug'  => 'warning',
                    'color' => '#ffae00',
                ),
                array(
                    'name'  => esc_html__('Alert color', 'foundationpress'),
                    'slug'  => 'alert',
                    'color' => '#cc4b37',
                ),
                array(
                    'name'  => esc_html__('Black', 'foundationpress'),
                    'slug'  => 'black',
                    'color' => $black,
                ),
                array(
                    'name'  => esc_html__('Dark gray', 'foundationpress'),
                    'slug'  => 'dark-gray',
                    'color' => $dark_gray,
                ),
                array(
                    'name'  => esc_html__('Gray', 'foundationpress'),
                    'slug'  => 'gray',
                    'color' => $gray,
                ),
                array(
                    'name'  => esc_html__('Green', 'foundationpress'),
                    'slug'  => 'green',
                    'color' => $green,
                ),
                array(
                    'name'  => esc_html__('Blue', 'foundationpress'),
                    'slug'  => 'blue',
                    'color' => $blue,
                ),
                array(
                    'name'  => esc_html__('Purple', 'foundationpress'),
                    'slug'  => 'purple',
                    'color' => $purple,
                ),
                array(
                    'name'  => esc_html__('Red', 'foundationpress'),
                    'slug'  => 'red',
                    'color' => $red,
                ),
                array(
                    'name'  => esc_html__('Orange', 'foundationpress'),
                    'slug'  => 'orange',
                    'color' => $orange,
                ),
                array(
                    'name'  => esc_html__('Yellow', 'foundationpress'),
                    'slug'  => 'yellow',
                    'color' => $yellow,
                ),
                array(
                    'name'  => esc_html__('White', 'foundationpress'),
                    'slug'  => 'white',
                    'color' => $white,
                ),
            )
        );

        add_theme_support(
            'editor-gradient-presets',
            array(
                array(
                    'name'     => esc_html__('Purple to yellow', 'foundationpress'),
                    'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
                    'slug'     => 'purple-to-yellow',
                ),
                array(
                    'name'     => esc_html__('Yellow to purple', 'foundationpress'),
                    'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
                    'slug'     => 'yellow-to-purple',
                ),
                array(
                    'name'     => esc_html__('Green to yellow', 'foundationpress'),
                    'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
                    'slug'     => 'green-to-yellow',
                ),
                array(
                    'name'     => esc_html__('Yellow to green', 'foundationpress'),
                    'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
                    'slug'     => 'yellow-to-green',
                ),
                array(
                    'name'     => esc_html__('Red to yellow', 'foundationpress'),
                    'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
                    'slug'     => 'red-to-yellow',
                ),
                array(
                    'name'     => esc_html__('Yellow to red', 'foundationpress'),
                    'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
                    'slug'     => 'yellow-to-red',
                ),
                array(
                    'name'     => esc_html__('Purple to red', 'foundationpress'),
                    'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
                    'slug'     => 'purple-to-red',
                ),
                array(
                    'name'     => esc_html__('Red to purple', 'foundationpress'),
                    'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
                    'slug'     => 'red-to-purple',
                ),
            )
        );
    }
    add_action('after_setup_theme', 'foundationpress_gutenberg_support');
endif;
        // Big thanks to EBISUCOM (https://github.com/ebisucom/wordpress-note-lp) for the creative ideas
        // front and editor both style
        function mytheme_both()
        {
            wp_enqueue_style(
                'landing-stylesheet',
                get_stylesheet_directory_uri() . '/dist/assets/css/' . foundationpress_asset_path('style-both.css'),
                array(),
                filemtime(get_theme_file_path('/dist/assets/css/style-both.css')),
                'all'
            );
        }
        add_action('enqueue_block_assets', 'mytheme_both');

        // block style
        function myjs_enqueue()
        {
            wp_enqueue_script('myjs-style', get_stylesheet_directory_uri() . '/dist/assets/js/' . foundationpress_asset_path('mystyle.js'), array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ), filemtime(get_theme_file_path('/dist/assets/js/mystyle.js')), true);
        }
        add_action('enqueue_block_editor_assets', 'myjs_enqueue');

        // change the title
        function change_title_tag_with_cfv($title)
        {
            // 個別ページの場合
            if (is_singular()) {
                // カスタムフィールドの値を取得
                $cf_title_tag = get_post_meta(get_the_ID(), 'my_title_tag', true);
                $title        = esc_html($cf_title_tag);
            }

            return $title;
        }
        add_filter('pre_get_document_title', 'change_title_tag_with_cfv');

        // landing old style
        function lp_custom()
        {
            if (is_page('lp:custom')) {
                wp_enqueue_style(
                    'lp-custom-style',
                    get_stylesheet_directory_uri() . '/dist/assets/css/' . foundationpress_asset_path('lp-custom.css'),
                    array(),
                    filemtime(get_theme_file_path('/dist/assets/css/lp-custom.css')),
                    'all'
                );
            }
        }
        add_action('wp_enqueue_scripts', 'lp_custom');

        // landing gutnberg style
        function lp_guten_front()
        {
            if (is_page('lp:gutenberg')) {
                wp_enqueue_style(
                    'lp-guten-front-style',
                    get_stylesheet_directory_uri() . '/dist/assets/css/' . foundationpress_asset_path('lp-guten-front.css'),
                    array(),
                    filemtime(get_theme_file_path('/dist/assets/css/lp-guten-front.css')),
                    'all'
                );
            } else {
                return;
            }
        }
        add_action('wp_enqueue_scripts', 'lp_guten_front');

          function lp_guten_both($post_title)
          {
              $title = get_post($post_title);
              // if (null !== $title) {
              if ('lp:gutenberg' === $title) {
                  wp_enqueue_style(
                      'lp-guten-both-style',
                      get_stylesheet_directory_uri() . '/dist/assets/css/' . foundationpress_asset_path('lp-guten-both.css'),
                      array(),
                      filemtime(get_theme_file_path('/dist/assets/css/lp-guten-both.css')),
                      'all'
                  );
                  // } else {
                  //     return;
                  // }
              }
          }
        add_action('enqueue_block_assets', 'lp_guten_both');

        function lp_guten_editor($post_title)
        {
            $title = get_post($post_title);
            if ('lp:gutenberg' === $title) {
                wp_enqueue_script(
                    'lp-guten',
                    get_stylesheet_directory_uri() . '/dist/assets/js/' . foundationpress_asset_path('lp-guten.js'),
                    array(),
                    filemtime(get_theme_file_path('/dist/assets/js/lp-guten.js')),
                    true
                );
                // } else {
              //     return;
              // }
            }
        }
        add_action('enqueue_block_editor_assets', 'lp_guten_editor');
