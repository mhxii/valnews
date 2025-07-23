<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "mglsi_news";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connexion échouée: " . mysqli_connect_error());
}
?>