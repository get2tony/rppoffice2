<?php   

include_once(dirname(__FILE__) . '/dbconfig/config.php');
session_start();

$suser=$_SESSION['suser'];

$sql= "SELECT * FROM `adminasreg` WHERE ( IFNULL(approval, 0) NOT LIKE '%approved') && user LIKE '$suser' && capdate LIKE '%".date('Y')."%'";
$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}
echo number_format($count);

?>