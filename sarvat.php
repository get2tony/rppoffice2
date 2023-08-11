<?php

$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Manage Self Assessment Registers</title>
  <link rel="stylesheet" href="css3/bootstrap.min.css">
  <link rel="stylesheet" href="css3/style4.css">
</head>

<body>

  <div class="panel ">
    <h4><span style="font-weight:bold;">Manage/Edit Returns Received in <?php echo date('Y') ?> </span></h4>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xs-3"><a href="tablevat?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&tab=y"><img src="img/003-folder-4.png" alt=""></a></div>
      <div class="col-xs-3"><a href="tablevat?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&tab=a"><img src="img/004-folder-3.png" alt=""></a></div>
      <div class="col-xs-3"><a href="tablevatlist?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>"><img src="img/003-folder-4.png" alt=""></a></div>

    </div>
    <div class="row">


      <div class="col-xs-3"><a class="btn btn-primary" href="tablevat?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&tab=y">Self Asmt Register for <?php echo date('Y') ?> </a></div>
      <div class="col-xs-3"><a class="btn btn-primary" href="tablevat?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&tab=a">All Self Asmt Filed</a></div>
      <div class="col-xs-3"><a class="btn btn-primary" href="tablevatlist?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>">VAT Filers Register</a></div>
    </div>


  </div>
  <hr>
  <h4 class=""><span style="font-weight:bold;">Manage VAT Compliance Registers</span></h4>
  <hr>
  <div class="container">
    <div class="row">

      <div class="col-xs-3"><a href="tablevat2?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>"><img src="img/005-folder-2.png" alt=""></a></div>
      <div class="col-xs-3"><a href="tablevat44?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>"><img src="img/003-folder-4.png" alt=""></a></div>
      <div class="col-xs-3"><a href="tablevat3?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>"><img src="img/005-folder-2.png" alt=""></a></div>
      <div class="col-xs-3"><a href="addvatlist?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>"><img src="img/002-file.png" alt=""></a></div>

    </div>&nbsp;
    <div class="row">
      <div class="col-xs-3"><a class="btn btn-primary" href="tablevat2?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>"><?php echo date('Y') ?> VAT Compliance (Extracts)</a></div>
      <div class="col-xs-3"><a class="btn btn-danger" href="tablevat44?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>">VAT Compliance(Indept)</a></div>
      <div class="col-xs-3"><a class="btn btn-primary" href="tablevat3?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>">VAT Compliance Check </a></div>
      <div class="col-xs-3"><a class="btn btn-primary" href="addvatlist?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>">Add VAT Filer</a></div>

    </div>


  </div>



</body>

</html>