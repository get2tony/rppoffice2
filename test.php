<?php 


$duedatenew=date('Y-m-d',strtotime('21-02-2019'));
$datecapnew=date('Y-m-d',strtotime('22-02-2019'));
   $today=$datecapnew; 
//$ts1 = strtotime($duedatenew);
//$ts2 = strtotime($datecapnew);

//$year1 = date('Y', $ts1);
//$year2 = date('Y', $ts2);
$duda=explode('-',$duedatenew);
$capda=explode('-',$datecapnew);
	
$year1 = $duda[0];
$year2 = $capda[0];

//$month1 = date('m', $ts1);
//$month2 = date('m', $ts2);
	
$month1 = $duda[1];
$month2 = $capda[1];

$day1 = $duda[2];
$day2 = $capda[2];

$diff = (($year2 - $year1) * 12) + ($month2 - $month1);


$datediff = strtotime($datecapnew) - strtotime($duedatenew);
$defaultdays=$datediff / (60 * 60 * 24);
	
	echo '1.'.$diff.'<br>';
	echo '2.'.$datediff.'<br>';
	echo '3.'.$defaultdays;

?>