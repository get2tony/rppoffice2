<?php 
    
     
include_once(dirname(__FILE__) . '/dbconfig/config.php');
    
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
    $coytin="";
    $table="";
    $sno="";


    $table=$_POST['table'];
    $sno=$_POST['sno'];
    $coytin=$_POST['tin'];
    $suser=$_POST['user'];
    

   $cont=LRPDelete($sno,$table,$coytin,$suser,$conn);
 
    if($cont===true){
    $sql="DELETE FROM $table WHERE 
    `tinno`='$coytin' && `sno`='$sno'";
    }
   if ($conn->query($sql) === TRUE) {
    $msg= "Record Deleted successfully";
    header('Location:deleteshowlrp?user='.$suser.'&msg='.$msg);
       exit();
   } else {
    $msg2= "Error Deleting record: ".mysqli_error($conn);
    header('Location:deleteshowlrp?user='.$suser.'&msg2='.$msg2);
       exit();
}


 mysqli_close($conn);
              	
            	 
   	      
    
?>