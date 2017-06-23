<html>
<head>
	<title>Editing page</title>
	<?php

	  $link = mysqli_connect("127.0.0.1", "root", "", "first_db");
    session_start();

    echo $_SESSION["username"];
    //echo "hi";
    if(!empty($_SESSION["username"]) && !empty($_SESSION["ascess_level"]) && $_SESSION["ascess_level"]==1){
    
    if(isset($_GET['id'])){

     $id = $_GET['id'];
     //echo $id;

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


     if(isset($_GET['id'])){

     $id = $_GET['id'];
     //echo $id;

     if(isset($_POST["delete"])){

     $query_delete = "DELETE FROM content WHERE id = '$id' ";
    
     $result_delete = mysqli_query($link, $query_delete);
    

     if($result_delete){
      echo "Edited";
      header("Location: forum.php");
     }

     }
   //  header("Location: forum.php");


   }

 }

 else if($_SESSION["ascess_level"]==0 && !empty($_SESSION["username"])) {
   header("Location: viewing.php");
   echo "Ascess denied";


   }
   else{
    header("Location: connect.php");
   }






	?>

  <style type="text/css">
    .link{
    padding-left: 20px;
    padding-right: 20px;
    border: 2.5px solid red;
   }

  </style>
</head>
<body>
 <form method = "POST" >
   	  <textarea name = "content0" id = "content0" width = "200" height = "200"></textarea>

   	  <input type = "text" name = "title">
   	  <input type= "submit" name = "edit" id = "edit" value = "Edit">
      <input type= "submit" name = "delete" id = "delete" value = "Delete">

    



   </form>
   <a href = "logout.php" class = "link">Logout</a>

</body>
</html>