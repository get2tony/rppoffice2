<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

//$msg="";
$username = $_POST['uname'];
$irno = $_POST['irno'];
$passw = $_POST['pass1'];
$passw2 = $_POST['pass2'];
$fname = ucfirst ($_POST['fname']);
$sname = ucfirst ($_POST['sname']);
$datecr=$_POST['date'];
$cruser=$_POST['crby'];
$dept=$_POST['dept'];
$level="user";
$checked="yes";
$approved="no";
//echo $user. $passw;
$taxoffice=getSettings('soname',$conn);


   
if ($username=="" || $passw=="" || $passw2=="" || $fname=="" || $sname==""){
    $error="Please you must fill all the Fields !";
	header("Location: signup?msg=".$error.mysqli_error($conn));
	exit;	
} else if ($passw == $passw2){
    
    	$query="INSERT INTO rppusers (username,pword,level,name,surname,checked,datecreate,createby,approved,dept,irno,taxoffice) VALUES ('$username','$passw','$level','$fname','$sname','$checked','$datecr','$cruser','$approved','$dept','$irno','$taxoffice') ";
        
        $result= mysqli_query($conn,$query);
        
        if(!$result){  
         $error="Your User Account was not created".mysqli_error($conn);
	     header("Location: signup?msg=".$error);
	     exit;
	     }
       
    	        
    	$error="Your User Account has been created Successfully";
    	header("Location: signup?msg2=".$error);
    	exit;
    	
    }else{
    	
    	$error="Your Passwords do not match!";
    	header("Location: signup?msg=".$error);
    	exit;
    }
        
        
         
       
    
?>