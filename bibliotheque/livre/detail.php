<?php
require_once '../../helper/request.php'; // Inclusion du fichier de fonctions utilitaires pour les requêtes HTTP
require_once '../../helper/bdd.php'; // Inclusion du fichier de connexion à la base de données

// Récupération du paramètre 'id' depuis la requête HTTP
$id = query('id');

// Vérifie si $id est une séquence de chiffres en utilisant une expression régulière
if (preg_match("/\d+/", $id) === 0) {
    http_response_code(404); // Définit le code de réponse HTTP à 404 si $id n'est pas composé de chiffres
    exit; // Arrête l'exécution du script PHP
}

$c = connection(); // Établit une connexion à la base de données en utilisant la fonction de connexion définie dans bdd.php

// Prépare la requête SQL pour sélectionner les informations du livre avec l'ID spécifié
$sql = "SELECT titre, resume, date_parution FROM livre WHERE id = " . mysqli_real_escape_string($c, $id);
$livre = mysqli_fetch_assoc(mysqli_query($c, $sql)); // Exécute la requête SQL et récupère le résultat sous forme de tableau associatif

$fmt = datefmt_create('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE); // Crée un formateur de date pour le format français, long sans composant de temps

if (!$livre) {
    http_response_code(404); // Définit le code de réponse HTTP à 404 si aucun livre correspondant à l'ID n'est trouvé
    exit; // Arrête l'exécution du script PHP
}

require '../header.php'; // Inclut le fichier d'en-tête HTML pour la page
?>

<h2><?php echo isset($livre['titre']) ? htmlentities($livre['titre']) : '' ?></h2>
<!-- Affiche le titre du livre, en utilisant htmlentities pour échapper les caractères spéciaux -->

<?php if (!empty($livre['date_parution'])): ?>
    <p class="small">
        <b>Date de parution:</b> <?php echo datefmt_format($fmt, date_create($livre['date_parution'])); ?> 
        <!-- Affiche la date de parution du livre en utilisant le formateur de date créé -->
    </p>
<?php endif; ?>

<div>
    <?php echo isset($livre['resume']) ? htmlentities($livre['resume']) : '' ?> 
    <!-- Affiche le résumé du livre, en utilisant htmlentities pour échapper les caractères spéciaux -->
</div>

<?php require '../footer.php'; // Inclut le fichier de pied de page HTML ?>
