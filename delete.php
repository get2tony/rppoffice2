<?php 


include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');


$search=$_GET['tin'];
$table=$_GET['tab'];
$serial=$_GET['sno'];
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
$fuser="";

while ($row = mysqli_fetch_array($query))
        {
$sno=$row[0];
$coytin=$row[1];
$coyname=$row[2];
$coyadd=$row[3];
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
$remark=$row[19];
$alabel=$row[14];
$assno=$row[15];
$ayear=$row[16];
$fuser=$row[22];   
}
  
    
    
    
    

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Returns Details</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
    
                     
   
</head>
<body>
   <div id="showArea" class="container-fluid">
          <div id ="printableArea"> 
          <form name="deleteform" action="dodelete " method="post">
            <div id="verify">
             <div class="row-fluid col-md-4">
                 <div class="alert-danger" id="screen"><h4><label for="">Assessment No:</label></h4><h4><i class="glyphicon glyphicon-remove"></i> <?php echo   $alabel.$assno.'/'.$ayear; ?></h4><h4>
                 <i class="glyphicon glyphicon-remove"></i> <?php echo str_replace("CIT","EDT",$alabel).$assno.'/'.$ayear ;?></h4></div>
             
               
                <div class="form-group">
                   
                    <input type="hidden" class="form-control" id="assmtno" value="<?php echo'$alabel.$assno."/".$ayear';?>" disabled/>
                    <input type="hidden" class="form-control" id="assmtno2" value="<?php echo' str_replace("CIT","EDT",$alabel).$assno."/".$ayear'?>" disabled>
                    
                </div>
               
                <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="text" class="form-control" name="coytin" value="<?php echo $coytin ?>" disabled/>
                    
                </div>
                <div class="form-group">
                    <label for="coyname">Company Name:</label>
                    <input type="text" class="form-control" name="coyname" value="<?php echo $coyname ?>" disabled/>
                     
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                   <textarea class="form-control" id="address" value=""  name="address" disabled><?php echo $coyadd ?></textarea>
                     
                </div>
                <div class="form-group">
                    <label for="yearend">Year End:</label>
                    <input name="yrend" type="text"
                     value="<?php echo $yearend ?> " disabled/>
                   </div>
                   <div class="form-group">
                    <label for="duedate">Due date:</label>
         <input type="text" name="duedate" value="<?php echo $duedate ?> "disabled />          
                     
                   </div>
                   <p></p>
                    
                    <div class="form-group">
                    <label for="YOA">Year of Assessment:</label>
                    <input name="yoa" type="text" class="form-control" id="yoa" placeholder="Year of Assessment" value="<?php echo $assyr ?> "disabled />
                    <span></span>
                    </div>
                    
                      <div class="form-group">
                    <label for="capture">Date of Capture:</label>
                    <input name="capture" type="text" id="capture" 
                        value="<?php echo $datecap ?> " disabled />
                                                
                   
                       </div>
                    <p></p>
                    
                   
                
                    </div>


               
        
               
                <!--second row-->
                <div class="row-fluid col-md-4">
                
                 <div class="form-group">
                    <label for="coyname">Turnover:</label>
                    <input name="tover" type="text" class="form-control" id="tover" value="<?php echo $turnover ?>" placeholder="Turnover" disabled />
                    
                    </div>
                    
                    <div class="form-group">
                    <label for="coyname">Assessable Profit:</label>
                    <input name="aprofit" value="<?php echo $asspt ?>" type="text" class="form-control" id="aprofit" placeholder="Assessable Profit" disabled />
                    
                    </div>
                    
                    <div class="form-group">
                    <label for="tprofit">Total Profit:</label>
                    <input name="tprofit" value="<?php echo $totalpt ?>" type="text" class="form-control" id="tprofit" placeholder="Total Profit" disabled />
                    
                    </div>
                    
                    
                     <div class="form-group">
                    <label for="cittxt">Company Income Tax:</label>
                    <input name="cit" value="<?php echo  $citamt ?>" type="text" class="form-control" id="cittxt" placeholder="CIT value here" disabled />
                     <span> </span>
                    </div>
                    
                     <div class="form-group">
                    <label for="edttxt">Education Tax:</label>
                    <input name="edt" value="<?php echo $edtamt ?>" type="text" class="form-control" id="edttxt" placeholder="EDT value here" disabled />
                     <span></span>
                    </div>

                    <div class="form-group">
                    <label for="mintax">Minimum Tax?:</label>
                    <select name="mintax" id="mintax" disabled >
                        <option><?php echo $mintax ?></option>
                        <option>yes</option>
                        <option>no</option>
                        
                                                
                         </select>
                       </div>
                       <div class="form-group">
                    <label for="mintax">Filed Nil?:</label>
                    <select name="niltax" id="niltax" disabled>
                        <option><?php echo $niltax ?></option>
                        <option>yes</option>
                        <option>no</option>
                        
                                                
                         </select>
                       </div>
                        
                        <div class="form-group">
                    <label for="asstype">Assessment Type:</label>
                    <select name="asstype" id="asstype" disabled >
                        <option><?php echo $asstype ?></option>
                        
                                                
                         </select>
                       </div>
                         <p></p>
                         
                         <div class="form-group">
                        <label for="remark">Remarks:</label>
                        <textarea name="remark" id="remark" value="" disabled><?php echo $remark ?></textarea>
                        
                        
                        </div>
                         <div class="row-fluid col-md-4">
                     <p></p>
                     <p></p>
                  </div>    
    
                </div>
                
                 </div>
                
             
                <div class="row-fluid col-md-4">
                <a target="dframe" href="tablepage2?user=<?php echo $suser ?>&tab=<?php echo $table ?>" class="btn btn-default"> Go Back</a>
                
                
     
                <input type="button" class="btn btn-danger"  onclick="myAlert();"value= "Delete" />
                
                <p></p>

                
                </div>
                 <input type="hidden" name="sno" value="<?php echo $sno ?> " />
                 <input type="hidden" name="tin" value="<?php echo $coytin ?> " />
                 <input type="hidden" name="table" value="<?php echo $table ?>"
                  />
                   <input type="hidden" name="user" value="<?php echo $suser ?>" />
                  </form>      
                
                    
             
                   
               
       </div>
            
                            
           
   </div>
    
   <script src="js3/jquery-1.12.4.js">
   </script>
   <script>
        function myAlert() {
            var conf= confirm("Do you really want to delete?");
    if (conf== true){
       document.deleteform.action = "dodelete ";
       document.deleteform.submit();
    }else{
      return;
    }
        }
        </script>
   
  
  
    
</body>
</html>
       
    

 

