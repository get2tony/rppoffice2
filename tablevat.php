<?php 

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$tab = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$ddate=date('Y');
$say='ALL';
if ($tab=='y') {
$say=date('Y');
}


$userstatus=checkUserstatus2($usersno,$conn);

if ($tab=='y') {
 $sql= "SELECT * FROM `vatreg` WHERE `yoa` LIKE '%".date('Y')."' ORDER BY sno DESC ";
}else {
    $sql= "SELECT * FROM `vatreg` ORDER BY sno DESC";
}



 $table="adminasreg";
$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}


$amt='';
$amt2='';
$showlabel='<div class="text-center"><h3>'.$say.' VAT SELF ASSESSMENT REGISTER</h3></div>';

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
  <?php echo $showlabel ?>
   <?php
                    
                   if ($errormsg2==null){
                       
                   
                   
                   }else{
            
                    echo ('<div class="alert-danger" id=""><marquee>'.$errormsg2.'</marquee> </div>');
                   }
                    
                     if ($errormsg==null){
                       
                   
                   
                   }else{
            
                    echo ('  <div class="alert-success" id=""><marquee>'.$errormsg.' </marquee> </div>');
                   }
                    ?>
   <div id="showcount" class="text-center"><font   color="red" ><?php echo $count ?> Record(s) Found</font></div><br>
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
                <th>Year</th>
                <th>Tax Type</th>
                <th>Month Filed</th>
                <th>Amount</th>
                <th>Basis</th>
                <th>Asmt No</th>
                <th>Date Filed</th>
                <th>Payment Date</th>
                <th>Category</th>
                <th>Collected By</th>
                <th>Actions </th>
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
           $amt=str_replace(',','',$row['amount']);
			
			
			if($amt==""){
				$amt=0;
			}
            $amt2=number_format(str_replace(' ','',$amt),2);
			
		    
            echo '<tr>

                
                    <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$row['coyname'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>VAT</td>
                    <td>'.$row['month'].'</td>
                    <td>'.$amt2.'</td>
                    <td>'.$row['basis'].'</td>
                    <td>'.$row['asmno'].'</td>
                    <td>'.$row['capdate'].'</td>
                    <td>'.$row['paydate'].'</td>
                    <td>'.ucfirst($row['category']).'</td>
                    <td>'.$row['capby'].'</td>
                   
                    
                    <td>';

                     if ($userstatus=="user" ){

                        echo '<a  class="btn btn-primary" data-toggle="tooltip" title="Edit Record!" target="dframe" href="editvatreg?tab='.$tab.'&tin='.$row['tinno'].'&serial='.$row['sno'].'&sno='.$usersno.'&user='.$suser.'">View / Edit</a>';

                     }else {
                         echo '<div class="row"><a class="btn btn-primary" data-toggle="tooltip" title="Edit Record!" target="dframe" href="editvatreg?tab='.$tab.'&tin='.$row['tinno'].'&serial='.$row['sno'].'&sno='.$usersno.'&user='.$suser.'"><span class="glyphicon glyphicon-edit" alt="Edit Records"></span></a>
                     <a  class="btn btn-danger"  data-toggle="tooltip" title="Delete Record!" target="dframe" href="deletevatreg?tab='.$tab.'&tin='.$row['tinno'].'&serial='.$row['sno'].'&sno='.$usersno.'&user='.$suser.'"> <span class="glyphicon glyphicon-trash" alt="Delete Records"></span></a></div>';
                     }
                    
                     echo '
                     
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