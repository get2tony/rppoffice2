<?php 
    
     
include_once(dirname(__FILE__) . '/dbconfig/config.php');
    
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
    include_once('vatmethods.php');

    
    $coytin=$_POST['coytin'];
    $coyname=$_POST['coyname'];
    $phone=$_POST['phone'];
    $address=trim(preg_replace('/\s\s+/', '', $_POST['address']));
    $yearend=$_POST['yrendm'];
    $assyr=$_POST['yoa'];
    $taxoffice=getSettings('soname',$conn);

    $mydate=date('d/m/Y',strtotime($_POST['capture']));
    $capture=$mydate;
    $duedate=$_POST['duedate'];
    $turnover=$_POST['tover'];
    $cost=$_POST['cost'];
    $fa=$_POST['fa'];
    $asspt=$_POST['asspt'];
    $totalpt=$_POST['tpt'];
    $citamt=$_POST['cit'];
    $edtamt=$_POST['edt'];
    $cgt=$_POST['cgt'];
    $nitd=$_POST['nitd'];
    $mintax=$_POST['mintax'];
    $niltax=$_POST['niltax'];
    $asstype=$_POST['asstype'];
    $alabel=$_POST['alabel'];
    $assno=$_POST['assno'];
    $ayear=$_POST['ayear'];
    $remark=$_POST['remark'];
    $citass=$_POST['citass'];
    $edtass=$_POST['edtass'];
    $suser=$_POST['user'];
    $paytype=$_POST['paytype'];
    $usersno=$_POST['usersno'];
    $irno=checkUserirno($usersno,$conn);


if (checkduplicate($conn,$coytin,$assyr,$asstype)=="true"){
                            
         $errormsg="DUPLICATION ERROR! Record Already Exist";
            header("Location:capture?user=".$suser."&msg=".$errormsg); 
                            exit();
                            
}
    
    $query="INSERT INTO $asstype (tinno,coyname,address,yearend,duedate,yoa,assmt_type,capdate,turnover,tprofit,aprofit,cit,edt,alabel,asmtno,ayear,mintax,niltax,remark,citass,edtass,user,modified,irno,cgt,nitd,phone,paytype,taxoffice,cost,fa)VALUES ('$coytin','$coyname','$address','$yearend','$duedate','$assyr','$asstype','$capture','$turnover','$totalpt','$asspt','$citamt','$edtamt','$alabel','$assno','$ayear','$mintax','$niltax','$remark','$citass','$edtass','$suser','','$irno','$cgt','$nitd','$phone','$paytype','$taxoffice','$cost','$fa')";
    
    $result = mysqli_query($conn,$query);

       

if(!$result){
	
			   //$errormsg="You must enter Company Name, TIN and Rc Number ";
	          // header("Location:  reg_file?msg=".$errormsg  ); 
        
           $errormsg="The Record could not be Submitted!  internal Error : ".mysqli_error($conn);
           header('Location:capture?user='.$suser.'&msg='.$errormsg  ); 
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
    
                      
   
</head>
<body>
   <div class="container-fluid">
        <div class="row-fluid col-md-4">
        
         <div class="alert-success" id="screen"><h2><label for="">Assigned Assessment No:</label></h2><h2> '.$alabel.$assno.'/'.$ayear.'</h2><h2>
            '.str_replace("CIT","EDT",$alabel).$assno.'/'.$ayear.'</h2></div>
            
            <h4>Note: This Account has been Submitted Successfully!. </h4>
            
            <p></p>
             <a class="btn btn-success" href="#" onclick="history.go(-2)"> Capture for Same Taxpayer</a>
            <a class="btn btn-primary" href="capture?user='.$suser.'&msg2='.$errormsg.'"> Capture New Returns</a>
            
            </div>
                </div>
         
             </head>
             </body>';
                	
   	       
  }
       mysqli_close($conn);
    
?>