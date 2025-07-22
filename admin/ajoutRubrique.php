<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom_rubrique'])) {
    $nom = $_POST['nom_rubrique'];

    $query_verif = "SELECT * FROM rubriques WHERE nom=?";
    $stmt = mysqli_prepare($conn, $query_verif);
    mysqli_stmt_bind_param($stmt, "s", $nom);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) != 0) {
        $msg_rub_error = "Rubrique $nom existe deja";
    } else {
        $query = "INSERT INTO rubriques (nom) VALUES (?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $nom);
        mysqli_stmt_execute($stmt);
        $msg_rub_succes = "Rubrique ajoutee avec succes";
    }
}

?>