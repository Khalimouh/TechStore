<?php
  if (session_status() == PHP_SESSION_NONE)
      session_start();


  if (!defined('PROJECT_ROOT'))
      define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

  if (!defined('PROJECT_LIBS'))
      define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');

  error_reporting(-1);
  ini_set('display_errors', 'On');
    //Get script dbconnection
  require_once(PROJECT_LIBS.'/app/dbconnection.php');
  $conn = null;
  // do some validation here to ensure id is safe
  function GetImage(){
  $id = $_SESSION['id'];
  connectDb($conn);
 

  $sql = "SELECT annonceur_photo FROM annonceur WHERE id_annonceur = '$id'";
  $result = $conn->query("$sql");
  $bin = $result->fetch_object();
  ShowImage($bin->annonceur_photo);

  }

  function ShowImage($binimage){
    print '<img src="data:image/jpeg;base64,'.base64_encode( $binimage ).'"/>';
  }

 

?>