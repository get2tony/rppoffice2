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



$officename=getSettings('oname',$conn);
$offadd=getSettings('address',$conn);
$tcname=getSettings('tcname',$conn);

$firstoff=substr($offadd,0,39) ;
$secondoff=substr($offadd,39,38) ;
$disoffname=substr($officename,0,46);


$coytin=$_REQUEST['data1'];
$coyname=stripslashes($_REQUEST['data2']);
//////////////////////////////////////

$coycount=strlen($coyname);
// echo $coycount;
if($coycount>30){

 	$coyname=str_replace('INTEGRATED','INT',$coyname);
	$coyname=str_replace('INTERNATIONAL','INTL',$coyname);
	$coyname=str_replace('LIMITED','LTD',$coyname);
	$coyname=str_replace('COMMERCIAL','COM',$coyname);
	$coyname=str_replace('INDUSTRIAL','IND',$coyname);
	$coyname=str_replace('INDUSTRIES','INDS',$coyname);
	$coyname=str_replace('PRODUCTION','PROD',$coyname);
	$coyname=str_replace('PRODUCTS','PROD',$coyname);
	$coyname=str_replace('PHARMACEUTICAL ','PHARM',$coyname);
	$coyname=str_replace('PHARMACEUTICALS','PHARM',$coyname);
	$coyname=str_replace('ENTERPRISES ','ENT',$coyname);
	$coyname=str_replace('INVESTMENT','INVEST',$coyname);
	$coyname=str_replace('INVESTMENTS','INVEST',$coyname);
	$coyname=str_replace('SERVICES','SERV',$coyname);
	$coyname=str_replace('SERVICE','SERV',$coyname);
	$coyname=str_replace('NIGERIA','NIG',$coyname);
	$coyname=str_replace('CONSTRUCTION','CONSTR',$coyname);
	$coyname=str_replace('CONSULTANCY','CONSULT',$coyname);
	$coyname=str_replace('PETROLEUM','PET',$coyname);
	$coyname=str_replace('VENTURES','VEN',$coyname);
	$coyname=str_replace('MANAGEMENT','MGT',$coyname);
	$coyname=str_replace('MANAGERS','MGRS',$coyname);
}

///////////////////////////////////
$address=$_REQUEST['data3'];
$yoa=$_REQUEST['data4'];
$capture=$_REQUEST['data5'];

$cdate=explode('-',$capture);
$year=$cdate[2];


$amount=str_replace(',','',$_REQUEST['data6']);

$taxtype='CIT';

if($_REQUEST['data8']=='LRP'){
	$asmtno=$_REQUEST['data9'];
}else{
	$asmtno=$_REQUEST['data8'].$_REQUEST['data9'].$_REQUEST['data10'];

}

$basis="LRP";

	$yoa2=$yoa-1;
$startdate="01-01-".$yoa2;
$enddate="31-12-".$yoa2;


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

$showamt=number_format($amount,2);



//  /////////////////////////////////////////////
 
$html='

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> LRP Assessment | Print</title>
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
		left: 730px;
		
	}
	.dib9{
		top: 347px;
		position: absolute;
		left: 824px;
		
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

<img  id="bgpic" src="img/bg.jpg" alt=""/>
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
     
      <div class="dib12"> <b>$showamt</b>   </div>
				  <div class="dib13">
				  	<b>$showamt</b>  </div>
          <div class="dib14">
          	<b></b>
          </div>
          <div class="dib15">
          	<b>$showamt</b>
          </div>
          <div class="dib16">
          	<b></b>
          </div>
	<div class="dib17">
		<b></b>
	</div>
    <div class="dib18">
    	<b>$showamt</b>
    </div>
    
    
    
    
    
</div>

</body>
</html>';

$html=str_replace('<?php echo $yoa ?>',$yoa,$html);
$html=str_replace('$davisible',$davisible,$html);
$html=str_replace('$dbvisible',$dbvisible,$html);

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

$html=str_replace('$showamt',$showamt,$html);


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

