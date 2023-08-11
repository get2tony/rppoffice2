<?php


include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
$errormsg='';
$errormsg2='';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;

$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;


$rate=getSettings('intrate',$conn)+getSettings('penrate',$conn);
$citrate=getSettings('citrate',$conn);
$edtrate=getSettings('edtrate',$conn);
$vatrate=getSettings('vatrate',$conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raise Assessment</title>
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
<body >
   <div class="container-fluid" id="unreg">

           <div class="note" ><h3> &nbsp;Raise Un-Registered Assessments (VAT, CIT, EDT, WHT &amp; POL)</h3>
            </div>
            <form id="returns" name="returns" action="doass2 " onsubmit="return validateForm()" method="post">
       <div class="row-fluid col-md-4">
                <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="text" class="form-control" id="coytin" name="coytin" placeholder="Tin here" onchange="getLoad('coytin')" >
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
                    <label for="YOA">Year of Assessment:</label>
                    <input type="text" name="yoa" class="form-control" id="yoa" placeholder="Year of Assessment" value="<?php   echo date('Y');?>" onchange="myVal()">
                    </div>

                      <div class="form-group">
                    <label for="capture">Date  Raised:</label>
                    <select name="capture" id="capture" >
                        <option><?php   echo date('d-m-Y');?></option>

                    </select>
                       </div>
                    <p></p>



                    </div>





                <!--second row-->
                <div class="row-fluid col-md-4">

                 <div class="form-group">
                    <label for="taxtype">Tax Type:</label>
                    <select name="ttype" id="tax" onchange="java_script_:show(this.options[this.selectedIndex].value)">
                        <option value="POL">POL</option>
                        <option value="VAT">VAT</option>
                        <option value="CIT">CIT</option>
                        <option value="EDT">EDT</option>
                        <option value="WHT">WHT</option>
                    </select>
                    </div>

                     <div class="form-group">
                    <label for="coyname">Period covered:</label>
                    <input type="text" class="" id="startdate"  name="startdate" placeholder="start date" size="10" value="01-01-<?php echo date('Y')-1 ;?>">
                    <label for="enddate"> To:</label>
                    <input type="text" class="" id="enddate"  name="enddate" placeholder="End date" size="10"  value="31-12-<?php echo date('Y')-1 ;?>">
                    </div>

                     <div id="addvatinfo" style="display:none;color:#0b33a2">

                    	<div class="form-group">
                        <label for="amnt">VAT Rate:</label>
                    <input type="text"  name="vatrate" id="vatrate" placeholder="VAT Rate" value="<?php echo $vatrate ?>" onchange="makenum('vatrate')" size="2" >
                     <label for="">%</label><br>
                    </div>
                    </div>
                    <div id="addedtinfo" style="display:none;color:#0b33a2">

                    	<div class="form-group">
                        <label for="amnt">EDT Rate:</label>
                    <input type="text"  name="edtrate" id="edtrate" placeholder="EDT Rate" value="<?php echo $edtrate ?>" onchange="makenum('edtrate')" size="2" >
                     <label for="">%</label><br><br>
                    <label for="amnt">Display Assessable Profit on Asmt?</label>
                    <select name="aprofit" id="aprofit" onchange="java_script_:showPaid2(this.options[this.selectedIndex].value)">
                    	<option value="no">No</option>
                    	<option value="yes">Yes</option>
                    </select>


                    </div>

                    </div>

                    <div id="edtpaid" style="display:none;color:#ef2323">

                    <div class="form-group">
                    <label for="amnt">EDT Already paid:</label>
                    <input type="text" class="form-control" name="edtamtpaid" id="edtamtpaid" placeholder="Amount Already paid" value="0.00"  >
                    <br>
                    <label for="amnt">Include Penalty &amp; Interest @ <?php echo $rate ?>%:</label>&nbsp;&nbsp;<input type="checkbox" name="penintedt" id="penintedt" placeholder="penalty" >

                    </div>

                    </div>



                    <div id="addcitinfo" style="display:none;color:#0b33a2">
                    <div class="form-group">
                    <label for="amnt">CIT Rate:</label>
                    <input type="text"  name="citrate" id="citrate" placeholder="CIT Rate" value="<?php echo $citrate ?>" onchange="makenum('citrate')" size="2" >
                     <label for="">%</label><br><br>
                    <label for="amnt">Display Total Profit on Asmt?</label>
                    <select name="tprofit" id="tprofit" onchange="java_script_:showPaid(this.options[this.selectedIndex].value)">
                    	<option value="no">No</option>
                    	<option value="yes">Yes</option>
                    </select>
                    </div>


                    </div>

                    <div id="citpaid" style="display:none;color:#ef2323">

                    <div class="form-group">

                    <label for="amnt">CIT Already paid:</label>
                    <input type="text" class="form-control" name="citamtpaid" id="citamtpaid" placeholder="Amount Already paid" value="0.00"  >
                    <br>
                    <label for="amnt">Include Penalty &amp; Interest @ <?php echo $rate ?>%:</label>&nbsp;&nbsp;<input type="checkbox" name="penintcit" id="penintcit" placeholder="penalty" >

                    </div>

                    </div>

                    <!--<div id="addvatinfo" hidden>
                    <div class="form-group">
                    <label for="amnt">Sales / Services:</label>
                    <input type="text" class="form-control" name="sales" id="sales" placeholder="Sales" value="0.00"  >
                    </div>

                    <div class="form-group">
                    <label for="amnt">Input VAT claim:</label>
                    <input type="text" class="form-control" name="input" id="input" placeholder="Input VAT" value="0.00"  >
                    </div>


					</div>-->



                    <div class="form-group">
                    <label for="amnt">Asmt Amount:</label>
                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount Raised" value="" onchange="makenum('amount')" required />

                    </div>

                    <div class="form-group">
                    <label for="cittxt">Basis of Assessment:</label>
                    <select name="basis" id=" basis">
                        <option value="Admin Tax">Administrative Tax</option>
                        <option value="Additional Tax">Additional Tax</option>
                        <option value="BOJ">Best of Judgement</option>
                        <option value="LRP">Un-Registered LRP</option>
                          <option value="TP Late Filing">TP Late Filing</option>
                        <option value="Re-assessment">Re-assessment</option>
                          <option value="Tax Investigation">Tax Investigation</option>
                        <option value="Provisional Tax">Provisional Tax</option>
                    </select>
                    </div>

                    <p></p>
				</div>
                     <div class="row-fluid col-md-4">
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
                <!--end of third row-->
            </form>



   </div>

   <script type="text/javascript">

function validateForm() {
    var x = document.forms["returns"]["coytin"].value;
    var y = document.forms["returns"]["defaultInput"].value;
    var z = document.forms["returns"]["address"].value;
    var w = document.forms["returns"]["amount"].value;

    var k = document.forms["returns"]["citrate"].value;
    var j = document.forms["returns"]["edtrate"].value;
    var s = document.forms["returns"]["vatrate"].value;


    if (x == "") {
        alert("Company's Tin must be filled ");
        return false;
    }
    if (k == 0.00 || k=="" || isNaN(k.replace(/,/g, '')) ) {
        alert("Enter a Valid CIT Rate ");
        document.forms["returns"]["citrate"].value=<?php echo $citrate;?>;
        return false;
    }
    if (j == 0.00 || j=="" || isNaN(j.replace(/,/g, '')) ) {
        alert("Enter a Valid EDT Rate ");
        document.forms["returns"]["edtrate"].value=<?php echo $edtrate;?>;
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




function show(aval) {
    if (aval == "CIT") {
    addcitinfo.style.display='inline-block';
    addvatinfo.style.display='none';
	addedtinfo.style.display='none';
	document.getElementById("tprofit").value="no";
	document.getElementById("aprofit").value="no";
	document.getElementById("penintcit").checked = false;
	document.getElementById("penintedt").checked = false;
	edtpaid.style.display='none';
	document.getElementById("citamtpaid").value='0.00';
	document.getElementById("edtamtpaid").value='0.00';
    Form.fileURL.focus();
    }

	if (aval == "EDT") {
    addedtinfo.style.display='inline-block';
    addvatinfo.style.display='none';
	addcitinfo.style.display='none';
	document.getElementById("aprofit").value="no";
	document.getElementById("tprofit").value="no";
	document.getElementById("penintedt").checked = false;
	document.getElementById("penintcit").checked = false;
	citpaid.style.display='none';
	document.getElementById("citamtpaid").value='0.00';
	document.getElementById("edtamtpaid").value='0.00';

    Form.fileURL.focus();
    }

	if (aval == "POL") {
   	addedtinfo.style.display='none';
	addcitinfo.style.display='none';
	addvatinfo.style.display='none';
	citpaid.style.display='none';
	edtpaid.style.display='none';
	document.getElementById("penintedt").checked = false;
	document.getElementById("penintcit").checked = false;
	document.getElementById("aprofit").value="no";
	document.getElementById("tprofit").value="no";
	document.getElementById("citamtpaid").value='0.00';
	document.getElementById("edtamtpaid").value='0.00';
    }
	if (aval == "WHT") {
   	addedtinfo.style.display='none';
	addcitinfo.style.display='none';
	addvatinfo.style.display='none';
	citpaid.style.display='none';
	edtpaid.style.display='none';
	document.getElementById("penintedt").checked = false;
	document.getElementById("penintcit").checked = false;
	document.getElementById("aprofit").value="no";
	document.getElementById("tprofit").value="no";
	document.getElementById("citamtpaid").value='0.00';
	document.getElementById("edtamtpaid").value='0.00';
    }

	if (aval == "VAT") {
   	addedtinfo.style.display='none';
	addcitinfo.style.display='none';
	addvatinfo.style.display='inline-block';
	citpaid.style.display='none';
	edtpaid.style.display='none';
	document.getElementById("penintedt").checked = false;
	document.getElementById("penintcit").checked = false;
	document.getElementById("aprofit").value="no";
	document.getElementById("tprofit").value="no";
	document.getElementById("citamtpaid").value='0.00';
	document.getElementById("edtamtpaid").value='0.00';
    }


  }


	function showPaid(aval) {
    if (aval == "yes") {
    citpaid.style.display='inline-block';
    Form.fileURL.focus();
    }
    else{
    citpaid.style.display='none';
    }

  }

function showPaid2(aval) {
    if (aval == "yes") {
    edtpaid.style.display='inline-block';
    Form.fileURL.focus();
    }
    else{
    edtpaid.style.display='none';
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




	</script>


</body>
</html>
