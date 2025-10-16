<?php
include 'includes/db.php';
$id = $_GET['reservation_id'];
$res = $conn->query("SELECT * FROM reservations WHERE id = $id");
$row = $res->fetch_assoc();

$trajet = $row['trajet'];
$places = 50 - $conn->query("SELECT COUNT(*) as total FROM reservations WHERE trajet='$trajet' AND paye=1")->fetch_assoc()['total'];


date_default_timezone_set('Africa/Abidjan');


$heure_actuelle = date('H:i');

$date_actuelle = date('d F Y');

$mois_fr = [
    'January' => 'Janvier', 'February' => 'Février', 'March' => 'Mars',
    'April' => 'Avril', 'May' => 'Mai', 'June' => 'Juin',
    'July' => 'Juillet', 'August' => 'Août', 'September' => 'Septembre',
    'October' => 'Octobre', 'November' => 'Novembre', 'December' => 'Décembre'
];
$date_actuelle = str_replace(array_keys($mois_fr), array_values($mois_fr), $date_actuelle);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de réservation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #0056b3;
            --secondary: #00a1e0;
            --accent: #ff5722;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #28a745;
            --orange: #FFA500;
            --white: #FFFFFF;
            --green: #28a745;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--dark);
        }
        
        .ticket-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            overflow: hidden;
            position: relative;
        }
        
        .ticket-header {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }
        
        .ticket-header h2 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .ticket-header::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 20px;
            background: white;
            clip-path: polygon(0 0, 100% 0, 95% 100%, 5% 100%);
        }
        
        .ticket-body {
            padding: 25px;
        }
        
        .detail-row {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #ddd;
        }
        
        .icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(to bottom right, var(--secondary), var(--primary));
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        
        .detail-content {
            flex-grow: 1;
        }
        
        .detail-label {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 3px;
        }
        
        .detail-value {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .places-remaining {
            font-weight: bold;
            color: <?= $places > 10 ? 'var(--success)' : 'var(--accent)' ?>;
        }
        
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-wave {
            background-color: #0056b3;
            color: white;
        }
        
        .btn-wave:hover {
            background-color: #003d82;
            transform: translateY(-2px);
        }
        
        .btn-confirm {
            background-color: var(--success);
            color: white;
        }
        
        .btn-confirm:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }
        
        .btn i {
            margin-right: 10px;
        }
        
        .ticket-footer {
            text-align: center;
            padding: 15px;
            font-size: 0.8rem;
            color: #666;
            background-color: #f8f9fa;
        }
        
        .metro-line {
            height: 6px;
            width: 300px;
            margin: 20px auto;
            display: flex;
            border-radius: 3px;
            overflow: hidden;
        }
        
        .metro-line span {
            flex: 1;
        }
        
        .metro-orange {
            background-color: var(--orange);
        }
        
        .metro-white {
            background-color: var(--white);
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }
        
        .metro-green {
            background-color: var(--green);
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="ticket-header">
            <h2>Détails du trajet</h2>
        </div>
        
        <div class="metro-line">
            <span class="metro-orange"></span>
            <span class="metro-white"></span>
            <span class="metro-green"></span>
        </div>
        
        <div class="ticket-body">
            <div class="detail-row">
                <div class="icon">
                    <i class="fas fa-route"></i>
                </div>
                <div class="detail-content">
                    <div class="detail-label">Trajet</div>
                    <div class="detail-value"><?= $trajet ?></div>
                </div>
            </div>
            
            <div class="detail-row">
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="detail-content">
                    <div class="detail-label">Heure actuelle (Abidjan)</div>
                    <div class="detail-value"><?= $heure_actuelle ?></div>
                </div>
            </div>
            
            <div class="detail-row">
                <div class="icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="detail-content">
                    <div class="detail-label">Date</div>
                    <div class="detail-value"><?= $date_actuelle ?></div>
                </div>
            </div>
            
            <div class="detail-row">
                <div class="icon">
                    <i class="fas fa-chair"></i>
                </div>
                <div class="detail-content">
                    <div class="detail-label">Places restantes</div>
                    <div class="detail-value"><span class="places-remaining"><?= $places ?></span> / 50</div>
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="https://pay.wave.com" target="_blank" class="btn btn-wave">
                    <i class="fas fa-money-bill-wave"></i> Payer avec Wave
                </a>
                
                <form action="code_display.php" method="GET" style="width: 100%;">
                    <input type="hidden" name="reservation_id" value="<?= $id ?>">
                    <button type="submit" class="btn btn-confirm">
                        <i class="fas fa-check-circle"></i> J'ai déjà payé
                    </button>
                </form>
            </div>
        </div>
        <div class="ticket-footer">
            Votre réservation #<?= $id ?> • Merci de voyager avec nous
        </div>
    </div>
</body>
</html>