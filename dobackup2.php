<?php
include_once(dirname(__FILE__) .'/dbconfig/config.php');
$host=$db_host;
$user=$db_user;
$password=$db_pass;
$db=$db_name;
$stamped=date('d-m-Y');
$mydump = 'C:\wamp64\bin\mysql\mysql5.7.19\bin\mysqldump.exe';
$file='dbbackups/'.'dbdump'.$stamped.'.sql';
//$file='dbdump'.$stamped.'.sql';




$db_connect=mysqli_connect($host,$user,$password,$db);

//mysql_select_db("$db");

$mydump = $mydump;

$command = $mydump.' -h'.$host.' -u'.$user.' -p"'.$password.'" '.$db.' > "'.$file.'"';

$temp = dirname(__FILE__) .'\dbbackups\Temp Resources'.rand(1, 999).'.bat';
//$//temp2 = dirname(__FILE__) . '\dbbackups';
$fp = fopen ($temp, "w+");
fwrite($fp, $command);
fclose($fp);

@exec('"'.$temp.'"', $array, $ret);
unlink($temp); 

mysqli_close($db_connect);

    
    header('Location:backupshow.php?file='.$file);
  

?>