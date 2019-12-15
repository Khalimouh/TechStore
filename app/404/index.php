<?php session_start(); ?> 
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="./index.css">
	<title>Page n'existe plus</title>
</head>
<body>
	<!-- -+-+-+-+-+-+-+-+-+- Header -+-+-+-+-+-+-+-+-+- -->
	<header> 
		<div id = "logo_header">
			<a href="/TechStore"><img src="/TechStore/app/img/logo.png"></a>
		</div>
		<div id = "search_bar_header" >		
    		<form action="/TechStore/app/ads/ads_category.php">
      		<input type="text" placeholder="Chercher un produit, une marque..." name="keyword">
      		<button type="submit"><img src="/TechStore/app/img/icon_search.png"></button>
    		</form>
		</div>
		<div id="buttons_header">
			<button id="button_head_annonce" onclick="window.location.href =' /TechStore/app/login/checkLoginAnnonce.php';">Deposer annonce</button>
			<button id="button_head_compte" onclick="window.location.href = '/TechStore/app/login/checkLogin.php';"><img src="/TechStore/app/img/icon_user.png"></button>
			<?php require("../main/logout_print.php"); ?>
		</div>
	</header>

	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Navigator -+-+-+-+-+-+-+-+-+- -->
	<section id="section_main">
		<section id="section_center">
		<div>
			<span style="font-size:  100px;">Oups !</span>	
			<br><br>
			<span style="font-size: 40px;">désolé, cette page n'existe pas ou plus...</span>
		</div>
		<img src="/TechStore/app/img/404.png">
		
		</section>
		
	
	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Section Right-+-+-+-+-+-+-+-+-+- -->
	<aside id="aside_right">
		<div id="section_title">Statistiques</div>
		<div class="title_right">Classement par catégorie</div>
		<?php  
			require_once("../main/stats.php");
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
		<footer>
            
        </footer>
	</footer>

</body>
</html>