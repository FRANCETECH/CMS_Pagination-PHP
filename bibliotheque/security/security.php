<?php

require_once '../../helper/session.php';
require_once '../../helper/response.php';

// utilisé pour gérer la redirection vers une page de connexion lorsque l'utilisateur n'est pas connecté. 
if (!has_user_connect()) {
    // le code enregistre l'URL actuelle ($_SERVER['REQUEST_URI']) dans une variable de session nommée REDIRECT_URL
    // Cela permet de mémoriser l'URL que l'utilisateur avait initialement demandée avant d'être redirigé vers la page de connexion.
    // Une fois connecté il sera de nouveau redirigé vers la page qu'il avait démandé avant d'être redirigé vers la page de connexion
    $_SESSION[REDIRECT_URL] = $_SERVER['REQUEST_URI']; 
    redirect('/bibliotheque/connexion.php');
}
