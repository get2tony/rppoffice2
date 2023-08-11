<?php

$errormsg='';
$errormsg2='';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$user = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;

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
    <div class="panel "><H2>Create an 
		              Application Administrator</H2></div>
     <div class="container-fluid">
       <div class="bootstrap-iso">
        <form  name="returns" action="process_create_admin " onsubmit="return validateForm()" method="post">
       <div class="row-fluid col-md-4">
     
                <div class="form-group">
                    <label for="coytin">Enter New Username:</label>
                    <input type="text" class="form-control" id="coytin" name="uname" placeholder="Username " >
                </div>
                <div class="form-group">
                    <label for="coyname">Enter New Password:</label>
                    <input type="password" class="form-control" id="coyname"  name="pass1" placeholder="Password">
                </div>

                <div class="form-group">
                    <label for="coyname">Re-type New Password:</label>
                    <input type="password" class="form-control" id="coyname"  name="pass2" placeholder="Password">
                </div>
                                
                    
                    
                <div class="form-group">
                    <label for="coyname">Staff First name:</label>
                    <input type="text" class="form-control" id="coyname"  name="fname" placeholder="First Name">
                </div>
                   <div class="form-group">
                    <label for="coyname">Staff Surname:</label>
                    <input type="text" class="form-control" id="coyname"  name="sname" placeholder="Surname">
                </div>
                   
                    <div class="form-group">
                    <label for="dept">Department:</label>
                    
                       <select name="dept" id="dept">
                           <option value="rpp">RPP</option>
                           <option value="vat">VAT</option>
                           <option value="other">Others</option>
                       </select>
                </div>
                    
                <label for="date">Date Created:</label>
                   <div class="input-group">
                <input id="date" type="text" class="form-control" name="date" placeholder="dd-mm-YYYY" value="<?php  echo date('d-m-Y')   ?>"><span  id="date" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
             <div class="form-group">
                    <label for="coyname"></label>
                    <input type="hidden" class="form-control" id="coyname"  name="crby" placeholder="Password" value="<?php  echo $user ?>"/>
                </div>
                    <p></p>
                    
                   <p></p>
                       
                
                    </div>
 <div class="row-fluid col-md-3">
                  
                     <button type="submit" class="btn btn-primary">Create Account </button>

                                
                <?php
                    
                   if ($errormsg==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg.' </h4> </div>');
                   }
                    
                     if ($errormsg2==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen"><h4>'.$errormsg2.' </h4> </div>');
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