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
		$query = "SELECT DISTINCT categorie FROM produit";

		$result = $conn->query($query)
				or die("SELECT Error: ".$conn->error);

		while ($tuple = mysqli_fetch_object($result)) {
			print_categorie($tuple->categorie);
		}
		$result->free();
		closeDb($conn);

	}
	
	function print_categorie($cat){
		print "<li><a href=#>$cat</a></li>";
	}



?>