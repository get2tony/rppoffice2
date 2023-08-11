<?php 
 
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

$coytin=mysqli_real_escape_string($conn,$_POST["coytin"]);
$coyname=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["coyname"]))));
$coyadd=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["address"]))));
$yearend=$_POST["yrendm"];
$amount=number_format(str_replace( ',', '',mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', isset($_POST['amount']) ? $_POST['amount'] : 0.00)))),2);
$assyr=$_POST["yoa"];
$unique='no';

if($yearend!="July" && $yearend!="August" && $yearend!="September" && $yearend!="October" && $yearend!="November" && $yearend!="December"){
    
    $assyr=$assyr-1;
	$unique='yes';
    
}


$datecap=$_POST["date"];
$issue=$_POST["capture"];
$suser=$_POST["user"];
$usersno=$_POST["usersno"];
$userstatus=checkUserstatus2($usersno,$conn);
$duedate=getDuedate($yearend);
$alabellrp="";
$page='raiselrp2';
$taxtype='LRP';

$asstype="";
$asstype2="";
$assyrz=$assyr;
if($unique=='yes'){
	$assyrz=$assyr+1;
}

if($assyrz < substr($datecap,-4)){
    $asstype="back_year";
    $asstype2="lrpback_year";
    
    
}else{
    $asstype="current";
    $asstype2="lrpcurrent";
   
}           
$showmonths=checkLRP($duedate,$datecap,$assyr);  
$showLRPdue=$amount;
$assnolrp=getAssmtNumLRP($conn,$asstype,$datecap);
$ayear=substr($assyrz,-2);

                  
                
if($asstype2=="lrpcurrent"){

//$alabellrp="LA/OI/LRP/";
$alabellrp=str_replace('TAX',$taxtype,getSettings('slabel',$conn));
}else{

//$alabellrp="LA/OIBA/LRP/";
$alabellrp=str_replace('TAX',$taxtype,getSettings('slabelb',$conn));
        }

  $alabellrp=str_replace('M',date('m'),$alabellrp);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm LRP Details</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
    
                      
   
</head>
<body>
   <div class="container-fluid">
           
          
            <div id="verify">
             <div class="row-fluid col-md-4">
                 <div class="alert-success" id="screen"><h4><label for="">Assessment No:</label></h4><h4> <?php echo $alabellrp.$assnolrp."/".$ayear;?></h4><h4>
                </h4></div>
             
               
                <div class="form-group">
                   
                    <input type="hidden" class="form-control" id="assmtno" value="<?php echo $alabellrp.$assnolrp."/".$ayear;?>"/>
                    
                    
                </div>
               
                <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="hidden" class="form-control" id="coytin" value="" >
                    <span><?php echo $coytin   ?> </span>
                </div>
                <div class="form-group">
                    <label for="coyname">Company Name:</label>
                    <input type="hidden" class="form-control" id="coyname" value="" hidden="hidden">
                     <span><?php echo stripslashes($coyname)   ?> </span>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                   <input type="hidden" class="form-control" id="address" value="" >
                     <span><?php echo $coyadd   ?> </span>
                </div>
                <div class="form-group">
                    <label for="yearend">Year End:</label>
                    
                     <span><?php echo $yearend  ?></span>
                   </div>
                   <div class="form-group">
                    <label for="duedate">Due date:</label>
                    
                     <span><?php  echo $duedate.' '.$assyr; ?> </span>
                   </div>
                   <p></p>
                    
                    <div class="form-group">
                    <label for="YOA">Year of Assessment:</label>
                    <input type="hidden" class="form-control" id="coyname" placeholder="Year of Assessment" value="" disabled>
                    <span><?php   echo $assyrz;?> </span>
                    </div>
                    
                      <div class="form-group">
                    <label for="capture">Date Submitted:</label>
                    <select name="capture" id="capture"  disabled>
                        <option><?php   echo $datecap;?></option>                
                    </select>
                       </div>
                       
                       <div class="form-group">
                    <label for="capture">Date Raised:</label>
                    <select name="date2" id="capture"  disabled>
                        <option><?php  echo $issue;?></option>                
                    </select>
                       </div>
                    <p></p>
                    
                   
                
                    </div>


               
        
               
                <!--second row-->
                <div class="row-fluid col-md-4">
        
                     <div class="form-group">
                    <label for="amount">Amount Due:</label>
                    <input type="hidden" class="form-control" id="amount" placeholder="Amount value here"  />
                     <span><?php echo  $showLRPdue ;?> </span>
                    </div>
                    
                    <?php
                    
                if ($showLRPdue>1 && $showmonths >0){
                    echo( '
                     <div class="form-group">
                    <label for="months">No. of Month(s) Default:</label>
                    <select name="months" id="months"  disabled>
                        <option>'.$showmonths.' </option>
                        
                         
                         </select>
                         
                         <form action="processlrp "  method="post" target="_blank">
                
               <input type="hidden" value="'.$coytin.'" name="coytin">
               <input type="hidden" value="'.$coyname.'" name="coyname">
               <input type="hidden" value="'.$coyadd.'" name="address">
               
               <input type="hidden" value="'.$assyrz.'" name="yoa">
               <input type="hidden" value="'.$datecap.'" name="capture">
               <input type="hidden" value="'.$issue.'" name="date2">
               <input type="hidden" value="'.$page.'" name="page">
               <input type="hidden" value="'.$yearend. '" name="yrendm">
               
               
               
               <input type="hidden" value="'.$showLRPdue.'" name="amount">
              
               <input type="hidden" value="'.$alabellrp.'" name="alabel">
               <input type="hidden" value="'.$assnolrp.'" name="assno">
               <input type="hidden" value="'.$ayear.'" name="ayear">
               <input type="hidden" value="'.$suser.'" name="user">
               <input type="hidden" value="'.$usersno.'" name="usersno">
               
               
               <input type="hidden" value="'.getDueMonth($duedate,$assyr).'" name="duedate">
               
               
               <input type="hidden" value="'.$showmonths.'" name="default">
               <input type="hidden" value="'.$asstype2.'" name="tbn">
                <input type="hidden" value="'.$userstatus.'" name="ustatus">
 
            <button type="Submit" class="btn btn-danger" onclick="">Raise Assessment</button>
            
           
        
           <p></p>
           
           
                
                    </form>');
                         
                          }else{
                        echo ('
                        <div class="alert-danger" id="screen"><h4><i class="glyphicon glyphicon-remove"></i> This Return is not Late, it will be due on   '.$duedate.' '.$assyr.' </h4> </div>
                        
                        <p></p>
                        <a class="btn btn-danger" href="raiselrp2?sno='.$usersno.'&user='.$suser.'">Go Back</a>');
                            }
                          
                           ?>
                       </div>
                        
                        
                        
                       
                         
                   
                        
                </div>
                
                <div class="row-fluid col-md-4">
                
                 
                <p></p>
                
                
                
                </div>
            
    
       </div>     
                               
           
   
   <script src="js3/jquery-1.12.4.js"></script>
  
  
    
</body>
</html>