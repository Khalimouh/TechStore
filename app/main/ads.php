<?php
	if (!defined('PROJECT_ROOT'))
	    define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

	if (!defined('PROJECT_LIBS'))
    	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');

    //Get script dbconnection
	require_once(PROJECT_LIBS.'/app/dbconnection.php');
	$conn = null;


function get_ads($query){
	connectDb($conn);
	
	$result = $conn->query($query)
			or die("SELECT Error: ".$conn->error);

	while ($tuple = mysqli_fetch_object($result)){
		$dateFormat = date("Y-m-d",strtotime($tuple->time_pub));
 		print_ads($tuple->id_annonce,$tuple->prix,$tuple->titre_annonce,$dateFormat,$tuple->nbr_cons);
 	}
	$result->free();
	closeDb($conn);
}

function print_ads($id, $price, $title, $date, $nbr){
	print "<a href=/TechStore/app/ad/ad.php?id=$id>";
	print "<div class= ads>";
	// photo ads
	print "<img class=img_ads src=./app/img/logo.png>";
	// price ads
	print "<div class=price_ads>$price €</div>";
	// title ads
	print "<div class=title_ads>$title</div>";
	// date ads and nbr consultation 
	print "<div class=date_ads><span>$date</span><span>$nbr</span></div>";
	print "</div></a>";  	
	
}
function get_popular_ads($limit = 1000,$cat = ''){
	$query = "SELECT a.id_annonce, a.titre_annonce, a.prix, a.time_pub, p.photo ,pr.categorie, COUNT(c.id_annonce) nbr_cons
				FROM annonce a
				LEFT JOIN consulter c ON a.id_annonce = c.id_annonce
				LEFT JOIN photo p ON a.id_annonce = p.id_annonce
                INNER JOIN produit pr ON a.id_produit = pr.id_produit and pr.categorie LIKE '$cat%'
				GROUP by a.id_annonce
				ORDER BY nbr_cons DESC
				LIMIT $limit";
	get_ads($query);
}

function get_recommanded_ads(){

}


?>
