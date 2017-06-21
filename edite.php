<html>
<head>
	<title>Editing page</title>
	<?php

	  $link = mysqli_connect("127.0.0.1", "root", "", "first_db");
    echo "hi";
	  if(isset($_GET['id'])){

     $id = $_GET['id'];
     echo $id;

     if(isset($_POST["edit"])){


     if(isset($_POST['title'])){
       $edited_title = $_POST['title'];
       echo $edited_title;
     }
     if(isset($_POST['content0'])){
       $edited_info = $_POST['content0'];
     }
     
     $query_edit = "UPDATE content SET title = '$edited_title', info = '$edited_info' WHERE id = '$id' ";
    
     $result = mysqli_query($link,$query_edit);
    

     if($result){
      echo "Edited";
      header("Location: forum.php");
     }

     }
   //  header("Location: forum.php");


   }






	?>
</head>
<body>
 <form method = "POST" >
   	  <textarea name = "content0" id = "content0" width = "200" height = "200"></textarea>

   	  <input type = "text" name = "title">
   	  <input type= "submit" name = "edit" id = "edit" value = "Edit">
      




   </form>

</body>
</html>