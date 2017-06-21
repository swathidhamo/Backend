<html>
<head>
	<title>The forum</title>
  <?php
   $link = mysqli_connect("127.0.0.1", "root", "", "first_db");



      $display = "SELECT title, info FROM content";
      $result = mysqli_query($link,$display);

      while($row = mysqli_fetch_assoc($result)) {
        echo  " - Title: " . $row["title"]. " Info" . $row["info"]. "<br>";
    }


  ?>
</head>
<body>
   <div id= "workspace">
   <form method = "GET" >
  

   </form>
</div>
   <script type="text/javascript">
    

   </script>


</body>
</html>