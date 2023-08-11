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


$coytin=$_GET['data1'];
$coyname=stripslashes($_GET['data2']);
$address=$_GET['data3'];
$yoa=$_GET['data4'];
$cit=number_format($_GET['data5'],2);
$edt=number_format($_GET['data6'],2);
$usersno=$_GET['data8'];
$staffname=$_GET['data7'];




$tcname=getSettings('tcname',$conn);
$rppname=getSettings('rppname',$conn);
$officename=getSettings('oname',$conn);
$soffice=getSettings('soname',$conn);
$nuyoa=date('Y');
$total=str_replace(',','',$cit) + str_replace(',','',$edt);

//use dompdf\dompdf;

//initialize dompdf class
//$dompdf = new Dompdf($this->dompdf_options);
//    $dompdf->setBasePath($webRoot);

$document = new Dompdf();
//$document->setBasePath($webRoot);
$document->set_option( 'dpi' , '126' );




//  /////////////////////////////////////////////



//  /////////////////////////////////////////////

$html='
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> Provisional Tax | Print</title>

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
		height: 1294px;
		width: 1000px;
	 	position:absolute;
	}
	
	#host1{
		
		height: 1294px;
		width: 1000px;
		float: left;
		position: absolute;
		
	}
	.officen{
		
		top: 207px;
		position: absolute;
		left: 350px;
	}
	
	.nuyoa{
		display: block;
		top: 265px;
		position: absolute;
		left: 650px;
	}
	
	.coyinfo{
		
		top: 315px;
		position: absolute;
		left:315px;
	}
	.coyinfo1{
		
		top: 350px;
		position: absolute;
		left:315px;
	}
	.coyinfo2{
		
		top: 386px;
		position: absolute;
		left:315px;
	}
	.coyinfo2a{
		
		top: 410px;
		position: absolute;
		left:315px;
	}
	.mid{
		
		top: 528px;
		position: absolute;
		left: 550px;
	}
	
	.mid1{
		
		top: 570px;
		position: absolute;
		left: 550px;
	}
	.mid2{
		
		top: 630px;
		position: absolute;
		left: 550px;
	}
	.mid3{
		
		top: 669px;
		position: absolute;
		left: 550px;
	}
	.nid{
		
		top: 528px;
		position: absolute;
		left: 740px;
	}
	.nid1{
		
		top: 570px;
		position: absolute;
		left: 740px;
	}
	.nid2{
		
		top: 630px;
		position: absolute;
		left: 740px;
	}
	.nid3{
		
		top: 671px;
		position: absolute;
		left: 740px;
	}
	.nid4{
		
		top: 740px;
		position: absolute;
		left: 740px;
	}
	
	.gid{
		
		top: 803px;
		position: absolute;
		left: 514px;
	}
	.gid1{
		
		top: 831px;
		position: absolute;
		left: 348px;
	}
	.gid2{
		
		top: 900px;
		position: absolute;
		left: 412px;
	}
	.gid3{
		
		top: 1025px;
		position: absolute;
		left: 208px;
	}
	.gid4{
		
		top:1135px;
		position: absolute;
		left:347px;
	}
	.gid5{
		
		top: 1237px;
		position: absolute;
		left:117px;
	}
	
	.gid5a{
		
		top: 1237px;
		position: absolute;
		left:519px;
	}

    
</style>

</head>

<body id="target" >
<img  id="bgpic" src="img/ptt.jpg" alt="">
<div id="host1">
  
 
<div class="officen">
	<b><?php echo $officename ?></b>
</div>
<div class="nuyoa">
	<b><?php echo $nuyoa ?></b>
</div>

	<div class="coyinfo"><b><?php echo $coyname ?></b></div>
	<div class="coyinfo1"><b><?php echo $coytin ?></b></div>
	<div class="coyinfo2"><b><?php echo substr($address,0,52) ?></b></div>
	<div class="coyinfo2a"><b><?php echo substr($address,52,50) ?></b></div>

	<div class="mid"><b><?php echo $yoa ?></b></div>
	<div class="mid1"><b><?php echo $nuyoa ?></b></div>
	<div class="mid2"><b><?php echo $yoa ?></b></div>
	<div class="mid3"><b><?php echo $nuyoa ?></b></div>
	
	
	<div class="nid"><b><?php echo $cit ?></b></div>
	<div class="nid1"><b><?php echo $cit ?></b></div>
	<div class="nid2"><b><?php echo $edt ?></b></div>
	<div class="nid3"><b><?php echo $edt ?></b></div>
	<div class="nid4"><b><?php echo number_format($total,2) ?></b></div>
	
	
<div class="gid"><b><?php echo $cit ?></b></div>
	<div class="gid1"><b><?php echo $edt ?></b></div>
	<div class="gid2"><b><?php echo $soffice ?>.</b></div>
<div class="gid3"><b><?php echo $yoa ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $nuyoa ?></b></div>

<div class="gid4">	
<b><?php echo date("j S") ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<b><?php echo strtoupper(date("F")) ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<b><?php echo $nuyoa ?></b></div>

<div class="gid5">
<b><?php echo $rppname ?></b></div>

<div class="gid5a">	<b><?php echo $tcname ?></b></div>
</div>

</body>
</html>';

$html=str_replace('<?php echo $officename ?>',$officename,$html);
$html=str_replace('<?php echo $coytin ?>',$coytin,$html);
$html=str_replace('<?php echo $nuyoa ?>',$nuyoa,$html);
$html=str_replace('<?php echo $coyname ?>',$coyname,$html);
$html=str_replace('<?php echo $yoa ?>',$yoa,$html);
$html=str_replace('<?php echo $cit ?>',$cit,$html);
$html=str_replace('<?php echo $edt ?>',$edt,$html);
$html=str_replace('<?php echo date("j S") ?>',date("j S"),$html);
$html=str_replace('<?php echo strtoupper(date("F")) ?>',strtoupper(date("F")),$html);
$html=str_replace('<?php echo substr($address,0,52) ?>',substr($address,0,52),$html);
$html=str_replace('<?php echo substr($address,52,50) ?>',substr($address,52,50),$html);
$html=str_replace('<?php echo $rppname ?>',$rppname,$html);
$html=str_replace('<?php echo $tcname ?>',$tcname,$html);
$html=str_replace('<?php echo number_format($total,2) ?>',number_format($total,2),$html);
$html=str_replace('<?php echo $soffice ?>',$soffice,$html);

$document->loadHtml($html);

//set page size and orientation

$document->setPaper('A4', 'portrait');

//Render the HTML as PDF

$document->render();

//Get output of generated pdf in Browser

$document->stream("Prov_print_".date('d-m-Y'), array("Attachment"=>0));
//1  = Download
//0 = Preview

//Testing of DOmPDF ends here



?>



