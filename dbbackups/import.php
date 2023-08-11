<?php
//Uncomment this below line for larger database to allow script to execute long time
include("../dbconfig/config.php");
//include("../backup.html");
 set_time_limit(0);
 $filename="";
// database file path
$filename = isset($_REQUEST['filebd']) ? $_REQUEST['filebd'] : "";
//echo "$filename";
// MySQL host
$mysql_host = $db_host;
// MySQL username
$mysql_username =$db_user;
// MySQL password
$mysql_password = $db_pass;
// Database name
$mysql_database = $db_name;
// Connect to MySQL server
$conn = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

//$conn =('localhost', 'root', '' , 'blog_samples');

$query = '';
$sqlScript = file($filename);
foreach ($sqlScript as $line)	{
	
	$startWith = substr(trim($line), 0 ,2);
	$endWith = substr(trim($line), -1 ,1);
	
	if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
		continue;
	}
		
	$query = $query . $line;
	if ($endWith == ';') {
		mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>'.mysqli_error($conn));
		$query= '';		
	}
}
echo '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Back Up Report</title>
    <link rel="stylesheet" href="../css3/bootstrap.min.css">
    <link rel="stylesheet" href="../css3/style4.css">
    
                     
   
</head>
<body>
   <div id="showArea" class="container-fluid">
           
          
            <div id="verify">
             <div class="row-fluid col-md-4">
                 
<div class="alert-success" id="screen"><h4><i class="glyphicon glyphicon-ok"></i> SQL File Imported Successfully! </h4> </div>
<p></p>
                <a target="dframe" href="../backup.php" class="btn btn-primary"> Go Back</a>
                
                
        </div>
                </div></div>
                </body>
</html>
';




?>