<?php


include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
//$term="";
$table="assdelete";
$term=date('Y');

$table = isset($_REQUEST['catb']) ? $_REQUEST['catb'] : "assdelete";

$term = isset($_REQUEST['cata']) ? $_REQUEST['cata'] : date('Y');

$showterm="Assessment Registers";

$tableshow="Delete Trails";

if ($table=='selfvatdelete') {
   $sql="SELECT * FROM selfdelete WHERE capdate LIKE '%".$term."%' && asstype LIKE '%VAT%' ORDER BY sno DESC";
}else if ($table=='selfdelete') {
   $sql="SELECT * FROM selfdelete WHERE capdate LIKE '%".$term."%' && asstype NOT LIKE '%VAT%' ORDER BY sno DESC";
}else {

 $sql="SELECT * FROM $table WHERE capdate LIKE '%".$term."%' ORDER BY sno DESC";
   
}


$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}




$assheader='    <th>S/No.</th>
                <th>Tin</th>
                <th>Company name</th>
                <th>YOA</th>
                <th>Date Raised</th>
                <th>Tax Type</th>
                <th>Amount</th>
                <th>Assmt No</th>
                <th>Assmt Type</th>
                <th>Raised by</th>
                <th>Action Date</th>
                <th>Actions</th>
                <th>Actions by</th>
           ';
$lrpheader='    <th>S/No.</th>
                <th>Tin</th>
                <th>Company name</th>
                <th>YOA</th>
                <th>Defaults</th>
                <th>Tax Type</th>
                <th>Amount</th>
                <th>Assmt No</th>
                <th>Assmt Type</th>
                <th>Action Date</th>
                <th>Actions</th>
                <th>Actions by</th>
           ';

$selfheader='   <th>S/No.</th>
                <th>Tin</th>
                <th>Company name</th>
                <th>YOA</th>
                <th>Date Received</th>
                <th>Received by</th>
                <th>CIT</th>
                <th>EDT</th>
                <th>Assmt Type</th>
                <th>Assmt No</th>
                <th>Action Date</th>
                <th>Actions</th>
                <th>Actions by</th>
            ';
$selfvatheader=' <th>S/No.</th>
                <th>Tin</th>
                <th>Company name</th>
                <th>YOA</th>
                <th>Date Received</th>
                <th>Received by</th>
                <th>VAT Amount</th>
                <th>Record Type</th>
                <th>Track No</th>
                <th>Action Date</th>
                <th>Actions</th>
                <th>Actions by</th>
            ';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report- <?php echo $showterm ?> <?php echo $tableshow ?> </title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
<!--    <link rel="stylesheet" href="css3/style4.css">-->
    
    
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
     
     
     
    
                      
   
</head>
<body>
  <div class="panel ">
  	<h3 class="pull-center"> &nbsp;Audit Users Delete Trails</h3>
  </div>
   <div class="container-fluid">
   <div class="row-fluid col-md-12">
   <div id="verify">
    <form name="search" action="audittrail "  method="post">
       
                
                    <label for="">Action Taken In:</label>
                   <input name="cata" value="<?php echo $term ?>" />
                       
                       
                  
              
               &nbsp;&nbsp;
                    <label for="coyname">Choose Register:</label>
                    <select name=catb onchange="this.form.submit();">
                       
        <option value="<?php echo $table ?>"><?php 
			
			if($table=='selfvatdelete'){
				echo 'Self Asmt Reg (VAT)';
			}else if($table=='assdelete'){
				echo 'Govt Asmt Registers';
			}else if($table=='selfdelete'){
				
				echo 'Self Asmt Register';
			}else{
                echo 'LRP/LSP Register';
            }
			?> </option>
                       <option value="assdelete">Govt Asmt Registers</option>
                       <option value="selfdelete">Self Asmt Register</option>
                       <option value="lrpdelete">LRP/LSP Register</option>
                       <option value="selfvatdelete">Self Asmt Reg (VAT)</option>
                       
                       
                               
                                              
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
           <?php
	if ($table=='lrpdelete') {
       echo $lrpheader;
    }			
	if($table=='assdelete'){
		 echo $assheader;
    }
    if($table=='selfdelete'){
		echo $selfheader;
	}
    if($table=='selfvatdelete'){
		echo $selfvatheader;
	}
					
					
					
					
					?>
              </tr>
        </thead>
        <tbody>
<?php 
	if($table=='lrpdelete'){
		
		$no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
            
             $amt2=number_format(str_replace(',','',$row['amount']),2);
            echo '<tr>

                
                   <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$row['coyname'].'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['dmonth'].'</td>
                    <td>'.$row['taxtype'].'</td>
                    <td>'.$amt2.'</td>
                    <td>'.$row['asmno'].'</td>
                    <td>'.$row['tabletype'].'</td>
                    <td>'.$row['capdate'].'</td>
                    <td>'.$row['action'].'</td>
					<td>'.$row['user'].'</td>
                    
                    
                </tr>';
            
            $no++;
        }
		
		
	}
	if($table=='assdelete'){
		
		$no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
            
             $amt2=number_format(str_replace(',','',$row['amount']),2);
            echo '<tr>

                
                   <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$row['coyname'].'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['datecap'].'</td>
                    <td>'.$row['taxtype'].'</td>
                    <td>'.$amt2.'</td>
                    <td>'.$row['asmno'].'</td>
                    <td>'.$row['basis'].'</td>
                    <td>'.$row['raisedby'].'</td>
                    <td>'.$row['capdate'].'</td>
                    <td>'.$row['action'].'</td>
					<td>'.$row['user'].'</td>
                    
                    
                </tr>';
            
            $no++;
        }
		
		
    }
    
    if($table=='selfdelete'){
		
		$no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
            
            
            echo '<tr>

                
                   <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$row['coyname'].'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['datecap'].'</td>
                    <td>'.$row['capby'].'</td>
                    <td>'.$row['cit'].'</td>
                    <td>'.$row['edt'].'</td>
                    <td>'.$row['asstype'].'</td>
                    <td>'.$row['assno'].'</td>
                    <td>'.$row['capdate'].'</td>
                    <td>'.$row['action'].'</td>
					<td>'.$row['user'].'</td>
                    
                    
                </tr>';
            
            $no++;
        }
		
		
		
	}
	
    if($table=='selfvatdelete'){
		
		$no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
            
            
            echo '<tr>

                
                   <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$row['coyname'].'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['datecap'].'</td>
                    <td>'.$row['capby'].'</td>
                    <td>'.$row['cit'].'</td>
                    <td>'.$row['asstype'].'</td>
                    <td>'.$row['assno'].'</td>
                    <td>'.$row['capdate'].'</td>
                    <td>'.$row['action'].'</td>
					<td>'.$row['user'].'</td>
                    
                    
                </tr>';
            
            $no++;
        }
		
		
		
	}
	
	
	
	

        ?>
            

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