<?php 
    
     
include_once(dirname(__FILE__) . '/dbconfig/config.php');
    
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
    include_once('vatmethods.php');
    ///////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////
    $coytin=$_POST['coytin'];
    
    $tab=$_POST['tab'];
    $capture=$_POST['capture'];
    
    $cattype=$_POST['cattype'];
    
    $basis=$_POST['basis'];
    
    $table='vatreg';
    $serial=$_POST['serial'];

    $suser=$_POST['user'];
	$usersno=$_POST['usersno'];
	$irno=checkUserirno($usersno,$conn);
    
    $modify=$suser." ".date("d-m-Y h:i:sa");

     $cont=selfDeletevat($serial,$table,$coytin,$suser,$conn);
    
     if($cont===true){
    
    $sql="DELETE FROM vatreg WHERE 
    `tinno`='$coytin' && `sno`='$serial' && `capdate`='$capture' && `category`='$cattype' && `basis`='$basis'";
     }
   if ($conn->query($sql) === TRUE){
    $msg= 'Record Deleted successfully';
    header('Location:tablevat?sno='.$usersno.'&user='.$suser.'&tab='.$tab.'&msg='.$msg);
       exit();
} else {
    echo "Error Deleting record:";
     header('Location:tablevat?sno='.$usersno.'&user='.$suser.'&tab='.$tab.'&msg='.$msg);
       exit();
}


 mysqli_close($conn);
              	
            	 
   	      
    
?>