# Projet:

1- Créer une page d'accueil contenant un header et un footer => le header doit contenir une nav pour accéder aux differentes pages

- Accès à la page: "ajouter"
|
|-> Seulement si on est connecté, alors on affiche cette page
|
|->si on est pas connecté, on est redirigé vers la page de connexion
   |
   |->On se connecte avec un identifiant et un mot de passe
   |
   |-> si connection reussie, redirection vers la page "ajouter"
        |-> On peut: créer un livre, supprimer un livre, modifier un livre, lire ou récupérer des données existantes de la base de données. 

2- sql
    - On met un systeme en place permettant de créer notre base de données si elle n'existe pas
    - On met en place le même systeme pour la table        

3- astuce
       -> enregister (en session) l'adresse de la page initialement demandée
       -> chercher dans $_SESSION la page sur laquelle on se trouve        

