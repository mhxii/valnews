<?php
require_once __DIR__ . '/config.php';
class Categorie {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        return mysqli_query($this->conn, "SELECT * FROM Categorie");
    }

    public function ajouter($libelle) {
        $query = "INSERT INTO Categorie (libelle) VALUES (?)";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $libelle);
        return mysqli_stmt_execute($stmt);
    }

    public function getById($id) {
        $id = intval($id);
        $query = "SELECT * FROM Categorie WHERE id = $id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }
}