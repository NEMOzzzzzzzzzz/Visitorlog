<?php
include 'config.php';
$id = $_GET['id'];
$conn->query("DELETE FROM visitors WHERE id=$id");
header("Location: index.php");
?>
