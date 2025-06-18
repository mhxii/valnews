<?php
include("../../config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $mdp = $_POST['mdp'];

    $query = "SELECT * FROM admins WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && ($mdp==$admin['mdp'])) {
        $_SESSION['admin'] = $admin['username'];
        header("Location: ../");
    } else {
        $erreur = "Identifiants invalides";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - ValNews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Connexion Admin</h2>
    <?php if (isset($erreur)) echo "<div class='alert alert-danger'>$erreur</div>"; ?>
    <form method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Nom utilisateur</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="mdp" required>
        </div>
        <button type="submit" class="btn btn-primary">Connexion</button>
    </form>
</div>
</body>
</html>
