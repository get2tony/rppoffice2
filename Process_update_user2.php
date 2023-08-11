<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

//$msg="";
$sno=$_POST['sno'];

$passw = $_POST['pass1'];

$datecr=$_POST['date'];
$cruser=$_POST['user'];
$usersno=$_POST['usersno'];
$level=$_POST['level'];
$status=$_POST['status'];
$dept=$_POST['dept'];
$irno=$_POST['irno'];






   
if ($passw==""){
    $error="Please you must enter a Password !";
	header("Location: update_account2?msg=".$error.mysqli_error($conn));
	exit;	
} else {
    
    $sql="UPDATE rppusers SET 
    pword='$passw',
    datecreate='$datecr',
    createby='$cruser',
    level='$level',
    approved='$status',
    dept='$dept',
    irno='$irno'
    WHERE sno=$sno";
        
    $result= mysqli_query($conn,$sql);
}
        if(!$result){  
         $error="Sorry!Your Account was not updated".mysqli_error($conn);
	     header("Location: update_account2?sno=".$usersno."&serial=".$sno."&user=".$user."&msg=".$error);
	     exit;
	     }
       
    	        
    	$error="Your Account has been Updated Successfully";
    	header("Location: update_account2?sno=".$usersno."&serial=".$sno."&user=".$user."&msg2=".$error);
    	exit;
    	
    
    
?>