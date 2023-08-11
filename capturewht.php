<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');
$errormsg='';
$errormsg2='';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;

$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;

$userstatus=checkUserstatus2($usersno,$conn);
$whtrate=getSetting('whtrate',$conn);
$rate=getSettings('intrate',$conn)+getSettings('penrate',$conn);
$getDate=isset($_REQUEST['yoa']) ? $_REQUEST['yoa'] : date('Y');
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


function transformToAssocArray( prmstr ) {
    var params = {};
    var prmarr = prmstr.split("&");
    for ( var i = 0; i < prmarr.length; i++) {
        var tmparr = prmarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    return params;
}

   function getSearchParameters() {
      var prmstr = window.location.search.substr(1);
      return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
}



function reboot(){
var params = getSearchParameters();
var n=params.tin;
var m=params.user;
var v=params.sno;
var a=params.amount;
var y=params.yoa;

if(n=="" ||n==null ){
document.getElementById("coytin").value="";
}else{
    document.getElementById("coytin").value= decodeURIComponent(n);
    document.getElementById("user").value= decodeURIComponent(m);
    document.getElementById("usersno").value= decodeURIComponent(v);
    document.getElementById("amount").value= decodeURIComponent(a);
    document.getElementById("yoa").value= decodeURIComponent(y);
    getLoad('coytin');
}

}
</script>


</head>
<body onload="reboot();">
   <div class="container-fluid">

           <div class="note2" ><h3> &nbsp;Raise Registered Assessments ( WITHHOLDING TAX )</h3>
            </div>
            <form id="returns" name="returns" action="doasswht " onsubmit="return validateForm()" method="post" target="dframe">
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
                    <input type="text" name="yoa" class="form-control" id="yoa" placeholder="Year of Assessment" value="<?php   echo $getDate;?>" onchange="myVal()">
                    </div>

                      <div class="form-group">
                    <label for="capture">Date  Raised:</label>
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
                <div class="row-fluid col-md-4">

                 <div class="form-group">
                    <label for="taxtype">Tax Type:</label>
                    <select name="ttype" id="tax" onchange="java_script_:show(this.options[this.selectedIndex].value)">
                         <option value="WHT">WHT</option>
                         <option value="TP">TRANSFER PRICING</option>
                         <option value="CIT">CIT</option>
                         <option value="EDT">EDT</option>
                         <option value="POL">POL</option>
                         <option value="VAT">VAT</option>
                    </select>
                    </div>

                     <div class="form-group">
                    <label for="coyname">Period covered:</label>
                    <input type="text" class="" id="startdate"  name="startdate" placeholder="start date" size="10" value="01-01-<?php echo $getDate-1 ;?>">
                    <label for="enddate"> To:</label>
                    <input type="text" class="" id="enddate"  name="enddate" placeholder="End date" size="10"  value="31-12-<?php echo $getDate-1 ;?>">
                    </div>

                    <!-- add WHT info -->

                    <div id="addwhtinfo" style="color:#0b33a2">

                    <div class="form-group">
                    <label for="amnt">WHT Rate:</label>
                    <input type="text"  name="whtrate" id="whtrate" placeholder="WHT Rate" value="<?php echo $whtrate?>" onchange="makenum('whtrate')" size="2" >
                     <label for="">%</label><br><br>
                    <label for="amnt">Display Transaction Amount?</label>
                    <select name="whttnx" id="whttnx" onchange="java_script_:showPaid3(this.options[this.selectedIndex].value)">
                    	<option value="no">No</option>
                    	<option value="yes">Yes</option>
                    </select>


                    </div>

                    </div>
                    <div id="whtpaid" style="display:none;color:#ef2323">

                    <div class="form-group">
                    <label for="amnt">WHT Already paid:</label>
                    <input type="text" class="form-control" name="whtamtpaid" id="whtamtpaid" placeholder="Amount Already paid" value="0.00" onchange="makenum('whtamtpaid')" >
                    <br>
                    <label for="amnt">Include Penalty &amp; Interest @ <?php echo $rate ?>%:</label>&nbsp;&nbsp;<input type="checkbox" name="penintwht" id="penintwht" placeholder="penalty" >

                    </div>

                    </div>



                    <!-- WHt ends Here -->



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
                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount Raised" value=0.00  onchange="makenum('amount')" required>

                    </div>

                    <div class="form-group">
                    <label for="cittxt">Basis of Assessment:</label>
                    <select name="basis" id=" basis">
                        <option value="Admin Tax">Administrative Tax</option>
                        <option value="Additional Tax">Additional Tax</option>
                        <option value="BOJ">Best of Judgement</option>
                        <option value="Audit">Audit Assessment</option>
                        <option value="TP Late Filing">TP Late Filing</option>
                        <option value="LRP">Un-Registered LRP</option>
                        <option value="Tax Investigation">Tax Investigation</option>
                        <option value="Re-assessment">Re-assessment</option>
                        <option value="Provisional Tax">Payment on Account</option>
                    </select>
                    </div>

                    <p></p>
				</div>
                     <div class="row-fluid col-md-4">
                        <input type="hidden" id="user" name="user" value="<?php echo $suser ?>">
                        <input type="hidden" id="usersno" name="usersno" value="<?php echo $usersno ?>">
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
    var m = document.forms["returns"]["whtrate"].value;


    if (m == 0.00) {
        alert("Enter a valid WHT Rate ");
        document.forms["returns"]["whtrate"].value="<?php echo $whtrate?>";
        return false;
    }
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
    if (w == "0.00") {
        alert("An Amount must be filled out");
        return false;
    }

}
    </script>
   <script type="text/javascript">
     function myVal() {
var k=document.getElementById("yoa").value;
var m= k-1;
document.getElementById("startdate").value="01-01-"+m;
document.getElementById("enddate").value="31-12-"+m;
      }


function show(aval) {
    if (aval == "CIT" || aval=="EDT" ||  aval=="POL" || aval=="TP"  ) {
        var m=document.getElementById("coytin").value;
        var n=document.getElementById("tax").value;
        var o=document.getElementById("user").value;
   	    var p=document.getElementById("usersno").value;
   	    var a=document.getElementById("amount").value;
   	    var y=document.getElementById("yoa").value;
   	    var z='captureWHT';
        window.location.href='captureadmin.php?tin='+encodeURIComponent(m)+'&tax='+encodeURIComponent(n)+
        '&user='+encodeURIComponent(o)+'&sno='+encodeURIComponent(p)+'&amount='+encodeURIComponent(a)+'&yoa='+encodeURIComponent(y)+'&frm='+encodeURIComponent(z);
    }

if (aval == "VAT") {
        var m=document.getElementById("coytin").value;
        var n=document.getElementById("tax").value;
        var o=document.getElementById("user").value;
   	    var p=document.getElementById("usersno").value;
   	    var a=document.getElementById("amount").value;
   	    var y=document.getElementById("yoa").value;
   	    var z='';
        window.location.href='capturevatrpp.php?tin='+encodeURIComponent(m)+'&tax='+encodeURIComponent(n)+
        '&user='+encodeURIComponent(o)+'&sno='+encodeURIComponent(p)+'&amount='+encodeURIComponent(a)+'&yoa='+encodeURIComponent(y)+'&frm='+encodeURIComponent(z);
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
function showPaid3(aval) {
    if (aval == "yes") {
    whtpaid.style.display='inline-block';
    Form.fileURL.focus();
    }
    else{
    whtpaid.style.display='none';
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
