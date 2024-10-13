<?php
require_once '../helper/request.php';
require_once '../helper/session.php';
require_once '../helper/bdd.php';
require_once '../helper/response.php';
require_once '../helper/form_helper.php';
require_once '../helper/logger.php';

notice('Accès à la page connexion');

$errors = [];

//vérifie si la méthode HTTP utilisée pour accéder à la page est une méthode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // utilisée pour obtenir la valeur d'un paramètre dans la requête HTTP. Le paramètre recherché est le champ de
    // formulaire avec le nom "username".
    $username = request('username');
    $password = request('password');
    $token = request('token');

    //$token === $_SESSION[TOKEN]: la valeur du jeton fourni ($token) est égale à la valeur stockée dans la session
    //Cela garantit que le jeton soumis correspond au jeton attendu dans la session.  contribuant ainsi à la protection 
    // contre les attaques CSRF.
    if (!$token || $token === $_SESSION[TOKEN]) {

        $c = connection();

        // protection contre les injections SQL
        $username = mysqli_real_escape_string($c, $username);

        $sql = "SELECT * FROM utilisateur WHERE username = '" . $username . "'";
        $result = mysqli_query($c, $sql);
        $user = mysqli_fetch_assoc($result);

        if (!$user) {
            $errors['authentication'][] = "Erreur d'authentification";

            error("Utilisateur non trouvé", ['username' => $username]);
        } elseif (!password_verify($password, $user['password'])) {
            $errors['authentication'][] = "Erreur d'authentification";

            error("Mauvais mot de passe", ['username' => $username]);
        } else {

            notice(sprintf("Utilisateur %s connecté", $username), ['username' => $username]);
            $_SESSION[USER] = $user;

            if (isset($_SESSION[REDIRECT_URL])) {
                $redirect_url = $_SESSION[REDIRECT_URL];
                unset($_SESSION[REDIRECT_URL]);
                redirect($redirect_url);
            }

            redirect('/bibliotheque/livre/index.php');
        }
    } else {
        $errors['authentication'][] = "Le token n'est pas valide";

        error("Le token n'est pas valide");
    }

}

require 'header.php' ?>

<h2>Connection</h2>

<?php echo form_errors('authentication', $errors) ?>

<form method="post" action="">
    <input type="hidden" name="token" value="<?php echo csrf_token() ?>"/>
    <div class="mb-3">
        <label for="username" class="form-label">Identifiant: </label>
        <input type="text" class="form-control" id="username" name="username"
               value="<?php echo $username ?? null ?>"/>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe: </label>
        <input type="password" class="form-control" id="password" name="password"/>
    </div>

    <button class="btn btn-outline-primary">Se connecter</button>
</form>

<?php require 'footer.php' ?>
