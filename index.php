<?php session_start(); ?> 
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="./index.css">
	<title>TechStore</title>
</head>
<body>
	<!-- -+-+-+-+-+-+-+-+-+- Header -+-+-+-+-+-+-+-+-+- -->
	<header> 
		<div id = "logo_header">
			<a href="#"><img src="./app/img/logo.png"></a>
		</div>
		<div id = "search_bar_header" >		
    		<form action="/action_page.php">
      		<input type="text" placeholder="Chercher un produit, une marque..." name="search">
      		<button type="submit"><img src="./app/img/icon_search.png"></button>
    		</form>
		</div>
		<div id="buttons_header">
			<button id="button_head_annonce" onclick="window.location.href =' ./app/login/checkLoginAnnonce.php';">Deposer annonce</button>
			<button id="button_head_compte" onclick="window.location.href = './app/login/checkLogin.php';"><img src="./app/img/icon_user.png"></button>
		</div>
	</header>

	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Navigator -+-+-+-+-+-+-+-+-+- -->
	<section id="section_main">
	<nav id="navigation_bar">
		<div id="section_title">Catégories</div>
		<ul>
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
        		get_popular_ads();
        	?>
        	
		</section>
			<h3>Annonces recommandées!</h3>
		<section id="section_recommanded_ads">
			<?php
        		require_once("./app/main/ads.php");
        		$limit = 1000;
        		get_popular_ads();
        	?>	
		</section>
		
	</section>
	
	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Section Right-+-+-+-+-+-+-+-+-+- -->
	<aside id="aside_right">
		<div id="section_title">Statistiques</div>
		<div>Classement par catégorie</div>
		<?php  
			require_once("./app/main/stats.php");
			getStatsCatg();

		?>
		<div>Classement par ville</div>
		<?php  
			getStatsVille();
		?>
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