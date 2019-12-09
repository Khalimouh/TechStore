<?php
	session_start();
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

	if (!isset($_POST['cat'])) {
		$cat  = '' ;
	}else{
		$cat = $_POST['cat'];
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['button_valider']) && $_POST['button_valider'] =='categorie'){
		echo "<script> alert('if categorie'); </script>";
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
		echo "<script> alert('else categorie'); </script>";
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
		echo "<script> alert('boutton valider'); </script>";
	}
	
	/*Récuperer les données des photos*/
	/*
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
		print("Problème de transfert");
		return false;
	} else {
	// Le fichier a bien été reçu	
	$img_taille = $_FILES['file']['size'];
	if ($img_taille > $taille_max) {
		print("Trop gros !");
		return false;
	}
	$img_type = $_FILES['file']['type'];
	$img_nom = $_FILES['file']['name'];
	$img_blob = file_get_contents ($_FILES['file']['tmp_name']);
		echo $img_nom." est bien trasféré" . "\n";
	}
	*/


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