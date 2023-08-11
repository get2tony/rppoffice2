<?php


include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');

$suser= isset($_REQUEST['user']) ? $_REQUEST['user'] : null; 
$sno= isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null; 
$serial= isset($_REQUEST['serial']) ? $_REQUEST['serial'] : null; 
if($serial==null){
	$serial=$sno;
}

$user=returnUsername($serial,$conn);


$self = returnSelfcount($user,$conn);
$gov = returnAsscount($user,$conn);
$lrp = returnLRPcount($user,$conn);

$sql4 = "SELECT * FROM adminasreg WHERE `taxtype`='VAT' && `capdate` like '%".date('Y')."' && `user`like '".$user."' ";
$sql5 = "SELECT * FROM adminasreg WHERE `basis`='BOJ' && `capdate` like '%".date('Y')."' && `user`like '".$user."' ";
$sql6 = "SELECT * FROM adminasreg WHERE `basis`='POL' && `capdate` like '%".date('Y')."' && `user`like '".$user."'";
$sql8 = "SELECT * FROM adminasreg WHERE `taxtype`='CIT' && `capdate` like '%".date('Y')."' && `user`like '".$user."' ";
$sql9 = "SELECT * FROM adminasreg WHERE `taxtype`='EDT' && `capdate` like '%".date('Y')."' && `user`like '".$user."' ";

        

$result4=mysqli_query($conn,$sql4);
     $vat=mysqli_num_rows($result4);
$result5=mysqli_query($conn,$sql5);
     $boj=mysqli_num_rows($result5);
$result6=mysqli_query($conn,$sql6);
     $pol=mysqli_num_rows($result6);
$result8=mysqli_query($conn,$sql8);
     $cit=mysqli_num_rows($result8);
$result9=mysqli_query($conn,$sql9);
     $edt=mysqli_num_rows($result9);

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
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: ""
	},
	data: [{
		type: "bar",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}",
		showInLegend: "false",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} = {y}",
		dataPoints: [
			{ y: <?php echo $self?>, label: "Self Asmts Received" },
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
		type: "pie",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} = {y}",
		dataPoints: [
			{ y: <?php echo $self?>, label: "Self Asmts " },
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
	   #ppics{
	   	width: 200px;
		height: 200px;
		clear: both;
		 display: block;
		 margin-left: auto;
  		margin-right: auto;
		   border-radius: 50%;
		   margin-top: 15px;
		   opacity: 0.5;
		   
	   }
	   
	   #profile{
	   	text-align: center;
		 
	   }
    </style> 
</head>
<body bgcolor="white" onload="startme();barme();">
<div class="container-fluid">
<div class="row-fluid col-md-8">
  <div class="panel"><h3><b>Score Card as at <?php echo date('d-m-Y')?></b></h3></div>
 <div id="chartContainer" style="height: 300px; width: 90%;"></div>  
    </div>
    <div  id="profile" class="row-fluid col-md-4">  
		<img  id="ppics" src="img/profile.png" alt="">
        <h3><?php echo $user;  ?></h3>
        <h4><b>Value of Asmt Raised: =N=<?php 
			
			
			$add= returnAssvalue($user,$conn);
			$add2=returnLRPvalue($user,$conn);
			
			echo number_format($add+$add2,2);
			
			?></b></h4>
    </div>
    
    <div class="row-fluid col-md-8">
      <div id="table">
    <h4><b>Analysis of Assessments by  <?php echo $user.' in '. date('Y') ?></b></h4>
     <table class="table  table-striped">
    <thead>
      <tr>
        <th>Register</th>
        <th>Tax type</th>
        <th>No. Raised</th>
        <th>Total Value Raised</th>
      </tr>
    </thead>
    <tbody>
      
      <tr>
        <td>VAT Assessments</td>
        <td>VAT</td>
        <td><span class="label label-danger"><?php echo $vat ?></span></td>
        <td><?php echo number_format(returnAssvalue2($user,'VAT',$conn),2);?></td>
      </tr>
      <tr>
        <td>LRP Current &amp; Back year</td>
        <td>CIT/VAT LSP</td>
        <td><span class="label label-danger"><?php echo $lrp ?></span></td>
        <td><?php echo number_format(returnLRPvalue($user,$conn),2);?></td>
      </tr>
       <tr>
        <td>POL Assessment</td>
        <td>CIT</td>
           <td><span class="label label-danger"><?php echo $pol ?></span></td>
           <td><?php echo number_format(returnAssvalue2($user,'POL',$conn),2);?></td>
      </tr>
      <tr>
        <td>BOJ Assessment</td>
        <td>CIT/EDT/VAT</td>
           <td><span class="label label-danger"><?php echo $boj ?></span></td>
           
           <td><?php echo number_format(returnAssvalue2($user,'BOJ',$conn),2);?></td>
      </tr>
       <tr>
        <td>CIT Assessment</td>
        <td>CIT</td>
           <td><span class="label label-danger"><?php echo $cit ?></span></td>
           
           <td><?php echo number_format(returnAssvalue2($user,'CIT',$conn),2);?></td>
      </tr><tr>
        <td>EDT Assessment</td>
        <td>EDT</td>
           <td><span class="label label-danger"><?php echo $edt ?></span></td>
           
           <td><?php echo number_format(returnAssvalue2($user,'EDT',$conn),2);?></td>
      </tr>
       
    </tbody>
  </table>
</div> 
       
    </div> 
    <div class="row-fluid col-md-4">
        <div id="chartContainer1" style="height: 280px; width: 100%;" ></div>
    </div>
 
    </div>
   
<script src="scripts/jquery-1.11.1.min.js"></script>
<script src="scripts/jquery.canvasjs.min.js"></script>
</body>
</html>