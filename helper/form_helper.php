<?php

require_once 'session.php'; // J'appelle le fichier session.php pour utiliser ses fonctions

function form_errors($fieldName, $errors): string
{
    // On initialise la variable $html à une chaine de caractère vide
    $html = ""; 
    //On verifie si $fieldName existe dans le tableau d'erreurs. Si c'est le cas, cela signifie qu'il y a des erreurs associées à ce champ de formulaire.
    if (isset($errors[$fieldName])) {  
        /*la fonction construit une chaîne de caractères HTML pour afficher ces erreurs. Elle ajoute une balise <div> avec la classe CSS "text-danger" 
        pour appliquer un style de texte en rouge.
        */
        $html = "<div class='text-danger'>"; 

        foreach ($errors[$fieldName] as $error) {
            // On utilise la fonction sprintf pour formater le message d'erreur dans une balise <p> et l'ajoute à la chaîne $html.
            $html .= sprintf("<p>%s</p>", $error); 

        }
        $html .= "</div>"; // Enfin, la fonction ferme la balise <div> 
    }

    return $html; //et renvoie la chaîne HTML résultante, qui contient les messages d'erreur formatés
}

// Cette fonction permet de sécuriser nos formulaires en utilisant le csrf_token()
function csrf_token(): string
{
    // valeur + datetime + url

    // bin2hex(): Convertit des données binaires en représentation hexadécimale
    $token = bin2hex(random_bytes(35)); // random_bytes:Récupère des octets aléatoires cryptographiquement sécurisés
    $_SESSION[TOKEN] = $token;         // Création d'un token
    return $token;                     // Cette fonction retourne un token
}
