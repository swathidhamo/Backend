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
        }

        //$date = strtotime("+60 seconds");
    
     		$sql = "INSERT INTO code (title,code, language,status,username,visible,times) VALUES (?,?,?,?,?,?,?)";
            $query = mysqli_prepare($link,$sql);
            mysqli_stmt_bind_param($query,"sssisis",$title, $code, $language,$status,$username,$visible,$date);
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

         echo "<p><a href= 'snippet.php?id=".$rows['id']."'>".$rows['title']."</a></p>"; 
         }

     }


	?>
    <style type="text/css">
      textarea{
      	width: 400px;
      	height: 400px;
      }


    </style>
 </head>
<body>
  <form method = "POST">
    Description: <input type= "text" name = "title" placeholder = "Enter a short description or name for the code">
    Code: <textarea name = "code" placeholder= "Insert the snippet"></textarea>
    Language: <input type = "text" name = "language" placeholder = "Enter the language">
    Status Private: <input type = "radio" name = "status">
    Stay anonymous: <input type = "radio" name = "visible">
    Time limit: <select name = "time">
                  <option value = "one">30 minutes</option>
                  <option value = "three"> 90 Seconds</option>  
                  <option value = "two">2 hours</option>
                  <option value = "twelve">12 hours</option>
                </select>
  <input type = "submit" name = "submit" value = "submit">











  </form>
</body>
</html>