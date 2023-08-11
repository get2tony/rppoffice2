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

$rate=getSettings('intrate',$conn)+getSettings('penrate',$conn);
$vatrate=getSettings('vatrate',$conn);
$userstatus=checkUserstatus2($usersno,$conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Capture VAT Self Assessment</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
     <link rel="stylesheet" href="jquery-ui.css">
  	<!-- <script src="js/jquery.character-counter.js"></script>   -->
      <script src="js/jquery-3.3.1.slim.min.js"></script>                 
       <!-- <script src="js3/jquery-1.12.0.min.js"></script> -->
  

<script>
   function getLoad(k) {
       var m=document.getElementById(k).value;
var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    myObj = JSON.parse(this.responseText);
    document.getElementById("defaultInput").value = myObj.name;
    document.getElementById("coytin").value = myObj.coytin;
    document.getElementById("address").value = myObj.address;
    document.getElementById("phone").value = myObj.phone;
    document.getElementById("remark").value = myObj.nob;
    document.getElementById("cattype").value = myObj.category;
  }
};
xmlhttp.open("GET", "getvatinfo.php?q=" +m, true);
// xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
   }
</script>              
   
</head>
<body>
   <div class="container-fluid">
           <div class="note2" ><h3> &nbsp;Capture (VAT) Self Assessment</h3>
            </div>
            <form id="returns" name="returns" action="dovatreturns " onsubmit="return validateForm()" method="post">
       <div class="row-fluid col-md-4">
                <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="text" class="form-control" id="coytin" name="coytin" placeholder="Tin here" onchange="getLoad('coytin')">
                </div>
               <div class="form-group">
                    <label for="coyname">Company Name:</label>
                    <input type="text" class="form-control" name="coyname"  onKeyPress="return taLimit(this)" onKeyUp="return taCount(this,'myCounter')" onchange="categofy()" placeholder="Taxpayer's Name" id="defaultInput" data-charcount-enable="true" maxlength="34"  />
                    <i style="color:grey">[34/ <span id='myCounter' >34</span> ]</i>
                </div>
                

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea  name="address" class="form-control" id="address" placeholder="Taxpayer's Address"></textarea>
                </div>
                                
                    <div class="form-group">
                    <label for="YOA">Phone No:</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" />
                    </div>
                    
                      
                    <p></p>
                    
                   
                
                    </div>


               
        
               
                <!--second row-->
                <div class="row-fluid col-md-4">
                <div class="form-group">
                    <label for="capture">Date of Capture:&nbsp;&nbsp;&nbsp;&nbsp;</label>
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
                <div class="form-group">
                    <label for="coyname">Category :</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="cattype" id="cattype">
                    <option value="corporate">Corporate</option>
                    <option value="enterprise">Enterprise</option>
                    </select>
                </div>

                 <div class="form-group">
                    <label for="taxtype">Tax Type:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="ttype" id="tax" onchange="ChangetaxList()">
                        <option value="VAT">VAT</option>
                        
                    </select>
                    </div>
                   <div class="form-group">
                    <label for="yearend">Return Filed:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="yrendm" id="yrendm" >
                        <option>January</option>
                        <option>February </option>
                        <option>March </option>
                        <option>April </option>
                        <option>May </option>
                        <option>June </option>
                        <option>July </option>
                        <option>August </option>
                        <option>September </option>
                        <option>October </option>
                        <option>November </option>
                        <option>December</option>
                    </select> 
                    <input type="text"  id="yryoa"  name="yryoa" placeholder="YOA" size="5" value="<?php   echo date('Y');?>" onchange="myVal()">
                
                   </div>
                    
                    <div class="form-group">
                    <label for="amnt">VAT Amount Filed @  <?php echo $vatrate ?>% :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text"  name="amount" placeholder="Amount" id="vamt" value=""  size="21" onchange="makenum('vamt')" required>
                    </div>

                    <div class="form-group">
                    <label for="amnt">Payment Date :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" id="date"  name="paydate" placeholder="Payment Date" value="<?php echo date('d-m-Y'); ?>">
                    </div>
                    
                                   
                    <div class="form-group">
                    <label for="cittxt">Basis of Assessment:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="basis" id=" basis">
                        <option value="Self Asmt">Self Assessment Tax</option>
                        <option value="Additional Tax">Additional Tax</option>
                        <option value="Admin Tax">Administrative Tax</option>
                        <option value="BOJ">Best of Judgement</option>
                         <option value="Audit">Audit Assessment</option>
                        <option value="Re-assessment">Re-assessment</option>
                       
                        
                    </select>
                    </div>
                    </div>
                    <!--third row-->
                <div class="row-fluid col-md-4">
                    <div class="form-group">
                        <label for="remark">Nature of Biz / Remarks :</label>
                        <textarea name="nob" class="form-control" id="remark" placeholder="Nature of Biz or Any Remarks" onclick="myext()"></textarea>
                        
                        </div>
                    
                    <p></p>
                       <input type="hidden" name="user" value="<?php echo $suser ?>">
                       <input type="hidden" name="usersno" value="<?php echo $usersno ?>">
                        <button type="submit" class="btn btn-primary">Process Info</button>

                                
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
  <script src="js/jquery-1.12.4.js"></script>
  <script src="jquery-ui.js"></script>
   <script type="text/javascript">
    
function validateForm() {
    var x = document.forms["returns"]["coytin"].value;
    var y = document.forms["returns"]["coyname"].value;
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
    if (w == " ") {
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
    
 </script>
 <script type="text/javascript">
 function categofy() {
     var k=document.getElementById("defaultInput").value.toUpperCase();

    if (k.includes('LTD') || k.includes('LIMITED') || k.includes('LIMTED') || k.includes('LMITED') ) {
        document.getElementById("cattype").value='corporate';
    } else {
         document.getElementById("cattype").value='enterprise';
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
      

maxL=34;
var bName = navigator.appName;
function taLimit(taObj) {
	if (taObj.value.length==maxL) return false;
	return true;
}

function taCount(taObj,Cnt) { 
	objCnt=createObject(Cnt);
	objVal=taObj.value;
	if (objVal.length>maxL) objVal=objVal.substring(0,maxL);
	if (objCnt) {
		if(bName == "Netscape"){	
			objCnt.textContent=maxL-objVal.length;}
		else{objCnt.innerText=maxL-objVal.length;}
	}
	return true;
}
function createObject(objId) {
	if (document.getElementById) return document.getElementById(objId);
	else if (document.layers) return eval("document." + objId);
	else if (document.all) return eval("document.all." + objId);
	else return eval("document." + objId);
}

      
 </script>
    <script type="text/javascript"> $("#date").datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true });</script>
    <script type="text/javascript"> $("#capture").datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true });</script>
</body>
</html>