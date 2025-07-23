<?php
require_once 'modele/config.php';
require_once 'controleur/ArticleControleur.php';
require_once 'controleur/CategorieControleur.php';

$action = $_GET['action'] ?? 'accueil';
$controller = $_GET['controller'] ?? 'article';

switch ($controller) {
    case 'article':
        $controller = new ArticleControleur();
        break;
    case 'categorie':
        $controller = new CategorieControleur();
        break;
    default:
        $controller = new ArticleControleur();
}

switch ($action) {
    case 'voir':
        $controller->voir();
        break;
    case 'ajouter':
        $controller->ajouter();
        break;
    case 'modifier':
        $controller->modifier();
        break;
    case 'supprimer':
        $controller->supprimer();
        break;
    case 'admin':
        $controller->admin();
        break;
    case 'categorie':
        $controller->parCategorie();
        break;
    default:
        $controller->accueil();
}
?>