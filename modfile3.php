<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
// include_once('vatmethods.php');
//$term="all";
//$table="adminasreg";


$table = isset($_REQUEST['table']) ? $_REQUEST['table'] : null;
//$term = isset($_REQUEST['cata']) ? $_REQUEST['cata'] : 'all';
$soffice = getSettings('soname', $conn);
$tc = getSettings('tcname', $conn);
$appdate = date('d/m/Y');

$errormsg15 = null;
$errormsg16 = null;
$errormsg17 = null;
$errormsg18 = null;


// if ($table=="settings") {
//     $sql="SELECT whtrate FROM $table";
//                 if (!mysqli_query($conn,$sql)) {
//                  //die ('SQL Error: ' . mysqli_error($conn));
//                     $query=mysqli_query($conn,"ALTER TABLE $table
//                     ADD whtrate VARCHAR(10) DEFAULT '10' AFTER modifiedby,
//                     ADD lrpint VARCHAR(10) DEFAULT '25000' AFTER whtrate,
//                     ADD lrpsub VARCHAR(10) DEFAULT '5000' AFTER lrpint,
//                     ADD lspint VARCHAR(10) DEFAULT '5000' AFTER lrpsub,
//                     ADD lspsub VARCHAR(10) DEFAULT '5000' AFTER lspint");
//             if($query){
//                 $errormsg2="Settings has been altered successfully!";
//             }else{
//                 $errormsg="Ooops!! Something went wrong!!".mysqli_error($conn);
//             }
//      }else{

//         $errormsg="Its been altered Already!";
//      }
// }

if ($table == "addcost") {
    $sql = "SELECT cost FROM current";
    if (!mysqli_query($conn, $sql)) {
        //die ('SQL Error: ' . mysqli_error($conn));
        $query = mysqli_query($conn, "ALTER TABLE current
                      ADD cost DECIMAL(65,2) DEFAULT '0' AFTER taxoffice,
                     ADD fa DECIMAL(65,2) DEFAULT '0' AFTER cost");

        if ($query) {
            $errormsg16 = "Table altered successfully!";
        } else {
            $errormsg15 = "Ooops!! Something went wrong!!";
        }
    } else {

        $errormsg15 = "Its been altered Already!";
    }
}

if ($table == "addcost2") {
    $sql = "SELECT cost FROM back_year";
    if (!mysqli_query($conn, $sql)) {
        //die ('SQL Error: ' . mysqli_error($conn));
        $query = mysqli_query($conn, "ALTER TABLE back_year
                     ADD cost DECIMAL(65,2) DEFAULT '0' AFTER taxoffice,
                     ADD fa DECIMAL(65,2) DEFAULT '0' AFTER cost");

        if ($query) {
            $errormsg18 = "Table altered successfully!";
        } else {
            $errormsg17 = "Ooops!! Something went wrong!!";
        }
    } else {

        $errormsg17 = "Its been altered Already!";
    }
}




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Modify Database Wizard</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">

    <style>
        #verifyx {
            display: block;
            width: 800px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row-fluid col-md-12">
            <div id="verifyx">
                <h1 style="color:red" id="screen" class="alert-success">Database Alteration Wizard</h1>
                <br>

                <form name="search8" action="modfile3" method="post">
                    <input type="hidden" name="table" value="addcost">
                    <div class="form-group">
                        <label for="capture">
                            <h3>(1) Press This Button </h3>
                        </label>&nbsp;&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="Modify Delete trails">
                    </div>

                    <?php

                    if ($errormsg15 == null) {

                        echo ('  <div class="" id="screen"><h4> </h4> </div>');
                    } else {

                        echo ('  <div class="alert-danger" id="screen"><h4>' . $errormsg15 . ' </h4> </div>');
                    }

                    if ($errormsg16 == null) {

                        echo ('  <div class="" id="screen"><h4> </h4> </div>');
                    } else {

                        echo ('  <div class="alert-success" id="screen" ><h4>' . $errormsg16 . ' </h4> </div>');
                    }
                    ?>


                </form>
                <form name="search8" action="modfile3" method="post">
                    <input type="hidden" name="table" value="addcost2">
                    <div class="form-group">
                        <label for="capture">
                            <h3>(2) Press This Button </h3>
                        </label>&nbsp;&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="Modify Delete trails">
                    </div>

                    <?php

                    if ($errormsg17 == null) {

                        echo ('  <div class="" id="screen"><h4> </h4> </div>');
                    } else {

                        echo ('  <div class="alert-danger" id="screen"><h4>' . $errormsg17 . ' </h4> </div>');
                    }

                    if ($errormsg18 == null) {

                        echo ('  <div class="" id="screen"><h4> </h4> </div>');
                    } else {

                        echo ('  <div class="alert-success" id="screen" ><h4>' . $errormsg18 . ' </h4> </div>');
                    }
                    ?>


                </form>
                <a href="index" class="btn btn-success">Exit Wizard</a>
            </div>
        </div>
    </div>
</body>

</html>