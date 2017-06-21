<html>
<head>
  <style type="text/css">
   div{

    border: 3px solid green;
    padding-top: 5px;
    padding-bottom:  5px;
    margin-bottom: 5px;
    margin-top: 5px;
   }


  </style>
	<title>The forum</title>
	<?php

	  $link = mysqli_connect("127.0.0.1", "root", "", "first_db");


      if(isset($_GET["new"])){
       
        if(isset($_GET["content0"])){
      	    $content = $_GET["content0"];
        }
        if(isset($_GET["title"])){
        	$title = $_GET["title"];
        }
  

      $sql = "INSERT INTO content (title, info) VALUEs ('$title', '$content')";
      $query = mysqli_query($link,$sql);

    }

   /*   $display = "SELECT id,title, info FROM content";
      $result = mysqli_query($link,$display);

      echo "<table><tr><td>Title</td><td>Info</td><td></td><td></td>";

      while($row = mysqli_fetch_assoc($result)) {

        echo "<tr><td>".$row['title']."</td>";
        echo "<td>".$row['info']."</td><tr>";
        echo "<td><a href='edit.php?id=".$row['id']."'>Edit</a></td>";
        echo "<td><a href='delete.php?id=".$row['id']."'>x</a></td><tr>";        
    }
*/


   $result=mysqli_query($link,"SELECT id, title, info FROM content");
   echo "<table><tr><td>No.</td><td>Title</td><td>Info</td><td></td><td></td>";
   while($query2=mysqli_fetch_array($result))
     {
        echo "<tr><td>".$query2['id']."</td>";
        echo "<td>".$query2['title']."</td>";
        echo "<td>".$query2['info']."</td>";
        echo "<td><a href= 'edite.php?id=".$query2['id']."'>Edit</a></td>";
        echo "<td><a href = 'deletee.php?id=".$query2['id']."'>X</a></td><tr>";

      
        }
  ?>

</table>
</body>
</html>    


</head>
<body>
   
   <form method = "GET" >
   	  <textarea name = "content0" id = "content0" width = "200" height = "200"></textarea>

   	  <input type = "text" name = "title">
   	  <input type= "submit" name = "edit" id = "edit" value = "Edit">
  
      <input type = "submit" name = "new" value = "new">




   </form>

 

   </script>


</body>
</html>