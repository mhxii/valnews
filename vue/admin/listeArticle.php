<!DOCTYPE html>
<html>
<head>
    <title>Liste des articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
    <h2 class="mb-4">Liste des articles</h2>
    <a href="index.php?controller=article&action=ajouter" class="btn btn-primary mb-3">Ajouter un article</a>
    <a href="index.php" class="btn btn-secondary mb-3">Retour à l'accueil</a>

    <?php if (isset($message)): ?>
        <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Date</th>
                <th>Categorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($articles && mysqli_num_rows($articles) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($articles)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['titre'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['dateCreation'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['libelle'] ?? 'Non categorise') ?></td>
                        <td>
                            <a href="index.php?controller=article&action=modifier&id=<?= $row['id'] ?>" 
                               class="btn btn-warning btn-sm">Modifier</a>
                            <a href="index.php?controller=article&action=supprimer&id=<?= $row['id'] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                               Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Aucun article trouve</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>