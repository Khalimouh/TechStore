<?php
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	error_reporting(-1);
	ini_set('display_errors', 'On');
	if (!defined('PROJECT_ROOT'))
	    define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);
	if (!defined('PROJECT_LIBS'))
    	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');
    //Get script dbconnection
	require_once(PROJECT_LIBS.'/app/dbconnection.php');
	
	$conn = null;
	$idann = $_SESSION['id'];

	if(isset($_POST['remove_button'])){
		//echo "remove\n";
		//print($_POST['remove_button']);
		
		$idAnnonceToDel = $_POST['remove_button'];
		
		/*Suppression des tuples dans l'ordre inverse des insertion*/
		connectDb($conn);
		$result = $conn->query("SELECT p.id_produit, p.categorie
				FROM annonce a, produit p
				WHERE a.id_produit = p.id_produit
				AND a.id_annonce = $idAnnonceToDel;");
		$produit = $result->fetch_object();
		//print($produit->id_produit);
		//print($produit->categorie);
		/*Suppresion des consultations*/
		$conn->query("DELETE FROM consulter WHERE id_annonce = $idAnnonceToDel;") or die("Erreur de suppression produit" . $conn->error);
		/*Suppression de la publication*/
		$conn->query("DELETE FROM publier WHERE id_annonce = $idAnnonceToDel;") or die("Erreur de suppression produit" . $conn->error);
		/*Suppression de la photo*/
		$conn->query("DELETE FROM photo WHERE id_annonce = $idAnnonceToDel;");
		/*Suppression de la catégorie*/
		switch ($produit->categorie) {
			case "Téléphonie":
				$conn->query("DELETE FROM telephonie   WHERE id_produit = $produit->id_produit; ");
				break;
			case "TV":
				$conn->query("DELETE FROM tv   WHERE id_produit = $produit->id_produit;");

				break;
			case "PC":
				$conn->query("DELETE FROM pc  WHERE id_produit = $produit->id_produit;");

				break;
			case "Accesoires":
				$conn->query("DELETE FROM accesoires WHERE id_produit = $produit->id_produit;");
				break;
			case "Appareil Photo":
				$conn->query("DELETE FROM app_photo  WHERE id_produit = $produit->id_produit;");
				break;
			default:

				break;
		}
		/*Suppression du produit*/
		$conn->query("DELETE FROM annonce WHERE id_annonce = $idAnnonceToDel");
		$result->free();
		$conn->query("DELETE FROM produit WHERE id_produit = $produit->id_produit;") or die("Erreur suppression produit". $conn->error); 
		/*Suppression de l'annonce*/
		$conn->close();
		header("Location: profil.php");
	}
	if(isset($_POST['update_button'])){
		/*
		echo "Update";
		print($_POST['update_button']);
		*/
		connectDb($conn);
		$idAnnonceToMod = $_POST['update_button'];
		$result = $conn->query("SELECT p.categorie
				FROM annonce a, produit p
				WHERE a.id_produit = p.id_produit
				AND a.id_annonce = $idAnnonceToMod;");
		$categorie = $result->fetch_object();
		$_SESSION['idannonce'] = $idAnnonceToMod ;
		$_SESSION['cat'] = $categorie->categorie;
		$result->free();
		$conn->close();

		header("Location: formannonces.php");
	}

	

?>

