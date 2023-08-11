<?php

$datecap=$_GET['msg'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LRP Duplication Report</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
        
        <!-- Our Custom CSS -->
       
</head>
<body>
    
    <div class="container">
       <div class="alert alert-danger">
  <h2><strong><span class="glyphicon glyphicon-warning-sign"></span> Duplication Error!</strong></h2> <h3>LRP Assessment already raised-
       on <strong> <?php echo $datecap; ?></strong></h3>
       
       <p></p>
       <button type="button" name="" class="btn btn-danger" onclick="closeWin()">Close Page!</button>
        </div> 
        
        
    </div>
    
        
     <script type="text/javascript">
    
   function closeWin() {
    window.close();
    } 
function closeWin2() {

       setTimeout(function() {
           window.close();
       }, 3500);
    

    } 
      window.onload=closeWin2();      
    </script>
    
    
</body>
</html>