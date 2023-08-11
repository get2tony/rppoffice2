<?php 
    
     
include_once(dirname(__FILE__) . '/dbconfig/config.php');   
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
    $table=$_POST['table'];
    $sno=$_POST['sno'];
    $coytin=$_POST['coytin'];
    $coyname=$_POST['coyname'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $yearend=$_POST['yrend'];
    $assyr=$_POST['yoa'];
    $capture=$_POST['capture'];
    $asstype=$_POST['asstype'];
    $turnover=mysqli_real_escape_string($conn,str_replace( ',', '',$_POST['tover']));
    $cost=mysqli_real_escape_string($conn,str_replace( ',', '',$_POST['cost']));
    $fa=mysqli_real_escape_string($conn,str_replace( ',', '',$_POST['fa']));
    $asspt=mysqli_real_escape_string($conn,str_replace( ',', '',$_POST['aprofit']));
    $topt=mysqli_real_escape_string($conn,str_replace( ',', '',$_POST['tprofit']));
    $cit=mysqli_real_escape_string($conn,str_replace( ',', '',$_POST['cit']));
    $edt=mysqli_real_escape_string($conn,str_replace( ',', '',$_POST['edt']));
    $mintax=$_POST['mintax'];
    $niltax=$_POST['niltax'];
    $asstype=$_POST['asstype'];
    $duedate=$_POST['duedate'];
    $remark=$_POST['remark'];
    $user=$_POST['user'];
    $suser=$_POST['suser'];
    $cgt=$_POST['cgt'];
    $nitd=$_POST['nitd'];
    $paytype=$_POST['paytype'];

    $coytin2=substr($coytin,0,-4);
    $mod=$suser." ".date('d-m-Y h:i:sa');
        
 
    
    $sql="UPDATE $table SET 
    tinno='$coytin',
    coyname='$coyname',
    address='$address',
    yearend='$yearend',
    duedate='$duedate',
    yoa='$assyr',
    assmt_type='$asstype',
    capdate='$capture',
    turnover='$turnover',
    tprofit='$topt',
    aprofit='$asspt',
    cit='$cit',
    edt='$edt',
    mintax='$mintax',
    niltax='$niltax',
    remark='$remark',   
    user='$user',  
    modified='$mod',   
    cgt='$cgt',   
    nitd='$nitd',   
    phone='$phone',   
    paytype='$paytype',
    cost='$cost',
    fa='$fa'   
    WHERE sno=$sno";
    
   if ($conn->query($sql) === TRUE) {
    $msg= "Record updated successfully";
    header('Location:edit?user='.$suser.'&sno='.$sno.'&tab='.$table.'&tin='.$coytin.'&msg='.$msg);
       exit();
} else {
    $msg2= "Error updating record: ";
    header('Location:edit?user='.$suser.'&sno='.$sno.'&tab='.$table.'&tin='.$coytin.'&msg2='.$msg2);
       exit();
}


 mysqli_close($conn);
              	
            	 
   	      
    
?>