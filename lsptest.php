<?php 


$coytin=$_REQUEST['data1'];
$coyname=stripslashes($_REQUEST['data2']);
$address=stripslashes($_REQUEST['data3']);
$yoa=$_REQUEST['data4'];
$capture=$_REQUEST['data5'];
$amount= str_replace(',','',$_REQUEST['data6']);
$basis=$_REQUEST['data10'];
$taxtype=$_REQUEST['data7'];
$asmtno=isset($_REQUEST['data9']) ? $_REQUEST['data9'] : null;
$startdate=isset($_REQUEST['start']) ? $_REQUEST['start'] : $_REQUEST['data13'];
$enddate=isset($_REQUEST['end']) ? $_REQUEST['end'] : $_REQUEST['data5'];
$month=date("m",strtotime($_REQUEST['data8']));

if ($startdate==null && $enddate==null) {
$startdate='01-'.$month.'-'.$yoa;
$enddate='31-'.$month.'-'.$yoa;	# code...
}
$suser=isset($_REQUEST['data12']) ? $_REQUEST['data12'] : null;
$default=isset($_REQUEST['data11']) ? $_REQUEST['data11'] : null;




echo $coytin.'<p>';











?>