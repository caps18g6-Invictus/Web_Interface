
<?php
/*
		name : usersched.php
		Author : Sasidhar Pasupuleti 
		Project LightBlu*/
	/*	
	name : usersched.php
	
	1. trun = 0 and status=1 pass=123 inserts command for switch on
	http://ec2-13-211-121-155.ap-southeast-2.compute.amazonaws.com/schedtest.php?status=1&dates=2018-04-09 12:34:00&trun=0&pass=123&devid=1&username=user1
	
	2.trun = 0 and status=0 pass=123 inserts command for switch off
	http://ec2-13-211-121-155.ap-southeast-2.compute.amazonaws.com/schedtest.php?status=1&dates=2018-04-09 12:34:00&trun=0&pass=123&devid=1&username=user1
	
	3. trun =1 gets command and works on device side
	http://ec2-13-211-121-155.ap-southeast-2.compute.amazonaws.com/usercommand.php?trun=1&username=user1&devid=1

	4. trun =3 gets command and works on device side
	http://ec2-13-211-121-155.ap-southeast-2.compute.amazonaws.com/usercommand.php?trun=3&username=user1

	*/

	
	// Get values.
	$pass = $_GET['pass'];
	$status = $_GET['status'];
	$row1= 0;
	$trun=$_GET['trun'];
	$datestr = $_GET['dates'];
	$delId=$_GET['schaid'];
	$dbname = $_GET['username'];
	$devid = $_GET['devid'];
	
	
	
	

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
	
	// Check if password is right. (If there is no password, assume no data is trying to be entered and skip over this.)
	if(isset($pass) && ($pass == $passcode)){
		
		// echo "2";echo isset($cid);
		// echo "3" ;echo isset($intensity);
		// echo "4" ;echo isset($rgb);
		// If all values are present, insert it into the MySQL database.
		if(($trun==0) && isset($datestr) && isset($status)&&isset($devid)){
			
			echo "edo edo";

			$servername = "127.0.0.1";
			$username = "root";
			//$dbname = "caps18g6";
			$password = "caps18g6";
			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// Insert values into table. Replace YOUR_TABLE_NAME with your database table name.
			$sql = "INSERT INTO scheduletest (time,status,year,month,day,hours,minutes,seconds,devid) VALUES ('$datesch', '$status','$datey','$datem','$dated','$dateH','$datei','$dates','$devid')";
			
			//http://ec2-13-211-121-155.ap-southeast-2.compute.amazonaws.com/schedtest.php?status=1&dates=2018-04-09 12:34:00&trun=0&pass=123&devid=1&username=user1

			
			
			//$ii= $ii +1;
			if (mysqli_query($conn, $sql)) {
				//echo "OK";
			} else {
				echo "Fail: " . $sql . "<br/>" . mysqli_error($conn);
			}
			
			// Close connection.
			mysqli_close($conn);
		}
	}
?>

 
		 <?php	
			// Database credentials.
		 if($trun == 1){
			// $servername = "dcm.uhcl.edu";
			// $username = "caps18g6";
			// $dbname = "caps18g6";
			// $password = "7286241";


			$servername = "127.0.0.1";
			$username = "root";
			//$dbname = "caps18g6";
			$password = "caps18g6";
			// Number of entires to display.
			$display = 15;
			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// Get the most recent 10 entries.
			//$result = mysqli_query($conn, "SELECT * FROM commands ORDER BY id DESC LIMIT " . $display . "");
			//DELETE FROM table WHERE date < '2011-09-21 08:21:22';
			//$result0 = mysqli_query($conn, "DELETE FROM scheduletest WHERE date < '$currentDateTime' ");
			$result = mysqli_query($conn, "SELECT * FROM scheduletest where devid='$devid' ORDER BY time ASC LIMIT 1; ");
			$rowsa = array();
			while($row = mysqli_fetch_assoc($result)) {
				
				$counter++;
				$rowsa[] = $row;
				
			}
			//echo "</table>";
			//echo $row1;
			echo json_encode($rowsa);

			
			//mysqli_query($conn, "DELETE FROM scheduletest where schaid='$delId'");
}
			
			if($trun == 2){
				$servername = "127.0.0.1";
			$username = "root";
			//$dbname = "caps18g6";
			$password = "caps18g6";
			// Number of entires to display.
			$display = 15;
			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// Get the most recent 10 entries.
			//$result = mysqli_query($conn, "SELECT * FROM commands ORDER BY id DESC LIMIT " . $display . "");
			$result = mysqli_query($conn, "DELETE FROM scheduletest where schaid='$delId'");
			
			
				
			}

			if($trun==3){
				$servername = "127.0.0.1";
			$username = "root";
			//$dbname = "caps18g6";
			$password = "caps18g6";
			// Number of entires to display.
			$display = 15;
			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// Get the most recent 10 entries.
			//$result = mysqli_query($conn, "SELECT * FROM commands ORDER BY id DESC LIMIT " . $display . "");
			echo $currentDateTime;
			$result = mysqli_query($conn, "DELETE FROM scheduletest WHERE time < '$currentDateTime' ");
			}
			
			mysqli_close($conn);
		?> 


		 
