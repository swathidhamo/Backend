<html>
<head>
	<title>Registeration Page</title>

	<?php
     
    $link = mysqli_connect("127.0.0.1", "root", "", "first_db");

    if(isset($_POST["create"])){
    	if(isset($_POST["username"])){
    		$username = $_POST["username"];
    		//echo$username;
    	}

    	if(isset($_POST["password"])){
    		$password = $_POST["password"];
    		//echo $password;
    	}

          

        $sql = "INSERT INTO user_info (username, password,ascess_level) VALUES ('$username', '$password','0')";
        $query = mysqli_query($link,$sql);
    }
    	if($query){
    		header("Location: connect.php");
    		echo "het";
    	}
    	else{
    		echo mysqli_error($link);
    	}



    




	?>
</head>
<body>
  <form method = "POST">
    Username: <input type = "text" name = "username">
    Password: <input type = "text" name = "password">


    <p><input type = "submit" name = "create" value="Register"></p> 


  </form>

</body>
</html>