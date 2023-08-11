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

$sql4 = "SELECT * FROM adminasreg WHERE `taxtype`='VAT' && `capdate` like '%".date('Y')."' && `user`like '".$user."' && approval like 'approved' ";
$sql5 = "SELECT * FROM adminasreg WHERE `basis`='BOJ' && `capdate` like '%".date('Y')."' && `user`like '".$user."' && approval like 'approved' ";
$sql6 = "SELECT * FROM adminasreg WHERE `taxtype`='POL' && `capdate` like '%".date('Y')."' && `user`like '".$user."' && approval like 'approved'";
$sql8 = "SELECT * FROM adminasreg WHERE `taxtype`='CIT' && `capdate` like '%".date('Y')."' && `user`like '".$user."' && approval like 'approved'";
$sql9 = "SELECT * FROM adminasreg WHERE `taxtype`='EDT' && `capdate` like '%".date('Y')."' && `user`like '".$user."' && approval like 'approved' ";

        

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

new Chart(document.getElementById("bar-chart"), {
    type: 'horizontalBar',
   // fill: boundary,
    data: {
      labels: ["Self Asmts", "Govt Asmts", "LRP Asmts", "VAT Asmts", "BOJ Asmts","POL Asmts"],
      datasets: [
        {
          label: "Count",
          fillColor:["transparent"] ,
          pointBackgroundColor:'blue',
          horizontal:true,
          lineTension: 0,
          backgroundColor:["","rgba(79, 129, 188, 0.6)","rgba(219, 6, 6, 0.6)","rgba(155, 187, 88, 0.6)","rgba(49, 195, 175, 0.6)","rgba(74, 172, 197, 0.6)","rgba(134, 107, 165, 0.6)"],
          fill: true,
          data: [null,<?php echo $self?>,<?php echo $gov ?>,<?php echo $lrp ?>,<?php echo $vat ?>,<?php echo $boj ?>,<?php echo $pol ?>]
          }]  
        },
    options: {
        //    labels:{fontFamily:'Arial'},
      legend: { display: false },
      title: {
        display: true,
        
        text: ''
      },

      scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:false
                }
            }]
        }

    }


});

}
</script>
  <script>
   function startme() {

new Chart(document.getElementById("bar-chart2"), {
    type: 'pie',
   // fill: boundary,
    data: {
      labels: ["Self Asmts", "Govt Asmts", "LRP Asmts", "VAT Asmts", "BOJ Asmts","POL Asmts"],
      datasets: [
        {
          label: "Count",
          fill: true,
          
          showline: false,
          pointBackgroundColor:'red',
          lineTension: 0,
          backgroundColor: ["#4F81BC","#db0606","#9BBB58","#31C3AF","#4AACC5","#866BA5"],
          data: [<?php echo $self?>,<?php echo $gov ?>,<?php echo $lrp?>,<?php echo $vat ?>,<?php echo $boj ?>,<?php echo $pol ?>]
          }]  
        },
    options: {
       
            // cutoutPercentage: 70,      
      legend: { display: false },
      title: {
        display: true,
        
        text: ''
      },

      scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:false
                }
            }]
        }

    }


});



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
     #shownum2{
        display: block;
        height: 60%;
        width: 50%;
        background-color: #866BA5;
        color: #fff;
        border-radius: 5%;
        /* clear: both; */
        text-align: center;
        padding: 2px;
        
     }
    </style> 
</head>
<body bgcolor="white" onload="startme();barme();">
<div class="container-fluid">
<div class="row-fluid col-md-8">
  <div class="panel"><h3><b>Score Card as at <?php echo date('d-m-Y')?></b></h3></div>
<canvas id="bar-chart" style="height: 300px; width: 90%;"></canvas>  
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
        <td><div id="shownum"><?php echo $vat ?></div></td>
        <td><?php echo number_format(returnAssvalue2($user,'VAT',$conn),2);?></td>
      </tr>
      <tr>
        <td>LRP Current &amp; Back year</td>
        <td>CIT/VAT LSP</td>
        <td><div id="shownum"><?php echo $lrp ?></div></td>
        <td><?php echo number_format(returnLRPvalue($user,$conn),2);?></td>
      </tr>
       <tr>
        <td>POL Assessment</td>
        <td>CIT</td>
           <td><div id="shownum"><?php echo $pol ?></div></td>
           <td><?php echo number_format(returnAssvalue2($user,'POL',$conn),2);?></td>
      </tr>
      <tr>
        <td>BOJ Assessment</td>
        <td>CIT/EDT/VAT</td>
           <td><div id="shownum"><?php echo $boj ?></div></td>
           
           <td><?php echo number_format(returnAssvalue2($user,'BOJ',$conn),2);?></td>
      </tr>
       <tr>
        <td>CIT Assessment</td>
        <td>CIT</td>
           <td><div id="shownum"><?php echo $cit ?></div></td>
           
           <td><?php echo number_format(returnAssvalue2($user,'CIT',$conn),2);?></td>
      </tr><tr>
        <td>EDT Assessment</td>
        <td>EDT</td>
           <td><div id="shownum"><?php echo $edt ?></div></td>
           
           <td><?php echo number_format(returnAssvalue2($user,'EDT',$conn),2);?></td>
      </tr>
       
    </tbody>
  </table>
</div> 
       
    </div> 
    <div class="row-fluid col-md-4">
         <canvas id="bar-chart2" style="height: 280px; width: 100%;" ></canvas>
    </div>
 
    </div>
   
<script src="scripts/jquery-1.11.1.min.js"></script>
<script src="Chart.js"></script>
</body>
</html>