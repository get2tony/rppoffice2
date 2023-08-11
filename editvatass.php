<?php


include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');

$errormsg='';
$errormsg2='';
$search='';
$table='';
$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;


$table = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
$search = isset($_REQUEST['tin']) ? $_REQUEST['tin'] : null;
$serial = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['usersno']) ? $_REQUEST['usersno'] : null;


$sql = "SELECT * FROM $table where `sno`='$serial'&&`tinno`='$search'";
        
$query = mysqli_query($conn, $sql);

if (!$query) {
    
    die ('SQL Error: here' . mysqli_error($conn));
    
}

$sno="";
$coytin="";
$coyname="";
$coyadd="";
$assyr="";
$datecap="";
$taxtype="";
$amount="";
$assno="";
$basis="";
$startdate="";
$enddate="";
$user="";
$modified="";

while ($row = mysqli_fetch_array($query))
        {
$sno=$row[0];
$coytin=$row[1];
$coyname=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($row[2]))));
$coyadd=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($row[3]))));
$assyr=$row[4];
$datecap=$row[5];
$taxtype=$row[6];
$amount=amount_empty($row[7]);
$assno=$row[8];
$basis=$row[9];
$startdate=$row[10];
$enddate=$row[11];
$user=$row[12];
$modified=$row[13];
$amtpaid=amount_empty($row[14]);
$assprofit=amount_empty($row[15]);
$tprofit=amount_empty($row[16]);
	

$penalty=$row[17];
$approval=$row[18];
$appby=$row[19];
$appdate=$row[20];
	
//	vat stuff
$inputvat=amount_empty($row[21]);
$vatamt=amount_empty($row[22]);
    
}
if($taxtype=='VAT'){
	$tprofit=0;
	$assprofit=0;
	
}
  
if($startdate=="" || $enddate=="") {
    $nyoa=$assyr-1;
    $startdate="01-01-".$nyoa;
    $enddate="31-12-".$nyoa;
}   
    
 $userstatus=checkUserstatus2($usersno,$conn);  
 $checkass=checkApprovalstatus($assno,$sno,$conn);

if($user=="Tony Damidami"){
	$userstatus="admin";
}
	
    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Raised Assessment</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
    <script src="js/jquery-3.3.1.slim.min.js"></script>                 
  	<script src="js/jquery.character-counter.js"></script>
           
   
</head>
<body>
   <div class="container-fluid">
            <form name="returns" action="doeditass " method="post">
       <div class="row-fluid col-md-4">
               
                <div class="form-group">
                    <label for="asno">Assessment No:</label>
                    <input type="text" class="form-control" id="" name="asno" placeholder="Asmt No"  value="<?php echo $assno ?>">
                </div>
                   
                   <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="text" class="form-control" id="coytin" name="coytin" placeholder="Tin here" value="<?php echo $coytin ?>" >
                </div>
                <div class="form-group">
                    <label for="coyname">Company Name:</label>
                    <input type="text" class="form-control"   name="coyname" placeholder="Taxpayer's Name" value="<?php echo $coyname ?>" id="defaultInput" data-charcount-enable="true" maxlength="34">
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea  name="address" class="form-control" id="address" placeholder="Taxpayer's Address" ><?php echo $coyadd ?></textarea>
                </div>
                                
                    <div class="form-group">
                    <label for="YOA">Year of Assessment:</label>
                    <input type="text" name="yoa" class="form-control" id="yoa" placeholder="Year of Assessment" value="<?php   echo $assyr;?>" onchange="myVal()">
                    </div>
                    <div class="form-group">
                    <label for="capture">Date  Raised:</label>
                    <?php  
						
		   			if($userstatus=="user"){
						
						echo '
                    <select name="capture" id="capture">
                        <option> '.$datecap.'</option>
                                                
                    </select>
                      ';
						
					}else{
						
						
						echo'
                    <input type="text" name="capture" id="capture" value="'.$datecap.'">';
						
					}
		   
		   			?>
                     
                                                
                  
                       </div>
                        <?php
                            
                        if($user=="" || $user==null){
                           
                        }else{
                            
                            echo'<div class="form-group">
                    <label for="capture">Raised by:</label>
                    <input name="captureby" type="text" id="capture" 
                        value="'.$user.'" disabled/>
                                                
                   
                       </div>';
                        }
                  
                                  
                        ?>
                    <p></p>
                    
                   
                
                    </div>


               
        
               
                <!--second row-->
                <div class="row-fluid col-md-4">
                
                 <div class="form-group">
                    <label for="taxtype">Tax Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <select name="ttype" id="" >
                        <option ><?php echo $taxtype ?></option>
                        
                      
                    </select>
                    </div>
                     
                 
                   <div class="form-group">
                    <label for="coyname">Period covered:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    
                    
                    
                    <input type="text" class="" id="startdate"  name="startdate" placeholder="start date" size="8" value="<?php echo $startdate;?>"   >                
                    
                    <label for="enddate"> To:</label>
                    <input type="text" class="" id="enddate"  name="enddate" placeholder="End date" size="8"  value="<?php echo $enddate;?>">
                </div> 
                   
					<div class="form-group">
                    <label for="amnt">Total Amount:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="" name="amount11" placeholder="Amount Raised" 
                    value="<?php 
						    $amount=number_format(str_replace(',','',$amount),2);
						   echo $amount ?>" size="21" disabled>
                    </div>
					
					                  
                    
                    <div class="form-group">
                    <label for="cittxt">Basis of Assessment:</label>&nbsp;
                    <select name="basis" id="">
                        <option ><?php echo $basis ?></option>
                         <?php  
                        if ($basis=="Additional Tax"){
                    echo "<option >Admin Tax</option>
                          <option >BOJ</option>
                          <option >Audit</option>
						 
                          <option >Re-assessment</option>
                         ";  
                        }elseif($basis=="Admin Tax"){
                    echo "<option >Additional Tax</option>
                          <option >BOJ</option>
						 <option >Audit</option>
                          <option >Re-assessment</option>
                          <option >Provisional Tax</option>";  
                        }elseif($basis=="BOJ"){
                     echo "<option >Additional Tax</option>
                          <option >Admin Tax</option>
						  <option >Audit</option>
                          <option >Re-assessment</option>";
                            
                        }elseif($basis=="Re-assessment"){
                     echo "<option >Additional Tax</option>
                          <option >Admin Tax</option>
						  <option >Audit</option>
                          <option >BOJ</option>
                          ";
                            
                        }elseif($basis=="Audit" || $basis=="audit"){
                     echo "<option >Additional Tax</option>
                          <option >Admin Tax</option>
                          <option >BOJ</option>
						  
                          <option >Re-assessment</option>";
                            
                        }
                        ?>
                        
                    </select>
                    </div>
                    
                    
                    <div class="form-group">
                    <label for="cittxt">Modified last by:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="form-control" name="modify" placeholder="modified by" value="<?php 
							if ($modified==''){
								$modified='Not Available';
							}
							echo $modified ?>" disabled>
                    
                    
					</div>
                   <div class="form-group">
                    <label for="cittxt">Amount Already paid:</label>&nbsp;&nbsp;
                    
          <input type="text" class="" name="amtpaid" placeholder="Amount Paid" value="<?php 
						    $amtpaid=number_format(str_replace(',','',$amtpaid),2);
						   echo $amtpaid ?>" size="21">
                        
                        
						
					</div>
                  <div class="form-group" >
                    <label for="cittxt">Input VAT:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="" name="inputvat" placeholder="input vat" value="<?php 
						    $inp=number_format(str_replace(',','',$inputvat),2);
						   echo $inp ?>" size="21">
					</div>
                   <div class="form-group" >
                    <label for="cittxt">VAT Amount Raised:</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" class="" name="vatraised" placeholder="total profit" value="<?php
$vraise=number_format(str_replace(',','',$vatamt),2); 
  if ($vraise==0){
    echo $amount;
    }else{
    echo $vraise;   
     }
?>" size="21">
					</div>
                        
                      <div class="form-group">
                    <label for="cittxt">Is Penalty (Inc)?:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="pena" id="">
                       
                       
                        <option ><?php 
	                     if ($penalty=='on'){
							echo  $show='Yes';
						 }else{
						 	echo  $show='No';
						 }
	                     ?></option>
                        
						</select>
					</div>                             
                                                                                                         
                   <div class="form-group">
                    <label for="cittxt">Approval Status:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="appstat" id="">
                        <option ><?php 
							   if($approval==''){
								  $approval='Not Available'; 
							   }
							   echo ucfirst($approval) ?></option>
                        
						</select>
					</div>
                   <div class="form-group">
                    <label for="cittxt">Approved By:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      
                    <input name="appby" type="text" id=""  
                        value="<?php 
	                     if ($appby==''){
							 $appby='Not Availabe';
						 }
	                    echo $appby ?>" disabled/>
                  	</div>
                   <div class="form-group">
                    <label for="cittxt">Date of Approval:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="appby" id="">
                       
                       
                        <option ><?php 
	                     if ($appdate==''){
							 $appdate='Not Availabe';
						 }
	                    echo $appdate ?></option>
                        
						</select>
					</div>
				</div>
                    <!--3rd section-->
             <div class="row-fluid col-md-4">
                        <button type="submit" class="btn btn-primary">Update Asmt Notice</button>
                <p></p>
                                
               <?php
                    
                   if ($errormsg2==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4><i class="glyphicon glyphicon-remove"></i> '.$errormsg2.' </h4> </div>');
                   }
                    
                     if ($errormsg==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen"><h4><i class="glyphicon glyphicon-ok"></i> '.$errormsg.' </h4> </div>');
                   }
					
					
					
                    ?>
               
               
                
                </div>
				
                <input type="hidden" name="sno" value="<?php echo $sno ?> " />
                 <input type="hidden" name="table" value="<?php echo $table ?>" />
                 <input type="hidden" name="suser" value="<?php echo $suser ?>" />
                 <input type="hidden" name="user" value="<?php echo $user ?>" />
                 <input type="hidden" name="usersno" value="<?php echo $usersno ?>" />
                 
                 <input type="hidden" name="assprofit" value="<?php 
						    $assprofit=number_format(str_replace(',','',$assprofit),2);
						   echo $assprofit ?>" />
                 <input type="hidden" name="tprofit" value="<?php 
						    $tprofit=number_format(str_replace(',','',$tprofit),2);
						   echo $tprofit ?>" />
                 
               
                 
                 <input type="hidden" name="penalty" value="<?php echo $penalty ?>" />
                 
                 
                 
                 
                  
            </form>
           
           
           
   </div>
   <!--<script src="js3/jquery-1.12.4.js"></script>-->
  
      <script type="text/javascript"> 
     function myVal() {                
var k=document.getElementById("yoa").value;
var m= k-1;
var strd=document.getElementById("startdate").value.substring(0, 6);
var endd=document.getElementById("enddate").value.substring(0, 6);

document.getElementById("startdate").value=strd+m;
document.getElementById("enddate").value=endd+m;


 var d = new Date();
var n = d.getFullYear();
 
          
         
      if( k < n){
         var j=document.getElementById("asno").value;
          var q=j.replace("OI","OIBA");
         document.getElementById("asno").value=q;
          
          
          
         }else{
        var j=document.getElementById("asno").value;
          var q=j.replace("OIBA","OI");
         document.getElementById("asno").value=q;  
             
         }
        
        
             
         }   

                    
    
    
    
    </script>
  
    
</body>
</html>