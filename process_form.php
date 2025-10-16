<?php
include 'includes/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $trajet = $_POST['trajet'];
    
    $stmt = $conn->prepare("INSERT INTO clients (nom, prenom, telephone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nom, $prenom, $telephone);
    $stmt->execute();
    $client_id = $stmt->insert_id;
    
    $heure_depart = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $stmt = $conn->prepare("INSERT INTO reservations (client_id, trajet, heure_depart) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $client_id, $trajet, $heure_depart);
    $stmt->execute();
    $reservation_id = $stmt->insert_id;

    header("Location: trajet_info.php?reservation_id=" . $reservation_id);
    exit();
}
?>