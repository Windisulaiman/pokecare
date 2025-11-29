<?php
abstract class Pokemon {
    protected $name;
    protected $type;
    protected $level;
    protected $hp;
    protected $specialMove;
    
    public function __construct($name, $type, $level, $hp, $specialMove) {
        $this->name = $name;
        $this->type = $type;
        $this->level = $level;
        $this->hp = $hp;
        $this->specialMove = $specialMove;
    }
    
    // Getter methods
    public function getName() {
        return $this->name;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function getLevel() {
        return $this->level;
    }
    
    public function getHp() {
        return $this->hp;
    }
    
    public function getSpecialMove() {
        return $this->specialMove;
    }
    
    // Abstract methods untuk polymorphism
    abstract public function train($trainingType, $intensity);
    abstract public function specialMove();
    
    // Method untuk meningkatkan stat
    protected function increaseStats($levelIncrease, $hpIncrease) {
        $this->level += $levelIncrease;
        $this->hp += $hpIncrease;
    }
    
    // Method untuk set stats (untuk testing)
    public function setStats($level, $hp) {
        $this->level = $level;
        $this->hp = $hp;
    }
}
?>