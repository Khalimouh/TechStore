<?php
	
	if (!defined('PROJECT_ROOT'))
	    define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

	if (!defined('PROJECT_LIBS'))
    	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');

    //Get script dbconnection
	require_once(PROJECT_LIBS.'/app/dbconnection.php');
	$conn = null;

	/* Getters from the URL */
	 if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['filterButton'])){

		$keyword = $_GET["keyword"];
		//$cat = $_GET["cat"];
		$marque = $_GET["marque"];
		$modele = $_GET["modele"];
		$poids = $_GET["poids"];
		$etat = $_GET["etat"];
		$ville = $_GET["ville"];

	/*	echo '<script type="text/javascript">alert("Data has been submitted to");</script>';*/
	}
	else {
		$keyword =''; /*$cat ='';*/ $marque =''; $modele =''; $etat = ''; $poids = ''; $ville ='';
	}

    /* -+ - +- +- +- +- - + - -+ -+ -+ - +- +- +- +- +- + -+ -+ -+ - +- +- */

	function print_ad_cat($title, $cat='', $marque, $model, $ad_ville, $etat, $urg, $price,
						$an_ville, $diffdate, $an_nom, $nbr_cons){
		print "<aside class=aside_ad><div class=ad_desc>";
		/* Annonce */
		print "<img src=../img/logo.png>";
		print "<div class=ad_caracts>";
		print "<div class=ad_title><a href=#>$title</a></div>";
		print "$cat<br>$marque $model<br>$ad_ville<br>$etat<br>$urg<br>$nbr_cons";
		print "	<div class=ad_price>$price €</div>"; 
		print "</div></div>";
		/* Annonceur */
		print "<div class=annonceur_div>";
		print "<div class=annonceur_ville>$an_ville</div>";
		print "<div class=diff_date_pub>$diffdate</div>";
		print "<a href=#><img src=../img/logo.png>";
		print "<div class=annonceur_nom>$an_nom</div>";
		print "</a></div></aside>";
	}




	function get_ads_cat($key ='',$cat ='', $marque ='', $modele ='', $etat = '', $ville =''){
		connectDb($conn);
		$query = "SELECT ann.id_annonceur,ann.nom, ann.prenom, ann.ville as a_ville, ann.annonceur_photo,
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
				LEFT JOIN photo p ON a.id_annonce = p.id_annonce
                INNER JOIN produit pr ON a.id_produit = pr.id_produit
                		and pr.categorie LIKE '%$cat%' and pr.marque LIKE '%$marque%' and pr.modele LIKE '%$modele%' and pr.etat LIKE '%$etat%'
                WHERE a.ville LIKE '%$ville%' AND a.titre_annonce LIKE '%$key%'
				GROUP by a.id_annonce
				ORDER BY nbr_cons DESC
				LIMIT 100";

		$result = $conn->query($query)
			or die("SELECT Error: ".$conn->error);

		while ($tuple = mysqli_fetch_object($result)){
			print_ad_cat($tuple->titre_annonce, $tuple->categorie, $tuple->marque, $tuple->modele, $tuple->ad_ville, $tuple->etat, $tuple->type_annonce, $tuple->prix, $tuple->a_ville, $tuple->time_pub, $tuple->nom." ".$tuple->prenom, $tuple->nbr_cons);			
 		}
		$result->free();
		closeDb($conn);
}




?>	
				
					
					
					