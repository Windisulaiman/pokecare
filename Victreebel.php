<?php
require_once 'Pokemon.php';

class Victreebel extends Pokemon {
    public function __construct() {
        parent::__construct(
            "Victreebel",
            "Grass/Poison",
            5,  // Level awal
            50, // HP awal
            "Leaf Blade. Mengeluarkan daun tajam yang dapat memotong dengan presisi tinggi."
        );
    }
    
    public function train($trainingType, $intensity) {
        // Efek latihan berdasarkan tipe dan intensitas
        switch($trainingType) {
            case 'Attack':
                $levelIncrease = $intensity * 0.8;
                $hpIncrease = $intensity * 2;
                break;
            case 'Defense':
                $levelIncrease = $intensity * 0.5;
                $hpIncrease = $intensity * 3;
                break;
            case 'Speed':
                $levelIncrease = $intensity * 0.7;
                $hpIncrease = $intensity * 1.5;
                break;
            default:
                $levelIncrease = $intensity * 0.6;
                $hpIncrease = $intensity * 2;
        }
        
        $this->increaseStats($levelIncrease, $hpIncrease);
        return true;
    }
    
    public function specialMove() {
        return $this->specialMove;
    }
}
?>