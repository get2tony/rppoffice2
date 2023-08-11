<?php 

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/vatmethods.php');
include_once(dirname(__FILE__) . '/tpmethods.php');


  require_once dirname(__FILE__) . '/dompdf/lib/html5lib/Parser.php';
  require_once dirname(__FILE__) . '/dompdf/php-font-lib/src/FontLib/Autoloader.php';
  require_once dirname(__FILE__) . '/dompdf/php-svg-lib/src/autoload.php';
  require_once dirname(__FILE__) . '/dompdf/src/Autoloader.php';
  Dompdf\Autoloader::register();
  use Dompdf\Dompdf;

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
// $tab = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$tinno =isset($_REQUEST['tin']) ? $_REQUEST['tin'] : null;

$officename=getSettings('oname',$conn);
$userstatus=checkUserstatus2($usersno,$conn);

   $sqlmain="CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT * FROM current UNION  SELECT * FROM back_year ";   
    $query1 = mysqli_query($conn,$sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query1) {
    die ('SQL Error: ' . mysqli_error($conn));
    }else{

    $sql="SELECT * FROM temp_self WHERE tinno LIKE '$tinno' ORDER BY sno DESC LIMIT 1";

    }
//  $table="adminasreg";
$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}


$amt='';
$amt2='';
$showlabel='<div class="text-center"><h3>TAX POSITION CHECK</h3></div>';

function getCITremark($a,$b){
  $show="";
if ($a<=0 && $b >1 ){
  $show= 'MIN TAX';
  }elseif ($a<=0 && $b==0) {
    $show= '';
  }
return $show;
}

 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RPP Office CIT Tax Position </title>
    <link rel="stylesheet" href="css3/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css3/buttons.dataTables.min.css">
    <link rel="stylesheet" href="css3/bootstrap.min.css">

<style type="text/css">
@media print{
 #buttonID{
  display:none;
}
}

#example{
   border:4px;
 }
table.dataTable thead td{
border-bottom:none;
}
table-bordered2{
border:0.3px;
}
table.dataTable tfoot td{
border-bottom:none;
}
table.dataTable.no-footer{
border-bottom:none;

}
#heading {
  position: absolute;
	font-family: Arial;
  font-weight: bold;
	font-size: 16px;
  left: 1200px;
  top: 30px;
}
#info{
  position: absolute;
	font-family: Arial;
  font-weight: bold;
	font-size: 16px;
  left: 770px;
  top: 20px;
}
#infoby {
  
	font-family: Arial;
  font-weight: bold;
	font-size: 16px;
  
}
#infoby span{
  color: #ad1818;
}
#heading2 {
  position:absolute;
	font-family: Arial;
  font-weight: bold;
	font-size: 16px;
  left: 40px;
  top:20px;
}
#heading2 span{
  color: #ad1818;
}
#heading span{
  color: #ad1818;
}
#info span{
  color: #ad1818;
}
#tableher{
  position:absolute;
	font-family: Arial;
	text-align: center;	
  /* margin:auto; */
  width: 90%;
  left: 40px;
  top:200px;
}
	
#tableher table  thead {
	font-size: 16px;
  font-weight:bold;
  /* color: #00f; */
  border:1px;
  background:#fef5c1;
}
#tableher table tr td {
	/* font-weight: bold; */
	text-align: left;
	font-size: 16px;
  font-family: Arial;
}
</style>
</head>

<body >

<div id="heading">
<strong>FEDERAL INLAND REVENUE SERVICE</strong><br/>
<?php echo $officename ?><br/>
RETURN PROCESSING ANNEXTURE <br/><br/>
<span>TAX POSITION FORM</span></div>
<br>

<?php 

       
        
        while ($row = mysqli_fetch_array($query))
        {
          
              $tinno=$row['tinno'];
            $coyname=$row['coyname'];
            $address=$row['address'];
            $remark = getnob($conn, $tinno);
            if ($remark == 'N/A') {
            $remark = substr($row['remark'], 0, 30);
            }  
            
            
            echo '
            <div id="heading2">
            ANNEX 1<br><br>
            <strong>TIN OF COMPANY:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><span>'.$tinno.'</span><br/>
            <strong>NAME OF COMPANY:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><span>'.$coyname.'</span><br/>
            <strong>ADDRESS OF COMPANY: </strong> <span>'.$address.'</span><br/>
            <strong>INDICATE WHETHER LIVE OR NOT: </strong><span>LIVE</span><br/>

</div>
            
         
            
            ';

        
        }

$yoa1=date("Y")-3;
$yoa2=date("Y")-2;
$yoa3=date("Y")-1;

$data1=gettaxinfo($conn,$tinno,$yoa1) ;
$data2=gettaxinfo($conn,$tinno,$yoa2) ;
$data3=gettaxinfo($conn,$tinno,$yoa3) ;

$lrp1=getlrpinfo($conn,$tinno,$yoa1);
$lrp2=getlrpinfo($conn,$tinno,$yoa2);
$lrp3=getlrpinfo($conn,$tinno,$yoa3);

$firstoff=substr($remark,0,41) ;
$secondoff=substr($remark,42,58) ;
?>


<div id="info">

INC:................................... <br/>
COMM:................................... <br/>
NOB:..<span><?php  echo $firstoff     ?></span><br/>
<span><?php  echo $secondoff     ?></span>...



</div>
<br>
<div id="tableher">
  <table id="example" class="table table-bordered" width="100%"  cellspacing="0" cellpadding="0">
   <thead >
    <tr>
      <td vwidth="8%" valign="top">YR OF ASMT</td>
      <td width="20%" valign="top">DATE &amp; ASSMT NO.</td>
      <td width="12%" valign="top">TURNOVER</td>
      <td width="12%" valign="top">ASSESSBLE PROFIT</td>
      <td width="11%" valign="top">TOTAL PROFIT</td>
      <td width="11%" valign="top">AMOUNT ASSESSED </td>
      <td width="8%" valign="top">NATURE OF ASMT</td>
      <td width="9%" valign="top">VAT PAID</td>
      <td width="11%" valign="top">REMARKS</td>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td height="21" style="font-weight: bold"> &nbsp;&nbsp;&nbsp; <?php echo $yoa1 ?></td>
      <td style="font-weight: bold">&nbsp;<?php echo $data1['assno'] ?> &nbsp;&nbsp; <?php echo $data1['capdate'] ?>  </td>
      <td>&nbsp;&nbsp; <?php echo $data1['tover'] ?> </td>
      <td>&nbsp;&nbsp; <?php 
      
      $sum1=getaddsum($conn,$tinno,$yoa1,'EDT','sum');
      $rate1=getaddsum($conn,$tinno,$yoa1,'EDT','rate');
      $add1=getaddsum($conn,$tinno,$yoa1,'EDT','add');
      $ap1=number_format((str_replace(',','',(int)$data1['edt'])+(int)$sum1)/($rate1/100),2);
      
      if ($add1==true){
        echo $ap1;
               
      }else {
        echo $data1['aprofit'];
      }
        
        
        
        ?></td>
      <td>&nbsp;&nbsp; <?php 
      
      $sum2=getaddsum($conn,$tinno,$yoa1,'CIT','sum');
      $rate2=getaddsum($conn,$tinno,$yoa1,'CIT','rate');
      $add2=getaddsum($conn,$tinno,$yoa1,'CIT','add');
      $tp2=number_format((str_replace(',','',(int)$data1['cit'])+(int)$sum2)/($rate2/100),2);
      
      if ($add2==true){
        echo $tp2;
               
      }else {
        echo $data1['tprofit'];
      }
        
        
        
        ?></td>
      <td>&nbsp;&nbsp; <?php echo $data1['cit'] ?></td>
      <td>&nbsp; CIT <?php echo getCITremark($data1['tprofit'],$data1['cit'] );  ?></td>
      <td>&nbsp; </td>
      <td> SELF ASMT</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;<?php echo str_replace('CIT','EDT',$data1['assno']) ?> &nbsp;&nbsp; <?php echo $data1['capdate'] ?> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp; <?php echo $data1['edt'] ?></td>
      <td>&nbsp; EDT </td>
      <td>&nbsp;  </td>
      <td> SELF ASMT</td>
    </tr>

<?php 
     $sql3="SELECT * FROM adminasreg WHERE tinno ='$tinno' && yoa = '$yoa1' && taxtype ='CIT' && (`approval`  LIKE 'approved' || `approval` IS NULL ) ORDER BY sno DESC ";
     $result3=mysqli_query($conn,$sql3);
      
    if ($result3){
       
		while ($row1 = mysqli_fetch_array($result3)){
                 
           $assno=$row1[8];
          $amount=$row1[7];
          $capdate=$row1[5];
          $taxtype=$row1[6];
          $basis=$row1[9];
          // $rate=$row1[24];
              // $sum+=$amount;         
          echo'
           <tr>
      <td>&nbsp;</td>
      <td>&nbsp;'.$assno.' &nbsp; '.date_format(date_create($capdate),"d/m/Y").'</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;'.number_format(str_replace(',','',$amount),2).'</td>
      <td>&nbsp;ADD '.$taxtype.'</td>
      <td>&nbsp; </td>
      <td>'.strtoupper($basis) .'</td>
    </tr>';        
          }
        }else {
    //         echo' <tr>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    // </tr>';
          }
      
      
       ?>
     <?php 
     $sql4="SELECT * FROM adminasreg WHERE tinno ='$tinno' && yoa = '$yoa1' && taxtype ='EDT' && (`approval`  LIKE 'approved' || `approval` IS NULL ) ORDER BY sno DESC ";
     $result4=mysqli_query($conn,$sql4);
      
    if ($result4){
		while ($row2 = mysqli_fetch_array($result4)){
                 
           $assno=$row2[8];
          $amount=$row2[7];
          $capdate=$row2[5];
          $taxtype=$row2[6];
          $basis=$row2[9];
                      
          echo'
           <tr>
      <td>&nbsp;</td>
      <td>&nbsp;'.$assno.' &nbsp;'.date_format(date_create($capdate),"d/m/Y").'</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
     <td>&nbsp;&nbsp;&nbsp;'.number_format(str_replace(',','',$amount),2).'</td>
      <td>&nbsp;ADD '.$taxtype.'</td>
      <td>&nbsp; </td>
      <td>'.strtoupper($basis).'</td>
    </tr>
    
    ';        
          }
        }else {
    //         echo' <tr>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    // </tr>';
          }
        
      
       ?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;<?php echo $lrp1['assno'] ?> &nbsp; <?php echo $lrp1['capdate'] ?>  </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;<?php echo $lrp1['amount'] ?></td>
      <td>&nbsp;&nbsp;<?php echo $lrp1['taxtype'] ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;<?php echo $lrp1['gov'] ?></td>
    </tr>
  <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  

<!-- SECOND YEAR -->

<tr>
      <td height="21" style="font-weight: bold"> &nbsp;&nbsp;&nbsp; <?php echo $yoa2 ?></td>
      <td style="font-weight: bold">&nbsp;<?php echo $data2['assno'] ?> &nbsp;&nbsp; <?php echo $data2['capdate'] ?>  </td>
      <td>&nbsp;&nbsp; <?php echo $data2['tover'] ?> </td>
      <td>&nbsp;&nbsp; <?php 
      
      $sum3=getaddsum($conn,$tinno,$yoa2,'EDT','sum');
      $rate3=getaddsum($conn,$tinno,$yoa2,'EDT','rate');
      $add3=getaddsum($conn,$tinno,$yoa2,'EDT','add');
      $ap3=number_format((str_replace(',','',(int)$data2['edt'])+(int)$sum3)/($rate3/100),2);
      
      if ($add3==true){
        echo $ap3;
               
      }else {
        echo $data2['aprofit'];
      }
        
        
        
        ?></td>
      <td>&nbsp;&nbsp; <?php 
      
      $sum4=getaddsum($conn,$tinno,$yoa2,'CIT','sum');
      $rate4=getaddsum($conn,$tinno,$yoa2,'CIT','rate');
      $add4=getaddsum($conn,$tinno,$yoa2,'CIT','add');
      $tp4=number_format((str_replace(',','',(int)$data2['cit'])+(int)$sum4)/($rate4/100),2);
      
      if ($add4==true){
        echo $tp4;
               
      }else {
        echo $data2['tprofit'];
      }
        
        
        
        ?></td>
      <td>&nbsp;&nbsp; <?php echo $data2['cit'] ?></td>
      <td>&nbsp; CIT <?php echo getCITremark($data2['tprofit'],$data2['cit'] ); ?></td>
       <td>&nbsp; </td>
      <td> SELF ASMT</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;<?php echo str_replace('CIT','EDT',$data2['assno']) ?> &nbsp;&nbsp; <?php echo $data2['capdate'] ?> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp; <?php echo $data2['edt'] ?></td>
      <td>&nbsp; EDT </td>
      <td>&nbsp; </td>
      <td> SELF ASMT</td>
    </tr>
    <?php 
     $sql5="SELECT * FROM adminasreg WHERE tinno ='$tinno' && yoa = '$yoa2' && taxtype ='CIT' && (`approval`  LIKE 'approved' || `approval` IS NULL ) ORDER BY sno DESC ";
     $result5=mysqli_query($conn,$sql5);
      
    if ($result5){
		while ($row3 = mysqli_fetch_array($result5)){
                 
           $assno=$row3[8];
          $amount=$row3[7];
          $capdate=$row3[5];
          $taxtype=$row3[6];
          $basis=$row3[9];
                      
          echo'
           <tr>
      <td>&nbsp;</td>
      <td>&nbsp;'.$assno.' &nbsp; '.date_format(date_create($capdate),"d/m/Y").'</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;'.number_format(str_replace(',','',$amount),2).'</td>
      <td>&nbsp;ADD '.$taxtype.'</td>
      <td>&nbsp; </td>
      <td>'.strtoupper($basis).'</td>
    </tr>
    
    ';        
          }
        }else {
    //         echo' <tr>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    // </tr>';
          }
        
      
       ?>
     <?php 
     $sql6="SELECT * FROM adminasreg WHERE tinno ='$tinno' && yoa = '$yoa2' && taxtype ='EDT' && (`approval`  LIKE 'approved' || `approval` IS NULL ) ORDER BY sno DESC ";
     $result6=mysqli_query($conn,$sql6);
      
    if ($result6){
		while ($row4 = mysqli_fetch_array($result6)){
                 
           $assno=$row4[8];
          $amount=$row4[7];
          $capdate=$row4[5];
          $taxtype=$row4[6];
          $basis=$row4[9];
                      
          echo'
           <tr>
      <td>&nbsp;</td>
      <td>&nbsp;'.$assno.' &nbsp;'.date_format(date_create($capdate),"d/m/Y").'</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;'.number_format(str_replace(',','',$amount),2).'</td>
      <td>&nbsp;ADD '.$taxtype.'</td>
      <td>&nbsp; </td>
      <td> '.strtoupper($basis).'</td>
    </tr>
    
    ';        
          }
        }else {
    //         echo' <tr>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    // </tr>';
          }
        
      
       ?>
    <tr>
     <td>&nbsp;</td>
      <td>&nbsp;<?php echo $lrp2['assno'] ?> &nbsp; <?php echo $lrp2['capdate'] ?>  </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;<?php echo $lrp2['amount'] ?></td>
      <td>&nbsp;&nbsp;<?php echo $lrp2['taxtype'] ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;<?php echo $lrp2['gov'] ?></td>
    </tr>
           <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  



  <!-- THIRD YEAR -->
  <tr>
      <td height="21" style="font-weight: bold"> &nbsp;&nbsp;&nbsp; <?php echo $yoa3 ?></td>
      <td style="font-weight: bold">&nbsp;<?php echo $data3['assno'] ?> &nbsp;&nbsp; <?php echo $data3['capdate'] ?>  </td>
      <td>&nbsp;&nbsp; <?php echo $data3['tover'] ?> </td>
      <td>&nbsp;&nbsp; <?php 
      
      $sum5=getaddsum($conn,$tinno,$yoa3,'EDT','sum');
      $rate5=getaddsum($conn,$tinno,$yoa3,'EDT','rate');
      $add5=getaddsum($conn,$tinno,$yoa3,'EDT','add');
      $ap5=number_format((str_replace(',','',(int)$data3['edt'])+(int)$sum5)/($rate5/100),2);
      
      if ($add5==true){
        echo $ap5;
               
      }else {
        echo $data3['aprofit'];
      }
        
        
        
        ?></td>
      <td>&nbsp;&nbsp; <?php 
      
      $sum6=getaddsum($conn,$tinno,$yoa3,'CIT','sum');
      $rate6=getaddsum($conn,$tinno,$yoa3,'CIT','rate');
      $add6=getaddsum($conn,$tinno,$yoa3,'CIT','add');
      $tp6=number_format((str_replace(',','',(int)$data3['cit'])+(int)$sum6)/($rate6/100),2);
      
      if ($add6==true){
        echo $tp6;
               
      }else {
        echo $data3['tprofit'];
      }
        
        
        
        ?></td>
      <td>&nbsp;&nbsp; <?php echo $data3['cit'] ?></td>
      <td>&nbsp; CIT <?php echo getCITremark($data3['tprofit'],$data3['cit'] );?></td>
      <td>&nbsp; </td>
      <td> SELF ASMT</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;<?php echo str_replace('CIT','EDT',$data3['assno']) ?> &nbsp;&nbsp; <?php echo $data3['capdate'] ?> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp; <?php echo $data3['edt'] ?></td>
      <td>&nbsp; EDT </td>
      <td>&nbsp; </td>
      <td> SELF ASMT</td>
    </tr>
    <?php 
     $sql7="SELECT * FROM adminasreg WHERE tinno ='$tinno' && yoa = '$yoa3' && taxtype ='CIT' && (`approval`  LIKE 'approved' || `approval` IS NULL ) ORDER BY sno DESC ";
     $result7=mysqli_query($conn,$sql7);
      
    if ($result7){
		while ($row5 = mysqli_fetch_array($result7)){
                 
           $assno=$row5[8];
          $amount=$row5[7];
          $capdate=$row5[5];
          $taxtype=$row5[6];
          $basis=$row5[9];
                      
          echo'
           <tr>
      <td>&nbsp;</td>
      <td>&nbsp;'.$assno.' &nbsp;'.date_format(date_create($capdate),"d/m/Y").'</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;'.number_format(str_replace(',','',$amount),2).'</td>
      <td>&nbsp;ADD '.$taxtype.'</td>
      <td>&nbsp; </td>
      <td> '.strtoupper($basis).'</td>
    </tr>
    
    ';        
          }
        }else {
    //         echo' <tr>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    // </tr>';
          }
        
      
       ?>
     <?php 
     $sql8="SELECT * FROM adminasreg WHERE tinno ='$tinno' && yoa = '$yoa3' && taxtype ='EDT' && (`approval`  LIKE 'approved' || `approval` IS NULL ) ORDER BY sno DESC ";
     $result8=mysqli_query($conn,$sql8);
      
    if ($result8){
		while ($row6 = mysqli_fetch_array($result8)){
                 
           $assno=$row6[8];
          $amount=$row6[7];
          $capdate=$row6[5];
          $taxtype=$row6[6];
          $basis=$row6[9];
                     
          echo'
           <tr>
      <td>&nbsp;</td>
      <td>&nbsp;'.$assno.' &nbsp;'.date_format(date_create($capdate),"d/m/Y").'</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
     <td>&nbsp;&nbsp;&nbsp;'.number_format(str_replace(',','',$amount),2).'</td>
      <td>&nbsp;ADD '.$taxtype.'</td>
      <td>&nbsp;</td>
      <td> '.strtoupper($basis).'</td>
    </tr>
    
    ';        
          }
        }else {
    //         echo' <tr>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    //   <td>&nbsp;</td>
    // </tr>';
          }
        
      
       ?>
    <tr>
     <td>&nbsp;</td>
      <td>&nbsp;<?php echo $lrp3['assno'] ?> &nbsp; <?php echo $lrp3['capdate'] ?>  </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;<?php echo $lrp3['amount'] ?></td>
      <td>&nbsp;&nbsp;<?php echo $lrp3['taxtype'] ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;<?php echo $lrp3['gov'] ?></td>
    </tr>
     <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
</tbody>
 </table>
 <br/>
 <br/>
 <table>
 <tr><td><div id="infoby">
<strong><span>INFORMATION SUPPLIED BY:</span></strong><br/><br/>
NAME:.....<span><?php echo strtoupper($suser) ?></span>.......... <br/>
RANK:................................... <br/>
SIGNATURE:..............................<br/>
DATE:.....<span><?php echo date('d-m-Y'); ?></span>................ 


</div></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>


<td><div id="infoby">
<strong><span>CHECKED &amp; APPROVED BY:</span></strong><br/><br/>
NAME:................................... <br/>
RANK:................................... <br/>
SIGNATURE:..............................<br/>
DATE:................................... 


</div></td>
<td></td>

</tr>

 </table>
 
</div>

<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>
   
   
    <!--the button initialization-->
    <script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'B',
        ordering:false,
        paging: false,
        responsive: true,
         
           buttons: [
                      
                    {
                        extend: 'collection',
                        text: 'Export Report As >',
                        attr: { id: 'buttonID' },
                        buttons: [
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            {
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL'

                            }       
                            
                            
                        ]
                        }
                    ]
              } );
       
              
    } );
   </script>
</body>
</html>