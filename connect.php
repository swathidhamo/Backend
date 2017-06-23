
<?php
$link = mysqli_connect("127.0.0.1", "root", "", "first_db");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The first_db database is great." . PHP_EOL;
   
 session_start();
 session_destroy();



 if(isset($_POST["Submit"])){
   if(isset($_POST['username'])){
	 
	$username = $_POST['username'];
   }
   if(isset($_POST['password'])){
	$password = $_POST['password'];
}



 session_start();

  $password_hash = hash( 'whirlpool', $password );

//$sql = "INSERT INTO user_info (id, username, password) VALUES('4','adminstrator','pilas')";//WHERE username = '" .$username. "' AND password = '" .$password. "' "
   $sql = "SELECT * FROM `user_info` WHERE username = '$username' ";
   $res = mysqli_query($link,$sql);
   $rows = mysqli_num_rows($res);

   $sql1 = "SELECT username, password, ascess_level, moderate_status FROM `user_info` WHERE username = '$username'";
   $res1 = mysqli_query($link, $sql1); 
   $ascess = mysqli_fetch_array($res1);
   $level = $ascess['ascess_level'];
   $hash = $ascess['password'];
   $moderated = $ascess['moderate_status'];
  // $_SESSION["moderated"] = $moderated;
   





//cho mysql_error();
//$rows = mysqli_statement_num_rows($res);

 if($rows == 1 && $level==1 &&$password_hash==$hash){
   echo "ji";
    $_SESSION["username"] = $username; 
    $_SESSION["ascess_level"] = $level;
    $_SESSION["moderated"] = $moderated;
	  header('Location: forum.php');
   
    echo mysqli_error($link);
	
}
  
 else if($rows==1 && $level==0 && $password_hash==$hash) {
    $_SESSION["username"] = $username; 
    $_SESSION["ascess_level"] = $level;
    echo "what";
    //echo $level;
	  header('Location: viewing.php');
   }
 else {
  	echo "no";
    echo $rows;
    echo $hash;
    echo mysqli_error($link);

   // echo $passwordha
	//echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
	//echo mysql_num_rows($res);
   }

  }

    
     // calculate the hash from a salt and a password
    function getPasswordHash($password)
   {
    return ( hash( 'whirlpool', $password ) );
   }

     // compare a password to a hash
   



   mysqli_close($link);
?>
<html>
<head>
	<title>Note making forum</title>

</head>
  <body>
  	<form method= "POST">

    <p>Username: <input type = "text" name = "username"></p> 
    <p>Password: <input type = "text" name = "password"></p>
     
     <input type = "submit" name = "Submit" value = "Log in">
     <a href = "register.php">Click here to register</a>
     
  	</form>
  
  </body
</html>