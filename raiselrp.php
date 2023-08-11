<?php

$errormsg='';
$errormsg2='';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raise Late Return Penalty</title>
     <link rel="stylesheet" href="css3/bootstrap.min.css">
<!--     <link rel="stylesheet" href="css/bootstrap-iso.css" />-->
     <link rel="stylesheet" href="css/bootstrap-datepicker3.css"/>
     <link rel="stylesheet" href="css3/style4.css"/>
     <!--  jQuery -->


<!-- Bootstrap Date-Picker Plugin -->
	<script src="js/jquery-3.3.1.slim.min.js"></script>                 
  	<script src="js/jquery.character-counter.js"></script>     
<!--<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>-->
<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
  <!-- <script src="js3/jquery-1.12.0.min.js"></script> -->
  

<script>
   function getLoad(k) {
       var m=document.getElementById(k).value;
var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    myObj = JSON.parse(this.responseText);
    document.getElementById("defaultInput").value = myObj.name;
    document.getElementById("address").value = myObj.address;
    document.getElementById("yrendm").value = myObj.yearend;
    document.getElementById("coytin").value = myObj.coytin;
  }
};
xmlhttp.open("GET", "getinfo.php?q=" +m, true);
// xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
   }
</script>

</head>
<body>
   
    
    <section id= "form">
     <div class="container-fluid">
       <div class="bootstrap-iso">
        <form  name="returns" action="dolrpreturns " onsubmit="return validateForm()" method="post">
       <div class="row-fluid col-md-4">
     
                <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="text" class="form-control" id="coytin" name="coytin" placeholder="Tin here" onchange="getLoad('coytin')">
                </div>
                <div class="form-group">
                    <label for="coyname">Company Name:</label>
                    <input type="text" class="form-control" name="coyname" placeholder="Taxpayer's Name" id="defaultInput" data-charcount-enable="true" maxlength="34">
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea  name="address" class="form-control" id="address" placeholder="Taxpayer's Address" maxlength="65"></textarea>
                </div>
                                
                    
                     <div class="form-group">
                    <label for="yearend">Year End:</label>
                    <select name="yrendm" id="yrendm" >
                        <option>December</option>
                        <option>November</option>
                        <option>October</option>
                        <option>September</option>
                        <option>August</option>
                        <option>July</option>
                        <option>June</option>
                        <option>May</option>
                        <option>April</option>
                        <option>March</option>
                        <option>February</option>
                        <option>January</option>
                    </select>&nbsp;&nbsp;
                    <input type="text"  id="yryoa"  name="yryoa" placeholder="YOA" size="5" value="<?php   echo date('Y')-1;?>" onchange="myVal()"><p></p>
                   </div>
                    
                    <div class="form-group">
                    <label for="YOA">Year of Assessment:</label>
                    <input type="text" name="yoa" class="form-control" id="yoa" placeholder="Year of Assessment" value="<?php   echo date('Y');?>">
                    </div>
                <label for="date">Date Submited:</label>
                   <div class="input-group">
                <input id="date" type="text" class="form-control" name="date" placeholder="dd-mm-YYYY" value="<?php  echo date('d-m-Y');   ?>"><span  id="date" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
                      
                      <br/>
                      <div class="form-group">
                     <label for="date">Date of Issue:</label>
                   
					   <select  name="date2"  >
                     <option value="<?php  echo date('d-m-Y');   ?>"><?php  echo date('d-m-Y');   ?></option>
                     </select>
					</div>
                    
                    
                   <p></p>
                       <input type="hidden" name="user" value="<?php echo $suser ?>">
                       <input type="hidden" name="usersno" value="<?php echo $usersno ?>">
                      
                        <button type="submit" class="btn btn-primary">Process LRP</button>
                
                    </div>
 <div class="row-fluid col-md-3">
                  
                    

                                
                <?php
                    
                   if ($errormsg2==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg2.' </h4> </div>');
                   }
                    
                     if ($errormsg==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen"><h4>'.$errormsg.' </h4> </div>');
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
    var y = document.forms["returns"]["defaultInput"].value;
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

function myVal() {                
    var k=document.getElementById("yryoa").value;
    var m=Number(k)+1;
    document.getElementById("yoa").value=m;

      }        
    
 </script>
</body>
</html>