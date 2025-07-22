<?php
$conn = mysqli_connect("localhost", "root", "", "mglsi_news");
if (!$conn) die("Erreur de connexion");

$result = mysqli_query($conn, "SELECT article.id, article.titre, article.dateCreation, categorie.libelle FROM article JOIN categorie ON article.categorie = categorie.id");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Liste des articles</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container">
  <h2 class="mb-4">Liste des articles</h2>
  <a href="index.php" class="btn btn-primary mb-3">RETOUR</a>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Titre</th>
        <th>Date</th>
        <th>Categorie</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['titre']; ?></td>
          <td><?php echo $row['dateCreation']; ?></td>
          <td><?php echo $row['libelle']; ?></td>
          <td>
            <a href="edit_article.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
            <a href="delete_article.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet article ?')">Supprimer</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>
