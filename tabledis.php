<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');


$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$errormsg='';
$errormsg2='';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
// $userstatus='admin';
$userstatus=isset($_REQUEST['ustatus']) ? $_REQUEST['ustatus'] : checkUserstatus2($usersno,$conn);

$showlabel='<div class="text-center"><h3>DISCHARGED GOVERNMENT ASSESSMENTS </h3></div>';

$table = 'adminasreg';   
$sql="SELECT * FROM adminasreg WHERE `approval`  LIKE 'discharged' ORDER BY capdate DESC";


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
    <title>Search Govt Asmt Register</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
     
     
   <style>
  #foo {
  background: none!important;
  border: none;
  padding: 0!important;
  color: #337AB7;
  text-decoration: underline;
  cursor: pointer;
    }
  
  </style>          
    
                      
   
</head>
<body>
 <?php echo $showlabel;?>
   <div class="container-fluid">
   <div class="row-fluid col-md-12">
   <div id="verify">
     <div id="showcount" class="text-center"><font   color="red" ><?php echo $count ?> Record(s) Found</font></div><br>
   <div class="row main">
    <div class="col-lg-4"></div>
    <div class="col-lg-4"> <div class="form-group has-feedback has-search">
    <span class="glyphicon glyphicon-search form-control-feedback"></span>
    <input  id="searchbox" type="text" class="form-control" placeholder="Search">
    <marquee behavior="alternate"> <font color="#FF0000"><?php echo $errormsg2 ?></font></marquee><marquee behavior="alternate"> <font color="green"><?php echo $errormsg ?></font></marquee>
  </div></div>    
                <div class="row-fluid col-md-12">
                <table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S/No.</th>
                <th>Tin</th>
                <th>Company</th>
                <th>Status</th>
                <th>Asmt Year</th>
                <th>Tax Type</th>
                <th>Amount</th>
                <th>Assmt No</th>
                <th>Basis</th>
                <th>Discharged by</th>
                <th>Date Discharged</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
            $assmtno  = $row['asmtno'];
			$coyname=str_replace("&","%26",$row['coyname']);
            $address= str_replace("&","%26",$row['address']);
            $coyname2=$row['coyname'];
            $address2= $row['address'];
			$taxtype=$row['taxtype'];
			$page='viewass';
			$editpage='editass';
			if($taxtype=='VAT'){
				$page='viewvatass';
				$editpage='editvatass';
			}
			
	    if($userstatus=='user'){
				 echo '<tr>

                    <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$coyname2.'</td>
                   
                    <td>'.$row['approval'].'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['taxtype'].'</td>
                    <td>'.number_format(str_replace(",","",$row['amount']),2).'</td>
                    <td>'.$row['asmtno'].'</td>
                    <td>'.$row['basis'].'</td>
                    <td>'.$row['appby'].'</td>
                    <td>'.$row['appdate'].'</td>
                    
                   
                    
                </tr>';
            
		}else{
				
				 echo '<tr>

                   <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$coyname2.'</td>
                    <td><div class="label-warning">'.strtoupper($row['approval']).'</div></td>
                    
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['taxtype'].'</td>
                  
                    <td>'.number_format(str_replace(",","",$row['amount']),2).'</td>
                    <td>'.$row['asmtno'].'</td>
                    <td>'.$row['basis'].'</td>
                    <td>'.$row['appby'].'</td>
                    <td>'.$row['appdate'].'</td>
                     
                    
                    <td><a class="btn btn-primary" target="dframe" onClick="" href="doapprove2?usersno='.$usersno.'&tin='.$row['tinno'].'&user='.$suser.'&tab='.$table.'&status='.$userstatus.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-ok"></span> Restore Asmt</a></td>
					  
                </tr>';
          
				
			}
           
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