
<?php
include("dbconfig/config.php ");
include("dbconfig/methods.php ");
include_once('vatmethods.php');


require_once 'dompdf/lib/html5lib/Parser.php';
  require_once 'dompdf/php-font-lib/src/FontLib/Autoloader.php';
  require_once 'dompdf/php-svg-lib/src/autoload.php';
  require_once 'dompdf/src/Autoloader.php';
  Dompdf\Autoloader::register();
  use Dompdf\Dompdf;


$serial= isset($_REQUEST['data20']) ? $_REQUEST['data20'] : null;
$officename=getSettings('oname',$conn);
$offadd=getSettings('address',$conn);
$tcname=getSettings('tcname',$conn);

$penalty=getSettings2($serial,'penrate',$conn)/100;
$interest=getSettings2($serial,'intrate',$conn)/100;
$pensum=0;
$intsum=0;
$amt=0;




$coytin=$_REQUEST['data1'];
$coyname=stripslashes($_REQUEST['data2']);
$address=stripslashes($_REQUEST['data3']);
$yoa=$_REQUEST['data4'];
$capture=$_REQUEST['data5'];
$amount= str_replace(',','',$_REQUEST['data6']);
$basis=$_REQUEST['data7'];
$taxtype=$_REQUEST['data8'];
$asmtno=isset($_REQUEST['data9']) ? $_REQUEST['data9'] : null;
$startdate=isset($_REQUEST['data10']) ? $_REQUEST['data10'] : '01-01-'.$yoa;
$enddate=isset($_REQUEST['data11']) ? $_REQUEST['data11'] : '31-12-'.$yoa;
$amtpaid=str_replace(',','',isset($_REQUEST['data12']) ? $_REQUEST['data12'] : 0);
$amtpaid=ifempty($amtpaid);
$pen=isset($_REQUEST['data15']) ? $_REQUEST['data15'] : 'off';
if($pen==null){
	$pen='off';
}
$suser=isset($_REQUEST['data16']) ? $_REQUEST['data16'] : null;
$appby=isset($_REQUEST['data17']) ? $_REQUEST['data17'] : null;
$datax=isset($_REQUEST['data24']) ? $_REQUEST['data24'] : "";
$inputtax=isset($_REQUEST['data18']) ? $_REQUEST['data18'] : 0;
$amtraised=str_replace(',','',isset($_REQUEST['data19']) ? $_REQUEST['data19'] : 0);
$vatrate= isset($_REQUEST['data23']) ? $_REQUEST['data23'] : getSettings('vatrate',$conn);


$rate=round(getSettings2($serial,'vatrate',$conn),1).'%';
$totalSales=getSettings2($serial,'assprofit',$conn) ? getSettings2($serial,'assprofit',$conn): 0;
$exmptSales=getSettings2($serial,'tprofit',$conn) ? getSettings2($serial,'tprofit',$conn): 0 ;
$vatsales="";
$firstadd=substr($address,0,35);
$secondadd=substr($address,35,35);
$thirdadd=substr($address,70,34);

$firstoff=substr($offadd,0,38) ;
$secondoff=substr($offadd,38,36) ;
$disoffname=substr($officename,0,46);
$salesvisible='visible';

if ($amtraised==0 && $pen=='off'){

	$amtraised=$amount;
}

if ($amtraised==0 && $pen=='on'){

	$amtraised=$amount;
}



if ($pen=='on'){

	$amt=$amtraised-$inputtax-$amtpaid;
	$pensum=$amt*$penalty;
	$intsum=$amt*$interest;


}


if (strpos($basis, 'late') !== false ) {
	$vatsales="";
}elseif (strpos($asmtno, 'UR') !== false) {
	$rate=$vatrate.'%';
	$vatsales=number_format(($amtraised)/($vatrate/100),2);# code...
	//code...
}else {
	$vatsales=number_format(($amtraised)/($rate/100),2);
	// $vatsales=number_format(($amtraised)/($rate/100),2);
}
$vatsales2=$vatsales;
// $amtraised2=$amtraised;

if ($totalSales===$exmptSales) {
	$totalSales=str_replace(",","",$vatsales);
	$exmptSales=0;
	$noexmpt=true;
}else{


}

$vatsales=$totalSales;
$vatexmpt=$exmptSales;






$m="@ ";




$noperiod=checkNUMMonth2($startdate,$enddate);

$displayinfo='<div align="center" style="font-family:verdana">This  Assessment was raised by '.ucfirst($suser).' on the '.$capture.'</div>';

$document = new Dompdf();
//$document->setBasePath($webRoot);
$document->set_option( 'dpi' , '126' );

// if($datax=="no"){
//  $amtpaid=0;
//  $vatexmpt=0;
//  $vatsales=0;
//  $vatsales2=0;
// }

if ($datax == 'no'){
	$salesvisible='hidden';
}else{
	$salesvisible='visible';
}

//  /////////////////////////////////////////////

if ($inputtax>0){
			$invisible="visible";
		}else{
			$invisible="hidden";
		}
if ($amtpaid>0){
			$amtvisible='visible';
		}else{
			$amtvisible='hidden';
		}
if ($vatexmpt>0){
			$exmptvisible='visible';
		}else{
			$exmptvisible='hidden';
		}

if ($pen=="on"){
			$penvisible='visible';
		}else{
			$penvisible='hidden';
		}

if (strpos($asmtno, 'UR') !== false && $basis == 'LRP') {
        	$showrate='hidden';
        }else{
          $showrate='visible';
    }

$showperiod=$noperiod+1;
$swamtraised=number_format($amtraised,2);
if($inputtax==0){
	$inputshw=0;

}else{
	$inputshw=number_format($inputtax,2);
}

	$amtinshw=number_format($amtraised-$inputtax,2);
	$penshow=number_format($pensum,2);
	$intshow=number_format($intsum,2);

if($pen=="on"){
	$sum=($amtraised-$inputtax-$amtpaid)+$pensum+$intsum;
	$totsum= number_format($sum,2)	;
	}else{

		$sum=($amtraised-$inputtax-$amtpaid);
	$totsum= number_format($sum,2);
	}

//  	///////////////////////////////////////  ///////////////////////
if (strpos($asmtno,"UR")){
				 $displayinfo=$displayinfo;
				 $showperiod=$showperiod;
				//  $rate="";
				//  $m="";
			}else{
		 		$displayinfo='';
	 			}

//
////////  /////////////////////////////////////////////

$html = '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>VAT Assessment | Print</title>
<!--<link href="css3config.phpAReport.css" rel="stylesheet" type="text/css">-->
 <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
<style type="text/css">
    body, div{

		margin: 0px;
    }

	b{
	font-family:Tahoma, Geneva, sans-serif;
	font-size:16px;
	color:#F00;

	}
	#showtot{
		font-family:Tahoma, Geneva, sans-serif;
		color:#F00;
		font-size:17px;
		font-weight: bold;

	}



	#bgpic{
		z-index: -1;
		clear: both;
		height: 1232px;
		width: 1000px;
	 	position:absolute;
		margin: 0px;
	}

	#host1{

		height: 1232px;
		width: 1000px;
		position: absolute;

	}

    .dig1{

		top: 35px;
		position: absolute;
		left: 780px;

	}
    .dig2{
		top: 59px;
		position: absolute;
		left: 760px;


	}
    .dig3{

		top: 87px;
		position: absolute;
		left: 837px;


	}
    .dig4{

		top: 131px;
		position: absolute;
		left: 770px;

	}
    .digb{

	top: 213px;
	position: absolute;
	left: 300px;

	}
    .dig5{

	top: 253px;
	position: absolute;
	left: 100px;

	}
    .dig6{

	top: 281px;
	position: absolute;
	left: 122px;

	}
     .dig7{

	top: 308px;
	position: absolute;
	left: 57px;

	}
	.dig7a{

	top: 330px;
	position: absolute;
	left: 57px;

	}
    .dig8{
		top: 259px;
		position: absolute;
		left: 570px;

	}
    .dig9{

		top: 289px;
		position: absolute;
		left: 570px;

	}
     .dig9b{

		 top: 319px;
		position: absolute;
		left: 570px;

		}
    .dig10{

		top: 387px;
		position: absolute;
		left: 78px;

		}
    .dig11{
		top: 390px;
		position: absolute;
		left: 242px;

		}
    .dig12{

		top: 390px;
		position: absolute;
		left: 500px;

		}
    .diggg{

		top: 443px;
		position: absolute;
		right: 380px;
		visibility: $salesvisible;

		}
    .diggg2{

		top: 473px;
		position: absolute;
		right: 370px;
		visibility: $exmptvisible;

		}

    .digm{

		top: 501px;
		position: absolute;
		right: 380px;
		visibility: $salesvisible;
		}
    .digmy{

		top: 531px;
		position: absolute;
		right: 380px;

		}
    .di2{

		top: 531px;
		position: absolute;
		right: 603px;
    visibility: $showrate;
		}

	.dig13{

		top: 603px;
		position: absolute;
		right: 160px;


		}
	.dig13b{

		top: 782px;
		position: absolute;
		right: 150px;

		visibility: $invisible;

				}
    .dig14{

		top: 810px;
		position: absolute;
		right: 160px;

		}
     .dig14b{

		 top: 839px;
		position: absolute;
		right: 151px;
		 visibility: $amtvisible;

		}
    .dig14c{

		 top: 868px;
		position: absolute;
		right: 160px;
		visibility: $penvisible;


			}
    .dig15{

		top: 897px;
		position: absolute;
		right: 160px;

		visibility: $penvisible;


			}
    .dig15b{

		top: 927px;
		position: absolute;
		right: 160px;
			}
     .dig16{
		top: 955px;
		position: absolute;
		right: 160px;
			}
	.dib19{
		top: 1055px;
		position: absolute;
		left: 159px;

	}

</style>
</head>

<body>
<img  id="bgpic" src="img/bg4.jpg" alt=""/>
<div id="host1">

<!--Assessment Details-->

<div class="dig1"><b><?php echo $asmtno ?></b></div>
<div class="dig2"><b><?php echo $capture ?></b></div>
<div class="dig3"><b><?php echo strtoupper($basis) ;?></b></div>
<div class="dig4"><b><?php echo $tcname; ?></b></div>
<div class="digb"><b><?php echo $coytin ?></b></div>
<div class="dig5"><b><?php echo $coyname ;?></b></div>
<div class="dig6"><b><?php echo $firstadd;?></b></div>
<div class="dig7"><b><?php echo $secondadd;?></b></div>
<div class="dig7a"><b><?php echo $thirdadd;?></b></div>

<div class="dig8"><b><?php  echo $disoffname ;?>,</b></div>

<div class="dig9"><b><?php  echo $firstoff ;?></b></div>
<div class="dig9b"><b><?php echo $secondoff ;?></b></div>
<div class="dig10"><b>$showperiod</b></div>
<div class="dig11"><b><?php echo $startdate;?></b></div>
<div class="dig12"><b><?php echo $enddate ;?></b></div>
<div class="diggg"><b><?php echo $vatsales ;?></b></div>
<div class="diggg2"><b>( <?php echo $vatexmpt ;?> )</b></div>
<div class="digm"><b><?php echo $vatsales2 ;?></b></div>
<div class="digmy"><b><?php echo $amtraised2 ;?></b></div>
<div class="di2"><b><?php echo $m ;?> <?php echo $rate ;?></b></div>



<div class="dig13"><b>$swamtraised</b></div>



<div class="dig13b"><b>( $inputshw )</b></div>


<div class="dig14"><b>$amtinshw</b></div>




<!--	amount paid comes here-->
<div class="dig14b"><b>( <?php echo number_format($amtpaid,2) ?> )</b></div>

<!--penalty and interest  here-->
<div class="dig14c"><b>$intshow</b></div>

<div class="dig15"><b>$penshow</b></div>

<!--Total due-->
<div class="dig15b"><b>$totsum</b></div>
<!--Total Vat due-->

<div class="dig16"><span id="showtot">$totsum</span></div>

</div>
<div class="dib19">$displayinfo</div>
</body>
</html>
';


$html=str_replace('$invisible',$invisible,$html);
$html=str_replace('$amtvisible',$amtvisible,$html);
$html=str_replace('$penvisible',$penvisible,$html);
$html=str_replace('$exmptvisible',$exmptvisible,$html);
$html=str_replace('$salesvisible',$salesvisible,$html);

$html=str_replace('<?php echo $asmtno ?>',$asmtno,$html);
$html=str_replace('<?php echo $capture ?>',$capture,$html);
$html=str_replace('<?php echo strtoupper($basis) ;?>',strtoupper($basis),$html);
$html=str_replace('<?php echo $tcname; ?>',$tcname,$html);
$html=str_replace('<?php echo $coytin ?>',$coytin,$html);
$html=str_replace('<?php echo $coyname ;?>',$coyname,$html);
$html=str_replace('<?php echo $firstadd;?>',$firstadd,$html);
$html=str_replace('<?php echo $secondadd;?>',$secondadd,$html);
$html=str_replace('<?php echo $thirdadd;?>',$thirdadd,$html);

$html=str_replace('<?php  echo $disoffname ;?>',$disoffname,$html);
$html=str_replace('<?php  echo $firstoff ;?>',$firstoff,$html);
$html=str_replace('<?php echo $secondoff ;?>',$secondoff,$html);
$html=str_replace('$showperiod',$showperiod,$html);
$html=str_replace('<?php echo $startdate;?>',$startdate,$html);
$html=str_replace('<?php echo $enddate ;?>',$enddate,$html);
$html=str_replace('<?php echo $vatsales ;?>',number_format($vatsales,2),$html);
$html=str_replace('<?php echo $vatexmpt ;?>',number_format($vatexmpt,2),$html);
$html=str_replace('<?php echo $vatsales2 ;?>',$vatsales2,$html);
$html=str_replace('<?php echo $amtraised2 ;?>',$swamtraised,$html);
$html=str_replace('<?php echo $rate ;?>',$rate,$html);
$html=str_replace('<?php echo $m ;?>',$m,$html);
$html=str_replace('$swamtraised',$swamtraised,$html);
$html=str_replace('$inputshw',$inputshw,$html);
$html=str_replace('<?php echo number_format($amtpaid,2) ?>',number_format($amtpaid,2),$html);
$html=str_replace('$amtinshw',$amtinshw,$html);
$html=str_replace('$penshow',$penshow,$html);
$html=str_replace('$intshow',$intshow,$html);
$html=str_replace('$totsum',$totsum,$html);
$html=str_replace('$showrate',$showrate,$html);
$html=str_replace('$displayinfo',$displayinfo,$html);



$document->loadHtml($html);

//set page size and orientation

$document->setPaper('letter', 'portrait');

//Render the HTML as PDF

$document->render();

//Get output of generated pdf in Browser

$document->stream("Assessment_print_".date('d-m-Y'), array("Attachment"=>0));
//1  = Download
//0 = Preview

//Testing of DOmPDF ends here




?>
