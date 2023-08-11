<?php
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
//$term=date('Y');
//$table="current";
$yoa=date('Y')-1;
$showterm="All Taxpayers";

$usersno=isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$username=isset($_REQUEST['user']) ? $_REQUEST['user'] : null;

$table = isset($_REQUEST['catb']) ? $_REQUEST['catb'] : "current";
$term = $yoa;
$showterm="All Taxpayers";


    
 $sql="SELECT * FROM $table WHERE yoa='".$term."' ORDER BY asmtno ASC";
   



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
    <title>Provisional Tax for <?php echo date('Y'); ?> YOA</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
<!--    <link rel="stylesheet" href="css3/style4.css">-->
    
    
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
     
     
     
    
                      
   
</head>
<body>
  <div class="text-center">
  	<h3>Generate Provisional Tax Letters for <?php echo date('Y') ?> YOA </h3>
  </div>
   <div class="container-fluid">
   <div class="row-fluid col-md-12">
   <div id="verify">
    <form name="search" action="listprov "  method="post">
       
                
                   
                       
                       
                   
              
               &nbsp;&nbsp;
                    <label for="coyname">Select Register :</label>
                    <select name=catb onchange="this.form.submit();">
                      
                       <option value="<?php echo $table ?>"><?php echo ucwords(str_replace('_',' ',$table)) ?> Register</option>
                       <option value="current">Current Register</option>
                       <option value="back_year">Back Year Register</option>
                                              
                   </select>
              

                
                        &nbsp;&nbsp;&nbsp;
                        
                        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search </button>&nbsp;&nbsp;&nbsp;
                <font  class="pull-center" color="red"><?php echo $count ?> Record(s) Found</font>
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
                <th>YOA</th>
                <th>Ass Profit</th>
                <th>Total Profit</th>
                <th>CIT Filed</th>
                <th>EDT Filed</th>
                <th>Date Filed</th>
                <th>Action1</th>
                <th>Action2</th>
                
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
            $page='doprov';
			$coyname=str_replace("&"," %26 ",$row['coyname']);
			$coyadd=str_replace('"',' ',$row['address']);
			$coyadd2=str_replace('&',' %26 ',$coyadd);
            echo '<tr>

                
                    <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$row['coyname'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.number_format($row['turnover'],2).'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.number_format($row['aprofit'],2).'</td>
                    <td>'.number_format($row['tprofit'],2).'</td>
                    <td>'.number_format($row['cit'],2).'</td>
                    <td>'.number_format($row['edt'],2).'</td>
                    <td>'.$row['capdate'].'</td>
                     <td><a  class="btn btn-primary" data-toggle="tooltip" title="Raise  Provisional!"target="_blank" href="'.$page.'?data1='.$row['tinno'].'&data2='.$coyname.'&data3='.$coyadd2.'&data4='.$row['yoa'].'&data5='.$row['cit'].'&data6='.$row['edt'].'&data7='.$username.'&data8='.$usersno.'">Print 4 HOD</a>				 
						
                     </td>
					 <td> <a  class="btn btn-success" data-toggle="tooltip" title="Raise  Provisional!"target="_blank" href="doprov2?data1='.$row['tinno'].'&data2='.$coyname.'&data3='.$coyadd2.'&data4='.$row['yoa'].'&data5='.$row['cit'].'&data6='.$row['edt'].'&data7='.$username.'&data8='.$usersno.'">Print 4 U</a></td>
                     
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