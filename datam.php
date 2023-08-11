<?php   

include_once(dirname(__FILE__) . '/dbconfig/config.php');
session_start();

$suser=$_SESSION['suser'];
$count=0;
$table='adminasreg';
$sql= "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%pending') || ( IFNULL(approval, 0) LIKE '%rejected') && user='$suser'";
$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);


//lrp tables
$sqlmain='CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT * FROM lrpcurrent UNION  SELECT * FROM lrpback_year ';   
    $query11 = mysqli_query($conn,$sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query11) {
    die ('SQL Error: ' . mysqli_error($conn));
    }else{
        $table='temp_self';
$sql1= "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%pending') || ( IFNULL(approval, 0) LIKE '%rejected') && user='$suser'";
$query1 = mysqli_query($conn,$sql1);
$count1=mysqli_num_rows($query1);

    }





if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}
if (!$query1) {
    die ('SQL Error: ' . mysqli_error($conn));
}
echo number_format($count+$count1);

?>