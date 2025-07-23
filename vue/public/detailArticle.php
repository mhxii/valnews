<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['titre']) ?> - ValNews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #EFEBE9; }
        .article-container { background-color: white; border-radius: 8px; padding: 2rem; }
        .article-title { color: #5D4037; }
        .back-btn { background-color: #5D4037; color: white; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <a href="index.php" class="btn back-btn mb-4">Retour aux actualites</a>
                
                <div class="article-container">
                    <span class="badge mb-3" style="background-color: #8D6E63; color: white;">
                        <?= htmlspecialchars($article['libelle'] ?? 'General') ?>
                    </span>
                    <h1 class="article-title mb-3"><?= htmlspecialchars($article['titre']) ?></h1>
                    <p class="text-muted mb-4">
                        Publie le <?= date('d/m/Y à H:i', strtotime($article['dateCreation'])) ?>
                    </p>
                    <div class="article-content">
                        <?= nl2br(htmlspecialchars($article['contenu'])) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>