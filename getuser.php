<?php
	/*
		name : getuser.php
		Author : Sasidhar Pasupuleti 
		Project LightBlu*/
	/*	
	name : getuser.php
	gets users for the given device id- called by device
	http://ec2-13-211-121-155.ap-southeast-2.compute.amazonaws.com/getuser.php?devid=1&trun=1


	*/
	
	
	// Get values.
	$pass = $_GET['pass'];
	$status = $_GET['status'];
	$row1= 0;
	$trun=$_GET['trun'];
	$datestr = $_GET['dates'];
	$delId=$_GET['schaid'];
	$dev_id=$_GET['devid'];
	
	
	
	

	//Y-m-d H:i:s
	// Assume you have a date string which is in d-m-Y format.

date_default_timezone_set('America/Mexico_City');
$phpdate = strtotime( $datestr );

$datesch = date( 'Y-m-d G:i:s', $phpdate );

$currentDateTime = date('Y-m-d G:i:s');

$datey = date( 'Y', $phpdate );
$datem = date( 'm', $phpdate );
$dated = date( 'd', $phpdate );
$dateH = date( 'G', $phpdate );
$datei = date( 'i', $phpdate );
$dates = date( 's', $phpdate );


 
// Print the date in Y-m-d format.
//print date('Y-m-d', $date->getTimestamp());


	
	//$date= date('Y-m-d H:i:s') ;
	
	// Set password. This is just to prevent some random person from inserting values. Must be consistent with YOUR_PASSCODE in Arduino code.
	$passcode = "123";

	 if($trun == 1){
			// $servername = "dcm.uhcl.edu";
			// $username = "caps18g6";
			// $dbname = "caps18g6";
			// $password = "7286241";


			$servername = "127.0.0.1";
			$username = "root";
			$dbname = "caps18g6";
			$password = "caps18g6";
			// Number of entires to display.
			$display = 15;
			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
	//select username from users where id = (select userid from userdevices where deviceid = 1);
			$result = mysqli_query($conn, "SELECT username from users where id = (select userid from userdevices where deviceid = '$dev_id');");
			$rowsa = array();
			while($row = mysqli_fetch_assoc($result)) {
				
				$counter++;
				$rowsa[] = $row;
				
			}
			//echo "</table>";
			//echo $row1;
			echo json_encode($rowsa);

			
	
}
			
			mysqli_close($conn);
	
	
?>

 
		 <?php	
			// Database credentials.
		 
		?> 


		 
