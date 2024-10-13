<?php
 // utilisée pour effectuer une redirection HTTP vers une autre URL. 
function redirect($url) // Elle prend un seul paramètre $url, qui est l'URL vers laquelle vous souhaitez rediriger l'utilisateur.
{
    // Http 302 (FOUND) - redirection temporaire
    header('Location: '.$url, true, 302);   // L'URL de redirection est construite en concaténant la valeur de $url avec la chaîne 'Location: '.
    exit(); 
   
}
