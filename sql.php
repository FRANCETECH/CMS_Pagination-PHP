<?php


// Cette variable stocke le nom d'hôte ou l'adresse IP du serveur de base de données auquel vous souhaitez vous connecter.
$host = 'localhost'; 
// Cette variable contient le nom d'utilisateur que vous utiliserez pour vous connecter à la base de données
$username = 'root'; 
 // C'est le mot de passe associé à l'utilisateur défini dans $username
$password = '';   
// Cette variable contient le nom de la base de données à laquelle vous souhaitez vous connecter.
$database = null;  
$port = 3306;

echo "<p>Connexion au SGBD</p>";

$c = mysqli_connect($host, $username, $password, $database, $port);

//Si erreurs
if(mysqli_connect_errno()) {         
    echo mysqli_connect_error();
    exit(); // exit: Affiche un message et termine le script courant                      
}

echo "<p>Connexion établie</p>";

mysqli_set_charset($c, 'utf8mb4');

echo "<p>Création de la base de données</p>";
$database = "biblio_2023w36";
$sql = "CREATE DATABASE IF NOT EXISTS ".$database;

// erreurs
if (!mysqli_query($c, $sql)) {    
    echo mysqli_error($c);
    mysqli_close($c);
    exit();
}

echo "<p>Connexion à la base de données</p>";
mysqli_select_db($c, $database); // mysqli_select_d: Sélectionne une base de données par défaut pour les requêtes

/**
 * $sql = <<<SQL ... SQL;: syntaxe appelée "heredoc" en PHP, qui permet de créer une chaîne de caractères 
 * multilignes de manière plus lisible.
 * Dans ce cas, la chaîne SQL commence par <<<SQL et se termine par SQL; Tout ce qui se trouve entre 
 * ces balises est 
 * considéré comme une chaîne de caractères,  y compris les sauts de ligne et l'indentation. 
 * ENGINE=InnoDB: spécifie le moteur de stockage à utiliser pour la table. Dans ce cas, le moteur 
 * "InnoDB" est utilisé.  Le moteur de stockage 
 * détermine comment les données sont stockées et gérées dans la table. InnoDB est l'un des moteurs de
 *  stockage MySQL couramment utilisés 
 * en raison de ses fonctionnalités de gestion de transactions et de clés étrangères. 
*/
$sql = <<<SQL
CREATE TABLE IF NOT EXISTS livre (     
    id int PRIMARY KEY AUTO_INCREMENT,
    titre varchar(50) not null,
    `resume` text,
    date_parution date
) ENGINE=InnoDB;  
SQL;

echo "<p>Création de la table livre</p>";

// Si erreurs
if (!mysqli_query($c, $sql)) {
    echo mysqli_error($c);
    mysqli_close($c);
    exit();
}

// heredoc. Explication. Création de la Table utilisateur
$sql = <<<SQL
CREATE TABLE IF NOT EXISTS utilisateur (
    id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(50) not null,
    password varchar(150) not null,
    `name` varchar(50)
) ENGINE=InnoDB;
SQL;

echo "<p>Création de la table utilisateur</p>";

// Si erreurs
if (!mysqli_query($c, $sql)) {
    echo mysqli_error($c);
    mysqli_close($c);
    exit();
}

// blowfish. => Algorithme
$password = password_hash('admin',  PASSWORD_DEFAULT);
$sql = "INSERT INTO utilisateur (`username`, `password`, `name`) VALUE ('admin', '".$password."', 'John Doe')";

echo "<p>Insertion utilisateur</p>";
if (!mysqli_query($c, $sql)) {
    echo mysqli_error($c);
    mysqli_close($c);    // Pour fermer la connexion
    exit(); // exit; Affiche un message et termine le script courant
}

mysqli_close($c);
