<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

$sno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$tinno = isset($_REQUEST['tin']) ? $_REQUEST['tin'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['usersno']) ? $_REQUEST['usersno'] : null;
$table = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
$status = isset($_REQUEST['status']) ? $_REQUEST['status'] : null;


$query="UPDATE $table SET approval='discharged', appdate='".date('d-m-Y')."', appby='".$suser."' WHERE sno LIKE '".$sno."' && tinno LIKE '".$tinno."'"; 
$result=mysqli_query($conn,$query);
      

                           
    
                   if ($result){
                   	$msg="The Assessment has been Discharged Successfully !";
    	     
	                  header("Location: tablesdisgov?sno=".$usersno."&msg=".$msg."&user=".$suser."&status=".$status);
	     	  	
                          }else {
    	
                    $msg2="Sorry! Unable to Discharge the Assessment";
	                header("Location: tablesdisgov?sno=".$usersno."&msg=".$msg2."&user=".$suser."&status=".$status);
                            
                                }  	                                                                                                                    


?>