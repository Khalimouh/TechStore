<?php
if (!defined('PROJECT_ROOT'))
	define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

if (!defined('PROJECT_LIBS'))
	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');


require_once(PROJECT_LIBS.'/app/dbconnection.php');
$conn = null;

if(isset($_POST['d_button'])){
		//echo "<script>window.open(
		//'../../app/ad/ad.php?id=".$_POST['d_button']."','_blank'); </script>";
		header("Location: ../../app/ad/ad.php?id=".$_POST['d_button']);
		exit;
}

if(isset($_POST['v_button'])){
		$id = $_POST['v_button'];
		$query = "UPDATE annonce SET etat_annonce = 'Validé' WHERE annonce.id_annonce = $id";
		connectDb($conn);
		
		if ($conn->query($query) === TRUE) {
			echo "<script>alert('Annonce ".$_POST['v_button']." a été validé!');
			location.href='../main';</script>";
 		   	exit;
		} else {
   			header("Location: ../main");
   			exit;
		}

		closeDb($conn);
		
}

function get_awaiting_ads(){

	connectDb($conn);
	$query = "SELECT a.id_annonce, a.id_produit, a.titre_annonce, a.prix,
	a.time_pub, a.etat_annonce
	FROM annonce a
	INNER JOIN annonceur an ON a.id_annonceur = an.id_annonceur
	WHERE a.etat_annonce = 'En attente'";
	$result = $conn->query($query) or die("SELECT Error: ". $conn->error);

	if($result){
		print("<form method='POST' action=../ads/ads_control.php>");
		print("<table id='Annonce_table'>");
		print('<thead>
			<tr>
			<th scope="id">ID</th>
			<th scope="infos">Infos</th>
			<th scope="details">Details</th>
			<th scope="validate">Valider</th>
			</tr>
			</thead>');
		
		while ($tuple = mysqli_fetch_object($result)){
			
			$dateFormat = date("Y-m-d",strtotime($tuple->time_pub));
			display_ads($tuple->id_annonce, $tuple->titre_annonce, $tuple->prix,$dateFormat, $tuple->etat_annonce);
		}

		print("</table>");
		print("</form>");

	}else{
		print "<div><tr>";
		print "Aucune annonce!";
		print "</div></tr>";  	
	}

	$result->free();
	closeDb($conn);

}


function display_ads($id, $titre_annonce, $prix, $date_pub, $etat_annonce){

	print"<tr>";
	print"<td>$id 
	<input type='hidden' name='id' value='$id' />
	</td>";
	print "<td > $titre_annonce, $prix, $date_pub, $etat_annonce </td>";
	print "<td>
	<button type='submit' name ='d_button' value='$id'>
	<img src='/TechStore/app/img/details.png'></button>
	</td>";
	if($etat_annonce == 'En attente')
		print "<td>
		<button type='submit' name ='v_button' value='$id'>
		<img src='/TechStore/app/img/validate.png'></button>
		</td>";
	else 
		print "<td>
		<button type='submit' name ='r_button' value='$id'>
		<img src='/TechStore/app/img/reject.png'></button>
		</td>";
	print"</tr>";
}

function get_ads(){

	connectDb($conn);
	$query = "SELECT a.id_annonce, a.id_produit, a.titre_annonce, a.prix,
	a.time_pub, a.etat_annonce
	FROM annonce a
	INNER JOIN annonceur an ON a.id_annonceur = an.id_annonceur";

	$result = $conn->query($query) or die("SELECT Error: ". $conn->error);

	if($result){
		print("<form method='POST' action=../ads/ads_control.php>");
		print("<table id='annonce_table'>");
		print('<thead>
			<tr>
			<th scope="id">ID</th>
			<th scope="infos">Infos</th>
			<th scope="details">Details</th>
			<th scope="etat">Action</th>
			</tr>
			</thead>');
		
		while ($tuple = mysqli_fetch_object($result)){
			
			$dateFormat = date("Y-m-d",strtotime($tuple->time_pub));
			display_ads($tuple->id_annonce, $tuple->titre_annonce, $tuple->prix,$dateFormat, $tuple->etat_annonce);
		}

		print("</table>");
		print("</form>");

	}else{
		print "<div><tr>";
		print "Aucune annonce!";
		print "</div></tr>";  	
	}

	$result->free();
	closeDb($conn);

}


?>