<?php 
	error_reporting(-1);
	
	// Connection BDD
	function connectDb(&$conn){		
		$conn = new mysqli('localhost', 'user' , 'user','techstore');
		if ($conn->connect_errno) {
			die ("Erreur de connexion : errno: " . $conn->errno . " error: ". $conn->error);
		}
		//echo "Connection succefully!";

	}

	function closeDb(&$conn){
		if(!mysqli_close($conn)){
			die ("Erreur de connexion : errno: " . $conn->errno . " error: ". $conn->error);
		//	echo "connection closed!";
		}

	}

?>