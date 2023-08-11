<?php   

include_once(dirname(__FILE__) . '/dbconfig/config.php');
session_start();

$suser=$_SESSION['suser'];
$count=0;
$count2=0;
$dcount=0;
$sql= "SELECT * FROM `adminasreg` WHERE ( IFNULL(approval, 0) NOT LIKE '%approved') && user LIKE '$suser' && capdate LIKE '%".date('Y')."%'";
$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);

$sql2= "SELECT * FROM `adminasreg` WHERE `user` LIKE '$suser' && capdate LIKE '%".date('Y')."%'";
$query2 = mysqli_query($conn,$sql2);
$count2=mysqli_num_rows($query2);

$sqlmain='CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT * FROM lrpcurrent UNION  SELECT * FROM lrpback_year ';   
    $query1 = mysqli_query($conn,$sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query1) {
    die ('SQL Error: ' . mysqli_error($conn));
    }else{
        $table='temp_self';


        $sqla= "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) NOT LIKE '%approved') && user LIKE '$suser' && capdate LIKE '%".date('Y')."%'";
$querya = mysqli_query($conn,$sqla);
$counta=mysqli_num_rows($querya);

$sqlb= "SELECT * FROM `$table` WHERE `user` LIKE '$suser' && capdate LIKE '%".date('Y')."%'";
$queryb = mysqli_query($conn,$sqlb);
$countb=mysqli_num_rows($queryb);


    }


if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}
if (!$query2) {
    die ('SQL Error: ' . mysqli_error($conn));
}
if (!$querya) {
    die ('SQL Error: ' . mysqli_error($conn));
}
if (!$queryb) {
    die ('SQL Error: ' . mysqli_error($conn));
}

$dcount=($count2 + $countb)-($count + $counta);
if ($dcount<1) {
    $dcount=0;
} 
echo number_format($dcount);

?>