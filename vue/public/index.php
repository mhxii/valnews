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
        <div class="collapse navbar-collapse" id="navRubriques">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= !isset($currentCategorie) ? 'active' : '' ?>" 
                       href="index.php">Toutes les categories</a>
                </li>
                <?php 
                mysqli_data_seek($categories, 0);
                while ($cat = mysqli_fetch_assoc($categories)): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= isset($currentCategorie) && $currentCategorie['id'] == $cat['id'] ? 'active' : '' ?>" 
                           href="index.php?controller=article&action=categorie&categorie=<?= $cat['id'] ?>">
                           <?= $cat['libelle'] ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <?php if (isset($currentCategorie)): ?>
        <h2 class='mb-4'>Categorie : <?= $currentCategorie['libelle'] ?></h2>
    <?php else: ?>
        <h2 class='mb-4'>Toutes les actualites</h2>
    <?php endif; ?>

    <?php if (mysqli_num_rows($articles) === 0): ?>
        <div class='alert alert-info'>Aucune actualite disponible<?= isset($currentCategorie) ? ' pour cette categorie' : '' ?>.</div>
    <?php else: ?>
        <?php while ($row = mysqli_fetch_assoc($articles)): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['titre'] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Categorie: <?= $row['libelle'] ?></h6>
                    <p class="card-text"><?= $row['contenu'] ?></p>
                    <small class="text-muted">Publie le: <?= $row['dateCreation'] ?></small>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>