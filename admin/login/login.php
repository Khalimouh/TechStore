<html>
<head>
	<link rel="stylesheet" type="text/css" href="login.css">
	<meta charset="utf-8">
	<title>Connexion</title>
</head>
<body>
    <div id = "logo_header" align="center">
            <a href="#"><img src="/TechStore/app/img/logo.png"></a>
    </div>

	<form method="post" action="checklogin.php">
		<div>
        	<label for="Login">Login :</label>
        	<input required type="text" id="Login" name="login">
    	</div>
    	<div>
        	<label for="Password">Password :</label>
        	<input required type="password" id="Password" name="pass">
    	</div>
    	
    	<div class="button" align="center">
        	<button type="submit">Se connecter</button>
   	    </div>
    	
   	</form>
</body>
</html>