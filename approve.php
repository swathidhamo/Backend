<html>
<head>
	<title>Posts Pending Approvals</title>
	<?php
    
	  $link = mysqli_connect("127.0.0.1", "root", "", "first_db");
      session_start();
       if(!empty($_SESSION["username"]) && !empty($_SESSION["ascess_level"])){
        $query = "SELECT id, title, info FROM approval";
        $result = mysqli_query($link,$query);
        $rows = mysqli_num_rows($result);

        if($rows==0){
          echo "You have no requests pending";
        }
        
        while($array = mysqli_fetch_array($result)){
           echo  "<div>Note  ".$array["id"]. "<p> Title:     " . $array["title"]."</p> <p>Info:   " . $array["info"]. "</p><br></div>";
        }

        if(isset($_POST["id"]) ){
          $id = $_POST["id"];

          $query_approve = "SELECT title, info FROM approval WHERE id = '$id' ";
          $result_approve = mysqli_query($link,$query_approve);
          $array_approve = mysqli_fetch_array($result_approve);
          $title = $array_approve["title"];
          $info = $array_approve["info"];
         
          if(isset($_POST["approve"])){
            $query_append = "INSERT INTO content (title, info) VALUES ('$title', '$info' )";
            $append_result = mysqli_query($link,$query_append);
            $query_reject = "DELETE FROM approval WHERE id = '$id' ";
            $reject_result = mysqli_query($link,$query_reject);
            if($append_result){
            echo "Sucessfully approved";
            header("Location: approve.php");
            }
          }
          else if(isset($_POST['reject'])){
            $query_reject = "DELETE FROM approval WHERE id = '$id' ";
            $reject_result = mysqli_query($link,$query_reject);
            if($reject_result){
              echo "Sucessfully rejected";
              header("Location: approve.php");
            }

          }
          


        }

       }

	?>
</head>
<body>
  <form method = "POST">
  <input type = "text" name = "id">
  <input type = "submit" name = "approve" value = "Approve">
  <input type = "submit" name = "reject" value = "Reject">
  <a href = "logout.php">Logout</a>
  </form>
</body>
</html>