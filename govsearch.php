<?php 

include_once(dirname(__FILE__) . '/dbconfig/config.php');
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : null;
$table = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;

if($type=="boj"){
    
  $sql= "SELECT * FROM `adminasreg` WHERE `basis` LIKE '$type' && `approval` LIKE 'approved'";  
    
}else{

$sql= "SELECT * FROM `adminasreg` WHERE `taxtype` LIKE '$type' && `approval` LIKE 'approved' ";
 $table="adminasreg";
$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
}

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}





 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RPP Office Assistant - Register Records</title>
    <link rel="stylesheet" href="css3/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css3/buttons.dataTables.min.css">
    <!-- <link rel="stylesheet" href="css3/dataTables.bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="css3/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="css3/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css3/bootstrap.min.css">
   


</head>
<body>
   <font  class="pull-center" color="red"><?php echo $count ?> Record(s) Found</font>
    <table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S/No.</th>
                <th>Tin</th>
                <th>Company</th>
                <th>Address</th>
                <th>Asmt Year</th>
                <th>Tax Type</th>
               
                <th>Amount</th>
                <th>Assmt No</th>
                <th>Basis</th>
                <th>Date Raised</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
           
			$coyname=str_replace("&","%26",$row['coyname']);
            $address= str_replace("&","%26",$row['address']);
            $coyname2=$row['coyname'];
            $address2= $row['address'];
			$page='viewass';
			$taxtype=$row['taxtype'];
			$editpage='editass';
			if($taxtype=='VAT'){
				$page='viewvatass';
				$editpage='editvatass';
			}
			
            echo '<tr>

                
                    <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$coyname2.'</td>
                    <td>'.$address2.'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['taxtype'].'</td>
                  
                    <td>'.$row['amount'].'</td>
                    <td>'.$row['asmtno'].'</td>
                    <td>'.$row['basis'].'</td>
                    <td>'.$row['capdate'].'</td>
                    
                    <td><a data-toggle="tooltip" title="View Record!"target="_blank" href="'.$page.'?data1='.$row['tinno'].'&data2='.$coyname.'&data3='.$address.'&data4='.$row['yoa'].'&data5='.$row['capdate'].'&data6='.$row['amount'].'&data7='.$row['basis'].'&data8='.$row['taxtype'].'&data9='.$row['asmtno'].'"><span class="glyphicon glyphicon-print" alt="View Records"></span></a>
                        <a data-toggle="tooltip" title="Edit Record!"target="dframe" href="'.$editpage.'?tin='.$row['tinno'].'&tab='.$table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-edit" alt="edit Records"></span></a>
                        <a  data-toggle="tooltip" title="Delete Record!"target="dframe" href="deleteass?tin='.$row['tinno'].'&tab='.$table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-trash" alt="Delete Records"></span></a>
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
            dom: 'Bfrtip',
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



      /* $(document).ready(function() {
       $('#example').DataTable( {
       dom: 'Bfrtip',
       buttons: ['copy','excel','csv','pdf']
           } );
       } );*/
       
   </script>
    
</body>
</html>