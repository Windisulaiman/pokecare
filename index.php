<?php
require_once 'Pokemon.php';
require_once 'Victreebel.php';

session_start();

if (!isset($_SESSION['pokemon'])) {
    $_SESSION['pokemon'] = new Victreebel();
    $_SESSION['training_history'] = [];
}

$pokemon = $_SESSION['pokemon'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéCare - Research & Training Center</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background: #f0f0f0;
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .header {
            background: white;
            color: #333;
            padding: 25px 30px;
            text-align: left;
            border-bottom: 2px solid #e0e0e0;
        }
        
        .header h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }
        
        .header p {
            font-size: 16px;
            color: #666;
            font-weight: normal;
        }
        
        .content {
            padding: 30px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        
        .left-column {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }
        
        .right-column {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }
        
        .info-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
        }
        
        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .info-grid {
            display: grid;
            gap: 12px;
        }
        
        .info-row {
            display: grid;
            grid-template-columns: 120px 1fr;
            align-items: center;
            font-size: 14px;
            padding: 5px 0;
        }
        
        .info-label {
            font-weight: bold;
            color: #666;
        }
        
        .info-value {
            color: #666;
            background: #f8f9fa;
            padding: 6px 10px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
        }
        
        .special-move-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
        }
        
        .special-move-text {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
            font-size: 14px;
            line-height: 1.4;
        }
        
        .navigation-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }
        
        .nav-buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 15px;
        }
        
        .nav-btn {
            padding: 12px 20px;
            border: 2px solid;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            text-decoration: none;
            display: block;
        }
        
        .btn-primary {
            background: #4CAF50;
            color: white;
            border-color: #4CAF50;
        }
        
        .btn-secondary {
            background: #2196F3;
            color: white;
            border-color: #2196F3;
        }
        
        .nav-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        
        .pokemon-display {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 25px;
            text-align: center;
        }
        
        .pokemon-icon {
            font-size: 80px;
            margin-bottom: 15px;
            color: #4CAF50;
        }
        
        .pokemon-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
        .pokemon-type {
            font-size: 16px;
            color: #666;
            background: #f8f9fa;
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
            border: 1px solid #e0e0e0;
        }
        
        .stats-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .stat-item {
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 12px;
            color: #666;
            font-weight: bold;
        }
        
        .divider {
            height: 1px;
            background: #e0e0e0;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PokéCare - Research & Training Center</h1>
            <p>Informasi Dasar Pokémon</p>
        </div>
        
        <div class="content">
            <div class="left-column">
                <div class="pokemon-display">
                    <div class="pokemon-image">
                        <img src="images/pict.png" alt="Victreebel" style="width: 180px; height: 180px; object-fit: contain;"></div>
                    <div class="pokemon-name">Victreebel</div>
                    <div class="pokemon-type">Grass/Poison</div>
                </div>
                
                <div class="stats-card">
                    <div class="card-title">Statistik</div>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-value"><?php echo floor($pokemon->getLevel()); ?></div>
                            <div class="stat-label">LEVEL</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value"><?php echo floor($pokemon->getHp()); ?></div>
                            <div class="stat-label">HP</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="right-column">
                <div class="info-card">
                    <div class="card-title">Informasi Dasar</div>
                    <div class="info-grid">
                        <div class="info-row">
                            <span class="info-label">Name:</span>
                            <span class="info-value"><?php echo $pokemon->getName(); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tipe:</span>
                            <span class="info-value"><?php echo $pokemon->getType(); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Level Awal:</span>
                            <span class="info-value">5</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">HP Awal:</span>
                            <span class="info-value">50</span>
                        </div>
                    </div>
                </div>
                
                <div class="special-move-card">
                    <div class="card-title">Jurus Special</div>
                    <div class="special-move-text">
                        <?php echo $pokemon->getSpecialMove(); ?>
                    </div>
                </div>
                
                <div class="navigation-card">
                    <div class="card-title">Aksi</div>
                    <div class="nav-buttons">
                        <a href="training.php" class="nav-btn btn-primary">Mulai Latihan</a>
                        <a href="history.php" class="nav-btn btn-secondary">Riwayat Latihan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>