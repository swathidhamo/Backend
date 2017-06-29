<html>
<head>
	<title></title>
	<?php

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
            }
            else{
                  echo "Yes it is avaliable";
                  
            }
      
   }




	?>
</head>
<body>

</body>
</html>