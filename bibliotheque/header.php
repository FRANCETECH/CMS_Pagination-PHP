<?php require_once __DIR__.'/../helper/session.php' ?>
<!doctype html>
<html lang="fr">
<head>
    <base href="/bibliotheque" /> 
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"/>
    <title>Bibliothèque</title>
</head>
<body class="d-flex flex-column h-100">
<div class="container-fluid"> 
    <header class="pt-5">    
        <h1>Bibliothèque Dawan</h1>
    </header>
    <nav class="nav nav-expand-lg">
        <a href="/bibliotheque/index.php" class="nav-link">Accueil</a>
        <a href="/bibliotheque/livre/index.php" class="nav-link">Liste des livres</a>
        <a href="/bibliotheque/livre/ajouter.php" class="nav-link">Ajouter un livre</a>
        <?php if(!has_user_connect()): ?>
            <a href="/bibliotheque/connexion.php" class="nav-link">Se connecter</a>
        <?php endif; ?>
    </nav>
    <?php if(has_user_connect()): ?>
    <div class="text-end">
        Bonjour <?php echo get_user_connect()['name']; ?>
        (
            <a href="/bibliotheque/mon-profil/index.php">Voir mon profil</a> -
            <a href="/bibliotheque/deconnexion.php">Se déconnecter</a>
        )
    </div>
    <?php endif; ?>
    <?php echo display_message_flash('success'); ?>
    <main>
