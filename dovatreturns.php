<?php 
 
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

$coytin=$_POST["coytin"];
$coyname=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["coyname"]))));
$coyadd=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["address"]))));
$month=$_POST["yrendm"];
$cattype=$_POST["cattype"];
$phone=$_POST["phone"];

$nob=trim(preg_replace('/\s\s+/', '', strtoupper($_POST["nob"])));
$yoa=$_POST['yryoa'];
$datecap=$_POST["capture"];
$amount=mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', $_POST["amount"])));
$suser=$_POST["user"];
$usersno=$_POST["usersno"];
//$nob=$_POST["nob"];
$taxtype=$_POST["ttype"];
$basis=$_POST["basis"];
$paydate=$_POST["paydate"];
$page="raiselrpvat";
$asstype="";
$asstype2="";
if($yoa < substr($datecap,-4)){
    $asstype="back_year";
    $asstype2="lrpback_year";
    $alabel=str_replace('TAX',$taxtype,getSettings('slabelb',$conn));
    
}else{
    $asstype="current";
    $asstype2="lrpcurrent";
    $alabel=str_replace('TAX',$taxtype,getSettings('slabel',$conn));
   
}   
 $alabel=str_replace('M',date('m'),$alabel);       
$assnolrp=getAssmtNumLRPvat($conn,$asstype,$datecap);
$assno=getAssmtNumselfvat($conn,$datecap);
$ayear=substr($yoa,-2);
$userirno=checkUserirno($usersno,$conn);
$duedate=getDuedatevat($month,$yoa);
$showmonths=checkLRPvat($duedate,$datecap);  
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
$filedate = date('Y-m-d',strtotime($datecap));
$ts1 = strtotime($filedate);
$ts2 = strtotime($duecap);
$datediff = $ts1 - $ts2;

$showdefaultdays=number_format(round($datediff / (60 * 60 * 24)));

if($asstype2=="lrpcurrent"){

//$alabellrp="LA/OI/VAT/LSP/";
$alabellrp=str_replace('TAX',$taxtype,getSettings('slabel',$conn))."LSP/";
}else{

//$alabellrp="LA/OIBA/VAT/LSP/";
$alabellrp=str_replace('TAX',$taxtype,getSettings('slabelb',$conn))."LSP/";
        }

 $alabellrp=str_replace('M',date('m'),$alabellrp);
$checkamt=is_numeric($amount);
if($checkamt=="Yes"){
  }else {
 $amount=0;
  }
 $userstatus=checkUserstatus2($usersno,$conn);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm VAT Return Details</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
    <!-- <link rel="stylesheet" href="sweetalert2.min.css">
    
   <style>
	   #hura{
		   top: 70px;
	   }
	
	</style>           -->
                      
   
</head>
<body>
   <div class="container-fluid">
           
          
            <div id="verify">
             <div class="row-fluid col-md-4">
                 <div class="alert-success" id="screen" style="display:block;height:100px" ><h4><label for="">VAT Self Assessment for the Month of </h4>
                 <span style="font-family:arial black;position:absolute;top:37px;"><h4><label for="" > <?php echo $month.' '.$yoa?></h4></span><br>Assigned Asmt No: <?php echo $alabel.$assno."/".$ayear;?>
             </div>
               
                <div class="form-group">
                   
                    <!-- <input type="hidden" class="form-control" id="assmtno" value=""/> -->
                    
                    
                </div>
               
                <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="hidden" class="form-control" id="" value="" >
                    <span><?php echo $coytin   ?> </span>
                </div>
                <div class="form-group">
                    <label for="coyname">Company Name:</label>
                    <input type="hidden" class="form-control" id="" value="" hidden="hidden">
                     <span><?php echo stripslashes($coyname)   ?> </span>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                   <input type="hidden" class="form-control" id="" value="" >
                     <span><?php echo $coyadd   ?> </span>
                </div>
                <div class="form-group">
                    <label for="yearend">Month Filed:</label>
                    
                     <span><?php echo $month.' '.$yoa;   ?> </span>
                   </div>
                   <div class="form-group">
                    <label for="duedate">Due date:</label>
                    
                     <span><?php  echo $duedate ?> </span>
                   </div>
                   <p></p>
                    
                   
                    
                      <div class="form-group">
                    <label for="capture">Date of Capture:</label>
                    <select name="capture" id=""  disabled>
                        <option><?php   echo $datecap;?></option>                
                    </select>
                       </div>
                    <p></p>
                    
                   <div class="form-group">
                    <label for="duedate">Payment date:</label>
                    
                     <span><?php  echo $paydate ?> </span>
                   </div>
                   
                
                   


               
        
               
                <!--second row-->
                
        
                     <div class="form-group">
                    <label for="amount">Amount Filed:</label>
                    
                     <span><?php echo  number_format($amount,2) ;?> </span>
                    </div>
                  <div class="form-group">
                    <label for="amount">Category:</label>
                    
                     <span><?php echo  $cattype?> </span>
                    </div>

                      <form name="datacap" action="dosubmitvat " method="post">
                      
              
               <input type="hidden" value="<?php echo $coytin ;?>" name="coytin" id="coytin">
               <input type="hidden" value="<?php echo $coyname;?>" name="coyname" id="coyname">
               <input type="hidden" value="<?php echo $coyadd;?>" name="address" id="address">
               <input type="hidden" value="<?php echo $month;?>" name="yrendm" id="yrendm">
               <input type="hidden" value="<?php echo $yoa;?>" name="yoa" id="yoa">
               <input type="hidden" value="<?php echo $datecap;?>" name="capture" id="capture">
               <input type="hidden" value="<?php echo $duedate;?>" name="duedate" id="duedate">
               <input type="hidden" value="<?php echo $amount;?>" name="amount" id="amount">
               <input type="hidden" value="<?php echo $showdefaultdays;?>" name="defaults" id="defaults">
               
               <input type="hidden" value="<?php echo $taxtype;?>" name="taxtype" id="taxtype">
               <input type="hidden" value="<?php echo $cattype;?>" name="cattype" id="cattype">
               <input type="hidden" value="<?php echo $paydate;?>" name="paydate" id="paydate">
               <input type="hidden" value="<?php echo $basis;?>" name="basis" id="basis">
               <input type="hidden" value="<?php echo $phone;?>" name="phone" id="phone">
              
               <input type="hidden" value="<?php echo $nob;?>" name="nob" id="nob">
               <input type="hidden" value="<?php echo $suser;?>" name="user" id="user">
               <input type="hidden" value="<?php echo $userirno;?>" name="userirno" id="userirno">
               <input type="hidden" name="usersno" value="<?php echo $usersno ?>" id="usersno">
               <input type="hidden"  value="<?php echo $alabel.$assno."/".$ayear;?>" name="label" id="label">
                </div>
                <div class="row-fluid col-md-4">

                 
                <?php
                        
                       if($amount<1){
                            
                         echo('<div class="alert-info" id="screen"><h4>This Return will be captured as NIL</h4></div> <p></p>
                         
                              <input type="Submit" class="btn btn-primary" value="Submit Returns">
             
                </form>
              
               
                         ') ;
                            
                        }else{
                            
                            
                            
                            echo('  <p></p>
                        
                
                
                
              
           
            
               
 
                <input type="Submit" class="btn btn-primary" value="Submit Returns">
             
            </form>
          
           ');
                            
                            
                        }
    
                    ?>
                    

                          <p>&nbsp;</p>
                         
                          
                          

                    
                    <?php
                    
                    if ($showLRPdue>1){
                    echo '
                     <div class="alert-danger" id="screen">
                    <label for="months">This Return is Late by ';
                    if ($showmonths<2) {

                      echo $showdefaultdays.' Day(s)';
                    }else {
                      echo $showmonths.'Months';
                    }
                    
                    
                    echo'  because the due date is '.$duedate.'; Hence it is liable to N '.$showLRPdue.' Late Submission Penalty.<br/>
                    
                    <h4>LSP Asmt No:&nbsp;'.$alabellrp.$assnolrp.'/'.$ayear.'</h4>
               <form action="processvatlrp "  method="post" target="_blank">
               <input type="hidden" value="'.$coytin.'" name="coytin">
               <input type="hidden" value="'.urlencode($coyname).'" name="coyname">
               <input type="hidden" value="'.urlencode($coyadd).'" name="address">
               
               <input type="hidden" value="'.$yoa.'" name="yoa">
               <input type="hidden" value="'.$month.'" name="yrendm">
               <input type="hidden" value="'.$datecap.'" name="capture">
               <input type="hidden" value="'.$page.'" name="page">
               <input type="hidden" value="'.$showLRPdue.'" name="amount">
               <input type="hidden" value="'.$alabellrp.'" name="alabel">
               <input type="hidden" value="'.$assnolrp.'" name="assno">
               <input type="hidden" value="'.$ayear.'" name="ayear">
               <input type="hidden" value="'.$suser.'" name="user">
               <input type="hidden" value="'.$usersno.'" name="usersno">
               <input type="hidden" value="VAT" name="taxtype">
               
               
               <input type="hidden" value="'.getDueMonthvat($duedate).'" name="duedate">
               <input type="hidden" value="'.$due.'" name="dueend">
               
               
               <input type="hidden" value="'.$showmonths.'" name="default">
               <input type="hidden" value="'.$asstype2.'" name="tbn">
               <input type="hidden" value="'.$userstatus.'" name="ustatus">
               <br>
             <button type="Submit" class="btn btn-danger" onclick="" >Raise Assessment</button>
            
           
        
           <p></p>
           
           
                
                    </form>';
                         
                          }else{
                        echo '';
                            }
                          
                           ?>
                       </div>
                        
                        
                        
                       
                         
                   
                        
                </div>
                
                <div class="row-fluid col-md-4">
                
                 
                <p></p>
                
                
                
                </div>
            
    
       </div>     
                               
           
   
   <script src="js3/jquery-1.12.4.js"></script>
   <!-- <script src="sweetalert2.all.min.js"> </script> -->
   <!-- <script src="Ajaxsubmit2.js"></script> -->
  
    
</body>
</html>