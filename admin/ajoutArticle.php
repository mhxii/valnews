<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['titre'])) {
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $rubrique = (int)$_POST['rubrique'];

    $query = "INSERT INTO articles (titre, contenu, id_rubrique) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $titre, $contenu, $rubrique);
    mysqli_stmt_execute($stmt);
    $message = "Article ajoute avec succes";
}
 ?>