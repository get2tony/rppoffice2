<?php

$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Self Assessment Registers</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
     <link rel="stylesheet" href="css3/style4.css">
</head>
<body>
   
      <div class="panel "><h4><span style="font-weight:bold;">Manage/Edit Received Returns for <?php echo date('Y') ?> YOA</span></h4></div>
       <div class="container">
             <div class="row">
             <div class="col-xs-3"><a href="tablepage?user=<?php echo $suser?>&tab=current"><img src="img/003-folder-4.png" alt=""></a></div>
             <div class="col-xs-3"><a href="tablepage?user=<?php echo $suser?>&tab=back_year"><img src="img/004-folder-3.png" alt=""></a></div>
             <div class="col-xs-3"><a href="tablecit?user=<?php echo $suser?>"><img src="img/007-folder.png" alt=""></a></div>
             <div class="col-xs-3"><a href="tablecitview?user=<?php echo $suser?>&tab=current"><img src="img/003-folder-4.png" alt=""></a></div>
             
           </div>
           <div class="row">
               
               
               <div class="col-xs-3"><a  class="btn btn-primary" href="tablepage?user=<?php echo $suser?>&tab=current">Current  Register for <?php echo date('Y') ?> YOA</a></div>
               <div class="col-xs-3"><a  class="btn btn-primary" href="tablepage?user=<?php echo $suser?>&tab=back_year">BackYear  Register for <?php echo date('Y') ?> YOA</a></div>
               <div class="col-xs-3"><a  class="btn btn-primary" href="tablecit?user=<?php echo $suser?>"> CIT Compliance status</a></div>
               <div class="col-xs-3"><a  class="btn btn-primary" href="tablecitview?user=<?php echo $suser?>"> CIT Filers Contacts</a></div>
           </div>
            
           
        </div> 
    <hr>
      <h4 class=""><span style="font-weight:bold;">Manage/Edit Received Returns from  Period - <?php echo date('Y') ?> YOA</span></h4>
      <hr>
       <div class="container">
             <div class="row">
             <div class="col-xs-3"><a href="tablesearch?user=<?php echo $suser?>"><img src="img/007-folder.png" alt=""></a></div>
             <div class="col-xs-3"><a href="tablepage2?user=<?php echo $suser?>&tab=current"><img src="img/003-folder-4.png" alt=""></a></div>
             <div class="col-xs-3"><a href="tablepage2?user=<?php echo $suser?>&tab=back_year"><img src="img/004-folder-3.png" alt=""></a></div>
             <div class="col-xs-3"><a href="tabletax?user=<?php echo $suser?>"><img src="img/007-folder.png" alt=""></a></div>
             
           </div>
           <div class="row">
               
               
               <div class="col-xs-3"><a  class="btn btn-primary" href="tablesearch?user=<?php echo $suser?>">Search Filing History</a></div>
               <div class="col-xs-3"><a  class="btn btn-primary" href="tablepage2?user=<?php echo $suser?>&tab=current">All Current  Register</a></div>
               <div class="col-xs-3"><a  class="btn btn-primary" href="tablepage2?user=<?php echo $suser?>&tab=back_year">All BackYear  Register</a></div>
               <div class="col-xs-3"><a  class="btn btn-primary" href="tabletax?user=<?php echo $suser?>"> Tax Position</a></div>
           </div>
            
           
        </div> 
        <hr>
       <div class="container">
             <div class="row">
             <div class="col-xs-3"><a href="tablecit3?user=<?php echo $suser?>"><img src="img/007-folder.png" alt=""></a></div>
             <div class="col-xs-3"><a href="tablecit4?user=<?php echo $suser?>"><img src="img/007-folder.png" alt=""></a></div>
             </div>
           <div class="row">
               
               
               <div class="col-xs-3"><a  class="btn btn-primary" href="tablecit3?user=<?php echo $suser?>"> World Bank Temp</a></div>
               <div class="col-xs-3"><a  class="btn btn-primary" href="tablecit4?user=<?php echo $suser?>"> RPP Compliance (Indepth)</a></div>
              
           </div>
            
           
        </div> 
        
    
</body>
</html>