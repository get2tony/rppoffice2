<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$table = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : 'adminasreg';
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$value='pending';
$status = isset($_REQUEST['status']) ? $_REQUEST['status'] : checkUserstatus2($usersno,$conn);
$catb=isset($_REQUEST['catb']) ? $_REQUEST['catb'] : 'adminasreg';


if($table!='lrps'){
$query="UPDATE $table SET approval='approved', appdate='".date('d-m-Y')."', appby='".$suser."' WHERE approval LIKE '".$value."'"; 
$result=mysqli_query($conn,$query);
                         
    
                   if ($result){
                   	$msg="The Assessments have all been Approved Successfully !";
    	     
	                  header("Location: tableappvat?catb=".$catb."&sno=".$usersno."&msg=".$msg."&user=".$suser."&status=".$status);
	     	  	
                          }else {
    	
                    $msg2="Sorry! Unable to Approve all the Assessment";
	                header("Location: tableappvat?catb=".$catb."&sno=".$usersno."&msg=".$msg2."&user=".$suser."&status=".$status);
                            
                                }  	 
}else {

$query="UPDATE lrpcurrent SET approval='approved', appdate='".date('d-m-Y')."', appby='".$suser."' WHERE approval LIKE '".$value."'"; 
$result=mysqli_query($conn,$query);
$query2="UPDATE lrpback_year SET approval='approved', appdate='".date('d-m-Y')."', appby='".$suser."' WHERE approval LIKE '".$value."'"; 
$result2=mysqli_query($conn,$query2);
                         
    
                   if ($result || $result2){
                   	$msg="The Assessments have all been Approved Successfully !";
    	     
	                  header("Location: tableappvat?catb=".$catb."&sno=".$usersno."&msg=".$msg."&user=".$suser."&status=".$status);
	     	  	
                          }else {
    	
                    $msg2="Sorry! Unable to Approve all the Assessment";
	                header("Location: tableappvat?catb=".$catb."&sno=".$usersno."&msg=".$msg2."&user=".$suser."&status=".$status);
                            
                                }  	 
}                                                                                                                   


?>