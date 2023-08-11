<?php
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

    $coytin=$_POST['coytin'];
    $coyname=trim(preg_replace('/\s\s+/', '', strtoupper(urldecode($_POST["coyname"]))));
    $address=trim(preg_replace('/\s\s+/', '', strtoupper(urldecode($_POST["address"]))));
    $page2="";
    $assyr=$_POST['yoa'];
    $monthfiled=$_POST['yrendm'];
    $capture=$_POST['capture'];
    $datefile=$_POST['datefile'];
    $asstype=$_POST['tbn'];

    //$end=$_POST['capture'];

    $amount=$_POST['amount'];
    $page=$_POST['page'];
    $lrptype="LSP";
	$tax='VAT';
////////////////////////////////////////////////////////
    $start=$_POST['start'];
    $end=$_POST['end'];
  ////////////////////////////////////////////
    $alabel=$_POST['alabel'];
    $assno=$_POST['assno'];
    $ayear="/".$_POST['ayear'];
    $basis='LATE SUBMISSION';
    $duedate1=$_POST['duedate'];
    // $start=isset($_REQUEST['dueend']) ? $_REQUEST['dueend'] : $duedate1;
    $default=$_POST['default'];
    $suser=$_POST['user'];
    $usersno=$_POST['usersno'];
    $taxoffice=getSettings('soname',$conn);
    $irno=checkUserirno($usersno,$conn);
    $userstatus=isset($_REQUEST['ustatus']) ? $_REQUEST['ustatus'] : 'user';
    $approval=checkapp('vatlrp',$conn);
    $openpage='viewvatlsp';

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
        $openpage='viewvatlsp';
    }else {
         $openpage="lrpclosed";
    }



 if (checkduplicateLRPvat($conn,$asstype,$coytin,$assyr,$amount,$tax,$monthfiled)=="true"){

 }else{

    $query="INSERT INTO $asstype (tinno,coyname,address,yoa,capdate,taxtype,amount,alabel,asmtno,ayear,basis,yearend,duedate,datefiled,DefaultMonth,user,tax,irno,taxoffice,approval,appby,appdate) VALUES ('$coytin','$coyname','$address','$assyr','$capture','$lrptype','$amount','$alabel','$assno','$ayear','$basis','$monthfiled','$duedate1','$datefile','$default','$suser','$tax','$irno','$taxoffice','$approval','$appby','$appdate')";

    $result = mysqli_query($conn,$query);

 }
   if(!$result){

			   //$errormsg="You must enter Company Name, TIN and Rc Number ";
	          // header("Location:  reg_file?msg=".$errormsg  );
			die('Ooops! Submit Return method Sorry, could not create or insert data'.$yearend.' '.mysqli_error($conn).$asstype);
		   }else{

$assno=$alabel.$assno.$ayear;

//   header('Location:'.$openpage.'?data1='.$coytin.'&data2='.$coyname.'&data3='.$address.'&data4='.$assyr.'&data5='.$capture.'&data6='.$amount.'&data7='.$lrptype.'&data8='.$monthfiled.'&data9='.$assno.'&data11='.$basis.'&data12='.$default.'&data13='.$suser.'&start='.$start.'&end='.$end);
        $page2="go";
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
     <input type="hidden" value="<?php echo $capture; ?>"  name="data5"/>
     <input type="hidden" value="<?php echo $amount; ?>"  name="data6"/>
     <input type="hidden" value="<?php echo $lrptype; ?>"  name="data7"/>
     <input type="hidden" value="<?php echo $monthfiled; ?>"  name="data8"/>
     <input type="hidden" value="<?php echo $assno; ?>"  name="data9"/>
     <input type="hidden" value="<?php echo $basis; ?>"  name="data10"/>
     <input type="hidden" value="<?php echo $default; ?>"  name="data11"/>
     <input type="hidden" value="<?php echo $suser; ?>"  name="data12"/>
     <input type="hidden" value="<?php echo $start; ?>"  name="start"/>
     <input type="hidden" value="<?php echo $end; ?>"  name="end"/>

     <input type="hidden" value="<?php echo $duedate1; ?>"  name="data13"/>
     <input type="hidden" value="<?php echo $datefile; ?>"  name="data15"/>


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