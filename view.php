<?php 


include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
$search=$_GET['tin'];
$table=$_GET['tab'];
$serial=$_GET['sno'];
$suser=$_GET['user'];


$sql = "SELECT * FROM $table where `sno`='$serial'&&`tinno`='$search'";
        
$query = mysqli_query($conn, $sql);

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
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
$capby="";

while ($row = mysqli_fetch_array($query))
        {
$coytin=$row[1];
$coyname=$row[2];
$coyadd=$row[3];
$yearend=$row[4];
$assyr=$row[6];
$datecap=$row[8];
$duedate=$row[5];
$turnover=number_format($row[9],2);
$asspt=number_format($row[11],2);
$totalpt=number_format($row[10],2);
$citamt=number_format($row[12],2);
$edtamt=number_format($row[13],2);
$mintax=$row[17];
$niltax=$row[18];
$asstype=$row[7];
$remark=$row[19];
$alabel=$row[14];
$assno=$row[15];
$ayear=$row[16];
$capby=$row[22];
    
}
  
    
    
    
    

echo'




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
          
            <div id="verify">
             <div class="row-fluid col-md-4">
                 <div class="alert-success" id="screen"><h4><label for="">Assessment No:</label></h4><h4>  '.  $alabel.$assno.'/'.$ayear .'</h4><h4>
                 '. str_replace("CIT","EDT",$alabel).$assno.'/'.$ayear .'</h4></div>
             
               
                <div class="form-group">
                   
                    <input type="hidden" class="form-control" id="assmtno" value="'.$alabel.$assno."/".$ayear .'">
                    <input type="hidden" class="form-control" id="assmtno2" value="'. str_replace("CIT","EDT",$alabel).$assno."/".$ayear .'">
                    
                </div>
               
                <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="hidden" class="form-control" id="coytin" value="" >
                    <span>'. $coytin.' </span>
                </div>
                <div class="form-group">
                    <label for="coyname">Company Name:</label>
                    <input type="hidden" class="form-control" id="coyname" value="" hidden="hidden">
                     <span>'. $coyname  .'</span>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                   <input type="hidden" class="form-control" id="address" value="" >
                     <span>'. $coyadd.' </span>
                </div>
                <div class="form-group">
                    <label for="yearend">Year End:</label>
                    
                     <span>'. $yearend .' </span>
                   </div>
                   <div class="form-group">
                    <label for="duedate">Due date:</label>
                    
                     <span>'. $duedate.' '.$assyr .' </span>
                   </div>
                   <p></p>
                    
                    <div class="form-group">
                    <label for="YOA">Year of Assessment:</label>
                    <input type="hidden" class="form-control" id="coyname" placeholder="Year of Assessment" value="" disabled>
                    <span>'.    $assyr.' </span>
                    </div>
                    
                      <div class="form-group">
                    <label for="capture">Date of Capture:</label>
                    <select name="capture" id="capture"  disabled>
                        <option>'. $datecap.'</option>
                                                
                    </select>
                       </div>
                       ';
    
                if ($capby=="" || $capby==null){
        
        
                    echo ('<div class="form-group">
                    <label for="capture"> Captured by:</label>
                    <select name="capture" id="capture"  disabled>
                        <option> Not Avaible</option>');
    }else{
        
         echo ('<div class="form-group">
                    <label for="capture"> Captured by:</label>
                    <select name="capture" id="capture"  disabled>
                        <option>'. $capby.'</option>');
    }
    
    
    
    echo '
                        
                                                
                    </select>
                       </div>
                    <p></p>
                    
                   
                
                    </div>


               
        
               
                <!--second row-->
                <div class="row-fluid col-md-4">
                
                 <div class="form-group">
                    <label for="coyname">Turnover:</label>
                    <input type="hidden" class="form-control" id="coyname" placeholder="Turnover" hidden="hidden">
                     <span>'.  $turnover.' </span>
                    </div>
                    
                    <div class="form-group">
                    <label for="coyname">Assessable Profit:</label>
                    <input type="hidden" class="form-control" id="coyname" placeholder="Assessable Profit" hidden="hidden">
                     <span>'. $asspt.'</span>
                    </div>
                    
                    <div class="form-group">
                    <label for="coyname">Total Profit:</label>
                    <input type="hidden" class="form-control" id="coyname" placeholder="Total Profit" hidden="hidden">
                     <span>'. $totalpt.'</span>
                    </div>
                    
                    
                     <div class="form-group">
                    <label for="cittxt">Company Income Tax:</label>
                    <input type="hidden" class="form-control" id="cittxt" placeholder="CIT value here" hidden="hidden">
                     <span>'.  $citamt.' </span>
                    </div>
                    
                     <div class="form-group">
                    <label for="edttxt">Education Tax:</label>
                    <input type="hidden" class="form-control" id="edttxt" placeholder="EDT value here" hidden="hidden">
                     <span>'. $edtamt.' </span>
                    </div>

                    <div class="form-group">
                    <label for="mintax">Minimum Tax?:</label>
                    <select name="mintax" id="mintax" disabled>
                        <option>'. $mintax.'</option>
                        
                                                
                         </select>
                       </div>
                       <div class="form-group">
                    <label for="mintax">Filed Nil?:</label>
                    <select name="niltax" id="niltax" disabled>
                        <option>'. $niltax.'</option>
                        
                                                
                         </select>
                       </div>
                        
                        <div class="form-group">
                    <label for="asstype">Assessment Type:</label>
                    <select name="asstype" id="asstype"  disabled>
                        <option>'.  ucwords($asstype) .'</option>
                        
                                                
                         </select>
                       </div>
                         <p></p>
                         
                         <div class="form-group">
                        <label for="remark">Remarks:</label>
                        <input type="hidden" name="remark" id="remark">
                         <span>'. $remark.'</span>
                        
                        </div>
                         <div class="row-fluid col-md-4">
                     <p></p>
                     <p></p>
                  </div>    
    
                </div>
                
                 </div>
                
                </div>
                <a target="dframe" href="tablepage?user='.$suser.'&tab='.$table.'" class="btn btn-primary"> Go Back</a>
                
                 
                <input type="button" class="btn btn-success" onClick="window.print();" value= "Print" />
                 
                        
               
           
            
                            
           
   </div>
    
   <script src="js3/jquery-1.12.4.js">
   </script>
   
   
  
  
    
</body>
</html>
       
    ';

 

?> 