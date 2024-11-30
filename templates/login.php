<?php
/*
  Template Name: Login
*/
?>
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

<body class="louloupiottes__login_body">
  <?php wp_body_open(); ?>
  <div class="louloupiottes__login">
    <h1>Connexion</h1>
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
</body>

</html>