<html>
<head>
	<title>Comments</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <?php
      
      $link = mysqli_connect("127.0.0.1", "root", "", "maps");
      session_start();
      if(isset($_POST["submit"])){
        if(isset($_POST["search_name"])){
          $search_name = $_POST["search_name"];
        }
            
          
         $query = "SELECT username, entry title, votes, time FROM entry WHERE username = '$search_name' ";
         $sql = mysqli_query($link,$query);

      }
















      ?>
  <script type="text/javascript">

    function autoComplete(){

             
         var name = document.getElementById("search_name").value    
         var xmlhttp = new XMLHttpRequest();
         xmlhttp.open("POST", "search.php", true);
         var parameter = "username="+name;
         xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         xmlhttp.send(parameter);
         xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                 
              

            }


        }
        nameuser="admin";
             var string = {};
         
            $.getJSON("search.json", function(json) {
               //$("#browsers").html(" ");
              for(var k =0;k<json.length;k++){
                if(k==0){
                   document.getElementById("browsers").innerHTML = " ";
                }
                var option = document.createElement("option");
                 option.value = json[k]["username"];
                 console.log(json[k]["username"]);
                document.getElementById("browsers").appendChild(option);
              //  string.content +=  ("<option value = '" +json[k]["username"]+ "'>");
              }
          });     
     }





       
     window.onload = function(){
     document.getElementById("search_name").addEventListener("keyup",autoComplete);
     }

   





  </script>
	<style type="text/css">
      .box{
      	border: 2px solid green;
      	padding: 15px 15px 15px 15px;
      	margin:  35px 35px 35px 35px;
      }
     
	</style>
</head>

<body>
<form method = "POST">
  <div id  = "content"></div>
  <input type = "text" name = "search_name" id = "search_name" list = "browsers">
  <div name = "status" id = "status">
   <input type = "submit" value = "Submit" name = "submit" id = "submit">
   <datalist id = "browsers">
    <option value = "google">

   </datalist>
  </div>
   <a href = "gitcode.php">Back to the map</a>

</form>
</body>
</html>