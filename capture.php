<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');

$errormsg = '';
$errormsg2 = '';
$userstatus = 'user';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$approved = isset($_REQUEST['app']) ? $_REQUEST['app'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$userstatus = checkUserstatus2($usersno, $conn);


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Receive Returns</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/jquery.character-counter.js"></script>
    <!-- <script src="js3/jquery-1.12.0.min.js"></script> -->

    <style type="text/css">
        .num {

            display: block;
            top: 160px;
            position: absolute;
        }
    </style>

    <script>
        function getLoad(k) {
            var m = document.getElementById(k).value;
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    myObj = JSON.parse(this.responseText);
                    document.getElementById("defaultInput").value = myObj.name;
                    document.getElementById("address").value = myObj.address;
                    document.getElementById("yrendm").value = myObj.yearend;
                    document.getElementById("remark").value = myObj.remark;
                    document.getElementById("coytin").value = myObj.coytin;
                    document.getElementById("phone").value = myObj.phone;
                }
            };
            xmlhttp.open("GET", "getinfo.php?q=" + m, true);
            // xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send();
        }
    </script>

</head>

<body>
    <div class="container-fluid">
        <form name="returns" action="doreturns " onsubmit="return validateForm()" method="post">
            <div class="row-fluid col-md-4">
                <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="text" class="form-control" id="coytin" name="coytin" placeholder="Tin here" onchange="getLoad('coytin')">
                </div>
                <div class="form-group">
                    <label for="coyname">Company Name:</label>
                    <input type="text" class="form-control" name="coyname" placeholder="Taxpayer's Name" id="defaultInput" data-charcount-enable="true" maxlength="34">
                </div>
                <div class="num form-group">
                    <label for="coyname">Phone No:</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Taxpayer's Phone Number" />
                </div>
                <br>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea name="address" class="form-control" id="address" placeholder="Taxpayer's Address"></textarea>
                </div>
                <div class="form-group">
                    <label for="yearend">Year End:</label>
                    <select name="yrendm" id="yrendm">
                        <option>December</option>
                        <option>November</option>
                        <option>October</option>
                        <option>September</option>
                        <option>August</option>
                        <option>July</option>
                        <option>June</option>
                        <option>May</option>
                        <option>April</option>
                        <option>March</option>
                        <option>February</option>
                        <option>January</option>
                    </select>
                    <input type="text" id="yryoa" name="yryoa" placeholder="YOA" size="5" value="<?php echo date('Y') - 1; ?>" onchange="myVal()">

                </div>
                <p></p>
                <div class="form-group">
                    <label for="YOA">Year of Assessment:</label>
                    <input type="text" name="yoa" class="form-control" id="yoa" placeholder="Year of Assessment" value="<?php echo date('Y'); ?>" onchange="mycom()">
                    <!--                    onchange="myreVal()"-->
                </div>

                <div class="form-group">
                    <label for="capture">Date of Capture:</label>
                    <?php
                    if ($userstatus != 'user') {

                        echo '<input type="text" name="capture" id="capture" 
                       value="' . date("d-m-Y") . '" >';
                    } else {
                        echo '<select name="capture" id="capture" >
                        <option> ' . date("d-m-Y") . '</option>
                                                
                    </select>';
                    }
                    ?>

                    <p></p>
                    <div class="form-group">
                        <label for="capture">Commencement Year ?:</label>
                        &nbsp;<input type="radio" name="comm" value="no" id="comm1" checked> No &nbsp;
                        <input type="radio" name="comm" value="yes" id="comm2"> Yes</div>

                </div>

                <p></p>

            </div>

            <!--second row-->
            <div class="row-fluid col-md-4">

                <div class="form-group">
                    <label for="tover">Turnover:</label>
                    <input type="text" class="form-control" name="tover" id="tover" placeholder="Turnover" value="" onchange="Nitcheck()" />
                </div>
                <div class="form-group">
                    <label for="csales">Direct Cost:</label>
                    <input type="text" class="form-control" name="csales" id="csales" placeholder="Direct Cost" value="" onchange="makenum('csales')" />
                </div>
                <div class="form-group">
                    <label for="faxt">Fixed Assets:</label>
                    <input type="text" class="form-control" name="faxt" id="faxt" placeholder="Fixed Assets" value="" onchange="makenum('faxt')" />
                </div>

                <div class="form-group">
                    <label for="asspt">Assessable Profit:</label>
                    <input type="text" class="form-control" name="asspt" id="asspt" placeholder="Assessable Profit" value="" onchange="makenum('asspt')" />
                </div>

                <div class="form-group">
                    <label for="tpt">Total Profit:</label>
                    <input type="text" class="form-control" id="tpt" name="tpt" placeholder="Total Profit" value="" onchange="makenum('tpt');myext()" />
                </div>

                <div class="form-group">
                    <label for="cittxt">Company Income Tax:</label>
                    <input type="text" name="cit" class="form-control" id="cittxt" placeholder="CIT value here" value="" onchange="makenum('cittxt');myext()" />
                </div>

                <div class="form-group">
                    <label for="edttxt">Education Tax:</label>
                    <input type="text" name="edt" class="form-control" id="edttxt" placeholder="EDT value here" value="" onchange="makenum('edttxt');myext()" />
                </div>

                <div class="form-group">
                    <label for="edttxt">Capital Gains Tax:</label>
                    <input type="text" name="cgt" class="form-control" id="cgt" placeholder="CGT value here" value="0" onchange="makenum('cgt')" />
                </div>
                <div style="display:none" id="nitds" class="form-group">
                    <label for="edttxt">National Information Tech Dev Fund (NITDF) levy :</label>
                    <input type="text" name="nitdl" class="form-control" id="nitdl" placeholder="NITDL value here" value="0" onchange="makenum('nitdl')" />
                </div>


            </div>

            <!--End of Second row-->

            <div class="row-fluid col-md-4">
                <br>
                <div class="form-group">
                    <label for="mintax">Minimum Tax?:</label>
                    <select name="mintax" id="mintax">
                        <option>No</option>
                        <option>Yes</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="niltax">Filed Nil?:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="niltax" id="niltax">
                        <option>No</option>
                        <option>Yes</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="niltax">Payment Mode:</label>
                    <select name="paytype" id="paytype">
                        <option>Cash Payment</option>
                        <option>WHT Credit Note</option>
                        <option>Cash & WHT</option>
                        <option>Exempted</option>
                        <option>Instalment</option>
                    </select>
                </div>



                <br>
                <p></p>

                <div class="form-group">
                    <label for="remark">Nature of Biz / Remarks:</label>
                    <textarea name="remark" class="form-control" id="remark" placeholder="Nature of Biz or Any Remarks" onclick="myext()"></textarea>

                </div>

                <p></p>
                <input type="hidden" name="user" value="<?php echo $suser ?>">
                <input type="hidden" name="usersno" value="<?php echo $usersno ?>">
                <button type="submit" class="btn btn-primary" onclick="check('tover','asspt','tpt','cittxt','edttxt')">Process Info</button>
                <p></p>


                <?php

                if ($errormsg == null) {

                    echo ('  <div class="" id="screen"><h4> </h4> </div>');
                } else {

                    echo ('  <div class="alert-danger" id="screen"><h4>' . $errormsg . ' </h4> </div>');
                }

                if ($errormsg2 == null) {

                    echo ('  <div class="" id="screen"><h4> </h4> </div>');
                } else {

                    echo ('  <div class="alert-success" id="screen" ><h4>' . $errormsg2 . ' </h4> </div>');
                }
                ?>



            </div>
            <!--end of Third row-->
        </form>



    </div>



    <script type="text/javascript">
        function validateForm() {
            var x = document.forms["returns"]["coytin"].value;
            var y = document.forms["returns"]["defaultInput"].value;
            var z = document.forms["returns"]["address"].value;
            var a = document.forms["returns"]["tover"].value;
            var dc = document.forms["returns"]["csales"].value;
            var fa = document.forms["returns"]["faxt"].value;
            var b = document.forms["returns"]["asspt"].value;
            var c = document.forms["returns"]["tpt"].value;
            var d = document.forms["returns"]["cit"].value;
            var e = document.forms["returns"]["edt"].value;
            var f = document.forms["returns"]["remark"].value;
            var g = document.forms["returns"]["cgt"].value;
            var h = document.forms["returns"]["nitdl"].value;


            if (x == "") {
                alert("Company's Tin must be filled ");
                return false;
            }
            if (y == "") {
                alert("Company's Name must be filled ");
                return false;
            }
            if (z == "") {
                alert("Address must be filled out");
                return false;
            }

            if (a == "") {
                alert("Turnover must not be empty, it should contain '0', if there is no value to capture");
                return false;
            }

            if (b == "") {
                alert("Assessable Profit must not be empty, it should contain '0', if there is no value to capture");
                return false;
            }
            if (c == "") {
                alert("Total Profit must not be empty, it should contain '0', if there is no value to capture");
                return false;
            }
            if (d == "") {
                alert(" CIT must not be empty, it should contain '0', if there is no value to capture");
                return false;
            }
            if (e == "") {
                alert("EDT must not be empty, it should contain '0', if there is no value to capture");
                return false;
            }
            if (f == "") {
                alert("Please Capture the Nature of Biz ");
                return false;
            }
            if (g == "") {
                alert("CGT must not be empty, it should contain '0', if there is no value to capture");
                return false;
            }
            if (dc == "") {
                alert("Direct Costs must not be empty, it should contain '0', if there is no value to capture");
                return false;
            }
            if (fa == "") {
                alert("Fixed Assets must not be empty, it should contain '0', if there is no value to capture");
                return false;
            }
            if (h == "") {
                alert("NITDL must not be empty, it should contain '0', if there is no value to capture");
                return false;
            }
        }
    </script>
    <script type="text/javascript">
        function myVal() {
            var k = document.getElementById("yryoa").value;
            var m = Number(k) + 1;
            document.getElementById("yoa").value = m;

        }
    </script>
    <script type="text/javascript">
        function myreVal() {
            var k = document.getElementById("yoa").value;
            var m = Number(k) - 1;
            document.getElementById("yryoa").value = m;

        }
    </script>
    <script type="text/javascript">
        function mycom() {
            var k = document.getElementById("yryoa").value;
            var m = document.getElementById("yoa").value;
            if (m == k) {

                document.getElementById("comm2").checked = true;

            } else {

                document.getElementById("comm1").checked = true;

            }

        }
    </script>
    <script type="text/javascript">
        function myext() {
            var k = parseInt(document.getElementById("cittxt").value);
            var m = parseInt(document.getElementById("tpt").value);

            if (k <= 0) {
                document.getElementById("niltax").value = "Yes";
            }
            if (m <= 0 && k > 0) {
                document.getElementById("mintax").value = "Yes";
            }

            if (m > 0 && k > 0) {
                document.getElementById("mintax").value = "No";
                document.getElementById("niltax").value = "No";
            }
        }

        function makenum(d) {
            var q = document.getElementById(d).value;
            if (isNaN(q.replace(/,/g, ''))) {
                q = 0;
            }
            if (q == "" || q === "") {
                q = 0;
                document.getElementById(d).value = q.toFixed(2);
            }

            var n = Number(parseFloat(q.replace(/,/g, ''))).toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            document.getElementById(d).value = n;

        }

        function check(a, b, c, d, e) {
            var w = document.getElementById(a).value;
            var x = document.getElementById(b).value;
            var y = document.getElementById(c).value;
            var z = document.getElementById(d).value;
            var k = document.getElementById(e).value;

            if (w == 'NaN') {
                w = 0;
                document.getElementById(a).value = w;
            }
            if (x == 'NaN') {
                x = 0;
                document.getElementById(b).value = x;
            }
            if (y == 'NaN') {
                y = 0;
                document.getElementById(c).value = y;
            }
            if (z == 'NaN') {
                z = 0;
                document.getElementById(d).value = z;
            }
            if (k == 'NaN') {
                k = 0;
                document.getElementById(e).value = k;
            }
        }

        function Nitcheck() {
            // Get the checkbox
            var tover = document.getElementById("tover").value;
            // Get the output text
            var nitdl = document.getElementById("nitds");

            // If the checkbox is checked, display the output text
            if (parseFloat(tover.replace(/,/g, '')) >= 100000000) {
                nitdl.style.display = "block";
            } else {
                nitdl.style.display = "none";
            }
            makenum("tover");
        }
    </script>

</body>

</html>