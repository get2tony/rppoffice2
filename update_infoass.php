<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once('vatmethods.php');

$sno = isset($_REQUEST['serial']) ? $_REQUEST['serial'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$suser =isset($_REQUEST['suser']) ? $_REQUEST['suser'] : null;
$user = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;

$irno=checkUserirno($sno,$conn);

   

    // $sql1="UPDATE adminasreg SET irno='".$irno."' WHERE user like '%".$suser;
    $sql1="UPDATE adminasreg SET `irno` = '".$irno."' WHERE `user` like '%".$user."'";
    $sql2="UPDATE back_year SET `irno` = '".$irno."' WHERE `user` like '%".$user."'";
    $sql3="UPDATE current SET `irno` = '".$irno."' WHERE `user` like '%".$user."'";
    $sql4="UPDATE lrpback_year SET `irno` = '".$irno."' WHERE `user` like '%".$user."'";
    $sql5="UPDATE lrpcurrent SET `irno` = '".$irno."' WHERE `user` like '%".$user."'";
    // $sql2="UPDATE back_year SET irno='".$irno."' WHERE user like '%".$suser;
    // $sql3="UPDATE current SET irno='".$irno."' WHERE user like '%".$suser;
    // $sql4="UPDATE lrpback_year SET irno='".$irno."' WHERE user like '%".$suser;
    // $sql5="UPDATE lrpcurrent SET irno='".$irno."' WHERE user like '%".$suser;
    
        
    $result1= mysqli_query($conn,$sql1);
    $result2= mysqli_query($conn,$sql2);
    $result3= mysqli_query($conn,$sql3);
    $result4= mysqli_query($conn,$sql4);
    $result5= mysqli_query($conn,$sql5);

        if(!$result1 || !$result2 || !$result3 || !$result4 || !$result5 ){  
         $error="Sorry!The Records were not all updated".mysqli_error($conn);
	     header("Location: view_accountsall?user=".$suser."&sno=".$usersno."&msg=".$error);
	     exit;
	     }
       
    	        
    	$error="The User Records has been Updated Successfully";
	     header("Location: view_accountsall?user=".$suser."&sno=".$usersno."&msg=".$error);
    	exit;
    	
    
    
?>