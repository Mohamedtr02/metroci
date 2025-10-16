<?php
include '../includes/db.php';
if ($_POST['pass'] != "admin123") die("Mot de passe incorrect.");

$res = $conn->query("SELECT r.id, c.nom, c.prenom, r.trajet FROM reservations r JOIN clients c ON r.client_id = c.id WHERE r.paye = 0");

while ($row = $res->fetch_assoc()) {
    echo "<p>" . $row['nom'] . " " . $row['prenom'] . " - " . $row['trajet'];
    echo " <a href='../confirmation.php?id=" . $row['id'] . "'>Confirmer paiement</a></p>";
}
?>