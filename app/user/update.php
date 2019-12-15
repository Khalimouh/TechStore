<?php 
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	error_reporting(-1);
	ini_set('display_errors', 'On');

	if (!defined('PROJECT_ROOT'))
		define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

	if (!defined('PROJECT_LIBS'))
	   	define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');

	require_once(PROJECT_LIBS.'/app/dbconnection.php');
	//require_once('UpdateUser.php');
	
	function upload(){
	$ret= false;
	$img_blob = '';
	$img_taille = 0;
	$img_type = '';
	$img_nom = '';
	$taille_max = 9000000;

	if ($_FILES['file'] > 0){
  		//print("You have selected a file to upload");
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

	$conn = null;
	connectDb($conn);
	/*Récuperation des informations de modification*/
	$id = $_SESSION['id'];
	$idannonce = $_SESSION['idannonce'];
	$titre = $_POST['titre_annonce'];
	$prix = $_POST['prix_annonce']; 
	$ville = $_POST['ville_annonce'];
	$etata = $_POST['etat'];
	$cat = $_SESSION['cat'];
	$poids = $_POST['poids_annonce'];
	$desc = $_POST['description'];
	$modele = $_POST['modele_annonce'];
	$marque = $_POST['marque_annonce'];
	$etatp = $_POST['etat_produit'];
	$img = upload();
	print($titre);
	/*Modification des tables de la base */
	connectDB($conn);
	/*Modification de l'annonce*/
	if(!empty($titre)){
		$result  = $conn->query("UPDATE annonce
		SET titre_annonce = '$titre'
		WHERE id_annonce = '$idannonce'");
	}if(!empty($prix)){
		$result  = $conn->query("UPDATE annonce
		SET prix = '$prix'
		WHERE id_annonce = '$idannonce'");
	}if(!empty($ville)){
		$result  = $conn->query("UPDATE annonce
		SET ville = '$ville'
		WHERE id_annonce = '$idannonce'");
	}if(!empty($etata)){
		$result  = $conn->query("UPDATE annonce
		SET type_annonce = '$etatp'
		WHERE id_annonce = '$idannonce'");
	}if(!empty($desc)){
		$result  = $conn->query("UPDATE annonce
		SET description = '$desc'
		WHERE id_annonce = '$idannonce'");
	}
	/*Modificationd de la photo*/
	if($img){
		$result  = $conn->query("UPDATE photo
		SET photo = '" . addslashes ($img) . "'
		WHERE id_annonce = '$idannonce'");
	}
	/*Modification du produit*/
	$result = $conn->query("SELECT p.id_produit, p.categorie
				FROM annonce a, produit p
				WHERE a.id_produit = p.id_produit
				AND a.id_annonce = $idannonce;");
	$produit = $result->fetch_object();
	if(!empty($marque)){
		$result  = $conn->query("UPDATE produit
		SET marque = '$marque'
		WHERE id_produit = '$produit->id_produit'");
	}if(!empty($modele)){
		$result  = $conn->query("UPDATE produit
		SET modele = '$modele'
		WHERE id_produit = '$produit->id_produit'");
	}if(!empty($etatp)){
		$result  = $conn->query("UPDATE produit
		SET etat = '$etatp'
		WHERE id_produit = '$produit->id_produit'");
	}if(!empty($poids)){
		$result  = $conn->query("UPDATE produit
		SET poids = '$poids'
		WHERE id_produit = '$produit->id_produit'");
	}

	/*Modification de la catégorie*/
	switch ($cat) {
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
				if ($nfc == "OUI" || $nfc == "Oui" ||$nfc == "oui") {
						$nfc = 1;
				}else{
					$nfc = 0;
				}
				if(!empty($diag)){
					$result  = $conn->query("UPDATE telephonie
					SET diagonale = '$diag'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($proc)){
					$result  = $conn->query("UPDATE telephonie
					SET processeur = '$proc'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($ram)){
					$result  = $conn->query("UPDATE telephonie
					SET ram = '$ram'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($taille)){
					$result  = $conn->query("UPDATE telephonie
					SET taille_disque = '$taille'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($os)){
					$result  = $conn->query("UPDATE telephonie
					SET os = '$os'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($batterie)){
					$result  = $conn->query("UPDATE telephonie
					SET batterie = '$batterie'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($nb_sim)){
					$result  = $conn->query("UPDATE telephonie
					SET nb_sim = '$nb_sim'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($type_sim)){
					$result  = $conn->query("UPDATE telephonie
					SET type_sim = '$type_sim'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($resav)){
					$result  = $conn->query("UPDATE telephonie
					SET ress_app_av = '$resav'
					WHERE id_produit = '$produit->id_produit'");
				}
				if(!empty($resar)){
					$result  = $conn->query("UPDATE telephonie
					SET ress_app_arr = '$resar'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($nfc)){
					$result  = $conn->query("UPDATE telephonie
					SET nfc = '$nfc'
					WHERE id_produit = '$produit->id_produit'");
				}
				break;
			case "TV":
				$diag  = $_POST['diagonale_tv'];
				$deftv = $_POST['definition_tv'];
				$os = $_POST['os_produit'];
				$tech = $_POST['technologie_tv'];
				$connectique = $_POST['connectique'];
				if(!empty($diag)){
					$result  = $conn->query("UPDATE tv
					SET diagonale = '$diagonale'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($deftv)){
					$result  = $conn->query("UPDATE tv
					SET definition = '$deftv'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($tech)){
					$result  = $conn->query("UPDATE tv
					SET tech = '$tech'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($os)){
					$result  = $conn->query("UPDATE tv
					SET os = '$od'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($diagonale)){
					$result  = $conn->query("UPDATE tv
					SET diagonale = '$diagonale'
					WHERE id_produit = '$produit->id_produit'");
				}
				break;
			case "PC":
				$diagonale = $_POST['diagonale_pc'];
				$proc = $_POST['processeur_pc'];
				$cg = $_POST['cg_pc'];
				$ram = $_POST['ram_pc'];
				$type =  $_POST['disque_pc'];
				$taille = $_POST['taille_disque_pc'];
				$bat = $_POST['batterie_pc'];
				if(!empty($diagonale)){
					$result  = $conn->query("UPDATE pc
					SET diagonale = '$diagonale'
					WHERE id_produit = '$produit->id_produit'");
				}
				if(!empty($proc)){
					$result  = $conn->query("UPDATE pc
					SET processeur = '$proc'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($cg)){
					$result  = $conn->query("UPDATE pc
					SET c_g = '$cg'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($ram)){
					$result  = $conn->query("UPDATE pc
					SET ram = '$ram'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($type)){
					$result  = $conn->query("UPDATE app_photo
					SET type_disque = '$type'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($taille)){
					$result  = $conn->query("UPDATE app_photo
					SET taille_disque = '$taille'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($bat)){
					$result  = $conn->query("UPDATE app_photo
					SET batterie = '$bat'
					WHERE id_produit = '$produit->id_produit'");
				}

				break;
			case "Accesoires":
				break;
			case "Appareil Photo":
				$resolution = $_POST['resolution_app'];
				$format = $POST['format_cap'];
				$def = $_POST['definition_app'];
				$mem= $_POST['memoire_app'];
				$ecran = $_POST['type_ecran_app'];
				$tech = $_POST['tech_app'];
				if(!empty($resolution)){
					$result  = $conn->query("UPDATE app_photo
					SET resolution = '$resolution'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($format)){
					$result  = $conn->query("UPDATE app_photo
					SET format_cap = '$format'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($def)){
					$result  = $conn->query("UPDATE app_photo
					SET definition = '$def'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($mem)){
					$result  = $conn->query("UPDATE app_photo
					SET type_memoire = '$mem'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($ecran)){
					$result  = $conn->query("UPDATE app_photo
					SET type_ecran = '$ecran'
					WHERE id_produit = '$produit->id_produit'");
				}if(!empty($tech)){
					$result  = $conn->query("UPDATE app_photo
					SET tech = '$tech'
					WHERE id_produit = '$produit->id_produit'");
				}
				break;		
			default:
				break;
		}

		header("Location: mesannonces.php");
?>