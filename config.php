<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "val_news";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connexion echouee: " . mysqli_connect_error());
}
?>
