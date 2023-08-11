<?php
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once(dirname(__FILE__) . '/dbconfig/config.php');
$sql1 = "SELECT * FROM current WHERE yoa like '%".date('Y')."'";
$sql2 = "SELECT * FROM adminasreg WHERE `capdate` like '%".date('Y')."' && approval like 'approved'";
$sql3 = "SELECT * FROM lrpcurrent WHERE `capdate` like '%".date('Y')."'";
$sql3b = "SELECT * FROM lrpback_year WHERE `capdate` like '%".date('Y')."'";
$sql4 = "SELECT * FROM adminasreg WHERE `taxtype`='VAT' && `capdate` like '%".date('Y')."' && approval like 'approved'";
$sql5 = "SELECT * FROM adminasreg WHERE `basis`='BOJ' && `capdate` like '%".date('Y')."' && approval like 'approved'";
$sql6 = "SELECT * FROM adminasreg WHERE `taxtype`='POL' && `capdate` like '%".date('Y')."' && approval like 'approved'";
$sql7="SELECT * FROM current WHERE yoa like '%".date('Y')."' ORDER BY `cit` DESC LIMIT 5";
        
$result=mysqli_query($conn,$sql1);
 $self=mysqli_num_rows($result); 
$result2=mysqli_query($conn,$sql2);
     $gov=mysqli_num_rows($result2);
$result3=mysqli_query($conn,$sql3);
    $lrp=mysqli_num_rows($result3);
$result3b=mysqli_query($conn,$sql3b);
    $lrp2=mysqli_num_rows($result3b);
$result4=mysqli_query($conn,$sql4);
     $vat=mysqli_num_rows($result4);
$result5=mysqli_query($conn,$sql5);
     $boj=mysqli_num_rows($result5);
$result6=mysqli_query($conn,$sql6);
     $pol=mysqli_num_rows($result6);

$self=amount_empty($self);
$gov=amount_empty($gov);
$lrp=amount_empty($lrp)+$lrp2=amount_empty($lrp2);
$vat=amount_empty($vat);
$boj=amount_empty($boj);
$pol=amount_empty($pol);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Intro Page</title>
     <link rel="stylesheet" href="css3/bootstrap.min.css">
<!--    <link rel="stylesheet" href="css3/style4.css">-->
    <script>
   function barme() {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: ""
	},
	data: [{
		type: "area",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}",
		showInLegend: "false",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} = {y}",
		dataPoints: [
			{ y: <?php echo $self?>, label: "Self Asmts" },
			{ y: <?php echo $gov ?>, label: "Gov't Asmts" },
			{ y: <?php echo $lrp+$lrp2 ?>, label: "LRP Asmts" },
			{ y: <?php echo $vat ?>, label: "VAT Asmts" },
			{ y: <?php echo $boj ?>, label: "BOJ Asmts" },
			{ y: <?php echo $pol ?>, label: "POL Asmts" }
			
		]
	}]
});
chart.render();

}
</script>
  <script>
   function startme() {

var chart = new CanvasJS.Chart("chartContainer1", {
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: ""
	},
	data: [{
		type: "doughnut",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} = {y}",
		dataPoints: [
			{ y: <?php echo $self?>, label: "Self Asmts" },
			{ y: <?php echo $gov ?>, label: "Gov't Asmts" },
			{ y: <?php echo $lrp ?>, label: "LRP Asmts" },
			{ y: <?php echo $vat ?>, label: "VAT Asmts" },
			{ y: <?php echo $boj ?>, label: "BOJ Asmts" },
			{ y: <?php echo $pol ?>, label: "POL Asmts" }
			
		]
	}]
});
chart.render();

}
</script>
   <style>
    b{
           color:darkred;
       }
    
    </style> 
</head>
<body bgcolor="white" onload="startme();barme();">
<div class="container-fluid">
<div class="row-fluid col-md-8">
  
 <div id="chartContainer" style="height: 300px; width: 90%;"></div>  
    </div>
    <div class="row-fluid col-md-4">  
<div id="table">
    <h4><b>Analysis of Registers for <?php echo date('Y') ?></b></h4>
     <table class="table  table-striped">
    <thead>
      <tr>
        <th>Register</th>
        <th>Tax type</th>
        <th>No. Raised</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Self Assessments</td>
        <td>CIT/EDT</td>
        <td><span class="label label-danger"><?php echo $self ?></span></td>
      </tr>
      <tr>
        <td>Gov't Assessments</td>
        <td>CIT/EDT/VAT</td>
        <td><span class="label label-danger"><?php echo $gov ?></span></td>
      </tr>
      <tr>
        <td>LRP Assessments</td>
        <td>CIT</td>
        <td><span class="label label-danger"><?php echo $lrp ?></span></td>
      </tr>
       <tr>
        <td>POL Assessments</td>
        <td>CIT</td>
           <td><span class="label label-danger"><?php echo $pol ?></span></td>
      </tr>
      <tr>
        <td>BOJ Assessments</td>
        <td>CIT</td>
           <td><span class="label label-danger"><?php echo $boj ?></span></td>
      </tr>
    </tbody>
  </table>
</div> 
    
    </div>
    
    <div class="row-fluid col-md-8">
      
       <h4><b>Top 5 Taxpayers as at <?php echo date('d-M-Y'); ?> for <?php echo date('Y'); ?> YOA</b> </h4>
        <table class="table table-striped">
    <thead>
      <tr>
        <th>Sno</th>
        <th>Taxpayer</th>
        <th>Year of Assmt</th>
        <th>Turnover</th>
        <th>Income Tax Filed</th>
      </tr>
    </thead>
    <tbody>
     
     <?php   
        $result7=mysqli_query($conn,$sql7);
        
        if(!$result7){
            
            
        }else{
        $no     = 1;
        
        while ($row = mysqli_fetch_array($result7))
        {
                $coyname=$row['coyname'];
                $turnover=$row['turnover'];
                $yoa=$row['yoa'];
                $cit=$row['cit'];
                $capdate=$row['capdate'];
            
            echo'
            <tr>
        <td>'.$no.'</td>
        <td>'.$coyname.'</td>
        <td>'.$yoa.'</td>
        <td>'.number_format($turnover,2).'</td>
        <td>'.number_format($cit,2).'</td>
      </tr>
            
            
            ';
        $no++;
            
        } }
        
        ?>
      
      
    </tbody>
  </table>
    </div> 
    <div class="row-fluid col-md-4">
        <div id="chartContainer1" style="height: 280px; width: 100%;" ></div>
    </div>
 
    </div>
   
<script src="scripts/jquery-1.11.1.min.js"></script>
<script src="scripts/jquery.canvasjs.min.js"></script>
</body>
</html>