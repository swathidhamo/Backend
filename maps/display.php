<html>
<head>
	<title>Luncatic</title>
	<?php

    $link = mysqli_connect("127.0.0.1", "root", "", "maps");
    session_start();  
   
    $lat = $_POST["latSE"];
    $lng = $_POST["lngSE"];
    //$lat = $_SESSION["lat"];
    //$lng = $_SESSION["lng"];
    echo $lat;
    echo $lng;

     $query = "SELECT title, entry FROM entry WHERE lat = '$lat' ";
    //$query = "SELECT title, entry FROM entry WHERE id>='24'";

    $sql = mysqli_query($link,$query);
      if($sql){
        
        $emparray =  array();
        while($result = mysqli_fetch_assoc($sql)){

             $emparray[] = $result;
        }

   

    }
    $ther = json_encode($emparray);
    file_put_contents("result.json",$ther);
    




 ?>

</head>
<body>
</body>
</html>