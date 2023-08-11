<?php

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/vatmethods.php');
include_once(dirname(__FILE__) . '/tpmethods.php');


require_once dirname(__FILE__) . '/dompdf/lib/html5lib/Parser.php';
require_once dirname(__FILE__) . '/dompdf/php-font-lib/src/FontLib/Autoloader.php';
require_once dirname(__FILE__) . '/dompdf/php-svg-lib/src/autoload.php';
require_once dirname(__FILE__) . '/dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
// $tab = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$tinno = isset($_REQUEST['tin']) ? $_REQUEST['tin'] : null;

$officename = getSettings('oname', $conn);
$userstatus = checkUserstatus2($usersno, $conn);

$sqlmain = "CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT * FROM current UNION  SELECT * FROM back_year ";
$query1 = mysqli_query($conn, $sqlmain);
//$count1=mysqli_num_rows($query1);
if (!$query1) {
    die('SQL Error: ' . mysqli_error($conn));
} else {

    $sql = "SELECT * FROM temp_self WHERE tinno LIKE '$tinno' ORDER BY sno DESC LIMIT 1";
}
//  $table="adminasreg";
$query = mysqli_query($conn, $sql);
$count = mysqli_num_rows($query);
if (!$query) {
    die('SQL Error: ' . mysqli_error($conn));
}


$amt = '';
$amt2 = '';
$showlabel = '<div class="text-center"><h3>TCC APPROVAL TEMPLATE</h3></div>';


?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RPP Office TCC APPROVAL TEMPLATE </title>
    <link rel="stylesheet" href="css3/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css3/buttons.dataTables.min.css">
    <link rel="stylesheet" href="css3/bootstrap.min.css">

    <style type="text/css">
        #heading {
            position: absolute;
            font-family: Arial;
            font-weight: bold;
            font-size: 16px;
            color: #a00303;
            left: 10px;
            top: 20px;
        }

        .Container {
            position: absolute;
            top: 150px;
            left: 10px;
            font-family: Arial;
        }

        #showstuff {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div id="heading">
        <strong>FEDERAL INLAND REVENUE SERVICE</strong><br />
        <?php echo $officename ?><br />
        RETURN PROCESSING ANNEXTURE <br /><br />
        <span>TCC APPROVAL TEMPLATE </span></div>
    <br>

    <?php



    while ($row = mysqli_fetch_array($query)) {

        $tinno = $row['tinno'];
        $coyname = $row['coyname'];
        $address = $row['address'];
        $remark = substr($row['remark'], 0, 30);
    }

    $yoa1 = date("Y") - 3;
    $yoa2 = date("Y") - 2;
    $yoa3 = date("Y") - 1;

    $data1 = gettaxinfo($conn, $tinno, $yoa1);
    $data2 = gettaxinfo($conn, $tinno, $yoa2);
    $data3 = gettaxinfo($conn, $tinno, $yoa3);

    $lrp1 = getlrpinfo($conn, $tinno, $yoa1);
    $lrp2 = getlrpinfo($conn, $tinno, $yoa2);
    $lrp3 = getlrpinfo($conn, $tinno, $yoa3);

    // first Year

    // Assessible Profit
    $turnover1 = $data1['tover'];
    $lrp1st = $lrp1['amount'];
    $sum1 = getaddsum($conn, $tinno, $yoa1, 'EDT', 'sum');
    $rate1 = getaddsum($conn, $tinno, $yoa1, 'EDT', 'rate');
    $add1 = getaddsum($conn, $tinno, $yoa1, 'EDT', 'add');
    $ap1 = number_format((str_replace(',', '', $data1['edt']) + $sum1) / ($rate1 / 100), 2);
    $edt1 = number_format((str_replace(',', '', $data1['edt']) + $sum1), 2);
    //-----------------------------

    // Total Profit
    $sum2 = getaddsum($conn, $tinno, $yoa1, 'CIT', 'sum');
    $rate2 = getaddsum($conn, $tinno, $yoa1, 'CIT', 'rate');
    $add2 = getaddsum($conn, $tinno, $yoa1, 'CIT', 'add');
    $tp2 = number_format((str_replace(',', '', $data1['cit']) + $sum2) / ($rate2 / 100), 2);
    $cit1 = number_format((str_replace(',', '', $data1['cit']) + $sum2), 2);

    //-----------------------------

    // Second Year

    // Assessible Profit
    $turnover2 = $data2['tover'];
    $lrp2nd = $lrp2['amount'];
    $sum3 = getaddsum($conn, $tinno, $yoa2, 'EDT', 'sum');
    $rate3 = getaddsum($conn, $tinno, $yoa2, 'EDT', 'rate');
    $add3 = getaddsum($conn, $tinno, $yoa2, 'EDT', 'add');
    $ap3 = number_format((str_replace(',', '', $data2['edt']) + $sum3) / ($rate3 / 100), 2);
    $edt2 = number_format((str_replace(',', '',$data2['edt']) + $sum3), 2);
    //-----------------------------

    // Total Profit
    $sum4 = getaddsum($conn, $tinno, $yoa2, 'CIT', 'sum');
    $rate4 = getaddsum($conn, $tinno, $yoa2, 'CIT', 'rate');
    $add4 = getaddsum($conn, $tinno, $yoa2, 'CIT', 'add');
    $tp4 = number_format((str_replace(',', '', $data2['cit']) + $sum4) / ($rate4 / 100), 2);
    $cit2 = number_format((str_replace(',', '', $data2['cit']) + $sum4), 2);

    //-----------------------------

    // Third Year

    // Assessible Profit
    $turnover3 = $data3['tover'];
    $lrp3rd = $lrp3['amount'];
    $sum5 = getaddsum($conn, $tinno, $yoa3, 'EDT', 'sum');
    $rate5 = getaddsum($conn, $tinno, $yoa3, 'EDT', 'rate');
    $add5 = getaddsum($conn, $tinno, $yoa3, 'EDT', 'add');
    $ap5 = number_format((str_replace(',', '', $data3['edt']) + $sum5) / ($rate5 / 100), 2);
    $edt3 = number_format((str_replace(',', '', $data3['edt']) + $sum5), 2);
    //-----------------------------

    // Total Profit
    $sum6 = getaddsum($conn, $tinno, $yoa3, 'CIT', 'sum');
    $rate6 = getaddsum($conn, $tinno, $yoa3, 'CIT', 'rate');
    $add6 = getaddsum($conn, $tinno, $yoa3, 'CIT', 'add');
    $tp6 = number_format((str_replace(',', '', $data3['cit']) + $sum6) / ($rate6 / 100), 2);
    $cit3 = number_format((str_replace(',', '', $data3['cit']) + $sum6), 2);

    //-----------------------------

    $aprofit1 = ($add1 == true) ? $ap1 : $data1['aprofit'];
    $tprofit1 = ($add2 == true) ? $tp2 : $data1['tprofit'];


    $aprofit2 = ($add3 == true) ? $ap3 : $data2['aprofit'];
    $tprofit2 = ($add4 == true) ? $tp4 : $data2['tprofit'];


    $aprofit3 = ($add5 == true) ? $ap5 : $data3['aprofit'];
    $tprofit3 = ($add6 == true) ? $tp6 : $data3['tprofit'];

    //-----------------------------

    ?>
    <div class="Container">
        <br>
        <table width="100%" id="example" class="display table table-bordered" border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr>

                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col"><?php echo $yoa1 ?></th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col"><?php echo $yoa2 ?></th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col"><?php echo $yoa3 ?></th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>


                </tr>
            </thead>
            <tbody>
                <tr id="showstuff">
                    <td width="55">SNO</td>
                    <td width="124">TIN</td>
                    <td width="155">COMPANY NAME</td>
                    <td width="155">TURNOVER</td>
                    <td width="132">ASS/PROFIT</td>
                    <td width="156">TOTAL PROFIT</td>
                    <td width="148">TAX PAYABLE</td>
                    <td width="154">CIT PAID CASH</td>
                    <td width="147">CIT PAID WHT</td>
                    <td width="129">TOTAL PAID</td>
                    <td width="153">OUTSTANDING</td>
                    <td width="113">EDT PAID</td>
                    <td width="162">VAT PAID</td>


                    <td width="155">TURNOVER</td>
                    <td width="132">ASS/PROFIT</td>
                    <td width="156">TOTAL PROFIT</td>
                    <td width="148">TAX PAYABLE</td>
                    <td width="154">CIT PAID CASH</td>
                    <td width="147">CIT PAID WHT</td>
                    <td width="129">TOTAL PAID</td>
                    <td width="153">OUTSTANDING</td>
                    <td width="113">EDT PAID</td>
                    <td width="162">VAT PAID</td>

                    <td width="155">TURNOVER</td>
                    <td width="132">ASS/PROFIT</td>
                    <td width="156">TOTAL PROFIT</td>
                    <td width="148">TAX PAYABLE</td>
                    <td width="154">CIT PAID CASH</td>
                    <td width="147">CIT PAID WHT</td>
                    <td width="129">TOTAL PAID</td>
                    <td width="153">OUTSTANDING</td>
                    <td width="113">EDT PAID</td>
                    <td width="162">VAT PAID</td>

                    <td width="129">UPDATE ON RETURNS FILING</td>
                    <td width="153">COMMENTS: date of Incorp., date of commencement, nature of biz etc</td>
                    <td width="113">OFFICER'S REMARKS</td>
                    <td width="162">HEAD RPP REMARKS</td>
                    <td width="162">COLLATION OFFICER'S REMARK</td>
                    <td width="162">TC'S REMARKS</td>


                </tr>
                <tr>
                    <td width="55">1</td>
                    <td width="124"><?php echo $tinno ?></td>
                    <td width="155"><?php echo $coyname ?></td>
                    <td width="155"><?php echo $turnover1 ?></td>
                    <td width="132"><?php echo $aprofit1 ?></td>
                    <td width="156"><?php echo $tprofit1 ?></td>
                    <td width="148"><?php echo $cit1 ?></td>
                    <td width="154"><?php echo $cit1 ?></td>
                    <td width="147">&nbsp;</td>
                    <td width="129"><?php echo $cit1 ?></td>
                    <td width="153">&nbsp;</td>
                    <td width="113"><?php echo $edt1 ?></td>
                    <td width="162">&nbsp;</td>


                    <td width="155"><?php echo $turnover2 ?></td>
                    <td width="132"><?php echo $aprofit2 ?></td>
                    <td width="156"><?php echo $tprofit2 ?></td>
                    <td width="148"><?php echo $cit2 ?></td>
                    <td width="154"><?php echo $cit2 ?></td>
                    <td width="147">&nbsp;</td>
                    <td width="129"><?php echo $cit2 ?></td>
                    <td width="153">&nbsp;</td>
                    <td width="113"><?php echo $edt2 ?></td>
                    <td width="162">&nbsp;</td>

                    <td width="155"><?php echo $turnover3 ?></td>
                    <td width="132"><?php echo $aprofit3 ?></td>
                    <td width="156"><?php echo $tprofit3 ?></td>
                    <td width="148"><?php echo $cit3 ?></td>
                    <td width="154"><?php echo $cit3 ?></td>
                    <td width="147">&nbsp;</td>
                    <td width="129"><?php echo $cit3 ?></td>
                    <td width="153">&nbsp;</td>
                    <td width="113"><?php echo $edt3 ?></td>
                    <td width="162">&nbsp;</td>

                    <td width="129">FILED TO DATE</td>
                    <td width="153">INC: &nbsp;&nbsp;&nbsp;, COMM: &nbsp;&nbsp;&nbsp;, NOB: <?php echo $remark ?> </td>
                    <td width="113">&nbsp;</td>
                    <td width="162">&nbsp;</td>
                    <td width="162">&nbsp;</td>
                    <td width="162">&nbsp;</td>
                </tr>

            </tbody>
        </table>



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
                ordering: false,
                paging: false,
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
    </script>
</body>

</html>