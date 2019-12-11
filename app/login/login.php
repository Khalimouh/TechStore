<?php

error_reporting(-1);
ini_set('display_errors', 'On');
if (!defined('PROJECT_ROOT'))
    define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

if (!defined('PROJECT_LIBS'))
    define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');


require_once(PROJECT_LIBS.'/app/dbconnection.php');
$conn = null;


$login = $_POST['annonceur_login'];
$password = $_POST['annonceur_password'];

connectDb($conn);
$resultat = $conn->query("SELECT id_annonceur, password FROM annonceur WHERE login = '$login'")or die("SELECT Error: " . $conn->error);


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
        if (session_status() == PHP_SESSION_NONE) {
           session_start();
        }
        $_SESSION['id'] = $get_info[0];
        $_SESSION['login'] = $login ;
        $_SESSION['user'] = 'Annonceur';
        
           echo 'Vous êtes connecté !';
        header("Location: ../user/profil.php");
        exit;
    }
    else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}

$resultat->free();
$conn->close();

?>