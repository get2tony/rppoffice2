<?php    
include_once(dirname(__FILE__) . '/dbconfig/config.php');  
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

    
    $coytin=$_POST['coytin'];
    $coyname=trim(preg_replace('/\s\s+/', '', strtoupper(urldecode($_POST["coyname"]))));
    $address=trim(preg_replace('/\s\s+/', '', strtoupper(urldecode($_POST["address"]))));
    $page2="";
    $assyr=$_POST['yoa'];
    $yearend=$_REQUEST['yrendm'];
    $capture=$_POST['capture'];
    $issue=$_POST['date2'];
	if($issue==''){
		$issue=$capdate;
	}
    $tax='CIT';
    $asstype=$_POST['tbn'];
    $amount=$_POST['amount'];
    $taxtype1="LRP";
    $alabel=$_POST['alabel'];
    $assno=$_POST['assno'];
    $ayear="/".$_POST['ayear'];
    $basis='LATE FILING';
    $duedate1=$_POST['duedate'];
    $default=$_POST['default'];
    $suser=$_POST['user'];
    $usersno=$_POST['usersno'];
    $userstatus=checkUserstatus2($usersno,$conn);
    $irno=checkUserirno($usersno,$conn);
    $taxoffice=getSetting('soname',$conn);
    // $taxoffice='Orile MSTO';
    $openpage='asmtlrp';
    $approval=checkapp('citlrp',$conn)? checkapp('citlrp',$conn):'approved';
    $appby='';
    $appdate='';

    if ( $userstatus=="controller" ) {
        $approval="approved";
        $appby=$suser;
        $appdate=date('d-m-Y');
        
    }

     if ($approval=="approved") {
         $appby=$suser;
         $appdate=date('d-m-Y');
         $openpage='asmtlrp';
    }else {
         $openpage="lrpclosed";
    }
    
    if (checkduplicateLRPvat($conn,$asstype,$coytin,$assyr,$amount,$tax,$yearend)=="true"){
     
     
    }
    
    
    $query="INSERT INTO $asstype (tinno,coyname,address,yoa,capdate,taxtype,amount,alabel,asmtno,ayear,basis,yearend,duedate,datefiled,DefaultMonth,user,modified,tax,irno,taxoffice,approval,appby,appdate) VALUES ('$coytin','$coyname','$address','$assyr','$issue','$taxtype1','$amount','$alabel','$assno','$ayear','$basis','$yearend','$duedate1','$capture','$default','$suser','','$tax','$irno','$taxoffice','$approval','$appby','$appdate')";
    
    $result = mysqli_query($conn,$query);
       

    if(!$result){
	           
			   //$errormsg="You must enter Company Name, TIN and Rc Number ";
	          // header("Location:  reg_file?msg=".$errormsg  ); 
			die('Ooops! Submit Return method Sorry, could not create or insert data'.$yearend.' '.mysqli_error($conn).$asstype);
		   }else{
		
                $page2='go';
        
   	        // exit();
            }
      
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Processing</title>
</head>
<body onload="dosub()">
<form id="myform" method="POST" action="<?php echo $openpage ?>">
        
     <input type="hidden" value="<?php echo $page2; ?>" id="page" />
     <input type="hidden" value="<?php echo $coytin; ?>"  name="data1"/>
     <input type="hidden" value="<?php echo $coyname; ?>"  name="data2"/>
     <input type="hidden" value="<?php echo $address; ?>"  name="data3"/>
     <input type="hidden" value="<?php echo $assyr; ?>"  name="data4"/>
     <input type="hidden" value="<?php echo $issue; ?>"  name="data5"/>
     <input type="hidden" value="<?php echo $amount; ?>"  name="data6"/>
     <input type="hidden" value="<?php echo $taxtype1; ?>"  name="data7"/>
     <input type="hidden" value="<?php echo $alabel; ?>"  name="data8"/>
     <input type="hidden" value="<?php echo $assno; ?>"  name="data9"/>
     <input type="hidden" value="<?php echo $ayear; ?>"  name="data10"/>
    
   
    </form>

    <script type="text/javascript" src="js3/jquery-1.12.4.js"></script>
     <script>
     function dosub() {
      var p=document.getElementById('page').value;
      if(p==="go"){
          document.getElementById('myform').submit(); 
      }else{
         print("no data found!");
      }
     }
     
     </script>
</body>
</html>

<?php 

            
       mysqli_close($conn);
    


?>