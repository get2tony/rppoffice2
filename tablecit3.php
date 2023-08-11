<?php 

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
// $tab = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
$showyr1 = isset($_REQUEST['noyr']) ? $_REQUEST['noyr'] : 3;
$showyr = $showyr1-1;
// $ddate=date('Y');

$userstatus=checkUserstatus2($usersno,$conn);


    //$sql="SELECT DISTINCT * FROM  current GROUP BY tinno ORDER BY coyname ASC ";
    //  $sql="SELECT current.tinno, back_year.tinno, current.coyname,back_year.coyname,current.address,back_year.address
    //         FROM current
    //        INNER JOIN back_year ON current.tinno=back_year.tinno";

    // $sql='SELECT current.tinno,current.coyname,current.address,current.yearend,current.duedate,back_year.tinno,back_year.coyname,back_year.address,back_year.yearend,back_year.duedate
    //         FROM current,back_year WHERE current.tinno=back_year.tinno GROUP BY back_year.tinno';
//    $sqlmain=' CREATE TEMPORARY TABLE temp_self SELECT * FROM original_table LIMIT 0';   
   $sqlmain='CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT * FROM current UNION  SELECT * FROM back_year ';   
    $query1 = mysqli_query($conn,$sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query1) {
    die ('SQL Error: ' . mysqli_error($conn));
    }else{

    $sql='SELECT DISTINCT * FROM temp_self GROUP BY tinno';

    }
//  $table="adminasreg";
$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}


$amt='';
$amt2='';
$showlabel='<div class="text-center"><h3>WORLD BANK TEMPLATE </h3></div>';

function getcurrentinfo5($conn, $tin, $yoa)
{

    $sql = "SELECT * FROM current where `tinno`='$tin' && `yoa`='$yoa'  LIMIT 1";
    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die('SQL Error: getcompinfo' . mysqli_error($conn));
    }
    $amount = "";
    while ($row = mysqli_fetch_array($query)) {
        $amount = $row[13];
    }
    if ($amount == '' || $amount == null) {
        $amount = getbackinfo5($conn, $tin, $yoa);
    } else {
        $amount = number_format($amount, 2); # code...
    }
    return $amount;
    mysqli_close($conn);
    exit;
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RPP Office CIT Compliance Register </title>
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
#noyr{
float: right;

}
</style>

</head>
<body>
  <?php echo $showlabel ?>
   <?php
                    
                   if ($errormsg2==null){
                       
                   
                   
                   }else{
            
                    echo ('<div class="alert-danger" id=""><marquee>'.$errormsg2.'</marquee> </div>');
                   }
                    
                     if ($errormsg==null){
                       
                   
                   
                   }else{
            
                    echo ('  <div class="alert-success" id=""><marquee>'.$errormsg.' </marquee> </div>');
                   }
                    ?>
   <div id="showcount" class="text-center"><font   color="red" ><?php echo $count ?> Record(s) Found</font></div><br>
   <div class="row main">
    <div class="col-lg-4"></div>
    <div class="col-lg-4"> <div class="form-group has-feedback has-search">
    <span class="glyphicon glyphicon-search form-control-feedback"></span>
    <input  id="searchbox" type="text" class="form-control" placeholder="Search">
  </div></div>
    <div class="col-lg-4" >
    <div id="noyr">
     <form action="" >
    
    <b>No. of years :</b>
     <select name="noyr" id="" onchange="this.form.submit();">
    <option value="<?php echo $showyr1 ?>"><?php echo $showyr1 ?></option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    </div>
    </select></form></div>
    
   </div>
    <table id="example" class="display table table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S/No.</th>
                <th>Tin</th>
                <th>Company</th>
                <th>Address</th>
                
                <th>Sector</th>
               
                <?php  

        for ($i=$showyr; $i >=0; $i--) { 
            # code...

             $day[$i]=(date('Y')-$i);

              echo '
                   <th>'.$day[$i].' YOA Turnover</th>
                   <th>'.$day[$i].' YOA  Ass Profit</th>
                   <th>'.$day[$i].' YOA  Total Profit</th>
                   <th>'.$day[$i].' YOA  Capital All</th>
                   <th>'.$day[$i].' YOA  CIT Paid</th>
                   <th>'.$day[$i].' YOA  EDT Paid</th>
                   
                   ';
        }
                    // $day4=(date('Y')-4);
                    // $day3=(date('Y')-3);
                    // $day2=(date('Y')-2);
                    // $day1=(date('Y')-1);
                    // $day0=(date('Y')-0);
                   
            
               ?>
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
          
            $tinno=$row['tinno'];
            $coyname=$row['coyname'];
            $address=$row['address'];
            $nob=$row['remark'];
            // $aprofit=$row['aprofit']? $row['aprofit']:0;
            // $tprofit=$row['tprofit']? $row['tprofit']:0;
            
            // $yearend=$row['yearend'];
            // $duedate=$row['duedate'];

            echo '<tr>

                
                    <td>'.$no.'</td>
                    <td>'.$tinno.'</td>
                    <td>'.$coyname.'</td>
                    <td>'.$address.'</td>
                    <td>'.$nob.'</td>';
                 for ($i=$showyr; $i>=0; $i--) { 

                    $aprofit=str_replace(',','',getcurrentinfo3($conn,$tinno,$day[$i]));
                    $tprofit=str_replace(',','',getcurrentinfo4($conn,$tinno,$day[$i]));
                    $citpaid=str_replace(',','',getcurrentinfo($conn,$tinno,$day[$i]));
                    $edtpaid=str_replace(',','',getcurrentinfo5($conn,$tinno,$day[$i]));
                    if ($citpaid<1) {
                        # code...
                    }else{
                        $citpaid=number_format($citpaid, 2);
                    }
                    if ($edtpaid<1) {
                        # code...
                    }else{
                        $edtpaid=number_format($edtpaid, 2);
                    }
                    $ca=($aprofit-$tprofit);
                     if ($ca<1) {
                        $ca=0;
                     }
                    echo '
                   <td>'.getcurrentinfo2($conn,$tinno,$day[$i]).'</td>
                   <td>'.number_format($aprofit,2).'</td>
                   <td>'.number_format($tprofit,2).'</td>
                   <td>'.number_format($ca,2).'</td>
                   <td>'.$citpaid.'</td>
                   <td>'.$edtpaid.'</td>
                                      
                    ';}
                
        
     echo '     
                </tr>';
				
			
                       
            
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
       
   </script>
    
</body>
</html>