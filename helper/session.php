<?php

session_start();

const FLASH = 'message_flash';
const USER = 'user';
const REDIRECT_URL = 'redirect_url';
const TOKEN = 'token';

//Est utilisée pour stocker des messages flash dans la session de l'application web. Les messages flash sont généralement utilisés pour afficher 
// des messages temporaires  à l'utilisateur après une action, tels que des notifications de succès, d'erreur ou d'autres informations importantes.
function create_message_flash($type, $message) 
{
    $_SESSION[FLASH][$type][] = $message;
}


//Est utilisée pour afficher les messages flash stockés dans la session de l'application web. 
// $type, qui spécifie le type de message flash à afficher (par exemple, "success", "error", "warning", etc.).
function display_message_flash($type) 
{
    if (!isset($_SESSION[FLASH])) { //Permet de verifier si le tableau existe
        /*Si ce tableau n'existe pas, cela signifie qu'il n'y a pas de messages flash enregistrés dans la session, et la fonction se termine en 
          retournant null.
        */
        return; 
    }

    $flashes = $_SESSION[FLASH]; // Si $_SESSION[FLASH] existe, la fonction récupère tout le contenu de ce tableau dans la variable $flashes

    if (!isset($flashes[$type])) { // vérifie si le type de message spécifié ($type) existe dans le tableau $flashes
        return;
    }

    // Si le type de message existe dans $flashes, la fonction récupère le tableau de messages associés à ce type dans la variable $messages
    $messages = $flashes[$type];

    unset($_SESSION[FLASH][$type]); // Ensuite, la fonction supprime le tableau de messages associé à ce type de la session.

    // La fonction construit un bloc HTML qui affiche les messages flash dans une boîte d'alerte. 
    $html = "<div class='alert alert-" . $type . "'>";
    foreach ($messages as $message) {
        $html .= "<p class='mb-0'>" . $message . "</p>";
    }
    $html .= "</div>";

    return $html; // Enfin, la fonction renvoie le code HTML complet de l'alerte contenant les messages flash.
}

// utilisée pour vérifier si un utilisateur est connecté en examinant les données stockées dans la session
function has_user_connect(): bool     
{
    return array_key_exists(USER, $_SESSION) && !empty($_SESSION[USER]); // la clé USER existe dans $_SESSION et elle n'est pas vide)=> true
}                                                                        // ce qui signifie que l'utilisateur est considéré comme connecté.

// utilisée pour récupérer les données de l'utilisateur connecté à partir de la session. 
function get_user_connect(): ?array   // ?array -> peut retourner soit un tableau, soit null
{
    if (!has_user_connect()) {
        return null;
    }
//utilisateur est connecté (c'est-à-dire que la session contient des données d'utilisateur)
    return $_SESSION[USER]; 
/*renvoie les données d'utilisateur stockées dans la session en utilisant la clé USER. Les données d'utilisateur sont renvoyées sous forme de 
tableau associatif (array).*/
}
