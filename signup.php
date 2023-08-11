<?php

$errormsg='';
$errormsg2='';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$suser = "Sign up page";

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FIRS RPP Office Assistant App</title>
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="css3/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="tiltbox.css"> -->
	
	<style>
		body,table{
			clear: both;
			margin: 0;
			padding: 0;
			display: block;
			
}
		
#getit{
			display:block;
			position:absolute;
			left:480px;
			top: 5px;
			z-index:1;

}
#leftside {
	background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
	background-size: 400% 400%;
	animation: gradient 15s ease infinite;
}

@keyframes gradient {
	0% {
		background-position: 0% 50%;
	}
	50% {
		background-position: 100% 50%;
	}
	100% {
		background-position: 0% 50%;
	}
}
		
#leftside{
			
			display: block;
			width: 30%;
			top: 0px;
			height: 100%;
			position: absolute;
			overflow:auto;	
			/* background-image:linear-gradient(#00b09b, #191654); */
}




		#rightside{
			display:block;
			width: 60%;
			height: 100%;
			background-color:white;
			position: absolute;
			left: 512px;
/*			background-image: linear-gradient(#00b09b, #96c93d);*/
			
		}
		#toplogo{
			display: block;
			height: 220px;
		}
		
		#footy1{
            color: darkgray;
            /* margin: auto; */
            position: relative;
			left: 200px;
			top: 300px;
			
		}
		#applogo{
			
			width: 150px;
			height: 100%;
		}
		#logo{
			opacity: 0.6;
			position: absolute;
			top: 45%;
			left: 50%;
			height: 182px;
			width: 312px;
			margin-top: -91px;/*  half the height*/
			margin-left: -156px;
		}
		#screen{
			height:auto;
			padding:10px;
			position:relative;
			border-radius:15px;
			

		}
	
	</style>
</head>
<body>
  <div class="container-fluid">
	<div class="row">
		<div class="container col-lg-6" id="leftside">
			<div class="row" id="logo">	<img src="img/lizardlogo.png" alt=""></div>
		</div>
	<div class="col-lg-6" id="rightside">
		<div class="panel "><H2>Sign Up as an 
			Application User </H2><br><br></div>
			<img id="getit" src="img/logo.png" alt=""  /><br>
		<div class="row-fluid col-md-6">
		<form  name="returns" action="process_create_user2 " onsubmit="return validateForm()" method="post">
       
     
                <div class="form-group">
                    <label for="coytin">Enter New Username:</label>
                    <input type="text" class="form-control" id="coytin" name="uname" placeholder="Username " >
                </div>
                <div class="form-group">
                    <label for="coyname">Enter New Password:</label>
                    <input type="password" class="form-control" id="coyname"  name="pass1" placeholder="Password">
                </div>

                <div class="form-group">
                    <label for="coyname">Re-type New Password:</label>
                    <input type="password" class="form-control" id="coyname"  name="pass2" placeholder="Password">
                </div>
                                                   
                <div class="form-group">
                    <label for="coyname">Staff First name:</label>
                    <input type="text" class="form-control" id="coyname"  name="fname" placeholder="First Name">
                </div>
                   <div class="form-group">
                    <label for="coyname">Staff Surname:</label>
                    <input type="text" class="form-control" id="coyname"  name="sname" placeholder="Surname">
                </div>
                   
                
                    </div>
		<div>
	
		<div class="row-fluid col-md-6">
			<div class="form-group">
                    <label for="coyname">Staff IR No:</label>
                    <input type="text" class="form-control" id="irno"  name="irno" placeholder="IR No">
                </div>
                   
                   <div class="form-group">
                    <label for="dept">Department:</label>
                    
                       <select name="dept" id="dept">
                           <option value="rpp">RPP</option>
                           <option value="vat">VAT</option>
                           <!-- <option value="other">Others</option> -->
                       </select>
                </div>
                    
                <label for="date">Date Created:</label>
                   <div class="input-group">
                <input id="date" type="text" class="form-control" name="date" placeholder="dd-mm-YYYY" value="<?php  echo date('d-m-Y')   ?>"><span  id="date" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
             <div class="form-group">
                    <label for="coyname"></label>
                    <input type="hidden" class="form-control" id="coyname"  name="crby" placeholder="" value="<?php  echo $suser ?>"/>
                </div>
                    <p></p>
                     <button type="submit" class="btn btn-primary">Create Profile</button>
                    <a href="index " class="btn btn-success">Go Back to Log in </a>
                   <p></p>
                     </form>  
			 <?php
                    
                   if ($errormsg==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg.' </h4> </div>');
                   }
                    
                     if ($errormsg2==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen"><h4>'.$errormsg2.' </h4> </div>');
                   }
                    ?>
		
		</div>
		<div class="col-sm-9"><span id="footy1">Copyright © 2018-<?php echo date('Y');?> Designed by Damidami Tony, Sunday IR 20956, Tel: 07061823474</span> </div>
	</div> 
		
		<!-- <script src="vanilla-tilt.min.js"></script> -->
	  <script src="js3/jquery-1.12.0.min.js"></script>
   	 <script type="text/javascript">
	
function getDaycolor(){
var d = new Date();
var n = d.getDay();

switch (n){
    case 1:
        document.getElementById("leftside").style.backgroundImage ="linear-gradient(#00b09b, #191654)";
        break;
    case 2:
         document.getElementById("leftside").style.backgroundImage ="linear-gradient(#c94b4b, #4b134f)";
        break;
    case 3:
        // document.getElementById("leftside").style.backgroundImage ="linear-gradient(#fc4a1a, #000000)";
        document.getElementById("leftside").style.backgroundImage ="linear-gradient(#f7b733, #fc4a1a)";
        // document.getElementById("leftside").style.backgroundImage ="linear-gradient(#fc4a1a, #f7b733)";
        break;
    case 4:
        document.getElementById("leftside").style.backgroundImage ="linear-gradient(#ad5389, #000000)";
        // document.getElementById("leftside").style.backgroundImage ="linear-gradient(#ad5389, #3c1053)";
        break;
    case 5:
        //  document.getElementById("leftside").style.backgroundImage ="linear-gradient(#3c3b3f, #605c3c)";
         document.getElementById("leftside").style.backgroundImage ="linear-gradient(#093028, #237a27)";
        //  document.getElementById("leftside").style.backgroundImage ="linear-gradient(#3c3b3f, #000000)";
		break;
	default:
		document.getElementById("leftside").style.backgroundImage ="linear-gradient(#191654, #00b09b)";
		// document.getElementById("leftside").style.backgroundImage ="linear-gradient(#00b09b, #191654)";
		break;

    }
}
	</script>
</body>
</html>



    
    