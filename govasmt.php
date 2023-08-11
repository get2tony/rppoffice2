<?php


    $suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
    $usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage/Edit Gov't Assessment Registers</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
     <link rel="stylesheet" href="css3/style4.css">
</head>
<body>
   
      <div class="panel "><H2>Manage/Edit Assessment Registers</H2></div>
       <div class="container">
             <div class="row">
             <div class="col-xs-2"><a href="tablegov?sno=<?php echo $usersno ?>&user=<?php echo $suser?>&type=cit"><img src="img/check-mark.png" alt="CIT" width="128px" height="128px"></a></div>
             <div class="col-xs-2"><a href="tablegov?sno=<?php echo $usersno ?>&user=<?php echo $suser?>&type=edt"><img src="img/contract.png" alt="EDT" width="128px" height="128px"></a></div>
             <div class="col-xs-2"><a href="tablegov?sno=<?php echo $usersno ?>&user=<?php echo $suser?>&type=boj"><img src="img/curriculum.png" alt="BOJ" width="128px" height="128px"></a></div>
             <div class="col-xs-2"><a href="tablegov?sno=<?php echo $usersno ?>&user=<?php echo $suser?>&type=vat"><img src="img/check-box.png" alt="VAT" width="128px" height="128px"></a></div>
             <div class="col-xs-2"><a href="tablegov?sno=<?php echo $usersno ?>&user=<?php echo $suser?>&type=pol"><img src="img/contract.png" alt="POL" width="128px" height="128px"></a></div>
             
           </div>
           <div class="row">
               <p></p>
               
        <div class="col-xs-2"><a  class="btn btn-primary" href="tablegov?sno=<?php echo $usersno ?>&user=<?php echo $suser?>&type=cit">CIT Assmt Register</a></div>
        <div class="col-xs-2"><a  class="btn btn-primary" href="tablegov?sno=<?php echo $usersno ?>&user=<?php echo $suser?>&type=edt">EDT Assmt Register  </a></div>
        <div class="col-xs-2"><a  class="btn btn-primary" href="tablegov?sno=<?php echo $usersno ?>&user=<?php echo $suser?>&type=boj">BOJ Assmt Register</a></div>
        <div class="col-xs-2"><a  class="btn btn-primary" href="tablegov?sno=<?php echo $usersno ?>&user=<?php echo $suser?>&type=vat">VAT Assmt Register</a></div>
        <div class="col-xs-2"><a  class="btn btn-primary" href="tablegov?sno=<?php echo $usersno ?>&user=<?php echo $suser?>&type=pol">POL Assmt Register</a></div>
           </div> &nbsp;
		   <div class="row">
             <div class="col-xs-2"><a href="tablegov?sno=<?php echo $usersno ?>&user=<?php echo $suser?>&type=wht"><img src="img/check-mark.png" alt="WHT" width="128px" height="128px"></a></div>
             <div class="col-xs-2"><a href="tablegov?sno=<?php echo $usersno ?>user=<?php echo $suser?>&type=auditall"><img src="img/contract.png" alt="AUDIT" width="128px" height="128px"></a></div>
             <div class="col-xs-2"><a href="tablegov?sno=<?php echo $usersno ?>user=<?php echo $suser?>&type=audit"><img src="img/contract.png" alt="AUDIT" width="128px" height="128px"></a></div>
             <div class="col-xs-2"><a href="tablesearch2?sno=<?php echo $usersno ?>&user=<?php echo $suser?>"><img src="img/007-folder.png" alt="" width="128px" height="128px"></a></div>
             
             
           </div>
           <div class="row">
               <p></p>
               
        <div class="col-xs-2"><a  class="btn btn-primary" href="tablegov?sno=<?php echo $usersno ?>&user=<?php echo $suser?>&type=wht">WHT Assmt Register</a></div>
        <div class="col-xs-2"><a  class="btn btn-success" href="tablegov?sno=<?php echo $usersno ?>user=<?php echo $suser?>&type=auditall">ALL AUDIT Assmts  </a></div>
        <div class="col-xs-2"><a  class="btn btn-primary" href="tablegov?sno=<?php echo $usersno ?>user=<?php echo $suser?>&type=audit"><?php echo date('Y')?> AUDIT Assmts   </a></div>
        <div class="col-xs-2"><a  class="btn btn-primary" href="tablesearch2?sno=<?php echo $usersno ?>&user=<?php echo $suser?>">Search All Govt Assmts   </a></div>
        
           </div>
            
           
        </div> 
        
        
    
</body>
</html>