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
	<form action="newAnnonce.php" method="POST" id ="updateform" enctype="multipart/form-data" >
		<div>
        	<label for="Titre">Titre :</label>
        	<input type="text" id="Titre" name="titre_annonce">
	    </div>
	    <div>
        	<label for="Prix">Prix :</label>
        	<input type="text" id="Prix" name="titre_annonce">
	    </div>
	    <div>
        	<label for="Ville">Ville :</label>
        	<input type="text" id="Ville" name="titre_annonce">
	    </div>
	  	<div class="type_annonce">
			<label for="Catégorie">Catégorie:</label>
		 	<select id="monselect">
		 	  <option value="noval" selected></option> 
			  <option value="Urgent">Urgent</option>
			  <option value="Non Urgent">Non Urgent</option>
			</select> 
		</div>  

	    <div>
    		<label for="ameliorer">Description</label>
       		<textarea name="ameliorer" id="ameliorer" rows="10" cols="25"></textarea>       
       </div>
		<div class="Catégories">
			<label for="Catégorie">Catégorie:</label>
		 	<select id="monselect">
		 	  <option value="noval" selected></option> 
			  <option value="app_photo">Appareils Photo</option>
			  <option value="accesoires">Acessoires</option>
			  <option value="pc" >PC</option>
			  <option value="telephonie">Téléphonie</option> 
			  <option value="tv">Télévision</option>
			</select> 
		</div> 
		<div>
        	<label for="Marque">Marque :</label>
        	<input type="text" id="Marque" name="titre_annonce">
	    </div>
	    <div>
        	<label for="Modéle">Modéle :</label>
        	<input type="text" id="Modéle" name="titre_annonce">
	    </div>
	    <div>
        	<label for="Poids">Poids :</label>
        	<input type="text" id="Poids" name="titre_annonce">
	    </div>
	    <div>
        	<label for="Etat">Etat :</label>
        	<input type="text" id="Etat" name="titre_annonce">
	    </div>      


       	<div>
        	<label for="file1">Photo 1:</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
            <input type="file" name="file1" size=3500000 />
        </div>
        <div>
        	<label for="file2">Photo 2:</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
            <input type="file" name="file2" size=3500000 />
        </div>

    	<div class="button" align="center">
        <button type="submit">Publier</button>
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