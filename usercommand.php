<?php
	/*
		name : usercommand.php
		Author : Sasidhar Pasupuleti 
		Project LightBlu*/
	/*	
	name : usercommand.php
	
	1. trun = 0 and cid=1 (Intesity mode) pass=123 inserts command
	http://ec2-13-211-121-155.ap-southeast-2.compute.amazonaws.com/usercommand.php?cid=1&intensity=234&year=2018&day=8&month=4&hours=2&minutes=34&seconds=56&red=100&green=100&blue=100&pass=123&trun=0&username=user1&devid=1
	
	2.trun = 0 and cid=2 (rgb mode) inserts command
	http://ec2-13-211-121-155.ap-southeast-2.compute.amazonaws.com/usercommand.php?cid=2&intensity=400&year=2018&day=8&month=4&hours=2&minutes=34&seconds=56&red=322&green=344&blue=224&pass=123&trun=0&username=user1&devid=1
	
	3. trun =1 gets command and works on device side
	http://ec2-13-211-121-155.ap-southeast-2.compute.amazonaws.com/usercommand.php?trun=1&username=user1&devid=1

	*/
	// Get values.
	$pass = $_GET['pass'];
	$cid = $_GET['cid'];
	$intensity = $_GET['intensity'];
	$year = $_GET['year'];
	$day =  $_GET['day'];
	$month = $_GET['month'];
	$hours = $_GET['hours'];
	$minutes = $_GET['minutes'];
	$seconds = $_GET['seconds'];
	$red = $_GET['red'];
	$green = $_GET['green'];
	$blue = $_GET['blue'];
	$row1= 0;
	$trun=$_GET['trun'];
	$dbUsername = $_GET['username'];
	$devid = $_GET['devid'];

	//Y-m-d H:i:s
	// Assume you have a date string which is in d-m-Y format.
//$date_string = '18-04-2013';
 
// Create the DateTime object
$date = date_create_from_format('Y-m-d H:i:s', $dateTime);
 
// Print the date in Y-m-d format.
//print date('Y-m-d', $date->getTimestamp());


	date_default_timezone_set('America/Mexico_City');
	//$date= date('Y-m-d H:i:s') ;
	
	// Set password. This is just to prevent some random person from inserting values. Must be consistent with YOUR_PASSCODE in Arduino code.
	$passcode = "123";
	
	// Check if password is right. (If there is no password, assume no data is trying to be entered and skip over this.)
	if(isset($pass) && ($pass == $passcode)){
		
		// If all values are present, insert it into the MySQL database.
		if(isset($cid)&&isset($intensity)&&($trun==0)){
			 

			$servername = "127.0.0.1";
			$username = "root";
			//$dbname = "caps18g6";
			$password = "caps18g6";
			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbUsername);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// Insert values into table. Replace YOUR_TABLE_NAME with your database table name.
			$sql = "INSERT INTO commands (cid,intensity,year,day,month,hours,minutes,seconds,red,green,blue,devid) VALUES ('$cid', '$intensity','$year','$day','$month','$hours','$minutes','$seconds','$red','$green','$blue','$devid')";
			
			//http://ec2-13-211-121-155.ap-southeast-2.compute.amazonaws.com/usercommand.php?cid=1&intensity=234&year=2018&day=8&month=4&hours=2&minutes=34&seconds=56&red=100&green=100&blue=100&pass=123&trun=0

			//http://ec2-13-211-121-155.ap-southeast-2.compute.amazonaws.com/usercommand.php?cid=2&intensity=400&year=2018&day=8&month=4&hours=2&minutes=34&seconds=56&red=322&green=344&blue=224&pass=123&trun=0

			//http://ec2-13-211-121-155.ap-southeast-2.compute.amazonaws.com/test.php?cid=1&intensity=500&year=2018&day=8&month=4&hours=2&minutes=34&seconds=56&red=322&green=344&blue=224&pass=123&trun=0
			
			//$ii= $ii +1;
			if (mysqli_query($conn, $sql)) {
				echo "OK";
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

			$servername = "127.0.0.1";
			$username = "root";
			//$dbname = "caps18g6";
			$password = "caps18g6";
			// Number of entires to display.
			$display = 15;
			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbUsername);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// Get the most recent 10 entries.
			//$result = mysqli_query($conn, "SELECT * FROM commands ORDER BY id DESC LIMIT " . $display . "");
			$result = mysqli_query($conn, "SELECT * FROM commands WHERE devid='$devid' LIMIT 1 ");
			$rowsa = array();
			while($row = mysqli_fetch_assoc($result)) {
				//echo "<table><tr><th>Date</th><th>Sensor 1</th><th>Sensor 2</th><th>Status</th></tr>";
				//echo "<tr><td>";
				//echo $row["date"];
				//echo json_encode($row["dateTime"]);
				//echo "</td><td>";
				$row1 =$row["idcommands"];
				//echo "</td><td>";
				//echo $row["s2"];
				//echo "</td><td>";
				//if($row["s1"] == 1) echo "Door is open!";
				//else echo "Door is closed.";
				//echo "</td></tr>";
				$counter++;
				$rowsa[] = $row;
				
			}
			//echo "</table>";
			//echo $row1;
			echo json_encode($rowsa);


			mysqli_query($conn, "DELETE FROM commands where idcommands='$row1'");
}
			//echo json_encode($row["dateTime"]);
			
			// Print number of entries in the database. Replace YOUR_TABLE_NAME with your database table name.
			//$row_cnt = mysqli_num_rows(mysqli_query($conn, "SELECT date FROM YOUR_TABLE_NAME"));
			//echo "<div class='notes'>Displaying last " . $display . " entries.<br/>The database table has " . $row_cnt . " total entries.</div>";
			
			// Close connection.
			mysqli_close($conn);
		?> 
	