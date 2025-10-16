

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    telephone VARCHAR(20)
);

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    trajet VARCHAR(100),
    heure_depart DATETIME,
    paye BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (client_id) REFERENCES clients(id)
);

CREATE TABLE codes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT,
    code VARCHAR(10),
    date_generation DATETIME,
    utilise BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (reservation_id) REFERENCES reservations(id)
);
