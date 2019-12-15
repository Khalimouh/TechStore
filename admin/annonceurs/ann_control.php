<?php
if (!defined('PROJECT_ROOT'))
	define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

if (!defined('PROJECT_LIBS'))
	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');


require_once(PROJECT_LIBS.'/app/dbconnection.php');
$conn = null;

if(isset($_POST['d_button'])){
	header("Location: ../../app/annonceur/annonceur.php?id=".$_POST['d_button']);
	exit;
}


if(isset($_POST['r_button'])){
	$id = $_POST['r_button'];

	/*Suppression des tuples dans l'ordre inverse des insertion*/
	connectDb($conn);
	$result = $conn->query("SELECT id_annonce, id_produit 
		FROM annonce a WHERE id_annonceur = $id");
	while ($t = $result->fetch_object()) {

		/*Suppression de la publication*/
		$conn->query("DELETE FROM publier WHERE id_annonce = $t->id_annonce;") or die("Erreur de suppression publier" . $conn->error);
		
		/*Suppression des photo*/
		$conn->query("DELETE FROM photo WHERE id_annonce = $t->id_annonce;") or die("Erreur de suppression photo" . $conn->error);

		/*Suppression des consultation*/
		$conn->query("DELETE FROM consulter WHERE id_annonce = $t->id_annonce;") or die("Erreur de suppression consulter" . $conn->error);

		/*Suppression de l'annonce*/
		$conn->query("DELETE FROM annonce WHERE id_annonce = $t->id_annonce") or die("Erreur de suppression annonce" . $conn->error);

		$result_p = $conn->query("SELECT categorie
			FROM produit p
			WHERE a.id_produit = $t->id_produit ");
		$produit = $result_p->fetch_object();

		$result_p->free();
		/*Suppression de la catégorie*/
		switch ($produit->categorie) {
			case "Téléphonie":
			$conn->query("DELETE FROM telephonie   WHERE id_produit = $t->id_produit; ") or die("Erreur de suppression telephonie" . $conn->error);
			break;
			case "TV":
			$conn->query("DELETE FROM tv   WHERE id_produit = $t->id_produit;") or die("Erreur de suppression tv" . $conn->error);

			break;
			case "PC":
			$conn->query("DELETE FROM pc  WHERE id_produit = $t->id_produit;") or die("Erreur de suppression pc" . $conn->error);

			break;
			case "Accesoires":
			$conn->query("DELETE FROM accesoires WHERE id_produit = $t->id_produit;") or die("Erreur de suppression accesoires" . $conn->error);

			break;
			case "Appareil Photo":
			$conn->query("DELETE FROM app_photo  WHERE id_produit = $t->id_produit;") or die("Erreur de suppression app_photo" . $conn->error);

			break;
			default:

			break;
		}
		/*Suppression du produit*/
		$conn->query("DELETE FROM produit WHERE id_produit = $t->id_produit;") or die("Erreur de suppression produit" . $conn->error);
	}
	$result->free();

	$conn->query("DELETE FROM annonceur WHERE id_annonceur = $id") or die("Erreur de suppression annonceur");

	$conn->close();

	echo "<script>alert('Annonceur ".$_POST['r_button']." et toutes ses annonces ont été supprimés!');
			location.href='../annonceurs';</script>";
	exit;

}

function get_annonceurs(){

	connectDb($conn);
	$query = "SELECT a.id_annonceur, a.nom, a.prenom, a.ville,
	a.mail , a.telephone, DATE(a.time_access) date_ins
	FROM v_annonceur a";
	
	$result = $conn->query($query) or die("SELECT Error: ". $conn->error);

	if($result){
		print("<form method='POST' action=../annonceurs/ann_control.php>");
		print("<table id='annonce_table'>");
		print('<thead>
			<tr>
			<th scope="id">ID</th>
			<th scope="infos">Infos</th>
			<th scope="details">Details</th>
			<th scope="validate">Retirer</th>
			</tr>
			</thead>');
		
		while ($tuple = mysqli_fetch_object($result)){
			display_ann($tuple->id_annonceur, $tuple->nom, $tuple->prenom, $tuple->ville, $tuple->mail, $tuple->telephone, $tuple->date_ins);
		}

		print("</table>");
		print("</form>");

	}else{
		print "<div><tr>";
		print "Aucun annonceur!";
		print "</div></tr>";  	
	}

	$result->free();
	closeDb($conn);

}


function display_ann($id, $nom, $prenom, $ville, $mail, $telephone, $date_ins){

	print"<tr>";
	print"<td>$id 
	<input type='hidden' name='id' value='$id' />
	</td>";
	print "<td > $nom, $prenom, $ville, $mail, $telephone, $date_ins</td>";
	print "<td>
	<button type='submit' name ='d_button' value='$id'>
	<img src='/TechStore/app/img/details.png'></button>
	</td>";
	print "<td>
	<button type='submit' name ='r_button' value='$id'>
	<img src='/TechStore/app/img/reject.png'></button>
	</td>";
	print"</tr>";
}



?>