<?php   

include_once(dirname(__FILE__) . '/dbconfig/config.php');
session_start();

$suser=$_SESSION['suser'];
$count=0;
$sql= "SELECT * FROM `adminasreg` WHERE ( IFNULL(approval, 0) LIKE '%pending') && capdate LIKE '%".date('Y')."%'";
$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);

$sqlmain='CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT * FROM lrpcurrent UNION  SELECT * FROM lrpback_year ';   
    $query11 = mysqli_query($conn,$sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query11) {
    die ('SQL Error: ' . mysqli_error($conn));
    }else{
        $table='temp_self';
        $sqla= "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%pending') && capdate LIKE '%".date('Y')."%'";
        $querya = mysqli_query($conn,$sqla);
        $counta=mysqli_num_rows($querya);

    }



if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}
if (!$querya) {
    die ('SQL Error: ' . mysqli_error($conn));
}
echo number_format($count+$counta);

?>