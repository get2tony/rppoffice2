<?php


include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');

// $term='';
//
//$table="current";



$table = isset($_REQUEST['catb']) ? $_REQUEST['catb'] : "both_self";
$term = isset($_REQUEST['cata']) ? $_REQUEST['cata'] : date('Y');
$showterm="Minimum Tax Filers";

if($term==''){
    $table="current";
    $term=date('Y');
    
$sql="SELECT * FROM $table WHERE (mintax like 'yes'|| tprofit < 1 && cit>1)&& yoa like '".$term."' ORDER BY capdate DESC";
}if ($table!='both_self') { 
 $sql="SELECT * FROM $table WHERE (mintax like 'yes'|| tprofit < 1 && cit>1)&& yoa like '".$term."' ORDER BY capdate DESC";
 
}else {
    $sqlmain = 'CREATE TEMPORARY TABLE IF NOT EXISTS both_self AS  SELECT * FROM current UNION  SELECT * FROM back_year ';
    $query1 = mysqli_query($conn, $sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query1) {
        die('SQL Error: ' . mysqli_error($conn));
    } else {
        $table = 'both_self';
        $sql="SELECT * FROM $table WHERE (mintax like 'yes'|| tprofit < 1 && cit>1)&& yoa like '".$term."' ORDER BY capdate DESC";
    }
}


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
    <title>Report- <?php echo $showterm ?> From <?php echo $table ?> Register for <?php echo $term ?> YOA</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
<!--    <link rel="stylesheet" href="css3/style4.css">-->
    
    
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
     
     
     
    
                      
   
</head>
<body>
   <div class="container-fluid">
   <div class="row-fluid col-md-12">
   <div id="verify">
    <form name="search" action="minsearchyoa "  method="post">
       
                
                    <label for="">Search For MIN TAX Filers by YOA:</label>
                  <input name="cata" value="<?php echo $term ?>" />
                       
                       
                   
              
               &nbsp;&nbsp;
                    <label for="coyname">Select Register:</label>
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
                        ?> </option>
                       <option value="both_self">Both Registers</option>
                       <option value="current">Current Register</option>
                       <option value="back_year">Back Year Register</option>
                                              
                   </select>
              

                
                        &nbsp;&nbsp;&nbsp;
                        
                        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search </button>&nbsp;&nbsp;&nbsp;
                <font  class="pull-center" color="red"><?php echo $count ?> Record(s) Found of <?php echo $showterm ?> in <?php echo $term ?> YOA </font>
                </form>
       </div>
       </div>
                <hr>
                <div class="row-fluid col-md-12">
                <table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S/No</th>
                <th>Tin</th>
                <th>Company</th>
                <th>Address</th>
                <th>Turnover</th>
                <th>Ass Profit</th>
                <th>Total Profit</th>
                <th>CIT Filed</th>
                <th>EDT Filed</th>
                <th>Assmt No</th>
                <th>EDT Assmt No</th>
                <th>Assmt Year</th>
                <th>Year End</th>
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
            echo '<tr>

                
                    <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$row['coyname'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.number_format($row['turnover'],2).'</td>
                    <td>'.number_format($row['aprofit'],2).'</td>
                    <td>'.number_format($row['tprofit'],2).'</td>
                    <td>'.number_format($row['cit'],2).'</td>
                    <td>'.number_format($row['edt'],2).'</td>
                     <td>'.$assmtno.'</td>
                     <td>'.$row['edtass'].'</td>
                     <td>'.$row['yoa'].'</td>
                     <td>'.$row['yearend'].'</td>
                     <td>'.$row['duedate'].'</td>
                     <td>'.$row['capdate'].'</td>
                     <td>'.$row['niltax'].'</td>
                     <td>'.$row['mintax'].'</td>
                     <td>'.$row['remark'].'</td>
                </tr>';
            
            $no++;
        }?>
            

        </tbody>
    </table>
       
               
               
                
                </div>
                <!--end of second row-->
            
           
           
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