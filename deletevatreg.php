<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

$errormsg='';
$errormsg2='';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$tab = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
$tin = isset($_REQUEST['tin']) ? $_REQUEST['tin'] : null;
$sno = isset($_REQUEST['serial']) ? $_REQUEST['serial'] : null;

$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;


$vatrate=getSettings('vatrate',$conn);
$userstatus=checkUserstatus2($usersno,$conn);





$sql = "SELECT * FROM vatreg where `sno`='$sno'&&`tinno`='$tin'";
        
$query = mysqli_query($conn, $sql);

if (!$query) {
    
    die ('SQL Error: here' . mysqli_error($conn));
    
}

$sno="";
$coytin="";
$coyname="";
$coyadd="";
$phone="";
$basis="";
$category="";
$month="";
$yoa="";
$amount="";
$capdate="";
$paydate="";
$defaultdays="";
$capby="";
$irno="";
$modified="";
$remark="";
$duedate="";
$showmonths="";  
$showLRPdue="";

$newcap="";
$ncap="";
$day="";
$Y="";
// $M=$ncap[1];
$M="";
// $showdefaultdays=$M;
$due="";

$duecap = ""; // or your date as well
$filedate = "";
$ts1 = "";
$ts2 = "";
$datediff = "";
$defaultdays="";

while ($row = mysqli_fetch_array($query))
        {
$sno=$row[0];
$coytin=$row[1];
$coyname=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($row[2]))));
$coyadd=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($row[3]))));
$phone=$row[4];
$basis=$row[5];
$category=$row[6];
$month=$row[7];
$yoa=$row[8];
$amount=$row[9];
$capdate=$row[10];
$paydate=$row[11];

$capby=$row[13];
$irno=$row[14];
$modified=$row[15];
$remark=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($row[16]))));


$duedate=getDuedatevat($month,$yoa);
$showmonths=checkLRPvat($duedate,$capdate);  
$showLRPdue=number_format(amountLRPvat($showmonths,$conn),2);

$newcap=str_replace(' ','/',$duedate);
$ncap=explode('/',$newcap);
$day=21;
$Y=$ncap[2];
// $M=$ncap[1];
$M=getNummonth($ncap[1]);
// $showdefaultdays=$M;
$due=$day.'-'.$M.'-'.$Y;

$duecap = date('Y-m-d',strtotime($due)); // or your date as well
$filedate = date('Y-m-d',strtotime($capdate));
$ts1 = strtotime($filedate);
$ts2 = strtotime($duecap);
$datediff = $ts1 - $ts2;
$defaultdays=number_format(round($datediff / (60 * 60 * 24)));

    
}
  
    
    



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EDIT VAT Self Assessment</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
     <link rel="stylesheet" href="jquery-ui.css">
      <script src="js/jquery-3.3.1.slim.min.js"></script>                 
  	<script src="js/jquery.character-counter.js"></script>  
       <!-- <script src="js3/jquery-1.12.0.min.js"></script> -->
  


</head>
<body>
   <div class="container-fluid" style="background:#FFFAFA">
           <div class="note2" ><h3> &nbsp;DELETE (VAT) Self Assessment</h3>
            </div>
            <form id="returns" name="returns" action="dodeletevatreg" onsubmit="return validateForm()" method="post">
       <div class="row-fluid col-md-4">
                <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="text" class="form-control" id="coytin" name="coytin" placeholder="Tin here" value="<?php echo $coytin ?>">
                </div>
                <div class="form-group">
                    <label for="coyname">Company Name:</label>
                    <input type="text" class="form-control" name="coyname" placeholder="Taxpayer's Name" id="defaultInput" data-charcount-enable="true" maxlength="34" value="<?php echo $coyname ?>" onchange="categofy()">
                </div>
                

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea  name="address" class="form-control" id="address" placeholder="Taxpayer's Address" value=""><?php echo $coyadd ?></textarea>
                </div>
                                
                    <div class="form-group">
                    <label for="YOA">Phone No:</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" value="<?php echo $phone ?> ">
                    </div>
                    
                      
                    <p></p>
                    
                   
                
                    </div>


               
        
               
                <!--second row-->
                <div class="row-fluid col-md-4">
                <div class="form-group">
                    <label for="capture">Date of Capture:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                   <?php
					
						
					echo '<input type="text" name="capture" id="capture" 
                       value="'.$capdate.'" >';
						
						   ?>
                   </div>
                <div class="form-group">
                    <label for="coyname">Category :</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="cattype" id="cattype">
                    <option value="<?php echo $category ?>"><?php echo ucfirst($category); ?></option>
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
                        <option><?php echo $month ?></option>
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
                    <input type="text"  id="yryoa"  name="yryoa" placeholder="YOA" size="5" value="<?php   echo $yoa ;?>">
                
                   </div>
                    
                    <div class="form-group">
                    <label for="amnt">VAT Amount Filed @  <?php echo $vatrate ?>% :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="" name="amount" placeholder="Amount" value="<?php echo $amount ?>" required size="21">
                    </div>

                    <div class="form-group">
                    <label for="amnt">Payment Date :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" id="date" class="" name="paydate" placeholder="Payment Date" value="<?php echo $paydate; ?>">
                    </div>
                    
                                   
                    <div class="form-group">
                    <label for="cittxt">Basis of Assessment:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="basis" id=" basis">
                        <option value="<?php echo $basis ?>"><?php echo $basis ?></option>
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
                        <textarea name="nob" class="form-control" id="remark" placeholder="Nature of Biz or Any Remarks" value=""><?php echo getRemark($conn,$tin) ?></textarea>
                        
                        </div>
                    <div class="form-group">
                    <label for="cittxt">Modified last by:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="form-control" name="modify" placeholder="modified by" value="<?php 
							if ($modified==''){
								$modified='Not Available';
							}
							echo $modified ?>" disabled>
                	</div>
                    <p></p>
                       <input type="hidden" name="user" value="<?php echo $suser ?>">
                       <input type="hidden" name="yoa" value="<?php echo $yoa ?>">
                       <input type="hidden" name="defaults" value="<?php echo $defaultdays ?>">
                       <input type="hidden" name="status" value="<?php echo $userstatus ?>">
                       <input type="hidden" name="serial" value="<?php echo $sno ?>">
                       <input type="hidden" name="duedate" value="<?php echo $duedate ?>">
                       <input type="hidden" name="tab" value="<?php echo $tab ?>">
                       <input type="hidden" name="usersno" value="<?php echo $usersno ?>">
                      <button type="button" class="btn btn-danger" onclick="myAlert();" >Delete Info</button>

                                
                <?php
                    
                   if ($errormsg2==null){
                       
                    echo ('<div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('<div class="alert-danger" id="screen"><h4>'.$errormsg2.' </h4> </div>');
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
 
 </script>
    <script type="text/javascript"> $("#date").datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true });</script>
    <script type="text/javascript"> $("#capture").datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true });</script>


   <script>
        function myAlert() {
            var conf= confirm("Do you really want to delete?");
    if (conf== true){
       document.returns.action = "dodeletevatreg ";
       document.returns.submit();
    }else{
      return;
    }
        }
    </script>

</body>
</html>