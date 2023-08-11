<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

$errormsg = '';
$errormsg2 = '';
$count = '';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;


$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$ustatus = isset($_REQUEST['status']) ? $_REQUEST['status'] : checkUserstatus2($usersno, $conn);
$tablename = isset($_REQUEST['catb']) ? $_REQUEST['catb'] : 'adminasreg';
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

        $sql = "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%pending') || ( IFNULL(approval, 0) LIKE '%rejected') AND  `user` = '$suser' ORDER BY STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') DESC ";
    } else {

        $sql = "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%pending')";
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

            $sql = "SELECT * FROM `$table`  WHERE ( IFNULL(approval, 0) LIKE '%pending' ||  IFNULL(approval, 0) LIKE '%rejected') AND `user`='$suser'  ORDER BY STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') DESC";
        } else if ($ustatus == "admin" || $ustatus == "master") {

            $sql = "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%pending') || ( IFNULL(approval, 0) LIKE '%rejected') AND  `user`='$suser' ORDER BY STR_TO_DATE(`$table`.`capdate`, '%d-%m-%Y') DESC ";
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
                echo 'LRP';
            } else {
                echo 'ADD / GOVT';
            } ?> ASSESSMENTS AWAITING APPROVAL </h3>
    </div>

    <!-- MY CHANGE PAGE LRP MENU COMES HERE -->
    <form name="search" action="tableappvat" method="post">
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



    <!-- MY CHANGE PAGE LRP MENU COMES HERE -->

    <?php
    if ($ustatus != "user" && $count > 1 && $ustatus == 'tax controller') {

        if ($tablename == 'lrps') {
            $table = 'lrps';
            $catb = 'lrps';
        }

        echo ' <div class="row">
           <div class="col-md-4"></div>
            <div class="col-md-4">
            <a href="appallvat?catb=' . $catb . '&tab=' . $table . '&user=' . $suser . '&status=' . $ustatus . '&sno=' . $usersno . '" class=" btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp;Approve All</a>&nbsp;<a href="rejectallvat?catb=' . $catb . '&tab=' . $table . '&user=' . $suser . '&status=' . $ustatus . '&sno=' . $usersno . '" class=" btn btn-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;Reject All</a>
            </div>
            <div class="col-md-4"></div>
            </div><p>';
    } else {
        # code...
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
                <th>Modify</th>
                <th>Status</th>


            </tr>
        </thead>
        <tbody>
            <?php

            $no = 1;
            $mo = 1;
            while ($row = mysqli_fetch_array($query)) {

                $serial = $row['sno'];
                $asmt = $row['asmtno'];
                $status = $row['approval'];
                $yrend = '';


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

                $amount = number_format(str_replace(',', '', $row['amount']), 2);
                $taxtype = $row['taxtype'];
                //$checkass=checkApprovalstatus($asmt,$serial,$conn);
                $headdept = checkUserdept($usersno, $conn);
                $userdept = getAssuser($row['user'], $conn);


                if ($tablename == 'lrps') {
                    $asmtno = $row[8] . $row[9] . $row[10];
                    $table = decideLrp('$asmtno');
                    $catb = 'lrps';
                }

                $reject = '<td><a class="btn btn-danger" target="dframe" href="dorejectvat?catb=' . $catb . '&tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&status=' . $ustatus . '&sno=' . $row['sno'] . '&usersno=' . $usersno . '"><span class="glyphicon glyphicon-remove"></span>&nbsp;Reject</a></td>';
                if ($suser == $row[12] || $suser == $row[16]) {
                    $asmtno = $row[8] . $row[9] . $row[10];

                    $page2 = 'editass';
                    if ($taxtype == 'VAT') {
                        $page20 = 'editvatass';
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
                        <a data-toggle="tooltip" title="Edit Record!"target="dframe" href="' . $page2 . '?yrend=' . $yrend . '&catb=' . $catb . '&tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&sno=' . $row['sno'] . '&status=' . $ustatus . '"><span class="glyphicon glyphicon-edit" alt="edit Records"></span></a>
                        <a  data-toggle="tooltip" title="Delete Record!"target="dframe" href="' . $pagedel . '?catb=' . $catb . '&yrend=' . $yrend . '&usersno=' . $usersno . '&tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&sno=' . $row['sno'] . '&status=' . $ustatus . '"><span class="glyphicon glyphicon-trash" alt="Delete Records" style="color:red;"></span></a>  &nbsp;' . $showresend . '  
                    </td>';
                }


                if ($headdept == $userdept) {
                    $yrend = '';

                    if ($tablename == 'lrps') {
                        $asmtno = $row[8] . $row[9] . $row[10];
                        $yrend = $row[15];
                        $table = decideLrp('$asmtno');
                        $catb = 'lrps';
                        $asmt = $asmtno;
                    }
                    //$yrend=$row['yearend'];
                    echo '<tr>

                
                    <td>' . $mo . '</td>
                    <td>' . $row['tinno'] . '</td>
                    <td>' . $row['coyname'] . '</td>
                    <td>' . $row['yoa'] . '</td>
                    <td>' . $row['taxtype'] . '</td>
                    <td>' . $amount . '</td>
                    <td>' . $asmt . '</td>
                    <td>' . $row['basis'] . '</td>
                    <td>' . $row['user'] . '</td>
                    <td>' . $row['capdate'] . '</td>
                    <td><a class="btn btn-primary" target="dframe" href="doapprovevat?catb=' . $catb . '&yrend=' . $yrend . '&tin=' . $row['tinno'] . '&user=' . $suser . '&tab=' . $table . '&status=' . $ustatus . '&sno=' . $row['sno'] . '&usersno=' . $usersno . '"><span class="glyphicon glyphicon-ok"></span>&nbsp;Approve</a></td>
                     ' . $reject . ' <td><strong>' . ucfirst($status) . '</strong></td>
                     </tr>';
                    $mo++;
                } else {
                    # code...
                }


            ?> <?php


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
    <!-- <script src="inactivity.js"></script> -->
</body>

</html>