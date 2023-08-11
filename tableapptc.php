<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');

$errormsg = '';
$errormsg2 = '';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;


$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$userno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$ustatus = isset($_REQUEST['status']) ? $_REQUEST['status'] : 'user';
$table = "adminasreg";

if ($ustatus == "user") {

    $sql = "SELECT * FROM `$table` WHERE `approval` NOT LIKE 'approved' &&  `user` LIKE '$suser' ";
} else if ($ustatus == "admin") {

    $sql = "SELECT * FROM `$table` WHERE `approval` NOT LIKE 'approved'";
} else {

    $sql = "SELECT * FROM `$table` WHERE `approval` LIKE 'pending'";
}


$query = mysqli_query($conn, $sql);
$count = mysqli_num_rows($query);
if (!$query) {
    die('SQL Error: ' . mysqli_error($conn));
}



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RPP Office Assistant - Pending Assessments</title>
    <link rel="stylesheet" href="css3/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css3/buttons.dataTables.min.css">
    <!-- <link rel="stylesheet" href="css3/dataTables.bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="css3/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="css3/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css3/bootstrap.min.css">



</head>

<body>
    <div class="text-center">
        <h3> ASSESSMENTS AWAITING APPROVAL</h3>
    </div>


    <div id="showcount" class="text-center">
        <font color="red"><?php echo $count ?> Record(s) Found</font>
    </div>
    <p></p>
    <?php
    if ($ustatus != "user" && $count > 1) {

        echo ' <div class="row">
           <div class="col-md-4"></div>
            <div class="col-md-4">
            <a href="appall?user=' . $suser . '&status=' . $ustatus . '" class=" btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp;Approve All</a>&nbsp;<a href="rejectall?user=' . $suser . '&status=' . $ustatus . '" class=" btn btn-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;Reject All</a>
            </div>
            <div class="col-md-4"></div>
            </div><p>';
    }



    ?>

    <table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S/No.</th>
                <th>Tin</th>
                <th>Company</th>
                <th>Asmt Year</th>
                <th>Tax Type</th>
                <th>Amount</th>
                <th>Assmt No</th>
                <th>Basis</th>
                <th>Raised By</th>
                <th>Date Raised</th>
                <th>Actions</th>
                <th>Status</th>
                <th></th>


            </tr>
        </thead>
        <tbody>
            <?php

            $no     = 1;

            while ($row = mysqli_fetch_array($query)) {

                $serial = $row['sno'];
                $asmt = $row['asmtno'];
                $status = $row['approval'];
                if ($status == "rejected") {
                    $showresend = '<a data-toggle="tooltip" title="Resend Record!" target="dframe" href="sendass?tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&sno=' . $row['sno'] . '"><span class="glyphicon glyphicon-repeat" alt="Resend Record" style="color:green;"></span></a>';
                } else {
                    $showresend = "";
                }

                $amount = number_format($row['amount'], 2);
                $taxtype = $row['taxtype'];
                //$checkass=checkApprovalstatus($asmt,$serial,$conn);
                $reject = '<td><a class="btn btn-danger" target="dframe" href="doreject?tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&status=' . $ustatus . '&sno=' . $row['sno'] . '"><span class="glyphicon glyphicon-remove"></span>&nbsp;Reject</a></td>';
                if ($suser == $row[12]) {
                    $page20 = 'editass';
                    if ($taxtype == 'VAT') {
                        $page20 = 'editvatass';
                    }

                    $reject = '<td>
                        <a data-toggle="tooltip" title="Edit Record!"target="dframe" href="' . $page20 . '?tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&sno=' . $row['sno'] . '&status=' . $ustatus . '"><span class="glyphicon glyphicon-edit" alt="edit Records"></span></a>
                        <a  data-toggle="tooltip" title="Delete Record!"target="dframe" href="deleteass2?usersno=' . $usersno . '&tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&sno=' . $row['sno'] . '&status=' . $ustatus . '"><span class="glyphicon glyphicon-trash" alt="Delete Records" style="color:red;"></span></a>     &nbsp;' . $showresend . '  
                    </td>';
                }
                echo '<tr>

                
                    <td>' . $no . '</td>
                    <td>' . $row['tinno'] . '</td>
                    <td>' . $row['coyname'] . '</td>
                    
                    <td>' . $row['yoa'] . '</td>
                    <td>' . $row['taxtype'] . '</td>
                    <td>' . $amount . '</td>
                    <td>' . $row['asmtno'] . '</td>
                    <td>' . $row['basis'] . '</td>
                    <td>' . $row['user'] . '</td>
                    <td>' . $row['capdate'] . '</td>
                    ';

            ?> <?php


                $page2 = 'editass';
                if ($taxtype == 'VAT') {
                    $page2 = 'editvatass';
                }
                if ($ustatus == "user") {
                    echo '<td>
                        <a data-toggle="tooltip" title="Edit Record!"target="dframe" href="' . $page2 . '?tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&sno=' . $row['sno'] . '&status=' . $ustatus . '"><span class="glyphicon glyphicon-edit" alt="edit Records"></span></a>
                        <a  data-toggle="tooltip" title="Delete Record!"target="dframe" href="deleteass2?usersno=' . $usersno . '&tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&sno=' . $row['sno'] . '&status=' . $ustatus . '"><span class="glyphicon glyphicon-trash" alt="Delete Records" style="color:red;"></span></a>     &nbsp;' . $showresend . '  
                    </td>
                    <td><span class=""><strong>' . ucfirst($status) . '</strong></span></td>';
                } else {

                    echo '
					
					<td><a class="btn btn-primary" target="dframe" href="doapprove?tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&status=' . $ustatus . '&sno=' . $row['sno'] . '"><span class="glyphicon glyphicon-ok"></span>&nbsp;Approve</a></td>
                    
                    ' . $reject . '
                    <td><span class=""><strong>' . ucfirst($status) . '</strong></span></td>
                     </tr>';
                }

                $no++;
            }
                ?>


        </tbody>
    </table>
    <div class="container">
        <div class="row">
            <marquee behavior="alternate">
                <font color="#FF0000"><?php echo $errormsg2 ?></font>
            </marquee>
            <marquee behavior="alternate">
                <font color="green"><?php echo $errormsg ?></font>
            </marquee>
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
            $('#example').DataTable({
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
            });
        });



        /* $(document).ready(function() {
         $('#example').DataTable( {
         dom: 'Bfrtip',
         buttons: ['copy','excel','csv','pdf']
             } );
         } );*/
    </script>
    <!-- <script src="inactivity.js"></script> -->
</body>

</html>