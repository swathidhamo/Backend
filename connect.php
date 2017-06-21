
<?php
$link = mysqli_connect("127.0.0.1", "root", "", "first_db");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The first_db database is great." . PHP_EOL;



	echo "wok";
if(isset($_POST["Submit"])){
if(isset($_POST['username'])){
	echo "it goes";
	echo $_POST['username'];
	$username = $_POST['username'];
}
if(isset($_POST['password'])){
	echo "adn hter";
	$password = $_POST['password'];
}
//$username = $_POST["username"];
//$password = $_POST["password"];
}
$table = "user_info";

//$sql  = "INSERT INTO user_info (id, username, password) VALUES('3','woek','pil')";WHERE username = '" .$username. "' AND password = '" .$password. "' "
$sql = "SELECT * FROM user_info ";
$res = mysqli_query($link,$sql);
$rows = mysql_num_rows($res);

if($rows > 0){
	echo "yes";
	
}
else {
	echo "no";
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