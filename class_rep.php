<html>
<head>

  <style type="text/css">
   div{

    border: 3px solid green;
    padding-top: 5px;
    margin-top: 5px;
    padding-bottom:  5px;
    margin-bottom: 5px;
    padding-right: 100px;
    width: 350px;
    margin-left: 100px;
    padding-left: 30px;
    background: #dce1ea;
   }
   .link{
    padding-left: 20px;
    padding-right: 20px;
    border: 2.5px solid red;
   }
   body{
     background: #0ca3d2;
   }

   p{
    font-style: bold;
   }
   img{
    width: 50px;
    height: 50px;
   }

  </style>
	<title>The forum</title>
  <?php
   $link = mysqli_connect("127.0.0.1", "root", "", "first_db");
   session_start();
   echo "<p>Welcome to the forum " .$_SESSION["username"]. "</p>";

     if( empty($_SESSION["username"]) || $_SESSION["ascess_level"] !=2 ) {

      header("Location: connect.php");
      echo "You do not have the ascess level";
     }
 
     else {

        if(isset($_POST["new"])){
         	if(isset($_POST["title"])){
         		$title = mysqli_real_escape_string($link,$_POST["title"]);
         		$title = stripslashes($title);
         	}
         	if(isset($_POST["content0"])){
                $content = mysqli_real_escape_string($link,$_POST["content0"]);
                $content = stripslashes($content);
         	}

         	
            $image = $_FILES['image']['tmp_name'];
            $img = file_get_contents($image);
     

         	$query = "INSERT INTO content (title, info, image) VALUES (?,?,?)";
         	$result = mysqli_prepare($link,$query);
         	mysqli_stmt_bind_param($result,"sss",$title,$content,$img);
         	$result_q = mysqli_stmt_execute($result);
         	if($result_q){
         		echo "Sucessfully added";
         	}


         } 



      $display = "SELECT id,title, info,image FROM content";
      $result_display = mysqli_query($link,$display);
      while($row = mysqli_fetch_assoc($result_display)) {
        $image_data = $row["image"];
        $image_encoded = base64_encode($image_data);

        echo  "<div>Note  ".$row["id"]. "<p> Title:     " . $row["title"]."</p> <p>Info:   " . $row["info"].  "<p><img src='data:image/jpeg;base64,$image_encoded'/></p>" . "</p><br></div>";
       





    }

  
   }
     

  ?>
</head>
<body>
  <form method = "POST" enctype="multipart/form-data" >
   	  <textarea name = "content0" id = "content0" width = "200" height = "200"></textarea>
   	  <input type = "text" name = "title">
      <input type = "submit" name = "new" value = "new">
      <input type="file" name="image" />
      

   </form>

   <a href = "logout.php" class = "link">Logout</a>
</body>
</html>