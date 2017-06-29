<html>
<head>
	<title>Registeration Page</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 

 

<?php
     session_start();
    $link = mysqli_connect("127.0.0.1", "root", "", "delta");

   if(isset($_POST["create"]) && $_SESSION["avaliable"]){
    	if(isset($_POST["username"])){
    		$username = $_POST["username"];
    		
    	}

    	if(isset($_POST["password"])){
    		$password = $_POST["password"];
    		
    	}

        if(isset($_POST["name"])){
            $name = $_POST["name"];
        }
         
          $hash = getPasswordHash($password); 

    
        $sql = "INSERT INTO user_info (username, password,name) VALUES ('$username', '$hash','$name')";
        $query = mysqli_query($link,$sql);
    
    	if($query){
    		header("Location: index.php");
    	}
    	else{
    		echo mysqli_error($link);
    	}

     }

// calculate the hash from a salt and a password
    function getPasswordHash( $password )
 {
    return ( hash( 'md5', $password ) );
  }


// get a new hash for a password



	?>

<!--    <script type="text/javascript">

    var input = document.getElementById("username");
  input.addEventListener("keyup", function(){
    console.log("Hello");
    var status = document.getElementById("usernameStatus");
    var username = document.getElementById("username").value;
    if(username != ''){
      status.innerHTML = '<b style = "color: red;> Checking.....'
      var request = new XMLHttpRequest();//creating a xml http request
      request.open('GET',"checkdata.php?username = "+encodeURIComponent(username),true);
      //request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
     // request.setRequestHeader('Content-Type', "text/plain;charset=UTF-8");
       
      request.onreadystatedchange = function(){
      if(request.readyState == 4 && request.status ==200){
        status.innerHTML = request.responseText;
         }
      }
     var name = "username =" + username;

      request.send(null);
    }

  });


  </script>
 <script type="text/javascript">

     $(document).ready(function(){
        $("#username").change(function(){
             $("#message").html("checking...");


        var username = $("#username").val();

          $.ajax({
                type:"post",
                url:"checkdata.php",
                data:"username =" + username,
                    success:function(data){
                    if(data==0){
                        $("#message").html("<span style='font-size:13px; color: black'> Username available</span>");

                    }
                    else{
                        $("#message").html("<span style=font-size:13px; color: red'> Username already taken</span>");
                    }
                }
             });

        });

     });
     console.log(data);

   </script>-->

   <script type="text/javascript">

     window.onload = function(){
      var name = document.getElementById("username");
      name.addEventListener("keyup",username_check);
      console.log("hi");
    }

  function username_check(){
    var username = document.getElementById("username").value;

  

   var xml = new XMLHttpRequest(); 
   var parameters = "username="+username;
   xml.open("POST","checkdata.php",true);
   xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xml.onreadystatechange = function() {
  if(xml.readyState == 4 && xml.status == 200) {
   document.getElementById('usernameStatus').innerHTML=xml.responseText+"<br />";

      }
    }


   xml.send(parameters);
  } 
</script>
  <style type="text/css">
   .login{
     border: 2px solid black;
     border-radius: 1px 1px 1px 1px;
     padding: 15px 15px 15px 15px;
     margin right: 400px;
     margin-top: 210px;
     margin-left: 210px;
     width: 450px;
     font-size: 20px;
   }

   body {
    font: 13px/20px "Lucida Grande", Tahoma, Verdana, sans-serif;
    color: #404040;
    background: #0ca3d2;

   }
   



  </style>
  
</head>

<body>
  <div class = "login">
  <form method = "POST">
      <p> Username: <input type = "text" name = "username" id = "username">
        <span id = "usernameStatus"></span></p>
      <p> Password: <input type = "text" name = "password"></p>
      <p> Name: <input type = "text" name = "name"></p>
    <p><input type = "submit" name = "create" value="Register"></p> 
  </form>
</div>



</body>
</html>