<?php 


include_once(dirname(__FILE__) . '/dbconfig/config.php');



$sql = "SELECT * FROM demo ";
        
$query = mysqli_query($conn, $sql);

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}
$label="";
$asno="";
$ayear="";


while ($row = mysqli_fetch_array($query))
        {
$label=$row[0];
$asno=$row[1];
$ayear=$row[2];

$show=$label.$asno.'/'.$ayear;
    echo'




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Returns Details</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
    
                      
   
</head>
<body>
   '.$show.'<br>
    
</body>
</html>
       
    ';

}
  
    
    
    
    



 

?> 