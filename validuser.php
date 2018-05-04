  <?php
	
	// Get values.
	$pass = $_GET['pass'];
	$user = $_GET['name'];
	$passkey = $_GET['password'];
	
	
	// Set password. This is just to prevent some random person from inserting values. Must be consistent with YOUR_PASSCODE in Arduino code.
	$passcode = "123";
	
	// Check if password is right. (If there is no password, assume no data is trying to be entered and skip over this.)
	if(isset($pass) && ($pass == $passcode))
	{
		  if(isset($user)&&isset($passkey))
		{
			// Database credentials
			$servername = "localhost";
			$username = "root";
			$dbname = "caps18g6";
			$password = "caps18g6";
			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn)
				die("Connection failed: " . mysqli_connect_error());
			
			//write the select query to check the validity
			$sql = "SELECT * FROM users 
			        WHERE username='$user' and password='$passkey'";
            $result = $conn->query($sql);
			
	
			if ($result->num_rows > 0) 
			{
				     $reply->valid = "true";
                     $myJSON = json_encode(mysqli_fetch_assoc($result));
					 echo $myJSON ;
			 }
		
			else 
			{
				$reply->valid = "false";
				$reply->id = "0";
                     $myJSON = json_encode($reply);
					 echo $myJSON ;
			}
			
			// Close connection.
			mysqli_close($conn);
		}
	}
?>

 
		