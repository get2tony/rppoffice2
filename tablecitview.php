<?php 

include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
// $tab = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
// $ddate=date('Y');
$phone='';
$userstatus=checkUserstatus2($usersno,$conn);


    // $sql="SELECT DISTINCT * FROM  back_year GROUP BY tinno ORDER BY coyname ASC ";
    //  $sql="SELECT current.tinno, back_year.tinno, current.coyname,back_year.coyname,current.address,back_year.address
    //         FROM current
    //        INNER JOIN back_year ON current.tinno=back_year.tinno";

    // $sql='SELECT current.tinno, back_year.tinno, current.coyname,back_year.coyname,current.address,back_year.address
    //         FROM current OUTER JOIN back_year ON current.tinno=back_year.tinno ORDER BY current.coyname';
       
    // $sql='SELECT tinno,coyname,address,phone FROM current GROUP BY tinno
    //         UNION DISTINCT
    //         SELECT tinno,coyname,address,phone FROM back_year GROUP BY tinno ORDER BY phone DESC';
$sqlmain='CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT tinno,coyname,address,phone,remark FROM current UNION  SELECT tinno,coyname,address,phone,remark FROM back_year ';   
    $query1 = mysqli_query($conn,$sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query1) {
    die ('SQL Error: ' . mysqli_error($conn));
    }else{

    $sql='SELECT DISTINCT * FROM temp_self GROUP BY tinno ORDER BY phone DESC';

    }

//  $table="adminasreg";
$query = mysqli_query($conn,$sql);
$count=mysqli_num_rows($query);
if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}


$amt='';
$amt2='';
$showlabel='<div class="text-center"><h3>CIT FILERS CONTACT INFO</h3></div>';

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RPP Office CIT Filers Register </title>
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
    <div class="col-lg-4"></div>

   </div>
    <table id="example" class="display table" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S/No.</th>
                <th>Tin</th>
                <th>Company</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>NOB</th>
               
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
          
            $tinno=$row['tinno'];
           
            $coyname=strtoupper($row['coyname']);
            $address=strtoupper($row['address']);
            $nob=strtoupper($row['remark']);
            $phone=$row['phone'];
            if(!$phone || $phone==''){
                $phone='Not Available';
            }


            echo '<tr>
                    <td>'.$no.'</td>
                    <td>'.$tinno.'</td>
                    <td>'.$coyname.'</td>
                    <td>'.$address.'</td>
                    <td>'.$phone.'</td>
                    <td>'.$nob.'</td>
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