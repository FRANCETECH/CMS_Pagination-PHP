<?php

// Vérifie que la valeur donnée n'est pas vide après avoir supprimé les espaces de début et de fin
function notBlank($value)
{
    if (is_null($value) || !is_string($value)) {
        return false;
    }
    // Trim supprime les espaces en début et fin de chaîne, puis vérifie si la chaîne est vide
    return trim($value) !== '';
}

//$test = notBlank('');
//var_dump($test);

// Vérifie que le nom donné ne contient que des lettres
function validName($name)
{
    // Utilise une expression régulière pour vérifier que le nom ne contient que des lettres Unicode
    // La regex '/^[\p{L}]+$/u' signifie :
    // - ^ : début de la chaîne
    // - [\p{L}]+ : un ou plusieurs caractères de lettre Unicode
    // - $ : fin de la chaîne
    // - /u : modificateur Unicode
    return preg_match('/^[\p{L}]+$/u', $name);
}

//$test = validName('diallo12');
//var_dump($test);

// Vérifie que l'email donné est valide
function validEmail($email)
{
    // Utilise la fonction filter_var avec le filtre FILTER_VALIDATE_EMAIL
    // Retourne false si l'email n'est pas valide
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
//$test = validEmail('kdiallodawan.fr');
//var_dump($test);

// Vérifie que le fichier donné n'est pas vide en vérifiant le code d'erreur UPLOAD_ERR_OK
function fileNotBlank($file)
{
    // Vérifie si la clé 'error' existe dans le tableau $file
    // Si elle n'existe pas, déclenche une erreur
    if (!isset($file['error'])) {
        trigger_error('La clé "error" n\'a pas été trouvé dans le tableau $file', E_USER_ERROR);
    }
    // Retourne true si le code d'erreur est UPLOAD_ERR_OK, indiquant que le fichier a été uploadé sans problème
    return $file['error'] === UPLOAD_ERR_OK;
}

// Vérifie que la taille du fichier est valide en vérifiant le code d'erreur UPLOAD_ERR_OK
function validFileSize($file)
{
   
    if (!isset($file['error'])) {
        trigger_error('La clé "error" n\'a pas été trouvé dans le tableau $file', E_USER_ERROR);
    }
    // Retourne true si le code d'erreur est UPLOAD_ERR_OK, indiquant que la taille du fichier est correcte
    return $file['error'] === UPLOAD_ERR_OK;
}

// Vérifie que le type MIME du fichier est dans la liste des types MIME autorisés
function validFileType($file, $allowedMimes)
{
    if (!isset($file['type'])) {
        trigger_error('La clé "type" n\'a pas été trouvé dans le tableau $file', E_USER_ERROR);
    }
    // Retourne true si le type MIME du fichier est dans le tableau des types MIME autorisés
    return in_array($file['type'], $allowedMimes);
}