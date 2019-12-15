<?php require_once("./app/user/newuser.php"); ?> 
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="./index.css">
	<link rel="icon" href="/TechStore/app/img/logo.ico" />
	<title>TechStore</title>
</head>
<body>
	<!-- -+-+-+-+-+-+-+-+-+- Header -+-+-+-+-+-+-+-+-+- -->
	<header> 
		<div id = "logo_header">
			<a href="/TechStore"><img src="./app/img/logo.png"></a>
		</div>
		<div id = "search_bar_header" >		
    		<form action="/TechStore/app/ads/ads_category.php">
      		<input type="text" placeholder="Chercher un produit, une marque..." name="keyword">
      		<button type="submit"><img src="./app/img/icon_search.png"></button>
    		</form>
		</div>
		<div id="buttons_header">
			<button id="button_head_annonce" onclick="window.location.href =' ./app/login/checkLoginAnnonce.php';">Deposer annonce</button>
			<button id="button_head_compte" onclick="window.location.href = './app/login/checkLogin.php';"><img src="./app/img/icon_user.png"></button>
			<?php require("./app/main/logout_print.php"); ?>
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
		<div class="title_right">Classement par catégorie</div>
		<?php  
			require_once("./app/main/stats.php");
			getStatsCatg();

		?>
		<div class="title_right">Classement par ville</div>
		<?php  
			getStatsVille();
		?>
		
	</aside>
	</section>
	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Footer -+-+-+-+-+-+-+-+-+- -->
	<footer>
           <div><h2>Visiteurs : <?php echo getNumberVisitors(); ?></h2></div>
           
        </footer>

</body>
</html>