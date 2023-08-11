$_REQUEST
<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');
require_once 'dompdf/lib/html5lib/Parser.php';
  require_once 'dompdf/php-font-lib/src/FontLib/Autoloader.php';
  require_once 'dompdf/php-svg-lib/src/autoload.php';
  require_once 'dompdf/src/Autoloader.php';
  Dompdf\Autoloader::register();
  use Dompdf\Dompdf;

$officename=getSettings('oname',$conn);
$offadd=getSettings('address',$conn);
$tcname=getSettings('tcname',$conn);






$coytin=$_REQUEST['data1'];
$coyname=stripslashes($_REQUEST['data2']);
$address=stripslashes($_REQUEST['data3']);
$yoa=$_REQUEST['data4'];
$capture=$_REQUEST['data5'];
$amount= str_replace(',','',$_REQUEST['data6']);
$basis=$_REQUEST['data11'];
$taxtype=$_REQUEST['data7'];
$asmtno=isset($_REQUEST['data9']) ? $_REQUEST['data9'] : null;
$startdate=isset($_REQUEST['start']) ? $_REQUEST['start'] : null;
$enddate=isset($_REQUEST['end']) ? $_REQUEST['end'] : null;
$month=date("m",strtotime($_REQUEST['data8']));

if ($startdate==null && $enddate==null) {
$startdate='01-'.$month.'-'.$yoa;
$enddate= date("t-m-Y", strtotime($startdate));
}

$coycount=strlen($coyname);
// echo $coycount;
if($coycount>33){

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




$suser=isset($_REQUEST['data13']) ? $_REQUEST['data13'] : null;
$duedate=isset($_REQUEST['data14']) ? $_REQUEST['data14'] : null;
$datefile=isset($_REQUEST['data15']) ? $_REQUEST['data15'] : null;
$default=isset($_REQUEST['data12']) ? $_REQUEST['data12'] : null;


$firstadd=substr($address,0,37);
$secondadd=substr($address,37,35);
$thirdadd=substr($address,70,34);

$firstoff=substr($offadd,0,38) ;
$secondoff=substr($offadd,38,36) ;
$disoffname=substr($officename,0,46);





$noperiod=$default;

$displayinfo='<div align="center" style="font-family:verdana">This  Assessment was raised by '.ucfirst($suser).' on the '.$capture.'</div>';

$document = new Dompdf();
//$document->setBasePath($webRoot);
$document->set_option( 'dpi' , '126' );
//  /////////////////////////////////////////////
$shm=explode('-',$enddate);
$showcom=getFullmonth($shm[1])." ".$shm[2];
$showamt=number_format($amount,2);

if (strpos($asmtno,"UR")){
		     $displayinfo=$displayinfo;
			}else{
		 		$displayinfo='';
	 			}
$showperiod=$noperiod;
//  /////////////////////////////////////////////


$html = '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>VAT LSP Assessment | Print</title>
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

	#host1{

		height: 1232px;
		width: 1000px;
		position: absolute;

	}

    .dig1{

		top: 35px;
		position: absolute;
		left: 762px;

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
	.basis{

		top: 477px;
		position: absolute;
		left: 760px;
		font-family:arial black ;
		font-size:26px;
		color:#F00;

		}

	.dig13{

		top: 603px;
		position: absolute;
		left: 760px;


		}
	.dig13b{

		top: 782px;
		position: absolute;
		left: 760px;

				}
    .dig14{

		top: 810px;
		position: absolute;
		left: 760px;

		}
     .dig14b{

		 top: 839px;
		position: absolute;
		left: 760px;


		}
    .dig14c{

		 top: 868px;
		position: absolute;
		left: 760px;

			}
    .dig15{

		top: 897px;
		position: absolute;
		left: 760px;

			}
    .dig15b{

		top: 927px;
		position: absolute;
		left: 760px;
			}
     .dig16{
		top: 955px;
		position: absolute;
		left: 760px;
			}
	.dib19{
		top: 1055px;
		position: absolute;
		left: 159px;

	}

</style>
</head>

<body>
<img  id="bgpic" src="img/bg5.jpg" alt=""/>
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
<div class="dig11"><b><?php echo $duedate;?></b></div>
<div class="dig12"><b><?php echo $datefile ;?></b></div>

<div class="basis"><span>LSP FOR-<br><?php echo $showcom?></span></div>

<div class="dig13"><b> $showamt </b></div>


<!-- here goes the input tax-->
<div class="dig13b"><b></b></div>
<!--input tax-->

<div class="dig14"><b> $showamt </b></div>




<!--	amount paid comes here-->
<div class="dig14b"><b></b></div>

<!--penalty and interest  here-->
<div class="dig14c"><b></b></div>

<div class="dig15"><b></b></div>

<!--Total due-->
<div class="dig15b"><b></b></div>
<!--Total Vat due-->

<div class="dig16"><b> $showamt </b></div>

</div>
<div class="dib19">$displayinfo</div>
</body>
</html>';




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
$html=str_replace('<?php echo $duedate;?>',$duedate,$html);
$html=str_replace('<?php echo $datefile ;?>',$datefile,$html);
$html=str_replace('<?php echo $showcom?>',$showcom,$html);
$html=str_replace('$showamt',$showamt,$html);
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


?>
