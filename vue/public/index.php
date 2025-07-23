<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ValNews - Actualites</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vue/public/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">ValNews</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= !isset($currentCategorie) ? 'active' : '' ?>" 
                           href="index.php">Toutes les actualites</a>
                    </li>
                    <?php 
                    mysqli_data_seek($categories, 0);
                    while ($cat = mysqli_fetch_assoc($categories)): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= isset($currentCategorie) && $currentCategorie['id'] == $cat['id'] ? 'active' : '' ?>" 
                               href="index.php?controller=article&action=categorie&categorie=<?= $cat['id'] ?>">
                               <?= htmlspecialchars($cat['libelle']) ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <?php if (isset($currentCategorie)): ?>
                    <h2 class="display-5 fw-bold"><?= htmlspecialchars($currentCategorie['libelle']) ?></h2>
                    <p class="text-muted">Articles de la categorie</p>
                <?php else: ?>
                    <h2 class="display-5 fw-bold">Dernieres actualites</h2>
                    <p class="text-muted">Tous nos articles recents</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <?php if ($articles && mysqli_num_rows($articles) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($articles)): ?>
                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card news-card h-100">
                            <div class="card-body">
                                <span class="badge category-badge mb-3"><?= htmlspecialchars($row['libelle'] ?? 'General') ?></span>
                                <h3 class="card-title h5 fw-bold"><?= htmlspecialchars($row['titre']) ?></h3>
                                <p class="card-text text-muted">
                                    <small><?= date('d/m/Y', strtotime($row['dateCreation'])) ?></small>
                                </p>
                                <p class="card-text">
                                    <?= nl2br(htmlspecialchars(mb_strimwidth($row['contenu'], 0, 200, '...'))) ?>
                                </p>
                                <a href="index.php?controller=article&action=voir&id=<?= $row['id'] ?>" class="btn read-more-btn">Lire la suite</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-light text-center py-4" style="background-color: var(--marron-clair);">
                        Aucun article disponible<?= isset($currentCategorie) ? ' pour cette categorie' : '' ?>.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <footer class="py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">© <?= date('Y') ?> ValNewss</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>