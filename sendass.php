<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');


$sno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$usersno = isset($_REQUEST['usersno']) ? $_REQUEST['usersno'] : null;
$tinno = isset($_REQUEST['tin']) ? $_REQUEST['tin'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$status = isset($_REQUEST['status']) ? $_REQUEST['status'] : checkUserstatus2($usersno,$conn);
$table = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
$catb = isset($_REQUEST['catb']) ? $_REQUEST['catb'] : 'adminasreg';


if ($usersno==null || $usersno=='') {
    $status=getuserlevel($suser,$conn);   
}

if (checkUserdept($usersno,$conn)=='rpp'|| $status=='user') {
    $page='tableapp';
   
}else{
    $page='tableappvat';
}

$query="UPDATE $table SET approval='pending', appdate='".date('d-m-Y')."', appby='".$suser."' WHERE sno LIKE '".$sno."' && tinno LIKE '".$tinno."'"; 
$result=mysqli_query($conn,$query);
 
      

                           
    
                   if ($result){
                   $msg="The Assessment has been Resent for Approval Successfully !";

                header("Location: ".$page."?catb=".$catb."&sno=".$usersno."&status=".$status."&user=".$suser."&msg=".$msg);
	     	  	
                          }else {
    	
                    $msg2="Sorry! Unable to Resend the Assessment";
	               header("Location: ".$page."?catb=".$catb."&sno=".$usersno."&msg=".$msg."&user=".$suser."&status=".$status);
                            
                                }  	                                                                                                                    


?>