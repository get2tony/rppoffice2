<?php 
    
     
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
    include_once('vatmethods.php');

    $taxoffice=getSettings('soname',$conn);
    $coytin=$_POST['coytin'];
    $coyname=trim(preg_replace('/\s\s+/', '', strtoupper(urldecode($_POST['coyname']))));
    $address=trim(preg_replace('/\s\s+/', '', urldecode($_POST['address'])));
    $month=$_POST['yrendm'];
    $assyr=$_POST['yoa'];
    $label=$_POST['label'];
    $capture=$_POST['capture'];
    $taxtype=$_POST['taxtype'];
    $cattype=$_POST['cattype'];
    $amount=str_replace( ',', '',$_POST['amount']);
    $duedate=$_POST['duedate'];
    $basis=$_POST['basis'];
    $default=$_POST['defaults'];
    if ($default<1) {
        $default=0;
    }else{
       
    }

    $paydate=$_POST['paydate'];
    $nob=$_POST['nob'];
    $phone=$_POST['phone'];

    $suser=$_POST['user'];
	$usersno=$_POST['usersno'];
	$irno=checkUserirno($usersno,$conn);
	$userstatus=checkUserstatus2($usersno,$conn);

   

$address=str_replace("&"," %26 ",$address);

if (isduplicateVAT($conn,$coytin,$assyr,$month,$basis,$amount,$coyname)=="true"){
                            
         $errormsg="DUPLICATION ERROR! This Record Already Exist";
           
            echo $errormsg;
            exit();
                            
}
if (isVATinlist($conn,$coytin,$cattype)=="true"){
                            
       $query="UPDATE vatlist SET coyname = '$coyname', `address` = '$address', phone='$phone', nob='$nob',category='$cattype',capdate='$capture',capby='$suser' WHERE tinno like '$coytin'";
           $result = mysqli_query($conn,$query);
           if(!$result){
         $errormsg2="Oops! Could Not Update Record in VAT list ".mysqli_error($conn);
             echo $errormsg2;
               exit();
            }else {
         
            }                  
}else {
    $query="INSERT INTO vatlist (tinno,coyname,`address`,phone,nob,category,capdate,capby,taxoffice) VALUES ('$coytin','$coyname','$address','$phone','$nob','$cattype','$capture','$suser','$taxoffice')";
     $result = mysqli_query($conn,$query);
     if(!$result){
         $errormsg2="Oops! Could Not capture Record in VAT list ".mysqli_error($conn);
        echo $errormsg2;
               exit();
     }else {
         
     }
}


    $query="INSERT INTO vatreg (tinno,coyname,`address`,phone,basis,category,`month`,yoa,amount,capdate,paydate,defaultdays,capby,irno,modified,remark,asmno,taxoffice) VALUES ('$coytin','$coyname','$address','$phone','$basis','$cattype','$month','$assyr','$amount','$capture','$paydate','$default','$suser','$irno','','$nob','$label','$taxoffice')";
     $result = mysqli_query($conn,$query);

 if(!$result){
	
			$errormsg2="Ooops! The Record  was not submitted because of ".mysqli_error($conn);
        echo $errormsg2;
               exit();
        
            }else{
        $errormsg="The Record has been successfully Submitted!";

    echo'
        <!DOCTYPE html>
        <html lang="en">
        <head>
    <meta charset="UTF-8">
    <title>Confirm Returns Details</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
    
                      
    <script src="js3/jquery-1.12.4.js"></script>
</head>
<body>
   <div class="container-fluid">
        <div class="row-fluid col-md-4">
        
         <div class="alert-success" id="screen"><h2><label for="">Assigned Assessment No:</label></h2><h2> '.$label.'</h2></div>
            
            <h4>Note: This VAT Return has been Submitted Successfully!. </h4>
            
            <p></p>
           <a class="btn btn-success" href="#" onclick="history.go(-2)"> Capture for Same Taxpayer</a>
            <a class="btn btn-primary" href="capturevatself?user='.$suser.'&msg2='.$errormsg.'"> Capture New Returns</a>
            
            </div>
                </div>
         
            

             
             </body>';
                	
			}
       mysqli_close($conn);
    
?>