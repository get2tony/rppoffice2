<?php 
    
     
include_once(dirname(__FILE__) . '/dbconfig/config.php');
    
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
    include_once('vatmethods.php');

    
    $coytin=$_POST['coytin'];
    $coyname=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["coyname"]))));
    $address=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["address"]))));
    
    $capture=$_POST['capture'];
    $taxoffice=getSettings('soname',$conn);
    $cattype=$_POST['cattype'];
    
    $nob=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($_POST["nob"]))));
    
    $phone=$_POST['phone'];

    $suser=$_POST['user'];
	$usersno=$_POST['usersno'];
	// $irno=checkUserirno($usersno,$conn);
	// $userstatus=checkUserstatus2($usersno,$conn);



if (isVATinlist($conn,$coytin,$cattype)=='true'){
                            
       $query="UPDATE vatlist SET coyname = '$coyname', `address` = '$address', phone='$phone', nob='$nob',category='$cattype',capdate='$capture',capby='$suser' WHERE tinno like '$coytin'";
        $result = mysqli_query($conn,$query);
        
           if(!$result){
                $errormsg2="Oops! Could Not Update Record in VAT list ".mysqli_error($conn);
                echo $errormsg2;
               exit();
            }else {

            $msg="Record Already Exists but Info has been Updated";
             header('Location:addvatlist?sno='.$usersno.'&user='.$suser.'&msg='.$msg);
               exit();
            }                  
}else {
    $query="INSERT INTO vatlist (tinno,coyname,`address`,phone,nob,category,capdate,capby,taxoffice) VALUES ('$coytin','$coyname','$address','$phone','$nob','$cattype','$capture','$suser','$taxoffice')";
     $result = mysqli_query($conn,$query);
     if(!$result){
         $errormsg2="Oops! Could Not capture Record in VAT list ".mysqli_error($conn);
        echo $errormsg2;
               exit();
     }else {
              $msg="Record has been Captured Successfully !";
             header('Location:addvatlist?sno='.$usersno.'&user='.$suser.'&msg='.$msg);
               exit();
     }
}
 mysqli_close($conn);
    
?>