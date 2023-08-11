<?php   

include_once(dirname(__FILE__) . '/dbconfig/config.php');
session_start();

$suser=$_SESSION['suser'];
$count3=0;
$table='adminasreg';
$sql3= "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) NOT LIKE '%pending')  AND ( IFNULL(approval, 0) NOT LIKE '%rejected') AND `user` LIKE '$suser'  ORDER BY STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') DESC";
// $sql3= "SELECT * FROM `$table` WHERE  approval NOT LIKE '%pending'  AND `user` LIKE '$suser'  || approval IS NULL AND `user` LIKE '$suser'  ORDER BY STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') DESC";
$query3 = mysqli_query($conn,$sql3);
$count3=mysqli_num_rows($query3);


$sqlmain='CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT * FROM lrpcurrent UNION  SELECT * FROM lrpback_year ';   
    $query11 = mysqli_query($conn,$sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query11) {
    die ('SQL Error: ' . mysqli_error($conn));
    }else{
        $table='temp_self';
        $sqla= "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) NOT LIKE '%pending')  AND ( IFNULL(approval, 0) NOT LIKE '%rejected') AND `user` LIKE '$suser'  ORDER BY STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') DESC";
// $sql3= "SELECT * FROM `$table` WHERE  approval NOT LIKE '%pending'  AND `user` LIKE '$suser'  || approval IS NULL AND `user` LIKE '$suser'  ORDER BY STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') DESC";
        $querya = mysqli_query($conn,$sqla);
        $counta=mysqli_num_rows($querya);

    }

if (!$query3) {
    die ('SQL Error: ' . mysqli_error($conn));
}
if (!$querya) {
    die ('SQL Error: ' . mysqli_error($conn));
}
echo number_format($count3+$counta);

?>