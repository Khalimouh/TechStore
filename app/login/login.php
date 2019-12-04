<?php

error_reporting(-1);
ini_set('display_errors', 'On');

$login = $_POST['annonceur_login'];
$password = $_POST['annonceur_password'];
$link = new mysqli('localhost', 'user', 'user', 'techstore');
	if ($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error:" .$link->error);
	}
$resultat = $link->query("SELECT id_annonceur, password FROM annonceur WHERE login = '$login'")or die("SELECT Error: " . $link->error);

/*
print "Il y a $num_rows lignes.<br/>";
$num_rows = $resultat->num_rows;
print "<table width=200 border=1>\n";
while ($get_info = $resultat->fetch_row()){
	print "<tr>\n";
	foreach ($get_info as $field)
	print "\t<td>$field</td>\n";
	print "</tr>\n";
}
print "</table>\n";
*/

$get_info = $resultat->fetch_row();

$isPasswordCorrect = password_verify($password, $get_info[1]);
if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
    header("Location: login.html");
}
else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $get_info[0];
        $_SESSION['login'] = $login ;
        echo 'Vous êtes connecté !';
        //header("Location: logout.php");
    }
    else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}

?>