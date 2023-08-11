<?php


include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once(dirname(__FILE__) . '/vatmethods.php');

$term="cit";
$table="current";
$dt1="";
$dt2="";
$termlabel="";
$dated=date('Y')."-".date('m')."-01";
$date1=date_format(date_create($dated),"d-m-Y");
$date2=date('d-m-Y'); 

$table = isset($_REQUEST['catb']) ? $_REQUEST['catb'] : "current";
if ($table=='both_self') {
    $sqlmain = 'CREATE TEMPORARY TABLE IF NOT EXISTS both_self AS  SELECT * FROM current UNION  SELECT * FROM back_year ';
    $query1 = mysqli_query($conn, $sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query1) {
        die('SQL Error: ' . mysqli_error($conn));
    } else {
        $table = 'both_self';
    }
}
$term = isset($_REQUEST['cata']) ? $_REQUEST['cata'] : "cit";
if ($term=="CIT/WHT Notes") {
    $term="whtcr";# code...
}
if ($term=="Exempted") {
    $term="exempt";# code...
}
if ($term=="Instalment") {
    $term="inst";# code...
}
if ($term=="Cash & WHT Notes") {
    $term="bothcr";# code...
}
if ($term=="NITDF Levy") {
    $term="nitd";# code...
}


$date1 = isset($_REQUEST['stdate']) ? $_REQUEST['stdate'] : $date1;
$date2= isset($_REQUEST['spdate']) ? $_REQUEST['spdate'] : $date2;

$fdate1=date_format(date_create($date1),"Y/m/d");
$fdate2=date_format(date_create($date2),"Y/m/d");

if($term=="cit"){
    $termlabel="CIT & EDT";
   
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d/%m/%Y') BETWEEN '$fdate1' AND '$fdate2' ";
}

if($term=="nil"){
     $termlabel="NIL";
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d/%m/%Y') BETWEEN '$fdate1' AND '$fdate2' && (niltax like 'yes' || cit < 1)";
}
if($term=="whtcr"){
     $termlabel="WHT CR Notes";
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d/%m/%Y') BETWEEN '$fdate1' AND '$fdate2' && paytype like '%WHT Credit Note'";
}
if($term=="nitd"){
     $termlabel="NITDF Levy";
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d/%m/%Y') BETWEEN '$fdate1' AND '$fdate2' && nitd >1";
}
if($term=="bothcr"){
     $termlabel="WHT CR & CASH";
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d/%m/%Y') BETWEEN '$fdate1' AND '$fdate2' && paytype like 'Cash & WHT'";
}
if($term=="exempt"){
     $termlabel="Exempted";
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d/%m/%Y') BETWEEN '$fdate1' AND '$fdate2' && paytype like 'Exempted'";
}
if($term=="inst"){
     $termlabel="Instalment";
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d/%m/%Y') BETWEEN '$fdate1' AND '$fdate2' && paytype like 'Instalment'";
}

if($term=="min"){
     $termlabel="Minimum Tax";
    
$sql=" SELECT * FROM `$table` WHERE STR_TO_DATE(`$table`.`capdate`, '%d/%m/%Y') BETWEEN '$fdate1' AND '$fdate2' && (mintax like 'yes'|| tprofit < 1 && cit>1)";
}
$showterm="All Taxpayers";
$tableshow=ucwords(str_replace("_"," ",$table));


$query=mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);

if (!$query) {
    
    die ('SQL Error: ' . mysqli_error($conn));
}

function conDuedate($yrend,$due,$yoa)
{
    if ($yrend=='January' || $yrend=='February' || $yrend=='March'|| $yrend =='April' || $yrend =='May' || $yrend == 'June') {
        $yoa=$yoa-1;
    }


    switch ($due) {
        case '31January':
            return "31/01/".$yoa;
            break;
        case '28February':
            return "28/02/".$yoa;
            break;
        case '31March':
            return "31/03/".$yoa;
            break;
        case '30April':
            return "30/04/".$yoa;
            break;
        case '31May':
            return "31/05/".$yoa;
            break;
        case '30June':
            return "30/06/".$yoa;
            break;
        case '31July':
            return "31/07/".$yoa;
            break;
        case '31August':
            return "31/08/".$yoa;
            break;
        case '30September':
            return "30/09/".$yoa;
            break;
        case '31October':
            return "31/10/".$yoa;
            break;
        case '30November':
            return "30/11/".$yoa;
            break;
        case '31December':
            return "31/12/".$yoa;
            break;
    }
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
       
       <label for="coyname">Choose Register:</label>
                    <select name=catb onchange="this.form.submit();">
                       <option value="<?php echo $table ?>"><?php
            if ($table == 'current') {
                echo 'Current Register';
            }
            if ($table == 'back_year') {
                echo 'Back Year Register';
            }
            if ($table == 'both_self') {
                echo 'Both Registers';
            }
                       
                       ?></option>
                       <option value="current">Current Register</option>
                       <option value="back_year">Back Year Register</option>
                       <option value="both_self">Both Registers</option>
                       
                                              
                   </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for=""> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Value :</label>&nbsp;&nbsp;&nbsp;
        <select name="cata" id="" onchange="this.form.submit();">
<option value="<?php 

if ($term=="whtcr") {
    $term="CIT/WHT Notes";# code...
}
if ($term=="bothcr") {
    $term="Cash & WHT Notes";# code...
}
if ($term=="inst") {
    $term="Instalment";# code...
}
if ($term=="exempt") {
    $term="Exempted";# code...
}
if ($term=="nitd") {
    $term="NITDF Levy";# code...
}

echo $term?>">
    <?php 
    
    if($term=="cit"){
    echo "CIT & EDT Filers";
    }elseif($term=='nil' || $term=='min'){
        echo strtoupper($term).' Filers';
    }else {
        echo $term;
    }
        ;        
                ?> </option>
            <option value="cit">CIT &amp; EDT Filers</option>
            <option value="nil">Nil Filers</option>
            <option value="min">Min Filers</option>
            <option value="whtcr">CIT/WHT Notes</option>
            <option value="bothcr">Cash &amp; WHT Notes</option>
            <option value="nitd">NITDF Levy</option>
            <option value="exempt">Exempted</option>
            <option value="inst">Instalment</option>

            
            
        </select>
    </div>
        
    </div>       
       
       
 </form>  
      
       </div>
               
               
                <hr>
                
                <div class="row-fluid col-md-12">
                <div class="text-center"> <font  color="red"><?php echo $count ?> Record(s) Found From <?php echo $tableshow ?> Register that filed <?php echo $termlabel ?> between <?php echo date_format(date_create($date1),"d-m-Y") ?> to <?php echo date_format(date_create($date2),"d-m-Y") ?> </font></div>
                <table id="example" class="display" width="100%" cellspacing="0">
                
        <thead>
            <tr>
                <th>S/No</th>
                <th>Tin</th>
                <th>Company</th>
                <th>Address</th>
                <th>Turnover</th>
                <th>Cost</th>
                <th>Fixed Assets</th>
                <th>Ass Profit</th>
                <th>Total Profit</th>
                <th>Capital Allow</th>
                <th>CIT Filed</th>
                <th>EDT Filed</th>
                <th>NITDF Filed</th>
                <th>Assmt No</th>
                <th>EDT Assmt No</th>
                <th>Assmt Year</th>
                <th>Year End</th>
                <th>Due Month</th>
                <th>Due Date</th>
                <th>Date Filed</th>
                <th>Nil Filed</th>
                <th>Min Tax Filed</th>
                <th>NOB / Remarks</th>
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
            $assmtno  = $row['citass'];
            $duedate= str_replace(' ','',$row['duedate']);
            $nu_duedate= conDuedate($row['yearend'],$duedate, $row['yoa']);
                $aprofit= str_replace(',','',$row['aprofit']);
                $tprofit= str_replace(',','',$row['tprofit']);
                $ca = ($aprofit - $tprofit);
                if ($ca < 1) {
                    $ca = 0;
                }
                if ($aprofit > 0 && $tprofit < 1) {
                    $ca = 0;
                }
            $tinno = $row['tinno'];
            $nob = getnob($conn, $tinno);
            if ($nob == 'N/A') {
                $nob = $row['remark'];
            }  
            echo '<tr>

                
                    <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$row['coyname'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.number_format((float)str_replace(',','',$row['turnover']),2).'</td>
                    <td>'.number_format((float)str_replace(',','',$row['cost']),2).'</td>
                    <td>'.number_format((float)str_replace(',','',$row['fa']),2).'</td>
                    <td>'.number_format((float)str_replace(',','',$row['aprofit']),2).'</td>
                    <td>'.number_format((float)str_replace(',','',$row['tprofit']),2).'</td>
                    <td>'.number_format($ca,2).'</td>
                    <td>'.number_format((float)str_replace(',','',$row['cit']),2).'</td>
                    <td>'.number_format((float)str_replace(',','',$row['edt']),2).'</td>
                    <td>'.number_format((float)str_replace(',','',$row['nitd']),2).'</td>
                     <td>'.$assmtno.'</td>
                     <td>'.$row['edtass'].'</td>
                     <td>'.$row['yoa'].'</td>
                     <td>'.$row['yearend'].'</td>
                     <td>'. $row['duedate'].'</td>
                     <td>'. $nu_duedate.'</td>
                     <td>'.$row['capdate'].'</td>
                     <td>'.$row['niltax'].'</td>
                     <td>'.$row['mintax'].'</td>
                     <td>'.$nob.'</td>
                </tr>';
            
            $no++;
        }?>
            

        </tbody>
    </table>
                </div>
                <!--end of  second row-->
            
           
          
   
   

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