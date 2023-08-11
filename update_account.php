<?php
include_once(dirname(__FILE__) . '/dbconfig/config.php');
$errormsg='';
$errormsg2='';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;

$serial = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$user = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;


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
$dept='';
$irno='';


while ($row = mysqli_fetch_array($query))
        {
$sno=$row[0];
$username=$row[1];
$password=$row[2];
$fname=$row[4];
$sname=$row[5];
$dept=$row[10];
$irno=$row[11];
    

    
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
			User Profile</H2></div>
     <div class="container-fluid">
       <div class="bootstrap-iso">
        <form  name="returns" action="process_update_user " onsubmit="return validateForm()" method="post">
       <div class="row-fluid col-md-4">
     
                <div class="form-group">
                    <label for="coytin">Enter New Username:</label>
                    <input type="text" class="form-control" id="coytin" name="uname" placeholder="Username " value="<?php echo $username ?>" >
                </div>
                <div class="form-group">
                    <label for="coyname">Enter New Password:</label>
                    <input type="text" class="form-control" id="coyname"  name="pass1" placeholder="Password" value="<?php echo $password ?>" />
           </div>                            
                    
                    
                <div class="form-group">
                    <label for="coyname">Staff First name:</label>
                    <input type="text" class="form-control" id="coyname"  name="ffname" placeholder="First Name" value="<?php echo $fname ?>" disabled/>
                </div>
            
               <div class="form-group">
                    <label for="coyname">Staff Surname:</label>
                    <input type="text" class="form-control" id="coyname"  name="ssname" placeholder="Surname" value="<?php echo $sname ?>" disabled/>
                </div>
                    
                <div class="form-group">
                    <label for="coyname">IR Number:</label>
                    <input type="text" class="form-control" id="irno"  name="irno" placeholder="IR NO" value="<?php echo $irno ?>" />
                </div>
                
                <div class="form-group">
                    <label for="dept">Department:</label>
                    
                       <select name="dept" id="dept">
                           <option value="<?php echo $dept ?>"><?php echo strtoupper($dept) ?></option>
                           <option value="rpp">RPP</option>
                           <option value="vat">VAT</option>
                           <!-- <option value="other">Others</option> -->
                       </select>
                </div>
                    
                <label for="date">Date Modified:</label>
                   <div class="input-group">
                <input id="date" type="text" class="form-control" name="date" placeholder="dd-mm-YYYY" value="<?php  echo date('d-m-Y')   ?>"><span  id="date" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
             <div class="form-group">
                    <label for="coyname"></label>
                    

                    <input type="hidden" name="user" value="<?php echo $user ?>"  />
                    <input type="hidden" name="fname" value="<?php echo $fname ?>"  />
                    <input type="hidden" name="sname" value="<?php echo $sname ?>"  />
                </div>
                   <div class="form-group">
                    <label for="coyname"></label>
                    
                    <input type="hidden" name="sno" value="<?php echo $sno ?>"  />
                </div>
                    <p></p>
                    
                   <p></p>
                       
                
                    </div>
 <div class="row-fluid col-md-3">
                  
                     <button type="submit" class="btn btn-success">Update Info </button>
                    
                                
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
                    
                    <p></p>
                   <a href="index " target="_parent" class="btn btn-default">Re-Login</a>');
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