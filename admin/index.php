<?php
include("../config.php");
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ./login");
    exit();
}

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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom_rubrique'])) {
    $nom = $_POST['nom_rubrique'];
    $query = "INSERT INTO rubriques (nom) VALUES (?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $nom);
    mysqli_stmt_execute($stmt);
    $msg_rub = "Rubrique ajoutee avec succes";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Ajouter un article</h2>
    <?php if (isset($message)) echo "<div class='alert alert-success'>$message</div>"; ?>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" class="form-control" name="titre" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contenu</label>
            <textarea class="form-control" name="contenu" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Rubrique</label>
            <select name="rubrique" class="form-select" required>
                <?php
                $res = mysqli_query($conn, "SELECT * FROM rubriques");
                while ($rub = mysqli_fetch_assoc($res)) {
                    echo "<option value='{$rub['id']}'>{$rub['nom']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Publier</button>
    </form>

    <hr class="my-5">

    <h2>Ajouter une rubrique</h2>
    <?php if (isset($msg_rub)) echo "<div class='alert alert-success'>$msg_rub</div>"; ?>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nom de la rubrique</label>
            <input type="text" class="form-control" name="nom_rubrique" required>
        </div>
        <button type="submit" class="btn btn-secondary">Ajouter rubrique</button>
    </form>
</div>
</body>
</html>
