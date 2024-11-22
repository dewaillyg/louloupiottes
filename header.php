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
            <div class="header__login">
                <!-- Si l'utilisteur est connecté -->
                <?php if (is_user_logged_in()) : $currentUser = wp_get_current_user(); ?>
                    <p><?= get_avatar($currentUser->ID, 48) ?></p>
                    <?= esc_html($currentUser->display_name); ?>
                    <a href="<?= esc_url(wp_logout_url(home_url())); ?>">Déconnexion</a>
                <?php else : ?>
                    <div>
                        <h2>Se connecter</h2>
                        <form method="POST">
                            <p>
                                <label for="username">Nom d'utilisateur :</label>
                                <input type="text" name="username" id="username" required>
                            </p>
                            <p>
                                <label for="password">Mot de passe :</label>
                                <input type="password" name="password" id="password" required>
                            </p>
                            <p>
                                <button type="submit" name="custom_login">Connexion</button>
                            </p>
                        </form>
                    </div>
                    <p>S'inscrire</p>
                <?php endif; ?>
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