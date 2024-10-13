<?php

const HOST = 'localhost';
const USERNAME = 'root';
const PASSWORD = '';
const DATABASE = 'biblio_2023w36';
const PORT = 3306;

function connection() {  // permet d'acceder à la base de données
    $c = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE, PORT);  // mysqli_connect: Permet d'établir une connexion à la base de données MySQL

    //Cette condition vérifie si une erreur s'est produite lors de la tentative de connexion 
    if(mysqli_connect_errno()) { // Retourne le code d'erreur du dernier appel de connexion

        //Appel à la fonction "emergency" en cas d'échec de connexion :
        emergency(mysqli_connect_error(), ['file' => __FILE__, "line" => __LINE__]);

        // Déclenche une erreur utilisateur(le message d'erreur, Le type d'erreur désigné pour cette erreur. Cela ne fonctionne qu'avec la 
        //famille de constantes E_USER et sera par défaut )
        trigger_error(mysqli_connect_error(), E_USER_ERROR); 
    }

    // Configuration des rapports d'erreurs MySQLi
    // Cette ligne configure le rapport d'erreurs de MySQLi pour signaler à la fois les erreurs standard et les avertissements stricts.
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Renvoi de la connexion 
    // Si la connexion réussit, la fonction renvoie l'objet de connexion MySQLi, qui peut ensuite être utilisé pour effectuer des requêtes sur la base de données.
    return $c;
}


