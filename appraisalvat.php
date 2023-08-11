<?php 

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');


$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$user = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$sno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;

$sql= "SELECT * FROM `rppusers`WHERE checked='yes' AND dept='vat' ";

$query = mysqli_query($conn,$sql);

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}





 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RPP Office Assistant - User Accounts</title>
    <link rel="stylesheet" href="css3/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css3/buttons.dataTables.min.css">
    <!-- <link rel="stylesheet" href="css3/dataTables.bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="css3/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="css3/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css3/bootstrap.min.css">
   


</head>
<body>
   
  
        <table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S/No.</th>
                <th>Staff Name</th>
                <th>No. of Accounts Received</th>
                <th></th>
                <th>No. of LRP Raised</th>
                <th></th>
                <th>No. of Add Asmt Raised</th>
                <th></th>
                <th>Value of  Add Asmts</th>
                <th></th>
                <th>Status</th>
                <th></th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
       
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
   					
				    $name=strtoupper($row['name'].' '.$row['surname']);
					
					$value=number_format(returnAssvalue(strtolower($name),$conn),2);
					$asco=returnAsscount($name,$conn);
					$lrpcount=returnLRPcount($name,$conn);
					$selfcount=returnSelfcount($name,$conn);
						
			
			
			
               echo ' <tr>
               <td>'.$no.'</td>
                    <td>'.$name.'</td>
                    <td>'.$selfcount.'</td>
                    <td></td>
                    <td>'.$lrpcount.'</td>
					<td></td>
                    <td>'.$asco.'</td>
					<td></td>
                    <td>'.$value.'</td>
					<td></td>'
                   
                   ;
            ?>    
                 
                     
            <?php 
                   if ($row['approved']=="yes"){
        echo '<td><span class="badge badge-success" style="background:green">Active</span></td>';
                                       
        }else{
                     
        echo '    
                    <td><span class="badge badge-danger" style="background:red" >In-active</span></td>';
            
            
        }
           
        echo  '<td></td>
		<td><a class="btn btn-primary" data-toggle="tooltip" title="View Details!" href="staff_score?sno='.$sno.'&user='.$user.'&serial='.$row['sno'].'">Score Card <span class="glyphicon glyphicon-edit" alt="Edit Records"></span></a>&nbsp;';
		
		?>
	       
        <?php
     
            echo  '</td></tr>';
          $no++;
        }
             ?>
           

        </tbody>
    </table>
<div class="container">
   <div class="row">
    <marquee behavior="alternate"> <font color="#FF0000"><?php echo $errormsg2 ?></font></marquee><marquee behavior="alternate"> <font color="green"><?php echo $errormsg ?></font></marquee>
    </div>
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