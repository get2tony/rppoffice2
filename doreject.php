<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

$sno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$tinno = isset($_REQUEST['tin']) ? $_REQUEST['tin'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$table = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
$status = isset($_REQUEST['status']) ? $_REQUEST['status'] : null;
$catb = isset($_REQUEST['catb']) ? $_REQUEST['catb'] : 'adminasreg';


$query="UPDATE $table SET approval='rejected', appdate='".date('d-m-Y')."', appby='".$suser."' WHERE sno LIKE '".$sno."' && tinno LIKE '".$tinno."'"; 
$result=mysqli_query($conn,$query);
      

                           
    
                   if ($result){
                   	$msg="The Assessment has been Rejected Successfully !";
    	     
	                  header("Location: tableapp?catb=".$catb."&msg=".$msg."&user=".$suser."&status=".$status);
	     	  	
                          }else {
    	
                    $msg2="Sorry! Unable to Reject the Assessment";
	                header("Location: tableapp?catb=".$catb."&msg=".$msg2."&user=".$suser."&status=".$status);
                            
                                }  	                                                                                                                    


?>