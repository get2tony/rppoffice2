<?php    
include_once(dirname(__FILE__) . '/dbconfig/config.php');  
include_once(dirname(__FILE__) . '/dbconfig/methods.php');

    $coytin="";
    $table="";
    $sno="";
    $suser='';
    $usersno='';
    $ustatus='';
    
    $table=$_POST['table'];
    $sno=$_POST['sno'];
    $coytin=$_POST['tin'];
    $suser=$_POST['user'];
    $usersno=$_POST['usersno'];
    $ustatus=$_POST['status'];

   //   $cont=assDelete($sno,$table,$coytin,$suser,$conn);
 
    
   //  if($cont===true){
    $sql="DELETE FROM $table WHERE 
    `tinno`='$coytin' && `sno`='$sno'";
   //  }
    
   if ($conn->query($sql) === TRUE) {
    $msg= "Record Deleted successfully";
    header('Location:deleteshowass2?sno='.$usersno.'&user='.$suser.'&msg='.$msg.'&status='.$ustatus);
       exit();
   } else {
    $msg2= "Error Deleting record: ".mysqli_error($conn);
    header('Location:deleteshowass2?sno='.$usersno.'&user='.$suser.'&msg2='.$msg2.'&status='.$ustatus);
       exit();
}


 mysqli_close($conn);
              	
            	 
   	      
    
?>