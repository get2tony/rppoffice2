<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
session_start();
if (!isset($_SESSION["username"])) {
    header("location:logout");
    exit();
}

$snouser = isset($_REQUEST['tokenid']) ? $_REQUEST['tokenid'] : null;
$s = explode('-', $snouser);
$sno = $s[0];
$suser = returnUsername($sno, $conn);
$userstatus = checkUserstatus2($sno, $conn);

$count = 0;
$count2 = 0;
$count3 = 0;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>RPP Office Assistant App v.2.5.1</title>

    <!-- Bootstrap CSS CDN -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="datetime.css">
    <link rel="stylesheet" href="menuset2.css">
    <link rel="stylesheet" href="homeset.css">
    <link rel="stylesheet" href="sidebarset2.css">
    <link rel="stylesheet" href="simplebar.css">
    <script src="simplebar.min.js"></script>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <!-- Our Custom CSS -->
    <script src="js3/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="css3/style4.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <style>


    </style>
    <script>
        function hideLoader() {
            fillstuff();
            $('#loading').fadeIn('slow');
            $('#loading').fadeOut('slow');
        }
    </script>
</head>

<body onload="goforit()">
    <div id="loading"></div>


    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar2">
            <div class="sidebar-header2">
                <h3>RPP Office Assistant Application &reg</h3>
            </div>
            <div data-simplebar class="scroller">
                <ul class="list-unstyled components">
                    <li>
                        <a href="dobackup2?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe">
                            <i class="glyphicon glyphicon-download-alt"></i>
                            Backup Database
                        </a>
                    </li>
                    <li>
                        <a href="dash?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe">
                            <i class="glyphicon glyphicon-home"></i>
                            Home
                        </a>

                    </li>
                    <li>
                        <a href="tableuser2?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe">
                            <i class="glyphicon glyphicon-list-alt"></i>
                            My Assessments &nbsp;<span id="show3" class="label label-danger">
                            </span>
                        </a>

                    </li>
                    <li>
                        <a href="capturevatself?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe">
                            <i class="glyphicon glyphicon-briefcase"></i>
                            Receive Returns (VAT)

                        </a>

                    </li>
                    <li>
                        <a href="sarvat?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe">
                            <i class="glyphicon glyphicon-folder-open"></i>
                            Self Asmt Register (VAT)

                        </a>

                    </li>

                    <li>
                        <a href="vatwork?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe">
                            <i class="glyphicon glyphicon-folder-open"></i>
                            VAT Desk Menu
                        </a>
                    </li>
                    <li>
                        <a href="lrpasearchvat?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe">
                            <i class="glyphicon glyphicon-folder-open"></i>
                            LSP Register
                        </a>
                    </li>

                    <li>
                        <a href="reports?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe">
                            <i class="glyphicon glyphicon-print"></i>
                            Reports
                        </a>
                    </li>
                    <li>
                        <a target="dframe" href="captureadmin?sno=<?php echo $sno ?>&user=<?php echo $suser ?>">
                            <i class="glyphicon glyphicon-file"></i>
                            Raise Assessments (Reg)
                        </a>
                    </li>
                    <li>
                        <a target="dframe" href="captureadmin2?sno=<?php echo $sno ?>&user=<?php echo $suser ?>">
                            <i class="glyphicon glyphicon-file"></i>
                            Raise Unregistered Asmt
                        </a>
                    </li>

                    <li>
                        <a href="taxwork?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe">
                            <i class="glyphicon glyphicon-plus-sign"></i>
                            App Tool kits
                        </a>
                    </li>
                    <li>
                        <?php

                        echo '
                        <a href="appusers3?sno=' . $sno . '&user=' . $suser . ' " target="dframe">
                            <i class="glyphicon glyphicon-user"></i>
                            Manage VAT Desk Users
                        </a>
                           '; ?>
                    </li>

                    <li>
                        <a href="logout"><i class="glyphicon glyphicon-off"></i> Logout</a>
                    </li>


                </ul>
            </div> <!-- <div class="container"><img id="downlogo" src="img/applogo.png" alt=""></div> -->

        </nav>

        <!-- Page Content Holder -->
        <div id="content" class="col-lg-12">

            <nav class="navbar " style="margin-bottom:20px;">
                <div class="container create">

                    <div class="logo">
                        <a class="brand" href="dash " target="dframe"> <img alt="RPP OFFICE ASSISTANT" src="img/logo.png" /> </a>

                    </div>
                    <div class="folder">
                        <div class="btn-group" role="group">
                            <a title="Approved Asmts" href="tableuser?sno=<?php echo $sno ?>&status=<?php echo $userstatus ?>&user=<?php echo $suser ?>" target="dframe" class="btn btn-info">
                                <?php echo date('Y') ?> Assessments &nbsp;<span id="show2" class="badge badge-danger"></span>
                            </a>




                            <?php


                            echo '
                                
                                <a title="Today\'s Approvals" id="def3" href="tableuser3?sno=' . $sno . '&status=' . $userstatus . '&user=' . $suser . '" target="dframe" class="btn btn-primary">
  								<i class="glyphicon glyphicon-envelope"></i>&nbsp;  Inbox &nbsp;<span id="show4" class="badge badge-light"></span>
                                </a>
                                
								<a title="Pending Approval" id="def" href="tableappvat?sno=' . $sno . '&status=' . $userstatus . '&user=' . $suser . '&sno=' . $sno . '"  target="dframe" class="btn btn-default">
  								<i class="glyphicon glyphicon-send"></i> &nbsp; Outbox&nbsp; <span id="show" class="badge badge-light"></span>
								</a>';



                            ?>

                        </div>
                    </div>
                    <div class="profile">
                        <div class="item1">

                            <div class="btn-group" role="group">
                                <a class="btn btn-default" title="user settings" href="update_account?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe"><i class="glyphicon glyphicon-cog"></i>&nbsp;Edit Profile</a>
                                <a class="btn btn-default" title="view score card" href="staff_score?sno=<?php echo $sno ?>" target="dframe">
                                    <i class="glyphicon glyphicon-user"></i>
                                    &nbsp;<?php echo $suser ?></a>




                            </div>
                        </div>

                        <div class="item2">
                            <div class="btn-group" role="group">
                                <a id="distime" class="btn btn-block"><?php echo date("l \, jS  F Y"); ?>&nbsp;&nbsp;<span class='glyphicon glyphicon-calendar'>&nbsp;</a>
                                <a class="btn btn-danger" title="Backup" href="dobackup2?sno=<?php echo $sno ?>" target="dframe">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="side">
                        <a id="out" title="logout" href="logout " class="btn btn-default"><i class="glyphicon glyphicon-off"></i></a>
                    </div>
                </div>
            </nav>
            <div class="row">
                <div class="embed-responsive embed-responsive-16by9 ">
                    <embed name="dframe" class="dframe" onload="hideLoader();" src="dash " height="100%" width="100%">
                    </embed>
                </div>
            </div>

        </div>

    </div>





    <!-- jQuery CDN -->
    <script src="js3/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap Js CDN -->
    <script type="text/javascript">
        function fillstuff() {
            $(document).ready(function() {

                $('#show').load('datam.php')

            });

            $(document).ready(function() {

                $('#show2').load('data2.php')

            });

            $(document).ready(function() {

                $('#show3').load('data3.php')

            });

            $(document).ready(function() {

                $('#show4').load('data7.php');

            });
            dobutton();
        }
    </script>
    <script src="js3/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar2').toggleClass('active');
            });
        });
    </script>
    <script type="text/javascript">
        function dobutton() {

            $(document).ready(function() {
                var a = 0;
                var a = document.getElementById("show").innerHTML;
                if (a > 0) {
                    document.getElementById("def").className = "btn btn-warning";
                } else {
                    document.getElementById("def").className = "btn btn-default";

                }
            });

            $(document).ready(function() {
                var b = 0;
                var b = document.getElementById("show4").innerHTML;
                if (b > 0) {
                    document.getElementById("def3").className = "btn btn-info";
                } else {
                    document.getElementById("def3").className = "btn btn-default";

                }
            });
        }
    </script>
    <script src="inactivity.js"></script>
</body>

</html>