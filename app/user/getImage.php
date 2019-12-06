<?php
  if (!defined('PROJECT_ROOT'))
      define('PROJECT_ROOT',$_SERVER['DOCUMENT_ROOT']);

  if (!defined('PROJECT_LIBS'))
      define('PROJECT_LIBS', PROJECT_ROOT . '/TechStore');

    //Get script dbconnection
  require_once(PROJECT_LIBS.'/app/dbconnection.php');
  $conn = null;
  $id = $_GET['id'];
  // do some validation here to ensure id is safe
  connectDb($conn);
 

  $sql = "SELECT annonceur_photo FROM annonceur WHERE id_annonceur = $id";
  $result = $conn->query("$sql");
  

  header("Content-type: image/jpeg");
  echo $row['dvdimage'];
?>