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

    .link{
    padding-left: 20px;
    padding-right: 20px;
    border: 2.5px solid red;
   }

    img{
      width: 100px;
      height: 100px;
    }

  </style>
	<title>The forum</title>
	<?php

	  $link = mysqli_connect("127.0.0.1", "root", "", "first_db");
     session_start();
     echo "Welcome to the forum " .$_SESSION["username"] . "  " .$_SESSION["moderated"]. " " ;
   
      if( !empty($_SESSION["username"]) && !empty($_SESSION["ascess_level"]) && $_SESSION["ascess_level"]==1){
      
      if(isset($_POST["new"])){
       
        if(isset($_POST["content0"])){
      	    $content = $_POST["content0"];
        }
        if(isset($_POST["title"])){
        	$title = $_POST["title"];
        }

      
       // $sql_image = "INSERT INTO content (image) values(?)";
      //  $stmt = mysqli_prepare($link,$sql_image);
 
       // mysqli_stmt_bind_param($stmt, "s",$img);
          $image = $_FILES['image']['tmp_name'];
          $img = file_get_contents($image);


     
        /* Here the database 'content' consists of the all the information that will be 
        displayed in the forum.
        But the database 'approval' will consists of the information that will have to 
        be approved by a non-moderated admin level member
        */
                 
       if($_SESSION["moderated"]==1){//if the user is not moderated the content will be directly added to the forum
    
      $sql = "INSERT INTO content (title, info, image) VALUES ('$title', '$content',?)";
      $query = mysqli_prepare($link,$sql);
      mysqli_stmt_bind_param($query, "s",$img);
      mysqli_stmt_execute($query);

     }
      
    
    if($_SESSION["moderated"]==0){//if the user is moderated then the content is added into a database that will have to be approved by the admin
      if(isset($_POST["content0"]) && isset($_POST["title"])){
      $sql_approval = "INSERT INTO approval (title, info, image) VALUES ('$title', '$content', ?)";
      $query_approval = mysqli_prepare($link,$sql_approval);
      mysqli_stmt_bind_param($query_approval,"s",$img);
      mysqli_stmt_execute($query_approval);
      if($query_approval){
        echo "Please wait while you post is pending for approval";
      }
     }
   }
  }


    //this is to display the contents of the forum for all the members 
   $result=mysqli_query($link,"SELECT id, title, info, image FROM content");
   echo "<table><tr><td>No.</td><td>Title</td><td>Info</td><td></td><td></td>";
   while($query2=mysqli_fetch_array($result))
     {
        $image_data = $query2['image'];
        $encoded = base64_encode($image_data);
        echo "<tr><td>".$query2['id']."</td>";
        echo "<td>".$query2['title']."</td>";
        echo "<td>".$query2['info']."</td>";
        echo "<td><img src='data:image/jpeg;base64,$encoded'/></td>";
        echo "<td><a href= 'edite.php?id=".$query2['id']."'>Edit/Delete</a></td><tr>";      
        }
    //to elevate the ascess level of a user
    if(isset($_POST["elevate"])){
       
         if(isset($_POST['ascess'])){
           $ascess = $_POST['ascess'];

           $ascess_query  = "UPDATE user_info SET ascess_level = '1' WHERE username = '$ascess' ";
           $result_q = mysqli_query($link, $ascess_query);

           if($result_q){
            echo "ascess changed";
           }
         }

       }   

  

    //to demote a given user from a higher to a lower ascess level
    if(isset($_POST["demote"])){
       
         if(isset($_POST['ascess'])){
           $ascess = $_POST['ascess'];

           $ascess_query  = "UPDATE user_info SET ascess_level = '0' WHERE username = '$ascess' ";
           $result_q = mysqli_query($link, $ascess_query);

           if($result_q){
            echo "ascess changed";
           }
         }

       }   
}

     

     else {
      header("Location: connect.php");
     }


   /*  if(isset($_POST["approval"])){

          echo mysqli_error($link);
          header("Location: approve.php");
         }
*/
     //to direct a non moderated admin ascess level member to the approval database

       
  ?>

</table>



</head>
<body>
   
   <form method = "POST" enctype="multipart/form-data" >
   	  <textarea name = "content0" id = "content0" width = "200" height = "200"></textarea>
   	  <input type = "text" name = "title">
      <input type = "submit" name = "new" value = "new">
      <input type="file" name="image" />
      <input type = "submit" name = "elevate" value = "elevate">
      <input type = "submit" name = "demote" value = "Demote">
      <input type = "text" name = "ascess" placeholder = "enter the username">
      <input type = "submit" name = "approval" value = "Approval Pending" >
      <a href="approve.php">Approvals pending</a>

   </form>

   <a href = "logout.php" class = "link">Logout</a>

 

   </script>


</body>
</html>