<?php
require_once '../security/security.php'; // Inclut le fichier de sécurité pour vérifier et appliquer les mesures de sécurité.
require_once '../../helper/form_helper.php'; // Inclut le fichier contenant des fonctions d'aide pour les formulaires.
require_once '../../helper/bdd.php'; // Inclut le fichier contenant les fonctions de connexion à la base de données.
require_once '../../helper/response.php'; // Inclut le fichier contenant les fonctions pour gérer les réponses HTTP.
require_once '../../validator/validators.php'; // Inclut le fichier contenant les fonctions de validation des données.
require_once '../../helper/request.php'; // Inclut le fichier contenant des fonctions pour gérer les requêtes.
require_once '../../helper/session.php'; // Inclut le fichier contenant des fonctions pour gérer les sessions.

$c = connection(); // Se connecte à la base de données et stocke la connexion dans la variable $c.
$errors = []; // Initialise un tableau vide pour stocker les erreurs.

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si la requête est une requête POST.

    $titre = request('titre'); // Récupère la valeur du champ 'titre' de la requête.
    $resume = request('resume'); // Récupère la valeur du champ 'resume' de la requête.
    $date_parution = request('date_parution'); // Récupère la valeur du champ 'date_parution' de la requête.

    if (!notBlank($titre)) { // Vérifie si le champ 'titre' n'est pas vide.
        $errors['titre'][] = "Le titre est obligatoire"; // Ajoute un message d'erreur au tableau $errors si le titre est vide.
    }

    if (count($errors) === 0) { // Si aucune erreur n'a été détectée.
        // https://www.php.net/manual/fr/datetime.format.php
        if ($date_parution != null) { // Si une date de parution a été fournie.
            $date_parution = date_format(date_create($date_parution), 'Y-m-d'); // Formate la date de parution au format 'Y-m-d'.
        }

        // Protection contre les injections SQL avec mysqli_real_escape_string
        $titre = $titre !== null ? mysqli_real_escape_string($c, $titre) : null; // Échappe les caractères spéciaux du titre.
        $resume = $resume !== null ? mysqli_real_escape_string($c, $resume) : null; // Échappe les caractères spéciaux du résumé.
        $date_parution = $date_parution !== null ? mysqli_real_escape_string($c, $date_parution) : null; // Échappe les caractères spéciaux de la date de parution.

        $sql = "INSERT INTO livre (`titre`, `resume`, `date_parution`) VALUE ('".$titre."'"; // Commence la construction de la requête SQL pour insérer un livre.
        $sql .= ($resume != null) ? ", '".$resume."'" : ", NULL"; // Ajoute le résumé à la requête SQL, ou NULL si le résumé est vide.
        $sql .= ($date_parution != null) ? ", '".$date_parution."'" : ", NULL"; // Ajoute la date de parution à la requête SQL, ou NULL si la date de parution est vide.
        $sql .= ")"; // Termine la construction de la requête SQL.

        mysqli_query($c, $sql); // Exécute la requête SQL.
        mysqli_close($c); // Ferme la connexion à la base de données.

        create_message_flash('success', 'Le livre a bien été ajouté'); // Crée un message flash de succès.

        // Pattern Post-redirect-get (redirection)
        redirect('/bibliotheque/livre/index.php'); // Redirige vers la page index.php après l'ajout du livre.
    }
}

require '../header.php'; // Inclut le fichier d'en-tête.
?>

<h2>Ajouter un livre</h2> <!-- Affiche le titre de la page -->

<form method="post" action=""> <!-- Début du formulaire avec la méthode POST -->
    <div class="mb-3">
        <label for="titre" class="form-label">Titre: </label> <!-- Étiquette pour le champ titre -->
        <input type="text" class="form-control" id="titre" name="titre"
               placeholder="Titre du livre" value=""/> <!-- Champ de saisie pour le titre du livre -->
        <?php echo form_errors('titre', $errors); ?> <!-- Affiche les erreurs liées au champ titre, s'il y en a -->
    </div>
    <div class="mb-3">
        <label for="resume" class="form-label">Résumé: </label> <!-- Étiquette pour le champ résumé -->
        <textarea name="resume" id="resume" class="form-control" placeholder="Résumé du livre"></textarea> <!-- Champ de saisie pour le résumé du livre -->
    </div>
    <div class="mb-3">
        <label for="date_parution" class="form-label">Date de parution: </label> <!-- Étiquette pour le champ date de parution -->
        <input type="date" class="form-control" id="date_parution" name="date_parution" value=""/> <!-- Champ de saisie pour la date de parution -->
    </div>

    <button class="btn btn-outline-primary">Ajouter</button> <!-- Bouton pour soumettre le formulaire -->
</form>

<?php require '../footer.php'; // Inclut le fichier de pied de page ?>
