<?php 

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once(dirname(__FILE__) . '/dbconfig/config.php');


$file = isset($_REQUEST['file']) ? $_REQUEST['file'] : null;
$errormsg='';
$errormsg2='';
;
$errormsg = $msg= '<h1>Database Backup!</h1>
    <p>Your download will start in a moment. If it doesnt, click <a class="btn btn-success" href="download.php?file='.$file.'">direct link.</a></p>';   

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Back Up Report</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">

    <script type="text/javascript">
        function startDownload() {
            window.location="download.php?file=<?php echo $file ?>";
        }
    </script>

                     
   
</head>
<body onload="startDownload()">
   <div id="showArea" class="container-fluid">
           
          
            <div id="verify">
             <div class="row-fluid col-md-4">
                 
             
               
                
                
             </div>

       
                <!--second row-->
             <div class="row-fluid col-md-4">
                
                            
                 <?php
                    
                   if ($errormsg2==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4><i class="glyphicon glyphicon-remove"></i> '.$errormsg2.' </h4> </div>');
                   }
                    
                     if ($errormsg==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen"><h4> '.$errormsg.' </h4> </div>');
                   }
                    ?>
                       
                        
                        
                         
                </div>          
                         
                <div class="row-fluid col-md-4">
                     
                      <div><p></p></div>
                      <div><p></p></div>
    <p></p>
               <p></p>
                <!-- <a target="dframe" href="backup.php" class="btn btn-default"> Go Back</a> -->
                
                
     
                
                
                <p></p>
                
                        
               
                
                </div>
                    
     
   </div>
    </div>
    
   <script src="js3/jquery-1.12.4.js">
   </script>
   
   
  
  
    
</body>
</html>
       
    

 

