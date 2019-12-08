<?php require_once("newAnnonce.php"); ?>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="../../index.css">
	<link rel="stylesheet" type="text/css" href="../user/form.css">
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
			<button id="button_head_annonce" onclick="window.location.href =' ../login/checkLoginAnnonce.php';">Deposer annonce</button>
			<button id="button_head_compte" onclick="window.location.href = '../user/profil.php';"><img src="../img/icon_user.png"></button>
		</div>
	</header>
<section id="section_main">
	<nav id="navigation_bar">
		<div id="section_title">Catégories</div>
		<ul>
  		<?php
  			require_once("../main/category.php");
  			getCategories();
  		?>
		</ul>
	</nav>
	<section id="section_center">
	<div id="section_title">Déposer annonce</div>
	<form action="<?=$_SERVER['PHP_SELF'];?>" method="post" id ="updateform" enctype="multipart/form-data" >
	    
		<div>
        	<label for="Titre">Titre :</label>
        	<input type="text" id="Titre" name="titre_annonce" value="<?php echo $titre_annonce; ?>">
	    </div>
	    <div>
        	<label for="Prix">Prix :</label>
        	<input type="text" id="Prix" name="prix_annonce" value="<?php echo $prix_annonce; ?>">
	    </div>
	    <div>
        	<label for="Ville">Ville :</label>
        	<input type="text" id="Ville" name="ville_annonce"value="<?php echo $ville_annonce; ?>">
	    </div>
	  	<div class="type_annonce">
			<label for="monselectEtat">Etat:</label>
		 	<select name = "etat" id="monselectEtat" value="<?php echo $etat; ?>" form="updateform">
		 	  <option value="noval" ></option> 
			  <option value="Urgent">Urgent</option>
			  <option value="Non Urgent">Non Urgent</option>
			</select> 
		</div>  

	    <div>
    		<label for="Description">Description</label>
       		<textarea on name="description" id="Description" rows="10" cols="25" form="updateform"></textarea>       
       </div>
		<div class="Catégories">
			<label for="Catégorie">Catégorie:</label>
		 	<select name="cat" id="monselectcategorie" value="<?php echo $cat; ?>" form="updateform" onchange="this.form.submit();">
		 	  <option value="" selected hidden><?php echo $tmpcategorie == "" ? "" : $tmpcategorie ?></option> 
			  <option value="Appareil Photo">Appareil Photo</option>
			  <option value="Accesoires">Acessoires</option>
			  <option value="PC" >PC</option>
			  <option value="Téléphonie">Téléphonie</option> 
			  <option value="TV">Télévision</option>
			</select> 
		</div> 
		<div>
        	<label for="Marque">Marque :</label>
        	<input type="text" id="Marque" name="marque_annonce" value="<?php echo $marque_annonce; ?>">
	    </div>
	    <div>
        	<label for="Modéle">Modéle :</label>
        	<input type="text" id="Modéle" name="modele_annonce" value="<?php echo $modele_annonce; ?>">
	    </div>
	    <div>
        	<label for="Poids">Poids :</label>
        	<input type="text" id="Poids" name="poids_annonce" value="<?php echo $poids_annonce; ?>">

	    </div>
	    <div>
        	<label for="Etat">Etat produit :</label>
        	<select name="etat_produit" id="monselectetatproduit" value="<?php echo $etat_produit; ?>" form="updateform">
			  <option value="Neuf">Neuf</option>
			  <option value="Use">Usé</option>
			</select> 

	    </div>      
		<?php
	    	return_correct_form($tmpcategorie);

	    ?>
       	<div>
        	<label for="file">Photo :</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
            <input type="file" name="file" size=3500000 />
        </div>
    	<div class="button" align="center">
        <button type="submit" name="Publish" value="publier">Publier</button>
   		 </div>
	</form>
	</section>
	<aside id="aside_right">
		<div id="section_title">Statistiques</div>
		<?php  
			require_once("../main/stats.php");
			getStatsCatg();
		?>
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