<?php 
	if (session_status() == PHP_SESSION_NONE) {
    session_start();
	}
	/*Debug
	*/
	error_reporting(-1);
	ini_set('display_errors', 'On');
	if (!defined('PROJECT_ROOT'))
	    define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);
	if (!defined('PROJECT_LIBS'))
    	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');
    //Get script dbconnection
	require_once(PROJECT_LIBS.'/app/dbconnection.php');
	$conn = null;
	$idann = $_SESSION['id'];
	//echo $_POST['cat'];
	if (!isset($_POST['cat'])) {
		$cat  = '' ;
	}else{
		$cat = $_POST['cat'];
	}
	
	
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['button_valider']) && $_POST['button_valider'] =='categorie'){
		//echo "<script> alert('if categorie'); </script>";
		$titre = $_POST['titre_annonce'];
		$prix = $_POST['prix_annonce'];
		$ville = $_POST['ville_annonce'];
		$etat = $_POST['etat'];//type_annonce
		$cat = $_POST['cat'];
		$description = $_POST['description'];
		$marque = $_POST['marque_annonce'];
		$modele = $_POST['modele_annonce'];
		$poids = floatval($_POST['poids_annonce']);
		$etatp = $_POST['etat_produit'];

	}else {
		//echo "<script> alert('else categorie'); </script>";
		$titre = '';
		$prix = '';
		$ville = '';
		$etat = '';
		$marque = '';
		$description = '';
		$modele = '';
		$poids = '';
		$etatp = '';
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['button_valider']) && $_POST['button_valider'] =='publier'){
		//echo "<script> alert('boutton valider'); </script>";
		connectDb($conn);
		$titre = $_POST['titre_annonce'];
		$prix = $_POST['prix_annonce'];
		$ville = $_POST['ville_annonce'];
		$etat = $_POST['etat'];//type_annonce
		$cat = $_POST['cat'];
		$description = $_POST['description'];
		$marque = $_POST['marque_annonce'];
		$modele = $_POST['modele_annonce'];
		$poids = floatval($_POST['poids_annonce']);
		$etatp = $_POST['etat_produit'];
		$img = upload();
		$nb_id_produit = $conn->query("SELECT * FROM produit") or die ("Erreur Select produit". $conn->error);
		$new_id_produit = $nb_id_produit->num_rows+1;
		/*Insertion du produit*/
		$conn->query("INSERT INTO produit (id_produit, marque , modele, poids, etat, categorie) VALUES ($new_id_produit , '$marque', '$modele' , '$poids' , '$etatp ', '$cat');") or die ("Erreur d'insertion produit" . $conn->error);

			/*Insertion dans la catégorie correspondante*/
		switch ($cat) {
			case "Appareil Photo":
				$resolution = $_POST['resolution_app'];
				$format = $POST['format_cap'];
				$def = $_POST['definition_app'];
				$mem= $_POST['memoire_app'];
				$ecran = $_POST['type_ecran_app'];
				$tech = $_POST['tech_app'];

				$conn->query("INSERT INTO  app_photo ( id_produit, resolution, format_cap, definition, type_memoire, type_ecran, tech) VALUES($new_id_produit, $resolution , '$format', '$mem' , '$ecran' , '$tech') ;") or die ("Erreur d'insertion Appareil Photo" . $conn->error);
				break;
			case "Accesoires":
				$conn->query("INSERT INTO accesoires (id_produit) VALUES ($new_id_produit);") or die("Erreur d'insertion Accesoires" . $conn->error);
				break;
			case "Téléphonie":
				$diag = $_POST['diagonale_tel'];
				$proc = $_POST['processeur_tel'];
				$ram = $_POST['ram_tel'];
				$taille = $_POST['taille_disque_tel'];
				$os = $_POST['os_produit'];
				$batterie = $_POST['batterie_tel'];
				$nb_sim = $_POST['nbsim'];
				$type_sim = $_POST['type_sim'];
				$resav = $_POST['ress_app_av'];
				$resar = $_POST['ress_app_ar'];
				$nfc = $_POST['nfc'];
				$conn->query("INSERT INTO telephonie (id_produit, diagonale, processeur, ram, taille_disque, os, batterie, nb_sim, type_sim, res_app_arr , res_app_avn,nfc) VALUES ($new_id_produit, '$diag', '$proc', '$ram', '$taille', '$os', '$batterie', '$nb_sim', '$type_sim', '$resav', '$resar', '$nfc');") or die("Erreur d'insertion Téléphonie" . $conn->error);

				break;
			case "PC":
				$diagonale = $_POST['diagonale_pc'];
				$proc = $_POST['processeur_pc'];
				$cg = $_POST['cg_pc'];
				$ram = $_POST['ram_pc'];
				$type =  $_POST['disque_pc'];
				$taille = $_POST['taille_disque_pc'];
				$bat = $_POST['batterie_pc'];
				$conn->query("INSERT INTO pc (id_produit, diagonale, processeur ,c_g , ram , type_disque, taille_disque, batterie) VALUES ($new_id_produit, $diagonale, '$processeur', '$cg', $ram, '$type', $taille, '$bat');") or die ("Erreur d'insertion PC" . $conn->error);

				break;
			case "TV":
				$diag  = $_POST['diagonale_tv'];
				$deftv = $_POST['definition_tv'];
				$os = $_POST['os_produit'];
				$tech = $_POST['technologie_tv'];
				$connectique = $_POST['connectique'];

				$conn->query("INSERT INTO tv (id_produit, diagonale, definition, tech, os ,connectique) VALUES ($new_id_produit, $diag, '$deftv', '$tech', '$os' ,'$connectique')
					;") or die ("Erreur d'insertion TV" . $conn->error);
				break;
			default:
				break;
		}

		/*Inserer l'annonce */
		/*Récup du numero annonce*/
		$nb_id_annonce= $conn->query("SELECT * FROM annonce");
		$new_id_annonce = $nb_id_annonce->num_rows+1;
		$date = date('Y-m-d H:i:s');
		$conn->query("INSERT INTO annonce ( id_annonce , titre_annonce , description, prix, ville, type_annonce, time_pub, id_annonceur, id_produit) VALUES ($new_id_annonce , '$titre', '$description', $prix ,'$ville', '$etat', '$date', $idann, $new_id_produit);") or die ("Erreur d'insertion Annonce" . $conn->error);
		/*	Inserer la photo */ 
		/*Recuperer l'id photo*/
		$nb_id_photo= $conn->query("SELECT * FROM photo");
		$new_id_photo = $nb_id_photo->num_rows+1;
		$conn->query("INSERT INTO photo(id_photo, id_annonce, photo) VALUES ($new_id_photo, $new_id_annonce," .
	"'" . addslashes ($img) . "');") or die ("Erreur d'insertion photo" . $conn->error);
		/*Inserer la publication corresspondant*/
		$conn->query("INSERT INTO publier (id_annonceur, id_annonce, date_publication) VALUES ($idann, $new_id_annonce, '$date');") or die ("Erreur d'insertion photo" . $conn->error);

		$nb_id_photo->free();
		$nb_id_annonce->free();
		$nb_id_produit->free();
		$conn->close();

	}
	
	/*Récuperer les données des photos*/
function upload(){
	$ret= false;
	$img_blob = '';
	$img_taille = 0;
	$img_type = '';
	$img_nom = '';
	$taille_max = 9000000;

	if ($_FILES['file'] > 0){
  		print("You have selected a file to upload");
  	}
	$ret = is_uploaded_file($_FILES['file']['tmp_name']);
	if (!$ret) {
		//print("Problème de transfert");
		return NULL;
	} else {
	// Le fichier a bien été reçu	
	$img_taille = $_FILES['file']['size'];
	if ($img_taille > $taille_max) {
		//print("Trop gros !");
		return NULL;
	}
	$img_type = $_FILES['file']['type'];
	$img_nom = $_FILES['file']['name'];
	$img_blob = file_get_contents ($_FILES['file']['tmp_name']);
		//echo $img_nom." est bien trasféré" . "\n";
	return $img_blob;
	}
}

	/*Afficher le fomulaire correspondant au produit*/
	function return_correct_form($cat){
		switch ($cat) {
			case 'Appareil Photo':
				print('
		       	<div>
		        	<label for="resolution">Resolution :</label>
        			<input type="text" id="resolution" name="resolution_app">
	   			</div>
	   			<div>
		        	<label for="format_cap">Format de capture :</label>
        			<input type="text" id="format_cap" name="format_cap" >
	   			</div>
	   			<div>
		        	<label for="definition">Definition :</label>
        			<input type="text" id="definition" name="definition_app" >
	   			</div>
	   			<div>
		        	<label for="memoire">Mémoire :</label>
        			<input type="text" id="memoire" name="memoire_app" >
	   			</div>
	   			<div>
		        	<label for="type_ecran_app">Type Ecran :</label>
        			<input type="text" id="type_ecran_app" name="type_ecran_app" >
	   			</div>
	   			<div>
		        	<label for="tech">Technologie:</label>
        			<input type="text" id="tech" name="tech_app" >
	   			</div>
	   			
');
				break;
			case 'Accessoires':
				break;
			case 'PC':
				print('		
		    
		       	<div>
		        	<label for="Diagonale">Diagonale :</label>
        			<input type="text" id="Diagonale" name="diagonale_pc">
	   			</div>
	   			<div>
		        	<label for="processeur">Processeur :</label>
        			<input type="text" id="processeur" name="processeur_pc" >
	   			</div>
	   			<div>
		        	<label for="cg">Graphique :</label>
        			<input type="text" id="cg" name="cg_pc" >
	   			</div>
	   			<div>
		        	<label for="ram">Ram :</label>
        			<input type="text" id="ram" name="ram_pc" >
	   			</div>
	   			<div>
		        	<label for="disque_pc">Type de disque :</label>
        			<input type="text" id="disque_pc" name="disque_pc" >
	   			</div>
	   			<div>
		        	<label for="taille_disque_pc">Taille du disque :</label>
        			<input type="text" id="taille_disque_pc" name="taille_disque_pc" >
	   			</div>
	   			<div>
		        	<label for="batterie_pc">Batterie:</label>
        			<input type="text" id="batterie_pc" name="batterie_pc" >
	   			</div>
');
				break;
			case 'Téléphonie':
				print('		
		
		       	<div>
		        	<label for="Diagonale">Diagonale :</label>
        			<input type="text" id="Diagonale" name="diagonale_tel">
	   			</div>
	   			<div>
		        	<label for="processeur">Processeur :</label>
        			<input type="text" id="processeur" name="processeur_tel" >
	   			</div>
	   			<div>
	   				<label for="os_produit">OS:</label>
		        	<select name="os_produit" form="tel_form">
					 	<option value="IOS">IOS</option>
			 		 	<option value="Android">Android</option>
					</select> 
	   			</div>
	   			<div>
		        	<label for="ram">Ram :</label>
        			<input type="text" id="ram" name="ram_tel" >
	   			</div>
	   			<div>
		        	<label for="batterie_tel">Autonomie :</label>
        			<input type="text" id="batterie" name="batterie_tel" >
	   			</div>
	   			<div>
		        	<label for="nbsim">Nombre de Sim:</label>
        			<input type="text" id="nbsim" name="nbsim" >
	   			</div>
	   			<div>
	   				<label for="type_sim">Type de Sim:</label>
		        	<select name="type_sim" form="tel_form">
					 	<option value="Sim" selected>SIM</option>
			 		 	<option value="Micro" >Micro</option>
					 	<option value="Nano">Nano</option>
					</select> 
	   			</div>
	   			<div>
		        	<label for="taille_disque_pc">Taille du disque :</label>
        			<input type="text" id="taille_disque_tel" name="taille_disque_tel" >
	   			</div>
	   			<div>
		        	<label for="ress_app_av">Resolution avant</label>
        			<input type="text" id="ress_app_av" name="ress_app_av" >
	   			</div>
	   				<div>
		        	<label for="ress_app_ar">Resolution arrière:</label>
        			<input type="text" id="ress_app_ar" name="ress_app_ar" >
	   			</div>
	   			<div>
	   				<label for="nfc">NFC:</label>
		        	<select name="nfc" form="tel_form">
					 	<option value="Yes">Oui</option>
			 		 	<option value="No" selected>Non</option>
					</select> 
	   			</div>
');
				break;
			case 'TV':
				print('		
				<div>
		        	<label for="definition_tv">Definition :</label>
        			<input type="text" id="definition_tv" name="definition_tv">
	   			</div>
	   			<div>
		        	<label for="diagonale_tv">Diagonale:</label>
        			<input type="text" id="diagonale_tv" name="diagonale_tv" >
	   			</div>
	   				<div>
	   				<label for="Etat">OS:</label>
		        	<select name="os_produit" >
					 	<option value ="none" selected> </option>
					 	<option value="SmartTV">SmartTV</option>
			 		 	<option value="Android">Android</option>
					</select> 
	   			</div>
	   			<div>
		        	<label for="technologie">Technologie :</label>
        			<input type="text" id="technologie" name="technologie_tv" >
	   			</div>
	   			<div>
		        	<label for="connectique">Connectique :</label>
        			<input type="text" id="connectique" name="connectique" >
	   			</div>
');
				break;
			
			default:
				break;
		}
	}
	
	
?>