<html>
<head>
	<title>Code snippets created</title>
	<?php
     
    $link = mysqli_connect("127.0.0.1", "root", "", "delta");

    $query_display = "SELECT id,title FROM code";
    $sql = mysqli_query($link,$query_display);
     while($rows = mysqli_fetch_array($sql)){

       echo "<p><a href= 'snippet.php?id=".$rows['id']."'>".$rows['id']." . ".$rows['title']."</a></p>"; 
      }

     mysqli_close($link);


	?>
</head>
<style type="text/css">
   body {
    font: 13px/20px "Lucida Grande", Tahoma, Verdana, sans-serif;
    color: #404040;
    background: #0ca3d2;

   }
   

</style>
<body>
  <div>Any snippet can be ascessed by the id displayed alongside in the format /snippet.php?id="your id number"</div>
</body>
</html>