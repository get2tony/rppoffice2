<?php 


include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

$errormsg='';
$errormsg2='';

$errormsg = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$errormsg2 = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$suser= isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$ustatus= isset($_REQUEST['status']) ? $_REQUEST['status'] : null;
   
$usersno=isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$dept=checkUserdept($usersno,$conn);

$page='tableapp';

if ($dept=='vat') {
  $page='tableappvat';
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Assessment Report</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
    
                     
   
</head>
<body>
   <div id="showArea" class="container-fluid">
           
          
            <div id="verify">
             <div class="row-fluid col-md-4">
                 
             
               
                
                
             </div>

       
                <!--second row-->
             <div class="row-fluid col-md-4">
                
                            
                 <?php
                    
                   if ($errormsg==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4><i class="glyphicon glyphicon-remove"></i> '.$errormsg.' </h4> </div>');
                   }
                    
                     if ($errormsg2==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen"><h4><i class="glyphicon glyphicon-ok"></i> '.$errormsg2.' </h4> </div>');
                   }
                    ?>
                       
                        
                        
                         
                </div>          
                         
                <div class="row-fluid col-md-4">
                     
                      <div><p></p></div>
                      <div><p></p></div>
    <p></p>
               <p></p>
                <a target="dframe" href="<?php echo $page ?>?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&status=<?php echo $ustatus ?>" class="btn btn-default"> Go Back</a>
                
                
     
                
                
                <p></p>
                
                        
               
                
                </div>
                    
     
   </div>
    </div>
    
   <script src="js3/jquery-1.12.4.js">
   </script>
   
   
  
  
    
</body>
</html>
       
    

 

