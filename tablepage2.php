<?php 

include_once(dirname(__FILE__) . '/dbconfig/config.php');
$table = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
$suser= isset($_REQUEST['user']) ? $_REQUEST['user'] : null;

$sql= "SELECT * FROM $table ORDER BY sno DESC";
// $sql= "SELECT * FROM $table ORDER BY STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') ASC";
        
$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}


$showlabel='<div class="text-center"><h3> ALL '.strtoupper(str_replace("_"," ",$table)).' SELF ASSESSMENT REGISTER</h3></div>';


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RPP Office Assistant -<?php echo $table ?>  Register Report</title>
    <link rel="stylesheet" href="css3/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css3/buttons.dataTables.min.css">
    <!-- <link rel="stylesheet" href="css3/dataTables.bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="css3/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="css3/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css3/bootstrap.min.css">
   


</head>
<body>
   <?php echo $showlabel ?>
    <table id="example" class="display" width="100%" cellspacing="0">
       <div id="showcount" class="text-center"><font   color="red" ><?php echo $count ?> Record(s) Found</font></div>
          <div class="row main">
    <div class="col-lg-4"></div>
    <div class="col-lg-4"> <div class="form-group has-feedback has-search">
    <span class="glyphicon glyphicon-search form-control-feedback"></span>
    <input  id="searchbox" type="text" class="form-control" placeholder="Search">
  </div></div>
    <div class="col-lg-4"></div>

   </div>
         <thead>
            <tr>
                <th>S/No.</th>
                <th>Tin</th>
                <th>Company</th>
                <th>Turnover</th>
                <th>YOA</th>
                <th>Ass Profit</th>
                <th>Total Profit</th>
                <th>CIT Filed</th>
                <th>EDT Filed</th>
                <th>Assmt No</th>
                <th>Date Filed</th>
                <th>Received By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
            $assmtno  = $row['citass'];
            $user=$row['user']?$row['user']: 'Admin';
            echo '<tr>

                
                    <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$row['coyname'].'</td>
                    <td>'.number_format($row['turnover'],2).'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.number_format($row['aprofit'],2).'</td>
                    <td>'.number_format($row['tprofit'],2).'</td>
                    <td>'.number_format($row['cit'],2).'</td>
                    <td>'.number_format($row['edt'],2).'</td>
                     <td>'.$assmtno.'</td>
                      <td>'.$row['capdate'].'</td>
                      <td>'.$user.'</td>
                    <td><a data-toggle="tooltip" title="View Record!"target="dframe" href="view?tin='.$row['tinno'].'&user='.$suser.'&tab='.$table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-print" alt="View Records"></span></a>
                        <a data-toggle="tooltip" title="Edit Record!"target="dframe" href="edit?tin='.$row['tinno'].'&user='.$suser.'&tab='.$table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-edit" alt="edit Records"></span></a>
                        <a  class="badge" style="background:red" data-toggle="tooltip" title="Delete Record!"target="dframe" href="delete?tin='.$row['tinno'].'&user='.$suser.'&tab='.$table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-trash" alt="Delete Records"></span></a>
                    </td>
                    
                </tr>';
            
            $no++;
        }?>
            

        </tbody>
    </table>


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

$(document).ready(function() {
    var dataTable = $('#example').dataTable();
    $("#searchbox").keyup(function() {
        dataTable.fnFilter(this.value);
    });    
});

      /* $(document).ready(function() {
       $('#example').DataTable( {
       dom: 'Bfrtip',
       buttons: ['copy','excel','csv','pdf']
           } );
       } );*/
       
   </script>
    
</body>
</html>