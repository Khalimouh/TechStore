<?php
	
	if (!defined('PROJECT_ROOT'))
	    define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

	if (!defined('PROJECT_LIBS'))
    	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');
	
    //Get script dbconnection
	require_once(PROJECT_LIBS.'/app/dbconnection.php');
	$GLOBALS['conn'] = null;

	function catsToArray(){
		
		$array = null;
		$query = "SELECT DISTINCT categorie from produit";
		$result = $GLOBALS['conn']->query($query)
					or die("SELECT Error: ".$GLOBALS['conn']->error);
		while ($tuple = mysqli_fetch_object($result))
			$array[] = $tuple->categorie;
		
		$result->free();
		return $array;	
	}


	function prepareStat($cat){
		
		$query = "SELECT a.nom ,a.prenom ,a.id_annonceur, pr.categorie ,COUNT(p.id_annonceur) nbr_ann
				FROM annonceur a , annonce an , publier p , produit pr
				WHERE a.id_annonceur = p.id_annonceur
				AND p.id_annonce = an.id_annonce
				AND pr.id_produit = an.id_produit
                AND pr.categorie = '$cat'
				GROUP BY a.id_annonceur, pr.categorie
                ORDER BY nbr_ann DESC";
		$result = $GLOBALS['conn']->query($query)
				or die("SELECT Error: ".$GLOBALS['conn']->error);
		print "<div class=table_stats>";
		print "<table>";
		print "<tr><th colspan=2>$cat</th></tr>";
		while ($tuple = mysqli_fetch_object($result))
			printStat($tuple->nom, $tuple->prenom, $tuple->nbr_ann);
		
		print	"</table></div>";

		$result->free();
	}

	function printStat($nom, $prenom, $nbr){
		print "<tr><td><a href= #>$nom $prenom</a></td><td>$nbr</td></tr>";
	}

	function getStatsCatg(){
		connectDb($GLOBALS['conn']);
	
		$cats = catsToArray();
		foreach ($cats as $cat) {
			prepareStat($cat);
		}
	
		closeDb($GLOBALS['conn']);
	}
?>