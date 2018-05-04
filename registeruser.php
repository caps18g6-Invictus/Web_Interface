  <?php
   //session_start();
    $pass=$_GET['pass'];
     $myusername=$_GET['name'];
      $mypassword = $_GET['password'];
	  $passcode = "123";
if(isset($pass) && ($pass == $passcode))
	{	  
 if(isset($myusername)&& isset($mypassword))
		{
            $servername = "localhost";
			$username = "root";
			$dbname = "caps18g6";
			$password = "caps18g6";
			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbname);
            $sql = "SELECT * FROM users WHERE username='$myusername'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0)
			{
				//So if it was in this loop that means a user was alredy registered with Username
				$error = "A user was already registered with user name ".$myusername;
				echo '<font size="7">A user was already registered with user name '.$myusername.'</font>';
			   
			}
			
			else
			{
			// Insert values into table. Replace YOUR_TABLE_NAME with your database table name.
			$sql = "INSERT INTO users 
			       (username,password)
                   VALUES ('$myusername', '$mypassword')";	   
            if (mysqli_query($conn, $sql))
			{
			    $sql = "CREATE DATABASE ".$myusername;
			    mysqli_query($conn, $sql); //Execute the query
				//Create new connection to the table
				$servername = "localhost";
			    $username = "root";
			    $dbname = $myusername;
			    $password = "caps18g6";
			// Create connection.
			$conn1 = mysqli_connect($servername, $username, $password, $myusername);
				$sql = "CREATE TABLE `commands` (
                        `idcommands` int(11) NOT NULL AUTO_INCREMENT,
                        `cid` int(11) DEFAULT NULL,
                        `intensity` int(11) DEFAULT NULL,
                        `year` int(11) DEFAULT NULL,
                        `day` int(11) DEFAULT NULL,
                        `month` int(11) DEFAULT NULL,
                        `hours` int(11) DEFAULT NULL,
                        `minutes` int(11) DEFAULT NULL,
                        `seconds` int(11) DEFAULT NULL,
                        `red` int(11) DEFAULT NULL,
                         `green` int(11) DEFAULT NULL,
                         `blue` int(11) DEFAULT NULL,
                         `devid` varchar(45) DEFAULT NULL,
                         PRIMARY KEY (`idcommands`)
                         ) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1";
			    mysqli_query($conn1, $sql); //Execute the query
				$sql =" CREATE TABLE `scheduletest` (
                       `schaid` int(11) NOT NULL AUTO_INCREMENT,
                       `status` int(11) DEFAULT NULL,
                       `time` datetime DEFAULT NULL,
                       `year` int(11) DEFAULT NULL,
                       `month` varchar(45) DEFAULT NULL,
                       `day` varchar(45) DEFAULT NULL,
                       `hours` varchar(45) DEFAULT NULL,
                       `minutes` varchar(45) DEFAULT NULL,
                       `seconds` varchar(45) DEFAULT NULL,
                       `devid` varchar(45) DEFAULT NULL,
                       PRIMARY KEY (`schaid`)
                     ) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1";
			     mysqli_query($conn1, $sql); //Execute the query
				 echo '<font size="7">'.$myusername.'was Created sucessfully</font>';
				 
			}
				  
	     }
	}
			
	}
?>