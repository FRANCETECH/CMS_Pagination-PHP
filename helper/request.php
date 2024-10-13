<?php
//Pour faciliter la récupération de données à partir du tableau $_POST, qui contient les données envoyées via une requête HTTP POST. 
function request ($key, $default = null) // $key : C'est la clé (ou le nom) de la valeur que l'on souhaite récupérer dans le tableau $_POST.
{                                       // $default: est une valeur par défaut optionnelle à renvoyer si la clé n'est pas présente dans $_POST.
    if(!array_key_exists($key, $_POST)) { // empty: Détermine si une variable est vide
        trigger_error(sprintf("La clé %s n'existe pas dans le tableau _POST", $key), E_USER_ERROR);
    }

    return !empty($_POST[$key]) ? $_POST[$key] : $default;
}

/**
 * Cette fonction PHP, appelée query, est conçue pour faciliter la récupération de valeurs depuis la 
 * superglobale $_GET (les données transmises via l'URL, généralement via une requête GET). Voici une explication ligne par ligne :
*/
function query($key, $default = null)
{
    // Vérifie si la clé spécifiée $key existe dans le tableau $_GET et si sa valeur n'est pas vide.
    if(array_key_exists($key, $_GET) && !empty($_GET[$key])) {
        return $_GET[$key]; // Si la clé existe dans $_GET et a une valeur non vide, la fonction renvoie cette valeur.
    }

    return  $default; //  Si la clé n'existe pas dans $_GET ou si sa valeur est vide, la fonction renvoie la valeur par défaut spécifiée.
}


