<?php include 'templates/header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de billet</title>
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
            background: url('arimage.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--dark);
        }
        
        .ticket-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            overflow: hidden;
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.1);
            backdrop-filter: none; 
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
            background: rgba(255, 255, 255, 0.95);
            clip-path: polygon(0 0, 100% 0, 95% 100%, 5% 100%);
        }
        
        .ticket-body {
            padding: 25px;
        }
        
        .form-group {
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
        
        .form-content {
            flex-grow: 1;
        }
        
        label {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 3px;
            display: block;
        }
        
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            margin-top: 5px;
            background-color: white;
        }
        
        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%230056b3'%3e%3cpath d='M7 10l5 5 5-5z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 15px;
        }
        
        .action-buttons {
            margin-top: 30px;
        }
        
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 86, 179, 0.3);
        }
        
        .btn-submit i {
            margin-right: 10px;
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
            <h2><i class="fas fa-ticket-alt" style="margin-right: 10px;"></i>Réservation de billet</h2>
        </div>
        
        <div class="metro-line">
            <span class="metro-orange"></span>
            <span class="metro-white"></span>
            <span class="metro-green"></span>
        </div>
        
        <div class="ticket-body">
            <form action="process_form.php" method="POST">
                <div class="form-group">
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="form-content">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="icon">
                        <i class="fas fa-user-tag"></i>
                    </div>
                    <div class="form-content">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="form-content">
                        <label for="telephone">Téléphone</label>
                        <input type="text" name="telephone" id="telephone" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <div class="form-content">
                        <label for="trajet">Trajet</label>
                        <select name="trajet" id="trajet" required>
                            <option value="">Choisissez un trajet</option>
                            <option value="Abobo - Adjamé">Abobo - Adjamé</option>
                            <option value="Yopougon - Koumassi">Yopougon - Koumassi</option>
                            <option value="Cocody - Plateau">Cocody - Plateau</option>
                            <option value="Marcory - Treichville">Marcory - Treichville</option>
                            <option value="Port-Bouët - Plateau">Port-Bouët - Plateau</option>
                        </select>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-check-circle"></i> Valider la réservation
                    </button>
                </div>
            </form>
        </div>
        
        <div class="ticket-footer">
            Réservation sécurisée • Merci de votre confiance
        </div>
    </div>
</body>
</html>
<?php include 'templates/footer.php'; ?>