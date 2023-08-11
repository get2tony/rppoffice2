<?php 

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

$table = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
 $suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
 $userno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$ddate=date('Y');
$sql= "SELECT * FROM $table WHERE `capdate` LIKE '%".date('Y')."' && `taxtype` LIKE 'LRP' ORDER BY sno DESC ";
$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}


$showlabel='<div class="text-center"><h3>'.$ddate.' '.strtoupper(str_replace("_"," ",substr($table,3))).' LRP ASSESSMENT REGISTER</h3></div>';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RPP Office Assistant -<?php echo $table  ?> LRP Register Reports</title>
    <link rel="stylesheet" href="css3/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css3/buttons.dataTables.min.css">
    <!-- <link rel="stylesheet" href="css3/dataTables.bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="css3/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="css3/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css3/bootstrap.min.css">
   
<style>
.main {
    width: 100%;
    margin: 5px auto;
}

/* Bootstrap 3 text input with search icon */

.has-search .form-control-feedback {
    right: initial;
    left: 0;
    color: #ccc;
}

.has-search .form-control {
    padding-right: 12px;
    padding-left: 34px;
}
</style>

</head>
<body>
  <?php echo $showlabel  ?>
   <div id="showcount" class="text-center"><font   color="red" ><?php echo $count ?> Record(s) Found</font></div>
   <div class="row main">
    <div class="col-lg-4"></div>
    <div class="col-lg-4"> <div class="form-group has-feedback has-search">
    <span class="glyphicon glyphicon-search form-control-feedback"></span>
    <input  id="searchbox" type="text" class="form-control" placeholder="Search">
  </div></div>
    <div class="col-lg-4"></div>

   </div>
    <table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S/No.</th>
                <th>Tin</th>
                <th>Company</th>
                <th>Address</th>
                <th>Year of Asmt</th>
                <th>Amount</th>
                <th>Year End</th>
                <th>Filing Due Date</th>
                <th>Date Tax Filed</th>
                <th>Default Month(s)</th>
                <th>Date Raised</th>
                <th>Raised by</th>
                <th>Assmt No</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
            $assmtno  = $row['alabel'].$row['asmtno'].$row['ayear'];
			$coyname=str_replace("&"," %26 ",$row['coyname']);
            $address= str_replace("&"," %26 ",$row['address']);
            echo '<tr>

                
                    <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$row['coyname'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['amount'].'</td>
                    <td>'.$row['yearend'].'</td>
                    <td>'.$row['duedate'].'</td>
                    <td>'.$row['datefiled'].'</td>
                    <td>'.$row['DefaultMonth'].'</td>
                    <td>'.$row['capdate'].'</td>
                    <td>'.$row['user'].'</td>
                     <td>'.$assmtno.'</td>
                    <td>
                    
                    
                    <form action="asmtlrp" method="post" target="_blank">
                        
               <input type="hidden" value="'.$row['tinno'].'"  id="data1" name="data1"/>
               <input type="hidden" value="'.$coyname.'"  id="data2" name="data2"/>
               <input type="hidden" value="'.$address.'"  id="data3" name="data3"/>
               <input type="hidden" value="'.$row['yoa'].'"  id="data4" name="data4"/>
               <input type="hidden" value="'.$row['capdate'].'"  id="data5" name="data5"/>
               <input type="hidden" value="'.$row['amount'].'"  id="data6" name="data6"/>
               <input type="hidden" value="'.$row['basis'].'"  id="data7" name="data7"/>
               <input type="hidden" value="'.$row['taxtype'].'"  id="data8" name="data8"/>
               <input type="hidden" value="'.$assmtno.'"  id="data9" name="data9"/>
                    <button  type="Submit" class ="btn btn-primary" data-toggle="tooltip" title="View Record! ">
                        <span class="glyphicon glyphicon-print" alt="View Records"></span> View</button>
                    </form>
                        
                    </td>
                    
                </tr>';
            
            
            $no++;
        }?>
            
            <!-- <a data-toggle="tooltip" title="Edit Record!"target="dframe" href="editlrp?tin='.$row['tinno'].'&yrend='.$row['yearend'].'&user='.$suser.'&tab='.$table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-edit" alt="edit Records"></span></a> -->
                        <!-- <a  class="badge" style="background:red" data-toggle="tooltip" title="Delete Record!"target="dframe" href="deletelrp?tin='.$row['tinno'].'&yrend='.$row['yearend'].'&user='.$suser.'&tab='.$table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-trash" alt="Delete Records"></span></a> -->
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