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
$showlabel='<div class="text-center"><h3>TCC POSITION CHECK</h3></div>';

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
    <title>RPP Office TCC summary Sheet </title>
    <link rel="stylesheet" href="css3/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css3/buttons.dataTables.min.css">
    <link rel="stylesheet" href="css3/bootstrap.min.css">

<style type="text/css">
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
	
#tableher table tr th {
	font-size: 16px;
  /* color: #00f; */
  background:#ffc300;
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
<span>TCC TEMPLATE DETAILS</span></div>
<br>

<?php 

       
        
        while ($row = mysqli_fetch_array($query))
        {
          
              $tinno=$row['tinno'];
            $coyname=$row['coyname'];
            $address=$row['address'];
            $remark=substr($row['remark'],0,30);
            
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
  <table id="example" class="display table table-bordered" width="95%" border="1"  cellspacing="0" cellpadding="0">
    <thead>
            <tr>
            <th >YR OF ASMT</th>
            <th >TURNOVER</th>
            <th >ASSESSBLE PROFIT</th>
            <th >TOTAL PROFIT</th>
            <th >AMOUNT ASSESSED </th>
            <th >NATURE OF ASMT</th>
            </tr>
    </thead>
    <tbody>
    <tr>
      <td height="21" style="font-weight: bold"> &nbsp;&nbsp;&nbsp; <?php echo $yoa1 ?></td>
      <td>&nbsp;&nbsp; <?php echo $data1['tover'] ?> </td>
      <td>&nbsp;&nbsp; <?php 
      
      $sum1=getaddsum($conn,$tinno,$yoa1,'EDT','sum');
      $rate1=getaddsum($conn,$tinno,$yoa1,'EDT','rate');
      $add1=getaddsum($conn,$tinno,$yoa1,'EDT','add');
      $ap1=number_format((str_replace(',','',$data1['edt'])+$sum1)/($rate1/100),2);
      
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
      $tp2=number_format((str_replace(',','',$data1['cit'])+$sum2)/($rate2/100),2);
      
      if ($add2==true){
        echo $tp2;
               
      }else {
        echo $data1['tprofit'];
      }
        
        
        
        ?></td>
      <td>&nbsp;&nbsp; <?php echo number_format((str_replace(',','',$data1['cit'])+$sum2),2) ?></td>
      <td>&nbsp; CIT </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp; <?php echo number_format((str_replace(',','',$data1['edt'])+$sum1),2) ?></td>
      <td>&nbsp; EDT </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;<?php echo $lrp1['amount'] ?></td>
      <td>&nbsp;&nbsp;<?php echo $lrp1['taxtype'] ?></td>
    </tr>
  <tr>
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
      <td>&nbsp;&nbsp; <?php echo $data2['tover'] ?> </td>
      <td>&nbsp;&nbsp; <?php 
      
      $sum3=getaddsum($conn,$tinno,$yoa2,'EDT','sum');
      $rate3=getaddsum($conn,$tinno,$yoa2,'EDT','rate');
      $add3=getaddsum($conn,$tinno,$yoa2,'EDT','add');
      $ap3=number_format((str_replace(',','',$data2['edt'])+$sum3)/($rate3/100),2);
      
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
      $tp4=number_format((str_replace(',','',$data2['cit'])+$sum4)/($rate4/100),2);
      
      if ($add4==true){
        echo $tp4;
               
      }else {
        echo $data2['tprofit'];
      }
        
        
        
        ?></td>
      <td>&nbsp;&nbsp; <?php echo number_format((str_replace(',','',$data2['cit'])+$sum4),2) ?></td>
      <td>&nbsp; CIT </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp; <?php echo number_format((str_replace(',','',$data2['edt'])+$sum3),2) ?></td>
      <td>&nbsp; EDT </td>
    </tr>
    <tr>
     <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;<?php echo $lrp2['amount'] ?></td>
      <td>&nbsp;&nbsp;<?php echo $lrp2['taxtype'] ?></td>
    </tr>
           <tr>
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
      <td>&nbsp;&nbsp; <?php echo $data3['tover'] ?> </td>
      <td>&nbsp;&nbsp; <?php 
      
      $sum5=getaddsum($conn,$tinno,$yoa3,'EDT','sum');
      $rate5=getaddsum($conn,$tinno,$yoa3,'EDT','rate');
      $add5=getaddsum($conn,$tinno,$yoa3,'EDT','add');
      $ap5=number_format((str_replace(',','',$data3['edt'])+$sum5)/($rate5/100),2);
      
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
      $tp6=number_format((str_replace(',','',$data3['cit'])+$sum6)/($rate6/100),2);
      
      if ($add6==true){
        echo $tp6;
               
      }else {
        echo $data3['tprofit'];
      }
        
        
        
        ?></td>
      <td>&nbsp;&nbsp; <?php echo number_format((str_replace(',','',$data3['cit'])+$sum6),2) ?></td>
      <td>&nbsp; CIT </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp; <?php echo number_format((str_replace(',','',$data3['edt'])+$sum5),2) ?></td>
      <td>&nbsp; EDT </td>
    </tr>
    <tr>
     <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;<?php echo $lrp3['amount'] ?></td>
      <td>&nbsp;&nbsp;<?php echo $lrp3['taxtype'] ?></td>
     
    </tr>
     <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
</tbody>
 </table>
 
</div>
<script type="text/javascript" src="js3/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="js3/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js3/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="js3/pdfmake.min.js"></script>
    <script type="text/javascript" src="js3/vfs_fonts.js"></script>
    <script type="text/javascript" src="js3/buttons.html5.min.js"></script>
    <script type="text/javascript" src="js3/jszip.min.js"></script>





    <!--the button initialization-->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Brtip',
            select: true,
            ordering:false,
            paging: false,
                buttons: [
                      
                    {
                        extend: 'collection',
                        text: 'Export Report As >',
                        buttons: [
                            'copy',
                            'excel',
                            'csv',
                            {
                                extend: 'pdf',
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