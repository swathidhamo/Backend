<html>
 <head>
	<title>New snippet</title>
	<?php

      session_start();
      $link = mysqli_connect("127.0.0.1", "root", "", "delta");

     if(empty($_SESSION["username"])){
      header("Location: index.php");
     }

     else{
     	if(isset($_POST["submit"])){
     		if(isset($_POST["title"])){
     			$title= $_POST["title"];
     		}

     		if(isset($_POST["code"])){
     			$code = $_POST["code"];

     		}


          $files = $_FILES['file']['tmp_name'];
          $file = file_get_contents($files);

     		if(isset($_POST["language"])){
     			$language = $_POST["language"];
     		}
        $username= $_SESSION["username"];
        
        if(isset($_POST["status"])){
          $status =1;
        }
        else{
          $status = 0;
        }

        if(isset($_POST["visible"])){
          $visible =1;
        }
        else{
          $visible = 0;
        }
        if(isset($_POST["time"])){
          $time = $_POST["time"];
          if($time=='one'){
            $date = strtotime("+30 minutes");
          }
          else if($time=='two'){
            $date = strtotime("+2 hours");
          }
          else if($time=='twelve'){
            $date = strtotime("+24 hours");
          }
          else if($time=='three'){
            $date = strtotime("+90 seconds");
          }
          else{
          $date = null;
          }          
        }

    
     		$sql = "INSERT INTO code (title,code, language,status,username,visible,times,file) VALUES (?,?,?,?,?,?,?,?)";
            $query = mysqli_prepare($link,$sql);
            mysqli_stmt_bind_param($query,"sssisiss",$title, $code, $language,$status,$username,$visible,$date,$file);
            $result = mysqli_stmt_execute($query);
     		if($result){
     			echo "Sucessfully added";
     		}
        else{
          echo mysqli_error($link);
        }

     	}
         //RewriteCond %{QUERY_STRING} ^(\w+)=(\w+)$
         //RewriteRule ^/snippet /snippet/%1/%2?


         $query_display = "SELECT id,title FROM code";
         $sql = mysqli_query($link,$query_display);
         while($rows = mysqli_fetch_array($sql)){

         echo "<p><a href= 'snippet.php?id=".$rows['id']."'>".$rows['id']." . ".$rows['title']."</a></p>"; 
         }

     }


	?>
    <style type="text/css">
      textarea{
      	width: 650px;
      	height: 500px;
      }

   .newnote{
     border: 2px solid black;
     padding: 30px 30px 30px 30px;
     
   }

   body {
    font: 13px/20px "Lucida Grande", Tahoma, Verdana, sans-serif;
    color: #404040;
    background: #0ca3d2;

   }
   



  </style>
 </head>
 <body>
  <div class = "newnote">
   <form method = "POST" enctype="multipart/form-data">
      <p> Description: <input type= "text" name = "title" placeholder = "Enter a short description or title for the code" size = "60"></p>
      <p>Code: <textarea name = "code" placeholder= "Insert the snippet"></textarea></p>
      <p>File upload:<input type="file" name="file" /></p>
      <p> Language: <input type = "text" name = "language" placeholder = "Enter the language"></p>
      <p> Status Private: <input type = "radio" name = "status"></p>
      <p> Stay anonymous: <input type = "radio" name = "visible"></p>
      <p> Time limit: <select name = "time">
                  <option value = "one">30 minutes</option>
                  <option value = "three"> 90 Seconds</option>  
                  <option value = "two">2 hours</option>
                  <option value = "twelve">12 hours</option>
                  <option value = "none">Never</option>
                </select></p></p>

       <p><input type = "submit" name = "submit" value = "Create snippet"></p>
  </div>
  <a href = "logout.php">Logout</a>

    </form>
  </body>
</html>''