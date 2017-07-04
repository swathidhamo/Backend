<html>
<head>
	<title>Comments</title>
	<?php
      $link = mysqli_connect("127.0.0.1", "root", "", "maps");
      session_start();

      $id = $_GET["id_comments"];

      if(isset($_POST["submit"])){
      	if(isset($_POST["comment_content"])){
      		$content = $_POST["comment_content"];
      	}

      	$name = $_SESSION["username"];

      	$query = "INSERT INTO comment (username, comments, entry) VALUES ('$name','$content','$id')";
        $sql = mysqli_query($link,$query);

        if($sql){
        	echo "Sucessfully added";
        }
        else{
        	echo mysqli_error($link);
        }

      }  

        //now to display the existing comments
         $display = "SELECT comments, username FROM comment WHERE entry = '$id'";
         $result = mysqli_query($link,$display);

           while($row = mysqli_fetch_assoc($result)) {

        echo  "<div class = 'box'>".$row["username"]."   says that   ' ".$row["comments"]." '<br></div>";
         }



      

     











	?>
	<style type="text/css">
      .box{
      	border: 2px solid green;
      	padding: 15px 15px 15px 15px;
      	margin:  35px 35px 35px 35px;
      }
	</style>
</head>

<body>
<form method = "POST">
  <input type = "text" name = "comment_content">
   <input type = "submit" value = "Submit" name = "submit">
   <a href = "gitcode.php">Back to the map</a>

</form>
</body>
</html>