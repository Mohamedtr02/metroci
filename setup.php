<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = '#####';

$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Création de la base
$conn->query("CREATE DATABASE IF NOT EXISTS $db");
$conn->select_db($db);

// Création des tables
$conn->query("CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    telephone VARCHAR(20)
)");

$conn->query("CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    trajet VARCHAR(100),
    heure_depart DATETIME,
    paye BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (client_id) REFERENCES clients(id)
)");

$conn->query("CREATE TABLE IF NOT EXISTS codes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT,
    code VARCHAR(10),
    date_generation DATETIME,
    utilise BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (reservation_id) REFERENCES reservations(id)
)");

echo "Installation terminée. Base de données et tables créées.";
?>
