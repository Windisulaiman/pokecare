<?php
require_once 'Pokemon.php';
require_once 'Victreebel.php';

session_start();

if (isset($_SESSION['training_history'])) {
    $_SESSION['training_history'] = [];
}

header('Location: history.php');
exit();
?>