
<?php




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sent for Approval</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
        
        <!-- Our Custom CSS -->
       
</head>
<body >
    
    <div class="container">
       <div class="alert alert-success">
  <h2><strong><span class="glyphicon glyphicon-warning-sign"></span> Approval Required!</strong></h2> <h3>LRP / LSP ASSESSMENT HAS BEEN SENT FOR APPROVAL
       on <strong> <?php echo date('d-m-Y') ?></strong></h3>
       
       <p></p>
       <button type="button" name="" class="btn btn-danger" onclick=" closeWin2();">Close Page!</button>
        </div> 
        
        
    </div>
    
        
     <script type="text/javascript">
    function closeWin2() {
    window.close();
    } 
  
    
   function closeWin() {

       setTimeout(function() {
           window.close();
       }, 3500);
    

    } 
      window.onload=closeWin();   
    </script>
    
    
</body>
</html>