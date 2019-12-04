<?php

$login = $_POST['annonceur_login'];
$password = $_POST['annonceur_password'];
$link = new mysqli('localhost', 'user', 'user', 'techstore');
	if ($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error:" .$link->error);
	}
$resultat = $link->query("SELECT * FROM annonceur WHERE login = '$login'")or die("SELECT Error: " . $link->error);


$num_rows = $result->num_rows;
print "Il y a $num_rows lignes.<br/>";
print "<table width=200 border=1>\n";
while ($get_info = $result->fetch_row()){
print "<tr>\n";
foreach ($get_info as $field)
print "\t<td>$field</td>\n";
print "</tr>\n";
}
print "</table>\n";


/*
$isPasswordCorrect = password_verify($password, $resultat['password']);
if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $resultat['id_user'];
        $_SESSION['login'] = $pseudo;
        echo 'Vous êtes connecté !';
    }
    else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}
*/

?>