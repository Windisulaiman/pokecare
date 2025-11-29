<?php
require_once 'Pokemon.php';
require_once 'Victreebel.php';

session_start();

if (!isset($_SESSION['pokemon'])) {
    header('Location: index.php');
    exit();
}

$pokemon = $_SESSION['pokemon'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trainingType = $_POST['training_type'] ?? '';
    $intensity = intval($_POST['intensity'] ?? 0);
    
    if ($intensity > 0 && $intensity <= 10 && in_array($trainingType, ['Attack', 'Defense', 'Speed'])) {
        $oldLevel = $pokemon->getLevel();
        $oldHp = $pokemon->getHp();
        
        $trainingResult = $pokemon->train($trainingType, $intensity);
        
        $_SESSION['training_history'][] = [
            'training_type' => $trainingType,
            'intensity' => $intensity,
            'old_level' => $oldLevel,
            'new_level' => $pokemon->getLevel(),
            'old_hp' => $oldHp,
            'new_hp' => $pokemon->getHp(),
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
        $message = "Latihan berhasil!";
    } else {
        $message = "Intensitas harus antara 1-10 dan pilih jenis latihan yang valid";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéCare - Latihan Pokémon</title>
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
        
        .training-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 25px;
        }
        
        .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }
        
        select, input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
            background: white;
        }
        
        select:focus, input:focus {
            outline: none;
            border-color: #4CAF50;
        }
        
        .btn {
            padding: 12px 25px;
            border: 2px solid #4CAF50;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            background: #4CAF50;
            color: white;
        }
        
        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        
        .result-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 25px;
        }
        
        .result-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .result-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .stat-item {
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
        }
        
        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        
        .special-move-card {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 15px;
            font-size: 14px;
            text-align: center;
        }
        
        .navigation-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
        }
        
        .nav-buttons {
            display: flex;
            gap: 12px;
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
        
        .message {
            padding: 15px;
            margin: 15px 0;
            border-radius: 6px;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            border: 2px solid;
        }
        
        .success {
            background: #f8fff8;
            border-color: #4CAF50;
            color: #4CAF50;
        }
        
        .error {
            background: #fff8f8;
            border-color: #f44336;
            color: #f44336;
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
            <h1>PokéCare - Latihan</h1>
            <p>Latihan Pokémon</p>
        </div>
        
        <div class="content">
            <div class="left-column">
                <div class="training-card">
                    <div class="card-title">Latihan Pokémon</div>
                    
                    <?php if ($message): ?>
                        <div class="message <?php echo strpos($message, 'berhasil') !== false ? 'success' : 'error'; ?>">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <div class="form-group">
                            <label for="training_type">Jenis Latihan:</label>
                            <select name="training_type" id="training_type" required>
                                <option value="">Pilih Jenis Latihan</option>
                                <option value="Attack">Attack</option>
                                <option value="Defense">Defense</option>
                                <option value="Speed">Speed</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="intensity">Intensitas (1-10):</label>
                            <input type="number" name="intensity" id="intensity" min="1" max="10" required placeholder="Masukkan intensitas 1-10">
                        </div>
                        
                        <button type="submit" class="btn">Latih</button>
                    </form>
                </div>
                
                <div class="navigation-card">
                    <div class="nav-buttons">
                        <a href="index.php" class="nav-btn btn-secondary">Kembali ke Beranda</a>
                        <a href="history.php" class="nav-btn btn-primary">Riwayat Latihan</a>
                    </div>
                </div>
            </div>
            
            <div class="right-column">
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $message && strpos($message, 'berhasil') !== false): ?>
                    <div class="result-card">
                        <div class="card-title">Hasil Latihan</div>
                        
                        <div class="result-stats">
                            <div class="stat-item">
                                <div class="stat-value">Level: <?php echo floor($oldLevel); ?> → <?php echo floor($pokemon->getLevel()); ?></div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">HP: <?php echo floor($oldHp); ?> → <?php echo floor($pokemon->getHp()); ?></div>
                            </div>
                        </div>
                        
                        <div class="special-move-card">
                            <strong>Jurus Special:</strong><br>
                            <?php echo $pokemon->getSpecialMove(); ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="training-card">
                        <div class="card-title">Informasi Pokémon</div>
                        <div class="info-grid">
                            <div style="display: grid; grid-template-columns: 100px 1fr; align-items: center; margin-bottom: 15px;">
                                <span style="font-weight: bold;">Name:</span>
                                <span style="background: #f8f9fa; padding: 8px; border-radius: 4px; border: 1px solid #e0e0e0;"><?php echo $pokemon->getName(); ?></span>
                            </div>
                            <div style="display: grid; grid-template-columns: 100px 1fr; align-items: center; margin-bottom: 15px;">
                                <span style="font-weight: bold;">Level:</span>
                                <span style="background: #f8f9fa; padding: 8px; border-radius: 4px; border: 1px solid #e0e0e0;"><?php echo floor($pokemon->getLevel()); ?></span>
                            </div>
                            <div style="display: grid; grid-template-columns: 100px 1fr; align-items: center; margin-bottom: 15px;">
                                <span style="font-weight: bold;">HP:</span>
                                <span style="background: #f8f9fa; padding: 8px; border-radius: 4px; border: 1px solid #e0e0e0;"><?php echo floor($pokemon->getHp()); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>