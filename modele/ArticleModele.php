<?php
require_once __DIR__ . '/config.php';

class Article {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAll() {
        $query = "SELECT a.id,a.titre, a.contenu, a.dateCreation, c.libelle AS libelle
              FROM Article a
              LEFT JOIN Categorie c ON a.categorie = c.id
              ORDER BY a.dateCreation DESC";
        return mysqli_query($this->conn, $query);
    }

    public function getByCategorie($id_categorie) {
        $id_categorie = intval($id_categorie);
        $query = "SELECT a.*, c.libelle 
                FROM article a 
                JOIN categorie c ON a.categorie = c.id 
                WHERE a.categorie = $id_categorie
                ORDER BY a.dateCreation DESC";
        return mysqli_query($this->conn, $query);
    }

    public function getById($id) {
        $id = intval($id);
        $query = "SELECT * FROM article WHERE id=$id";
        return mysqli_query($this->conn, $query);
    }

    public function ajouter($titre, $contenu, $categorie) {
    $titre = mysqli_real_escape_string($this->conn, $titre);
    $contenu = mysqli_real_escape_string($this->conn, $contenu);
    $categorie = intval($categorie);
    $query = "INSERT INTO article(titre, contenu, categorie) VALUES ('$titre', '$contenu', $categorie)";
    return mysqli_query($this->conn, $query);
    }

    public function modifier($id, $titre, $contenu, $categorie) {
        $id = intval($id);
        $titre = mysqli_real_escape_string($this->conn, $titre);
        $contenu = mysqli_real_escape_string($this->conn, $contenu);
        $categorie = intval($categorie);
        $query = "UPDATE article SET titre='$titre', contenu='$contenu', categorie=$categorie WHERE id=$id";
        return mysqli_query($this->conn, $query);
    }

    public function supprimer($id) {
        $id = intval($id);
        $query = "DELETE FROM article WHERE id=$id";
        return mysqli_query($this->conn, $query);
    }
}
?>