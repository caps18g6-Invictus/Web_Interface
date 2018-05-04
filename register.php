  <?php
   //session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = $_POST['username'];
      $mypassword = $_POST['password']; 
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
			}
			
			else
			{
			// Insert values into table. Replace YOUR_TABLE_NAME with your database table name.
			$sql = "INSERT INTO users 
			       (username,password)
                   VALUES ('$myusername', '$mypassword')";	   
            if (mysqli_query($conn, $sql))
			{
				echo "Data Inserted  Sucessfully".$myusername;
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
                         ) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;";
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
				 header("location: login.php");
			}
				  
			}
			
   }
?>

<html>
   
   <head>
      <title>Register Page</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" type="image/x-icon" href="register.ico" />
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Register</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                 <input type = "submit" value = " Signup "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>