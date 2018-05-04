<?php
	/*
		Description: PHP code for NodeMCU project which inserts the date and two switch statuses into a MySQL database table.
		Create a table in a database with columns: "date" (text), "s1" (boolean), "s2" (boolean).
		
		Author: Matthew W. - www.mwhprojects.com - www.github.com/mwhprojects/NodeMCU-MySQL
	*/
	
	/* This PHP file is used to insert values into the database as well as display them on a webpage for you to view. The following PHP code at the top of this file is to get and insert values into the database, if the parameters are set in the URL. The PHP code later on is to display the values on the page. */
	// Get values.
	$pass = $_GET['pass'];
	$ii=5;
	date_default_timezone_set('America/Mexico_City');
	$date= date('Y-m-d H:i:s') ;
	$datey = date('Y');
	$datem = date('m');
	$dated = date('d');
	
	$dateh = date('G');
	$datei = date('i');
	$dates = date('s');
	
	//echo '<html>'

	// Set password. This is just to prevent some random person from inserting values. Must be consistent with YOUR_PASSCODE in Arduino code.
	$passcode = "123";
	
	// Check if password is right. (If there is no password, assume no data is trying to be entered and skip over this.)
	//if(isset($pass) && ($pass == $passcode)){
		
		//{"id":"10","date":"2018-04-04 02:01:12","s1":"1.00","s2":"1.00"}
		echo '[{"year":"'.$datey.'",';
		echo '"month":"'.$datem.'",';
		echo '"day":"'.$dated.'",';
		echo '"hour":"'.$dateh.'",';
		echo '"min":"'.$datei.'",';
		echo '"sec":"'.$dates.'"}]';
		//echo "{\"date\"\:\"".$date."\"
		// If all values are present, insert it into the MySQL database.
		
	//}
	//echo '</html>'
?>

 
		
	