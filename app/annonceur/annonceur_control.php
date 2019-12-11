<?php
if (!defined('PROJECT_ROOT'))
	define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);


if (!defined('PROJECT_LIBS'))
	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


    //Get script dbconnection
require_once(PROJECT_LIBS.'/app/dbconnection.php');
$conn = null;

/* Getters from the URL */
if(!isset($_GET["id"]) or $_GET["id"] == '')	
	header("Location: /TechStore/app/404");


$id = $_GET["id"];

if( isset($_SESSION['id']))
	if($_SESSION['id'] == $id)
		header("Location: /TechStore/app/user/profil.php");

function getAnnonceur($id){
	$query = "SELECT a.id_annonceur, a.nom, a.prenom, a.ville, a.mail, a.telephone,
				COUNT(p.id_annonce) nbr_ann 
				FROM v_annonceur a 
    			INNER JOIN publier p ON a.id_annonceur = p.id_annonceur
				WHERE a.id_annonceur = $id";

	connectDb($conn);
	$result = $conn->query($query)
	or die("SELECT Error: ".$conn->error);

	if(mysqli_num_rows ( $result ) <1 ) header("Location: /TechStore/app/404");

	if ($tuple = mysqli_fetch_object($result)){
		printAnn($tuple->id_annonceur, $tuple->nom, $tuple->prenom, $tuple->ville, $tuple->mail, $tuple->telephone, $tuple->nbr_ann);			
	}

	$result->free();
	closeDb($conn);


}

function getAds($id){
	$query = "SELECT a.id_annonce, a.titre_annonce, a.prix, a.ville, a.type_annonce, p.marque, p.modele 	, p.poids, p.etat, p.categorie, a.description, COUNT(c.id_annonce) nbr_cons
				FROM annonce a
				INNER JOIN produit p ON a.id_produit = p.id_produit
				LEFT JOIN consulter c ON  c.id_annonce = a.id_annonce
				WHERE a.id_annonceur = $id
				GROUP BY a.id_annonce";
	connectDb($conn);
	$result = $conn->query($query)
	or die("SELECT Error: ".$conn->error);

	while ($tuple = mysqli_fetch_object($result)){
		printAd($tuple->id_annonce, $tuple->titre_annonce, $tuple->categorie, $tuple->marque, $tuple->modele, $tuple->ville, $tuple->etat, $tuple->type_annonce, $tuple->prix, $tuple->nbr_cons);			
	}

	$result->free();
	closeDb($conn);
}


function printAnn($id, $nom, $prenom, $ville, $mail, $tel, $nbr_ann){
	print"<div class=ann_name>$nom $prenom</div>";
	print"<div><span class=ann_caract>Numéro :</span> $id</div>";
	print"<div><span class=ann_caract>Email :</span> $mail</div>";
	print"<div><span class=ann_caract>Téléphone :</span> $tel</div>";
	print"<div><span class=ann_caract>Ville :</span> $ville</div>";
	print"<div><span class=ann_caract>Nombre d'annonces :</span> $nbr_ann</div>";
}

function printAd($id_ann,$title, $cat, $marque, $model, $ad_ville, $etat, $urg, $price, $nbr_cons){
	
	print"<aside class=aside_ad><div class=ad_desc>";
	print"<img src=../img/logo.png>";
	print"<div class=ad_caracts>";
	print"<div class=ad_title><a href=/TechStore/app/ad/ad.php?id=$id_ann target=_blank>$title</a></div>";
	print"$cat<br>$marque $model<br>$ad_ville<br>$etat<br>$urg<br>$nbr_cons";
	print"<div class=ad_price>$price €</div>";
	print"</div></div></aside>";
}



?>