<?php


    $suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
    $usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage LRP Registers</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
     <link rel="stylesheet" href="css3/style4.css">
      <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
   
      <div class="panel "><h2>Manage LRP Registers</h2></div>
       <div class="container">
             <div class="row">
             <div class="col-xs-3"><a href="tablelrp?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&tab=lrpcurrent"><img src="img/003-folder-4.png" alt=""></a></div>
             <div class="col-xs-3"><a href="tablelrp?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&tab=lrpback_year"><img src="img/004-folder-3.png" alt=""></a></div>
             <div class="col-xs-3"><a href="raiselrp?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>"><img src="img/002-file.png" alt=""></a></div>
             <div class="col-xs-3"><a href="raiselrp2?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>"><img src="img/002-file.png" alt=""></a></div>
             
           </div>
           &nbsp;
           <div class="row">
               
               
               <div class="col-xs-3"><a class="btn btn-primary" href="tablelrp?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&tab=lrpcurrent">LRP Current  Register</a></div>
               <div class="col-xs-3"><a class="btn btn-primary" href="tablelrp?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&tab=lrpback_year">LRP BackYear  Register</a></div>
               <div class="col-xs-3"><a class="btn btn-primary" href="raiselrp?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>">Raise CIT LRP  ( Auto ) </a></div>
               <div class="col-xs-3"><a class="btn btn-success" href="raiselrp2?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>">Raise CIT LRP  ( Manual ) </a></div>
           </div>
            
           
        </div><br>
       <div class="container">
             <div class="row">
             <div class="col-xs-3"><a href="lrpasearchvat?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>" target="dframe"><img src="img/003-folder-4.png" alt=""></a></div>
            
             
           </div>
           &nbsp;
           <div class="row">
               
               
               <div class="col-xs-3"><a class="btn btn-primary" href="lrpasearchvat?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>" target="dframe">LSP VAT Registers</a></div>
               
           </div>
            
           
        </div> 
        
        
    
</body>
</html>