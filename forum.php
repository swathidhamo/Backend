<html>
<head>
	<title>The forum</title>
	<?php

	  $link = mysqli_connect("127.0.0.1", "root", "", "first_db");


      if(isset($_GET["edit"])){
       
        if(isset($_GET["content0"])){
      	    $content = $_GET["content0"];
        }
        if(isset($_GET["title"])){
        	$title = $_GET["title"];
        }
  }

      $sql = "INSERT INTO content (title, info) VALUEs ('$title', '$content')";
      $query = mysqli_query($link,$sql);

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
   	  <textarea name = "content0" id = "content0" width = "200" height = "200"></textarea>

   	  <input type = "text" name = "title">
   	  <input type= "submit" name = "edit" id = "edit" value = "Edit">



   </form>
</div>
 

   </script>


</body>
</html>