<html>
<head>
  <title>Editing page</title>
  <?php

    $link = mysqli_connect("127.0.0.1", "root", "", "maps");
    session_start();

    
    if(!empty($_SESSION["image_id"])){
    
    
     $id = $_SESSION["image_id"];

     if(isset($_POST["submit"])){


       

      $image = $_FILES['image']['tmp_name'];
      $img = file_get_contents($image);
     

     
     $query_edit = "UPDATE entry SET image  = ? WHERE id = '" .$id. "' ";
      $edit = mysqli_prepare($link,$query_edit);
      mysqli_stmt_bind_param($edit, "s",$img);
      $result = mysqli_stmt_execute($edit);
    
    

     if($result){
      echo "Edited";
      header("Location: gitcode.php");
     }

     }
   //  header("Location: forum.php");


   }


   else{
    header("Location: login.php");
   }






  ?>

  <style type="text/css">
  
   body {
    font: 13px/20px "Lucida Grande", Tahoma, Verdana, sans-serif;
    color: #404040;
    background: #0ca3d2;

   }


  </style>
</head>
<body>
 <form method = "POST" enctype="multipart/form-data" >
       <input type="file" name="image" />     
       <input type= "submit" name = "submit" id = "submit" value = "Upload">
      
   </form>
   <a href = "logout.php" class = "link">Logout</a>

</body>
</html>