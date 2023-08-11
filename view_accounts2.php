<?php 

include_once(dirname(__FILE__) . '/dbconfig/config.php');



$sql= "SELECT * FROM `rppusers`";

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
   <div class="panel "><H2>Manage Application Users</H2></div>
   <div>
       <marquee behavior="alternate"> <font color="#FF0000"><?php echo $errormsg ?></font></marquee><marquee behavior="alternate"> <font color="yellow"><?php echo $errormsg2 ?></font></marquee>
       
   </div>
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
                <th>Username</th>
                <th>Staff Name</th>
               
                <th>Access Level</th>
                <th>Date Created</th>
                <th>Status</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
        <tr>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
   
               echo '<td>'.$no.'</td>
                    <td>'.$row['username'].'</td>
                    <td>'.$row['name'].' '.$row['surname'].'</td>
                   
                    <td>'.$row['level'].'</td>
                    <td>'.$row['datecreate'].'</td>';
            ?>    
                 
                     
            <?php 
                   if ($row['approved']=="yes"){
                   echo '    
                    <td><span class="label label-success">Active</span></td>';
                                       
                     }else{
                     
                   echo '    
                    <td><a href="activate_account?sno='.$sno.'&serial='.$row['sno'].'"><span class="label label-danger">Activate</span></a></td>';
            
            
                 }
           
             echo  '<td><a class="btn btn-danger" href="delete_account?sno='.$sno.'&serial='.$row['sno'].'">Delete Account</a></td>';
         }
          
    $no++;   
             ?>
            </tr>

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