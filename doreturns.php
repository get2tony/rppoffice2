<?php 
 
include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');

$coytin=$_POST["coytin"];
$coyname=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["coyname"]))));
$phone=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["phone"]))));
$coyadd=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["address"]))));
$yearend=$_POST["yrendm"];
$assyr=$_POST["yoa"];
$datecap=$_POST["capture"];
$duedate=getDuedate($yearend);
$turnover=mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', $_POST["tover"])));

$cost=mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', $_POST["csales"])));
$fa=mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', $_POST["faxt"])));
$yrendyoa=$_POST['yryoa'];
$asspt=mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '',$_POST["asspt"])));
$totalpt=mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '',$_POST["tpt"])));
$citamt=mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '',$_POST["cit"])));
$edtamt=mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '',$_POST["edt"])));
$cgt=mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '',$_POST["cgt"])));
$nitd=mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '',$_POST["nitdl"])));
$mintax=$_POST["mintax"];
$niltax=$_POST["niltax"];
$suser=$_POST["user"];
$usersno=$_POST["usersno"];
$comm=$_POST["comm"];
$asstype='current';
$taxtype='CIT';
$paytype=$_POST["paytype"];
if($comm=="yes"){
	$comm=checkcomm($yrendyoa,$assyr);
}



if($assyr < substr($datecap,-4)){
    
    $asstype="back_year";
}

if($asstype=="current"){
    
//    $alabel="LA/OI/CIT/";
    $alabel=str_replace('TAX',$taxtype,getSettings('slabel',$conn));
    
    $asstype2="lrpcurrent";
}else{
    
//    $alabel="LA/OI/CITBA/";
    $alabel=str_replace('TAX',$taxtype,getSettings('slabelb',$conn));
     
    $asstype2="lrpback_year";
}

$alabel=str_replace('M',date('m'),$alabel);
$assno=getAssmtNum($conn,$asstype,$datecap);
$ayear=substr($assyr,-2);

$remark=trim(preg_replace('/\s\s+/', '', strtoupper($_POST["remark"])));
$showduedate= $duedate.' '.$assyr;
$showyrend= $yearend.' '.$yrendyoa;

if($yrendyoa<$assyr && $yearend!="July" && $yearend!="August" && $yearend!="September" && $yearend!="October" && $yearend!="November" && $yearend!="December"){
    
   $showduedate= $duedate.' '.$yrendyoa;
    
}



/*computation Rates*/
$c=number_format(str_replace( ',', '',$totalpt)*0.3,2);
$e=number_format(str_replace( ',', '',$asspt)*0.02,2);
/*ends here*/
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Returns Details</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
    
                      
   
</head>
<body>
 
   <div class="container-fluid">
           
          
                <div class="panel panel-default">
              <div  id="verify" class="panel-heading "> <h4><b>Verify Information Supplied</b></div>
              </h4>
              <!-- Available Assmt No:<?php // echo $alabel.$assno."/".$ayear;?> -->
              <div class="panel-body">
            
                 <div id="verify">
             <div class="row-fluid col-md-4">
                
               
                <div class="form-group">
                   
                    <input type="hidden" class="form-control" id="assmtno" value="<?php echo $alabel.$assno."/".$ayear;?>">
                    <input type="hidden" class="form-control" id="assmtno2"  value="<?php echo str_replace("CIT","EDT",$alabel).$assno."/".$ayear;?>">
                    
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
                    <label for="coyname">Phone:</label>
                    <input type="hidden" name="" class="form-control" id="phone" value="" hidden="hidden">
                     <span><?php echo stripslashes($phone)   ?> </span>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                   <input type="hidden" class="form-control" id="address" value="" >
                     <span><?php echo $coyadd   ?> </span>
                </div>
                <div class="form-group">
                    <label for="yearend">Year End:</label>
                    
                     <span><?php echo $showyrend   ?> </span>
                   </div>
                   <div class="form-group">
                    <label for="duedate">Due date:</label>
                    
                     <span><?php  echo $showduedate ?> </span>
                   </div>
                   <p></p>
                    
                    <div class="form-group">
                    <label for="YOA">Year of Assessment:</label>
                    <input type="hidden" class="form-control" id="coyname" placeholder="Year of Assessment" value="" disabled>
                    <span><?php   echo $assyr;?> </span>
                    </div>
                    
                      <div class="form-group">
                    <label for="capture">Date of Capture:</label>
                    <select name="capture" id="capture"  disabled>
                        <option><?php   echo $datecap;?></option>
                                                
                    </select>
                       </div>
                       <div class="form-group">
                    <label for="mintax">Payment Mode:</label>
                    <select name="paytype" id="paytype" disabled>
                        <option><?php echo $paytype ?></option>
                        
                                                
                         </select>
                       </div>

                        <div class="form-group">
                    <label for="asstype">Assessment Type:</label>
                    <select name="asstype" id="asstype"  disabled>
                        <option><?php echo ucwords($asstype); ?></option>
                        
                                                
                         </select>
                       </div>
                    <p></p>
                    
                   
                
                    </div>


               
        
               
                <!--second row-->
                <div class="row-fluid col-md-4">
                
                 <div class="form-group">
                    <label for="coyname">Turnover:</label>
                    <input type="hidden" class="form-control" id="coyname" placeholder="Turnover" hidden="hidden">
                     <span><?php echo number_format(str_replace( ',', '',$turnover),2);?> </span>
                    </div>
                    
                    <div class="form-group">
                    <label for="cost">Direct Costs:</label>
                    <input type="hidden" class="form-control" id="cost" placeholder="Direct Costs" hidden="hidden">
                     <span><?php echo number_format(str_replace( ',', '',$cost),2);?></span>
                    </div>
                    <div class="form-group">
                    <label for="fa">Fixed Assets:</label>
                    <input type="hidden" class="form-control" id="fa" placeholder="fa" hidden="hidden">
                     <span><?php echo number_format(str_replace( ',', '',$fa),2);?></span>
                    </div>
                    <div class="form-group">
                    <label for="coyname">Assessable Profit:</label>
                    <input type="hidden" class="form-control" id="coyname" placeholder="Assessable Profit" hidden="hidden">
                     <span><?php echo number_format(str_replace( ',', '',$asspt),2);?></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="coyname">Total Profit:</label>
                    <input type="hidden" class="form-control" id="coyname" placeholder="Total Profit" hidden="hidden">
                     <span><?php echo number_format(str_replace( ',', '',$totalpt),2);?></span>
                    </div>
                    
                    
                     <div class="form-group">
                    <label for="cittxt">Company Income Tax:</label>
                    <input type="hidden" class="form-control" id="cittxt" placeholder="CIT value here" hidden="hidden">
                     <span><?php echo  number_format(str_replace( ',', '',$citamt),2);?> </span>
                    </div>
                    
                     <div class="form-group">
                    <label for="edttxt">Education Tax:</label>
                    <input type="hidden" class="form-control" id="edttxt" placeholder="EDT value here" hidden="hidden">
                     <span><?php echo number_format(str_replace( ',', '',$edtamt),2); ?> </span>
                    </div>
                     <div class="form-group">
                    <label for="edttxt">Capital Gains Tax:</label>
                    <input type="hidden" class="form-control" id="edttxt" placeholder="EDT value here" hidden="hidden">
                     <span><?php echo number_format(str_replace( ',', '',$cgt),2); ?> </span>
                    </div>
                     <div class="form-group">
                    <label for="edttxt">(NITDF) levy:</label>
                    <input type="hidden" class="form-control" id="edttxt" placeholder="EDT value here" hidden="hidden">
                     <span><?php echo number_format(str_replace( ',', '',$nitd),2); ?> </span>
                    </div>

                    <div class="form-group">
                    <label for="mintax">Minimum Tax?:</label>
                    <select name="mintax" id="mintax" disabled>
                        <option><?php echo $mintax ?></option>
                        
                                                
                         </select>
                       </div>
                       <div class="form-group">
                    <label for="mintax">Filed Nil?:</label>
                    <select name="niltax" id="niltax" disabled>
                        <option><?php echo $niltax ?></option>
                        
                                                
                         </select>
                       </div>
                       
                        
                       
                         <p></p>
                         
                         <div class="form-group">
                        <label for="remark">Remarks:</label>
                        <input type="hidden" name="remark" id="remark">
                         <span><?php echo $remark?></span>
                        
                        </div>
                        
                        
                </div>
                
                <div class="row-fluid col-md-4">
                 
                <p></p>
                
                
                
                </div>
            
                <form name="datacap" action="dosubmit " method="post">
                
               <input type="hidden" value="<?php echo $coytin ;?>" name="coytin">
               <input type="hidden" value="<?php echo $coyname;?>" name="coyname">
               <input type="hidden" value="<?php echo $phone;?>" name="phone">
               <input type="hidden" value="<?php echo $coyadd;?>" name="address">
               <input type="hidden" value="<?php echo $yearend;?>" name="yrendm">
               <input type="hidden" value="<?php echo $assyr;?>" name="yoa">
               <input type="hidden" value="<?php echo $datecap;?>" name="capture">
               <input type="hidden" value="<?php echo $duedate;?>" name="duedate">
               <input type="hidden" value="<?php echo $turnover;?>" name="tover">
               <input type="hidden" value="<?php echo $cost;?>" name="cost">
               <input type="hidden" value="<?php echo $fa;?>" name="fa">
               <input type="hidden" value="<?php echo $asspt;?>" name="asspt">
               <input type="hidden" value="<?php echo $totalpt;?>" name="tpt">
               <input type="hidden" value="<?php echo $citamt;?>" name="cit">
               <input type="hidden" value="<?php echo $edtamt;?>" name="edt">
               <input type="hidden" value="<?php echo $cgt;?>" name="cgt">
               <input type="hidden" value="<?php echo $nitd;?>" name="nitd">
               <input type="hidden" value="<?php echo $mintax;?>" name="mintax">
               <input type="hidden" value="<?php echo $niltax;?>" name="niltax">
               <input type="hidden" value="<?php echo $asstype;?>" name="asstype">
               <input type="hidden" value="<?php echo $alabel;?>" name="alabel">
               <input type="hidden" value="<?php echo $assno;?>" name="assno">
               <input type="hidden" value="<?php echo $ayear;?>" name="ayear">
               <input type="hidden" value="<?php echo $ayear;?>" name="edtass">
               <input type="hidden" value="<?php echo $remark;?>" name="remark">
               <input type="hidden" value="<?php echo $suser;?>" name="user">
               <input type="hidden" value="<?php echo $paytype;?>" name="paytype">
              <input type="hidden" name="usersno" value="<?php echo $usersno ?>">
               <input type="hidden" class="form-control" id="assmtno" name="citass" value="<?php echo $alabel.$assno."/".$ayear;?>">
                    <input type="hidden" class="form-control" id="assmtno2" name="edtass" value="<?php echo str_replace("CIT","EDT",$alabel).$assno."/".$ayear;?>">
                
                <?php
                        
    
                        if($citamt<$c||$edtamt<$e && $niltax=='No'){
                            
                         echo('<div class="row-fluid col-md-4"><div class="alert-danger" id="screen">Kindly verify the CIT amount and EDT amount With the Systems Computations:  <br/><h4>CIT due: &nbsp;&nbsp;'.$c.'</h4><h4>EDT due: &nbsp;&nbsp;'.$e.'</h4></div> <p></p>
                         
                         
                            <!--end of second row-->
                            
                       
                        
               
 
               <a href="capture " class="btn btn-info"> Go Back</a> <input type="submit" class="btn btn-danger" value="Ignore & Submit">
              </div>
                </form>
                         ') ;
                            
                        }else{
                            
                            
                            
                            echo('  <p></p>
                        
                
                
                
                <!--end of second row-->
           
            
               <div class="row-fluid col-md-4">
 
                <input type="submit" class="btn btn-primary" value="Submit Returns">
              </div>
            </form>
          
           ');
                            
                            
                        }
    
                    ?>
                    
                    
                    
                    
      
            <?php 
					if($yrendyoa<$assyr && $yearend!="July" && $yearend!="August" && $yearend!="September" && $yearend!="October" && $yearend!="November" && $yearend!="December"){
       
					}else{
           			$yrendyoa=$assyr;
       				}
					
                $checklrp=checkLRP($duedate,$datecap,$yrendyoa);
                $showmonths=checkLRP($duedate,$datecap,$yrendyoa);  
                $showLRPdue=number_format(amountLRP($checklrp,$conn),2);
                $assnolrp=getAssmtNumLRP($conn,$asstype,$datecap);
                                                    
            		if ($showmonths>0 && $comm=="no"){
                
                
                        if($asstype2=="lrpcurrent"){
								
                            $alabellrp=str_replace('TAX','LRP',getSettings('slabel',$conn));
                            
							
                        }else{

                            $alabellrp=str_replace('TAX','LRP',getSettings('slabelb',$conn));

                        }
                $alabellrp=str_replace('M',date('m'),$alabellrp);
              echo ('
            <div class="row-fluid col-md-4">
           <p></p>
           <div class="alert-danger" id="screen">Be informed that this Account is <b>'.$showmonths.' Month(s) Late </b>and is Liable to Pay Late Return Penalty<br/><h4>LRP due: &nbsp;N' .$showLRPdue.'<p><p/>LRP Asmt No:&nbsp;'.$alabellrp.$assnolrp.'/'.$ayear.'</h4>
            <form action="processlrp "  method="post" target="_blank">
                
               <input type="hidden" value="'.$coytin.'" name="coytin">
               <input type="hidden" value="'.$coyname.'" name="coyname">
               <input type="hidden" value="'.$coyadd.'" name="address">
               
               <input type="hidden" value="'.$assyr.'" name="yoa">
               <input type="hidden" value="'.$datecap.'" name="capture">
               <input type="hidden" value="'.$datecap.'" name="date2">
               <input type="hidden" value="'.$yearend.'" name="yrendm">
               
               
               
               <input type="hidden" value="'.$showLRPdue.'" name="amount">
              
               <input type="hidden" value="'.$alabellrp.'" name="alabel">
               <input type="hidden" value="'.$assnolrp.'" name="assno">
               <input type="hidden" value="'.$ayear.'" name="ayear">
               
               
               <input type="hidden" value="'.getDueMonth($duedate,$yrendyoa).'" name="duedate">
               
               
               <input type="hidden" value="'.$showmonths.'" name="default">
               <input type="hidden" value="'.$asstype2.'" name="tbn">
               <input type="hidden" value="'.$suser.'" name="user">
               <input type="hidden" value="'.$usersno.'" name="usersno">
 
            <button type="Submit" class="btn btn-danger" onclick="" >Raise Assessment</button>
            
           
        
           <p></p>
           
            </div>
           
            
            ');  
            }
       
       
       
       
            ?>
                </form>
       </div>     
                    </div>                 
       </div>  
   </div>
   <script src="js3/jquery-1.12.4.js"></script>
  
  
    
</body>
</html>