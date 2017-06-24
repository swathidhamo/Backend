<html>
<head>
	<title>Posts Pending Approvals</title>

	<?php
    
	  $link = mysqli_connect("127.0.0.1", "root", "", "first_db");
      session_start();
       if(!empty($_SESSION["username"]) && !empty($_SESSION["ascess_level"]) && $_SESSION["moderated"]==1){
        $query = "SELECT id, title, info, image FROM approval";
        $result = mysqli_query($link,$query);
        $rows = mysqli_num_rows($result);

        if($rows==0){
          echo "You have no requests pending";
        }
        
        while($array = mysqli_fetch_array($result)){
          $image_encoded = base64_encode($array["image"]);
           echo  "<div>Note  ".$array["id"]. "<p> Title:     " . $array["title"]."</p> <p>Info:   " . $array["info"]. "<p><img src='data:image/jpeg;base64,$image_encoded'/></p>" . "</p><br></div>";
        }

        if(isset($_POST["id"]) ){
          $id = $_POST["id"];

          $query_approve = "SELECT title, info, image FROM approval WHERE id = '$id' ";
          $result_approve = mysqli_query($link,$query_approve);
          $array_approve = mysqli_fetch_array($result_approve);
          $title = $array_approve["title"];
          $info = $array_approve["info"];
          $image_content = $array_approve["image"];
         // $img = base64_decode($image_content);
         
          if(isset($_POST["approve"])){
            $query_append = "INSERT INTO content (title, info, image) VALUES ('$title', '$info', ? )";
            $append_result = mysqli_prepare($link,$query_append);
            mysqli_stmt_bind_param($append_result,"s",$image_content);
            mysqli_stmt_execute($append_result);

           
            if($append_result){
              echo "Sucessfully approved";
              $query_reject = "DELETE FROM approval WHERE id = '$id' ";
              $reject_result = mysqli_query($link,$query_reject);
            }
          }
          else if(isset($_POST['reject'])){
            $query_reject = "DELETE FROM approval WHERE id = '$id' ";
            $reject_result = mysqli_query($link,$query_reject);
            if($reject_result){
              echo "Sucessfully rejected";
            //  header("Location: approve.php");
            }

          }
          


        }

       }

       else if($_SESSION["moderated"]==0){
        header("Location: forum.php");
       }

	?>
  <style type="text/css">
    .link{
    padding-left: 20px;
    padding-right: 20px;
    border: 2.5px solid red;
   }
   img{
    width: 50px;
    height: 50px;
   }
  </style>
</head>
<body>
  <form method = "POST">
  <input type = "text" name = "id">
  <input type = "submit" name = "approve" value = "Approve">
  <input type = "submit" name = "reject" value = "Reject">
  <a href = "logout.php" class = "link">Logout</a>
  <a href = "forum.php">Forum</a>
  </form>
</body>
</html>