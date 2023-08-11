<?php   

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');
session_start();

$suser=$_SESSION['suser'];
$count3=0;


$polapp=getSetting('polapp',$conn);

if ($polapp=='yes') {
    $sql3= "SELECT * FROM `adminasreg` WHERE ( IFNULL(approval, 0) LIKE '%approved')";
}else {
    $sql3= "SELECT * FROM `adminasreg` WHERE ( IFNULL(approval, 0) LIKE '%approved') && `taxtype` NOT LIKE 'POL'";
}

$sqlmain='CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT * FROM lrpcurrent UNION  SELECT * FROM lrpback_year ';   
    $query11 = mysqli_query($conn,$sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query11) {
    die ('SQL Error: ' . mysqli_error($conn));
    }else{
        $table='temp_self';
        $sqla= "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%approved')";
        $querya = mysqli_query($conn,$sqla);
        $counta=mysqli_num_rows($querya);
    }

$query3 = mysqli_query($conn,$sql3);
$count3=mysqli_num_rows($query3);
if (!$query3) {
    die ('SQL Error: ' . mysqli_error($conn));
}
if (!$querya) {
    die ('SQL Error: ' . mysqli_error($conn));
}
echo number_format($count3+$counta);

?>