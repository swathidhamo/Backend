
<?php
$link = mysqli_connect("127.0.0.1", "root", "", "first_db");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The first_db database is great." . PHP_EOL;




 if(isset($_POST["Submit"])){
   if(isset($_POST['username'])){
	 
	$username = $_POST['username'];
   }
   if(isset($_POST['password'])){
	$password = $_POST['password'];
}
//$username = $_POST["username"];
//$password = $_POST["password"];
}
 

//$sql = "INSERT INTO user_info (id, username, password) VALUES('4','adminstrator','pilas')";//WHERE username = '" .$username. "' AND password = '" .$password. "' "
$sql = "SELECT * FROM `user_info` WHERE username = '$username' AND password = '$password' ";
$res = mysqli_query($link,$sql);

$rows = mysqli_num_rows($res);
//cho mysql_error();
//$rows = mysqli_statement_num_rows($res);

if($rows ==1 && $username == "admin"){
	echo "yes it works";
	header('Location: forum.php');
	
}
else if($rows==1){
	header('Location: viewing.php');
}
else {
	echo "no";
	//echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
	//echo mysql_num_rows($res);

}


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
     
  	</form>
  
  </body
</html>