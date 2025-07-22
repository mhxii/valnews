<?php
require_once('../config.php');
$id = intval($_GET['id']);
mysqli_query($conn, "DELETE FROM article WHERE id=$id");
header("Location: index.php");
exit();
