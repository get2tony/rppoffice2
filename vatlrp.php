<?php 
$sum=0;
$date1 =  isset($_REQUEST['stdate']) ? $_REQUEST['stdate'] : null;
$date2 =  isset($_REQUEST['spdate']) ? $_REQUEST['spdate'] : null;

$duedatenew=date('Y-m-d',strtotime($date1));
$datecapnew=date('Y-m-d',strtotime($date2));

$ts1 = strtotime($duedatenew);
$ts2 = strtotime($datecapnew);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$diff = (($year2 - $year1) * 12) + ($month2 - $month1);

$sum= ($diff/2)*($diff+1)*(5000);
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>VAT Late Submission Penalty</title>
<link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
     <link rel="stylesheet" href="css/bootstrap-datepicker3.css"/>
     <!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>


  <!--  jQuery -->
</head>

<body>

<div id="showArea" class="container-fluid">

<div class="row-fluid col-md-4"> 

 <?php
   
    if($sum>0){
     echo ' <div class="alert-warning" id="screen"><h4><i class="glyphicon glyphicon-envelope"></i> Computation of Penalty for <h2>'.$diff.' Month(s) of Default</h2> =
 '.$diff.'/2('.$diff.'+1)* N 5,000&nbsp; therefore&nbsp; The penalty </h4>
    is <h2 >N '.number_format($sum,2).'</h2> </div> '; 
        
    }
    
?>
</div>
<div class="row-fluid col-md-4">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h3>Value Added Tax Returns</h3>
<h5>Determination of Months of Default</h5>
<form name="calculate" action="vatlrp " method="POST">
 
 
 
 <p>&nbsp;</p>
 
	<label for="date">Date VAT due:</label>
                   <div class="input-group col-xs-5">
                <input id="date" type="text" class="form-control" name="stdate" placeholder="dd-mm-YYYY" value="<?php  echo date('d-m-Y')   ?>"><span  id="date" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
     </div>    
                    
                    <p>&nbsp;</p>
	<label for="date">Date Submited:</label>
                   <div class="input-group col-xs-5">
                <input id="date" type="text" class="form-control" name="spdate" placeholder="dd-mm-YYYY" value="<?php  echo date('d-m-Y')   ?>"><span  id="date" class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
                      
                <br>
                      <button name="Abutton1" type="submit" class="btn btn-primary">Submit</button>&nbsp;<button name="Abutton2" type="reset" class="btn btn-success">Reset	</button>
    
     
               



</form>
    </div>
<div class="row-fluid col-md-4">  </div>

    </div>
    
     <script>
    $(document).ready(function(){
      var date_input=$('input[name="stdate"]'); //our date input has the name "date"
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
     <script>
    $(document).ready(function(){
      var date_input=$('input[name="spdate"]'); //our date input has the name "date"
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
</body>

</html>
