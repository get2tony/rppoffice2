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

    
if($yearend!="July" && $yearend!="August" && $yearend!="September" && $yearend!="October" && $yearend!="November" && $yearend!="December"){
        $yrendyoa=$assyr-1;
}else{
           $yrendyoa=$assyr;
       }

    $duedate=getDuedate($yearend,$yrendyoa);

   $defaultmonth=checkLRP($duedate,$datefiled,$yrendyoa); 
   $amount=number_format(amountLRP(checkLRP($duedate,$datefiled,$yrendyoa),$conn),2);

    
    
    $duedate1=getDueMonth($duedate,$yrendyoa);
    




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
    header('Location:editlrp?usersno='.$usersno.'&sno='.$sno.'&user='.$suser.'&tab='.$table.'&tin='.$coytin.'&due='.$duedate1.'&def='.$defaultmonth.'&amt='.$amount.'&yrend='.$yearend.'&msg='.$msg);
       exit();
} else {
    $msg2= "Error updating record: ";
    header('Location:editlrp?usersno='.$usersno.'&sno='.$sno.'&user='.$suser.'&tab='.$table.'&tin='.$coytin.'&yrend='.$yearend.'&msg2='.$msg2);
       exit();
}


 mysqli_close($conn);
              	
            	 
   	      
    
?>