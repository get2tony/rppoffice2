<?php
$db_host = 'localhost'; // Server Name
$db_user = 'root'; // Username
$db_pass = 'root'; // Password
$db_name = 'rppoffice'; // Database Name

$conn = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	die ('db');	
}



?>