<html>
<head>
	 
	<title>Maps</title>
  <?php
   session_start();
   $link = mysqli_connect("127.0.0.1", "root", "", "maps");
   echo "Welcome to your account  ".$_SESSION["username"]." ";
   echo  "<input type = 'text' id = 'uname' name = 'uname' value = ".$_SESSION['username'].">";
  
      $_POST["uname"] = $_SESSION["username"];
     if($_POST["submit"] || !empty($_POST["submit"])){
        if(isset($_POST["status"])){
          $status = $_POST["status"];
        }
       
        
        if(isset($_POST["entry"])){
           $entry  = $_POST["entry"];
        } 
        if(isset($_POST["title"])){
           $title  = $_POST["title"];
        } 
               $lat = $_SESSION["lat"];
               $lng = $_SESSION["lng"];
           
          // $username = $_SESSION["username"];  
           //$time = strtotime("now");
           //$username = "admin";
               $username  = $_SESSION["username"];
           $createdate= date('Y-m-d H:i:s');
           $votes = 0;
         $query = "INSERT INTO entry (username, entry, title, lat, lng,status,time,votes) VALUES 
         ('$username','$entry','$title','$lat','$lng','$status','$createdate','$votes')";
         $sql = mysqli_query($link,$query);
        if($sql){
          echo "Sucessfully updated";
      
       }
       else{
        echo "Not updated  ";
        echo mysqli_error($link);
       }
     }
          //$query = "SELECT title, entry FROM entry WHERE lat = '$lat' AND lng = '$lng' ";
    if(isset($_POST["sort_submit"])){
      if($_POST["sort"]==2){
        $_SESSION["sort_option"] = "sort_by_time";
      }
      else if($_POST["sort"] ==1){
        $_SESSION["sort_option"] = "sort_by_votes";
      }
      
    }
    else{
      $_SESSION["sort_option"] = "no";
    }
   
  
    if(!empty($_GET["id_vote"]) ) {
      $id_vote = $_GET["id_vote"];
      $query_vote = "UPDATE entry SET votes = votes + 1 WHERE id = '$id_vote' ";
      $result_vote = mysqli_query($link,$query_vote);
      if($result_vote){
        echo "Voting sucessful";
        $_GET["id_vote"] = null;
        
      }
      else{
        echo "Voting unsucessful";
      }
    }
    
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
    #uname{
      display: none;
    }
    textarea{
    	width: 800px;
    	height: 250px;
    }
    .info{
      border: 2px solid red;
      margin-right: 100px;
      margin-left: 30px;
      padding: 15px 30px 15px 15px;
    }
    #contents{
      border: 2px solid blue;
      margin-right: 100px;
      margin-left: 30px;
      padding: 15px 30px 15px 15px;
    }
    </style>
       
    <script type="text/javascript">
    var markerIndex = 0;
    var i = 0;
    var latVar, lngVar;
    var parameter;
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
  /* function markerInfoSend(x,y){
    
       console.log("workd");
       var xml = new XMLHttpRequest(); 
       var parameters = "lat="+x+"&lng="+y;
       xml.open("GET","display.php",true);
       xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       xml.onreadystatechange = function() {
        if(xml.readyState == 4 && xml.status == 200) {
           document.getElementById('usernameStatus').innerHTML=x+"sent again data<br />";
      }
    }
        xml.send(parameters);
  } */
           function markerInfoSend(xe,ye){
            var nameuser = document.getElementById("uname").value;
            
        var xmlhttp = new XMLHttpRequest();
         xmlhttp.open("POST", "display.php", true);
         var parameter = "latSE="+xe+"&lngSE="+ye+"&name="+nameuser;
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         xmlhttp.send(parameter);
        xmlhttp.onreadystatechange = function() {
          
          console.log(xe + "   " + ye);
        if (this.readyState == 4 && this.status == 200) {
          // var myObj = this.responseText;
         // console.log(this.responseText);
           //console.warn(xhr.responseText);
        
          
            }
        };
         
         //xmlhttp.responseType = "json";
        /* $.getJSON("result.json", function(data) {
             $("#content").innerHTML = data["title"];
             console.log("title");
             console.log(data["title"]);
            
         });*/
         var request = new XMLHttpRequest();
         document.getElementById("content").innerHTML = " work now ";
        request.open('GET', 'result.json', true);
        request.onload = function () {
       // begin accessing JSON data here
        var data = JSON.parse(this.responseText);
        console.log(data.length);
     //var ti="title"
     for(var k = 0; k<data.length;k++){
      if(data[k]["status"]==1){
        if(data[k]["username"]==nameuser){
           document.getElementById("content").innerHTML += 
           "<p class = 'info'>Entry by :  "+data[k]["username"]+"</p><p class = 'info'>   Title: "+
           data[k]["title"]+"  At: "+data[k]["time"]+ "  "+"</p><p id = 'contents'>  " + data[k]["lat"]+"   "
           +data[k]["lng"] +data[k]["entry"] + "<p class = 'info'>Votes: "+data[k]["votes"]+"  "+
           "<a name  = 'vote'href='gitcode.php?id_vote="+data[k]["id"]+"'>Upvote</a></p></p>";
   
        }
        else{
          document.getElementById("content").innerHTML += "<p class = 'info'>That is a private entry by " + data[k]["username"]+" </p>";
        }
      }
      else{
       document.getElementById("content").innerHTML += 
       "<p class = 'info'>Entry by :  "+data[k]["username"]+"</p><p class = 'info'>   Title: "+
       data[k]["title"]+"  At: "+data[k]["time"]+ "  "+"</p><p id = 'contents'>   "+ data[k]["lat"]+"   "
       +data[k]["lng"] +data[k]["entry"] + "<p class = 'info'>Votes: "+data[k]["votes"]+"  "+
       "<a name  = 'vote'href='gitcode.php?id_vote="+data[k]["id"]+"'>Upvote</a></p></p>";
     }
   
   }
    console.log(data[0]["title"]);
  //  document.getElementById("content").innerHTML += "<p id = 'info'>Entry by :  "+data[0]["username"]+"   "+data[0]["title"]+"</p><p id = 'contents'>   "+data[0]["entry"]+data[0]["lat"]+   "</p>";
  
}
   
           request.send();
           console.log(document.getElementById("uname").value);
        $.getJSON("result.json", function(json) {
   // console.log(json); // this will show the info it in firebug console
});
          
}
     
    </script>
    <script type="text/javascript">
      var lngArray = [];
      var latArray = [];
      var multiple_entry = false;


     function saveMarker(x,y,i){
       if(latArray!=null&&lngArray!=null){
         latArray.push(x);
         lngArray.push(y);
       }
       else{
        latArray = [];
        lngArray = [];
       }
       
         markerInfo(x,y);
        // latArray.push(x);
         //lngArray.push(y);
         $("#entry").show();
        // $("#content").innerHTML = " ";
         localStorage.setItem("lat",JSON.stringify(latArray));
         localStorage.setItem("lng",JSON.stringify(lngArray));
         console.log(latArray);
         i++;
         localStorage.setItem("index",i);

     }








  
    function myMap() {
  
      
       var myCenter = new google.maps.LatLng(20.508742,78.120850);//set the centre for the map at first
       var mapCanvas = document.getElementById("maps");//to get the area where we will be setting up our map
       var mapProperties = {//to create a object that will store the properties of the map we are about to display
       	   center: myCenter, 
       	   zoom: 2, 
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
             marker.setMap(map);
             if(multiple_entry){
              marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
             }
           // marker.setIcon('http://www.traveldiariesapp.com/Content/Images/travel-diaries-logo-home.png');
            marker.addListener("click",function(){
              console.log("hi");
              /*document.cookie = "lng"+location.lat;
              document.cookie = "lat="+ location.lng;
              document.cookie= "location=yes";*/
              markerInfoSend(location.lat,location.lng);
              console.log(location.lat + " this is the lgn ");
              console.log(location.lng);
           
                
            });
              marker.addListener("dblclick",function(){
              console.log("create");
              marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
               //multiple_entry = true;
              saveMarker(location.lat,location.lng,i);
               //RHIS BIT IS OUT
           /*  markerInfo(location.lat,location.lng);
               latArray.push(location.lat);
               lngArray.push(location.lng);
              $("#entry").show();
              localStorage.setItem("lat",JSON.stringify(latArray));
              localStorage.setItem("lng",JSON.stringify(lngArray));
              console.log(latArray);
              i++;
              localStorage.setItem("index",i);*/
           
                
            });
    
          }

            
       
       google.maps.event.addListener(map, 'click', function(event) {
         //latVar = "lat" + i;
         //lngVar = "lng" + i;
         multiple_entry = false;
         placeMarker(event.latLng);
         //ANS HERE
         var lat = event.latLng.lat();
         var lng = event.latLng.lng();
         saveMarker(lat,lng,i);
         console.log("clicked!!!");
         /*markerInfo(lat,lng);
        if(latArray!=null&&lngArray!=null){
         latArray.push(lat);
         lngArray.push(lng);
       }
       else{
        latArray = [];
        lngArray = [];
       }
        // marker.setMap(map);
         //localStorage.setItem("position",event.latLng);
         //localStorage.setItem(latVar,lat);
         //localStorage.setItem(lngVar,lng);
         localStorage.setItem("lat",JSON.stringify(latArray));
         localStorage.setItem("lng",JSON.stringify(lngArray));
         console.log(latArray);
         i++;
        
         localStorage.setItem("index",i);
         //console.log(lat);
         $("#entry").show();*/
         
        });
    
      
       
        window.onload = function(){
        if(localStorage.getItem("index")!=null){
          latArray = JSON.parse(localStorage.getItem("lat"));
          lngArray = JSON.parse(localStorage.getItem("lng"));
        }
        else{
          latArray = [];
          lngArray = [];
        }
          i = localStorage.getItem("index");
          latIntro = JSON.parse(localStorage.getItem("lat"));
         
          lngIntro = JSON.parse(localStorage.getItem("lng"));
         
          if(latIntro!=null){
           lngIntro = lngIntro.sort();
          latIntro = latIntro.sort();
          }
        for(var j = 0;j<parseInt(localStorage.getItem("index"));j++){
          if(latIntro[j-1]==latIntro[j]){
             multiple_entry = true;
          }
          else{
            multiple_entry = false;
          }
          //latIntro = "lat" + j;
          //lngIntro = "lng" + j;
         var locationMarker = {
          lat: parseFloat(latIntro[j]),
          lng: parseFloat(lngIntro[j])
      }
       placeMarker(locationMarker);
    }
  }
       
}
     
    
</script>


	<?php
    //session_start();   
  /*   if($_COOKIE["info"]=="yes") {
                  $latS = $_COOKIE["lat"];
                  $lngS = $_COOKIE["lng"]; 
                  $query = "SELECT id,title,entry FROM entry WHERE lat = '$latS' AND lng = '$lngS'";
                  ECHO "YES";
                  $sql = mysqli_query($link,$query);
                  if($sql){
                     while($result = mysqli_fetch_array($sql)){
                      print  "<div>Snippet  ".$result["id"]. "<p> Title:     " . 
                      $result["title"]."</p> <p>Entry:   ".$result["entry"]. 
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
           
           $username = $_SESSION["username"];       
         $query = "INSERT INTO entry (username, entry, title, lat, lng,status) VALUES 
         ('$username','$entry','$title','$lat','$lng','$status')";
         $sql = mysqli_query($link,$query);
        if($sql){
         	echo "Sucessfully updated";
      
       }
       else{
       	echo "Not updated";
       	echo mysqli_error($link);
       }
     }
          //$query = "SELECT title, entry FROM entry WHERE lat = '$lat' AND lng = '$lng' ";
    
    */
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
     <p>Private<select name = "status">
      <option value = "0">Public</option>
      <option value = "1">Private</option>
     </select></p>
     <input type = "submit" name = "submit">
    
       <input type = "text" name = "comment_content">
       <input type = "text" name = "comment_username">

 </div>
    <a href="logout.php">Logout</a>
      
      <p>Sort By<select name = "sort">
      <option value = "2">Time</option>
      <option value = "1">Votes</option>
     </select></p>
     Sort:<input type = "submit" name = "sort_submit" value = "sort">
</form>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIEXY3Y8DysLQt5Se7ecaikiw6OUlxZJY&callback=myMap"></script>
</body>
</html>