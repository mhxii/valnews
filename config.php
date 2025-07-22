<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "mglsi_news";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connexion echouee: " . mysqli_connect_error());
}
?>
