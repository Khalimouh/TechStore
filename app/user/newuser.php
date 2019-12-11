<?php 
if (!defined('PROJECT_ROOT'))
	define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

if (!defined('PROJECT_LIBS'))
	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(!isset($_SESSION['id']) and !isset($_SESSION['user'])) {
    //Get script dbconnection
	require_once(PROJECT_LIBS.'/app/dbconnection.php');
	$conn = null;

	connectDb($conn);
	//récuperation de l'id_user
	$result = $conn->query("SELECT MAX(id_user) max_id FROM user") 
				or die("SELECT Error: ".$conn->error);

	$tuple = mysqli_fetch_object($result);
	$max_id = $_SESSION['id'] = $tuple->max_id + 1;
	$_SESSION['user'] = 'Visiteur';
	$ip = getIpAddress(); 
	
	$result->free();
	//Insert new user;
	$conn->query("INSERT INTO user VALUES ($max_id, CURRENT_TIME(), '$ip', 'Visiteur');") or die("Erreur insertion user : " . $conn->error);
	// Insert new visitor
	$conn->query("INSERT INTO visiteur VALUES ($max_id);") or die ("Erreur insertion visiteur : ".$conn->error);

	closeDb($conn);

}
function getIpAddress(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//echo $_SESSION['id'], $_SESSION['user'];





?>