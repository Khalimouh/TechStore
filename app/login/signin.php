<?php

error_reporting(-1);
ini_set('display_errors', 'On');

if (!defined('PROJECT_ROOT'))
	define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

if (!defined('PROJECT_LIBS'))
   	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');

require_once(PROJECT_LIBS.'/app/dbconnection.php');
$conn = null;

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


$Login = $_POST['annonceur_login'];
$password = $_POST['annonceur_password'];
$confpassword = $_POST['annonceur_conf_password'];
$mail = $_POST['annonceur_e-mail'];
$nom = $_POST['annonceur_nom'];
$prenom = $_POST['annonceur_prenom'];
$ville = $_POST['annonceur_ville'];
$tel = $_POST['annonceur_tel'];
$user_ip = getUserIpAddr();

/*
print($Login . "\n");
print($password . "\n");
print($confpassword. "\n");
print($mail. "\n");
print($nom. "\n");
print($prenom. "\n");
print($tel. "\n");
*/

//Informations sur l'image à transferer
$ret= false;
$img_blob = '';
$img_taille = 0;
$img_type = '';
$img_nom = '';
$taille_max = 3550000;

//vérifie si l'image à été envoyée par le fomulaire
	if ($_FILES['file'] > 0){
  		echo "You have selected a file to upload";
  	}

	$ret = is_uploaded_file($_FILES['file']['tmp_name']);
	if (!$ret) {
		echo "Problème de transfert";
		return false;
	} else {
	// Le fichier a bien été reçu	
	$img_taille = $_FILES['file']['size'];
		if ($img_taille > $taille_max) {
			echo "Trop gros !";
			return false;
		}
	$img_type = $_FILES['file']['type'];
	$img_nom = $_FILES['file']['name'];
	$img_blob = file_get_contents ($_FILES['file']['tmp_name']);
	echo $img_nom." est bien trasféré" . "\n";
	}


//Verifie la conconrdance des mots de passes et des emails
if(strcmp($password, $confpassword) == 0 && filter_var($mail, FILTER_VALIDATE_EMAIL)){
		//hachage du mot de passe
		$passhache = password_hash($password, PASSWORD_DEFAULT);
		/*print($passhache);*/
		//On se connecte à la BD
		connectDb($conn);
		//récuperation de l'id_user
		$res = $conn->query("SELECT MAX(id_user) as maxIdUser FROM user");
		$new_id_availible = $res->fetch_object();
		$maxid = $new_id_availible->maxIdUser +1 ;
		//print($new_id_availible->maxIdUser);
		//récuperation de la date
		$date = date('Y-m-d H:i:s');


		$conn->query("INSERT INTO user (id_user, time_access, adress_ip, type_user) VALUES ($maxid, '$date', '$user_ip', 'Annonceur');") or die("Erreur insertion user : " . $conn->error);

		$conn->query("INSERT INTO annonceur (id_annonceur, login, password, mail,
			nom, prenom, ville, telephone, annonceur_photo) VALUES ($maxid, '$Login','$passhache', '$mail', '$nom', '$prenom', '$ville', '$tel', " .
		"'" . addslashes ($img_blob) . "');")or die("Erreur insertion annonceur: " . $conn->error);
		//rediriger vers la page d'acceuil du site 	
			$res->free();
			$conn->close();

			header("Location: ../user/login.php");
			exit;
}else{
	header("Location: signin.html");
	print("Les mots de passe ne sont pas identiques");
	exit;
}



?>