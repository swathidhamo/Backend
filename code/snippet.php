<html>
<head>
	<title>Code snippets</title>
	<?php
  session_start();
	$link = mysqli_connect("127.0.0.1", "root", "", "delta");
   
    if(isset($_GET["id"])){
    	$id = $_GET["id"];
    }

    $query = "SELECT id, title, code, language,status,username,visible,times FROM code WHERE id = $id";
    $sql = mysqli_query($link,$query);
    
   	
   	while($result = mysqli_fetch_array($sql)){
      $current_time =strtotime("now");
     if($result["times"]>=$current_time){
     
      if($result["status"]==1 && $result["username"]==$_SESSION["username"]){
        //for code that is set private
   		  print  "<div>Snippet  ".$result["id"]. "<p> Title:     " . $result["title"]."</p> <p>Code:   " . $result["code"]. "</p><p> language: ".$result['language']."<br></div>";
        }
        else if($result["status"]==0){
        //for code that is set as public
        if($result["visible"]==0){
          echo "Code contributed by : ".$result["username"];
         } 

         print  "<div>Snippet  ".$result["id"]. "<p> Title:     " . $result["title"]."</p> <p>Code:   " . $result["code"]. "</p><p> language: ".$result['language']."<br></div>";
         }
        else{
          echo "Sorry this code is set private by the contributor";
        }

     }
     else{
      echo "post has expired";
     }

    }
   	
     



	?>
</head>
<body>

</body>
</html>