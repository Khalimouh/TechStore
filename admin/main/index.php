<?php 
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if(!isset($_SESSION['admin'])){
	header("Location: ../login/login.php");
}
?>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="./index.css">
	<link rel="icon" href="/TechStore/app/img/logo.ico" />
	<title>Administrateur</title>
</head>
<body>
	<!-- -+-+-+-+-+-+-+-+-+- Header -+-+-+-+-+-+-+-+-+- -->
	<header> 
		<div id = "logo_header">
			<a href="/TechStore"><img src="/TechStore/app/img/logo.png"></a>
		</div>
		<div id="buttons_header">
			<button id="button_head_annonce" onclick="window.location.href =' /TechStore/admin/main';">Accueil</button>
			<button id="button_head_compte" onclick="window.location.href = '/TechStore/admin/login/logout.php';"><img src="/TechStore/app/img/logout.png"></button>
		</div>
		
	</header>

	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Navigator -+-+-+-+-+-+-+-+-+- -->
	<section id="section_main">
	<nav id="navigation_bar">
		<ul>
			<li><a href="/TechStore/admin/main">Accueil</a></li>
			<li><a href="/TechStore/admin/annonceurs">Annonceurs</a></li>
			<li><a href="/TechStore/admin/ads">Annonces</a></li>
		</ul>
		
	</nav>
	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Section Center-+-+-+-+-+-+-+-+-+- -->
	<section id="section_center">
		<h1>Annonces en attente de validation</h1>
		<?php require_once("../ads/ads_control.php");
			get_awaiting_ads();

		 ?>
		
	</section>
	
	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Section Right-+-+-+-+-+-+-+-+-+- -->
	<aside id="aside_right">
		
	</aside>
	</section>
	<!-- -+-+-+-+-+-+-+-+-+-+-+-+-+--+-+-+-+-+-+-+-+-+- -->
	<!-- -+-+-+-+-+-+-+-+-+- Footer -+-+-+-+-+-+-+-+-+- -->
	<footer>
           
           
        </footer>

</body>
</html>