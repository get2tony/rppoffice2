<?php


include_once(dirname(__FILE__) . '/dbconfig/methods.php');

include_once(dirname(__FILE__) . '/dbconfig/config.php');


$officename="ORILE IGANMU MICRO &amp; SMALL TAX OFFICE";
$offadd="SUNNY ASEMOTA HOUSE PLOT 5A, SURU-ALABA LAGOS.";
$tcname="Ojokutu Toyin (Mrs.)";

$coytin=$_GET['data1'];
$coyname=stripslashes($_GET['data2']);
$address=$_GET['data3'];
$yoa=$_GET['data4'];
$capture=$_GET['data5'];
$cdate=explode('-',$capture);
$year=$cdate[2];

$amount=str_replace( ',', '',$_GET['data6']);
$basis=$_GET['data7'];
$taxtype=$_GET['data8'];
$asmtno=$_GET['data9'];


$startdate=isset($_REQUEST['data10']) ? $_REQUEST['data10'] : null;
$enddate=isset($_REQUEST['data11']) ? $_REQUEST['data11'] : null;

$amtpaid=isset($_REQUEST['data12']) ? $_REQUEST['data12'] : null;
$assprofit=isset($_REQUEST['data13']) ? $_REQUEST['data13'] : null;

$tprofit= isset($_REQUEST['data14']) ? $_REQUEST['data14'] : null;
$penalty= isset($_REQUEST['data15']) ? $_REQUEST['data15'] : null;
$suser= isset($_REQUEST['data16']) ? $_REQUEST['data16'] : null;
$appby= isset($_REQUEST['data17']) ? $_REQUEST['data17'] : null;
$inputtax= isset($_REQUEST['data18']) ? $_REQUEST['data18'] : null;
$vatraised= isset($_REQUEST['data19']) ? $_REQUEST['data19'] : null;


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
	
 $rate="30%";
}
if($taxtype=="EDT"){
 $rate="2%";
}

if($taxtype=="CIT" && $display=="true" ){
	
	$amount=$tprofit*0.3;
	$amtdue=$amount-$amtpaid;
	$penalty=checkpen($penalty,$amtdue);
	
	$assprofit=0.00;
}

if($taxtype=="EDT" && $display=="true"){
	$tprofit=0.00;
	$amount=$assprofit*0.02;
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

$displayinfo='<div align="center" style="font-family:verdana">This  Assessment was raised by '.$suser.' on the '.$capture.'</div>';
?>



<!doctype html>
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
		<?php 
		if ($yoa>=$year){
			echo 'visibility: visible;';
		}else{
			echo 'visibility: hidden;';
		}
		?>
		
	}
	.dibb{
		top: 269px;
		position: absolute;
		left: 446px;
		<?php 
		if ($yoa<$year){
			echo 'visibility: visible;';
		}else{
			echo 'visibility: hidden;';
		}
		?>
		
		
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
		
		<?php 
		if ($amtpaid>0){
			echo 'visibility: visible;';
		}else{
			echo 'visibility: hidden;';
		}
		?>
		
		
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

<img  id="bgpic" src="<?php if($taxtype=="EDT") {
    
  echo "img/bg2.jpg";  
}else{
    echo  "img/bg.jpg";}
      ?>" alt=""/>
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
     
      <div class="dib12">     	<b><?php 
      					  if($assprofit==0.00){
      		 
      		
      		}else if ($taxtype=="CIT" && $assprofit>0) {
      						  
      					  }else{
      			echo number_format($assprofit,2) ;
      					  }
      					  ?></b>
      </div>
				  <div class="dib13">
				  	<b><?php if($tprofit==0.00){
				  		 
				  		
				  		}else if ($taxtype=="EDT" && $tprofit>0) {
				  						  
				  	}else {
				  		echo number_format($tprofit,2);}
				  	?></b>
				  </div>
          <div class="dib14">
          	<b><?php	echo $rate;	?></b>
          </div>
          <div class="dib15">
          	<b><?php echo number_format($amount,2); ?></b>
          </div>
          <div class="dib16">
          	<b>( <?php if($amtpaid==0.00){
          		 
          		
          		}else {
          		echo  number_format($amtpaid,2);
          					  
          	}
          					  ?> )</b>
          </div>
	<div class="dib17">
		<b><?php  
		if ($penalty<=0){
			
		}else{
		
		echo number_format($penalty,2); 
		}
		           ?></b>
	</div>
    <div class="dib18">
    	<b><?php echo number_format($amtfinal,2); ?></b>
    </div>
    
    
    
    
    
</div>
<div class="dib19"><?php
	 if (strpos($asmtno,'UR')){
		 echo $displayinfo;
	 }else{
		 
	 }
	?></div>
</body>
</html>
