<?php 

session_start();
$user=$_SESSION['user'];
$sno=$_SESSION['sno'];


session_write_close();
session_destroy();

header("Location: index");
exit;




?>