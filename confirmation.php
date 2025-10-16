<?php
include 'includes/db.php';
$id = $_GET['id'];
$conn->query("UPDATE reservations SET paye=1 WHERE id=$id");
header("Location: admin/dashboard.php");
exit();
?>