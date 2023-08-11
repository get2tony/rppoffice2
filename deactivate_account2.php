<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

$sno = isset($_REQUEST['serial']) ? $_REQUEST['serial'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;


$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;


$query="UPDATE rppusers SET approved='no', datecreate='".date('d-m-Y')."', createby='".$suser."' WHERE sno='".$sno."' "; 
$result=mysqli_query($conn,$query);
      

                           
    
                   if ($result){
                   	$msg="The Account has been Deactivated";
    	     
	                  header("Location: view_accountsvat?sno=".$usersno."&user=".$suser."&msg=".$msg);
	     	  	
                          }else {
    	
                    $error="Sorry! Unable to Deactivate the Account";
	                header("Location: view_accountsvat?sno=".$usersno."&user=".$suser."&msg2=".$error);
                            
                                }  	                                                                                                                    


?>