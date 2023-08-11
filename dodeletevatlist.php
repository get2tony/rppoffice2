<?php 
    
     
include_once(dirname(__FILE__) . '/dbconfig/config.php');
    
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
    include_once('vatmethods.php');
    ///////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////
    $coytin=$_POST['coytin'];
    $capture=$_POST['capture'];
    $cattype=$_POST['cattype'];
    $serial=$_POST['serial'];
    $suser=$_POST['user'];
	$usersno=$_POST['usersno'];
	//$irno=checkUserirno($usersno,$conn);
    $table='vatlist';
    //$modify=$suser." ".date("d-m-Y h:i:sa");
$cont=selfDeletevat($serial,$table,$coytin,$suser,$conn);
    
     if($cont===true){
    
   

    $sql="DELETE FROM vatlist WHERE 
    `tinno`='$coytin' && `sno`='$serial' && `capdate`='$capture' && `category`='$cattype'";
     }
    
   if ($conn->query($sql) === TRUE){
    $msg= 'Record Deleted successfully';
    header('Location:tablevatlist?sno='.$usersno.'&user='.$suser.'&msg='.$msg);
       exit();
} else {
    echo "Error Deleting record:";
     header('Location:tablevatlist?sno='.$usersno.'&user='.$suser.'&msg='.$msg);
       exit();
}


 mysqli_close($conn);
              	
            	 
   	      
    
?>