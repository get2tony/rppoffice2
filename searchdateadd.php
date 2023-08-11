<?php

include("dbconfig/config.php");
include("dbconfig/methods.php");

$term="cit";
$table="adminasreg";
$dt1="";
$dt2="";
$termlabel="";
$dated=date('Y')."-".date('m')."-01";
$date1=date_format(date_create($dated),"d-m-Y");
$date2=date('d-m-Y'); 

$table = isset($_REQUEST['catb']) ? $_REQUEST['catb'] : "adminasreg";
$term = isset($_REQUEST['cata']) ? $_REQUEST['cata'] : "all";
$date1 = isset($_REQUEST['stdate']) ? $_REQUEST['stdate'] : $date1;
$date2= isset($_REQUEST['spdate']) ? $_REQUEST['spdate'] : $date2;


$fdate1=date_format(date_create($date1),"Y-m-d");
$fdate2=date_format(date_create($date2),"Y-m-d");

if($term=="all"){
    $termlabel="All";
    
$sql="SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') BETWEEN '$fdate1' AND '$fdate2' && approval like 'approved' ";
}
if($term=="cit"){
    $termlabel="CIT";
    
$sql="SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') BETWEEN '$fdate1' AND '$fdate2' && taxtype like 'cit' && approval like 'approved' ";
}

if($term=="edt"){
    $termlabel="EDT";
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') BETWEEN '$fdate1' AND '$fdate2' && taxtype like 'edt' && approval like 'approved'";
}


if($term=="boj"){
     $termlabel="BOJ";
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') BETWEEN '$fdate1' AND '$fdate2' && basis like 'boj' && approval like 'approved'";
}
if($term=="Audit"){
     $termlabel="Audit";
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') BETWEEN '$fdate1' AND '$fdate2' && basis like 'Audit' && approval like 'approved'";
}

if($term=="vat"){
     $termlabel="VAT";
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') BETWEEN '$fdate1' AND '$fdate2' && taxtype like 'vat' && approval like 'approved'";
}

if($term=="wht"){
     $termlabel="WHT";
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') BETWEEN '$fdate1' AND '$fdate2' && taxtype like 'WHT' && approval like 'approved'";
}
if($term=="pol"){
     $termlabel="POL";
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') BETWEEN '$fdate1' AND '$fdate2' && taxtype like 'pol'";
}
$showterm="All Taxpayers";
$tableshow="Additional/Admin";


$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report-  <?php echo $termlabel ?> Raised between <?php echo date_format(date_create($date1),"d-m-Y") ?> to <?php echo date_format(date_create($date2),"d-m-Y") ?></title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
   <link rel="stylesheet" href="jquery-ui.css">
   <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
     
     
     
    
                      
   
</head>
<body>
<div class="container bootstrap-iso">
   
  <form action="" class="form-horizontal">
                   
<div class="row-fliud ">
    <div class="col-md-12">
        <label for="">Date From :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input id="date" type="text" name="stdate"  value="<?php echo $date1?>">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for=""> Date To :</label>
        <input id="date1" type="text" name="spdate" value="<?php echo $date2 ?>">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="btn btn-primary">Search</button>
       
    </div>
</div>
<div class="row-fliud">
 
    <div class="col-md-12">
       
       <label for="coyname">Choose Register:</label>
                    <select name=catb>
            <option value="<?php echo $table ?>">Add/Admin Register</option>
                       <option value="adminasreg">Add/Admin Register</option>
                       
                       
                                              
                   </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Value :</label>&nbsp;&nbsp;&nbsp;
        <select name="cata" id="" onchange="this.form.submit();">
<option value="<?php echo $term?>">
    <?php 
    if ($term!='all') {
       echo strtoupper($term);
    }else {
        echo ucfirst($term);
    }
    ?> Asmts</option>
               
            <option value="all">All Asmts</option>
            <option value="cit">CIT Asmts</option>
            <option value="edt">EDT Asmts</option>
            <option value="Audit">Audit Asmts</option>
            <option value="vat">VAT Asmts</option>
            <option value="pol">POL Asmts</option>
            <option value="wht">WHT Asmts</option>
            <option value="boj">BOJ Asmts</option>
            
            
            
            
        </select>
    </div>
        
    </div>       
       
       
 </form> <p></p> 
      
       </div>
               
               
                <hr>
                
                <div class="row-fluid col-md-12">
				 <div class="text-center"><font   color="red"><?php echo $count ?> Record(s) Found From <?php echo $tableshow ?> Register Raised <?php echo $termlabel ?> between <?php echo date_format(date_create($date1),"d-m-Y") ?> to <?php echo date_format(date_create($date2),"d-m-Y") ?> </font></div>
                <table id="example" class="display" width="100%" cellspacing="0">
                
        <thead>
            <tr>
                <th>S/No</th>
                <th>Tin</th>
                <th>Company</th>
                <th>Address</th>
                <th>YOA</th>
                <th>Date Raised</th>
                <th>Tax Type</th>
                <th>Amount</th>
                <th>T. Profit</th>
                <th>As. Profit</th>
                <th>Assmt No</th>
                <th>Basis</th>
                <th>Period From</th>
                <th>Period To</th>
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
           
            echo '<tr>

                
                    <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$row['coyname'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.$row['yoa'].'</td>
                     <td>'.$row['capdate'].'</td>
                     <td>'.$row['taxtype'].'</td>
                     <td>'.number_format((float)str_replace(',','',$row['amount']),2).'</td>
                     <td>'.number_format((float)str_replace(',','',$row['tprofit']),2).'</td>
                     <td>'.number_format((float)str_replace(',','',$row['assprofit']),2).'</td>
                     <td>'.$row['asmtno'].'</td>
                     <td>'.$row['basis'].'</td>
                     <td>'.$row['startdate'].'</td>
                     <td>'.$row['enddate'].'</td>
                </tr>';
            
            $no++;
        }?>
            

        </tbody>
    </table>
                </div>
                <!--end of second row-->
            
           
          
   
   

<script src="js/jquery-1.12.4.js"></script>
  <script src="jquery-ui.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>
   <script type="text/javascript"> $("#date").datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true });</script>
   <script type="text/javascript"> $("#date1").datepicker({ dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true });</script>
   
    <!--the button initialization-->
    <script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
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
    } );
} );
   </script>
   
   
    
</body>
</html>