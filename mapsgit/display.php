<html>
<head>
	<title>Luncatic</title>
	<?php
    $link = mysqli_connect("127.0.0.1", "root", "", "maps");
    session_start();  
   
    $latS = $_POST["latSE"];
    $lngS = $_POST["lngSE"];
    $name_user = $_POST["name"];
    //$lat = $_SESSION["lat"];
    //$lng = $_SESSION["lng"];
    //echo $lat;
    //echo $lng;
    $latend = $latS + 1.0;
    $latbgn = $latS - 1.0;
    $lngend = $lngS + 1.0;
    $lngend = $lngS - 1.0;
     $query = "SELECT title, entry,lat,username,status FROM entry WHERE lat = '$latS' AND lng = '$lngS' ";
    //$query = "SELECT title, entry FROM entry WHERE id>='24'";
    $sql = mysqli_query($link,$query);

      if($sql){
        
        $emparray =  array();

        while($result = mysqli_fetch_assoc($sql)){
          if($result["status"]==1){
            if($name_user==$result["username"]){

             $emparray[] = $result;
           }
            else{
                $emparray[] = " not ascess";
            }

         }
         else{
             $emparray[] = $result;
         }
        }
   
    }
    $ther = json_encode($emparray);
    file_put_contents("result.json",$ther);
    
 ?>

</head>
<body>
</body>
</html>