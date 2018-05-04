 
 <?php
 // Get values.
	$user = $_GET['name'];
	$welcome="WELCOME ".$user;
 ?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="dashboard.ico" />
<title>DASHBOARD</title>
<style>
 .header
 {
          overflow: hidden;
          background-color: #99d6ff;
          padding: 20px 10px;
 }
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}
li {
    float: left;
	border-right: 1px solid #bbb;
}
li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}
</style>
</head>

<body>
<div class="header">
<form action="http://ec2-13-211-121-155.ap-southeast-2.compute.amazonaws.com/login.php" >
<label style="font-size:300%;" >DASHBOARD </label>
<input style="font-size:100%;float:right;" type="submit" value="LOGOUT">
</form>
</div>
<br>
<div align="center" style="font-size:200%;" >
<?php echo $welcome ?>
</div>
<br>
<form method="post">
<label style="font-size:200%;">Select the Device You Want to Control  <?php echo $user ?></label>
<select autofocus name="devicelist" style="font-size:140%" >
<option></option>
  <?php
			// Database credentials
			$servername = "localhost";
			$username = "root";
			$password = "caps18g6";
			$dbname = "caps18g6";
			
			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn)
				die("Connection failed: ");
			
			//write the select query to check the numberof devices
			$sql = "SELECT d.id,d.devicename,d.ssid,d.password  FROM devices d , userdevices ud
			        WHERE d.id=ud.deviceid AND ud.userid=(SELECT id FROM users WHERE username='$user')";
            $result = $conn->query($sql);
			if ($result->num_rows == 0) 
                     $error="(You had not registered any Device ".$user.".Please Register a device using LIGHT-BLUE Ios Mobile App)";
		    
			if ($result->num_rows > 0) 
			{
				$error="";
				while($row = $result->fetch_assoc()) 
				{
				    $id = $row["id"];
                    $devicename = $row["devicename"];
                   echo '<option value="'. $id .'">'. $devicename .'</option>';
				}
			}
			// Close connection.
			mysqli_close($conn);
  ?>
</select>
</form>
<label style="font-size:100%;color:red" ><?php echo $error ?></label>
<br><br>
<?php
$device = $_POST['devicelist'];
$colorlink="/color.php?name=".$user."&device=".$device;
$intensitylink="/intensity.php?name=".$user."&device=".$device;
$schedulelink="/schedule.php?name=".$user."&device=".$device;
?>
<ul>
  <li><a class="active" href=<?php echo $colorlink ?> target="_blank" >SET COLOR</a></li>
  <li><a href=<?php echo $intensitylink ?> target="_blank">SET INTENSITY</a></li>
  <li><a href=<?php echo $schedulelink ?> target="_blank">SET SCHEDULE</a></li>
</ul>
<iframe  name="menu" style="height:475px;width:1345px;border:none;"><iframe>
</body>
</html>

