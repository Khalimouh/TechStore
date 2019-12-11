<?php
	/*
	error_reporting(-1);
	ini_set('display_errors', 'On');
	*/
	if (!defined('PROJECT_ROOT'))
	    define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

	if (!defined('PROJECT_LIBS'))
    	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');


	require_once(PROJECT_LIBS.'/app/dbconnection.php');
	$conn = null;

	if (session_status() == PHP_SESSION_NONE) {
    session_start();
	}

	function debug(){
		print $_SESSION['id'];
		print $_SESSION['login'];
	}
	
	function display_user_info($photo, $nom , $prenom, $mail , $ville , $tel){
		$id = $_SESSION['id'];
		print "<div class= user>";
		print "<div> Nom: $nom  <br> Prénom: $prenom <br> </div>";
		print "<div> Téléphone : $tel <br> </div>";
		print "<div> E-Mail : $mail <br> </div>";
		print "<div> Ville : $ville <br> </div>";
		print "</div>";
	}
	
	function get_user_info(){
		$login = $_SESSION['login'];
		connectDb($conn);
		$query = "SELECT * FROM annonceur WHERE login = '$login'";
		$result = $conn->query($query) or die ("SELECT error:" . $conn->error);
		$tuple = mysqli_fetch_object($result);
		display_user_info($tuple->annonceur_photo, $tuple->nom, $tuple->prenom, $tuple->mail, $tuple->ville, $tuple->telephone);
		$result->free();
		$conn->close();	
	}

//Ajouter id dans la balise tr Modifier 
	function display_user_annonces($id,$price, $title, $date, $nbrow , $idproduit){
		
		print"<tr>";
		print"<td> $id,$idproduit  <input type='hidden' name='$idprod' value='$idproduit' /> <input type='hidden' name='$nbrow' value='$id' /></td>";
		print "<td > $title , $price € , $date </td>";
		print "<td>
				<button type='submit' name ='remove_button' value='$id'>
						<img src='../img/remove.png'>
				</button>
			</td>";
		print "<td><button type='submit' name='update_button' value='$id'><img src='../img/settings.png'></button></td>";
		print"</tr>";
	}

	function get_user_annonces(){
		
		$id = $_SESSION['id'];
		connectDb($conn);
		$query = "SELECT DISTINCT a.id_annonce, a.id_produit, a.titre_annonce, a.prix, a.time_pub
					FROM annonce a , annonceur an , publier p
					WHERE a.id_annonceur = an.id_annonceur AND p.id_annonceur = a.id_annonceur
						AND an.id_annonceur = '$id' ";
		$result = $conn->query($query) or die("SELECT Error: ". $conn->error);
		print("<form method='POST' action='updateannonces.php'>");
		print("<table id='Annonce_table'  border=1>");
		print('<thead>
		        <tr>
		            <th scope="id">ID</th>
		            <th scope="infos">Infos</th>
		            <th scope="remove">Retirer</th>
		            <th scope="update">Modifier</th>
		        </tr>
   			 </thead>');
		//Passe dans le if quand l'utilisateur n'a pas d'annonce (bug)
		$nbrow = 0;
		if($result){
			while ($tuple = mysqli_fetch_object($result)){
			$nbrow++;
 			$dateFormat = date("Y-m-d",strtotime($tuple->time_pub));
 			display_user_annonces($tuple->id_annonce, $tuple->prix,$tuple->titre_annonce,$dateFormat, $nbrow ,$tuple->id_produit);
 			}
 			$_SESSION['nbrow'] = $nbrow;
		}else{
			print "<div><tr>";
			print "Qu'attendez vous pour publier des annonces !";
			print "</div></tr>";  	
		}
		print("</table>");
		print("</form>");

		$result->free();
		closeDb($conn);

	}


	function displayUserStats($categorie, $nbann){
		print"<tr>";
		print "<td> $categorie</td>";
		print "<td> $nbann</td>";
		print"</tr>";
	}



	function get_user_stats(){
		$id = $_SESSION['id'];
		connectDb($conn);
		//Ces publications dans chaque catégorie
		$query = "SELECT  a.id_annonceur, pr.categorie ,COUNT(p.id_annonceur) nbr_annonce FROM annonceur a , annonce an , publier p , produit pr WHERE a.id_annonceur = p.id_annonceur AND p.id_annonce = an.id_annonce AND pr.id_produit = an.id_produit GROUP BY a.id_annonceur, pr.categorie HAVING a.id_annonceur = '$id'";
		//Ses publications totales
		$query2 = "SELECT COUNT(*) as nb
					FROM publier p , annonceur an
					WHERE p.id_annonceur = an.id_annonceur
					GROUP BY an.id_annonceur
					HAVING an.id_annonceur = '$id'";
		

		$result = $conn->query($query) or die("SELECT Error: ".$conn->error);
		$result2 = $conn->query($query2) or die("SELECT Error: ".$conn->error);

		if($tupleNBAnnonce = mysqli_fetch_object($result2)){
			print("Vous avez publié:  $tupleNBAnnonce->nb annonce(s).<br>");
		
			print("Dans les catégorie suivantes: ");
			print("<table id=' Annonceur_stats' border=1 >");
		
			while ($tuplesAnnonces = mysqli_fetch_object($result)){
				displayUserStats($tuplesAnnonces->categorie, $tuplesAnnonces->nbr_annonce);
 			}

			print("</table>");
		}
 		else{
 			print "<div><tr>";
			print "Qu'attendez vous pour publier des annonces !";
			print "</div></tr>";  	
 		}

		$result->free();
		$result2->free();	
		closeDb($conn);
	}

?>