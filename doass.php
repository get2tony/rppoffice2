<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

$coytin=$_POST["coytin"];
$coyname=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["coyname"]))));
$coyadd=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["address"]))));
$assyr=$_POST["yoa"];
$datecap=$_POST["capture"];
$taxtype=$_POST["ttype"];
$suser=$_POST["user"];
$usersno=$_POST["usersno"];

$inputtax=isset($_POST['inpamt']) ? $_POST['inpamt'] : null;
$vatpaid=isset($_POST['amtpaid']) ? $_POST['amtpaid'] : null;
$citrate1=isset($_POST['citrate']) ? $_POST['citrate'] : getSettings('citrate',$conn);
$edtrate1=isset($_POST['edtrate']) ? $_POST['edtrate'] : getSettings('edtrate',$conn);
$vatrate=isset($_POST['vatrate']) ? $_POST['vatrate'] : getSettings('vatrate',$conn);
$vatpen=isset($_POST['penintvat']) ? $_POST['penintvat'] : 'off';
$vatexmpt=isset($_POST['exmpt']) ? $_POST['exmpt'] : 0;

$startdate = isset($_POST['startdate']) ? $_POST['startdate'] : null;
$enddate = isset($_POST['enddate']) ? $_POST['enddate'] : null;
$edtpaid=number_format(str_replace( ',', '',mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', isset($_POST['edtamtpaid']) ? $_POST['edtamtpaid'] : 0.00)))),2);
$citpaid=number_format(str_replace( ',', '',mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', isset($_POST['citamtpaid']) ? $_POST['citamtpaid'] : 0.00)))),2);


$aprofit=isset($_POST['aprofit']) ? $_POST['aprofit'] : 'no';
$tprofit=isset($_POST['tprofit']) ? $_POST['tprofit'] : 'no';
$citpen=isset($_POST['penintcit']) ? $_POST['penintcit'] : 'off';
$edtpen=isset($_POST['penintedt']) ? $_POST['penintedt'] : 'off';

$userstatus=checkUserstatus2($usersno,$conn);

$basis=$_REQUEST["basis"];
$asno=getADAssmtNum($conn,"adminasreg",$taxtype,$datecap);


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

//    $alabel="LA/OI/".$taxtype."/ADD/".$asno."/";
    $alabel=str_replace('TAX',$taxtype,getSettings('alabel',$conn)).$asno."/";

}

if($asstype=="back_year"){

//    $alabel="LA/OI/".$taxtype."BA/ADD/".$asno."/";
    $alabel=str_replace('TAX',$taxtype,getSettings('alabelb',$conn)).$asno."/";

}
if($asstype=="levy"){

    $alabel=str_replace('TAX',$taxtype,getSettings('slabel',$conn)).$asno."/";

}

if($basis=='Audit'){

	$alabel=str_replace("ADD","AUD",$alabel);

}


$alabel=str_replace('M',date('m'),$alabel);
$ayear=substr($assyr,-2);


if ($taxtype=="CIT"){
           $noass= $alabel.$ayear;
           } else{
                $noass= str_replace("CIT","EDT",$alabel).$ayear;
           };



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Assessment Details</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
    <link rel="stylesheet" href="sweetalert2.min.css">

   <style>
	   #hura{
		   top: 70px;
	   }

	</style>

</head>
<body>
   <div class="container-fluid">
           <div id="verify">
          <form name="datacap" action="dosubmitass " method="post" target="_blank">

             <div class="row-fluid col-md-4">

                 <label for="">Assessment No:</label>
                 <div class="form-group">
                <input type="text" class="form-control" name="assmtno" value="<?php echo $noass  ?> " >
                </div>

                <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="hidden" class="form-control" id="coy2" value="" >
                    <span><?php echo $coytin   ?> </span>
                </div>
                <div class="form-group">
                    <label for="coyname">Company Name:</label>
                    <input type="hidden" class="form-control" id="coy" value="" hidden="hidden">
                     <span><?php echo stripslashes($coyname)   ?> </span>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                   <input type="hidden" class="form-control" id="add" value="" >
                     <span><?php echo $coyadd   ?> </span>
                </div>

                 <div class="form-group">
                    <label for="YOA">Year of Assessment:</label>
                    <input type="hidden" class="form-control" id="coy" placeholder="Year of Assessment" value="" disabled>
                    <span><?php   echo $assyr;?> </span>
                    </div>

                      <div class="form-group">
                    <label for="capture">Date Raised:</label>
                    <select name="capt" id="capt"  disabled>
                        <option><?php   echo $datecap;?></option>

                    </select>
                       </div>


                 <div class="form-group">
                    <label for="coyname">Taxtype:</label>
                    <input type="hidden" class="form-control" id="coy" placeholder="Turnover" hidden="hidden">
                     <span><?php

                     if($taxtype=="TP"){
                        echo "Transfer Pricing";
                     }else {
                        echo $taxtype;
                     }
                     ;?> </span>
                    </div>

                    <?php

                 if($startdate!=="" && $enddate!=="" ){

                  echo('  <div class="form-group">
                    <label for="coyname">Period covered:</label>



                    <input type="text" class="" id="startdate1"  name="startdate1" placeholder="start date" size="6" value="'.$startdate.'"   >

                    <label for="enddate"> To:</label>
                    <input type="text" class="" id="enddate1"  name="enddate1" placeholder="End date" size="6"  value="'.$enddate.'">
                </div> ');

                 }
                    ?>

		            <div class="form-group">
                            <label for="coyname">Amount:</label>
                            <input type="hidden" class="form-control" id="coy" placeholder="Assessable Profit" hidden="hidden">
                        <span><?php echo $amount;?></span><br>
                    </div>
                    <div class="form-group">
                        <label for="coyname">Rate:</label>
                            <input type="hidden" class="form-control" id="coy" placeholder="Assessable Profit" hidden="hidden">
                        <span><?php if ($taxtype=="EDT") {
                                    echo  (float)($edtrate1);
                                        }

                                    if ($taxtype=="CIT") {
                                    echo  (float)($citrate1);
                                        }

                                        if ($taxtype=="VAT") {
                                    echo  (float)($vatrate);
                                        }
                                        if ($taxtype=="POL" || $taxtype == "TP" ) {
                                    echo 'Not Applicable';
                                        }
                                        ;?>% </span> </div>
                   </div><div id="hura" class="row-fluid col-md-6">
                    <?php
				 $totpenint=(getSettings('penrate',$conn)+getSettings('intrate',$conn));
				 $citrate= (float)($citrate1)/100;
				 $edtrate= (float)($edtrate1)/100;

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

//				 vat comes here
				 $inputtax=str_replace(',','',$inputtax);
				 $vatpaid=str_replace(',','',$vatpaid);
				 $totalvat=(float)($amountray)-(float)($inputtax)-(float)($vatpaid);
                 $vatsales=(($amountray)/($vatrate/100))+ (str_replace(',','',$vatexmpt));



				 if ($taxtype=="VAT" ){
					echo '

                    <h4><b>Sales / Income</b></h4>
                    <div class="form-group">
                    <label for="coyname">Total Sales / Supplies:</label>
                    <input type="hidden" class="form-control" id="pen" placeholder="Interest & Penalty" hidden="hidden">
                <span> '.number_format($vatsales,2).'</span>
                    </div>
                    <div class="form-group">
                    <label for="coyname">Exempted / Zero-Rated:</label>
                    <input type="hidden" class="form-control" id="pen" placeholder="Interest & Penalty" hidden="hidden">
                <span> '.$vatexmpt.'</span>
                    </div>
                    <h4><b>Deductions</b></h4>
					 <div class="form-group">
                    <label for="coyname">Less: Input VAT Claim:</label>
                    <input type="hidden" class="form-control" id="pen" placeholder="Interest & Penalty" hidden="hidden">
                <span> '.number_format($inputtax,2).'</span>
                    </div>

					<div class="form-group">
                    <label for="coyname">Less:  VAT Already Paid:</label>
                    <input type="hidden" class="form-control" id="pen" placeholder="Interest & Penalty" hidden="hidden">
                <span> '.number_format($vatpaid,2).'</span>
                    </div>

                    <h4><b>Tax Due</b></h4>
                    <div class="form-group">
                    <label for="coyname">VAT Outstanding:</label>
                    <input type="hidden" class="form-control" id="amt" placeholder="Total Amt" hidden="hidden">
                <span> '.number_format($totalvat,2).'</span>
                    </div>';
						 }
				 if ($vatpen=='on'){

					 $vatint=$totalvat*($totpenint/100);
				 	 $totalvat=$totalvat+$vatint;

					echo ' <div class="form-group">
                    <label for="coyname">Add: Interest &amp; Penalty @ '.$totpenint.'%:</label>
                    <input type="hidden" class="form-control" id="pen" placeholder="Interest & Penalty" hidden="hidden">
                <span> '.number_format($vatint,2).'</span>
                    </div>


                    <div class="form-group">
                    <label for="coyname">Total Amount Payable:</label>
                    <input type="hidden" class="form-control" id="amt" placeholder="Total Amt" hidden="hidden">
                <span> '.number_format($totalvat,2).'</span>
                    </div>';
				 }


				 if ($citpen=="on" ){
					echo '

					<div class="form-group">
                    <label for="coyname">Add: Interest &amp; Penalty @ '.$totpenint.'%:</label>
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
                    <label for="coyname">Add: Interest &amp; Penalty @ '.$totpenint.'%:</label>
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
                    <input type="hidden" class="form-control" id="coy" placeholder="basis" hidden="hidden">
                     <span><?php echo $basis; ?></span>
                    </div>









               <input type="hidden" value="<?php echo $coytin ;?>"  id="coytin" name="coytin">
               <input type="hidden" value="<?php echo urlencode($coyname) ;?>"  id="coyname" name="coyname">
               <input type="hidden" value="<?php echo urlencode($coyadd); ?>"  id="address" name="address">
               <input type="hidden" value="<?php echo $assyr;?>"  id="yoa" name="yoa">
               <input type="hidden" value="<?php echo $datecap;?>"  id="capture" name="capture">

               <input type="hidden" value="<?php echo $taxtype;?>"  id="ttype" name="ttype">
               <input type="hidden" value="<?php echo $amount;?>"  id="amount" name="amount">
               <input type="hidden" value="<?php echo $startdate;?>"  id="startdate" name="startdate">
               <input type="hidden" value="<?php echo $enddate;?>"  id="enddate" name="enddate">

               <input type="hidden" value="<?php echo $basis;?>"  id="basis" name="basis">
               <input type="hidden" value="<?php echo $suser;?>"  id="user" name="user">
               <input type="hidden" value="<?php echo $usersno;?>"  id="usersno" name="usersno">
               <input type="hidden" value="<?php echo $noass;?>"  id="assmn" name="assmn">

               <input type="hidden" value="<?php echo $edtpaid;?>" id="edtpaid"  name="edtpaid">
               <input type="hidden" value="<?php echo $citpaid;?>"  id="citpaid" name="citpaid">
               <input type="hidden" value="<?php echo $aprofit;?>"  id="aprofit" name="aprofit">
               <input type="hidden" value="<?php echo $tprofit;?>"  id="tprofit" name="tprofit">
               <input type="hidden" value="<?php echo $citpen;?>"  id="citpen" name="citpen">
               <input type="hidden" value="<?php echo $citrate1;?>"  id="citrate" name="citrate">
               <input type="hidden" value="<?php echo $edtpen;?>"  id="edtpen" name="edtpen">
               <input type="hidden" value="<?php echo $edtrate1;?>"  id="edtrate" name="edtrate">


               <input type="hidden" value="<?php echo $vatpen;?>"  id="vatpen" name="vatpen">
               <input type="hidden" value="<?php echo $vatrate;?>"  id="vatrate" name="vatrate">
               <input type="hidden" value="<?php echo $inputtax;?>"  id="inputtax" name="inputtax">
               <input type="hidden" value="<?php echo $vatpaid;?>"  id="vatpaid" name="vatpaid">
               <input type="hidden" value="<?php echo $vatexmpt;?>"  id="vatexmpt" name="vatexmpt">
               <input type="hidden" value="<?php echo $vatsales;?>"  id="vatsales" name="vatsales">



                <?php
                 $polcheck=getSetting('polapp',$conn);
                 if ( $userstatus=="controller" ) {

                     echo '<input  class="btn btn-primary" type="submit"  onclick="" value="Click to Generate" />';
                 }else if($taxtype=="POL" && $polcheck=='no' ){
                    echo '<input  class="btn btn-primary" type="submit"  onclick="" value="Click to Generate" />';
                 }else {

                    echo '<input  class="btn btn-primary" type="button"  value="Click to Generate" onclick="myFunction()" />';
                 }



                ?>




                </div>

               </form>
          <!-- <input type="button" class="btn btn-primary" onclick="myhome()" value="Testing!"> -->

       </div>

    </div>
   <script src="js3/jquery-1.12.4.js"></script>
   <script src="sweetalert2.all.min.js"> </script>
   <script src="Ajaxsubmit.js"></script>
</body>
</html>
