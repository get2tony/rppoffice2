<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

$errormsg='';
$errormsg2='';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$tin = isset($_REQUEST['tin']) ? $_REQUEST['tin'] : null;
$sno = isset($_REQUEST['serial']) ? $_REQUEST['serial'] : null;

$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;


// $vatrate=getSettings('vatrate',$conn);
$userstatus=checkUserstatus2($usersno,$conn);





$sql = "SELECT * FROM vatlist where `sno`='$sno'&&`tinno`='$tin'";
        
$query = mysqli_query($conn, $sql);

if (!$query) {
    
    die ('SQL Error: here' . mysqli_error($conn));
    
}

$sno="";
$coytin="";
$coyname="";
$coyadd="";
$phone="";
$remark="";
$category="";
$capdate="";
$modified="";


while ($row = mysqli_fetch_array($query))
        {
$sno=$row[0];
$coytin=$row[1];
$coyname=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($row[2]))));
$coyadd=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($row[3]))));
$phone=$row[4];
$remark=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($row[5]))));
$category=$row[6];
$capdate=$row[7];
$modified=$row[8];


    
}
  
    
    



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EDIT VAT FILER RECORD</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
     <link rel="stylesheet" href="jquery-ui.css">
      <script src="js/jquery-3.3.1.slim.min.js"></script>                 
  	<script src="js/jquery.character-counter.js"></script>  
       <!-- <script src="js3/jquery-1.12.0.min.js"></script> -->
  


</head>
<body>
   <div class="container-fluid">
           <div class="note2" ><h3> &nbsp;EDIT VAT FILER'S RECORD</h3>
            </div>
            <form id="returns" name="returns" action="doeditvatlist" onsubmit="return validateForm()" method="post">
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

                
                    </div>
                    <!--third row-->
                <div class="row-fluid col-md-4">
                    <div class="form-group">
                        <label for="remark">Nature of Biz / Remarks :</label>
                        <textarea name="nob" class="form-control" id="remark" placeholder="Nature of Biz or Any Remarks" value=""><?php echo $remark ?></textarea>
                        
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
                       <input type="hidden" name="status" value="<?php echo $userstatus ?>">
                       <input type="hidden" name="serial" value="<?php echo $sno ?>">
                       <input type="hidden" name="usersno" value="<?php echo $usersno ?>">
                        <button type="submit" class="btn btn-primary">Update Info</button>

                                
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
</body>
</html>