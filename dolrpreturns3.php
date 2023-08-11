<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');
// $coyname="";
// $coytin="";
// $coyadd="";
// $startdate="";
// $enddate="";
// $datecap="";
// $amount="";
// $yoa="";
// $yearend='';



$coytin=mysqli_real_escape_string($conn,$_POST["coytin"]);
$coyname=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["coyname"]))));
$coyadd=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["address"]))));
$datefile = isset($_POST['datefile']) ? $_POST['datefile'] : null;
$startdate = isset($_POST['startdate']) ? $_POST['startdate'] : null;
$enddate = isset($_POST['enddate']) ? $_POST['enddate'] : null;




$getyoa=explode('-',$enddate);
$assyr=$getyoa[2];
$yoa=$getyoa[2]+1;
$duem=$getyoa[1]+1;

if($getyoa[1]>11){

   $assyr=$yoa;


}

$duedate="21-".$duem."-".$assyr;
$taxtype="VAT";

$datecap=$_POST["capture"];

$getYrend=explode('-',$enddate);
$yearend=getFullmonth($getYrend[1]);
$suser=$_POST["user"];
$usersno=$_POST["usersno"];
$userstatus=checkUserstatus2($usersno,$conn);
//$duedate=getDuedatevat($yearend,$yoa);
$alabellrp="";
$page="raiselrpvat2";
$asstype="";
$asstype2="";
if($getyoa[2] < substr($datecap,-4)){
    $asstype="back_year";
    $asstype2="lrpback_year";


}else{
    $asstype="current";
    $asstype2="lrpcurrent";

}
$showmonths=checkNUMMonth($duedate,$datefile)+1;
$showLRPdue=number_format(str_replace( ',', '',mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', isset($_POST['amount']) ? $_POST['amount'] : 0.00)))),2);
$assnolrp=getAssmtNumLRPvat($conn,$asstype,$datecap);
$ayear=substr($yoa,-2);



if($asstype2=="lrpcurrent"){

//$alabellrp="LA/OI/VAT/LSP/";
$alabellrp=str_replace('TAX',$taxtype,getSettings('slabel',$conn))."LSP/";
}else{

//$alabellrp="LA/OIBA/VAT/LSP/";
$alabellrp=str_replace('TAX',$taxtype,getSettings('slabelb',$conn))."LSP/";
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
                    <label for="yearend">Period Covered:</label>

                     <span><?php echo $startdate;?></span>
                      <label for="yearend">To:</label> <?php echo $enddate;   ?> </span>
                   </div>

                   <p></p>

                   <div class="form-group">
                 <label for="datefile">Due date :</label>
                 <select name="duedate" id="duedate"  disabled>
                     <option><?php   echo $duedate;?></option>
                 </select>
                    </div>

                   <div class="form-group">
                 <label for="datefile">Date of Filed:</label>
                 <select name="datefile" id="datefile"  disabled>
                     <option><?php   echo $datefile;?></option>
                 </select>
                    </div>


                      <div class="form-group">
                    <label for="capture">Date Raised:</label>
                    <select name="capture" id="capture"  disabled>
                        <option><?php   echo $datecap;?></option>
                    </select>
                       </div>
                    <p></p>



                    </div>





                <!--second row-->
                <div class="row-fluid col-md-4">

                     <div class="form-group">
                    <label for="amount">Amount Due:</label>

                     <span><?php echo  $showLRPdue ;?> </span>
                    </div>

                    <?php

                    if ($showLRPdue>1){
                    echo( '
                     <div class="form-group">
                    <label for="months">No. of Month(s) Default:</label>
                    <select name="months" id="months"  disabled>
                        <option>'.$showmonths.' </option>


                         </select>

                         <form action="processvatlrp2 "  method="post" target="_blank">

               <input type="hidden" value="'.$coytin.'" name="coytin">
               <input type="hidden" value="'.$coyname.'" name="coyname">
               <input type="hidden" value="'.$coyadd.'" name="address">

               <input type="hidden" value="'.$yoa.'" name="yoa">
               <input type="hidden" value="'.$yearend.'" name="yrendm">
               <input type="hidden" value="'.$datecap.'" name="capture">
               <input type="hidden" value="'.$page.'" name="page">
               <input type="hidden" value="'.$startdate.'" name="start">
               <input type="hidden" value="'.$enddate.'" name="end">



               <input type="hidden" value="'.$showLRPdue.'" name="amount">

               <input type="hidden" value="'.$alabellrp.'" name="alabel">
               <input type="hidden" value="'.$assnolrp.'" name="assno">
               <input type="hidden" value="'.$ayear.'" name="ayear">
               <input type="hidden" value="'.$suser.'" name="user">
               <input type="hidden" value="'.$usersno.'" name="usersno">
               <input type="hidden" value="'.$taxtype.'" name="taxtype">


               <input type="hidden" value="'.$duedate.'" name="duedate">

                 <input type="hidden" value="'.$datefile.'" name="datefile">
               <input type="hidden" value="'.$showmonths.'" name="default">
               <input type="hidden" value="'.$asstype2.'" name="tbn">
                <input type="hidden" value="'.$userstatus.'" name="ustatus">


            <button type="Submit" class="btn btn-danger" onclick="" >Raise Assessment</button>



           <p></p>



                    </form>');

                          }else{
                        echo ('


                        <p></p>
                        <a class="btn btn-danger" href="raiselrpvat2?sno='.$usersno.'&user='.$suser.' ">Go Back</a>');
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
