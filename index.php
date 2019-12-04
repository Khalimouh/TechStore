<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="./index.css">
	<title>TechStore</title>
</head>
<body>
	<!-- -+-+-+-+-+-+-+-+-+- Header -+-+-+-+-+-+-+-+-+- -->
	<header> 
		<div id = "logo_header"> <h2> Image </h2></div>
		<div id = "search_bar_header" >		
    		<form action="/action_page.php">
      		<input type="text" placeholder="Chercher un produit, une marque..." name="search">
      		<button type="submit"><i class="button_search"></i></button>
    		</form>
		</div>
		<div id="buttons_header"><h2>B2</h2></div>
	</header>
	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Navigator -+-+-+-+-+-+-+-+-+- -->
	<section id="section_main">
	<nav id="navigation_bar">
		<div id="section_title">Catégories</div>
		<ul>
		<li><a href="#" class="active">Home</a></li>
  		<?php
  			require_once("./app/main/category.php");
  			getCategories();
  		?>
		</ul>
	</nav>
	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Section Center-+-+-+-+-+-+-+-+-+- -->
	<section id="section_center">
		<div id="section_title">Annonces</div>
		<h3>Annonces populaires</h3>
		<section id="section_popular_ads">
			<?php
        		require_once("./app/main/ads.php");
        		get_ads();
        	?>
        	
		</section>
			<h3>Annonces recommandées!</h3>
		<section id="section_recommanded_ads">
			<?php
        		require_once("./app/main/ads.php");
        		get_ads();
        	?>	
		</section>
		
	</section>
	
	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Section Right-+-+-+-+-+-+-+-+-+- -->
	<aside id="aside_right">
		<div id="section_title">Statistiques</div>
		<div>
			<h1>À propos de l'auteur</h1>
            <p>C'est moi, Zozor ! Je suis né un 23 novembre 2005.</p>
        </div>
        <div>
			<h1>À propos de l'auteur</h1>
            <p>C'est moi, Zozor ! Je suis né un 23 novembre 2005.</p>
        </div>
        <div>
			<h1>À propos de l'auteur</h1>
            <p>C'est moi, Zozor ! Je suis né un 23 novembre 2005.</p>
        </div>
	</aside>
	</section>
	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Footer -+-+-+-+-+-+-+-+-+- -->
	<footer>
		<footer>
            <p>Copyright Zozor - Tous droits réservés<br />
            <a href="#">Me contacter !</a></p>
        </footer>
	</footer>

</body>
</html>