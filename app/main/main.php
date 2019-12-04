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
	
	?>

	<?php
		echo "<br>hello world<br>";
		closeDb($conn);

	?>
</body>
</html>