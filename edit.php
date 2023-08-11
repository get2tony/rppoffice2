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



$sql = "SELECT * FROM $table where `sno`='$serial'&&`tinno`='$search'";
        
$query = mysqli_query($conn, $sql);

if (!$query) {
    
    die ('SQL Error: here' . mysqli_error($conn));
    
}

$sno="";
$coytin="";
$coyname="";
$coyadd="";
$yearend="";
$cost="";
$fa="";
$assyr="";
$datecap="";
$duedate="";
$turnover="";
$asspt="";
$totalpt="";
$citamt="";
$edtamt="";
$mintax="";
$niltax="";
$asstype="";
$remark="";
$alabel="";
$assno="";
$ayear="";
$user="";
$modified="";
$phone="";
$cgt="";
$nitd="";
$paytype="";


while ($row = mysqli_fetch_array($query))
        {
$sno=$row[0];
$coytin=$row[1];
$coyname=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($row[2]))));
$coyadd=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($row[3]))));
$yearend=$row[4];
$assyr=$row[6];
$datecap=$row[8];
$duedate=$row[5];
$turnover=$row[9];
$asspt=$row[11];

$totalpt=$row[10];
$citamt=$row[12];
$edtamt=$row[13];
$mintax=$row[17];
$niltax=$row[18];
$asstype=$row[7];
$remark=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($row[19]))));
$alabel=$row[14];
$assno=$row[15];
$ayear=$row[16];
$user=$row[22];
$modified=$row[23];
$phone=$row[27];
$cgt=$row[25]?$row[25]:0;
$nitd=$row[26]?$row[26]:0;;
$paytype=$row[28]?$row[28]:'Cash Payment';
$cost = $row[30];
$fa = $row[31];
    
}
  
    
    
    
    

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Returns Details</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
    
     <script src="js/jquery-3.3.1.slim.min.js"></script>                 
  	<script src="js/jquery.character-counter.js"></script>                
   
</head>
<body>
   <div id="showArea" class="container-fluid">
          <div id ="printableArea"> 
          <form name="editform" action="doedit " method="post">
            <div id="verify">
             <div class="row-fluid col-md-4">
                 <div class="alert-success" id="screen"><h4><label for="">Assessment No:</label></h4><h4><?php echo   $alabel.$assno.'/'.$ayear; ?></h4><h4>
                 <?php echo str_replace("CIT","EDT",$alabel).$assno.'/'.$ayear ;?></h4></div>
             
               
                <div class="form-group">
                   
                    <input type="hidden" class="form-control" id="assmtno" value="<?php echo'$alabel.$assno."/".$ayear';?>"/>
                    <input type="hidden" class="form-control" id="assmtno2" value="<?php echo' str_replace("CIT","EDT",$alabel).$assno."/".$ayear'?>">
                    
                </div>
               
                <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="text" class="form-control" name="coytin" value="<?php echo $coytin ?>" />
                    
                </div>
                <div class="">
                    <label for="coyname">Company Name:</label>
                    <input type="text" class="form-control" name="coyname" value="<?php echo $coyname ?>" id="defaultInput" data-charcount-enable="true" maxlength="34"/>
                     
                </div>

                <div class="">
                    <label for="address">Address:</label>
                   <textarea class="form-control" id="address" value=""  name="address"><?php echo $coyadd ?></textarea>
                     
                </div>
                <div class="form-group">
                    <label for="coyname">Phone:</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone ?>" id="phone" placeholder="Phone Number" />
                     
                </div>
                <div class="form-group">
                    <label for="yearend">Year End:</label>
                    <input name="yrend" type="text"
                     value="<?php echo $yearend ?> "/>
                   </div>
                   <div class="form-group">
                    <label for="duedate">Due date:</label>
         <input type="text" name="duedate" value="<?php echo $duedate ?> "/>          
                     
                   </div>
                   <p></p>
                    
                    <div class="form-group">
                    <label for="YOA">Year of Assessment:</label>
                    <input name="yoa" type="text" class="" id="yoa" placeholder="Year of Assessment" value="<?php echo $assyr ?>" />
                    <span></span>
                    </div>
                    
                      <div class="form-group">
                    <label for="capture">Date of Capture:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input name="capture" type="text" id="capture" 
                        value="<?php echo $datecap ?> "/>
                                                
                   
                       </div>
                       <?php
                            
                        if($user=="" || $user==null){
                           
                        }else{
                            
                           echo'<div class="form-group">
                    <label for="capture">Captured by:</label>
                    <select name="captureby" type="text" id="capture" 
                        value="">
						
						<option> '.$user.'</option>
						
						</select>
                                                
                   
                       </div>';
                        }
                  
                                  
                        ?>
                    <p></p>
                    
                   
                
                    </div>


               
        
               
                <!--second row-->
                <div class="row-fluid col-md-4">
                
                 <div class="form-group">
                    <label for="coyname">Turnover:</label>
                    <input name="tover" type="text" class="form-control" id="tover" value="<?php echo number_format($turnover,2) ?>" placeholder="Turnover" />
                    
                    </div>
                    
                    <div class="form-group">
                    <label for="cost">Direct Cost:</label>
                    <input name="cost" value="<?php echo number_format($cost,2) ?>" type="text" class="form-control" id="cost" placeholder="Direct Cost" onchange="makenum('cost')"/>
                    
                    </div>
                    <div class="form-group">
                    <label for="fa">Fixed Assets:</label>
                    <input name="fa" value="<?php echo number_format($fa,2) ?>" type="text" class="form-control" id="fa" placeholder="Fixed Assets" onchange="makenum('fa')"/>
                    
                    </div>
                    <div class="form-group">
                    <label for="coyname">Assessable Profit:</label>
                    <input name="aprofit" value="<?php echo number_format($asspt,2) ?>" type="text" class="form-control" id="aprofit" placeholder="Assessable Profit" onchange="makenum('aprofit')"/>
                    
                    </div>
                    
                    <div class="form-group">
                    <label for="tprofit">Total Profit:</label>
                    <input name="tprofit" value="<?php echo number_format($totalpt,2) ?>" type="text" class="form-control" id="tprofit" placeholder="Total Profit"  onchange="makenum('tprofit');myext()" />
                    
                    </div>
                    
                    
                     <div class="form-group">
                    <label for="cittxt">Company Income Tax:</label>
                    <input name="cit" value="<?php echo  number_format($citamt,2) ?>" type="text" class="form-control" id="cittxt" placeholder="CIT value here" onchange="makenum('cittxt');myext()" />
                     <span> </span>
                    </div>
                    
                     <div class="form-group">
                    <label for="edttxt">Education Tax:</label>
                    <input name="edt" value="<?php echo number_format($edtamt,2) ?>" type="text" class="form-control" id="edttxt" placeholder="EDT value here" onchange="makenum('edttxt');myext()" />
                     <span></span>
                    </div>
                     <div class="form-group">
                    <label for="edttxt">Capital Gains Tax:</label>
                    <input name="cgt" value="<?php echo number_format($cgt,2) ?>" type="text" class="form-control" id="cgt" placeholder="CGT value here" onchange="makenum('cgt')"/>
                     <span></span>
                    </div>
                     <div class="form-group">
                    <label for="edttxt">(NITD) Levy:</label>
                    <input name="nitd" value="<?php echo number_format($nitd,2) ?>" type="text" class="form-control" id="nitd" placeholder="NITDL value here" onchange="makenum('nitd')" />
                     <span></span>
                    </div>

                   
                         <div class="row-fluid col-md-4">
                         
                     <p></p>
                     <p></p>
                  </div>    
    
                </div>
                
                 </div>
                
             
                <div class="row-fluid col-md-4">
                 <div class="form-group">
                    <label for="mintax">Minimum Tax?:</label>
                    <select name="mintax" id="mintax" >
                        <option><?php echo $mintax ?></option>
                        <option>No</option>
                        <option>Yes</option>
                        
                                                
                         </select>
                       </div>
                       
                       <div class="form-group">
                    <label for="mintax">Filed Nil?:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <select name="niltax" id="niltax" >
                        <option><?php echo $niltax ?></option>
                        <option>No</option>
                        <option>Yes</option>
                        
                                                
                         </select>
                       </div>
                       <div class="form-group">
                    <label for="niltax">Payment Mode:</label>
                    <select name="paytype" id="paytype" >
                      <option><?php echo $paytype ?></option>
                        <option>WHT Credit Note</option>
                        <option>Cash & WHT</option>
                        <option>Cash Payment</option>
                        <option>Exempted</option>
                        <option>Instalment</option>
                     </select>
                       </div>
                        
                        <div class="form-group">
                    <label for="asstype">Assessment Type:</label>
                    <select name="asstype" id="asstype" >
                        <option><?php echo $asstype ?></option>
                        
                                                
                         </select>
                       </div>
                         <p></p>
                         
                         <div class="form-group">
                        <label for="remark">Nature of Biz/Remarks:</label><br/>
                        <textarea class="form-control" name="remark" id="remark" value=""><?php echo $remark ?></textarea>
                        
                        
                        </div>
                <a target="dframe" href="tablepage2?user=<?php echo $suser ?>&tab=<?php echo $table ?>" class="btn btn-primary"> Go Back</a>
                
                
     
                <input type="Submit" class="btn btn-success" value= "Update" />
                
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
                
                  </form>      
                
                    
             
                   
               
       </div>
            
                            
           
   </div>
    
  
   
   
   
  
<script type="text/javascript"> 

     function myVal() {                
var k=document.getElementById("yryoa").value;
var m=Number(k)+1;
document.getElementById("yoa").value=m;

      }            
    

  
     function myreVal() {                
var k=document.getElementById("yoa").value;
var m=Number(k)-1;
document.getElementById("yryoa").value=m;

      }            
    

     function mycom() {                
var k=document.getElementById("yryoa").value;
var m=document.getElementById("yoa").value;
 if( m == k){
	
	document.getElementById("comm2").checked=true;
	 
	}else{
		
	
	document.getElementById("comm1").checked=true;
		
	}

  }            
    


function myext() {                
var k=parseInt(document.getElementById("cittxt").value);
var m=parseInt(document.getElementById("tprofit").value);

if (k<=0) {
    document.getElementById("niltax").value="Yes";
}
if (m<=0 && k>0) {
    document.getElementById("mintax").value="Yes"; 
}

if (m>0 && k>0) {
    document.getElementById("mintax").value="No";
    document.getElementById("niltax").value="No";
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
       
    

 

