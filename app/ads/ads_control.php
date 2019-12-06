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

	/*	echo '<script type="text/javascript">alert("Data has been submitted to");</script>';*/
	}
	else {
		$keyword =''; /*$cat ='';*/ $marque =''; $modele =''; $etat = ''; $poids_min = ''; $poids_max = ''; $prix_min = ''; $prix_max =''; $ville =''; $urgence = ''; $date_min =''; $date_max = ''; $photos ='';
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




	function get_ads_cat($keyword ='', $cat ='', $marque ='', $modele ='', $etat = '', $poids_min = '', $poids_max = '', $prix_min = '', $prix_max ='', $ville ='', $urgence = '', $date_min ='', $date_max = '', $photos = ''){
		$t_prix_max = $prix_max =='' ? 10000 : $prix_max;
		$t_date_max = $date_max =='' ? 'CURRENT_DATE()' : $date_max;
		$t_poids_max = $poids_max =='' ? 10000 : $poids_max;
		$t_poids_cond = ($poids_min == '' AND $poids_max == '') ? '' :
				"AND pr.poids BETWEEN ".$poids_min." AND ".$t_poids_max." ";

		if($photos == '')
			$t_photos = 'LEFT JOIN photo p ON a.id_annonce = p.id_annonce';
		else if ($photos == 'Avec photos')
			$t_photos = 'INNER JOIN photo p ON a.id_annonce = p.id_annonce';
		else if ($photos == 'Sans photos')
			$t_photos = 'INNER JOIN photo p ON a.id_annonce <> p.id_annonce';
		
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
				$t_photos
                INNER JOIN produit pr ON a.id_produit = pr.id_produit
                WHERE a.ville LIKE '%$ville%' AND a.titre_annonce LIKE '%$keyword%' 
                AND pr.categorie LIKE '%$cat%' AND pr.marque LIKE '%$marque%' 
                AND pr.modele LIKE '%$modele%' and pr.etat LIKE '%$etat%' 
                AND a.prix BETWEEN '$prix_min' AND '$t_prix_max' 
                AND a.time_pub BETWEEN '$date_min' AND $t_date_max
                $t_poids_cond
                AND a.type_annonce LIKE '$urgence%'
				GROUP by a.id_annonce
				ORDER BY nbr_cons DESC
				LIMIT 100";

		//echo $query;
		//echo '<script type="text/javascript">console.log("'.$query.'");</script>';
		$result = $conn->query($query)
			or die("SELECT Error: ".$conn->error);

		while ($tuple = mysqli_fetch_object($result)){
			print_ad_cat($tuple->titre_annonce, $tuple->categorie, $tuple->marque, $tuple->modele, $tuple->ad_ville, $tuple->etat, $tuple->type_annonce, $tuple->prix, $tuple->a_ville, $tuple->time_pub, $tuple->nom." ".$tuple->prenom, $tuple->nbr_cons);			
 		}

		$result->free();
		closeDb($conn);
}




?>	
				
					
					
					