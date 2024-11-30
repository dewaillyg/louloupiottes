<?php
/*
    Template Name: Verification Reussis
*/
?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body class="louloupiottes__verification_success">
    <?php wp_body_open(); ?>
    <h2>Votre e-mail a été vérifié avec succès. Vous pouvez maintenant vous connecter.</h2>
    <a href="<?php echo get_permalink(get_page_by_path('connexion')); ?>">Se connecter</a>
</body>

</html>