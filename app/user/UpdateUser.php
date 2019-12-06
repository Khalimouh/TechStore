<?php
session_start();
error_reporting(-1);
ini_set('display_errors', 'On');

if (!defined('PROJECT_ROOT'))
	define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

if (!defined('PROJECT_LIBS'))
   	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');

require_once(PROJECT_LIBS.'/app/dbconnection.php');
$conn = null;
$id = $_SESSION['id'];
print("\n User id $id\n");

$Login = $_POST['annonceur_login'];
$password = $_POST['annonceur_password'];
$confpassword = $_POST['annonceur_conf_password'];
$mail = $_POST['annonceur_e-mail'];
$nom = $_POST['annonceur_nom'];
$prenom = $_POST['annonceur_prenom'];
$ville = $_POST['annonceur_ville'];
$tel = $_POST['annonceur_tel'];

$ret= false;
$img_blob = '';
$img_taille = 0;
$img_type = '';
$img_nom = '';
$taille_max = 3550000;

//vérifie si l'image à été envoyée par le fomulaire
	if ($_FILES['file'] > 0 ) {
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


if(strcmp($password, $confpassword) == 0 && filter_var($mail,FILTER_VALIDATE_EMAIL)){
$passhache = password_hash($password, PASSWORD_DEFAULT);
connectDb($conn);

	if(!empty($Login)){
		$result  = $conn->query("UPDATE annonceur
		SET login = '$Login'
		WHERE id_annonceur = '$id'") or die("Error Update login" . $conn->error);
	}
	if(!empty($password)){
		$result  = $conn->query("UPDATE annonceur
		SET password = '$passhache'
		WHERE id_annonceur = '$id'")or die("Error Update login" . $conn->error);
	}
	if(!empty($mail)){
		$result  = $conn->query("UPDATE annonceur
		SET mail = '$mail'
		WHERE id_annonceur = '$id'")or die("Error Update login" . $conn->error);
	}
	if(!empty($nom)){
		$result  = $conn->query("UPDATE annonceur
		SET nom = '$nom'
		WHERE id_annonceur = '$id'")or die("Error Update login" . $conn->error);
	}
	if(!empty($prenom )){
		$result  = $conn->query("UPDATE annonceur
		SET prenom = '$prenom'
		WHERE id_annonceur = '$id'")or die("Error Update login" . $conn->error);
	}
	if(!empty($ville )){
		$result  = $conn->query("UPDATE annonceur
		SET ville = '$ville'
		WHERE id_annonceur = '$id'")or die("Error Update login" . $conn->error);
	}
	if(!empty($tel)){
		$result  = $conn->query("UPDATE annonceur
		SET telephone = '$tel'
		WHERE id_annonceur = '$id'")or die("Error Update login" . $conn->error);
	}
	if(!empty($img_nom )){
		$result  = $conn->query("UPDATE annonceur
		SET annonceur_photo = '" . addslashes ($img_blob) . "'
		WHERE id_annonceur = '$id'")or die("Error Update login" . $conn->error);
	}

	header("Location: profil.php");
	exit;
}else{
	header("Location: updateUser.php");
	exit;
}
?>



