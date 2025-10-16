<?php
include 'includes/db.php';
$id = $_GET['reservation_id'];
$res = $conn->query("SELECT * FROM reservations WHERE id=$id");
$row = $res->fetch_assoc();

date_default_timezone_set('Africa/Abidjan');
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
    <title>Code d'accès</title>
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
            text-align: center;
        }
        
        .detail-row {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #ddd;
            justify-content: center;
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
        
        .code-display {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary);
            letter-spacing: 3px;
            margin: 20px 0;
            padding: 15px;
            background-color: #f0f7ff;
            border-radius: 8px;
            border: 2px dashed var(--secondary);
        }
        
        .message {
            font-size: 1.1rem;
            margin-bottom: 25px;
            color: var(--dark);
            line-height: 1.6;
        }
        
        .info-text {
            font-size: 0.9rem;
            color: #666;
            margin-top: 10px;
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
        
        .ticket-footer {
            text-align: center;
            padding: 15px;
            font-size: 0.8rem;
            color: #666;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="ticket-header">
            <h2><i class="fas fa-ticket-alt"></i> Code d'accès</h2>
        </div>
        
        <div class="metro-line">
            <span class="metro-orange"></span>
            <span class="metro-white"></span>
            <span class="metro-green"></span>
        </div>
        
        <div class="ticket-body">
            <?php if ($row['paye']): ?>
                <?php
                $res_code = $conn->query("SELECT * FROM codes WHERE reservation_id=$id");
                if ($res_code->num_rows == 0) {
                    $code = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 8);
                    $now = date('Y-m-d H:i:s');
                    $conn->query("INSERT INTO codes (reservation_id, code, date_generation) VALUES ($id, '$code', '$now')");
                    file_put_contents("codes.txt", "$code;$now\n", FILE_APPEND);
                } else {
                    $row_code = $res_code->fetch_assoc();
                    $code = $row_code['code'];
                }
                ?>
                
                <div class="message">
                    Votre réservation #<?= $id ?> a été confirmée avec succès.
                </div>
                
                <div class="detail-row">
                    <div class="icon">
                        <i class="fas fa-key"></i>
                    </div>
                    <div>
                        <div class="detail-label">Code d'accès unique</div>
                        <div class="code-display"><?= $code ?></div>
                    </div>
                </div>
                
                <div class="info-text">
                    <i class="fas fa-info-circle"></i> Présentez ce code à l'entrée pour accéder au métro.
                </div>
                
                <div class="info-text">
                    <i class="fas fa-calendar-day"></i> Date de génération : <?= $date_actuelle ?>
                </div>
                
            <?php else: ?>
                <div class="message" style="color: var(--accent);">
                    <i class="fas fa-exclamation-circle"></i> Paiement non encore confirmé
                </div>
                
                <div class="detail-row">
                    <div class="icon" style="background: linear-gradient(to bottom right, #ff5722, #e53935);">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <div class="detail-label">Statut de la réservation</div>
                        <div style="font-size: 1.2rem;">En attente de paiement</div>
                    </div>
                </div>
                
                <div class="info-text">
                    Veuillez compléter votre paiement ou réessayer plus tard.
                </div>
                
                <a href="https://pay.wave.com" class="btn" style="
                    display: inline-block;
                    margin-top: 20px;
                    padding: 12px 25px;
                    background: linear-gradient(to right, var(--primary), var(--secondary));
                    color: white;
                    border-radius: 8px;
                    text-decoration: none;
                    font-weight: 600;
                ">
                    <i class="fas fa-money-bill-wave"></i> Payer maintenant
                </a>
            <?php endif; ?>
        </div>
        
        <div class="ticket-footer">
            Réservation #<?= $id ?> • Service client : @TraoreMohamed.ci
        </div>
    </div>
</body>
</html>