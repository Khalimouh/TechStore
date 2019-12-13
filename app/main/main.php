<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="./main.css">
	<title>Main</title>
</head>
<body>
	<?php
	require_once("../dbconnection.php");
	$conn = null;
	connectDb($conn);
	$query = "SELECT annonceur_photo img FROM annonceur WHERE id_annonceur = 11";
	$result = $conn->query($query) or die ("Erreur img ".$conn->error);
	$tuple= mysqli_fetch_object($result);
	if($tuple->img)
		echo '<img src="data:image/jpeg;base64,'.base64_encode( $tuple->img ).'"/>';
	else echo '<img src="/TechStore/app/img/logo.png">';
	closeDb($conn);

	?>
</body>
</html>