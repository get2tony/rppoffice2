<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

//$msg="";
$sno=$_POST['sno'];
$officename=$_POST['oname'];
$soffice=$_POST['osname'];
$tcname=$_POST['tcname'];
$rppname=$_POST['rppname'];
$oaddress=$_POST['address'];
$user=$_POST['user'];
$page=$_POST['page'];


$slabel=$_POST['slabel'];
$slabelb=$_POST['slabelb'];
$alabel=$_POST['alabel'];
$alabelb=$_POST['alabelb'];
$citrate=$_POST['citrate'];
$edtrate=$_POST['edtrate'];
$intrate=$_POST['intrate'];
$penrate=$_POST['penrate'];
$vatrate=$_POST['vatrate'];
$modify=$_POST['modifiedby'].' on '.date('d-m-Y');
$whtrate=$_POST['whtrate'];
$lrpint=str_replace(',','',$_POST['lrpint']);
$lrpsub=str_replace(',','',$_POST['lrpsub']);
$lspint=str_replace(',','',$_POST['lspint']);
$lspsub=str_replace(',','',$_POST['lspsub']);
$vatlrp=$_POST['lspapp'];
$citlrp=$_POST['lrpapp'];
$polapp=$_POST['polapp'];




   
if ($officename=="" || $tcname=="" || $oaddress=="" || $rppname==""){
    $error="Please you must fill all the Fields !";
	header("Location: ".$page."?msg=".$error.mysqli_error($conn));
	exit;	
} else {
    
    $sql="UPDATE settings SET 
officename='$officename',
soffice='$soffice',
tcname='$tcname',
rppname='$rppname',
oaddress='$oaddress',
slabel='$slabel',
slabelb='$slabelb',
alabel='$alabel',
alabelb='$alabelb',
citrate='$citrate',
edtrate='$edtrate',
intrate='$intrate',
penrate='$penrate',
vatrate='$vatrate',
modifiedby='$modify',
whtrate='$whtrate',
lrpint='$lrpint',
lrpsub='$lrpsub',
lspint='$lspint',
lspsub='$lspsub',
vatlrp='$vatlrp',
citlrp='$citlrp',
polapp='$polapp'";

        
    $result= mysqli_query($conn,$sql);
}
        if(!$result){  
         $error="Sorry!Your Account was not updated".mysqli_error($conn);
	     header("Location: ".$page."?user=".$user."&msg=".$error);
	     exit;
	     }
       
    	        
    	$error="The Settings has been Updated Successfully by".$modify;
    	header("Location: ".$page."?user=".$user."&msg2=".$error);
    	exit;
    	
    
    
?>