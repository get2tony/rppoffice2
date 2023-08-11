<?php 
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
    $table=$_POST['table'];
    $sno=$_POST['sno'];

    $coytin=$_POST['coytin'];
    $coyname=$_POST['coyname'];
    $address=$_POST['address'];
    $assyr=$_POST['yoa'];
    $capture=$_POST['capture'];
    $taxtype=$_POST['ttype'];
    $amount=str_replace( ',', '',mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', $_POST["amount"]))));
	$amtpaid=str_replace( ',', '',mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', $_POST["amtpaid"]))));
	$assprofit=str_replace( ',', '',mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', $_POST["assprofit"]))));
	$tprofit=str_replace( ',', '',mysqli_real_escape_string($conn,str_replace( ',', '',preg_replace('/\s+/', '', $_POST["tprofit"]))));
    $assno=$_POST['asno'];
    $basis=$_POST['basis'];
    $startdate=$_POST['startdate'];
    $enddate=$_POST['enddate'];
    $user=$_POST['user'];
    $suser=$_POST['suser'];
    $usersno=$_POST['usersno'];

    $amtraised=str_replace(',','',$_POST['vatraised'] ? $_POST['vatraised']:0);
    $pen=$_POST['penalty'];
    $inputvat=str_replace(',','',$_POST['inputvat'] ? $_POST['inputvat']:0);
    $rate=getSettings('intrate',$conn)+getSettings('penrate',$conn);
    $citrate=getSettings('citrate',$conn);
    $edtrate=getSettings('edtrate',$conn);

    $coytin2=substr($coytin,0,-4);
    $mod=$suser." ".date('d-m-Y h:i:sa');

     $editpage='editass';

     if ($pen=='on') {

        $penal=$amount*($rate/(100+$rate));
        $amt=$amount-$penal;
        
    }else {
        $amt=$amount;
    }
     
    if ($taxtype=='POL') {
        $assprofit=$amount;
	    $tprofit=$amount;
    }
    if ($taxtype=='WHT') {
        
        if( strpos( $assprofit,"_N" ) !== false) {
        //$asprofit=chop('$assprofit','_N');
        $tprofit=$amount;
        }else{

            $tprofit=($amt+$amtpaid)/$assprofit;
        }

	    
    }

    if ($taxtype=='CIT') {

        $tprofit=($amt+$amtpaid)/($citrate/100);
        
        # code...
    }
    if ($taxtype=='EDT') {

        $assprofit=($amt+$amtpaid)/($edtrate/100);
        # code...
    }

	if($taxtype=='VAT'){
		$editpage='editvatass';
		$amount= ResolveVat($amtraised,$amtpaid,$inputvat,$pen);
	}
    
    $sql="UPDATE $table SET 
    tinno='$coytin',
    coyname='$coyname',
    address='$address',
    yoa='$assyr',
    taxtype='$taxtype',
    capdate='$capture',
    amount='$amount',
    asmtno='$assno',
    basis='$basis',
    startdate='$startdate',
    enddate='$enddate',
    user='$user',  
    modified='$mod',
    amtpaid='$amtpaid',
    assprofit='$assprofit',
    tprofit='$tprofit',
    inputvat='$inputvat',
    vatamt='$amtraised'
    WHERE sno='$sno'";
    
   if ($conn->query($sql) === TRUE) {
    $msg= "Record updated successfully";
    header('Location:'.$editpage.'?usersno='.$usersno.'&user='.$suser.'&sno='.$sno.'&tab='.$table.'&tin='.$coytin.'&msg='.$msg);
       exit();
} else {
    echo "Error updating record:";
    header('Location:'.$editpage.'?usersno='.$usersno.'&user='.$suser.'&sno='.$sno.'&tab='.$table.'&tin='.$coytin.'&msg2='.$msg2);
       exit();
}


 mysqli_close($conn);
              	
            	 
   	      
    
?>