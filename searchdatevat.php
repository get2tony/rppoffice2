<?php


include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');

$term="vat";
$table="vatreg";
$dt1="";
$dt2="";
$termlabel="";
$dated=date('Y')."-".date('m')."-01";
$date1=date_format(date_create($dated),"d-m-Y");
$date2=date('d-m-Y'); 

$table = isset($_REQUEST['catb']) ? $_REQUEST['catb'] : "vatreg";
$term = isset($_REQUEST['cata']) ? $_REQUEST['cata'] : "vat";
$date1 = isset($_REQUEST['stdate']) ? $_REQUEST['stdate'] : $date1;
$date2= isset($_REQUEST['spdate']) ? $_REQUEST['spdate'] : $date2;

$fdate1=date_format(date_create($date1),"Y/m/d");
$fdate2=date_format(date_create($date2),"Y/m/d");

if($term=="vat"){
    $termlabel="VAT";
   
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') BETWEEN '$fdate1' AND '$fdate2' ";
}

if($term=="nil"){
     $termlabel="NIL";
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') BETWEEN '$fdate1' AND '$fdate2' && amount=0";
}
if($term=="non"){
     $termlabel="Non";
    
$sql=" SELECT * FROM `$table` WHERE `capdate`='' AND `amount` ='' ";
}


$showterm="All Taxpayers";
$tableshow=ucwords(str_replace("_"," ",$table));


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
    <title>Report-<?php echo $termlabel ?> Filed between <?php echo date_format(date_create($date1),"d-m-Y") ?> to <?php echo date_format(date_create($date2),"d-m-Y") ?></title>
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
       
       <label for="coyname">Register:</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name=catb>
                       <option value="vatreg">VAT Register</option>        
                   </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for=""> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Value :</label>&nbsp;&nbsp;&nbsp;
        <select name="cata" id="" onchange="this.form.submit();">
<option value="<?php echo $term?>">
    <?php 
    
    if($term=="cit"){
    echo "CIT & EDT";
    }else{
        echo strtoupper($term);
    }
        ;        
                ?> Filers</option>
            <option value="vat">VAT Filers</option>
            <option value="nil">VAT Nil Filers</option>
            <option value="non">VAT Non Filers</option>
           
            
            
        </select>
    </div>
        
    </div>       
       
       
 </form>  
      
       </div>
               
               
                <hr>
                
                <div class="row-fluid col-md-12">
                <div class="text-center"> <font  color="red"><?php echo $count ?> Record(s) Found From VAT Register that filed <?php echo $termlabel ?> between <?php echo date_format(date_create($date1),"d-m-Y") ?> to <?php echo date_format(date_create($date2),"d-m-Y") ?> </font></div>
                <table id="example" class="display" width="100%" cellspacing="0">
                
        <thead>
            <tr>
                <th>S/No</th>
                <th>Tin</th>
                <th>Company</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Month Filed</th>
                <th>VAT Amount Filed</th>
                <th>Date Filed</th>
                <th>Payment Date</th>
                <th>Basis</th>
                <th>Default days</th>
                <th>NOB / Remarks</th>
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {

            $amt=$row["amount"];
                if($amt=="") {
                    $amt="Not Filed";
                }
            if (preg_match('#[0-9]#',$amt)) {
             $amt= number_format($amt,2);   # code...
            }
            if (preg_match('#[0-9]#',$amt) && $amt==0) {
               $amt='NIL' ;# code...;
            }
           
          
             
            echo '<tr>

                
                    <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$row['coyname'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td>'.$row['month'].' '.$row['yoa'].'</td>
                    <td>'.$amt.'</td>
                    <td>'.$row['capdate'].'</td>
                    <td>'.$row['paydate'].'</td>
                    <td>'.$row['basis'].'</td>
                    <td>'.$row['defaultdays'].'</td>
                    <td>'.$row['remark'].'</td>
                </tr>';
            
            $no++;
        }?>
            

        </tbody>
    </table>
     <!-- <td>'.number_format((float)str_replace(',','',$row['amount']),2).'</td> -->
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