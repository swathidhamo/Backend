<html>
<head>
	 
	<title>Maps</title>
  <?php
   session_start();
   $link = mysqli_connect("127.0.0.1", "root", "", "maps");


  ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style type="text/css">
	
	#maps{ 
      width: 400px;
      height: 400px;
    }
    
    #entry{
    	display: none;
    }
    textarea{
    	width: 800px;
    	height: 250px;
    }

    </style>
       
    <script type="text/javascript">

    var markerIndex = 0;
    var i = 0;
    var latVar, lngVar;
    //var marker;
   


   
   

    function markerInfo(x,y){
    
     
       var xml = new XMLHttpRequest(); 
       var parameters = "lat="+x+"&lng="+y;
       xml.open("POST","data.php",true);
       xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       xml.onreadystatechange = function() {
        if(xml.readyState == 4 && xml.status == 200) {
           document.getElementById('usernameStatus').innerHTML=x+"sent data<br />";
      }
    }


        xml.send(parameters);
  } 


   function markerInfoSend(x,y){
    
     
       var xml = new XMLHttpRequest(); 
       var parameters = "lat="+x+"&lng="+y;
       xml.open("POST","display.php",true);
       xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       xml.onreadystatechange = function() {
        if(xml.readyState == 4 && xml.status == 200) {
           document.getElementById('usernameStatus').innerHTML=x+"sent again data<br />";
      }
    }


        xml.send(parameters);
  } 




    </script>
    <script type="text/javascript">

    function myMap() {
  
      
       var myCenter = new google.maps.LatLng(51.508742,-0.120850);//set the centre for the map at first
       var mapCanvas = document.getElementById("maps");//to get the area where we will be setting up our map
       var mapProperties = {//to create a object that will store the properties of the map we are about to display
       	   center: myCenter, 
       	   zoom: 5, 
       	   mapTypeId: google.maps.MapTypeId.HYBRID

       	};
       var map = new google.maps.Map(mapCanvas, mapProperties);
       var infoWindow, messageWindow;
       infoWindow = new google.maps.InfoWindow;
       //to draw a map in area mapCanvas using the properties defined in mapproperties

          function placeMarker(location) {//to create a constructor that will define the marker that is created
            var marker = new google.maps.Marker({
            position: location, 
            map: map });

            marker.addListener("click",function(){
              console.log("hi");
              document.cookie = "lng"+location.lat;
              document.cookie = "lat="+ location.lng;
              document.cookie= "location=yes";
            });

           // document.cookie = "";
          }
            
       
       google.maps.event.addListener(map, 'click', function(event) {

         latVar = "lat" + i;
         lngVar = "lng" + i;
         placeMarker(event.latLng);
         var lat = event.latLng.lat();
         var lng = event.latLng.lng();
         console.log("clicked!!!");
         markerInfo(lat,lng);

        // marker.setMap(map);
         //localStorage.setItem("position",event.latLng);
         localStorage.setItem(latVar,lat);
         localStorage.setItem(lngVar,lng);
         i++;
         localStorage.setItem("index",i);
         //console.log(lat);

         $("#entry").show();
         
        });



    


      


       


        window.onload = function(){

          i = localStorage.getItem("index");
        for(var j = 0;j<parseInt(localStorage.getItem("index"));j++){
          latIntro = "lat" + j;
          lngIntro = "lng" + j;
         var locationMarker = {
          lat: parseFloat(localStorage.getItem(latIntro)),
          lng: parseFloat(localStorage.getItem(lngIntro))
      }
      placeMarker(locationMarker);
    }
  }
       
}


     

    

</script>


	<?php


    //session_start();   


     if($_COOKIE["info"]=="yes") {
                  $latS = $_COOKIE["lat"];
                  $lngS = $_COOKIE["lng"]; 
                  $query = "SELECT id,title,entry FROM entry WHERE lat = '$latS' AND lng = '$lngS'";
                  ECHO "YES";
                  $sql = mysqli_query($link,$query);
                  if($sql){
                     while($result = mysqli_fetch_array($sql)){
                      print  "<div>Snippet  ".$result["id"]. "<p> Title:     " . $result["title"]."</p> <p>Entry:   ".$result["entry"]. 
                      "</p><p><br></div>";
                          }
                     }
              }
 


     if($_POST["submit"]){
        if(isset($_POST["entry"])){
           $entry  = $_POST["entry"];
        } 

        if(isset($_POST["title"])){
           $title  = $_POST["title"];
        } 

        if(isset($_POST["status"])){
          $status = 1;
        }
        else{
          $status = 0;
        }

           $lat = $_SESSION["lat"];
           $lng = $_SESSION["lng"];

           $username = "Swathi";       

         $query = "INSERT INTO entry (username, entry, title, lat, lng,status) VALUES ('$username','$entry','$title','$lat','$lng','$status')";
         $sql = mysqli_query($link,$query);
        if($sql){
         	echo "Sucessfully updated";
      
       }
       else{
       	echo "Not updated";
       	echo mysqli_error($link);
       }


     }


   

    
 ?>

</head>
<body>
 <div id = "maps"></div>
 <div id = "content"></div>
 <form method = "POST">
 	<a href = "entry.php"></a>
 <div id = "entry">
     <p>Title: <input type = "text" name = "title"></p>
     <span id = "usernameStatus"></span>
     <p>Entry: <textarea name = "entry"></textarea></p>
     <p>Private<input type = "radio" name = "private"></p>
     <input type = "submit" name = "submit">
 </div>
</form>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIEXY3Y8DysLQt5Se7ecaikiw6OUlxZJY&callback=myMap"></script>
</body>
</html>