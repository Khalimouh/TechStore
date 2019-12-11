<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['id']) and $_SESSION['user'] == 'Visiteur'){
	header("Location: login.html");
}else{
	header("Location: ../user/profil.php");
}


?>