<?php 
    
     
include_once(dirname(__FILE__) . '/dbconfig/config.php');
    
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
    include_once('vatmethods.php');
    ///////////////////////////////////////////////////////////


    $coytin="";
    $coyname="";
     $address="";
    $month="";
    $assyr="";
    $capture="";
    $taxtype="";
    $cattype="";
    $amount="";
    $duedate="";
    $basis="";
    $default="";
    $paydate="";
    $nob="";
    $phone="";
    $serial="";

    $suser="";
	$usersno="";
	$irno="";

    ////////////////////////////////////////////////////////////
    $coytin=$_POST['coytin'];
    $coyname=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["coyname"]))));
    $address=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["address"]))));
    $month=$_POST['yrendm'];
    $assyr=$_POST['yryoa'];
    $capture=$_POST['capture'];
    $taxtype=$_POST['ttype'];
    $cattype=$_POST['cattype'];
    $amount=str_replace( ',', '',$_POST['amount']);
    $duedate=$_POST['duedate'];
    $basis=$_POST['basis'];
    $default=$_POST['daylate'];
    if ($default<1) {
        $default=0;
    }
    $paydate=$_POST['paydate'];
    $nob=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["nob"]))));
    $phone=$_POST['phone'];
    $serial=$_POST['serial'];

    $suser=$_POST['user'];
	$usersno=$_POST['usersno'];
	$irno=checkUserirno($usersno,$conn);
    
    $modify=$suser." ".date("d-m-Y h:i:sa");

if (isVATinlist($conn,$coytin,$cattype)=="true"){
                            
       $query="UPDATE vatlist SET coyname = '$coyname', `address` = '$address', phone='$phone', nob='$nob',category='$cattype',capdate='$capture',capby='$suser' WHERE tinno like '$coytin'";
           $result = mysqli_query($conn,$query);
           if(!$result){
         $errormsg2="Oops! Could Not Update Record in VAT list in doeditvatreg".mysqli_error($conn);
             echo $errormsg2;
               exit();
            }else {
         
            }                  
}


    $sql="UPDATE vatreg SET
    `tinno`='$coytin', 
    `coyname`='$coyname',
    `address`='$address', 
    `phone`='$phone', 
    `basis`='$basis',
    `category`='$cattype',
    `month`='$month',
    `yoa`='$assyr',
    `amount`='$amount',
    `capdate`='$capture',
    `paydate`='$paydate',
    `defaultdays`='$default',
    `modified`='$modify',
    `remark`='$nob'
    WHERE `sno`='$serial'";
    
   if (mysqli_query($conn,$sql)) {
    $msg= 'Record updated successfully';
    header('Location:editvatreg?sno='.$usersno.'&user='.$suser.'&serial='.$serial.'&tin='.$coytin.'&msg='.$msg);
       exit();
} else {
    echo "Error updating record:";
     header('Location:editvatreg?sno='.$usersno.'&user='.$suser.'&serial='.$serial.'&tin='.$coytin.'&msg='.$msg);
       exit();
}


 mysqli_close($conn);
              	
            	 
   	      
    
?>