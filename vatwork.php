<?php


$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Manage Gov't Assessment Registers</title>
  <link rel="stylesheet" href="css3/bootstrap.min.css">
  <link rel="stylesheet" href="css3/style4.css">
</head>

<body>

  <div class="panel">
    <h3>Manage Value Added Tax Desk</h3>
  </div>
  <div class="container">

    <div class="row">
      <!-- raiselrpvat2?sno=&user= -->

      <div class="col-xs-3"><a href="raiselrpvat?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>" target="dframe"><img src="img/check-box.png" alt="LSP" width="128px" height="128px"></a></div>
      <div class="col-xs-3"><a href="raiselrpvat2?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>" target="dframe"><img src="img/check-box.png" alt="LSP" width="128px" height="128px"></a></div>

      <div class="col-xs-3"><a href="capturevat?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>" target="dframe"><img src="img/002-file.png" alt="VAT" width="128px" height="128px"></a></div>

      <div class="col-xs-3"><a href="vatlrp?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>" target="dframe"><img src="img/003-calculator2.png" alt="VAT" width="128px" height="128px"></a></div>





    </div>

    <div class="row">
      <p></p>


      <div class="col-xs-3"><a class="btn btn-primary" href="raiselrpvat?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>" target="dframe">Raise VAT LSP ( Auto )</a> </div>
      <div class="col-xs-3"><a class="btn btn-success" href="raiselrpvat2?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>" target="dframe">Raise VAT LSP ( Manual )</a> </div>

      <div class="col-xs-3"><a class="btn btn-primary" href="capturevat?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>" target="dframe">Raise VAT Assessment</a></div>

      <div class="col-xs-3"><a class="btn btn-primary" href="vatlrp?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>" target="dframe">Compute VAT Penalty</a></div>





    </div>
    <p>&nbsp;</p>


    <div class="row">
      <div class="col-xs-3"><a href="tablegov?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&type=vat" target='dframe'><img src="img/005-folder-2.png" alt="VAT" width="128px" height="128px"></a></div>
      <div class="col-xs-3"><a href="tablelrpvat?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&tab=lrpcurrent" target='dframe'><img src="img/005-folder-2.png" alt="VAT" width="128px" height="128px"></a></div>
      <div class="col-xs-3"><a href="tablelrpvat?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&tab=lrpback_year" target='dframe'><img src="img/005-folder-2.png" alt="VAT" width="128px" height="128px"></a></div>



    </div>
    <div class="row">
      <p></p>

      <div class="col-xs-3"><a target='dframe' class="btn btn-primary" href="tablegov?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&type=vat">VAT Assmt Register</a></div>
      <div class="col-xs-3"><a target='dframe' class="btn btn-primary" href="tablelrpvat?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&tab=lrpcurrent">VAT LSP Current Register</a></div>

      <div class="col-xs-3"><a target='dframe' class="btn btn-primary" href="tablelrpvat?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&tab=lrpback_year">VAT LSP Back year Register</a></div>


    </div>



  </div>



</body>

</html>