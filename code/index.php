<html>
<head>
	<title>Code snippet forum-Login page</title>
	<?php

     session_start();
     session_destroy();

     $link = mysqli_connect("127.0.0.1", "root", "", "delta");
     session_start();    

     if(!$link){
      echo "Could not connect";
      echo mysqli_error($link);
     }
     else{
      echo "Sucesssfully connected";

      if(isset($_POST["login"])){
      	if(isset($_POST["username"])){
      		$username = $_POST["username"];
      	}
      	if(isset($_POST["password"])){
      		$password = $_POST["password"];
      	}
        $password_hash = hash('md5',$password);
        $query = "SELECT * FROM user_info WHERE username = '$username' AND password = '$password_hash'";
        $sql = mysqli_query($link,$query);
        $rows = mysqli_num_rows($sql);
        if($rows==1){
          echo "Sucessfully logged in";
          $_SESSION["username"] = $username;
          header("Location: insert.php");

        }
        else{
          echo "Invalid username or password";
          echo $password_hash;
        }


      	
      }

     }






	?>
</head>
<body>
  <form method = "POST" >
    Username: <input type = "text" name = "username" placeholder = 'Enter the username'>
    Password: <input type = "text" name = "password" placeholder = "Enter the password">
    <input type = "submit" name = "login" value = "Login">
  </form>
  <a href = "register.php">Click here to register</a>
</body>
</html>