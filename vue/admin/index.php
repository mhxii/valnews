<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="index.php?controller=article&action=admin" class="btn btn-primary">LISTE DES ARTICLES</a>
    <h2>Ajouter un article</h2>
    <form method="post" action="index.php?controller=article&action=ajouter">
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
                <?php while ($cat = mysqli_fetch_assoc($categories)): ?>
                    <option value="<?= $cat['id'] ?>"><?= $cat['libelle'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Publier</button>
    </form>

    <hr class="my-5">

    <h2>Ajouter une categorie</h2>
    <form method="post" action="index.php?controller=categorie&action=ajouter">
        <div class="mb-3">
            <label class="form-label">Nom de la categorie</label>
            <input type="text" class="form-control" name="nom_categorie" required>
        </div>
        <button type="submit" class="btn btn-secondary">Ajouter categorie</button>
    </form>
</div>
</body>
</html>