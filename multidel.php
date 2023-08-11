<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');

$raw=$_POST['selected'];
$raw1=str_replace('[','',$raw);
$raw2=str_replace(']','',$raw1);
$raw3=str_replace('"','',$raw2);
$myArray=explode(',',$raw3);
$arrlength = count($myArray);

$suser=$_POST['user'];
$usersno=$_POST['usersno'];
$cont=true;
$page=$_POST['page'];
$trail=$_POST['trail'];

for($i = 0; $i < $arrlength; $i++) {

$data=explode('/',$myArray[$i]);

  
$sno=$data[0];
$table=$data[1];
$coytin=$data[2];

if ($trail=='lrp') {
  $cont=LRPDelete($sno,$table,$coytin,$suser,$conn);
}
if ($trail=='self') {
  $cont=selfDelete($sno,$table,$coytin,$suser,$conn);
}
if ($trail=='gov') {
  $cont=assDelete($sno,$table,$coytin,$suser,$conn); 
}
    
 if($cont===true){
    $sql="DELETE FROM $table WHERE 
    `tinno`='$coytin' && `sno`='$sno'";
    }
    $result[] = mysqli_query($conn,$sql);

}
foreach ($result as &$value) {
  $value = $value;
}


if ( $value=== TRUE) {
  $msg= "(".$arrlength.") Records Deleted successfully";
  header('Location:'.$page.'?sno='.$usersno.'&user='.$suser.'&msg='.$msg);
     exit();
} else {
  $msg2= "Error Deleting records: ".mysqli_error($conn);
  header('Location:'.$page.'?sno='.$usersno.'&user='.$suser.'&msg2='.$msg2);
     exit();
}


mysqli_close($conn);
              

?>