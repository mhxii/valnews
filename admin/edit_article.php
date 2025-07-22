<?php
require_once('../config.php');

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM article WHERE id=$id");
$article = mysqli_fetch_assoc($result);

$categories = mysqli_query($conn, "SELECT * FROM Categorie");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = mysqli_real_escape_string($conn, $_POST['titre']);
    $contenu = mysqli_real_escape_string($conn, $_POST['contenu']);
    $categorie = intval($_POST['categorie']);

    $sql = "UPDATE article SET titre='$titre', contenu='$contenu', categorie=$categorie WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Article</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2>Modifier Article</h2>
  <form method="post">
    <div class="mb-3">
      <label>Titre</label>
      <input type="text" name="titre" class="form-control" value="<?php echo $article['titre']; ?>">
    </div>
    <div class="mb-3">
      <label>Contenu</label>
      <textarea name="contenu" class="form-control"><?php echo $article['contenu']; ?></textarea>
    </div>
    <div class="mb-3">
      <label>Categorie</label>
      <select name="categorie" class="form-control">
        <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
          <option value="<?php echo $cat['id']; ?>" <?php if ($cat['id'] == $article['categorie']) echo 'selected'; ?>>
            <?php echo $cat['libelle']; ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
  </form>
</body>
</html>
