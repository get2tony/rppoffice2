<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');



//$msg="";
$username= $_POST['uname'];
$passw = $_POST['pass1'];
$passw2 = $_POST['pass2'];
$fsname =ucfirst ($_POST['fname']);
$suname =ucfirst ($_POST['sname']);
$datecr=$_POST['date'];
$cruser=$_POST['crby'];
$dept=$_POST['dept'];
$level="admin";
$checked="yes";
$approved="yes";
//echo $user. $passw;
$taxoffice=getSettings('soname',$conn);

//echo $user. $passw.$fname. $passw2.$sname.$level;
   
   if ($username==""|| $passw=="" || $passw2=="" || $fsname=="" || $suname==""){
    	
    	
             $error="Please you must fill all the Fields !".$user;
	                 header("Location: create_admin_staff?msg=".$error);
	             exit;	
       
       
    }else if ($passw == $passw2){
    	$query="INSERT INTO rppusers (username,pword,level,name,surname,checked,datecreate,createby,approved,dept,taxoffice) VALUES ('$username','$passw','$level','$fsname','$suname','$checked','$datecr','$cruser','$approved','$dept',$taxoffice) ";
       
    	$result= mysqli_query($conn,$query);
       
       if(!$result){
                    $error="The User was not created".mysqli_error($conn);
	                  header("Location: create_admin_staff?msg=".$error);
	                   exit;
	     }
    	$error="An Administrator Account has been created Successfully";
    	header("Location: create_admin_staff?msg2=".$error);
    	exit;
    	          
    }else{
    	
    	$error="The Passwords do not match!";
    	header("Location: create_admin_staff?msg=".$error);
    	exit;
    }
        
         
         
    
    
?>