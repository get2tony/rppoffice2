<?php 
    
 include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
    include_once('vatmethods.php');

    
    $coytin=$_POST['coytin'];
    $coyname=trim(preg_replace('/\s\s+/', '', strtoupper($_POST['coyname'])));
    $address=trim(preg_replace('/\s\s+/', '', $_POST['address']));
    $assyr=$_POST['yoa'];
    $capture=$_POST['capture'];
    $taxtype=$_POST['ttype'];
    $amount=str_replace( ',', '',$_POST['amount']);
    $assno=$_POST['assmn'];
    $basis=$_POST['basis'];
    $startdate=$_POST['startdate'];
    $enddate=$_POST['enddate'];
    $suser=$_POST['user'];
	$usersno=$_POST['usersno'];
	$irno=checkUserirno($usersno,$conn);

    $edtpaid=str_replace( ',', '',$_POST['edtpaid']);
    $citpaid=str_replace( ',', '',$_POST['citpaid']);
    $aprofit=$_POST['aprofit'];
    $tprofit=$_POST['tprofit'];
    $citpen=$_POST['citpen'];
    $edtpen=$_POST['edtpen'];
	$approval="pending";
	$userstatus=checkUserstatus2($usersno,$conn);
  	$appby='';
	$appdate='';

	$vatpen=$_POST['vatpen'];
	$inputtax=str_replace(',','',$_POST['inputtax']);
	$vatpaid=str_replace(',','',$_POST['vatpaid']);
	
	 $totpenint=(getSettings('penrate',$conn)+getSettings('intrate',$conn));
	  $tot=$totpenint/100;

	$citrate1=isset($_POST['citrate']) ? $_POST['citrate'] : getSettings('citrate',$conn);
	$edtrate1=isset($_POST['edtrate']) ? $_POST['edtrate'] : getSettings('edtrate',$conn);
	$vatrate1=isset($_POST['vatrate']) ? $_POST['vatrate'] : getSettings('vatrate',$conn);

	 $citrate= $citrate1/100;
	 $edtrate= $edtrate1/100;

	 $asspage="viewass2 ";
// RETAIN COMPUTATION RATES
	 $citratex= $citrate1;
	 $edtratex= $edtrate1;
	 $intratex= getSettings('intrate',$conn);
	 $penratex= getSettings('penrate',$conn);
	 $vatratex= $vatrate1;
//  RATES ENDS HERE

	$amtpaid=0;
	$penalty="off";
	$assprofit=($amount+$edtpaid)/$edtrate;
	$totalprofit=($amount+$citpaid)/$citrate;
	
	$vatraised=$amount;
	$totalvat=$amount-$inputtax-$vatpaid;
	$datax="";

	if($taxtype=='VAT'){
		
		$amtpaid=$vatpaid;
		$amount=$totalvat;
		$penalty=$vatpen;
		$asspage="viewvatass ";
		$datax="no";
		
	}
	

    if ($aprofit=="yes"){
		
		
		$amtpaid=$edtpaid;
		$penalty=$edtpen;
	
		$totalprofit=0;
		
	}else if ($aprofit=="no"){
		$assprofit=$amount;
	}
	
	if ($tprofit=="yes"){
		
		$amtpaid=$citpaid;
		$penalty=$citpen;
		
		$assprofit=0;
		
	}else if ($tprofit=="no"){
		$totalprofit=$amount;
	}
    
    
    

  

    // $asspage2="captureadmin ";
   
    if($penalty=='on'){
		$amount2=$amount+($amount*$tot);
	}else{
		$amount2=$amount;
	}


 $address=str_replace("&"," %26 ",$address);
 $coyname=str_replace("&"," %26 ",$coyname);
	
 header('Location:'.$asspage.'?data1='.$coytin.'&data2='.str_replace("&"," %26 ",$coyname).'&data3='.str_replace("&"," %26 ",$address).'&data4='.$assyr.'&data5='.$capture.'&data6='.$amount.'&data7='.$basis.'&data8='.$taxtype.'&data9='.$assno.'&data10='.$startdate.'&data11='.$enddate.'&data12='.$amtpaid.'&data13='.$assprofit.'&data14='.$totalprofit.'&data15='.$penalty.'&data16='.$suser.'&data17='.$appby.'&data18='.$inputtax.'&data19='.$vatraised.'&data21='.$citratex.'&data22='.$edtratex.'&data23='.$vatratex.'&data24='.$datax); 
exit();
            
       mysqli_close($conn);
    
?>