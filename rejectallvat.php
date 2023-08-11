<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');


$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$table = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : 'adminasreg';
$status = isset($_REQUEST['status']) ? $_REQUEST['status'] : checkUserstatus2($usersno,$conn);
$value='pending';
$catb=isset($_REQUEST['catb']) ? $_REQUEST['catb'] : 'adminasreg';

if($table!='lrps'){  
                  $query="UPDATE $table SET approval='rejected', appdate='".date('d-m-Y')."', appby='".$suser."' WHERE approval LIKE '".$value."'"; 
                  $result=mysqli_query($conn,$query);
      
                   if ($result){
                   	$msg="The Assessments have all been Rejected Successfully !";
    	     
	                  header("Location: tableappvat?catb=".$catb."&sno=".$usersno."&msg=".$msg."&user=".$suser."&status=".$status);
	     	  	
                          }else {
    	
                    $msg2="Sorry! Unable to Reject all the Assessment";
	                header("Location: tableappvat?catb=".$catb."&sno=".$usersno."&msg=".$msg2."&user=".$suser."&status=".$status);
                            
                                }  	  
                                
}else {

                  $catb='lrps';

                  $query="UPDATE lrpcurrent SET approval='rejected', appdate='".date('d-m-Y')."', appby='".$suser."' WHERE approval LIKE '".$value."'"; 
                  $result=mysqli_query($conn,$query);

                  $query2="UPDATE lrpback_year SET approval='rejected', appdate='".date('d-m-Y')."', appby='".$suser."' WHERE approval LIKE '".$value."'"; 
                  $result2=mysqli_query($conn,$query2);
      
                   if ($result || $result2){
                   	$msg="The Assessments have all been Rejected Successfully !";
    	     
	                  header("Location: tableappvat?catb=".$catb."&sno=".$usersno."&msg=".$msg."&user=".$suser."&status=".$status);
	     	  	
                          }else {
    	
                    $msg2="Sorry! Unable to Reject all the Assessment";
	                header("Location: tableappvat?catb=".$catb."&sno=".$usersno."&msg=".$msg2."&user=".$suser."&status=".$status);
                            
                                }  	

}


?>