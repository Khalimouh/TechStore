<?php
	require_once("../dbconnection.php");
	$conn = null;
	connectDb($conn);

	$result = $link->query( "SELECT * FROM birthdays" )
	or die("SELECT Error: ".$link->error);
	$num_rows = $result->num_rows;
	print "There are $num_rows records.<P>";
	print "<table width=200 border=1>\n";
	while ($get_info = $result->fetch_row()){ 
	print "<tr>\n";
	foreach ($get_info as $field) 
	print "\t<td><font face=arial size=1/>$field</font></td>\n";
	print "</tr>\n";
	}
	print "</table>\n";
	$result->free();


	closeDb($conn);



?>