<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');

$coytin=$_POST["coytin"];
$coyname=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["coyname"]))));
$coyadd=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["address"]))));
$assyr=$_POST["yoa"];
$datecap=$_POST["capture"];
$taxtype=$_POST["ttype"];
$suser=$_POST["user"];
$usersno=$_POST["usersno"];

$citrate1=$_POST["citrate"];
$edtrate1=$_POST["edtrate"];
$vatrate=$_POST["vatrate"];

$startdate = isset($_POST['startdate']) ? $_POST['startdate'] : null;
$enddate = isset($_POST['enddate']) ? $_POST['enddate'] : null;
$edtpaid=number_format(str_replace( ',', '',mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', $_POST["edtamtpaid"])))),2);
$citpaid=number_format(str_replace( ',', '',mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', $_POST["citamtpaid"])))),2);
$aprofit=isset($_POST['aprofit']) ? $_POST['aprofit'] : 'no';
$tprofit=isset($_POST['tprofit']) ? $_POST['tprofit'] : 'no';
$citpen=isset($_POST['penintcit']) ? $_POST['penintcit'] : 'off';
$edtpen=isset($_POST['penintedt']) ? $_POST['penintedt'] : 'off';



$basis=$_REQUEST["basis"];
$asno=rand(15,230);


$amount=number_format(str_replace( ',', '',mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', $_POST["amount"])))),2);

if($assyr < substr($datecap,-4)){

    $asstype="back_year";
}else{

   $asstype="current";
}

if($taxtype=="POL"){
    $asstype="levy";

}

if($asstype=="current"){

    $alabel="LA/UR/".$taxtype."/".$asno."/";
}

if($asstype=="back_year"){

    $alabel="LA/UR/".$taxtype."BA/".$asno."/";

}
if($asstype=="levy"){

    $alabel="LA/UR/".$taxtype."/".$asno."/";

}





$ayear=substr($assyr,-2);


   $noass='';
  if ($taxtype=="CIT"){
      $noass=$alabel.$ayear;
           } else{
               $noass=str_replace("CIT","EDT",$alabel).$ayear;
           };




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Assessment Details</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">



</head>
<body>
   <div class="container-fluid" id="unreg">
           <div id="verify">
          <form name="datacap" action="dosubmitass2 " method="post" target="_blank">

             <div class="row-fluid col-md-4">

                 <label for="">Assessment No:</label>
                 <div class="form-group">
                <input type="text" class="form-control" name="assmtno" value=" <?php echo $noass   ?>" disabled>
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
                    <label for="YOA">Year of Assessment:</label>
                    <input type="hidden" class="form-control" id="coyname" placeholder="Year of Assessment" value="" disabled>
                    <span><?php   echo $assyr;?> </span>
                    </div>

                      <div class="form-group">
                    <label for="capture">Date Raised:</label>
                    <select name="capture" id="capture"  disabled>
                        <option><?php   echo $datecap;?></option>

                    </select>
                       </div>


                 <div class="form-group">
                    <label for="coyname">Taxtype:</label>
                    <input type="hidden" class="form-control" id="coyname" placeholder="Turnover" hidden="hidden">
                     <span><?php echo $taxtype;?> </span>
                    </div>

                    <?php

                 if($startdate!=="" && $enddate!=="" ){

                  echo('  <div class="form-group">
                    <label for="coyname">Period covered:</label>



                    <input type="text" class="" id="startdate"  name="startdate" placeholder="start date" size="6" value="'.$startdate.'"   >

                    <label for="enddate"> To:</label>
                    <input type="text" class="" id="enddate"  name="enddate" placeholder="End date" size="6"  value="'.$enddate.'">
                </div> ');

                 }
                    ?>
                    <div class="form-group">
                    <label for="coyname">Amount:</label>
                    <input type="hidden" class="form-control" id="coyname" placeholder="Assessable Profit" hidden="hidden">
                <span><?php echo $amount;?></span><br>

                <label for="coyname">Rate:</label>
                    <input type="hidden" class="form-control" id="coy" placeholder="Assessable Profit" hidden="hidden">
                <span><?php if ($taxtype=="EDT") {
                            echo number_format($edtrate1,1);
                                }

                            if ($taxtype=="CIT") {
                            echo round($citrate1);
                                }

                                if ($taxtype=="VAT") {
                            echo number_format($vatrate,1);
                                }
                                ;?>%  </span>
                    </div>
                    <?php

				$totpenint=(getSettings('penrate',$conn)+getSettings('intrate',$conn));
				 $citrate= $citrate1/100;
				 $edtrate= $edtrate1/100;

				 $citpaidamt=str_replace(',','',$citpaid);
				 $edtpaidamt=str_replace(',','',$edtpaid);
				 $amountray=str_replace(',','',$amount);

				 $totprofit=($amountray+$citpaidamt)/$citrate;
				 $citout=$totprofit*$citrate;
				 $citdue=$citout-$citpaidamt;
				 $discitpen=$citdue*($totpenint/100);

				 $aspro=($amountray+$edtpaidamt)/$edtrate;
				 $edtout=$aspro*$edtrate;
				 $edtdue=$edtout-$edtpaidamt;
				 $disedtpen=$edtdue*($totpenint/100);

				 $distotalcit=$citdue+$discitpen;
				 $distotaledt=$edtdue+$disedtpen;


				 if ($citpen=="on" ){
					echo '<div class="form-group">
                    <label for="coyname">Add: Interest &amp; Penalty @ 29%:</label>
                    <input type="hidden" class="form-control" id="pen" placeholder="Interest & Penalty" hidden="hidden">
                <span> '.number_format($discitpen,2).'</span>
                    </div>

                    <div class="form-group">
                    <label for="coyname">Total Amount Payable:</label>
                    <input type="hidden" class="form-control" id="amt" placeholder="Total Amt" hidden="hidden">
                <span> '.number_format($distotalcit,2).'</span>
                    </div>';

				 }
				  if ($edtpen=="on" ){
					echo '<div class="form-group">
                    <label for="coyname">Add: Interest &amp; Penalty @ 29%:</label>
                    <input type="hidden" class="form-control" id="pen" placeholder="Interest & Penalty" hidden="hidden">
                <span> '.number_format($disedtpen,2).'</span>
                    </div>

                    <div class="form-group">
                    <label for="coyname">Total Amount Payable:</label>
                    <input type="hidden" class="form-control" id="amt" placeholder="Total Amt" hidden="hidden">
                <span> '.number_format($distotaledt,2).'</span>
                    </div>';

				 }


				 ?>


                    <div class="form-group">
                    <label for="coyname">Basis of Assessment:</label>
                    <input type="hidden" class="form-control" id="coyname" placeholder="basis" hidden="hidden">
                     <span><?php echo $basis; ?></span>
                    </div>



                     </div>

                <div class="row-fluid col-md-4">
                 <br/>







                </div>



               <input type="hidden" value="<?php echo $coytin ;?>" name="coytin">
               <input type="hidden" value="<?php echo $coyname;?>" name="coyname">
               <input type="hidden" value="<?php echo $coyadd;?>" name="address">
               <input type="hidden" value="<?php echo $assyr;?>" name="yoa">
               <input type="hidden" value="<?php echo $datecap;?>" name="capture">

               <input type="hidden" value="<?php echo $taxtype;?>" name="ttype">
               <input type="hidden" value="<?php echo $amount;?>" name="amount">
               <input type="hidden" value="<?php echo $startdate;?>" name="startdate">
               <input type="hidden" value="<?php echo $enddate;?>" name="enddate">

               <input type="hidden" value="<?php echo $basis;?>" name="basis">
               <input type="hidden" value="<?php echo $suser;?>" name="user">
               <input type="hidden" value="<?php echo $usersno;?>" name="usersno">
               <input type="hidden" value="<?php echo $noass;?>" name="assmn">

               <input type="hidden" value="<?php echo $edtpaid;?>" name="edtpaid">
               <input type="hidden" value="<?php echo $citpaid;?>" name="citpaid">
               <input type="hidden" value="<?php echo $aprofit;?>" name="aprofit">
               <input type="hidden" value="<?php echo $tprofit;?>" name="tprofit">
               <input type="hidden" value="<?php echo $citpen;?>" name="citpen">
               <input type="hidden" value="<?php echo $edtpen;?>" name="edtpen">

               <input type="hidden" value="<?php echo $citrate1;?>" name="citrate">
               <input type="hidden" value="<?php echo $edtrate1;?>" name="edtrate">
               <input type="hidden" value="<?php echo $vatrate;?>" name="vatrate">

               <input  class="btn btn-primary" type="submit"  onclick="" value="Generate" />


               </form>


       </div>

    </div>
   <script src="js3/jquery-1.12.4.js"></script>

  <script>
	 function myhome() {


}</script>

</body>
</html>
