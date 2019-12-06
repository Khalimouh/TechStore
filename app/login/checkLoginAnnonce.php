<?php
session_start();
if(!$_SESSION['id']){
	header("Location: login.html");
}else{
	header("Location: ../Annonces/submitAnnonce.php");
}


?>