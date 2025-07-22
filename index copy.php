<?php include("config.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Accueil - ValNews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">ValNews</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navRubriques">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navRubriques">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= !isset($_GET['rubrique']) ? 'active' : '' ?>" href="index.php">Toutes les rubriques</a>
                </li>
                <?php
                $rubriques = mysqli_query($conn, "SELECT * FROM rubriques");
                while ($rub = mysqli_fetch_assoc($rubriques)) {
                    $active = (isset($_GET['rubrique']) && $_GET['rubrique'] == $rub['id']) ? "active" : "";
                    echo "<li class='nav-item'>
                            <a class='nav-link $active' href='?rubrique={$rub['id']}'>{$rub['nom']}</a>
                          </li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <?php
    if (isset($_GET['rubrique'])) {
        $id_rubrique = (int)$_GET['rubrique'];
        $rub_query = mysqli_query($conn, "SELECT nom FROM rubriques WHERE id = $id_rubrique");
        $rub_fetch = mysqli_fetch_assoc($rub_query);
        echo "<h2 class='mb-4'>Rubrique : {$rub_fetch['nom']}</h2>";
        $rub_selected = "WHERE a.id_rubrique = $id_rubrique";
    } else {
        echo "<h2 class='mb-4'>Toutes les actualites</h2>";
        $rub_selected = "";
    }

    $query = "SELECT a.titre, a.contenu, a.date_publication, r.nom AS rubrique
              FROM articles a
              LEFT JOIN rubriques r ON a.id_rubrique = r.id
              $rub_selected
              ORDER BY a.date_publication DESC";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 0) {
        echo "<div class='alert alert-info'>Aucune actualite disponible pour cette rubrique.</div>";
    }

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card mb-3'>
                <div class='card-body'>
                    <h5 class='card-title'>{$row['titre']}</h5>
                    <h6 class='card-subtitle mb-2 text-muted'>Rubrique: {$row['rubrique']}</h6>
                    <p class='card-text'>{$row['contenu']}</p>
                    <small class='text-muted'>Publie le: {$row['date_publication']}</small>
                </div>
              </div>";
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
