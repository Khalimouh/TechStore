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

	function getAd(){
		global $id;
	$query = "SELECT a.id_annonce, a.titre_annonce, a.prix, a.time_pub, a.ville as ad_ville, 				a.type_annonce, p.photo, COUNT(c.id_annonce) nbr_cons, 
				an.id_annonceur, an.nom, an.prenom, an.mail, an.telephone, an.telephone, an.ville as an_ville,
				pr.categorie, pr.marque, pr.modele, pr.poids, pr.etat
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
	
	if ($tuple = mysqli_fetch_object($result)){
 		print_ad($tuple->id_annonce, $tuple->titre_annonce, $tuple->prix, $tuple->time_pub, $tuple->ad_ville, $tuple->type_annonce, $tuple->nbr_cons, $tuple->id_annonceur, $tuple->nom, $tuple->prenom, $tuple->mail, $tuple->telephone, $tuple->an_ville, $tuple->categorie, $tuple->marque, $tuple->modele, $tuple->poids, $tuple->etat);
 	}
	$result->free();
	closeDb($conn);
    }


    function print_ad($id_annonce, $titre_annonce, $prix, $time_pub, $ad_ville, $type_annonce, $nbr_cons, $id_annonceur, $nom, $prenom, $mail, $telephone, $an_ville, $categorie, $marque, $modele, $poids, $etat){
    	print "<div>";
		print "<a href=/TechStore/app/ads/ads_category.php>";
		print "<span>Toutes les catégories</span></a> >>> ";
		print "<a href=/TechStore/app/ads/ads_category.php?cat=$categorie>";
		print "<span>$categorie</span></a></div><hr>";

		print "<div class=ad_title>$titre_annonce</div>";
		print "<div class=ad_info>Numero : $id_annonce</div>";
		print "<div class=ad_info>Déposée le : $time_pub</div>";
		print "<div class=ad_info>Nombre de consultation : $nbr_cons</div><hr>";
		
		print "<div class=ad_caracts>";
		print "<br>$marque $modele<br>$ad_ville<br><br>$type_annonce<br>";
		print "<div class=ad_price>$prix</div></div><hr>";
		print "<div class=annonceur_div>";
		print "<a href=#><div class=annonceur_nom>$nom $prenom</div></a>"; 
		print "<div >Ville: $an_ville</div>";
		print "<div >Téléphone: $telephone</div>";
		print "<div >Email : $mail</div></div><hr>";
		print "<section id=section_photos>";
		print "<img src=/TechStore/app/img/logo.png></section>";
		

    }
?>