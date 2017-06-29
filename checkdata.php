<html>
<head>
	<title></title>
	<?php
      session_start();

      $link = mysqli_connect("127.0.0.1", "root", "", "delta");
      $username = $_POST["username"];

      

      if(!$link){
            echo "error";
      }
      else{

      
      	$query = "SELECT * FROM user_info WHERE username = '$username' ";
      	$sql = mysqli_query($link,$query);
      	$rows = mysqli_num_rows($sql);
      	if($rows>0){
                  echo "No it is unavaliable";
                  $_SESSION["avaliable"] = false;
            }
            else{
                  echo "Yes it is avaliable";
                  $_SESSION["avaliable"] = true;

            }
      
   }




	?>
</head>
<body>

</body>
</html>