<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="../../index.css">
	<link rel="stylesheet" type="text/css" href="profile.css">
	<title>TechStore</title>
</head>
<body>
	<header> 
		<div id = "logo_header">
			<a href="../../index.php"><img src="../img/logo.png"></a>
		</div>
		<div id = "search_bar_header" >		
    		<form action="/TechStore/app/ads/ads_category.php">
      		<input type="text" placeholder="Chercher un produit, une marque..." name="search">
      		<button type="submit"><img src="../img/icon_search.png"></button>
    		</form>
		</div>
		<div id="buttons_header">
			<button id="button_head_annonce" onclick="window.location.href =' ../login/checkLoginAnnonce.php';">Deposer annonce</button>
			<button id="button_head_compte" onclick="window.location.href = 'profil.php';"><img src="../img/icon_user.png"></button>
			<button id="logout" onclick="window.location.href = '../login/logout.php';"><img src="../img/remove.png"></button>
		</div>
	</header>
<section id="section_main">
	<nav id="navigation_bar">
		<div id="section_title">Gestion</div>
		<ul>
			<li><a href="profil.php">Profil</a></li>
			<li><a href="updateUser.php">Modifier Coordonnées</a></li>
			<li><a href="mesannonces.php">Mes annonces</a></li>
		</ul>
	</nav>
	<section id="section_center">
		<div id="section_title">Profil</div>
		<h3>Mes informations personelles</h3>
		<section id="section_profil">
		<div style="height: 30vh;  display: flex;">
		<?php 
			require_once("getImage.php");
			GetImage();
		?>
		</div>
		<?php
			require_once("user_profile.php");
			get_user_info();	
		?>
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
            <?php echo "Bienvenue ". $_SESSION['login']. " !" ?>
        </footer>
	


</body>
</html>
