<?php


    // Début de la session
    session_start();

    // Metadonnées titre dans HEAD
    define('TITLE_HEAD', [
    'BuildUs | Gérer votre entreprise plus simplement',
    'BuildUs | Créer un compte',
    'BuildUs | Connexion à votre espace',
    'BuildUs | Mot de passe oublié',
    'BuildUs | Page non trouvée',
    'BuildUs | Conditions générales d\'utilisation',
    'BuildUs | Politique de confidentialité',
    'BuildUs | Tableau de bord',
    'BuildUs | Paramètres',
    'BuildUs | Clients',
    'BuildUs | Employés',
    'BuildUs | Calendrier',
    'BuildUs | Rappels',
    'BuildUs | Chiffre d\'affaires',
    ]);

    // Metadonnées description dans HEAD
    define('DESCRIPTION_HEAD', [
    'Gérez votre entreprise plus simplement avec le logiciel web BuildUs et vous focalisez au maximum sur votre coeur de métier.',
    'Créez un compte sur BuildUs et gérez votre entreprise plus simplement.',
    'Connectez-vous à votre espace BuildUs et gérez votre entreprise plus simplement.',
    'Vous avez oublié votre mot de passe BuildUs ? Pas de panique, nous allons vous aider à le retrouver.',
    'La page que vous recherchez n\'existe pas ou plus.',
    'Retrouvez les conditions générales d\'utilisation de BuildUs.',
    'Retrouvez la politique de confidentialité de BuildUs.',
    'Gérez votre entreprise plus simplement avec le logiciel web BuildUs et vous focalisez au maximum sur votre coeur de métier.',
    ]);

    // Données de connexion à la base de données
    define('HOST', 'localhost');
    define('DB_NAME', 'buildUs');
    define('USERNAME', 'godtier');
    define('PASSWORD', 'Dr3tqvmkl2prcg80*');

    // Constante de temps de session
    define('SESSION_TIME', 1200);

    // Tableaux d'erreurs
    $errorsModify = [];
    $errorsRegistration = [];
    $errorConnexion = [];
    $errorForgot = [];