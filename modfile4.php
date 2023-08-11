<?php
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');

$coytin = "";
$coyname = "";
$cost18 = "";
$cost19 = "";
$year = "";
$table = '';


$sql = "SELECT * FROM cost_table ";
$query = mysqli_query($conn, $sql);
$count = mysqli_num_rows($query);

if (!$query) {

    die('SQL Error: here' . mysqli_error($conn));
}



while ($row = mysqli_fetch_array($query)) {
    
    $coytin = $row[0];
    $coyname = $row[1];
    $cost18 = $row[2];
    $cost19 = $row[3];
   
    
}
$a=0;
while ($a <= $count) {
    $year = 2019;
    $table = 'current';
    $sql1 = " UPDATE $table SET cost='$cost19' WHERE tinno='$coytin' && yoa='$year' ";
    if (mysqli_query($conn, $sql1)) {
        echo "All done";
    }
}
  














?>