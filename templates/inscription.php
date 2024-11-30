<?php
/*
    Template Name: Inscription
*/
?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$errorsMessage = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

    $username = sanitize_user($_POST['username'], true);
    $email = sanitize_email($_POST['mail']);
    $password = $_POST['password'];
    $passwordCheck = $_POST['passwordCheck'];

    // Vérification des champs vides
    if (empty($username) || empty($email) || empty($password) || empty($passwordCheck)) {
        $errorsMessage = 'Tous les champs sont obligatoires.';
    }
    // Vérification des mots de passe
    elseif ($password !== $passwordCheck) {
        $errorsMessage = 'Les mots de passe ne correspondent pas.';
    }
    // Vérification de l'existence du compte
    elseif (username_exists($username) || email_exists($email)) {
        $errorsMessage = 'Le nom d\'utilisateur ou l\'e-mail est déjà utilisé.';
    }
    // Création de l'utilisateur
    else {
        $user_id = wp_create_user($username, $password, $email);

        if (is_wp_error($user_id)) {
            $errorsMessage = 'Erreur lors de la création de l\'utilisateur : ' . $user_id->get_error_message();
        } else {
            if (!is_wp_error($user_id)) {
                $verification_code = md5($user_id . time());
                update_user_meta($user_id, 'email_verification_code', $verification_code);

                $verification_link = add_query_arg(
                    [
                        'action' => 'verify_email',
                        'user_id' => $user_id,
                        'code' => $verification_code
                    ],
                    site_url()
                );


                $subject = 'Vérifiez votre adresse e-mail pour activer votre compte';

                $template = file_get_contents(get_template_directory() . '/templates/email-template.html'); 

                $template = str_replace('{{username}}', $username, $template); 
                $template = str_replace('{{verification_link}}', $verification_link, $template); 

                // En-têtes de l'email (important pour spécifier que c'est du HTML)
                $headers = array('Content-Type: text/html; charset=UTF-8');

                // Envoi de l'email
                wp_mail($email, $subject, $template, $headers);


                $success = 'Votre compte a été créé avec succès. Un e-mail de vérification a été envoyé.';
            }
        }
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
        <h1>Inscription</h1>
        <form method="POST">
            <input placeholder="Login" type="text" name="username" id="username" required>
            <input placeholder="Mail" type="text" name="mail" id="mail" required>
            <input placeholder="Mot de passe" type="password" name="password" id="password" required>
            <input placeholder="Confirmez Mot de passe" type="password" name="passwordCheck" id="passwordCheck" required>
            <div>
                <button type="submit" name="register">S'inscrire</button>
                <a href="<?php $inscriptionPage = get_page_by_path('connexion');
                            if ($inscriptionPage) {
                                $inscriptionPageURL = get_permalink($inscriptionPage->ID);
                                echo esc_url($inscriptionPageURL);
                            }
                            ?>">Se connecter</a>
            </div>
        </form>
        <?php if ($errorsMessage != '') : ?>
            <p class="errors"><?= $errorsMessage ?></p>
        <?php elseif ($errorsMessage == "" && $success != "") : ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>
    </div>
</body>

</html>