<html>
<head>
	<title>Code snippet forum-Registration page</title>
	<?php
      
     $link = mysqli_connect("127.0.0.1", "root", "", "first_db");

     if(!$link){
      echo "Could not connect";
      echo mysqli_error($link);
     }
     else{
      echo "Sucesssfully connected";

      if(isset($_POST["register"])){
      	if(isset($_POST["username"])){
      		$username = mysqli_real_escape_string($link,$_POST["username"]);
          $username = stripslashes($username);

      	}
      	if(isset($_POST["password"])){
      		$password = mysqli_real_escape_string($link,$_POST["password"]);
          $password = stripslashes($password);

      	}

        $password_hash = hash('md5',$password);

        $query = "INSERT INTO user_info (username,password) VALUES (?,?)";
        $sql = mysqli_prepare($link,$query);
      	
      }
    }
     






	?>
</head>
<body>
  <form method = "POST" >
    Username: <input type = "text" name = "username" placeholder = 'Enter the username'>
    Password: <input type = "text" name = "password" placeholder = "Enter the password">
    <input type = "submit" name = "register" value = "Signup">
  </form>

</body>
</html>