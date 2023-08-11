<?php 
    
     
include_once(dirname(__FILE__) . '/dbconfig/config.php');
    
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
    $table=$_POST['table'];
    $sno=$_POST['sno'];
    $coytin=$_POST['coytin'];
    $coyname=$_POST['coyname'];
    $address=$_POST['address'];
    $yearend=$_POST['yrendm'];
    $assyr=$_POST['yoa'];
    $datefiled=$_POST['date'];
    $fuser=$_POST['fuser'];
    $suser=$_POST['user'];
    $usersno=$_POST['usersno'];
    

//$duedate=getDuedatevat($yearend,$yoa);
    $duedate=getDuedatevat($yearend,$assyr);

	//$showmonths=checkLRPvat($duedate,$datecap);  
//	$showLRPdue=number_format(amountLRPvat($showmonths),2);

   $defaultmonth=checkLRPvat($duedate,$datefiled); 
   $amount=number_format(amountLRPvat($defaultmonth,$conn),2);

    
    
    $duedate1=getDueMonthvat($duedate);
    




    $coytin2=substr($coytin,0,-4);

    if($defaultmonth<1){
      $defaultmonth='0'  ;
    }
 
    
    $sql="UPDATE $table SET 
    tinno='$coytin',
    coyname='$coyname',
    address='$address',
    yoa='$assyr',
    yearend='$yearend',
	capdate='$datefiled',
    duedate='$duedate1',
    datefiled='$datefiled',
    amount='$amount',
    DefaultMonth='$defaultmonth',
    user='$fuser',
    modified='$suser'
    WHERE sno='$sno'";
    
   if ($conn->query($sql) === TRUE) {
    $msg= "Record updated successfully ! ";
    header('Location:editlrpvat?usersno='.$usersno.'&sno='.$sno.'&user='.$suser.'&tab='.$table.'&tin='.$coytin.'&due='.$duedate1.'&def='.$defaultmonth.'&amt='.$amount.'&yrend='.$yearend.'&msg='.$msg);
       exit();
} else {
    $msg2= "Error updating record: ";
    header('Location:editlrpvat?usersno='.$usersno.'&sno='.$sno.'&user='.$suser.'&tab='.$table.'&tin='.$coytin.'&yrend='.$yearend.'&msg2='.$msg2);
       exit();
}


 mysqli_close($conn);
              	
            	 
   	      
    
?>