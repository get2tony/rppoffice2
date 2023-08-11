<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
$user = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$sno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;

$userlevel=checkUserstatus2($sno,$conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage RPP Staff Accounts</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
     <link rel="stylesheet" href="css3/style4.css">
</head>
<body>
   
      <div class="panel "><h2>Manage RPP Staff Accounts</h2></div>
       <div class="container">
             <div class="row">
             <div class="col-xs-3"><img src="img/worker.png" alt=""></div>
             <div class="col-xs-3"><img src="img/appraisal.png" alt=""></div>
             <div class="col-xs-3"><img src="img/boss-1.png" alt=""></div>
             <div class="col-xs-3"><img src="img/user-settings-icon.png" alt=""></div>
             
           </div>
          <?php
            $pager='view_accounts';
          if ($userlevel=='master') {
              $pager='view_accountsall';
          }
           
           echo '
           <div class="row">
            
               
               <div class="col-xs-3"><a  class="btn btn-primary" href="'.$pager.'?sno='.$sno.'&user='.$user.'">View all Users</a></div>
               <div class="col-xs-3"><a  class="btn btn-primary" href="appraisal?sno='.$sno.'&user='.$user.'">View Score Card</a></div>
               <div class="col-xs-3"><a  class="btn btn-primary" href="" >Create New User</a></div>
               <div class="col-xs-3"><a  class="btn btn-primary" href="">Create Admin User </a></div>
           </div>  '; ?>
            
           <!-- <div class="col-xs-3"><a  class="btn btn-primary" href="create_CR_staff?sno='.$sno.'&user='.$user.'" >Create New User</a></div> -->
               <!-- <div class="col-xs-3"><a  class="btn btn-primary" href="create_admin_staff?sno='.$sno.'&user='.$user.'">Create Admin User </a></div> -->
        </div> 
        
        
    
</body>
</html>