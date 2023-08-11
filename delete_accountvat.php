<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

$tinno1 = isset($_REQUEST['serial']) ? $_REQUEST['serial'] : null;
$sno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;





$query="DELETE FROM rppusers WHERE sno='".$tinno1."'"; 
$result=mysqli_query($conn,$query);
      

                           
    
                   if ($result){
                   	$msg="The Account has been deleted";
    	     
	                  header("Location: view_accountsvat?sno=".$sno."&msg=".$msg);
	     	  	
                          }else {
    	
                    $error="Oops! Problem Deleting the Account";
	                header("Location: view_accountsvat?sno=".$sno."&msg2=".$error);
                            
                                }  	                                                                                                                    


?>