<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['custom_login'])) {
    // Récupération des informations du formulaire
    $creds = [
        'user_login'    => sanitize_text_field($_POST['username']),
        'user_password' => sanitize_text_field($_POST['password']),
    ];

    // Tentative de connexion
    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        echo '<p class="header__errors" style="color: red;">' . $user->get_error_message() . '</p>';
    } else {
        wp_redirect(esc_url(home_url())); // Redirection après connexion (personnalisable)
        exit;
    }
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body>
    <?php wp_body_open(); ?>
    <!-- VERSION DESKTOP -->
    <!-- VERSION DESKTOP -->
    <!-- VERSION DESKTOP -->
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
                <!-- Si l'utilisateur est connecté -->
                <?php if (is_user_logged_in()) : $currentUser = wp_get_current_user(); ?>
                    <div class="desktop_connected">
                        <div>
                            <a href=""><?= get_avatar($currentUser->ID, 48) ?></a>
                        </div>
                        <div>
                            <a href="<?= esc_url(wp_logout_url(home_url())); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <!-- Sinon -->
                <?php else : ?>
                    <a href="<?php $loginPage = get_page_by_path('connexion');
                                if ($loginPage) {
                                    $loginPageURL = get_permalink($loginPage->ID);
                                    echo esc_url($loginPageURL);
                                } ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <p>Connexion</p>
                    </a>
                <?php endif; ?>
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
    <!-- VERSION RESPONSIVE -->
    <!-- VERSION RESPONSIVE -->
    <!-- VERSION RESPONSIVE -->
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
            <div class="header__login">
                <!-- Si l'utilisteur est connecté -->
                <?php if (is_user_logged_in()) : $currentUser = wp_get_current_user(); ?>
                    <div class="header__login_responsive">
                        <h2>Profil</h2>
                        <p><?= get_avatar($currentUser->ID, 48) ?></p>
                        <?= esc_html($currentUser->display_name); ?>
                        <div>
                            <a href="">Editer</a>
                            <a href="<?= esc_url(wp_logout_url(home_url())); ?>">Déconnexion</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div>
                        <h2>Se connecter</h2>
                        <form method="POST">
                            <input placeholder="Login" type="text" name="username" id="username" required>
                            <input placeholder="Mot de passe" type="password" name="password" id="password" required>
                            <div>
                                <button type="submit" name="custom_login">Connexion</button>
                                <a href="<?php $loginPage = get_page_by_path('inscription');
                                    if ($loginPage) {
                                        $loginPageURL = get_permalink($loginPage->ID);
                                         echo esc_url($loginPageURL);
                                    }
                                ?>">S'inscrire</a>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <?php dynamic_sidebar('blog-sidebar'); ?>