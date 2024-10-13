<?php

/**
 * Il est important de définir le fuseau horaire correctement pour éviter des erreurs potentielles liées à la gestion du temps dans le script.
 * Cela assure également une cohérence lors de l'utilisation de fonctions liées à la date et à l'heure, en s'assurant que les calculs et les 
 * comparaisons sont effectués dans le contexte du fuseau horaire approprié. 
*/
ini_set("date.timezone", "Europe/Paris"); //

const NOTICE = "NOTICE";
const ERROR = "ERROR";
const EMERGENCY = "EMERGENCY"; // EMERGENCY signifie uergence

// void (procédure) la fonction ne renvoie pas de valeur. (Fait une action)
function writelog($level, $message, $params): string // writelog: en anglais signifie journal d'ecriture
{
    $path = __DIR__.'/../bibliotheque/var/log/connexion.txt'; // Le chemin complet du fichier dans le quel on doit écrire
    $date = date_format(date_create(), 'c');  // date_create: création d'un objet dateTime

    // [date + heure] level: message [params]
    $message = sprintf("[%s] %s: %s %s\n", $date, $level, $message, json_encode($params));

    // FILE_APPEND => écrire à la suite du fichier
    file_put_contents($path, $message, FILE_APPEND);

    return $message;
}

/*
$message: contient l'information que vous souhaitez enregistrer dans le journal (log). notice, a pour but de faciliter la création de messages de 
niveau de gravité "notice" dans un système de journalisation (logging). $params = []: Avec une valeur par defaut vide, contient l'information que 
vous souhaitez enregistrer dans le journal (log).
*/
function notice($message, $params = []): void 
{                                            
    writelog(NOTICE, $message, $params);
}

function error($message, $params = []): void
{
    writelog(ERROR, $message, $params);
}

function emergency($message, $params = []):void
{
    $message = writelog(EMERGENCY, $message, $params);

    // envoie une notification (mail, sms, message sur plateforme de discution (discord) )
    mail("dev.technologie2018@gmail.com", "Erreur Critique", $message);
}
