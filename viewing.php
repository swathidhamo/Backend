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
   }
   .link{
    padding-left: 20px;
    padding-right: 20px;
    border: 2.5px solid red;
   }

   p{
    font-style: bold;
   }

   body{
     background: #0ca3d2;
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

     if( empty($_SESSION["username"]) ) {

      header("Location: connect.php");
      echo "You do not have the ascess level";
     }
 
     else {
      $display = "SELECT id,title, info,image FROM content";
      $result = mysqli_query($link,$display);
      while($row = mysqli_fetch_assoc($result)) {
        $image_data = $row["image"];
        $image_encoded = base64_encode($image_data);

        echo  "<div>Note  ".$row["id"]. "<p> Title:     " . $row["title"]."</p> <p>Info:   " . $row["info"].  "<p><img src='data:image/jpeg;base64,$image_encoded'/></p>" . "</p><br></div>";
    }

  
   }
     

  ?>
</head>
<body>
   <a href = "logout.php" class = "link">Logout</a>
   
   <form method = "POST" >
   

   </form>

  

   <script type="text/javascript">
    

   </script>


</body>
</html>