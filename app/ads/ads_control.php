<?php

if (!defined('PROJECT_ROOT'))
	define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

if (!defined('PROJECT_LIBS'))
	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');



    //Get script dbconnection
require_once(PROJECT_LIBS.'/app/dbconnection.php');
$conn = null;

/* Getters from the URL */
if(!isset($_GET["cat"]))	
	$_GET["cat"] = '';

$cat = $_GET["cat"];

if(!isset($_GET["keyword"]))	
	$_GET["keyword"] = '';

$keyword = $_GET["keyword"];
	

function printFormCatg($cat =''){
	global $cpu, $diag, $c_g, $ram, $taille_disk, $type_disk, $os, $app_photo;
		echo '<div>';
		echo '<input form="filter_form" type="text" name="cpu" placeholder="Processeur" value=',$cpu,'>';
	if($cat == 'PC'){
		echo '<input form="filter_form" type="text" name="c_g" placeholder="Carte graphique" value=',$c_g,'>';
	}
		echo '<input form="filter_form" type="text" name="diag" placeholder="Diagonale" value=',$diag,'>';
		echo '<select name ="ram" form="filter_form">';
		echo '<option value="" selected hidden>',$ram=='' ? 'RAM' : $ram,'</option>';
		echo '<option value="1 GO">1 GO</option>';
		echo '<option value="2 GO">2 GO</option>';
		echo '<option value="">Peu importe</option>';
		echo '</select>';
		echo '<select name ="taille_disk" form="filter_form">';
		echo '<option value="" selected hidden>',$taille_disk=='' ? 'Taille disque' : $taille_disk,'</option>';
		echo '<option value="8 GO">8 GO</option>';
		echo '<option value="16 GO">16 GO</option>';
		echo '<option value="32 GO">32 GO</option>';
		echo '<option value="">Peu importe</option>';
		echo '</select>';
	if($cat == 'PC'){
		echo '<select name ="type_disk" form="filter_form">';
		echo '<option value="" selected hidden>',$type_disk=='' ? 'Type disque' : $type_disk,'</option>';
		echo '<option value="HDD">HDD</option>';
		echo '<option value="SSD">SSD</option>';
		echo '<option value="">Peu importe</option>';
		echo '</select>';
	}
		echo '<select name ="os" form="filter_form">';
		echo '<option value="" selected hidden>',$os=='' ? 'OS' : $os,'</option>';
		echo '<option value="IOS">IOS</option>';
		echo '<option value="Android">Android</option>';
		echo '<option value="">Peu importe</option>';
		echo '</select>';
	if($cat == 'Téléphonie'){
		echo '<select name ="app_photo" form="filter_form">';
		echo '<option value="" selected hidden>',$app_photo=='' ? 'Appareil photo' : $app_photo,'</option>';
		echo '<option value="1 MP">1 MP</option>';
		echo '<option value="2 MP">2 MP</option>';
		echo '<option value="">Peu importe</option>';
		echo '</select>';	
	}
		echo '</div>';
}

if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['filterButton'])){

	$marque = $_GET["marque"];
	$modele = $_GET["modele"];
	$poids_min = $_GET["poids_min"];
	$poids_max = $_GET["poids_max"];
	$prix_min = $_GET["prix_min"];
	$prix_max = $_GET["prix_max"];
	$date_min = $_GET["date_min"];
	$date_max = $_GET["date_max"];
	$etat = $_GET["etat"];
	$ville = $_GET["ville"];
	$urgence = $_GET["urgence"];
	$photos = $_GET["photos"];
	$cpu = isset($_GET["cpu"]) ? $_GET["cpu"] : '';
	$diag= isset($_GET["diag"]) ? $_GET["diag"] : '';
	$ram = isset($_GET["ram"]) ? $_GET["ram"] : '';
	$taille_disk = isset($_GET["taille_disk"]) ? $_GET["taille_disk"] : '';
	$type_disk = isset($_GET["type_disk"]) ? $_GET["type_disk"] : '';
	$os = isset($_GET["os"]) ? $_GET["os"] : '';
	$c_g = isset($_GET["c_g"]) ? $_GET["c_g"] : '';
	$app_photo = isset($_GET["app_photo"]) ? $_GET["app_photo"] : '';

	/*	echo '<script type="text/javascript">alert("Data has been submitted to");</script>';*/
}
else {
	 $marque =''; $modele =''; $etat = ''; $poids_min = ''; $poids_max = ''; $prix_min = ''; $prix_max =''; $ville =''; $urgence = ''; $date_min =''; $date_max = ''; $photos ='';$cpu = ''; $diag= ''; $ram= ''; $taille_disk = ''; $type_disk = ''; $os = ''; $c_g = '';$app_photo = '';
}



/* -+ - +- +- +- +- - + - -+ -+ -+ - +- +- +- +- +- + -+ -+ -+ - +- +- */

function print_ad_cat($id,$title, $cat='', $marque, $model, $ad_ville, $etat, $urg, $price,
	$id_ann,$an_ville, $diffdate, $an_nom, $nbr_cons){
	print "<aside class=aside_ad><div class=ad_desc>";
	/* Annonce */
	print "<img src=../img/logo.png>";
	print "<div class=ad_caracts>";
	print "<div class=ad_title><a href=/TechStore/app/ad/ad.php?id=$id target=_blank>$title</a></div>";
	print "$cat<br>$marque $model<br>$ad_ville<br>$etat<br>$urg<br>$nbr_cons";
	print "	<div class=ad_price>$price €</div>"; 
	print "</div></div>";
	/* Annonceur */
	print "<div class=annonceur_div>";
	print "<div class=annonceur_ville>$an_ville</div>";
	print "<div class=diff_date_pub>$diffdate</div>";
	print "<a href=/TechStore/app/annonceur/annonceur.php?id=$id_ann target=_blank><img src=/TechStore/app/img/logo.png>";
	print "<div class=annonceur_nom>$an_nom</div>";
	print "</a></div></aside>";
}




function get_ads_query($keyword ='', $cat ='', $marque ='', $modele ='', $etat = '', $poids_min = '', $poids_max = '', $prix_min = '', $prix_max ='', $ville ='', $urgence = '', $date_min ='', $date_max = '', $photos = '', $cpu = '', $diag= '', $ram= '', $taille_disk = '', $type_disk = '', $os = '', $c_g = '', $app_photo = ''){
	$t_prix_max = $prix_max =='' ? 10000 : $prix_max;
	$t_date_max = $date_max =='' ? "CURRENT_DATE()" : "'".$date_max."'";
	$t_poids_max = $poids_max =='' ? 10000 : $poids_max;
	$t_poids_cond = ($poids_min == '' AND $poids_max == '') ? '' :
	"AND poids BETWEEN ".$poids_min." AND ".$t_poids_max." ";

	$t_diag = $diag =='' ? 10000 : preg_replace('/[^0-9.]+/', '', $diag);
	$t_ram = $ram =='' ? 10000 : preg_replace('/[^0-9.]+/', '', $ram);
	$t_taille_disk = $taille_disk =='' ? 10000 : preg_replace('/[^0-9.]+/', '', $taille_disk);
	$t_app_photo = $app_photo =='' ? 10000 : preg_replace('/[^0-9.]+/', '', $app_photo);
	
	if($photos == '')
		$t_photos = 'LEFT JOIN photo p ON a.id_annonce = p.id_annonce';
	else if ($photos == 'Avec photos')
		$t_photos = 'INNER JOIN photo p ON a.id_annonce = p.id_annonce';
	else if ($photos == 'Sans photos')
		$t_photos = 'INNER JOIN photo p ON a.id_annonce <> p.id_annonce';

	if($cat == 'PC')

		$query = "SELECT ann.id_annonceur,ann.nom, ann.prenom, ann.ville as an_ville, ann.annonceur_photo,
			a.id_annonce, a.titre_annonce, a.prix, a.time_pub, a.ville as ad_ville,
			a.type_annonce,p.photo,
			v_pc.marque, v_pc.modele, v_pc.etat , v_pc.categorie, v_pc.poids, COUNT(c.id_annonce) nbr_cons
			FROM annonce a
			INNER JOIN (SELECT a2.id_annonceur, an.id_annonce, a2.nom, a2.prenom,
			a2.ville, a2.annonceur_photo	
			FROM v_annonceur a2, publier p , annonce an
			WHERE a2.id_annonceur = p.id_annonceur
			AND an.id_annonce = p.id_annonce) ann
			ON a.id_annonceur = ann.id_annonceur and a.id_annonce = ann.id_annonce
			LEFT JOIN consulter c ON a.id_annonce = c.id_annonce
			$t_photos
			INNER JOIN v_pc ON a.id_produit = v_pc.id_produit
			WHERE a.ville LIKE '%$ville%' AND a.titre_annonce LIKE '%$keyword%' 
			AND v_pc.categorie LIKE '$cat%' 
			AND v_pc.marque LIKE '%$marque%' OR v_pc.marque LIKE '%$keyword%'
			AND v_pc.modele LIKE '%$modele%' OR v_pc.modele LIKE '%$keyword%'
			and v_pc.etat LIKE '%$etat%' 
			AND a.prix BETWEEN '$prix_min' AND '$t_prix_max' 
			AND a.time_pub BETWEEN '$date_min' AND $t_date_max
			$t_poids_cond
			AND a.type_annonce LIKE '$urgence%' 
			AND v_pc.processeur LIKE '%$cpu%' OR v_pc.processeur LIKE '%$keyword%'
			AND v_pc.c_g LIKE '%$c_g%' OR v_pc.c_g LIKE '%$keyword%'
			AND v_pc.diagonale <= '$t_diag' AND v_pc.ram <= '$t_ram' 
			AND v_pc.type_disque LIKE '$type_disk%' OR v_pc.type_disque LIKE '%$keyword%'
			AND v_pc.taille_disque <= '$t_taille_disk'

			GROUP by a.id_annonce
			ORDER BY nbr_cons DESC
			LIMIT 100";

	else if($cat == 'Téléphonie')
		$query= "SELECT ann.id_annonceur,ann.nom, ann.prenom, ann.ville as an_ville, ann.annonceur_photo,
	a.id_annonce, a.titre_annonce, a.prix, a.time_pub, a.ville as ad_ville,
	a.type_annonce,p.photo,
	t.marque, t.modele, t.etat , t.categorie, t.poids, COUNT(c.id_annonce) nbr_cons
	FROM annonce a
	INNER JOIN (SELECT a2.id_annonceur, an.id_annonce, a2.nom, a2.prenom,
	a2.ville, a2.annonceur_photo	
	FROM v_annonceur a2, publier p , annonce an
	WHERE a2.id_annonceur = p.id_annonceur
	AND an.id_annonce = p.id_annonce) ann
	ON a.id_annonceur = ann.id_annonceur and a.id_annonce = ann.id_annonce
	LEFT JOIN consulter c ON a.id_annonce = c.id_annonce
	$t_photos
	INNER JOIN v_telephonie t ON a.id_produit = t.id_produit
	WHERE a.ville LIKE '%$ville%' AND a.titre_annonce LIKE '%$keyword%' 
	AND t.categorie LIKE '$cat%' 
	AND t.marque LIKE '%$marque%' OR t.marque LIKE '%$keyword%'
	AND t.modele LIKE '%$modele%' OR t.modele LIKE '%$keyword%'
	and t.etat LIKE '%$etat%' 
	AND a.prix BETWEEN '$prix_min' AND '$t_prix_max' 
	AND a.time_pub BETWEEN '$date_min' AND $t_date_max
	$t_poids_cond
	AND a.type_annonce LIKE '$urgence%'
	AND t.processeur LIKE '%$cpu%' OR t.processeur LIKE '%$keyword%'
	AND t.res_app_arr <= '$t_app_photo' AND t.diagonale <= '$t_diag' 
	AND t.ram <= '$t_ram' AND t.taille_disque <= '$t_taille_disk'
	GROUP by a.id_annonce
	ORDER BY nbr_cons DESC
	LIMIT 100";
	else
		$query = "SELECT ann.id_annonceur,ann.nom, ann.prenom, ann.ville as an_ville, ann.annonceur_photo,
	a.id_annonce, a.titre_annonce, a.prix, a.time_pub, a.ville as ad_ville,
	a.type_annonce,p.photo,
	pr.marque, pr.modele, pr.etat , pr.categorie, pr.poids, COUNT(c.id_annonce) nbr_cons
	FROM annonce a
	INNER JOIN (SELECT a2.id_annonceur, an.id_annonce, a2.nom, a2.prenom,
	a2.ville, a2.annonceur_photo	
	FROM v_annonceur a2, publier p , annonce an
	WHERE a2.id_annonceur = p.id_annonceur
	AND an.id_annonce = p.id_annonce) ann
	ON a.id_annonceur = ann.id_annonceur and a.id_annonce = ann.id_annonce
	LEFT JOIN consulter c ON a.id_annonce = c.id_annonce
	$t_photos
	INNER JOIN produit pr ON a.id_produit = pr.id_produit
	WHERE a.ville LIKE '%$ville%' AND a.titre_annonce LIKE '%$keyword%' 
	AND pr.categorie LIKE '$cat%' 
	AND pr.marque LIKE '%$marque%' OR pr.marque LIKE '%$keyword%'
	AND pr.modele LIKE '%$modele%' OR pr.modele LIKE '%$keyword%'
	and pr.etat LIKE '%$etat%' 
	AND a.prix BETWEEN '$prix_min' AND '$t_prix_max' 
	AND a.time_pub BETWEEN '$date_min' AND $t_date_max
	$t_poids_cond
	AND a.type_annonce LIKE '$urgence%'
	GROUP by a.id_annonce
	ORDER BY nbr_cons DESC
	LIMIT 100";


		//echo $query;
		//echo '<script type="text/javascript">console.log("'.$query.'");</script>';
	return $query;

}

function printResults($query){
	connectDb($conn);
	$result = $conn->query($query)
	or die("SELECT Error: ".$conn->error);

	while ($tuple = mysqli_fetch_object($result)){
		print_ad_cat($tuple->id_annonce,$tuple->titre_annonce, $tuple->categorie, $tuple->marque, $tuple->modele, $tuple->ad_ville, $tuple->etat, $tuple->type_annonce, $tuple->prix,$tuple->id_annonceur, $tuple->an_ville, $tuple->time_pub, $tuple->nom." ".$tuple->prenom, $tuple->nbr_cons);			
	}

	$result->free();
	closeDb($conn);
}

?>	



