<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');


$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$tablename=isset($_REQUEST['catb']) ? $_REQUEST['catb'] : 'adminasreg';

$ustatus = isset($_REQUEST['status']) ? $_REQUEST['status'] : checkUserstatus2($usersno,$conn);
// $userstatus=checkUserstatus2($usersno,$conn);

$ddate=date('d-m-Y');
$table='adminasreg';
$catb='adminasreg';

function decideLrp($d){
    $tab='lrpcurrent';
if (strpos($d,'BA')) {
   $tab='lrpback_year';
}
return $tab;
}



if ($tablename=='adminasreg') {
if($ustatus=='controller'){

	$sql= "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%approved') && `capdate` LIKE '%$ddate' ORDER BY sno DESC";
	$showlabel='<div class="text-center"><h3>'.$ddate.' APPROVED ASSESSMENTS</h3></div>';
    }else{

    $sql= "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%approved') && `user` LIKE '$suser' && `appdate`LIKE '%$ddate' ORDER BY sno DESC";
        $showlabel='<div class="text-center"><h3>MY '.$ddate.' APPROVED ASSESSMENTS</h3></div>';
    }
}else {
    $sqlmain='CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT * FROM lrpcurrent UNION  SELECT * FROM lrpback_year ';
    $query1 = mysqli_query($conn,$sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query1) {
    die ('SQL Error: ' . mysqli_error($conn));
    }else{
        $table='temp_self';
        if($ustatus=='controller'){

            $sql= "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%approved') && `capdate` LIKE '%$ddate' ORDER BY sno DESC";
            $showlabel='<div class="text-center"><h3>'.$ddate.' APPROVED LRP / LSP ASSESSMENTS</h3></div>';
            }else{

            $sql= "SELECT * FROM `$table` WHERE ( IFNULL(approval, 0) LIKE '%approved') && `user` LIKE '$suser' && `appdate`LIKE '%$ddate' ORDER BY sno DESC";
                $showlabel='<div class="text-center"><h3>MY '.$ddate.' APPROVED LRP / LSP ASSESSMENTS</h3></div>';
            }

    }
}

$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}



 ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RPP Office Assistant - My Approved Assessments</title>
    <link rel="stylesheet" href="css3/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css3/buttons.dataTables.min.css">
    <!-- <link rel="stylesheet" href="css3/dataTables.bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="css3/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="css3/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css3/bootstrap.min.css">

<style>
.main {
    width: 100%;
    margin: 5px auto;
}

/* Bootstrap 3 text input with search icon */

.has-search .form-control-feedback {
    right: initial;
    left: 0;
    color: #ccc;
}

.has-search .form-control {
    padding-right: 12px;
    padding-left: 34px;
}
</style>

</head>
<body>
  <?php  echo $showlabel ?>

    <div>
  <!-- DROPDOWN FORM COMES HERE -->

<form name="search" action="tableuser3 "  method="post">
                    <label for="coyname">Display List:</label>
                    <select name=catb onchange="this.form.submit();">
                       <option value="<?php echo $tablename?>"><?php if ($table=='adminasreg') {
                           echo " Gov't Asmt";

                       }else{

                            echo "Late Penalty Asmt";

                       }     ?> </option>
                       <option value="adminasreg">Gov't Asmt</option>
                       <option value="lrps">Late Penalty Asmt</option>


                   </select>
               <input type="hidden" name="sno" value="<?php echo $usersno ?>">
               <input type="hidden" name="user" value="<?php echo $suser ?>">
               <input type="hidden" name="status" value="<?php echo $ustatus ?>">


                        &nbsp;&nbsp;&nbsp;

                        <!-- <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search </button>&nbsp;&nbsp;&nbsp; -->

                </form>






  <!-- DROPDOWN FORM COMES HERE -->




  </div>



   <div id="showcount" class="text-center"><font   color="red" ><?php echo $count ?> Record(s) Found</font></div>
   <div class="row main">
    <div class="col-lg-4"></div>
    <div class="col-lg-4"> <div class="form-group has-feedback has-search">
    <span class="glyphicon glyphicon-search form-control-feedback"></span>
    <input  id="searchbox" type="text" class="form-control" placeholder="Search">
  </div></div>
    <div class="col-lg-4"></div>

   </div>
    <table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S/No.</th>
                <th>Tin</th>
                <th>Company</th>
                <th>Asmt Year</th>
                <th>Tax Type</th>
                <th>Amount</th>
                <th>Assmt No</th>
                <th>Basis</th>
                <th>Date Raised</th>
                <th>Actions</th>
                <th>Raised By</th>

                <th>Approved By</th>
                <th>Approval Date</th>
                 <?php
				if($ustatus=='user'){

				}else{
					echo'<th>More Actions </th>';
				}

				?>


            </tr>
        </thead>
        <tbody>
<?php


        $no     = 1;

        while ($row = mysqli_fetch_array($query))
        {
          	$page="viewass";
			$serial=$row['sno'];
			$asmt=$row['asmtno'];
			$status=$row['approval'];
			$appby=$row['appby'];
			$appdate=$row['appdate'];
			$taxtype=$row['taxtype'];
			$coyname=str_replace("&","%26",$row['coyname']);
            $address= str_replace("&","%26",$row['address']);
			$coyname2=$row['coyname'];
            //$address2= $row['address'];
            $amount=number_format(str_replace(',', '', $row['amount']),2);

            $editpage='editass';
            $yrend='';
            $pagedel='deleteass';
            if ($tablename=='lrps') {
                    $asmtno=$row[8].$row[9].$row[10];
                     $table=decideLrp('$asmtno');
                     $catb='lrps';
                }
			if($taxtype=='VAT'){
				$page='viewvatass';
				$editpage='editvatass';
            }
            if ($taxtype=='LRP') {
                      $page='asmtlrp';
                      $editpage='editlrp';
                      $pagedel='deletelrp';
                      $table=decideLrp($asmtno);
                      $yrend= $row[15];
                      $catb='lrps';
                      $asmt=$asmtno;
            }
            if ($taxtype=='LSP') {
                      $page='viewvatlsp';
                       $editpage='editlrpvat';
                       $pagedel='deletelrpvat';
                        $table=decideLrp($asmtno);
                       $yrend= $row[15];
                       $catb='lrps';
                       $asmt=$asmtno;
            }


			if($status=='pending'){

			}else{
			//$checkass=checkApprovalstatus($asmt,$serial,$conn);

            echo '<tr>


                    <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$coyname2.'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['taxtype'].'</td>
                    <td>'.$amount.'</td>
                    <td>'.$asmt.'</td>
                    <td>'.ucwords($row['basis']).'</td>
                    <td>'.$row['capdate'].'</td>


                    <td>


                         &nbsp; '?>

                <?php

                if ($tablename!='lrps') {
                    echo ' <form action="'.$page.' " method="post" target="_blank">

               <input type="hidden" value="'.$row['tinno'].'"  id="data1" name="data1"/>
               <input type="hidden" value="'.$row['coyname'].'"  id="data2" name="data2"/>
               <input type="hidden" value="'.$row['address'].'"  id="data3" name="data3"/>
               <input type="hidden" value="'.$row['yoa'].'"  id="data4" name="data4"/>
               <input type="hidden" value="'.$row['capdate'].'"  id="data5" name="data5"/>
               <input type="hidden" value="'.$row['amount'].'"  id="data6" name="data6"/>
               <input type="hidden" value="'.$row['basis'].'"  id="data7" name="data7"/>
               <input type="hidden" value="'.$row['taxtype'].'"  id="data8" name="data8"/>
               <input type="hidden" value="'.$asmt.'"  id="data9" name="data9"/>
               <input type="hidden" value="'.$row['startdate'].'"  id="data10" name="data10"/>
               <input type="hidden" value="'.$row['enddate'].'"  id="data11" name="data11"/>
               <input type="hidden" value="'.$row['amtpaid'].'"  id="data12" name="data12"/>
               <input type="hidden" value="'.$row['assprofit'].'"  id="data13" name="data13"/>
               <input type="hidden" value="'.$row['tprofit'].'"  id="data14" name="data14"/>
               <input type="hidden" value="'.$row['penalty'].'"  id="data15" name="data15"/>
               <input type="hidden" value="'.$row['user'].'"  id="data16" name="data16"/>
               <input type="hidden" value="'.$row['appby'].'"  id="data17" name="data17"/>
               <input type="hidden" value="'.$row['inputvat'].'"  id="data18" name="data18"/>
               <input type="hidden" value="'.$row['vatamt'].'"  id="data19" name="data19"/>
               <input type="hidden" value="'.$row['sno'].'"  id="data20" name="data20"/>
                        <button  type="Submit" class ="btn btn-primary" data-toggle="tooltip" title="View Record! ">
                        <span class="glyphicon glyphicon-print" alt="View Records"></span> View</button>
                  		 </form>';
                }
                if ($tablename=='lrps' && $taxtype=='LRP') {
                   echo '
                   <form action="'.$page.' " method="post" target="_blank">
                  <input type="hidden" value="'.$row['tinno'].'"  id="data1" name="data1"/>
                <input type="hidden" value="'.$row['coyname'].'"  id="data2" name="data2"/>
               <input type="hidden" value="'.$row['address'].'"  id="data3" name="data3"/>
               <input type="hidden" value="'.$row['yoa'].'"  id="data4" name="data4"/>
               <input type="hidden" value="'.$row['capdate'].'"  id="data5" name="data5"/>
               <input type="hidden" value="'.$row['amount'].'"  id="data6" name="data6"/>
               <input type="hidden" value="'.$row['basis'].'"  id="data7" name="data7"/>
               <input type="hidden" value="'.$row['taxtype'].'"  id="data8" name="data8"/>
               <input type="hidden" value="'.$asmt.'"  id="data9" name="data9"/>


                    <button  type="Submit" class ="btn btn-primary" data-toggle="tooltip" title="View Record! ">
                        <span class="glyphicon glyphicon-print" alt="View Records"></span> View</button>
                  		 </form>


                   ';
                }


                if ($tablename=='lrps' && $taxtype=='LSP') {
                  $due=explode('-',$row['duedate']);
                  $duem=$due[1];
                  if ($duem==1) {
                    $start="01-12-".$due[2]-1;
                    $end="31-12-".$due[2]-1;
                  }else {
                    $rm=$due[1]-1;
                      $start="01-".$rm."-".$due[2];
                        $end="31-".$rm."-".$due[2];
                    }
                    // code...
                   echo '
                     <form action="'.$page.' " method="post" target="_blank">

               <input type="hidden" value="'.$row['tinno'].'"  id="data1" name="data1"/>
               <input type="hidden" value="'.$row['coyname'].'"  id="data2" name="data2"/>
               <input type="hidden" value="'.$row['address'].'"  id="data3" name="data3"/>
               <input type="hidden" value="'.$row['yoa'].'"  id="data4" name="data4"/>
               <input type="hidden" value="'.$row['capdate'].'"  id="data5" name="data5"/>
               <input type="hidden" value="'.$row['amount'].'"  id="data6" name="data6"/>
               <input type="hidden" value="'.$row['taxtype'].'"  id="data7" name="data7"/>
               <input type="hidden" value="'.$row['yearend'].'"  id="data8" name="data8"/>
               <input type="hidden" value="'.$asmt.'"  id="data9" name="data9"/>
               <input type="hidden" value="'.$row['basis'].'"  id="data10" name="data10"/>
               <input type="hidden" value="'.$row['DefaultMonth'].'"  id="data11" name="data11"/>
               <input type="hidden" value="'.$row['user'].'"  id="data12" name="data12"/>
               <input type="hidden" value="'.$row['duedate'].'"  id="data13" name="data13"/>
               <input type="hidden" value="'.$row['datefiled'].'"  id="data15" name="data15"/>
               <input type="hidden" value="'.$start.'"  id="start" name="start"/>
               <input type="hidden" value="'.$end.'"  id="end" name="end"/>




                   <button  type="Submit" class ="btn btn-primary" data-toggle="tooltip" title="View Record! ">
                        <span class="glyphicon glyphicon-print" alt="View Records"></span> View</button>
                  		 </form>
                   ';
                }

                  echo '

            	            &nbsp;


                    </td>

					'?>

				   <?php


				if($appby==""){
						$appby='Previously Issued';
					}
			if($appdate==""){
						$appdate=$row['capdate'];
					}

			?>
         <?php
                if($ustatus=='user'){

				echo'
				<td>'.$row['user'].'</td>
				<td>'.ucfirst($appby).'</td>
				<td>'.ucfirst($appdate).'</td>
                </tr>';
				}else{


					echo'
				<td>'.$row['user'].'</td>
				<td>'.ucfirst($appby).'</td>
                <td>'.ucfirst($appdate).'</td>
                <td>
                <a data-toggle="tooltip" title="Edit Record!"target="dframe" href="'.$editpage.'?catb='.$catb.'&yrend='.$yrend.'&usersno='.$usersno.'&tin='.$row['tinno'].'&user='.$suser.'&tab='.$table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-edit" alt="edit Records"></span></a>
                <a  class="badge" style="background:red" data-toggle="tooltip" title="Delete Record!" target="dframe" href="'.$pagedel.'?catb='.$catb.'&yrend='.$yrend.'&usersno='.$usersno.'&tin='.$row['tinno'].'&user='.$suser.'&tab='.$table.'&sno='.$row['sno'].'"> <span class="glyphicon glyphicon-trash" alt="Delete Records"></span></a></td>


                </tr>';


				}




            $no++;
        }


    }?>
<!--            <a  class="badge" style="background:red" data-toggle="tooltip" title="Delete Record!" target="dframe" href="deleteass?tin='.$row['tinno'].'&user='.$suser.'&tab='.$table.'&sno='.$row['sno'].'"> <span class="glyphicon glyphicon-trash" alt="Delete Records"></span></a>-->

        </tbody>
    </table>


    <script type="text/javascript" src="js3/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="js3/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js3/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="js3/pdfmake.min.js"></script>
    <script type="text/javascript" src="js3/vfs_fonts.js"></script>
    <script type="text/javascript" src="js3/buttons.html5.min.js"></script>
    <script type="text/javascript" src="js3/jszip.min.js"></script>





    <!--the button initialization-->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Brtip',
            select: true,
                buttons: [

                    {
                        extend: 'collection',
                        text: 'Export Report As >',
                        buttons: [
                            'copy',
                            'excel',
                            'csv',
                            {
                                extend: 'pdf',
                                orientation: 'landscape',
                                pageSize: 'LEGAL'

                            }


                        ]
                        }
                    ]
              } );
    } );


$(document).ready(function() {
    var dataTable = $('#example').dataTable();
    $("#searchbox").keyup(function() {
        dataTable.fnFilter(this.value);
    });
});
      /* $(document).ready(function() {
       $('#example').DataTable( {
       dom: 'Bfrtip',
       buttons: ['copy','excel','csv','pdf']
           } );
       } );*/

   </script>

</body>
</html>
