<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
$errormsg='';
$errormsg2='';
$search='';
$table='';
$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;

 $suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;

$table = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
$search = isset($_REQUEST['tin']) ? $_REQUEST['tin'] : null;
$serial = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;


$sql = "SELECT * FROM $table where `sno`='$serial'&&`tinno`='$search'";


$query = mysqli_query($conn, $sql);

if (!$query) {

    die ('SQL Error: here' . mysqli_error($conn));

}

$sno="";
$coytin="";
$coyname="";
$coyadd="";
$assyr="";
$datecap="";
$taxtype="";
$amount="";
$yrend = isset($_REQUEST['yrend']) ? $_REQUEST['yrend'] : null;
$amtmsg = isset($_REQUEST['amt']) ? $_REQUEST['amt'] : null;
$defmsg = isset($_REQUEST['def']) ? $_REQUEST['def'] : null;
$duemsg = isset($_REQUEST['due']) ? $_REQUEST['due'] : null;

$alabel="";
$assno="";
$ayear="";
$basis="";

$duedate="";
$datefiled="";
$defaultmonth="";
$fuser="";

while ($row = mysqli_fetch_array($query))
        {
$sno=$row[0];
$coytin=$row[1];
$coyname=$row[2];
$coyadd=$row[3];
$assyr=$row[4];
$datecap=$row[5];
$taxtype=$row[6];
$amount=$row[7];

$alabel=$row[8];
$assno=$row[9];
$ayear=$row[10];
$basis=$row[11];

$duedate=$row[12];
$datefiled=$row[13];
$defaultmonth=$row[14];
$fuser=$row[16];
//$yrend=getyrend($duedate) ;

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Late Return Penalty</title>
     <link rel="stylesheet" href="css3/bootstrap.min.css">
<!--     <link rel="stylesheet" href="css/bootstrap-iso.css" />-->
     <link rel="stylesheet" href="css/bootstrap-datepicker3.css"/>
     <link rel="stylesheet" href="css3/style4.css"/>
     <!--  jQuery -->


<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>


  <!--  jQuery -->

</head>
<body>


    <section id= "form">
     <div class="container-fluid">
       <div class="bootstrap-iso">
        <form  name="returns" action="dodeletelrp " onsubmit="return validateForm()" method="post">
       <div class="row-fluid col-md-4">

                <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="text" class="form-control" id="coytin" name="coytin" placeholder="Tin here" value="<?php echo $coytin ?>" disabled/>
                </div>
                <div class="form-group">
                    <label for="coyname">Company Name:</label>
                    <input type="text" class="form-control" id="coyname"  name="coyname" placeholder="Taxpayer's Name" value="<?php echo $coyname ?>" disabled/>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea  name="address" class="form-control" id="address" placeholder="Taxpayer's Address" disabled><?php echo $coyadd ?></textarea>
                </div>



                     <div class="form-group">
                    <label for="yearend">Month Filed:</label>
                    <select name="yrendm" id="yrendm" >
                       <option >
                     <?php echo $yrend ?>
                       </option>
                    </select><select name="yoa" id="" >
                    <option ><?php   echo $assyr ?> </option>
                     </select><p></p>
                   </div>

                <label for="date">Date Submited:</label>
                   <div class="input-group">
                <input id="date" type="text" class="form-control" name="date" placeholder="dd-mm-YYYY" value="<?php  echo $datefiled   ?>" disabled/><span  id="date" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
                    <p></p>

                   <p></p>

                <input type="hidden" name="sno" value="<?php echo $sno ?> " />
                <input type="hidden" name="tin" value="<?php echo $coytin ?> " />
                 <input type="hidden" name="table" value="<?php echo $table ?>" />
                 <input type="hidden" name="user" value="<?php echo $suser ?>" />


                        <button type="submit" class="btn btn-danger">Delete VAT LSP</button>

                    </div>
 <div class="row-fluid col-md-4">




                <?php

                   if ($errormsg2==null){

                    echo ('  <div class="" id="screen"><h4> </h4> </div>');

                   }else{

                    echo ('  <div class="alert-danger" id="screen"><h4> <i class="glyphicon glyphicon-remove"></i> '.$errormsg2.' </h4> </div>');
                   }

                     if ($errormsg==null){

                    echo ('  <div class="" id="screen"><h4> </h4> </div>');

                   }else{

                    echo (' <div class="alert-success" id="screen"><h4><i class="glyphicon glyphicon-ok"></i> '.$errormsg.' </h4> </div>

                          <p>&nbsp;</p>



                     <div class="alert-warning" id="screen"><h4>
                    The Due date is now <b>'.$duemsg.',</b><p></p>
                    The No. of Months of Default is <b>'.$defmsg.'</b><p></p>
                    The VAT LSP Due is now <b>N '.$amtmsg.'</b>
                    </h4>

                    </div>

                    </div>');

                   }
                    ?>
            </div>


         </form>
        </div>
        </div>
    </section>



<!--    <script src="js3/jquery-1.12.4.js"></script>-->
    <script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'dd-mm-yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
      };
      date_input.datepicker(options);
    });
    </script>
<script type="text/javascript">

function validateForm() {
    var x = document.forms["returns"]["coytin"].value;
    var y = document.forms["returns"]["coyname"].value;
    var z = document.forms["returns"]["address"].value;


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

}

 </script>
</body>
</html>
