<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

//$msg="";
$user = $_POST['username'];
$passw = $_POST['password'];
$page="";

//echo $user. $passw;
$query="SELECT * FROM rppusers WHERE username='$user' AND pword='$passw'"; 

$result = mysqli_query($conn,$query);
while ($row = mysqli_fetch_array($result)){
    $sno=$row[0];
	$username= $row[1];
	$password= $row[2];
	$level=$row[3];
	$suser=$row[4]." ".$row[5];
    $approved=$row[9];
    $dept=$row[10];
    
    
	session_start();
	$_SESSION["username"]="$username";
    $_SESSION["password"]="$password";
    $_SESSION['suser']="$suser";

   
   
 

}




    if ($user=="" || $passw==""){
    $error="Can not submit empty fields !";
	header("Location: index?msg=".$error);
	exit;	
    }
    
	$token=rand(10000000000000,3400000000000000);

    
            
    if ($username==$user && $password== $passw && $approved=='yes' ){
        $tokenid=$sno."-".$token;
        if ( $level=='master'){
            $page="home2";
      
            }
		
		
		 if ($level=='admin' && $dept=='rpp'){
             $page="home2";
            }
		
		if ($level=='admin' && $dept=='vat'){
             $page="homevat2";
            }
		
		
        if ($level=='user' && $dept=='rpp'){
            $page="home";
	        //    header("Location: home?tokenid=".$sno."-".$token);  
            }
		if ($level=='user' && $dept=='vat'){
            $page="homevat"; 
            }
		
		if ($level=='controller'){
            $page="home3";
            }
        
    }else if ($approved=='no'){
        
        $error="Sorry ! Account not Activated by Admin";
        header("Location: index?msg=".$error);
        exit;
    }else{
        
        $error="Invalid username or Password";
        header("Location: index?msg=".$error);
        exit;
        
    }
     ?>   
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
    </head>
    <body onload="dosub()">
         <form id="myform" method="POST" action="<?php echo $page?>">
        
     <input type="hidden" value="<?php echo $page?>"  id="page"/>
     <input type="hidden" value="<?php echo $sno?>"  id="sno" name="sno"/>
     <input type="hidden" value="<?php  echo $tokenid?>"  id="token" name="tokenid"/>
    <!-- <input type="button" id=""> -->
    </form>

     <script type="text/javascript" src="js3/jquery-1.12.4.js"></script>
     <script>
     function dosub() {
      var p=document.getElementById('page').value;
      if(p===""){

      }else{
        document.getElementById('myform').submit(); 
      }
         
     }
     
     </script>
    </body>
    </html>    
