<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

//$msg="";
$sno=$_POST['sno'];
$username = $_POST['uname'];
$passw = $_POST['pass1'];
$fname =ucfirst ($_POST['fname']);
$sname =ucfirst ($_POST['sname']);
$datecr=$_POST['date'];
$cruser=$_POST['user'];
$dept=$_POST['dept'];
$irno=$_POST['irno'];



   
if ($username=="" || $passw=="" || $fname=="" || $sname==""){
    $error="Please you must fill all the Fields !";
	header("Location: update_account?msg=".$error.mysqli_error($conn));
	exit;	
} else {
    
    $sql="UPDATE rppusers SET 
    username='$username',
    pword='$passw',
    name='$fname',
    surname='$sname',
    datecreate='$datecr',
    createby='$cruser',
    dept='$dept',
    irno='$irno'
    WHERE sno=$sno";
        
    $result= mysqli_query($conn,$sql);
}
        if(!$result){  
         $error="Sorry!Your Account was not updated".mysqli_error($conn);
	     header("Location: update_account?sno=".$sno."&msg=".$error);
	     exit;
	     }
       
    	        
    	$error="Your Account has been Updated Successfully";
    	header("Location: update_account?sno=".$sno."&msg2=".$error);
    	exit;
    	
    
    
?>