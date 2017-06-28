<html>
<head>
	<title>Registeration Page</title>
 

	<?php
     
    $link = mysqli_connect("127.0.0.1", "root", "", "delta");

    if(isset($_POST["create"])){
    	if(isset($_POST["username"])){
    		$username = $_POST["username"];
    		
    	}

    	if(isset($_POST["password"])){
    		$password = $_POST["password"];
    		
    	}

        if(isset($_POST["name"])){
            $name = $_POST["name"];
        }
         
          $hash = getPasswordHash($password); 

        $sql = "INSERT INTO user_info (username, password,name) VALUES ('$username', '$hash','$name')";
        $query = mysqli_query($link,$sql);
    }
    	if($query){
    		header("Location: index.php");
    		echo "het";
    	}
    	else{
    		echo mysqli_error($link);
    	}



// calculate the hash from a salt and a password
    function getPasswordHash( $password )
 {
    return ( hash( 'md5', $password ) );
  }


// get a new hash for a password



	?>
</head>
<body>
  <form method = "POST">
      <p> Username: <input type = "text" name = "username"></p>
      <p> Password: <input type = "text" name = "password"></p>
      <p> Name: <input type = "text" name = "name"></p>
    <p><input type = "submit" name = "create" value="Register"></p> 
  </form>

</body>
</html>