<?php
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once(dirname(__FILE__) . '/dbconfig/config.php');

$errormsg='';
$errormsg2='';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;

$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;

$rate=getSettings('intrate',$conn)+getSettings('penrate',$conn);
$vatrate=getSettings('vatrate',$conn);
$userstatus=checkUserstatus2($usersno,$conn);
$getDate=isset($_REQUEST['yoa']) ? $_REQUEST['yoa'] : date('Y');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raise VAT Assessment</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
      <script src="js/jquery-3.3.1.slim.min.js"></script>
  	<script src="js/jquery.character-counter.js"></script>
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
   <div class="container-fluid">
           <div class="note2" ><h3> &nbsp;Raise Registered Assessments (VAT)</h3>
            </div>
            <form id="returns" name="returns" action="doass " onsubmit="return validateForm()" method="post">
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
                    <textarea  name="address" class="form-control" id="address" placeholder="Taxpayer's Address"></textarea>
                </div>

                    <div class="form-group">
                    <label for="YOA">Year of Assessment:</label>
                    <input type="text" name="yoa" class="form-control" id="yoa" placeholder="Year of Assessment" value="<?php   echo date('Y');?>" onchange="myVal()">
                    </div>

                     <div class="form-group">
                    <label for="capture">Date of Capture:</label>
                   <?php
					if ($userstatus!='user'){

					echo '<input type="text" name="capture" id="capture"
                       value="'.date("d-m-Y").'" >';

					}else{
						echo '<select name="capture" id="capture" >
                        <option> '.date("d-m-Y").'</option>

                    </select>';
					}
				   ?>
                </div>
                    <p></p>



                    </div>





                <!--second row-->
                <div class="row-fluid col-md-5">

                 <div class="form-group">
                    <label for="taxtype">Tax Type:</label>
                    <select name="ttype" id="tax" onchange="ChangetaxList()">
                        <option value="VAT">VAT</option>

                    </select>
                    </div>
                    <div class="form-group">
                    <label for="coyname">Period covered:</label>



                    <input type="text" class="" id="startdate"  name="startdate" placeholder="start date" size="10" value="01-01-<?php echo date('Y')-1 ;?>"   >


                    <label for="enddate"> To:</label>
                    <input type="text" class="" id="enddate"  name="enddate" placeholder="End date" size="10"  value="31-12-<?php echo date('Y')-1 ;?>">
                </div>

                <div class="form-group">
                    <label for="exmpt" style="color:red">Exempted / Zero-Rated Supplies:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="" name="exmpt" id="exmpt" onchange="makenum('exmpt')"  onfocus="this.placeholder = ''" placeholder = 'Exempted / Zero-Rated'" value=""  size="21"required />
                    </div>

                    <div class="form-group">
                    <label for="amnt">VAT Amount @ <input type="text"  name="vatrate" id="vatrate" placeholder="VAT Rate" value="<?php echo $vatrate  ?>" onchange="makenum('vatrate')" size="2" > % :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="" name="amount"  onfocus="this.placeholder = ''" placeholder = 'Enter Amount'"  id="vamt" onchange="makenum('vamt')" value="" required size="21" />
                    </div>

                    <div class="form-group">
                    <label for="amnt" style="color:red">Less:&nbsp;&nbsp; Input  claimed:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="" name="inpamt" id="inpamt" onchange="makenum('inpamt')"  onfocus="this.placeholder = ''" placeholder = 'Input claimed'" value=""  size="21"required />
                    </div>

                    <div class="form-group">
                    <label for="amnt" style="color:red">Less:&nbsp;&nbsp; Amount already Paid / Deducted:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="" name="amtpaid" id="amtpaid" onchange="makenum('amtpaid')"  onfocus="this.placeholder = ''" placeholder = 'Amount Paid'" value=""  size="21" required />
                    </div>

                    <label for="amnt">Include Penalty &amp; Interest @ <?php echo $rate ?>%:</label>&nbsp;&nbsp;<input type="checkbox" name="penintvat" id="penintvat" placeholder="penalty" />
                    <p></p>

                    <div class="form-group">
                    <label for="cittxt">Basis of Assessment:</label>
                    <select name="basis" id=" basis">
                        <option value="Additional Tax">Additional Tax</option>
                        <option value="Admin Tax">Administrative Tax</option>
                        <option value="BOJ">Best of Judgement</option>
                         <option value="Audit">Audit Assessment</option>
                           <option value="TP Late Filing">TP Late Filing</option>
                           <option value="Tax Investigation">Tax Investigation</option>
                           <option value="VAT Coordination">VAT Coordination</option>
                         <option value="late registration">Late Registration</option>
                        <option value="Re-assessment">Re-assessment</option>


                    </select>
                    </div>

                    <p></p>
                       <input type="hidden" name="user" value="<?php echo $suser ?>">
                       <input type="hidden" name="usersno" value="<?php echo $usersno ?>">
                        <button type="submit" class="btn btn-primary">Process Asmt</button>


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
                <!--end of second row-->
            </form>



   </div>

   <script type="text/javascript">

function validateForm() {
    var x = document.forms["returns"]["coytin"].value;
    var y = document.forms["returns"]["coyname"].value;
    var z = document.forms["returns"]["address"].value;
    var w = document.forms["returns"]["amount"].value;
    var s = document.forms["returns"]["vatrate"].value;


    if (x == "") {
        alert("Company's Tin must be filled ");
        return false;
    }

    if (s == 0.00 || s=="" || isNaN(s.replace(/,/g, '')) ) {
        alert("Enter a Valid VAT Rate ");
        document.forms["returns"]["vatrate"].value=<?php echo $vatrate;?>;
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
    if (w == "0.00") {
        alert("An Amount must be filled out");
        return false;
    }

}


    </script>


  <script type="text/javascript">
  function myVal() {
  var k=document.getElementById("yoa").value;
  var y=document.getElementById("yoa").value;
  if (y<2021) {
    document.getElementById("vatrate").value =5;
  }else {
    document.getElementById("vatrate").value ="<?=$vatrate?>";
  }
  var vr="<?=$vatrate?>";
  if (y>2020 && vr==5) {
    document.getElementById("vatrate").value =7.5;
  }
  var m= k-1;

  document.getElementById("startdate").value="01-01-"+m;
  document.getElementById("enddate").value="31-12-"+m;
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


            </script>

</body>
</html>
