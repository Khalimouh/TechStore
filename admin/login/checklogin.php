<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if($_POST['login'] == 'admin' and $_POST['pass'] == '123'){
	$_SESSION['admin'] = 'admin';
	header("Location: ../main");
	exit;
}
else {
	header("Location: login.php");
	exit;
}

?>