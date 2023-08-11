<?php


include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

$errormsg='';
$errormsg2='';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
// $usersno=getusersno($suser,$conn);
$userstatus=checkUserstatus2($usersno,$conn);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raise VAT Late Return Penalty </title>
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
    // document.getElementById("yrendm").value = myObj.yearend;
    document.getElementById("coytin").value = myObj.coytin;
  }
};
xmlhttp.open("GET", "getinfo.php?q=" +m, true);
// xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
   }
</script>
<script language="javascript" src="cal2.js">
/*
Xin's Popup calendar script-  Xin Yang (http://www.yxscripts.com/)
Script featured on/available at http://www.dynamicdrive.com/
This notice must stay intact for use
*/
</script>
<script language="javascript" src="cal_conf2.js"></script>
</head>
<body>


    <section id= "form">
     <div class="container-fluid">
       <div class="bootstrap-iso">
        <form  name="returns" action="dolrpreturns3 " onsubmit="return validateForm()" method="post">
       <div class="row-fluid col-md-4">

                <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="text" class="form-control" id="coytin" name="coytin" placeholder="Tin here" onchange="getLoad('coytin')">
                </div>
                <div class="form-group">
                    <label for="coyname">Company Name:</label>
                    <input type="text" class="form-control" name="coyname" placeholder="Taxpayer's Name" id="defaultInput" data-charcount-enable="true" maxlength="34" />
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea  name="address" class="form-control" id="address" placeholder="Taxpayer's Address"></textarea>
                </div>
                         <div class="form-group" >
                    <label for="YOA">Assessment Year:</label>
                    <input type="text" name="yoa" class="form-control" id="yoa" placeholder="Year of Assessment" value="<?php   echo date('Y');?>" onchange="myVal()" />
                    </div>
                    <div class="form-group">
                    <label for="coyname">Period covered:</label>


                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="datepicker" id="startdate"  name="startdate" placeholder="start date" size="10" value="01-01-<?php echo date('Y')-1 ;?>"   />


                    <label for="enddate">&nbsp;&nbsp;&nbsp; To:&nbsp;&nbsp;</label>
                    <input type="text" class="datepicker" id="enddate"  name="enddate" placeholder="End date" size="10"  value="31-01-<?php echo date('Y')-1 ;?>"  />
                </div>


                    </div>
 <div class="row-fluid col-md-3">
                   <div class="form-group">
                    <label for="amnt">Amount Raised:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="" id="amount" name="amount" placeholder="Amount Raised" value="" onchange="makenum('amount')" size="21" required />
                    </div>

                    <div class="form-group">
                     <label for="amnt">Date Filed:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <input class="datepicker"  name="datefile" placeholder="dd-mm-yyyy" value="<?php echo date("d-m-Y")?>"  size="21" required />
                     </div>

                     <div class="form-group">
                    <label for="capture">Date Raised:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
					if ($userstatus=='user' && $suser !='Tony Damidami'){

					echo '<select name="capture" id="capture" >
                        <option> '.date("d-m-Y").'</option>
                    </select>';

					}else{

                    echo '<input class="datepicker" type="text" name="capture" id="capture"
                       value="'.date("d-m-Y").'" >';
					}
				   ?>
                       </div>
                    <p></p>

                   <p></p>
                       <input type="hidden" name="user" value="<?php echo $suser ?>">
                       <input type="hidden" name="usersno" value="<?php echo $usersno ?>">
                        <button type="submit" class="btn btn-primary pull-right">Process LRP</button>




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
<script type="text/javascript">
     function myVal() {
var k=document.getElementById("yoa").value;
var m= k-1;
document.getElementById("startdate").value="01-01-"+m;
document.getElementById("enddate").value="31-01-"+m;
      }
      </script>
<script type="text/javascript">

function validateForm() {
    var x = document.forms["returns"]["coytin"].value;
    var y = document.forms["returns"]["defaultInput"].value;
    var z = document.forms["returns"]["address"].value;
    var w = document.forms["returns"]["amount"].value;


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
     if (w <= 0 || w == "") {
        alert("An Amount must be entered");
        return false;
    }

}

function makenum(d) {
    var q=document.getElementById(d).value;
	if( isNaN(q.replace(/,/g, ''))){
	   q=0;
	   }
    if(q=="" || q===""){
    q=0;
    document.getElementById(d).value = q.toFixed(2);
    }

    var n = Number(parseFloat(q.replace(/,/g, ''))).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
    document.getElementById(d).value = n;

      }

  $.fn.datepicker.defaults.format = "dd-mm-yyyy";
    $('.datepicker').datepicker({
        // startDate: '-3d'
    });

 </script>
</body>
</html>
