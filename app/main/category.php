<?php
	if (!defined('PROJECT_ROOT'))
	    define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

	if (!defined('PROJECT_LIBS'))
    	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');
	
    //Get script dbconnection
	require_once(PROJECT_LIBS.'/app/dbconnection.php');
	$conn = null;
	function getCategories(){
		connectDb($conn);
		$query = "SELECT categorie, COUNT(*) nbr
					FROM produit p, annonce a
					WHERE p.id_produit = a.id_produit
					GROUP BY categorie
					ORDER BY categorie";

		$result = $conn->query($query)
				or die("SELECT Error: ".$conn->error);

		while ($tuple = mysqli_fetch_object($result)) {
			print_categorie($tuple->categorie, $tuple->nbr);
		}
		$result->free();
		closeDb($conn);

	}
	
	function print_categorie($cat,$nbr){
		print "<li>";
		print "<a href= # >";
		print "<span>$cat</span>";
		print "<span class=nbr_ads>$nbr</span>";
		print "</a></li>";
	}



?>