<?php
if (!defined('PROJECT_ROOT'))
	define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

if (!defined('PROJECT_LIBS'))
	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');



    //Get script dbconnection
require_once(PROJECT_LIBS.'/app/dbconnection.php');
$conn = null;

/* Getters from the URL */
if(!isset($_GET["id"]))	
	header("Location: /TechStore/app/404");

$id = $_GET["id"];
$titre = 'Annonce';
function getAd(){
	global $id, $titre;
	$query = "SELECT a.id_annonce, a.titre_annonce, a.prix, a.time_pub, a.ville as ad_ville, 				a.type_annonce, p.photo, COUNT(c.id_annonce) nbr_cons, 
	an.id_annonceur, an.nom, an.prenom, an.mail, an.telephone, an.telephone, an.ville as an_ville,
	pr.categorie, pr.marque, pr.modele, pr.poids, pr.etat,pr.id_produit
	FROM annonce a
	LEFT JOIN consulter c ON a.id_annonce = c.id_annonce
	LEFT JOIN photo p ON a.id_annonce = p.id_annonce
	INNER JOIN produit pr ON a.id_produit = pr.id_produit
	INNER JOIN v_annonceur an ON a.id_annonceur = an.id_annonceur
	WHERE a.id_annonce = $id
	GROUP by a.id_annonce";
    //echo $query;
	connectDb($conn);
	$result = $conn->query($query)
	or die("SELECT Error: ".$conn->error);

	if(mysqli_num_rows ( $result ) <1 ) header("Location: /TechStore/app/404");

	$tuple = mysqli_fetch_object($result);
	
	$query = getQueryCat($tuple->categorie,$tuple->id_produit);
	$caracts = [];

	if($query != ''){
		$result = $conn->query($query)
				or die("SELECT Error: ".$conn->error);
		$caracts = mysqli_fetch_assoc($result);
	}

	$result->free();
	
	$_GET["titre"] = $tuple->titre_annonce;
	$_GET["marque"] = $tuple ->marque;
	$_GET["modele"] = $tuple ->modele;
	$_GET["cat"] = $tuple ->categorie;
	
	
	print_ad($tuple->id_annonce, $tuple->titre_annonce, $tuple->prix, $tuple->time_pub, $tuple->ad_ville, $tuple->type_annonce, $tuple->nbr_cons, $tuple->id_annonceur, $tuple->nom, $tuple->prenom, $tuple->mail, $tuple->telephone, $tuple->an_ville, $tuple->categorie, $tuple->marque, $tuple->modele, $tuple->poids, $tuple->etat, $caracts);
		

	
	

	
   	
	


	closeDb($conn);
}


function print_ad($id_annonce, $titre_annonce, $prix, $time_pub, $ad_ville, $type_annonce, $nbr_cons, $id_annonceur, $nom, $prenom, $mail, $telephone, $an_ville, $categorie, $marque, $modele, $poids, $etat, $caracts){
	print "<div class=redirect_cat>";
	print "<a href=/TechStore/app/ads/ads_category.php>";
	print "<span>Toutes les catégories</span></a> >> ";
	print "<a href=/TechStore/app/ads/ads_category.php?cat=$categorie>";
	print "<span>$categorie</span></a>";
	print "</div><hr>";

	print "<div class=ad_title>$titre_annonce</div>";
	print "<div class=ad_info><span class=ad_caract_title>Numero :</span> $id_annonce</div>";
	print "<div class=ad_info><span class=ad_caract_title>Déposée le :</span> $time_pub</div>";
	print "<div class=ad_info><span class=ad_caract_title>Nombre de consultation :</span> $nbr_cons</div><hr>";

	print "<div class=ad_caracts>";
	print "<div class= ad_caract><span class= ad_caract_title>Marque :</span> $marque</div>";
	print "<div class= ad_caract><span class= ad_caract_title>Modèle :</span> $modele</div>";
	print "<div class= ad_caract><span class= ad_caract_title>Disponible à :</span> $ad_ville</div>";
	print "<div class= ad_caract><span class= ad_caract_title>Etat :</span> $etat</div>";
	print "<div class= ad_caract><span class= ad_caract_title>Poids :</span> $poids</div>";
	print "<div class= ad_caract><span class= ad_caract_title>Urgence :</span> $type_annonce</div>";

	print "<div class = caracts_cat>";
	foreach ($caracts as $name => $data) {
		print "<div ><span class= ad_caract_title>$name :</span> $data </div>";
	}
	print "</div>";
	print "<div class=ad_price>$prix €</div></div><hr>";
	print "<section id=section_photos>";
	print "<img src=/TechStore/app/img/logo.png><img src=/TechStore/app/img/logo.png><img src=/TechStore/app/img/logo.png><img src=/TechStore/app/img/logo.png><img src=/TechStore/app/img/logo.png></section><hr>";

	print "<div class=annonceur_div>";
	print "<h2>A propos de l'annonceur</h2>";
	print "<a href=/TechStore/app/annonceur/annonceur.php?id=$id_annonceur target=_blank><div class=annonceur_nom>$nom $prenom</div></a>"; 
	print "<div><span class=ad_caract_title>Ville:</span> $an_ville</div>";
	print "<div><span class=ad_caract_title>Téléphone:</span> $telephone</div>";
	print "<div><span class=ad_caract_title>Email : </span> $mail</div></div><hr>";

}

function getQueryCat($cat, $id){
	$query = '';
	switch($cat)
	{
		case 'PC': { 
			$query ="SELECT pc.diagonale Diagonale, pc.processeur Processeur, pc.c_g 'Carte graphique', pc.ram Ram, pc.type_disque 'Type disque', pc.taille_disque 'Taille Disque', pc.batterie Batterie FROM v_pc pc WHERE pc.id_produit = $id";
		
			return $query;
		}
		case 'Téléphonie': { 
			$query = "SELECT t.diagonale Diagonale, t.processeur Processeur, t.ram Ram, t.taille_disque 'Taille Disque', t.os OS, t.batterie Batterie, t.nb_sim 'Nombre SIM', t.res_app_arr 'App photo', t.res_app_av 'Secondaire', t.nfc NFC FROM v_telephonie t WHERE t.id_produit = $id";

			return $query;
		}

		case 'TV':{
			$query = "SELECT tv.diagonale Diagonale, tv.definition Définition, tv.tech Téchnologie, tv.os OS, tv.connectique Connectique FROM v_tv tv WHERE tv.id_produit = $id";
			return $query;
		}

		case 'Appareils photo':{
			$query = "SELECT app.resolution Résolution, app.format_cap 'Format capteur', app.definition Définition, app.type_memoire 'Type mémoire', app.type_ecran 'Type écran', app.tech Téchnologie FROM v_app_photo app WHERE app.id_produit = $id";
			return $query;
		}
		default: {

			return $query;

		}

	}

}
?>