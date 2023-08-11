<?php


include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');

//  $term='December';
//
//$table="current";




$term = isset($_REQUEST['cata']) ? $_REQUEST['cata'] : "December";
$termyoa = isset($_REQUEST['catb']) ? $_REQUEST['catb'] : date('Y');
$showterm = "Taxpayers";

$sqlmain = 'CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT * FROM current UNION  SELECT * FROM back_year ';
$query1 = mysqli_query($conn, $sqlmain);
//$count1=mysqli_num_rows($query1);
if (!$query1) {
    die('SQL Error: ' . mysqli_error($conn));
} else {

    $sql = "SELECT DISTINCT * FROM temp_self WHERE yearend like '%" . $term . "%' GROUP BY tinno ORDER BY STR_TO_DATE(capdate,'%d/%m/%Y') DESC";
}

// $sql="SELECT DISTINCT *
// FROM   current  WHERE yearend like '%".$term."%' GROUP BY tinno ORDER BY STR_TO_DATE(capdate,'%d/%m/%Y') DESC ";

//  $sql="SELECT * FROM current WHERE yearend like '".$term."' GROUP BY tinno HAVING COUNT(tinno)>1 ORDER BY capdate ASC";
//SELECT email
//FROM users
//GROUP BY email
//HAVING ( COUNT(email) = 1 )
//select * from customers where customer_id in (select distinct(customer_id) from orders);
//select s.name "Student", c.name "Course"
//from student s, bridge b, course c
//where b.sid = s.sid and b.cid = c.cid 




$query = mysqli_query($conn, $sql);
$count = mysqli_num_rows($query);

if (!$query) {
    die('SQL Error: ' . mysqli_error($conn));
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Report- <?php echo $showterm ?> with <?php echo $term ?> Year Ends</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <!--    <link rel="stylesheet" href="css3/style4.css">-->


    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">






</head>

<body>
    <div class="container-fluid">
        <div class="row-fluid col-md-12">
            <div id="verify">
                <form name="search" action="searchdueyoax" method="post">


                    <label for="">Search by Year End:</label>
                    <select name="cata" id="cata" onchange="this.form.submit();">
                        <option value="<?php echo $term ?>"><?php echo $term ?></option>
                        <option>December</option>
                        <option>November </option>
                        <option>October </option>
                        <option>September </option>
                        <option>August </option>
                        <option>July </option>
                        <option>June </option>
                        <option>May </option>
                        <option>April </option>
                        <option>March </option>
                        <option>February </option>
                        <option>January</option>
                    </select>


                    &nbsp;&nbsp;

                    <label for="coyname">YOA:</label>
                    <input type="text" name=catb value="<?php echo date('Y') ?>" />



                    &nbsp;&nbsp;&nbsp;

                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search </button>&nbsp;&nbsp;&nbsp;
                    <font class="pull-center" color="red"><?php echo $count ?> Record(s) Found of <?php echo $showterm ?> with <?php echo $term ?> Year End </font>
                </form>
            </div>
        </div>
        <hr>
        <div class="row-fluid col-md-12">
            <table id="example" class="display" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S/No</th>
                        <th>Tin</th>
                        <th>Company</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Year End</th>
                        <th>Due Date</th>
                        <th>Filing Status for <?php echo $termyoa ?> YOA</th>
                        <th>Date Filed</th>


                    </tr>
                </thead>
                <tbody>
                    <?php

                    $no     = 1;

                    while ($row = mysqli_fetch_array($query)) {

                        if (Checkfilestatus($row[1], $termyoa, $conn) == 'Filed') {
                            $capdate= $row[8];
                        } else {

                            $capdate= 'N/A';
                        }

                        echo '<tr>

                
                    <td>' . $no . '</td>
                    <td>' . $row[1] . '</td>
                    <td>' . $row[2] . '</td>
                    <td>' . $row[3] . '</td>
                    <td>' . $row[27] . '</td>
                     <td>' . $row[4] . '</td>
                     <td>' . $row[5] . '</td>
                     <td>' . Checkfilestatus($row[1], $termyoa, $conn) . '</td>
                     <td>'  .$capdate. '</td>
                   
                </tr>';

                        $no++;
                    } ?>


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
            $('#example').DataTable({
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
            });
        });
    </script>

<?php

function Checkfilestatus($tin,$yoa,$conn){
   
    $filed='';
    $foundyoa='';
    $sqlmain = 'CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT * FROM current UNION  SELECT * FROM back_year ';
    $query1 = mysqli_query($conn, $sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query1) {
        die('SQL Error: ' . mysqli_error($conn));
    } else {

        $sql = "SELECT DISTINCT * FROM temp_self WHERE tinno like '%" . $tin . "%' && yoa like '%" . $yoa . "%'";
    }
    $query = mysqli_query($conn, $sql);

    if ($query) {
        while ($row = mysqli_fetch_array($query)) {
            $foundyoa = $row[6];
        }

        if ($foundyoa=='') {
           $filed='Not Filed'; # code...
        }else {
            $filed='Filed';
        }

    }else{

        die('SQL Error: ' . mysqli_error($conn));
    }
    return $filed; 

}


?>

</body>

</html>