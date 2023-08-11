<?php 



$assyr=$_GET['data1'];
$basis=stripslashes($_GET['data2']);
$ttype=$_GET['data3'];
$suser=$_GET['data4'];
$page='captureadmin';

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Approval</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
    
                     
   
</head>
<body>
   <div id="showArea" class="container-fluid">
           
          
            <div id="verify">
             <div class="row-fluid col-md-4">
                 
             <img src="<?php 
             
            if ($ttype=="CIT")	{
					echo 'img/bg.jpg';
				}   
            if ($ttype=="WHT")	{
					echo 'img/bg.jpg';
				}   
				if ($ttype=="EDT"){
					echo 'img/bg2.jpg';
				}	
				
				if ($ttype=="VAT"){
               echo 'img/bg3.jpg';
               $page='capturevat';
				}	
				if ($ttype=="POL"){
					echo 'img/bg.jpg';
				}?>	" height="700px" width="520px" alt="">
               
                
                
             </div>

       
                <!--second row-->
             <div class="row-fluid col-md-4">
         
                      <div class="alert-success" id="screen"><h3>Your <?php echo $ttype ?> <?php echo $basis ?> Assessment,  For <?php echo $assyr ?> YOA Has been Raised &amp; Registered. However, it has been forwarded to the Tax Controller for Approval.<p></p>
                        
                      Kindly Check your Assessment Outbox for Status Update.<i class="glyphicon glyphicon-ok"></i> </h3> </div>
                         <p></p>
                         <a target="dframe" href="<?php echo $page ?>?user=<?php echo $suser ?>" class="btn btn-primary"> Raise Another Assessment</a>&nbsp;<a target="dframe" href="<?php echo $page ?>?user=<?php echo $suser ?>" class="btn btn-success" onclick="myhome()"> Return Home &amp; Close </a>
                </div>          
                         
                <div class="row-fluid col-md-4">
                     
                      <div><p></p></div>
                      <div><p></p></div>
    <p></p>
               <p></p>
                
                
                
     
                
                
                <p></p>
                
                        
               
                
                </div>
                    
     
   </div>
    </div>
    
   <script src="js3/jquery-1.12.4.js">
   </script>
   
<script>
function myhome() {
   
	window.close();
}
</script>
  
  
    
</body>
</html>
       
    

 

