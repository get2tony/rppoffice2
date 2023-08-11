<?php 
    
     
include_once(dirname(__FILE__) . '/dbconfig/config.php');
    
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
    include_once('vatmethods.php');
    ///////////////////////////////////////////////////////////



// $coytin="";
// $coyname="";
// $coyadd="";
// $phone="";
// $remark="";
// $category="";
// $capdate="";
// $modify="";


    ////////////////////////////////////////////////////////////
    $coytin=$_POST['coytin'];
    $coyname=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["coyname"]))));
    $address=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["address"]))));
    $phone=$_POST['phone'];
    $remark=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["nob"]))));
    $serial=$_POST['serial'];
    $category=$_POST['cattype'];
    $capdate=$_POST['capture'];
    $usersno=$_POST['usersno'];
    $status=$_POST['status'];
    $s=explode('_',$_POST['user']);
    $suser=$s[0];
    $modify=$suser."_".date("d-m-Y h:i:sa");


    $sql="UPDATE vatlist SET
    `tinno`='$coytin', 
    `coyname`='$coyname',
    `address`='$address', 
    `phone`='$phone', 
    `category`='$category',
    `capdate`='$capdate',
    `capby`='$modify',
    `nob`='$remark'
    WHERE `sno`='$serial'";
    
   if (mysqli_query($conn,$sql)) {
    $msg= 'Record updated successfully';
    header('Location:editvatlist?sno='.$usersno.'&user='.$suser.'&serial='.$serial.'&tin='.$coytin.'&msg='.$msg);
       exit();
} else {
    echo "Error updating record:";
     header('Location:editvatlist?sno='.$usersno.'&user='.$suser.'&serial='.$serial.'&tin='.$coytin.'&msg='.$msg);
       exit();
}


 mysqli_close($conn);
              	
            	 
   	      
    
?>