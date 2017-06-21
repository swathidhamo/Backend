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
  

      $sql = "INSERT INTO content (title, info) VALUES ('$title', '$content')";
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
        echo "<td><a href= 'edite.php?id=".$query2['id']."'>Edit/Delete</a></td><tr>";      
        }

    if(isset($_GET["elevate"])){
       
         if(isset($_GET['ascess'])){
           $ascess = $_GET['ascess'];

           $ascess_query  = "UPDATE user_info SET ascess_level = '1' WHERE username = '$ascess' ";
           $result_q = mysqli_query($link, $ascess_query);

           if($result_q){
            echo "ascess changed";
           }
         }

       }   


    if(isset($_GET["demote"])){
       
         if(isset($_GET['ascess'])){
           $ascess = $_GET['ascess'];

           $ascess_query  = "UPDATE user_info SET ascess_level = '0' WHERE username = '$ascess' ";
           $result_q = mysqli_query($link, $ascess_query);

           if($result_q){
            echo "ascess changed";
           }
         }

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
      <input type = "submit" name = "new" value = "new">
      <input type = "submit" name = "elevate" value = "elevate">
      <input type = "submit" name = "demote" value = "Demote">
      <input type = "text" name = "ascess" placeholder = "enter the username">
   </form>

 

   </script>


</body>
</html>