<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['id']) and $_SESSION['user'] == 'Annonceur'){
	print '<button id="logout" onclick="window.location.href = \'/TechStore/app/login/logout.php\';"><img src="/TechStore/app/img/remove.png"></button>';
}


?>