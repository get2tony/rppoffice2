<?php
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$sno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>RPP O A- Reports</title>
  <link rel="stylesheet" href="css3/bootstrap.min.css">

</head>

<body>

  <div class="panel ">
    <h2>Generate Specific Reports</h2>
  </div>


  <div class="col-md-6 ">
    <H4><span class=""><b>Generate Reports for Only Returns filed in <?php echo date('Y'); ?></b> </span></H4>
    <ul class="list-group ">
      <li class="list-group-item">List of Taxpayers - <a href="allregsearch?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">All Filers of Returns in <?php echo date('Y') ?> Regardless of YOA (Self Assessment Registers)</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="saregsearch?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">Filers of <?php echo date('Y') ?> YOA Returns (Self Assessment Registers)</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="govsasearch?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe">Government Assessment Registers</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="govsasearch3?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe">AUDIT Assessment Registers in <?php echo date('Y') ?> YOA</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="lrpasearch?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">LRP Registers</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="lrpasearchvat?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">VAT LSP Registers</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="sasearchtype?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">By Tax Types (Self Assessment)</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="sasearchyoa?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">By Years of Assessment (Self Assessment)</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="nilsearchyoa?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">Nil Filers by YOA only (Self Assessment)</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="minsearchyoa?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">Minimum Tax Filers by YOA (Self Assessment)</a></li>
      <!--     <li class="list-group-item">List of Taxpayers - <a href="topsearchyoa " target="dframe">Top Filers by YOA (Self Assessment)</a></li>-->
    </ul>


  </div>






  <div class="col-md-6">
    <h4> <span class=""><b> Generate Reports for Returns Filed Regardless of Year Filed</b></span></h4>
    <ul class="list-group ">
      <li class="list-group-item">List of Taxpayers - <a href="sasearchyoa?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">All Filers of Specific YOA Returns Regardless of Year Filed (Self Assessment)</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="nilsearchyoa2?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">All Nil Filers in <?php echo date('Y') ?> regardless of YOA filed (Self Assessment)</a></li>
      <li class="list-group-item" style="background:#edf6d3">List of Taxpayers - <a href="searchdate " target="dframe">Filers by Date (Self Assessments, NIL, Min Tax, NITDF &amp; WHT Credit Notes Filers)</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="govsasearch2?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe">Government Assessment Registers by YOA</a></li>
      <li class="list-group-item" style="background:#edf6d3">List of Taxpayers - <a href="searchdateadd " target="dframe">Search by Date (Govt Asmts,VAT,POL,WHT, AUDIT &amp; BOJ )</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="govsasearch3?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe">AUDIT Assessment Registers by YOA</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="minsearchyoa?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">Minimum Tax Filers by YOA (Self Assessment)</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="topsearchyoa?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">Top Filers by YOA (Self Assessment)</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="searchdueyoa?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">Filers by Year End (Self Assessment)</a></li>
      <li class="list-group-item" style="background:#f9f5c0">List of Taxpayers - <a href=" searchdueyoax?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">Non-Filers / Filers by Year End (Self Assessment)</a></li>
      <li class="list-group-item" style="background:#edf6d3">List of Taxpayers - <a href="searchdueyoa2?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">Filers by Due Month (Self Assessment)</a></li>
    </ul>


  </div>





  <div class="col-md-6">
    <h4> <span class=""><b> Generate Reports for VAT Returns Filed </b></span></h4>
    <ul class="list-group ">
      <li class="list-group-item">List of Taxpayers - <a href="lrpasearchvat?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">VAT LSP Registers</a></li>
      <li class="list-group-item" style="background:#edf6d3">List of Taxpayers - <a href="searchdatevat " target="dframe">Filers by Date (VAT Self Assments, NIL &amp; Non Filers)</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="govsasearch3?sno=<?php echo $sno ?>&user=<?php echo $suser ?>" target="dframe">AUDIT Assessment Registers by YOA</a></li>

      <li class="list-group-item" style="background:#edf6d3">List of Taxpayers - <a href="searchdateadd " target="dframe">Search by Date (Govt Asmts,VAT,POL,WHT, AUDIT &amp; BOJ )</a></li>
      <li class="list-group-item">List of Taxpayers - <a href="topsearchvat?sno=<?php echo $sno ?>&user=<?php echo $suser ?> " target="dframe">VAT Top Filers (Self Assessment)</a></li>

    </ul>


  </div>








</body>

</html>