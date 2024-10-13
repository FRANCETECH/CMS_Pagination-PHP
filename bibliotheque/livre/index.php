<?php
require_once '../../helper/request.php';
require_once '../../helper/bdd.php';

// Récupérer les paramètres de recherche, de tri, etc.
$query = query('q');
$field = query('field');
$sort = query('sort', "asc");

// Déterminer la page actuelle et le nombre de résultats par page
$page = query('page', 1); // Page actuelle (par défaut 1)
$results_per_page = 3; // Nombre de résultats par page
$offset = ($page - 1) * $results_per_page; // Calcul de l'offset

// Connexion à la base de données
$c = connection();

// Construction de la requête SQL de base
$sql = "SELECT id, titre, date_parution FROM livre";

// Si une recherche est effectuée, ajouter une clause WHERE
if ($query != null) {
    $sql .= " WHERE titre LIKE '%" . mysqli_real_escape_string($c, $query) . "%'";
}

// Si des options de tri sont spécifiées, les ajouter
if ($field != null && $sort != null) {
    if ($sort != "asc" && $sort != "desc") {
        $sort = "asc";
    }
    $sql .= " ORDER BY " . mysqli_real_escape_string($c, $field) . " " . mysqli_real_escape_string($c, $sort);
}

// Limiter les résultats pour la pagination
$sql .= " LIMIT $results_per_page OFFSET $offset";

// Exécuter la requête SQL
$result = mysqli_query($c, $sql);
$livres = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Obtenir le nombre total de livres pour la pagination
$count_sql = "SELECT COUNT(*) AS total FROM livre";
if ($query != null) {
    $count_sql .= " WHERE titre LIKE '%" . mysqli_real_escape_string($c, $query) . "%'";
}
$count_result = mysqli_query($c, $count_sql);
$total_livres = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_livres / $results_per_page);

// Formatter la date
$fmt = datefmt_create('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);

require '../header.php';
?>

<h2>Liste des livres</h2>

<!-- Formulaire de recherche -->
<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="input-group mb-3">
        <input
        type="search" name="q" class="form-control" aria-label="Rechercher par le titre" placeholder="Rechercher par le titre" value="<?php echo $query; ?>"/>
        <?php if ($query): ?>
            <a href="/bibliotheque/livre/" class="btn btn-outline-secondary">Réinitialiser le filtre</a>
        <?php endif ?>
        <button class="btn btn-outline-secondary">Rechercher</button>
    </div>
</form>

<table class="table">
    <thead>
        <tr>
            <th>Numero</th>
            <th>Titre Du Livre</th>
            <th>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo http_build_query(array_merge($_GET, ['field' => 'date_parution', 'sort' => $sort === 'asc' ? 'desc' : 'asc'])); ?>">
                    Date de parution
                </a>
            </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($livres): ?>
            <?php foreach ($livres as $livre): ?>
                    <tr>
                        <td><?php echo htmlentities($livre['id']); ?></td>
                        <td><?php echo htmlentities($livre['titre']); ?></td>
                        <td><?php echo $livre['date_parution'] != null ? datefmt_format($fmt, date_create($livre['date_parution'])) : '-'; ?></td>
                        <td class="text-end">
                            <a href="/bibliotheque/livre/detail.php?id=<?php echo $livre['id'] ?>">Détail</a>
                            -
                            <a href="/bibliotheque/livre/modifier.php?id=<?php echo $livre['id'] ?>">Modifier</a>
                            -
                            <a href="/bibliotheque/livre/supprimer.php?id=<?php echo $livre['id'] ?>">Supprimer</a>
                        </td>
                    </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">Aucun livre</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Affichage de la pagination -->
<nav aria-label="Pagination">
    <ul class="pagination">
        <!-- Bouton "Précédent" -->
        <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
            <a class="page-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>">Précédent</a>
        </li>
        
        <!-- Numéros de page -->
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                <a class="page-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
        
        <!-- Bouton "Suivant" -->
        <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
            <a class="page-link" href="<?php echo $_SERVER['PHP_SELF']; ?>?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>">Suivant</a>
        </li>
    </ul>
</nav>


<?php require '../footer.php'; ?>
