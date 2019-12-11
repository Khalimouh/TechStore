	<?php 
		require_once("../user/newuser.php");
		require_once("../main/ads.php");
		require_once("../ads/ads_control.php");
		require_once("./ad_control.php");
	?>
<html>
<head>
	<meta charset="utf-8">
	<!--<meta http-equiv="Refresh" content="0; url=https://www.w3docs.com" /> -->
	<link rel="stylesheet" type="text/css" href="ad.css">
	<link rel="icon" href="/TechStore/app/img/logo.ico" />
	<title><?php echo $titre; ?></title>
</head>
<body>
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
			<button id="button_head_annonce" onclick="window.location.href =' ../login/checkLoginAnnonce.php';">Deposer annonce</button>
			<button id="button_head_compte" onclick="window.location.href = '../login/checkLogin.php';"><img src="../img/icon_user.png"></button>
		</div>
	</header>

	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Footer -+-+-+-+-+-+-+-+-+- -->

	<section id="section_main">
	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Section Center-+-+-+-+-+-+-+-+-+- -->
	<form >
		<input type="hidden" name="id" value="">
		<input type="hidden" name="titre">
		<input type="hidden" name="cat">
		<input type="hidden" name="marque">
		<input type="hidden" name="model">
	</form>
	<section id="section_center">
		<?php getAd();  ?>
		<h2>Annonces similaires</h2>
		<section id="section_popular_ads">
			<?php
			    get_popular_ads(6,$_GET["cat"],$_GET["marque"],$_GET["modele"], $_GET["id"]);
			?>
		</section>
	</section>
	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Section Right-+-+-+-+-+-+-+-+-+- -->
	
	<aside id="aside_right">
		<div id="section_title">Statistiques</div>
		<div>Classement par catégorie</div>
		<?php  
			require_once("../main/stats.php");
			getStatsCatg();

		?>
		<div>Classement par ville</div>
		<?php  
			getStatsVille();
		?>
	</aside>
	</section>


	
		<footer>
            <p> <?php echo $_SESSION['id']," ",$_SESSION['user']; ?> <br />
           
        </footer>
	
</body>
</html>