<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body>
    <?php wp_body_open(); ?>
    <header class="louloupiottes__header">

        <div class="header__top">
            <nav class="top__left">
                <a href="<?= home_url('/') ?>">
                    <img class="louloupiottes__header_img" alt='logo' src='<?= get_template_directory_uri() ?>/assets/img/logo.png' />
                </a>
                <?= bloginfo('name'); ?>
                <div>
                    <?php get_search_form() ?>
                </div>

            </nav>
            <div class="top__right">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main',
                    'container' => 'ul',
                ));
                ?>
            </div>
        </div>
        <nav class="header__bottom">
            <?php dynamic_sidebar('categories-sidebar'); ?>
        </nav>

        <div class="header__hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>
    <nav class="header__responsive">
        <div>
            <div>
                <?php get_search_form() ?>
            </div>
            <div class="pages">
                <h2>Pages</h2>
                <div class="top__right">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main',
                        'container' => 'ul',
                    ));
                    ?>
                </div>
            </div>
            <nav class="header__bottom">
                <h2>Catégories</h2>
                <?php dynamic_sidebar('categories-sidebar'); ?>
            </nav>
        </div>
    </nav>
    <?php dynamic_sidebar('blog-sidebar'); ?>