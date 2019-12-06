<html>
<head>
	<?php 
		require_once("../main/ads.php");
		require_once("./ads_control.php");

	?>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="ads_category.css">
	<title> Categorie </title>
</head>
<body>
	<header> 
		<div id = "logo_header">
			<a href="#"><img src="../img/logo.png"></a>
		</div>
		<div id = "search_bar_header" >		
    		<form action="/action_page.php">
      		<input type="text" placeholder="Chercher un produit, une marque..." name="search">
      		<button type="submit"><img src="../img/icon_search.png"></button>
    		</form>
		</div>
		<div id="buttons_header">
			<button id="button_head_annonce" onclick="addAnnonce()">Deposer annonce</button>
			<button id="button_head_compte" onclick="compte()"><img src="../img/icon_user.png"></button>
		</div>
	</header>

	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Footer -+-+-+-+-+-+-+-+-+- -->

	<section id="section_main">
	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Section Center-+-+-+-+-+-+-+-+-+- -->
	<section id="section_center">
		<div id="section_title">Annonces</div>
		<section id="section_popular_ads">
			<?php
				
				get_popular_ads(6, 'PC');
			?>
		</section>
			<section id="section_search_filter">
			<form method="get" action="<?=$_SERVER['PHP_SELF'];?>"  id="filter_form">
				<input type="text" name="keyword" placeholder="Mots clés" value="<?php echo $keyword; ?>">
				<input type="text" name="marque" placeholder="Marque" value="<?php echo $marque; ?>">
				<input type="text" name="modele" placeholder="Modèle" value="<?php echo $modele; ?>">
				<div style="display: flex; flex-direction: column;">
					<input form="filter_form" type="text" name="prix_min" placeholder="Prix min" value="<?php echo $prix_min; ?>">
					<input form="filter_form" type="text" name="prix_max" placeholder="Prix max" value="<?php echo $prix_max; ?>">
				</div>
				<div style="display: flex; flex-direction: column;">
					<input form="filter_form" type="text" name="poids_min" placeholder="Poids min" value="<?php echo $poids_min; ?>">
					<input form="filter_form" type="text" name="poids_max" placeholder="Poids max" value="<?php echo $poids_max; ?>">
				</div>
				<div style="display: flex; flex-direction: column;">
					<input form="filter_form" type="text" placeholder="Date de" 
					onfocus="(this.type='date')"  onblur="(this.type='text')" name="date_min" value="<?php echo $date_min; ?>">
					<input form="filter_form" type="text" placeholder="Date à" 
					onfocus="(this.type='date')"  onblur="(this.type='text')" name="date_max" value="<?php echo $date_max; ?>">
				</div>
				<select name ="etat" form="filter_form">
					<option value="" selected hidden><?php echo $etat=='' ? 'Etat' : $etat; ?></option>
					<option value="Neuf">Neuf</option>
  					<option value="Occasion">Occasion</option>
  					<option value="">Peu importe</option>
				</select> 
				<select name ="ville" form="filter_form">
					<option value="" selected hidden><?php echo $ville=='' ? 'Ville' : $ville; ?></option>
  					<option value="Paris">Paris</option>
					<option value="Lyon">Lyon</option>
					<option value="Marseille">Marseille</option>
					<option value="Toulouse">Toulouse</option>
					<option value="Caen">Caen</option>
					<option value="Bordeaux">Bordeaux</option>
					<option value="Montpellier">Montpellier</option>
					<option value="Rennes">Rennes</option>
					<option value="Nantes">Nantes</option>
					<option value="Lille">Lille</option>
					<option value="Strasbourg">Strasbourg</option>
					<option value="Versailles">Versailles</option>
					<option value="Creteil">Créteil</option>
					<option value="">Toute la france</option>

				</select>
				<select name ="urgence" form="filter_form">
					<option value="" selected hidden><?php echo $urgence=='' ? 'Urgence' : $urgence; ?></option>
  					<option value="Urgent">Urgent</option>
  					<option value="Non urgent">Non urgent</option>
  					<option value="">Peu importe</option>
				</select>
				<select name ="photos" form="filter_form">
					<option value="" selected hidden><?php echo $photos=='' ? 'Photos' : $photos; ?></option>
  					<option value="Avec photos">Avec photos</option>
  					<option value="Sans photos">Sans photos</option>
  					<option value="">Peu importe</option>
				</select>
				 
				<input type="submit" name="filterButton" value="Filtrer"></input>
				<input type="reset">
			</form>
			</section>
		<section id="section_ads">
			<?php
				
				get_ads_cat($keyword,'', $marque, $modele, $etat, $poids_min, $poids_max, $prix_min, $prix_max, $ville, $urgence, $date_min, $date_max, $photos);

			?>
		</section>
		
	</section>
	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Section Right-+-+-+-+-+-+-+-+-+- -->
	
	<aside id="aside_right">
		<div id="section_title">Statistiques</div>
		
	</aside>
	</section>


	<footer>
		<footer>
            <p>Copyright Zozor - Tous droits réservés<br />
            <a href="#">Me contacter !</a></p>
        </footer>
	</footer>
</body>
</html>