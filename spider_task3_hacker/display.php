<html>
<head>
	<title>Luncatic</title>
	<?php
    $link = mysqli_connect("127.0.0.1", "root", "", "maps");
    session_start();  
   
    $latS = $_POST["latSE"];
    $lngS = $_POST["lngSE"];
    //$search = $_POST["name"];
    
    //$lat = $_SESSION["lat"];
    //$lng = $_SESSION["lng"];
     echo $latS;
     echo $lngS;
    $latend = $latS + 5.5;
    $latbgn = $latS - 5.5;
    $lngend = $lngS + 5.5;
    $lngbgn = $lngS - 5.5;
    // if($latS==undefined || $latS == null){
      //$query = "SELECT title, entry,lat,lng,username,status,time,votes FROM entry WHERE username = '$search' ";
    //}
    //else{
      $query = "SELECT title, entry,lat,lng,username,status,time,votes FROM entry WHERE lat = '$latS'AND lng = '$lngS' ";
//       $query = "SELECT title, entry,lat,lng,username,status,time,votes FROM entry WHERE (lat >'$latbgn' AND lat< '$latend')
  //       AND (lng>'$lngbgn' AND lng<'$lngend') ";

         if($_SESSION["sort_option"]=="sort_by_time"){
                 $query = "SELECT title, entry,lat,lng,username,status,time,votes FROM entry WHERE lat >=  '$latbgn' AND 
                lng <= '$lngend' AND lat <= '$latend' AND lng >='$lngbgn' ORDER BY time DESC ";   
       }

         if($_SESSION["sort_option"]=="sort_by_votes"){
                $query = "SELECT title, entry,lat,lng,username,status,time,votes FROM entry WHERE lat >= '$latbgn' AND 
               lng <= '$lngend' AND lat <= '$latend' AND lng >='$lngbgn' ORDER BY votes ASC ";   
       }
   //}
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