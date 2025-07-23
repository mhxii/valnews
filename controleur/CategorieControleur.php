<?php
require_once __DIR__ . '/../modele/CategorieModele.php';

class CategorieControleur {
    private $categorieModel;

    public function __construct() {
        global $conn;
        $this->categorieModel = new Categorie($conn);
    }

    public function ajouter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $libelle = $_POST['nom_categorie'];
            $this->categorieModel->ajouter($libelle);
            header('Location: index.php?controller=article&action=ajouter');
        }
    }
}
?>