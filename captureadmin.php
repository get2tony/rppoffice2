<?php
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
$errormsg = '';
$errormsg2 = '';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;

$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$frm = isset($_REQUEST['frm']) ? $_REQUEST['frm'] : null;

$userstatus = checkUserstatus2($usersno, $conn);

$rate = getSettings('intrate', $conn) + getSettings('penrate', $conn);
$citrate = getSettings('citrate', $conn);
$edtrate = getSettings('edtrate', $conn);
$getDate=isset($_REQUEST['yoa']) ? $_REQUEST['yoa'] : date('Y');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Raise Assessment</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">

    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/jquery.character-counter.js"></script>
    <!-- <script src="js3/jquery-1.12.0.min.js"></script> -->


    <script>
        function getLoad(k) {
            var m = document.getElementById(k).value;
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    myObj = JSON.parse(this.responseText);
                    document.getElementById("defaultInput").value = myObj.name;
                    document.getElementById("address").value = myObj.address;
                    document.getElementById("coytin").value = myObj.coytin;
                }
            };
            xmlhttp.open("GET", "getinfo.php?q=" + m, true);
            // xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send();
        }

        function getSearchParameters() {
            var prmstr = window.location.search.substr(1);
            return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
        }

        function transformToAssocArray(prmstr) {
            var params = {};
            var prmarr = prmstr.split("&");
            for (var i = 0; i < prmarr.length; i++) {
                var tmparr = prmarr[i].split("=");
                params[tmparr[0]] = tmparr[1];
            }
            return params;
        }

        function reboot() {
            var params = getSearchParameters();
            var n = params.tin;
            var m = params.tax;
            var v = params.user;
            var w = params.sno;
            var a = params.amount;
            var y = params.yoa;
            var z = params.frm;

            if (n == "" || n == null) {
                // document.getElementById("coytin").value="";
            } else {
                document.getElementById("coytin").value = decodeURIComponent(n);
                document.getElementById("tax").value = decodeURIComponent(m);
                document.getElementById("user").value = decodeURIComponent(v);
                document.getElementById("usersno").value = decodeURIComponent(w);
                document.getElementById("amount").value = decodeURIComponent(a);
                document.getElementById("yoa").value = decodeURIComponent(y);
                getLoad('coytin');
                // show(m);
            }
            if (z == "" || z == null) {

                var d = document.getElementById("tax").value;
                show(d);
            } else {
                show(m);
            }

        }
    </script>


</head>

<body onload="reboot()">
    <div class="container-fluid">

        <div class="note2">
            <h3> &nbsp;Raise Registered Assessments ( CIT,EDT,WHT,POL,TP &amp; VAT )</h3>
        </div>
        <form id="returns" name="returns" action="doass " onsubmit="return validateForm()" method="post" target="dframe">
            <div class="row-fluid col-md-4">
                <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="hidden" id="user" value="<?php echo $suser ?>">
                    <input type="hidden" id="usersno" value="<?php echo $usersno ?>">
                    <input type="text" class="form-control" id="coytin" name="coytin" placeholder="Tin here" onchange="getLoad('coytin')">
                </div>
                <div class="form-group">
                    <label for="coyname">Company Name:</label>
                    <input type="text" class="form-control" name="coyname" placeholder="Taxpayer's Name" id="defaultInput" data-charcount-enable="true" maxlength="34">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea name="address" class="form-control" id="address" placeholder="Taxpayer's Address" maxlength="65"></textarea>
                </div>

                <div class="form-group">
                    <label for="YOA">Year of Assessment:</label>
                    <input type="text" name="yoa" class="form-control" id="yoa" placeholder="Year of Assessment" value="<?php echo $getDate; ?>" onchange="myVal()">
                </div>

                <div class="form-group">
                    <label for="capture">Date Raised:</label>
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
                </div>
                <p></p>



            </div>





            <!--second row-->
            <div class="row-fluid col-md-4">

                <div class="form-group">
                    <label for="taxtype">Tax Type:</label>
                    <select name="ttype" id="tax" onchange="java_script_:show(this.options[this.selectedIndex].value)">
                        <?php
                            $getTax = isset($_REQUEST['tax']) ? $_REQUEST['tax'] : null;
                            if ($getTax=="TP") {
                               $showtax='TRANSFER PRICING';
                             }else {
                                 $showtax= $getTax;
                             };

                            if ($getTax!== null) {
                               echo '<option value="'.$getTax.'">'.$showtax.'</option>';
                            }
                        ?>
                        <option value="POL">POL</option>
                        <option value="CIT">CIT</option>
                        <option value="EDT">EDT</option>
                        <option value="WHT">WHT</option>
                        <option value="CGT">CGT</option>
                        <option value="TP">TRANSFER PRICING</option>
                        <option value="NITDL">NITDL</option>
                        <option value="VAT">VAT</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="coyname">Period covered:</label>
                    <input type="text" class="" id="startdate" name="startdate" placeholder="start date" size="10" value="01-01-<?php echo $getDate - 1; ?>">
                    <label for="enddate"> To:</label>
                    <input type="text" class="" id="enddate" name="enddate" placeholder="End date" size="10" value="31-12-<?php echo $getDate - 1; ?>">
                </div>
                <div id="addedtinfo" style="display:none;color:#0b33a2">

                    <div class="form-group">
                        <label for="amnt">EDT Rate:</label>
                        <input type="text" name="edtrate" id="edtrate" placeholder="EDT Rate" value="<?php echo $edtrate ?>" onchange="makenum('edtrate')" size="2">
                        <label for="">%</label><br><br>
                        <label for="amnt">Display Assessable Profit on Asmt?</label>
                        <select name="aprofit" id="aprofit" onchange="java_script_:showPaid2(this.options[this.selectedIndex].value)">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>


                    </div>

                </div>
                <div id="edtpaid" style="display:none;color:#ef2323">

                    <div class="form-group">
                        <label for="amnt">EDT Already paid:</label>
                        <input type="text" class="form-control" name="edtamtpaid" id="edtamtpaid" placeholder="Amount Already paid" value="0.00" onchange="makenum('edtamtpaid')">
                        <br>
                        <label for="amnt">Include Penalty &amp; Interest @ <?php echo $rate ?>%:</label>&nbsp;&nbsp;<input type="checkbox" name="penintedt" id="penintedt" placeholder="penalty">

                    </div>

                </div>



                <div id="addcitinfo" style="display:none;color:#0b33a2">
                    <div class="form-group">
                        <label for="amnt">CIT Rate:</label>
                        <input type="text" name="citrate" id="citrate" placeholder="CIT Rate" value="<?php echo $citrate ?>" onchange="makenum('citrate')" size="2">
                        <label for="">%</label><br><br>
                        <label for="amnt">Display Total Profit on Asmt?</label>
                        <select name="tprofit" id="tprofit" onchange="java_script_:showPaid(this.options[this.selectedIndex].value)">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>


                </div>

                <div id="citpaid" style="display:none;color:#ef2323">

                    <div class="form-group">
                        <label for="amnt">CIT Already paid:</label>
                        <input type="text" class="form-control" name="citamtpaid" id="citamtpaid" placeholder="Amount Already paid" value="0.00" onchange="makenum('citamtpaid')">
                        <br>

                        <label for="amnt">Include Penalty &amp; Interest @ <?php echo $rate ?>%:</label>&nbsp;&nbsp;<input type="checkbox" name="penintcit" id="penintcit" placeholder="penalty">

                    </div>

                </div>

                <!--<div id="addvatinfo" hidden>
                    <div class="form-group">
                    <label for="amnt">Sales / Services:</label>
                    <input type="text" class="form-control" name="sales" id="sales" placeholder="Sales" value="0.00"  >
                    </div>

                    <div class="form-group">
                    <label for="amnt">Input VAT claim:</label>
                    <input type="text" class="form-control" name="input" id="input" placeholder="Input VAT" value="0.00"  >
                    </div>


					</div>-->



                <div class="form-group">
                    <label for="amnt">Asmt Amount:</label>
                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount Raised" value=0.00 onchange="makenum('amount')" required>

                </div>

                <div class="form-group">
                    <label for="cittxt">Basis of Assessment:</label>
                    <select name="basis" id="basis">
                        <option value="Admin Tax">Administrative Tax</option>
                        <option value="Additional Tax">Additional Tax</option>
                        <option value="BOJ">Best of Judgement</option>
                        <option value="Audit">Audit Assessment</option>
                        <option value="TP Late Filing">TP Late Filing</option>
                        <option value="LRP">Un-Registered LRP</option>
                        <option value="Re-assessment">Re-assessment</option>
                        <option value="Tax Investigation">Tax Investigation</option>
                        <option value="VAT Coordination">VAT Coordination</option>
                        <option value="Provisional Tax">Payment on Account</option>
                    </select>
                </div>

                <p></p>
            </div>
            <div class="row-fluid col-md-4">
                <input type="hidden" name="user" value="<?php echo $suser ?>">
                <input type="hidden" name="usersno" value="<?php echo $usersno ?>">
                <button type="submit" class="btn btn-primary">Process Asmt</button>


                <?php

                if ($errormsg2 == null) {

                    echo ('  <div class="" id="screen"><h4> </h4> </div>');
                } else {

                    echo ('  <div class="alert-danger" id="screen"><h4>' . $errormsg2 . ' </h4> </div>');
                }

                if ($errormsg == null) {

                    echo ('  <div class="" id="screen"><h4> </h4> </div>');
                } else {

                    echo ('  <div class="alert-success" id="screen"><h4>' . $errormsg . ' </h4> </div>');
                }
                ?>



            </div>
            <!--end of third row-->
        </form>



    </div>

    <script type="text/javascript">
        function validateForm() {
            var x = document.forms["returns"]["coytin"].value;
            var y = document.forms["returns"]["defaultInput"].value;
            var z = document.forms["returns"]["address"].value;
            var w = document.forms["returns"]["amount"].value;
            var k = document.forms["returns"]["citrate"].value;
            var m = document.forms["returns"]["edtrate"].value;


            if (m == 0.00) {
                alert("Enter valid EDT Rate ");
                document.forms["returns"]["edtrate"].value = <?php echo $edtrate; ?>;
                return false;
            }
            if (k == 0.00) {
                alert("Enter valid CIT Rate ");
                document.forms["returns"]["citrate"].value = <?php echo $citrate; ?>;
                return false;
            }
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
            if (w == "0.00") {
                alert("An Amount must be filled out");
                return false;
            }

        }
    </script>

    <script type="text/javascript">
        function myVal() {
            var k = document.getElementById("yoa").value;
            var m = k - 1;
            document.getElementById("startdate").value = "01-01-" + m;
            document.getElementById("enddate").value = "31-12-" + m;
        }



        function show(aval) {
            if (aval == "CIT") {
                addcitinfo.style.display = 'inline-block';
                addedtinfo.style.display = 'none';
                document.getElementById("tprofit").value = "yes";
                document.getElementById("aprofit").value = "no";
                document.getElementById("penintcit").checked = false;
                document.getElementById("penintedt").checked = false;
                edtpaid.style.display = 'none';
                citpaid.style.display = 'inline-block';
                document.getElementById("citamtpaid").value = '0.00';
                document.getElementById("edtamtpaid").value = '0.00';
                Form.fileURL.focus();
            }

            if (aval == "EDT") {
                addedtinfo.style.display = 'inline-block';
                addcitinfo.style.display = 'none';
                document.getElementById("aprofit").value = "yes";
                document.getElementById("tprofit").value = "no";
                document.getElementById("penintedt").checked = false;
                document.getElementById("penintcit").checked = false;
                citpaid.style.display = 'none';
                edtpaid.style.display = 'inline-block';
                document.getElementById("citamtpaid").value = '0.00';
                document.getElementById("edtamtpaid").value = '0.00';

                Form.fileURL.focus();
            }

            if (aval == "POL") {
                addedtinfo.style.display = 'none';
                addcitinfo.style.display = 'none';
                citpaid.style.display = 'none';
                edtpaid.style.display = 'none';
                document.getElementById("penintedt").checked = false;
                document.getElementById("penintcit").checked = false;
                document.getElementById("aprofit").value = "no";
                document.getElementById("tprofit").value = "no";
                document.getElementById("citamtpaid").value = '0.00';
                document.getElementById("edtamtpaid").value = '0.00';
                document.getElementById("amount").value = '25000';
            }
            if (aval == "TP") {
                addedtinfo.style.display = 'none';
                addcitinfo.style.display = 'none';
                citpaid.style.display = 'none';
                edtpaid.style.display = 'none';
                document.getElementById("penintedt").checked = false;
                document.getElementById("penintcit").checked = false;
                document.getElementById("aprofit").value = "no";
                document.getElementById("tprofit").value = "no";
                document.getElementById("citamtpaid").value = '0.00';
                document.getElementById("edtamtpaid").value = '0.00';
                document.getElementById("amount").value = '25000';
                document.getElementById("basis").value = 'TP Late Filing';
            }
            if (aval == "NITDL") {
                addedtinfo.style.display = 'none';
                addcitinfo.style.display = 'none';
                citpaid.style.display = 'none';
                edtpaid.style.display = 'none';
                document.getElementById("penintedt").checked = false;
                document.getElementById("penintcit").checked = false;
                document.getElementById("aprofit").value = "no";
                document.getElementById("tprofit").value = "no";
                document.getElementById("citamtpaid").value = '0.00';
                document.getElementById("edtamtpaid").value = '0.00';
                document.getElementById("amount").value = '25000';

            }
            if (aval == "WHT") {
                addedtinfo.style.display = 'none';
                addcitinfo.style.display = 'none';
                citpaid.style.display = 'none';
                edtpaid.style.display = 'none';
                var m = document.getElementById("coytin").value;
                var a = document.getElementById("amount").value;
                var y = document.getElementById("yoa").value;
                var o = "<?php echo $suser ?>";
                var p = "<?php echo $usersno ?>";
                // var n=document.getElementById("tax").value;
                window.location.href = 'capturewht.php?tin=' + encodeURIComponent(m) + '&user=' + encodeURIComponent(o) + '&sno=' + encodeURIComponent(p) + '&amount=' + encodeURIComponent(a) + '&yoa=' + encodeURIComponent(y);
            }
            if (aval == "CGT") {
                addedtinfo.style.display = 'none';
                addcitinfo.style.display = 'none';
                citpaid.style.display = 'none';
                edtpaid.style.display = 'none';
                var m = document.getElementById("coytin").value;
                var a = document.getElementById("amount").value;
                var y = document.getElementById("yoa").value;
                var o = "<?php echo $suser ?>";
                var p = "<?php echo $usersno ?>";
                // var n=document.getElementById("tax").value;
                window.location.href = 'capturecgt.php?tin=' + encodeURIComponent(m) + '&user=' + encodeURIComponent(o) + '&sno=' + encodeURIComponent(p) + '&amount=' + encodeURIComponent(a) + '&yoa=' + encodeURIComponent(y);
            }

            if (aval == "VAT") {
                addedtinfo.style.display = 'none';
                addcitinfo.style.display = 'none';
                citpaid.style.display = 'none';
                edtpaid.style.display = 'none';
                var m = document.getElementById("coytin").value;
                var a = document.getElementById("amount").value;
                var y = document.getElementById("yoa").value;
                var o = "<?php echo $suser ?>";
                var p = "<?php echo $usersno ?>";
                // var n=document.getElementById("tax").value;
                window.location.href = 'capturevatrpp.php?tin=' + encodeURIComponent(m) + '&user=' + encodeURIComponent(o) + '&sno=' + encodeURIComponent(p) + '&amount=' + encodeURIComponent(a) + '&yoa=' + encodeURIComponent(y);

            }


        }


        function showPaid(aval) {
            if (aval == "yes") {
                citpaid.style.display = 'inline-block';
                Form.fileURL.focus();
            } else {
                citpaid.style.display = 'none';
            }

        }

        function showPaid2(aval) {
            if (aval == "yes") {
                edtpaid.style.display = 'inline-block';
                Form.fileURL.focus();
            } else {
                edtpaid.style.display = 'none';
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
    </script>
</body>

</html>
