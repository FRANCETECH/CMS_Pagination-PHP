<?php
session_start();

require_once '../helper/response.php'; // J'importe le fichier pour utiliser la fonction redirect()

session_destroy();

redirect('/bibliotheque/index.php');
