<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');

$sno = isset($_REQUEST['serial']) ? $_REQUEST['serial'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;

$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$page='view_accounts';
$level=checkUserstatus2($usersno,$conn);

$query="UPDATE rppusers SET approved='yes', datecreate='".date('d-m-Y')."', createby='".$suser."' WHERE sno='".$sno."' "; 
$result=mysqli_query($conn,$query);
      
if ($level=='master') {
     $page='view_accountsall';
}
                           
 if ($level=='controller') { 
      $page='view_accountstc';  
 }
                   if ($result){
                   	$msg="The Account has been Activated";
    	     
	                  header("Location: ".$page."?sno=".$usersno."&user=".$suser."&msg=".$msg);
	     	  	
                          }else {
    	
                    $error="Sorry! Unable to Activate the Account";
	                header("Location: ".$page."?sno=".$usersno."&user=".$suser."&msg2=".$error);
                            
                                }  	                                                                                                                    


?>