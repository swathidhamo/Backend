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
   }


  </style>
	<title>The forum</title>
  <?php
   $link = mysqli_connect("127.0.0.1", "root", "", "first_db");
   session_start();
   echo "Welcome to the forum " .$_SESSION["username"];

     if( empty($_SESSION["username"]) ) {

      header("Location: connect.php");
      echo "You do not have the ascess level";
     }
 
     else {
      $display = "SELECT id,title, info FROM content";
      $result = mysqli_query($link,$display);

      while($row = mysqli_fetch_assoc($result)) {

        echo  "<div>Note  ".$row["id"]. "<p> Title:     " . $row["title"]."</p> <p>Info:   " . $row["info"]. "</p><br></div>";
    }

  
   }
     

  ?>
</head>
<body>
   <div id= "workspace">
   <form method = "GET" >
   

   </form>
</div>
   <a href = "logout.php">Logout</a>
   
   <script type="text/javascript">
    

   </script>


</body>
</html>