<?php
require_once __DIR__ . '/../modele/ArticleModele.php';
require_once __DIR__ . '/../modele/CategorieModele.php';

class ArticleControleur {
    private $articleModel;
    private $categorieModel;

    public function __construct() {
        global $conn;
        $this->articleModel = new Article($conn);
        $this->categorieModel = new Categorie($conn);
    }

    public function parCategorie() {
    $id_categorie = intval($_GET['categorie']);
    $articles = $this->articleModel->getByCategorie($id_categorie);
    $categories = $this->categorieModel->getAll();
    $currentCategorie = $this->categorieModel->getById($id_categorie);
    
    require_once __DIR__ . '/../vue/public/index.php';
    }

    public function accueil() {
        $articles = $this->articleModel->getAll();
        $categories = $this->categorieModel->getAll();
        require_once __DIR__ . '/../vue/public/index.php';
    }

    public function admin() {
        $articles = $this->articleModel->getAll();
        require_once __DIR__ . '/../vue/admin/listeArticle.php';
    }

    public function ajouter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'];
            $contenu = $_POST['contenu'];
            $categorie = $_POST['categorie'];
            $this->articleModel->ajouter($titre, $contenu, $categorie);
            header('Location: index.php?controller=article&action=admin');
        } else {
            $categories = $this->categorieModel->getAll();
            require_once __DIR__ . '/../vue/admin/index.php';
        }
    }

    public function modifier() {
        $id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'];
            $contenu = $_POST['contenu'];
            $categorie = $_POST['categorie'];
            $this->articleModel->modifier($id, $titre, $contenu, $categorie);
            header('Location: index.php?controller=article&action=admin');
        } else {
            $article = $this->articleModel->getById($id);
            $categories = $this->categorieModel->getAll();
            require_once __DIR__ . '/../vue/admin/editArticle.php';
        }
    }

    public function supprimer() {
        $id = $_GET['id'];
        $this->articleModel->supprimer($id);
        header('Location: index.php?controller=article&action=admin');
    }
}
?>