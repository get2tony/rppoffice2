<?php


include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
$term="all";
$table="adminasreg";

$table = isset($_REQUEST['catb']) ? $_REQUEST['catb'] : null;
$term = isset($_REQUEST['cata']) ? $_REQUEST['cata'] : 'all';

$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;

$userstatus=checkUserstatus2($usersno,$conn);

if ($term==""){
    
    $showterm="All Taxpayers";

$table="adminasreg";
$tableshow="Additional/ Admin";
    
$sql="SELECT * FROM $table WHERE capdate LIKE '%".date('Y')."%' ORDER BY asmtno ASC";
}
if ($term=="all"){
    $table="adminasreg";
    $showterm="All Taxpayers";
    $tableshow="Additional/ Admin";


$sql="SELECT * FROM $table WHERE capdate LIKE '%".date('Y')."%' && `approval` LIKE 'approved' ORDER BY asmtno ASC";
}
 if($term=="cit"){ 
      $showterm="CIT Raised";
$sql="SELECT * FROM `$table` WHERE `taxtype` like 'CIT' && `approval` LIKE 'approved' && capdate like '%".date('Y')."' ORDER BY asmtno ASC";
 }
if($term=="edt"){ 
      $showterm="EDT Raised";
$sql="SELECT * FROM `$table` WHERE `taxtype` like 'EDT' && `approval` LIKE 'approved' && capdate like '%".date('Y')."' ORDER BY asmtno ASC";
 }

if($term=="vat"){ 
      $showterm="VAT Raised";
$sql="SELECT * FROM `$table` WHERE `taxtype` like 'VAT' && `approval` LIKE 'approved' && capdate like '%".date('Y')."' ORDER BY asmtno ASC";
 }
if($term=="wht"){ 
      $showterm="WHT Raised";
$sql="SELECT * FROM `$table` WHERE `taxtype` like 'WHT' && `approval` LIKE 'approved' && capdate like '%".date('Y')."' ORDER BY asmtno ASC";
 }

if($term=="pol"){ 
      $showterm="POL Raised";
$sql="SELECT * FROM `$table` WHERE `taxtype` like 'POL' && `approval` LIKE 'approved' && capdate like '%".date('Y')."'";
 }
if($term=="boj"){ 
      $showterm="BOJ Raised";
$sql="SELECT * FROM `$table` WHERE `basis` like 'BOJ' && `approval` LIKE 'approved' && capdate like '%".date('Y')."' ";
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
    <meta charset="UTF-8">
    <title>Report- <?php echo $showterm ?> From <?php echo $tableshow ?> Register</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
<!--    <link rel="stylesheet" href="css3/style4.css">-->
    
    
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
     
     
     
    
  <style>
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
   <div class="container-fluid">
   <div class="row-fluid col-md-12">
   <div id="verify">
    <form name="search" action="govsasearch "  method="post">
       
                
                    <label for="">Search by Tax type :</label>
                   <select name=cata onchange="this.form.submit();">
                   <?php 
                        if ($term!='all') {
                            echo '<option value="'.$term.'">'.strtoupper($term).'</option>';
                        }else {
                            echo '<option value="all">All Taxpayers</option>';
                        }
                        
                        
                        ?>
                       
                       <option value="cit">CIT</option>
                       <option value="edt">EDT</option>
                       <option value="vat">VAT</option>
                       <option value="pol">POL</option>
                       <option value="boj">BOJ</option>
                       <option value="wht">WHT</option>
                       <option value="all">All Taxpayers</option>
                       
                   </select>
              
               &nbsp;&nbsp;
                    <label for="coyname">Register:</label>
                    <select name=catb onchange="this.form.submit();">
                       <option value="adminasreg">Gov't Asmt Register</option>
                       
                                              
                   </select>
               <input type="hidden" name="sno" value="<?php echo $usersno ?>">

                
                        &nbsp;&nbsp;&nbsp;
                        
                        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search </button>&nbsp;&nbsp;&nbsp;
                <font  class="pull-center" color="red"><?php echo $count ?> Record(s) Found</font>
                </form>
       </div>
       </div>
                <hr>
                <div class="row-fluid col-md-12">
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
             $assmtno  = $row['asmtno'];
			$coyname=str_replace("&","%26",$row['coyname']);
            $address= str_replace("&","%26",$row['address']);
			$coyname2=$row['coyname'];
            $address2= $row['address'];

            
			$taxtype=$row['taxtype'];
			$page='viewass';
			$editpage='editass';
			if($taxtype=='VAT'){
				$page='viewvatass';
				$editpage='editvatass';
			}
			
           if($userstatus=='user'){
				 echo '<tr>

                
                   <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$coyname2.'</td>
                    <td>'.$address2.'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['taxtype'].'</td>
                  
                    <td>'.number_format(str_replace(",","",$row['amount']),2).'</td>
                    <td>'.$row['asmtno'].'</td>
                    <td>'.$row['basis'].'</td>
                    <td>'.$row['capdate'].'</td>
                    
                    <td><a class="btn btn-primary" data-toggle="tooltip" title="View Record!"target="_blank" href="'.$page.'?data1='.$row['tinno'].'&data2='.$coyname.'&data3='.$address.'&data4='.$row['yoa'].'&data5='.$row['capdate'].'&data6='.$row['amount'].'&data7='.$row['basis'].'&data8='.$row['taxtype'].'&data9='.$row['asmtno'].'&data10='.$row['startdate'].'&data11='.$row['enddate'].'&data12='.$row['amtpaid'].'&data13='.$row['assprofit'].'&data14='.$row['tprofit'].'&data15='.$row['penalty'].'&data16='.$row['user'].'&data17='.$row['appby'].'&data18='.$row['inputvat'].'&data19='.$row['vatamt'].'&data20='.$row['sno'].'">Print</a>
                    </td>
                    
                </tr>';
            
			}else{
				
				 echo '<tr>

                
                   <td>'.$no.'</td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$coyname2.'</td>
                    <td>'.$address2.'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['taxtype'].'</td>
                  
                    <td>'.number_format(str_replace(",","",$row['amount']),2).'</td>
                    <td>'.$row['asmtno'].'</td>
                    <td>'.$row['basis'].'</td>
                    <td>'.$row['capdate'].'</td>
                    
                    <td >
                    
                    <form action="'.$page.' " id="fo" method="post" target="_blank">
                        
               <input type="hidden" value="'.$row['tinno'].'"  id="data1" name="data1"/>
               <input type="hidden" value="'.$coyname2.'"  id="data2" name="data2"/>
               <input type="hidden" value="'.$address2.'"  id="data3" name="data3"/>
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
                         
                    
                    
                    
                 
                    <a data-toggle="tooltip" title="Edit Record!"target="dframe" href="'.$editpage.'?tin='.$row['tinno'].'&tab='.$table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-edit" alt="edit Records"></span></a>
                    <a data-toggle="tooltip" title="Delete Record!"target="dframe" href="deleteass?tin='.$row['tinno'].'&tab='.$table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-trash" alt="Delete Records"></span></a>
					   </form>
					   </td>
                </tr>';
            
				
				
				
			}
           
            $no++;
        }?>
            
            

        </tbody>
    </table>
       
               
               
                
                </div>
                <!--end of second row-->
            
           
           <!-- //<a data-toggle="tooltip" title="View Record!" href="javascript:{}" onclick="document.getElementById(\'fo\').submit();"><span class="glyphicon glyphicon-print" alt="view Records"></span></a> -->
   </div>
   
   
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>
   
   
    <!--the button initialization-->
    <script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
                
            }
        ]
    } );
} );
   </script>
   
  
    
</body>
</html>