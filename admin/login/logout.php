<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Suppression des variables de session et de la session
unset($_SESSION['admin']);

header("Location: login.php");
?>