<?php 
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
    include_once('vatmethods.php');


    $coytin=$_POST['coytin'];
    $coyname=trim(preg_replace('/\s\s+/', '', strtoupper(urldecode($_POST['coyname']))));
    $address=trim(preg_replace('/\s\s+/', '', urldecode($_POST['address'])));
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
	$taxoffice=getSettings('soname',$conn);
    $cgtpaid=str_replace( ',', '',$_POST['cgtpaid']);
    // $citpaid=str_replace( ',', '',$_POST['citpaid']);
    $cgttnx=$_POST['cgttnx'];
    // $tprofit=$_POST['tprofit'];
    // $citpen=$_POST['citpen'];
    $cgtpen=$_POST['cgtpen'];
	$approval="pending";
	$userstatus=checkUserstatus2($usersno,$conn);
  	$appby='';
	$appdate='';
    $vatraised=0;
    $inputtax=0;
	// $vatpen=$_POST['vatpen'];
	// $inputtax=str_replace(',','',$_POST['inputtax']);
	// $vatpaid=str_replace(',','',$_POST['vatpaid']);

	 $totpenint=(getSettings('penrate',$conn)+getSettings('intrate',$conn));
	  $tot=$totpenint/100;
	 $cgtrate= $_POST['cgtrate']/100;
	//  $edtrate= getSettings('edtrate',$conn)/100;


	$amtpaid=0;
	$penalty="off";
	$assprofit=($amount+$cgtpaid)/$cgtrate;
	$totalprofit=($amount+$cgtpaid)/$cgtrate;

	// $vatraised=$amount;
	// $totalvat=$amount-$inputtax-$vatpaid;

	// if($taxtype=='VAT'){

	// 	$amtpaid=$vatpaid;
	// 	$amount=$totalvat;
	// 	$penalty=$vatpen;
	// 	$asspage="viewvatass ";

	// }


    if ($cgttnx=="yes"){


		$amtpaid=$cgtpaid;
		$penalty=$cgtpen;

		$assprofit=$cgtrate;

	}else if ($cgttnx=="no"){
		$assprofit=$cgtrate.'_N';
		$totalprofit=$amount;
	}


    $asspage="viewass ";
    $asspage2="capturecgt ";

    if($penalty=='on'){
		$amount2=$amount+($amount*$tot);
	}else{
		$amount2=$amount;
	}

if ($userstatus=="controller"){
	$approval="approved";
	$appby=$suser;
	$appdate=date('d-m-Y');

}
if ($taxtype=="POL"){
	$approval="approved";
	$appby=$suser;
	$appdate=date('d-m-Y');

}

if ($basis=="late registration" && $taxtype=="VAT"){
	$approval="approved";
	$appby=getSettings('tcname',$conn);;
	$appdate=date('d-m-Y');
	$asspage="viewvatass";

}



// $address=str_replace("&"," %26 ",$address);
// $coyname=str_replace("&"," %26 ",$coyname);
if (checkduplicateAdmin($conn,$coytin,$assyr,$taxtype,$assno,$basis,$amount)=="true"){

         $errormsg="DUPLICATION ERROR! This Record Already Exist";

            echo $errormsg;
                            exit();

}


    $query="INSERT INTO adminasreg (tinno,coyname,address,yoa,capdate,taxtype,amount,asmtno,basis,startdate,enddate,user,modified,amtpaid,assprofit,tprofit,penalty,approval,appby,appdate,inputvat,vatamt,irno,taxoffice)VALUES ('$coytin','$coyname','$address','$assyr','$capture','$taxtype','$amount2','$assno','$basis','$startdate','$enddate','$suser','','$amtpaid','$assprofit','$totalprofit','$penalty','$approval','$appby','$appdate','$inputtax','$vatraised','$irno','$taxoffice')";

    $result = mysqli_query($conn,$query);



    if(!$result){

			$errormsg2="Ooops! The Record  was not submitted because of ".mysqli_error($conn);
        echo $errormsg2;
               exit();

		   }

	if ($approval=="approved"){
              	header('Location:'.$asspage.'?data1='.$coytin.'&data2='.str_replace("&"," %26 ",$coyname).'&data3='.str_replace("&"," %26 ",$address).'&data4='.$assyr.'&data5='.$capture.'&data6='.$amount.'&data7='.$basis.'&data8='.$taxtype.'&data9='.$assno.'&data10='.$startdate.'&data11='.$enddate.'&data12='.$amtpaid.'&data13='.$assprofit.'&data14='.$totalprofit.'&data15='.$penalty.'&data16='.$suser.'&data17='.$appby.'&data18='.$inputtax.'&data19='.$vatraised);
   	        exit();
            }else{
		echo " THE ASSESSMENT HAS BEEN SUCCESSFULLY SENT FOR APPROVAL !";
		// $asspage="sendassshow ";
		// header('Location:'.$asspage.'?data1='.$assyr.'&data2='.$basis.'&data3='.$taxtype.'&data4='.$suser);
   	        exit();


	}
       mysqli_close($conn);

?>
