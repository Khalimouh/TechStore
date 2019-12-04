<?php
	if (!defined('PROJECT_ROOT'))
	    define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

	if (!defined('PROJECT_LIBS'))
    	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');

    //Get script dbconnection
	require_once(PROJECT_LIBS.'/app/dbconnection.php');
	$conn = null;

function get_ads(){
	connectDb($conn);
	$query = "SELECT a.titre_annonce, a.prix, a.time_pub, p.photo 
				FROM annonce a
				LEFT JOIN photo p ON a.id_annonce = p.id_annonce";

	$result = $conn->query($query)
			or die("SELECT Error: ".$conn->error);

	while ($tuple = mysqli_fetch_object($result)){
 		print_ads($tuple->prix,$tuple->titre_annonce,$tuple->time_pub);
 	}
	$result->free();
	closeDb($conn);
}

function print_ads($price,$title,$date){
	print "<a href= #>";
	print "<div class= ads>";
	print "<img class=img_ads src=./app/img/logo.png>";
	print "<div class=price_ads>$price €</div>";
	print "<div class=title_ads>$title</div>";
	print "<div class=date_ads>$date</div>";
	print "</div></a>";  	
	
}
?>
