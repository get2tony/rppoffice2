<?php

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/vatmethods.php');

// reference the Dompdf namespace

  require_once dirname(__FILE__) . '/dompdf/lib/html5lib/Parser.php';
  require_once dirname(__FILE__) . '/dompdf/php-font-lib/src/FontLib/Autoloader.php';
  require_once dirname(__FILE__) . '/dompdf/php-svg-lib/src/autoload.php';
  require_once dirname(__FILE__) . '/dompdf/src/Autoloader.php';
  Dompdf\Autoloader::register();
  use Dompdf\Dompdf;
	

$officename=getSettings('oname',$conn);
$offadd=getSettings('address',$conn);
$tcname=getSettings('tcname',$conn);

$coytin=$_REQUEST['data1'];
$coyname=stripslashes($_REQUEST['data2']);
$address=$_REQUEST['data3'];
$yoa=$_REQUEST['data4'];
$capture=$_REQUEST['data5'];
$cdate=explode('-',$capture);
$year=$cdate[2];

$amount=str_replace( ',', '',$_REQUEST['data6']);
$basis=$_REQUEST['data7'];
$taxtype=$_REQUEST['data8'];
$asmtno=$_REQUEST['data9'];

$sd='01-01-'.$yoa-1;
$ed='31-12-'.$yoa-1;


$startdate=isset($_REQUEST['data10']) ? $_REQUEST['data10'] : $sd;
$enddate=isset($_REQUEST['data11']) ? $_REQUEST['data11'] : $ed;

$amtpaid=isset($_REQUEST['data12']) ? $_REQUEST['data12'] : null;
$assprofit=isset($_REQUEST['data13']) ? $_REQUEST['data13'] : null;

$tprofit= isset($_REQUEST['data14']) ? $_REQUEST['data14'] : null;
$penalty= isset($_REQUEST['data15']) ? $_REQUEST['data15'] : null;
$suser= isset($_REQUEST['data16']) ? $_REQUEST['data16'] : null;
$appby= isset($_REQUEST['data17']) ? $_REQUEST['data17'] : null;
$inputtax= isset($_REQUEST['data18']) ? $_REQUEST['data18'] : null;
$vatraised= isset($_REQUEST['data19']) ? $_REQUEST['data19'] : null;
$serial= isset($_REQUEST['data20']) ? $_REQUEST['data20'] : null;


$citrate= isset($_REQUEST['data21']) ? $_REQUEST['data21'] : getSettings('citrate',$conn);
$edtrate= isset($_REQUEST['data22']) ? $_REQUEST['data22'] : getSettings('edtrate',$conn);
$vatrate= isset($_REQUEST['data23']) ? $_REQUEST['data23'] : getSettings('vatrate',$conn);
//$serial= isset($_REQUEST['data20']) ? $_REQUEST['data20'] : null;


$whttnx='yes';

$firstoff=substr($offadd,0,39) ;
$secondoff=substr($offadd,39,38) ;
$disoffname=substr($officename,0,46);


$amtdue=$amount;


if($assprofit==null){
	$assprofit=$amount;
}
if ($tprofit==null){
	
	$tprofit=$amount;
}
if($penalty==null){
	
	$penalty="off";
}

$rate="";

$display=checktodisplay($taxtype,$amount,$assprofit,$tprofit);


if($taxtype=="CIT"){
	
 $rate=$citrate.'%';
}
if($taxtype=="WHT"){

	$floatval=floatval($assprofit);
	if ($floatval && $assprofit>100) {
	$assprofit='0.1_N';
	$vatraised=0;
	//$tprofit=$amount/$assprofit;# code...
		}	

	if( strpos( $assprofit,"_N" ) !== false) {
	$assprofit=chop('$assprofit','_N');
	$whttnx='no';
}

 $rate=($assprofit*100).'%';
}
if($taxtype=="EDT"){
 $rate=$edtrate.'%';
}

if($taxtype=="WHT" && $whttnx=="yes"){
	//$tprofit=$tprofit/$assprofit;
	$amount=$tprofit*($assprofit);
	$amtdue=$amount-$amtpaid;
	$penalty=checkpen($penalty,$amtdue);
	
	$assprofit=0.00;
}elseif ($taxtype=="WHT" && $whttnx=='no') {
	$amount=$tprofit;
	$amtdue=$amount;
	$penalty=checkpen($penalty,$amtdue);//$penalty="off";
}
if($taxtype=="CIT" && $display=="true" ){
	
	$amount=$tprofit*($citrate/100);
	$amtdue=$amount-$amtpaid;
	$penalty=checkpen($penalty,$amtdue);
	
	$assprofit=0.00;
}

if($taxtype=="EDT" && $display=="true"){
	$tprofit=0.00;
	$amount=$assprofit*($edtrate/100);
	$amtdue=$amount-$amtpaid;
	$penalty=checkpen($penalty,$amtdue);
	
	
}

if ($startdate==null || $enddate==null){
	$yoa2=$yoa-1;
	$startdate="01-01-".$yoa2;
	$enddate="31-12-".$yoa2;
	
	
}

$amtfinal=$amtdue+$penalty;

if($taxtype=="POL"){
    $basis="POL";
    }

if($assprofit==$amount || $tprofit==$amount){
	$rate="";
}
if($taxtype=='WHT' && $tprofit==$amount){
	$rate="";
}

$displayinfo='<div align="center" style="font-family:verdana">This  Assessment was raised by '.ucfirst($suser).' on the '.$capture.'</div>';

//use dompdf\dompdf;

//initialize dompdf class
//$dompdf = new Dompdf($this->dompdf_options);
//    $dompdf->setBasePath($webRoot);

$document = new Dompdf();
//$document->setBasePath($webRoot);
$document->set_option( 'dpi' , '127' );




//  /////////////////////////////////////////////
 
		if ($yoa>=$year){
			$davisible='visible';
		}else{
			$davisible='hidden';
		}
		
		if ($yoa<$year){
			$dbvisible='visible';
		}else{
			$dbvisible='hidden';
		}

		if ($amtpaid>0){
			$apvisible='visible';
		}else{
			$apvisible='hidden';
		}

		if($taxtype=="EDT") {
    
		  $bgpic= "img/bg2.jpg";  
		}
		if($taxtype=="CIT" || $taxtype=="POL" ) {
    
		  $bgpic= "img/bg.jpg";  
		}
		if($taxtype=="WHT") {
    
		  $bgpic= "img/bgwht.jpg";  
		}

		if($assprofit==0.00){
      		 
      		$showassp='';
      		}else if ($taxtype=="CIT" && $assprofit>0) {
      					$showassp='';	  
      					  }else{
      			$showassp= number_format($assprofit,2) ;
      	}
		if($assprofit==0.00){
      		 
      		$showassp='';
      		}else if ($taxtype=="WHT" && $assprofit>0) {
      					$showassp='';	  
      					  }else{
      			$showassp= number_format($assprofit,2) ;
		  }
		  if($tprofit==0.00){
				  		 
				  	$showtp	='';
				  		}else if ($taxtype=="WHT" && $tprofit>0) {
				  		$showtp	='';				  
				  	}else {
				  		$showtp	= number_format($tprofit,2);
		}
		if($tprofit==0.00){
				  		 
				  	$showtp	='';
				  		}else if ($taxtype=="EDT" && $tprofit>0) {
				  		$showtp	='';				  
				  	}else {
				  		$showtp	= number_format($tprofit,2);
		}
	$showamt=number_format($amount,2);

		if($amtpaid==0.00){
          		 
          		$showpd='';
          		}else {
          		$showpd=  number_format($amtpaid,2);
          					  
          	}
		if ($penalty<=0){
			$showpen='';
		}else{
		
		$showpen=number_format($penalty,2); 
		}
	
		$showfn=number_format($amtfinal,2);

		if (strpos($asmtno,"UR")){
		     $displayinfo=$displayinfo;
			}else{
		 		$displayinfo='';
	 			}

//  /////////////////////////////////////////////



$html = '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> Assessment | Print</title>
<!--<link href="css3config.phpAReport.css" rel="stylesheet" type="text/css">-->
 <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
<style type="text/css">
    body, div{
  		
		margin: 0px;
    }
	img { max-width: none; width: 100% }
	b{
	font-family:Tahoma, Geneva, sans-serif;
	font-size:16px;
	color:#F00;
	
	} 
	#bgpic{
		z-index: -1;	
		clear: both;
		height: 1232px;
		width: 1000px;
	 	position:absolute;
		margin: 0px;
	}
	
	#host{
		
		height: 1232px;
		width: 1000px;
		position: absolute;
		
	}
	.dib1{
		top: 170px;
		position: absolute;
		left: 500px;
		
	}
	.dib2{
		top: 195px;
		position: absolute;
		left: 557px;
		
	}
	.dib3{
		top: 195px;
		position: absolute;
		left: 767px;
		
	}
	.diba{
		top: 231px;
		position: absolute;
		left: 446px;
		visibility: $davisible;
		
		
	}
	.dibb{
		top: 269px;
		position: absolute;
		left: 446px;
		
		
		visibility: $dbvisible;
		
	}
	.dib4{
		top: 323px;
		position: absolute;
		left: 250px;
		
	}
	.dib5{
		top: 367px;
		position: absolute;
		left: 250px;
		
	}
	.dib6{
		top: 393px;
		position: absolute;
		left: 250px;
		
		
	}
	.dib7{
		top: 422px;
		position: absolute;
		left: 250px;
		
	}
	
	
	.dib8{
		top: 320px;
		position: absolute;
		left: 733px;
		
	}
	.dib9{
		top: 347px;
		position: absolute;
		left: 815px;
		
	}
	
	.dib10{
		top: 413px;
		position: absolute;
		left: 720px;
		
	}
	.dig8{
		top: 602px;
		position: absolute;
		left: 544px;
		
	}
	.dig9{
		top: 622px;
		position: absolute;
		left: 544px;
		
	}
	.dig9b{
		top: 640px;
		position: absolute;
		left: 544px;
		
	}
	
	.dib11{
		top: 823px;
		position: absolute;
		left: 250px;
		
	}
	
	.dib12{
		top: 875px;
		position: absolute;
		left: 604px;
		
	}
	.dib13{
		top: 987px;
		position: absolute;
		left: 604px;
		
	}
	.dib14{
		top: 1064px;
		position: absolute;
		left: 535px;
		
	}
	.dib15{
		top: 1064px;
		position: absolute;
		left: 604px;
		
	}
	.dib16{
		top: 1090px;
		position: absolute;
		left: 604px;
		
		visibility: $apvisible;
		
		
		
	}
	.dib17{
		top: 1112px;
		position: absolute;
		left: 604px;
		
	}
	.dib18{
		top: 1135px;
		position: absolute;
		left: 604px;
		
	}
	.dib19{
		top: 1195px;
		position: absolute;
		left: 159px;
		
	}
	
    
</style>
</head>
<body>

<img  id="bgpic" src="$bgpic" alt=""/>
<div id="host">
 
    <div class="dib1"><b><?php echo $yoa ?></b></div>
   	<div class="dib2"><b><?php echo $startdate ;?></b></div>
    <div class="dib3">	<b><?php echo $enddate ;?></b> </div>
    
    
    <div class="diba">	<b>X</b> </div>
    <div class="dibb">	<b>X</b> </div>
    
    
        
    <div class="dib4">	<b><?php echo $coyname ;?></b> </div>
     <div class="dib5">	<b><?php echo substr($address,0,33);?></b>  </div>
    <div class="dib6"> <b><?php echo substr($address,33,32);?></b>  </div>
     <div class="dib7">	<b><?php echo substr($address,66,33);?></b>  </div>
     <div class="dib8">	<b><?php echo $asmtno ?></b> </div>
    <div class="dib9"> <b><?php echo $coytin ?></b>   </div>
     <div class="dib10"><b><?php echo $capture ?></b> </div>
     
     
     <div class="dig8"><b><?php  echo $disoffname ;?>,</b></div>
	 <div class="dig9"><b><?php  echo $firstoff ;?>,</b></div>
	 <div class="dig9b"><b><?php echo $secondoff ;?></b></div>
     
     
     
     
      <div class="dib11"><b><?php echo strtoupper($basis) ;?></b></div>
     
      <div class="dib12">     	<b>$showassp</b>
      </div>
				  <div class="dib13">
				  	<b>$showtp</b>
				  </div>
          <div class="dib14">
          	<b><?php echo $rate;	?></b>
          </div>
          <div class="dib15">
          	<b>$showamt</b>
          </div>
          <div class="dib16">
          	<b>( $showpd )</b>
          </div>
	<div class="dib17">
		<b>$showpen</b>
	</div>
    <div class="dib18">
    	<b>$showfn</b>
    </div>
    
    
    
    
    
</div>
<div class="dib19">$displayinfo</div>
</body>
</html>';


$html=str_replace('<?php echo $yoa ?>',$yoa,$html);
$html=str_replace('$davisible',$davisible,$html);
$html=str_replace('$dbvisible',$dbvisible,$html);
$html=str_replace('$apvisible',$apvisible,$html);
$html=str_replace('$bgpic',$bgpic,$html);
$html=str_replace('<?php echo $startdate ;?>',$startdate,$html);
$html=str_replace('<?php echo $enddate ;?>',$enddate,$html);
$html=str_replace('<?php echo $coyname ;?>',$coyname,$html);
$html=str_replace('<?php echo substr($address,0,33);?>',substr($address,0,33),$html);
$html=str_replace('<?php echo substr($address,33,32);?>',substr($address,33,32),$html);
$html=str_replace('<?php echo substr($address,66,33);?>',substr($address,66,33),$html);

$html=str_replace('<?php echo $asmtno ?>',$asmtno,$html);
$html=str_replace('<?php echo $coytin ?>',$coytin,$html);
$html=str_replace('<?php echo $capture ?>',$capture,$html);
$html=str_replace('<?php  echo $disoffname ;?>',$disoffname,$html);
$html=str_replace('<?php  echo $firstoff ;?>',$firstoff,$html);
$html=str_replace('<?php echo $secondoff ;?>',$secondoff,$html);
$html=str_replace('<?php echo strtoupper($basis) ;?>',strtoupper($basis),$html);
$html=str_replace('$showassp',$showassp,$html);
$html=str_replace('$showtp',$showtp,$html);
$html=str_replace('<?php echo $rate;	?>',$rate,$html);
$html=str_replace('$showamt',$showamt,$html);
$html=str_replace('$showpd',$showpd,$html);
$html=str_replace('$showpen',$showpen,$html);
$html=str_replace('$showfn',$showfn,$html);
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




