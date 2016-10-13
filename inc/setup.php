<?php
/**
 * Setup script for this theme
 * =====================================================
 * @package  growp
 * @license  GPLv2 or later
 * @since 1.0.0
 * =====================================================''
 */

/**
 * テーマのセットアップ
 * @return void
 */


function growp_setup()
{

    load_theme_textdomain('growp', get_template_directory() . '/languages');
    load_theme_textdomain('tgmpa', get_template_directory() . '/languages');

    // automatic feed をサポート
    add_theme_support('automatic-feed-links');

    // パンくず をサポート
    add_theme_support('growp-breadcrumbs');

    // ページネーション をサポート
    add_theme_support('growp-pagination');

    // アイキャッチ画像のサポート
    add_theme_support('post-thumbnails');

    // メニューのサポート
    add_theme_support('menus');

    // タイトルタグをサポート
    add_theme_support('title-tag');

    // HTML5構造化マークアップで出力
    add_theme_support(
        'html5',
        array(
            'comment-list',
            'search-form',
            'comment-form',
            'gallery',
            'caption',
        )
    );

    // editor-style を登録
    add_editor_style(GROWP_STYLESHEET_URL);

}

add_action('after_setup_theme', 'growp_setup');

/**
 * wp_head() で出力されるタグの調整
 *
 * @return void
 */
function growp_head_cleanup()
{

    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

    global $wp_widget_factory;

    remove_action('wp_head',
        array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style',
        )
    );
}

add_filter('init', 'growp_head_cleanup', 10);


// 登録のサンプル
function growp_register_menus()
{
    new MenuPosts('global_nav', 'グローバルナビゲーション');
}

add_action("registered_taxonomy", "growp_register_menus");
