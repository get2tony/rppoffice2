<?php

include_once(dirname(__FILE__) . '/dbconfig/methods.php');

include_once(dirname(__FILE__) . '/dbconfig/config.php');


//Testing of DOmPDF starts here

//require_once 'dompdf/src/Autoloader.php';
//require_once 'dompdf/src/Dompdf.php';

// reference the Dompdf namespace

require_once 'dompdf/lib/html5lib/Parser.php';
  require_once 'dompdf/php-font-lib/src/FontLib/Autoloader.php';
  require_once 'dompdf/php-svg-lib/src/autoload.php';
  require_once 'dompdf/src/Autoloader.php';
  Dompdf\Autoloader::register();
  use Dompdf\Dompdf;


//	$webRoot = 'wamp64/www/rppoffice/';



$tover=$_GET['data1'];
$gprofit=$_GET['data2'];
$nasset=$_GET['data3'];
$pcap=$_GET['data4'];
$yoa=$_GET['data5'];
$amount=$_GET['data6'];
$dtover=500000;
$rateb='0.125%';



//A      total value
$agt=$gprofit*(0.50/100);
$ant=$nasset*(0.50/100);
$pct=$pcap*(0.25/100);
$tot=$dtover*(0.25/100);

if($tover<=0 || $tover<$dtover){
	
	$tot=0;
}else{
	$tot=$dtover*(0.25/100);
}

$highest=max($ant,$pct,$agt,$tot);


//B                   /////////////////////////////////
$tdiff=$tover-$dtover;

if ($tdiff<=0 || $tover < $dtover){
	$tdiff=0;
	$rtover=0;
	$tover=0;
	$rateb="N/A";
	$tot=0;
	$dtover=0;
}else{
	
	$rtover=$tdiff*(0.125/100);
}
 

$total=$rtover+$highest;
$payable=$total-$amount;
 
//use dompdf\dompdf;

//initialize dompdf class
//$dompdf = new Dompdf($this->dompdf_options);
//    $dompdf->setBasePath($webRoot);

$document = new Dompdf();
//$document->setBasePath($webRoot);
$document->set_option( 'dpi' , '137' );




//  /////////////////////////////////////////////
$oname=getSettings("oname",$conn);

if($rateb=="N/A"){
		 $tot="N/A";
		 
	 }else{
		 
	$tot=number_format($tot,2); 	 
	 }
	


//  /////////////////////////////////////////////

$html='<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>RPP A.O Minimum Tax Report</title>

<style>
#mainhost2 {
	
	font-family:Tahoma, Geneva, sans-serif;
	font-size:24px;
	color:#000;
    

}
b{
	font-family:Tahoma, Geneva, sans-serif;
	font-size:27px;
	color:#F00;
	
}
#logo{
	display:block;
	position:absolute;
	top: 20px;
	left:5px;
	width: 230px;
	height:150px;
}
#show{
	border:2px solid #000;
	width: 300px;
	height:50px;
	top: 1105px;
	position:absolute;
	display:block;
	left:620px;
	background-color:red;
	opacity:0.1;
}
	
</style>
</head>

<body>
<img id="logo" src="img/logo2.jpg" width="144" height="103" alt="firs_logo">
 <div id="mainhost2">
<table width="466" border="0" cellspacing="0" cellpadding="0">
  <tr>
     <th width="134" scope="col"></th>
    <th width="4" scope="col">&nbsp;</th>
    <th width="328" align="left" valign="top" scope="col"><p><b>FEDERAL INLAND REVENUE SERVICE<br><?php echo $oname ?></b><br>MINIMUM TAX COMPUTATION</p>
      <p><br>
    FOR <?php echo $yoa ?> YEARS OF ASSESSMENT</p></th>
  </tr>
</table>
<table width="465" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="465" scope="col">&nbsp;</th>
  </tr>
</table>
<table width="471" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th width="138" align="left" valign="middle" scope="col"> &nbsp;A:</th>
    <th width="129" align="left" valign="middle" scope="col">&nbsp;</th>
    <th width="94" align="left" valign="middle" scope="col">&nbsp;</th>
    <th width="100" align="left" valign="middle" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;</td>
    <td align="center" valign="middle"><b>RATES</b></td>
    <td align="center" valign="middle"><b>VALUE (=N=)</b></td>
    <td align="center" valign="middle"><b>TOTAL (=N=)</b></td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;GROSS PROFIT</td>
    <td align="center" valign="middle">0.50%</td>
    <td align="right" valign="middle"><?php echo number_format($gprofit,2) ?></td>
    <td align="right" valign="middle"><?php echo number_format($agt,2) ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;NET ASSETS</td>
    <td align="center" valign="middle">0.50%</td>
    <td align="right" valign="middle"><?php echo number_format($nasset,2) ?></td>
    <td align="right" valign="middle"><?php echo number_format($ant,2) ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;PAID UP CAPITAL</td>
    <td align="center" valign="middle">0.25%</td>
    <td align="right" valign="middle"><?php echo number_format($pcap,2) ?></td>
    <td align="right" valign="middle"><?php echo number_format($pct,2) ?></td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;TURNOVER</td>
    <td align="center" valign="middle">0.25%</td>
    <td align="right" valign="middle"><?php echo number_format($dtover,2) ?></td>
    <td align="right" valign="middle"><?php echo $tot?>
	</td>
  </tr>
</table>
<table width="474" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="106" scope="col">&nbsp;</th>
    <th width="68" scope="col">&nbsp;</th>
    <th width="131" scope="col">&nbsp;</th>
    <th width="169" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" valign="middle"><b>HIGHEST OF A: </b></td>
    <td align="center" valign="middle"><h3><b><?php echo number_format($highest,2) ?></b></h3></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="474" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th width="135" align="left" scope="col">&nbsp;B:</th>
    <th width="135" align="left" scope="col">&nbsp;</th>
    <th width="90" align="left" scope="col">&nbsp;</th>
    <th width="104" align="left" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"> &nbsp;TURNOVER</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="right"><?php echo number_format($tover,2) ?></td>
  </tr>
  <tr>
    <td align="left"> &nbsp;LESS:</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="right"><?php echo number_format($dtover,2) ?></td>
  </tr>
  <tr>
    <td align="left"> &nbsp;EXCESS OF TURNOVER</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="right"><?php echo number_format($tdiff,2) ?></td>
  </tr>
  <tr>
    <td align="left"> &nbsp;RATE</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="right"><?php echo $rateb ?></td>
  </tr>
  <tr>
    <td align="left"><b>&nbsp;TOTAL OF B</b></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="right"><b><?php echo number_format($rtover,2) ?></b></td>
  </tr>
</table>
<table width="477" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="369" scope="col">&nbsp;</th>
    <th width="108" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td><b> DETERMINATION OF MINIMUM TAX PAYABLE</b></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><b>ADD</b>:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>I. HIGHEST OF A</td>
    <td align="right"><?php echo number_format($highest,2) ?></td>
  </tr>
  <tr>
    <td>II. TOTAL OF B</td>
    <td align="right"><?php echo number_format($rtover,2) ?></td>
  </tr>
  <tr>
    <td><b>AMOUNT DUE</b></td>
    <td align="right" id="total"><b><?php echo number_format($total,2) ; ?></b></td>
  </tr>
  <tr>
    <td><b>LESS:</b> CIT ALREADY PAID</td>
    <td align="right">(<?php echo number_format($amount,2) ?>)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right" id="total"><span id="axe"></span></td>
  </tr>
  <tr>
    <td><b>TOTAL MINIMUM TAX PAYABLE</b></td>
    <td align="right" id="tota"><b><?php echo number_format($payable,2) ; ?></b></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<div id="show"></div>	
</div>
</body>
</html>
';

$html=str_replace('<?php echo $oname ?>',$oname,$html);
$html=str_replace('<?php echo $yoa ?>',$yoa,$html);
$html=str_replace('<?php echo number_format($gprofit,2) ?>',number_format($gprofit,2),$html);
$html=str_replace('<?php echo number_format($agt,2) ?>',number_format($agt,2),$html);
$html=str_replace('<?php echo number_format($nasset,2) ?>',number_format($nasset,2),$html);
$html=str_replace('<?php echo number_format($ant,2) ?>',number_format($ant,2) ,$html);
$html=str_replace('<?php echo number_format($pcap,2) ?>',number_format($pcap,2) ,$html);
$html=str_replace('<?php echo number_format($pct,2) ?>',number_format($pct,2),$html);
$html=str_replace('<?php echo number_format($dtover,2) ?>',number_format($dtover,2),$html);
$html=str_replace('<?php echo $tot?>',$tot,$html);
$html=str_replace('<?php echo number_format($highest,2) ?>',number_format($highest,2),$html);
$html=str_replace('<?php echo number_format($tover,2) ?>',number_format($tover,2),$html);
$html=str_replace('<?php echo number_format($dtover,2) ?>',number_format($dtover,2),$html);
$html=str_replace('<?php echo number_format($tdiff,2) ?>',number_format($tdiff,2),$html);
$html=str_replace('<?php echo $rateb ?>',$rateb,$html);
$html=str_replace('<?php echo number_format($rtover,2) ?>',number_format($rtover,2),$html);
$html=str_replace('<?php echo number_format($highest,2) ?>',number_format($highest,2),$html);
$html=str_replace('<?php echo number_format($rtover,2) ?>',number_format($rtover,2),$html);
$html=str_replace('<?php echo number_format($total,2) ; ?>',number_format($total,2),$html);
$html=str_replace('<?php echo number_format($amount,2) ?>',number_format($amount,2),$html);
$html=str_replace('<?php echo number_format($payable,2) ; ?>',number_format($payable,2),$html);



$document->loadHtml($html);

//set page size and orientation

$document->setPaper('A4', 'potrait');

//Render the HTML as PDF

$document->render();

//Get output of generated pdf in Browser

$document->stream("Minimum tax_print_".date('d-m-Y'), array("Attachment"=>0));
//1  = Download
//0 = Preview

//Testing of DOmPDF ends here



?>
