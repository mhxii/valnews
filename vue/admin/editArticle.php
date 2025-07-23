<!DOCTYPE html>
<html>
<head>
    <title>Modifier Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Modifier Article</h2>
        </div>
        <div class="card-body">
            <a href="index.php?controller=article&action=admin" class="btn btn-secondary mb-3">Retour a la liste</a>

            <?php if (isset($message)): ?>
                <div class="alert alert-success"><?= $message ?></div>
            <?php endif; ?>

            <form method="post" action="index.php?controller=article&action=modifier&id=<?= $article['id'] ?>">
                <div class="mb-3">
                    <label class="form-label">Titre *</label>
                    <input type="text" name="titre" class="form-control" 
                           value="<?= htmlspecialchars($article['titre'] ?? '') ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Contenu *</label>
                    <textarea name="contenu" class="form-control" rows="8" required><?= 
                        htmlspecialchars($article['contenu'] ?? '') 
                    ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Categorie *</label>
                    <select name="categorie" class="form-select" required>
                        <?php 
                        if (is_object($categories)) {
                            mysqli_data_seek($categories, 0);
                        }
                        
                        while ($cat = is_object($categories) ? mysqli_fetch_assoc($categories) : $categories[array_key_first($categories)]): ?>
                            <option value="<?= $cat['id'] ?>"
                                <?= ($cat['id'] == ($article['categorie'] ?? 0)) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['libelle']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>