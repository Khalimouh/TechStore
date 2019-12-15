<html>
		<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../../index.css">
		<link rel="stylesheet" type="text/css" href="form.css">
		<title>TechStore</title>
	</head>
	<body>
		<header> 
			<div id = "logo_header">
				<a href="../../index.php"><img src="../img/logo.png"></a>
			</div>
			<div id = "search_bar_header" >		
	    		<form action="/action_page.php">
	      		<input type="text" placeholder="Chercher un produit, une marque..." name="search">
	      		<button type="submit"><img src="../img/icon_search.png"></button>
	    		</form>
			</div>
			<div id="buttons_header">
				<button id="logout" onclick="window.location.href = '../login/logout.php' ;"><img src="../img/remove.png"></button>
				<button id="button_head_annonce" onclick="window.location.href =' ../login/checkLoginAnnonce.php';">Deposer annonce</button>
				<button id="button_head_compte" onclick="window.location.href = 'profil.php';"><img src="../img/icon_user.png"></button>
			</div>
		</header>
		<section id="section_main">
		<nav id="navigation_bar">
			<div id="section_title">Mes annonces </div>
			<ul>
				<li><a href="mesannonces.php">Mes annonces</a></li>
				<li><a href="updateUser.php">Modifier Coordonnées</a></li>
				<li><a href="profil.php">Profil</a></li>
			</ul>
		</nav>
		<section id="section_center">
		<div id="section_title">Modifier Annonce</div>
		<form action="update.php" method="post" id ="updateform" enctype="multipart/form-data">
		<div>
	        	<label for="Titre">Titre :</label>
	        	<input type="text" id="Titre" name="titre_annonce">
		    </div>
		    <div>
	        	<label for="Prix">Prix :</label>
	        	<input type="text" id="Prix" name="prix_annonce">
		    </div>
		    <div>
	        	<label for="Ville">Ville :</label>
	        	<input type="text" id="Ville" name="ville_annonce">
		    </div>
		  	<div class="type_annonce">
				<label for="monselectEtat">Etat:</label>
			 	<select name = "etat" id="monselectEtat"  form="updateform">
				  <option value="Urgent">Urgent</option>
				  <option value="Non Urgent">Non Urgent</option>
				</select> 
			</div>  
		    <div>
	    		<label for="Description">Description</label>
	       		<textarea  name="description" id="Description" rows="10" cols="25" form="updateform" ></textarea>       
	       </div>
	         <div>
	        	<label for="Marque">Marque :</label>
	        	<input type="text" id="Marque" name="marque_annonce" >
		    </div>
		    <div>
	        	<label for="Modéle">Modéle :</label>
	        	<input type="text" id="Modéle" name="modele_annonce">
		    </div>
		    <div>
	        	<label for="Poids">Poids :</label>
	        	<input type="text" id="Poids" name="poids_annonce" >

		    </div>
		    <div>
	        	<label for="Etat">Etat produit :</label>
	        	<select name="etat_produit" id="monselectetatproduit" form="updateform">
				  <option value="Neuf">Neuf</option>
				  <option value="Occasion">Occasion</option>
				</select> 
			</div>
			<?php  
				require_once("../Annonces/newAnnonce.php");
	        	return_correct_form($_SESSION['cat']);
			?>
		  	<div>
	        	<label for="file">Photo :</label>
	            <input type="hidden" name="MAX_FILE_SIZE" value="9000000" />
	            <input type="file" name="file" size=9000000 />
	        </div>
	        <div class="button" align="center">
	        <button type="submit"  name="modifier" value="modifier">Publier</button>
	        </div>

	</form>
		<section id="section_recommanded_ads">
		</section>
		</section>
		<aside id="aside_right">
			<div id="section_title">Statistiques</div>
			<?php  
				require_once("user_profile.php");
	        	get_user_stats();
			?>
		</aside>
		</section>
		<footer>
			<footer>
	          Bienvenu(e) !
		</footer>
		</body>
		</html>