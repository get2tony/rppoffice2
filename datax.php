<?php   

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once('vatmethods.php');
session_start();

$suser=$_SESSION['suser'];
$count=0;
$table='adminasreg';
$sql= "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%pending') || ( IFNULL(approval, 0) LIKE '%rejected') ";
$query = mysqli_query($conn,$sql);
$no=1;
while ($row = mysqli_fetch_array($query))
        {
            $headdept=getAssuser($suser,$conn);
            $userdept=getAssuser($row['user'],$conn);

            if ($headdept==$userdept) {
               
                
                   $count=$no;
              $no++;    
            } 
            
        }

        echo number_format($count);
        
?>