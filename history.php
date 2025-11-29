<?php
require_once 'Pokemon.php';
require_once 'Victreebel.php';

session_start();

if (!isset($_SESSION['pokemon']) || !isset($_SESSION['training_history'])) {
    header('Location: index.php');
    exit();
}

$trainingHistory = $_SESSION['training_history'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéCare - Riwayat Latihan</title>
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
        
        .content {
            padding: 30px;
        }
        
        .history-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .training-list {
            display: grid;
            gap: 15px;
        }
        
        .training-item {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
        }
        
        .training-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .training-type {
            font-weight: bold;
            color: #333;
            font-size: 16px;
        }
        
        .training-intensity {
            background: #4CAF50;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .training-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .stat-group {
            text-align: center;
        }
        
        .stat-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .stat-value {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
        }
        
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #666;
        }
        
        .empty-state h3 {
            margin-bottom: 10px;
            color: #999;
            font-size: 18px;
        }
        
        .empty-state p {
            font-size: 14px;
        }
        
        .reset-section {
            text-align: center;
            margin: 25px 0;
        }
        
        .btn-danger {
            background: #f44336;
            color: white;
            border: 2px solid #f44336;
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-danger:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        
        .navigation {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }
        
        .nav-btn {
            flex: 1;
            padding: 12px;
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
        
        .btn-secondary {
            background: #2196F3;
            color: white;
            border-color: #2196F3;
        }
        
        .btn-primary {
            background: #4CAF50;
            color: white;
            border-color: #4CAF50;
        }
        
        .nav-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        
        .divider {
            height: 1px;
            background: #e0e0e0;
            margin: 25px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PokéCare - Riwayat Latihan</h1>
            <p>Riwayat Latihan</p>
        </div>
        
        <div class="content">
            <div class="history-section">
                <div class="section-title">Riwayat Latihan</div>
                
                <?php if (empty($trainingHistory)): ?>
                    <div class="empty-state">
                        <h3>Belum ada riwayat latihan</h3>
                        <p>Lakukan latihan pertama Anda di halaman Latihan Pokémon</p>
                    </div>
                <?php else: ?>
                    <div class="training-list">
                        <?php foreach (array_reverse($trainingHistory) as $index => $training): ?>
                            <div class="training-item">
                                <div class="training-header">
                                    <span class="training-type"><?php echo $training['training_type']; ?></span>
                                    <span class="training-intensity">Intensitas <?php echo $training['intensity']; ?></span>
                                </div>
                                
                                <div class="training-stats">
                                    <div class="stat-group">
                                        <div class="stat-label">LEVEL</div>
                                        <div class="stat-value">
                                            <?php echo floor($training['old_level']); ?> → <?php echo floor($training['new_level']); ?>
                                            <div style="color: #4CAF50; font-size: 12px; margin-top: 5px;">
                                                +<?php echo floor($training['new_level'] - $training['old_level']); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stat-group">
                                        <div class="stat-label">HP</div>
                                        <div class="stat-value">
                                            <?php echo floor($training['old_hp']); ?> → <?php echo floor($training['new_hp']); ?>
                                            <div style="color: #4CAF50; font-size: 12px; margin-top: 5px;">
                                                +<?php echo floor($training['new_hp'] - $training['old_hp']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="reset-section">
                        <a href="reset_history.php" class="btn-danger" onclick="return confirm('Yakin ingin mereset riwayat latihan?')">Reset Riwayat Latihan</a>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="divider"></div>
            
            <div class="navigation">
                <a href="index.php" class="nav-btn btn-secondary">Kembali ke Beranda</a>
                <a href="training.php" class="nav-btn btn-primary">Mulai Latihan Baru</a>
            </div>
        </div>
    </div>
</body>
</html>