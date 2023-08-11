<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

$errormsg = '';
$errormsg2 = '';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$tablename = isset($_REQUEST['catb']) ? $_REQUEST['catb'] : 'adminasreg';
$ustatus = isset($_REQUEST['status']) ? $_REQUEST['status'] : checkUserstatus2($usersno, $conn);
$table = 'adminasreg';
$catb = 'adminasreg';

function decideLrp($d)
{
    $tab = 'lrpcurrent';
    if (strpos($d, 'BA')) {
        $tab = 'lrpback_year';
    }
    return $tab;
}



if ($tablename == 'adminasreg') {
    $table = 'adminasreg';
    if ($ustatus == "user") {

        $sql = "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%pending' ||  IFNULL(approval, 0) LIKE '%rejected') AND `user` = '$suser'  ORDER BY STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') DESC";
    } else if ($ustatus == "admin" || $ustatus == "master") {

        $sql = "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%pending') ||  (IFNULL(approval, 0) LIKE '%rejected') AND  `user` = '$suser' ORDER BY STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') DESC";
    } else {

        $sql = "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%pending') ORDER BY STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') DESC";
    }
} else {
    $sqlmain = 'CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT * FROM lrpcurrent UNION  SELECT * FROM lrpback_year ';
    $query1 = mysqli_query($conn, $sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query1) {
        die('SQL Error: ' . mysqli_error($conn));
    } else {
        $table = 'temp_self';
        if ($ustatus == "user") {

            $sql = "SELECT * FROM `$table`  WHERE ( IFNULL(approval, 0) LIKE '%pending' ||  IFNULL(approval, 0) LIKE '%rejected') AND `user` = '$suser'  ORDER BY STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') DESC";
        } else if ($ustatus == "admin" || $ustatus == "master") {

            $sql = "SELECT * FROM `$table`  WHERE ( IFNULL(approval, 0) LIKE '%pending') ||  (IFNULL(approval, 0) LIKE '%rejected') AND  `user` = '$suser' ORDER BY STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') DESC";
        } else {

            $sql = "SELECT * FROM `$table`  WHERE ( IFNULL(approval, 0) LIKE '%pending') ORDER BY STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') DESC";
        }
    }
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
    <div class="text-center">
        <h3><?php if ($tablename == 'lrps') {
                echo 'LRP / LSP';
            } else {
                echo 'ADD / GOVT';
            } ?> ASSESSMENTS AWAITING APPROVAL</h3>
    </div>
    <div>
        <!-- DROPDOWN FORM COMES HERE -->

        <form name="search" action="tableapp " method="post">
            <label for="coyname">Display List:</label>
            <select name=catb onchange="this.form.submit();">
                <option value="<?php echo $tablename ?>"><?php if ($table == 'adminasreg') {
                                                            echo " Gov't Asmt";
                                                        } else {

                                                            echo "Late Penalty Asmt";
                                                        }     ?> </option>
                <option value="adminasreg">Gov't Asmt</option>
                <option value="lrps">Late Penalty Asmt</option>


            </select>
            <input type="hidden" name="sno" value="<?php echo $usersno ?>">
            <input type="hidden" name="user" value="<?php echo $suser ?>">
            <input type="hidden" name="status" value="<?php echo $ustatus ?>">


            &nbsp;&nbsp;&nbsp;

            <!-- <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search </button>&nbsp;&nbsp;&nbsp; -->

        </form>






        <!-- DROPDOWN FORM COMES HERE -->




    </div>

    <div id="showcount" class="text-center">
        <font color="red"><?php echo $count ?> Record(s) Found</font>
    </div>
    <p></p>
    <?php
    if ($ustatus != "user" && $count > 1) {
        if ($tablename == 'lrps') {
            // $asmtno=$row[8].$row[9].$row[10];
            $table = 'lrps';
            $catb = 'lrps';
        }

        echo ' <div class="row">
           <div class="col-md-4"></div>
            <div class="col-md-4">
            <a href="appall?catb=' . $catb . '&tab=' . $table . '&sno=' . $usersno . '&user=' . $suser . '&status=' . $ustatus . '" class=" btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp;Approve All</a>&nbsp;<a href="rejectall?catb=' . $catb . '&tab=' . $table . '&sno=' . $usersno . '&user=' . $suser . '&status=' . $ustatus . '" class=" btn btn-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;Reject All</a>
            </div>
            <div class="col-md-4"></div>
            </div><p>';
    }



    ?>
    <div class="row main">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group has-feedback has-search">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                <input id="searchbox" type="text" class="form-control" placeholder="Search">
            </div>
        </div>
        <div class="col-lg-4"></div>

    </div>

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
                <?php if ($ustatus != 'user') {
                    echo '<th>Actions2</th>';
                }

                ?>
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
                // $as$row['asmtno']

                if ($status == "rejected") {
                    if ($tablename == 'lrps') {
                        $asmtno = $row[8] . $row[9] . $row[10];
                        $table = decideLrp('$asmtno');
                        $catb = 'lrps';
                    }
                    $showresend = '<a data-toggle="tooltip" title="Resend Record!" target="dframe" href="sendass?catb=' . $catb . '&tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&sno=' . $row['sno'] . '&status=' . $ustatus . '&usersno=' . $usersno . '"><span class="glyphicon glyphicon-repeat" alt="Resend Record" style="color:green;"></span></a>';
                } else {
                    $showresend = "";
                }


                $amount = number_format((float)str_replace(',', '', $row['amount']), 2);
                $taxtype = $row['taxtype'];
                if ($tablename == 'lrps') {
                    $asmtno = $row[8] . $row[9] . $row[10];
                    $table = decideLrp('$asmtno');
                    $catb = 'lrps';
                }
                //$checkass=checkApprovalstatus($asmt,$serial,$conn);
                $reject = '<td><a class="btn btn-danger" target="dframe" href="doreject?catb=' . $catb . '&tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&status=' . $ustatus . '&sno=' . $row['sno'] . '"><span class="glyphicon glyphicon-remove"></span>&nbsp;Reject</a></td>';
                if ($suser == $row[12] || $suser == $row[16]) {
                    $asmtno = $row[8] . $row[9] . $row[10];

                    if ($taxtype == 'VAT') {
                        $page20 = 'editvatass';
                        $pagedel = 'deleteass2';
                        $yrend = '';
                    }
                    if ($taxtype == 'CIT') {
                        $page20 = 'editass';
                        $pagedel = 'deleteass2';
                        $yrend = '';
                    }
                    if ($taxtype == 'WHT') {
                        $page20 = 'editass';
                        $pagedel = 'deleteass2';
                        $yrend = '';
                    }
                    if ($taxtype == 'CGT') {
                        $page20 = 'editass';
                        $pagedel = 'deleteass2';
                        $yrend = '';
                    }
                    if ($taxtype == 'EDT') {
                        $page20 = 'editass';
                        $pagedel = 'deleteass2';
                        $yrend = '';
                    }
                    if ($taxtype == 'POL') {
                        $page20 = 'editass';
                        $pagedel = 'deleteass2';
                        $yrend = '';
                    }
                    if ($taxtype == 'TP') {
                        $page20 = 'editass';
                        $pagedel = 'deleteass2';
                        $yrend = '';
                    }
                    if ($taxtype == 'NITDL') {
                        $page20 = 'editass';
                        $pagedel = 'deleteass2';
                        $yrend = '';
                    }
                    if ($taxtype == 'LRP') {
                        $page20 = 'editlrp';
                        $pagedel = 'deletelrp';
                        $table = decideLrp($asmtno);
                        $yrend = $row[15];
                        $catb = 'lrps';
                        $asmt = $asmtno;
                    }
                    if ($taxtype == 'LSP') {
                        $page20 = 'editlrpvat';
                        $pagedel = 'deletelrpvat';
                        $table = decideLrp($asmtno);
                        $yrend = $row[15];
                        $catb = 'lrps';
                        $asmt = $asmtno;
                    }

                    $reject = '<td>
                        <a data-toggle="tooltip" title="Edit Record!"target="dframe" href="' . $page20 . '?catb=' . $catb . '&yrend=' . $yrend . '&tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&sno=' . $row['sno'] . '&status=' . $ustatus . '"><span class="glyphicon glyphicon-edit" alt="edit Records"></span></a>
                        <a  data-toggle="tooltip" title="Delete Record!"target="dframe" href="' . $pagedel . '?catb=' . $catb . '&yrend=' . $yrend . '&usersno=' . $usersno . '&tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&sno=' . $row['sno'] . '&status=' . $ustatus . '"><span class="glyphicon glyphicon-trash" alt="Delete Records" style="color:red;"></span></a>     &nbsp;' . $showresend . '
                    </td>';
                }
                echo '<tr>


                    <td>' . $no . '</td>
                    <td>' . $row['tinno'] . '</td>
                    <td>' . $row['coyname'] . '</td>

                    <td>' . $row['yoa'] . '</td>
                    <td>' . $row['taxtype'] . '</td>
                    <td>' . $amount . '</td>
                    <td>' . $asmt . '</td>
                    <td>' . ucwords($row['basis']) . '</td>
                    <td>' . $row['user'] . '</td>
                    <td>' . $row['capdate'] . '</td>
                    ';

            ?> <?php

                $asmtno = $row[8] . $row[9] . $row[10];
                $page2 = 'editass';
                $pagedel = 'deleteass2';
                if ($taxtype == 'VAT') {
                    $page2 = 'editvatass';
                    $pagedel = 'deleteass2';
                }
                if ($taxtype == 'LRP') {
                    $page2 = 'editlrp';
                    $pagedel = 'deletelrp';
                    $table = decideLrp($asmtno);
                    $catb = 'lrps';
                }
                if ($taxtype == 'LSP') {
                    $page2 = 'editlrpvat';
                    $pagedel = 'deletelrpvat';
                    $table = decideLrp($asmtno);
                    $catb = 'lrps';
                }

                if ($ustatus == "user") {

                    echo '<td>
                        <a data-toggle="tooltip" title="Edit Record!"target="dframe" href="' . $page2 . '?catb=' . $catb . '&tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&sno=' . $row['sno'] . '&status=' . $ustatus . '"><span class="glyphicon glyphicon-edit" alt="edit Records"></span></a>
                        <a  data-toggle="tooltip" title="Delete Record!"target="dframe" href="' . $pagedel . '?catb=' . $catb . '&usersno=' . $usersno . '&tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&sno=' . $row['sno'] . '&status=' . $ustatus . '"><span class="glyphicon glyphicon-trash" alt="Delete Records" style="color:red;"></span></a>     &nbsp;' . $showresend . '
                    </td>
                    <td><span class=""><strong>' . ucfirst($status) . '</strong></span></td>
                    <td></td>';
                } else {

                    echo '

					<td><a class="btn btn-primary" target="dframe" href="doapprove?catb=' . $catb . '&usersno=' . $usersno . '&tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&status=' . $ustatus . '&sno=' . $row['sno'] . '"><span class="glyphicon glyphicon-ok"></span>&nbsp;Approve</a></td>

                    ' . $reject . '<td><strong>' . ucfirst($status) . '</strong></td><td><span class=""></span></td>';
                }
                echo ' </tr>';
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
