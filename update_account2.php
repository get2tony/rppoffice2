<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');

$errormsg='';
$errormsg2='';
$ustatus='';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;

$serial = isset($_REQUEST['serial']) ? $_REQUEST['serial'] : null;
$user = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$userstatus=checkUserstatus2($usno,$conn);


$sql = "SELECT * FROM rppusers where `sno`='$serial'";


$query = mysqli_query($conn, $sql);

if (!$query) {
    
    die ('SQL Error: here' . mysqli_error($conn));
    
}

$sno="";
$username="";
$password="";
$fname="";
$sname="";
$level="";
$approved='';
$appshow='';
$dept='';



while ($row = mysqli_fetch_array($query))
        {
$sno=$row[0];
$username=$row[1];
$password=$row[2];
$fname=$row[4];
$sname=$row[5];
$level=$row[3];
$approved=$row[9];
$irno=$row[11];
$appshow='';
if($approved=='yes'){
	$appshow='Active';
}elseif($approved=='no'){
	$appshow='In-Active';
}
    
$dept=$row[10];
    
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FIRS RPP Office Assistant App</title>
     <link rel="stylesheet" href="css3/bootstrap.min.css">
          <link rel="stylesheet" href="css3/style4.css"/>

<!--     <link rel="stylesheet" href="css/bootstrap-iso.css" />-->
     <link rel="stylesheet" href="css/bootstrap-datepicker3.css"/>
     <!--  jQuery -->


<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>


  <!--  jQuery -->
  
</head>
<body>
   
    
    <section id= "form">
    <div class="panel "><H2>Edit 
			User Account</H2></div>
     <div class="container-fluid">
       <div class="bootstrap-iso">
        <form  name="returns" action="process_update_user2 " onsubmit="return validateForm()" method="post">
       <div class="row-fluid col-md-4">
     
                
                <?php 
                 if ($userstatus=='master') {
                    echo '<div class="form-group">
                    <label for="coyname">User Password:</label>
                    <input type="text" class="form-control" id="coyname"  name="" placeholder="Password" value="'.$password.'" disabled/>
           </div>  ';
                 }else{

                    echo'<div class="form-group">
                    <label for="coyname">User Password:</label>
                    <input type="password" class="form-control" id="coyname"  name="" placeholder="Password" value="'.$password.'" disabled/>
           </div>  ';
                 }
                
                
                ?>                          
                    
                    
                <div class="form-group">
                    <label for="coyname">Staff First name:</label>
                    <input type="text" class="form-control" id="coyname"  name="fname" placeholder="First Name" value="<?php echo strtoupper($fname) ?>"  disabled />
                </div>
                   <div class="form-group">
                    <label for="coyname">Staff Surname:</label>
                    <input type="text" class="form-control" id="coyname"  name="sname" placeholder="Surname" value="<?php echo strtoupper($sname) ?>" disabled />
                </div>
                   <div class="form-group">
                    <label for="dept">Department:</label>
                    
                       <select name="dept" id="dept">
                           <option value="<?php echo $dept ?>"><?php echo strtoupper($dept) ?></option>
                           <option value="rpp">RPP</option>
                           <option value="vat">VAT</option>
                           <option value="other">Others</option>
                       </select>
                </div>
                   <div class="form-group">
                    <label for="coyname">IR Number:</label>


                    <?php
							$ustatus=checkUserstatus2($usno,$conn);
						if ($ustatus=='master'){
							
							echo ' <input type="text" class="form-control" id="irno"  name="irno" placeholder="IR NO" value="' .$irno.'"  />';
						}else {
                           
						
                            echo '<input type="text" class="form-control" id="irno"  name="" placeholder="IR NO" value="' .$irno.'" disabled />
                            
                            <input type="hidden" name="irno" value="' .$irno.'"  />';
                        }
                        
                        ?>
                    
                </div>
                   
                    
                <label for="date">Date Modified:</label>
                   <div class="input-group">
                <input id="date" type="text" class="form-control" name="date" placeholder="dd-mm-YYYY" value="<?php  echo date('d-m-Y')   ?>"><span  id="date" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div><p></p>
                      
                      
                      
                      
               <div class="form-group">
                    <label for="coyname">Change Account Type: </label>
                    <select name="level" id="">
                        <option value="<?php echo $level ?>"><?php echo strtoupper($level) ?></option>
                        <option value="admin">ADMIN</option><option value="user">USER</option>
                        
                        <?php
							$ustatus=checkUserstatus2($usno,$conn);
						if ($ustatus=='master'){
							
							echo ' <option value="controller">TAX CONTROLLER</option>';
						}
						
						
						?>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="coyname">Change Account Status: </label>
                    <select name="status" id="">
                        <option value="<?php echo $approved ?>"><?php echo $appshow ?></option>
                        <option value="yes">ACTIVE</option><option value="no">IN-ACTIVE</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="coyname"></label>
                    
                    <input type="hidden" name="user" value="<?php echo $user ?>"  />
                     <input type="hidden" name="pass1" value="<?php echo $password ?>"  />
                </div>
             <div class="form-group">
                    <label for="coyname"></label>
                    
                    <input type="hidden" name="sno" value="<?php echo $sno ?>"  />
                    <input type="hidden" name="usersno" value="<?php echo $usno ?>"  />
                </div>
                    <p></p>
                    
                   <p></p>
                       
                
                    </div>
 <div class="row-fluid col-md-3">
                  
                     <button type="submit" class="btn btn-primary">Apply Changes </button>
                    
                                
                <?php
                    
                   if ($errormsg==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>
                    
                    
                    ');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg.' </h4> </div>');
                   }
                    
                     if ($errormsg2==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen"><h4>'.$errormsg2.' </h4> </div>
                    
                    ');
                   }
                    ?>
            </div>
               
               
         </form>
        </div>
        </div>
    </section>
    
    
    
<!--    <script src="js3/jquery-1.12.4.js"></script>-->
    <script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'dd-mm-yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
      };
      date_input.datepicker(options);
    });
    </script>
<script type="text/javascript">
    
function validateForm() {
    var x = document.forms["returns"]["coytin"].value;
    var y = document.forms["returns"]["coyname"].value;
    var z = document.forms["returns"]["address"].value;
    
    
    if (x == "") {
        alert("Company's Tin must be filled ");
        return false;
    }
     if (y == "") {
        alert("Company's Name must be filled ");
        return false;
    }
     if (z == "") {
        alert("Address must be filled out");
        return false;
    }
     
} 
    
 </script>
</body>
</html>