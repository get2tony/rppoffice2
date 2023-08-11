<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');

$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : null;
$table = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$ddate=date('Y');

$userstatus=checkUserstatus2($usersno,$conn);

$sql= "SELECT * FROM `adminasreg` WHERE `taxtype` LIKE '$type' && `approval` LIKE 'approved' && `capdate` LIKE '%".date('Y')."' ORDER BY sno DESC";

if($type=="auditall"){


  $sql= "SELECT * FROM `adminasreg` WHERE `basis` LIKE 'Audit Assessment' && `approval` LIKE 'approved' ORDER BY sno DESC";

}

if ($type=="boj"){

  $sql= "SELECT * FROM `adminasreg` WHERE `basis` LIKE '$type' && `approval` LIKE 'approved' && `capdate` LIKE '%".date('Y')."' ORDER BY sno DESC ";

}

if ($type=="audit") {

$sql= "SELECT * FROM `adminasreg` WHERE `basis` LIKE 'Audit Assessment' && `approval` LIKE 'approved' &&  `capdate` LIKE '%".date('Y')."' ORDER BY sno DESC";

}




 $table="adminasreg";
$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}


$amt='';
$amt2='';

if ($type=='auditall') {
  $showlabel='<div class="text-center"><h3>ALL AUDIT GOVT ASSESSMENT REGISTER</h3></div>';
}else {
  $showlabel='<div class="text-center"><h3>'.$ddate.' '.strtoupper($type).' GOVT ASSESSMENT REGISTER</h3></div>';
}


 ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RPP Office Assistant - Register Records</title>
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

#foo {
  background: none!important;
  border: none;
  padding: 0!important;
  /*optional*/
  /* font-family: arial, sans-serif; */
  /*input has OS specific font-family*/
  color: #337AB7;
  text-decoration: underline;
  cursor: pointer;
    }

</style>

</head>
<body>
  <?php echo $showlabel ?>

   <div id="showcount" class="text-center"><font   color="red" ><?php echo $count ?> Record(s) Found</font></div><br>
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
                <th>Address</th>
                <th>Asmt Year</th>
                <th>Tax Type</th>
                <th>Amount</th>
                <th>Assmt No</th>
                <th>Basis</th>
                <th>Date Raised</th>
                <th>Raised by</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
<?php

        $no     = 1;

        while ($row = mysqli_fetch_array($query))
        {
           $amt=str_replace(',','',$row['amount']);
			$page="viewass";
            $page2='editass';

			$serial=$row['sno'];
			$asmt=$row['asmtno'];
			$status=$row['approval'];
			$appby=$row['appby'];
			$appdate=$row['appdate'];
			$taxtype=$row['taxtype'];

			$coyname=str_replace("&"," %26 ",$row['coyname']);
            $address= str_replace("&"," %26 ",$row['address']);
			//$amount=number_format(str_replace(',', '', $row['amount']),2);



			if($taxtype=='VAT'){
				$page='viewvatass';
				$page2='editvatass';
			}

			if($amt==""){
				$amt=0;
			}
            $amt2=number_format(str_replace(' ','',$amt),2);

		    $user=$row['user']?$row['user']: 'Admin';
            echo '<tr>


                    <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.urldecode($row['coyname']).'</td>
                    <td>'.urldecode($row['address']).'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['taxtype'].'</td>
                    <td>'.$amt2.'</td>
                    <td>'.$row['asmtno'].'</td>
                    <td>'.ucwords($row['basis']).'</td>
                    <td>'.$row['capdate'].'</td>
                    <td>'.$user.'</td>

                    <td>';



			if ($userstatus=="user" ){

                        echo '
                            <form action="'.$page.' " id="fo" method="post" target="_blank">

               <input type="hidden" value="'.$row['tinno'].'"  id="data1" name="data1"/>
               <input type="hidden" value="'.$row['coyname'].'"  id="data2" name="data2"/>
               <input type="hidden" value="'.$row['address'].'"  id="data3" name="data3"/>
               <input type="hidden" value="'.$row['yoa'].'"  id="data4" name="data4"/>
               <input type="hidden" value="'.$row['capdate'].'"  id="data5" name="data5"/>
               <input type="hidden" value="'.$row['amount'].'"  id="data6" name="data6"/>
               <input type="hidden" value="'.$row['basis'].'"  id="data7" name="data7"/>
               <input type="hidden" value="'.$row['taxtype'].'"  id="data8" name="data8"/>
               <input type="hidden" value="'.$row['asmtno'].'"  id="data9" name="data9"/>
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
                <button type="Submit" class ="btn btn-primary" data-toggle="tooltip" title="View Record! ">
                        <span class="glyphicon glyphicon-print" alt="View Records"></span>View</button>
                    </form>
                        </tr>';

				}else{


                        echo '


                        <form action="'.$page.' " id="fo" method="post" target="_blank">

               <input type="hidden" value="'.$row['tinno'].'"  id="data1" name="data1"/>
               <input type="hidden" value="'.$row['coyname'].'"  id="data2" name="data2"/>
               <input type="hidden" value="'.$row['address'].'"  id="data3" name="data3"/>
               <input type="hidden" value="'.$row['yoa'].'"  id="data4" name="data4"/>
               <input type="hidden" value="'.$row['capdate'].'"  id="data5" name="data5"/>
               <input type="hidden" value="'.$row['amount'].'"  id="data6" name="data6"/>
               <input type="hidden" value="'.$row['basis'].'"  id="data7" name="data7"/>
               <input type="hidden" value="'.$row['taxtype'].'"  id="data8" name="data8"/>
               <input type="hidden" value="'.$row['asmtno'].'"  id="data9" name="data9"/>
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
                <button  id="foo" type="Submit" class ="btn btn-default" data-toggle="tooltip" title="View Record! ">
                        <span class="glyphicon glyphicon-print" alt="View Records"></span></button>
                         <a  data-toggle="tooltip" title="Edit Record!" target="dframe" href="'.$page2.'?tin='.$row['tinno'].'&user='.$suser.'&tab='.$table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-edit" alt="Edit Records"></span></a>
                        <a  class="badge" style="background:red" data-toggle="tooltip" title="Delete Record!" target="dframe" href="deleteassgov?usersno='.$usersno.'&tin='.$row['tinno'].'&user='.$suser.'&tab='.$table.'&sno='.$row['sno'].'&type='.$type.'"> <span class="glyphicon glyphicon-trash" alt="Delete Records"></span></a>


                  </form>
                        </td>

                </tr>';

			}


            $no++;
        }?>


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


       function sendURL(){
        var url = document.getElementById("view").href;

        s = url.replace(/[^=&]+=(&|$)/g,"").replace(/&$/,"");
        document.getElementById("view").href=s;
       }

   </script>

</body>
</html>
