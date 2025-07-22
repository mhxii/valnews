<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['titre'])) {
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $categorie = (int)$_POST['categorie'];

    $query = "INSERT INTO article (titre, contenu, categorie) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $titre, $contenu, $categorie);
    mysqli_stmt_execute($stmt);
    $message = "Article ajoute avec succes";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom_categorie'])) {
    $nom = $_POST['nom_categorie'];
    $query = "INSERT INTO categorie (libelle) VALUES (?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $nom);
    mysqli_stmt_execute($stmt);
    $msg_cat = "Categorie ajoutee avec succes";
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
    <a href="liste_articles.php" class="btn btn-primary">LISTE DES ARTICLES</a>
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
            <label class="form-label">Categorie</label>
            <select name="categorie" class="form-select" required>
                <?php
                $res = mysqli_query($conn, "SELECT * FROM Categorie");
                while ($cat = mysqli_fetch_assoc($res)) {
                    echo "<option value='{$cat['id']}'>{$cat['libelle']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Publier</button>
    </form>

    <hr class="my-5">

    <h2>Ajouter une categorie</h2>
    <?php if (isset($msg_cat)) echo "<div class='alert alert-success'>$msg_cat</div>"; ?>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nom de la categorie</label>
            <input type="text" class="form-control" name="nom_categorie" required>
        </div>
        <button type="submit" class="btn btn-secondary">Ajouter categorie</button>
    </form>
</div>
</body>
</html>
