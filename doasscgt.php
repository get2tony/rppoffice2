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
$cgtratex=$_POST["cgtrate"];



$startdate = isset($_POST['startdate']) ? $_POST['startdate'] : null;
$enddate = isset($_POST['enddate']) ? $_POST['enddate'] : null;
$cgtpaid=number_format(str_replace( ',', '',mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', isset($_POST['cgtamtpaid']) ? $_POST['cgtamtpaid'] : 0.00)))),2);

$cgttnx=isset($_POST['cgttnx']) ? $_POST['cgttnx'] : 'no';
$cgtpen=isset($_POST['penintcgt']) ? $_POST['penintcgt'] : 'off';


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
       #fin{
        display:block;
        /* border:1px solid; */
        /* padding:5px; */
        /* width:100%; */
        /* background:red; */

        /* border-radius:5px; */


       }

	</style>

</head>
<body>
   <div class="container-fluid">
           <div id="verify">
          <form name="datacap" action="dosubmitasscgt" method="post" target="_blank">

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
                     <span><?php echo $taxtype;?> </span>
                    </div>

                    <?php

                 if($startdate!=="" && $enddate!=="" ){

                  echo('  <div class="form-group">
                    <label for="coyname">Period covered:</label>



                    <input type="text" class="" id="startdate1"  name="startdate1" placeholder="start date" size="7" value="'.$startdate.'"   >

                    <label for="enddate"> To:</label>
                    <input type="text" class="" id="enddate1"  name="enddate1" placeholder="End date" size="7"  value="'.$enddate.'">
                </div> ');

                 }
                    ?>

			  </div>
                    <div id="hura" class="row-fluid col-md-4">
                   <div class="form-group">

                        <input type="hidden" class="form-control" id="coy" placeholder="Assessable Profit" hidden="hidden">

                    </div>
                    <?php
				 $totpenint=(getSettings('penrate',$conn)+getSettings('intrate',$conn));
				//  $citrate= getSettings('citrate',$conn)/100;
				//  $edtrate= getSettings('edtrate',$conn)/100;
				 $cgtrate= $cgtratex/100;

				//  $citpaidamt=str_replace(',','',$citpaid);
				//  $edtpaidamt=str_replace(',','',$edtpaid);
				 $cgtpaidamt=str_replace(',','',$cgtpaid);
				 $amountray=str_replace(',','',$amount);

				//  $totprofit=($amountray+$citpaidamt)/$citrate;
				//  $citout=$totprofit*$citrate;
				//  $citdue=$citout-$citpaidamt;
				//  $discitpen=$citdue*($totpenint/100);

				//  $aspro=($amountray+$edtpaidamt)/$edtrate;
				//  $edtout=$aspro*$edtrate;
				//  $edtdue=$edtout-$edtpaidamt;
				//  $disedtpen=$edtdue*($totpenint/100);

				//  $distotalcit=$citdue+$discitpen;
				//  $distotaledt=$edtdue+$disedtpen;

//				 vat comes here
				//  $inputtax=str_replace(',','',$inputtax);
				//  $vatpaid=str_replace(',','',$vatpaid);
				//  $totalvat=$amountray-$inputtax-$vatpaid;

                 // cgt COMES HERE
                $totcgttnx=($amountray+$cgtpaidamt)/$cgtrate;
                $discgt=$totcgttnx*$cgtrate;
				 $cgtout=$totcgttnx*$cgtrate;
				 $cgtdue=$cgtout-$cgtpaidamt;
                 $discgtpen=$cgtdue*($totpenint/100);
                  $distotalcgt=$cgtdue+$discgtpen;
                 // cgt ENDS HERE

				 if ($taxtype=="CGT" ){
					echo '

					 <div class="form-group">
                    <label for="coyname">Transaction Amount:</label>
                    <input type="hidden" class="form-control" id="pen" placeholder="Interest & Penalty" hidden="hidden">
                <span> '.number_format($totcgttnx,2).'</span>
                    </div>

					<div class="form-group">
                    <label for="coyname">Capital Gains Tax @ '.(int)$cgtratex.'%: </label>
                    <input type="hidden" class="form-control" id="pen" placeholder="Interest & Penalty" hidden="hidden">
                <span> '.number_format($discgt,2).'</span>
                    </div>


                    <div class="form-group">
                    <label for="coyname">Less: Already Paid</label>
                    <input type="hidden" class="form-control" id="amt" placeholder="Total Amt" hidden="hidden">
                <span> '.number_format($cgtpaidamt,2).'</span>
                    </div>

                    <div class="form-group">
                    <label for="coyname">CGT Outstanding</label>
                    <input type="hidden" class="form-control" id="amt" placeholder="Total Amt" hidden="hidden">
                <span> '.number_format($cgtdue,2).'</span>
                    </div>';
						 }


				 if ($cgtpen=="on" ){
					echo '

					<div class="form-group">
                    <label for="coyname">Add: Interest &amp; Penalty @ '.$totpenint.'%:</label>
                    <input type="hidden" class="form-control" id="pen" placeholder="Interest & Penalty" hidden="hidden">
                <span> '.number_format($discgtpen,2).'</span>
                    </div>

                    <div class="form-group" id="fin">
                    <label for="coyname">Total CGT Amount Payable:</label>
                    <input type="hidden" class="form-control" id="amt" placeholder="Total Amt" hidden="hidden">
                <span> '.number_format($distotalcgt,2).'</span>
                    </div>';

				 }



				 ?>


                    <div class="form-group">
                    <label for="coyname">Basis of Assessment:</label>
                    <input type="hidden" class="form-control" id="coy" placeholder="basis" hidden="hidden">
                     <span><?php echo $basis; ?></span>
                    </div>









               <input type="hidden" value="<?php echo $coytin ;?>"  id="coytin" name="coytin">
               <input type="hidden" value="<?php echo urlencode($coyname);?>"  id="coyname" name="coyname">
               <input type="hidden" value="<?php echo urlencode($coyadd);?>"  id="address" name="address">
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


               <input type="hidden" value="<?php echo $cgtratex;?>"  id="cgtrate" name="cgtrate">
               <input type="hidden" value="<?php echo $cgtpaidamt;?>"  id="cgtpaid" name="cgtpaid">
               <input type="hidden" value="<?php echo $cgttnx;?>"  id="cgttnx" name="cgttnx">
               <input type="hidden" value="<?php echo $cgtpen;?>"  id="cgtpen" name="cgtpen">

               </div>
               <div id="" class="row-fluid col-md-4">
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>


                <?php



                    echo '<input  class="btn btn-primary" type="button"  value="Click to Generate" onclick="myFunction()" />';



                ?>





      </div>
               </form>
          <!-- <input type="button" class="btn btn-primary" onclick="myhome()" value="Testing!"> -->

       </div>

    </div>
   <script src="js3/jquery-1.12.4.js"></script>
   <script src="sweetalert2.all.min.js"> </script>
   <script src="Ajaxsubmit4.js"></script>

    <!-- <script>
function myhome() {
   Swal.fire({
  position: 'center',
  type: 'success',
  grow: 'true',
  title: 'Your work has been saved',
  showConfirmButton: true,
//   timer: 3000
})
}


</script> -->

</body>
</html>
