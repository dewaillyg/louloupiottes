<?php

function charger_master_css(): void
{
    wp_enqueue_style(
        'master-style',
        get_template_directory_uri() . '/styles/master.css',
        array(),
        '1.0',
        'all'
    );
}

function custom_search_form($form)
{
    $form = '
    <form class="louloupiottes__searchform" role="search" method="get" id="searchform" action="' . esc_url(home_url('/')) . '">
        <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Rechercher" />
        <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
    </form>';
    return $form;
}

add_theme_support('post-thumbnails');
add_theme_support('title-tag');

register_nav_menus(array(
    'main' => 'Menu Principal',
    'footer' => 'Bas de Page',
));

register_sidebar(array(
    'id' => 'blog-sidebar',
    'name' => 'Blog'
));

register_sidebar(array(
    'id' => 'categories-sidebar',
    'name' => 'Categories'
));

add_action('wp_enqueue_scripts', 'charger_master_css');
add_filter('get_search_form', 'custom_search_form');
