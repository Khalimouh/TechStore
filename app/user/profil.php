<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="../../index.css">
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
			<button id="button_head_compte" onclick="window.location.href = 'profil.php';"><img src="../img/icon_user.png"></button>
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
		<div id="section_title">Profil</div>
		<h3>Mes informations personelles</h3>
		<section id="section_recommanded_ads">
		<?php
			require_once("user_profile.php");
			get_user_info();	
		?>
		</section>
		<h3>Mes statistiques</h3>
		<section id="section_recommanded_ads">
			<?php
        		require_once("user_profile.php");
        		get_user_stats();
        	?>	
		</section>
		<h3>Mes annonces</h3>
		<section id="section_recommanded_ads">
			<?php
        		require_once("user_profile.php");
        		get_user_annonces();
        	?>	
		</section>

	<h4>Gestion du compte</h4>
	<table>
	<tr>
	<td>Modifier infos</td>
	<td>
	<section id="section_recommanded_ads">
		<button id="updateUser" onclick="window.location.href = 'updateUser.php';"><img src="../img/settings.png"></button>
	</section>
	</td>
	</tr>
	<tr>
	<td> Se déconnecter </td>
	<td>
	<section id="section_recommanded_ads">
		<button id="logout" onclick="window.location.href = '../login/logout.php';"><img src="../img/remove.png"></button>
	</section>
</td>
	</tr>
	</table>
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
