<?php
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');


$errormsg = '';
$errormsg2 = '';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;

$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;

$page=$_SERVER['PHP_SELF'];
$trail='lrp';
$ustatus=checkUserstatus2($usersno,$conn);


$table = isset($_REQUEST['catb']) ? $_REQUEST['catb'] : "both_self";
$term = isset($_REQUEST['cata']) ? $_REQUEST['cata'] : date('Y');
$showterm="LRP ".ucfirst(substr(str_replace('_',' ',$table),3));
$tableshow="Late Returns Penalty";


if ($table=='lrpcurrent'){
    $table='lrpcurrent';
    $sql = "SELECT * FROM $table WHERE capdate LIKE '%" . $term . "' && taxtype LIKE 'LRP' ORDER BY sno DESC";
}
if ($table=='lrpback_year'){
    $table='lrpback_year';
    $sql = "SELECT * FROM $table WHERE capdate LIKE '%" . $term . "' && taxtype LIKE 'LRP' ORDER BY sno DESC";
}

if ($table=='both_self') {
    $sqlmain = 'CREATE TEMPORARY TABLE IF NOT EXISTS both_self AS  SELECT * FROM lrpcurrent UNION  SELECT * FROM lrpback_year ';
    $query1 = mysqli_query($conn, $sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query1) {
        die('SQL Error: ' . mysqli_error($conn));
    } else {
        $table = 'both_self';
        $sql = "SELECT * FROM $table WHERE capdate LIKE '%" . $term . "' && taxtype LIKE 'LRP' ORDER BY sno DESC";
    }# code...
}	
 
    $query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}

function gettab($a,$conn){

    $a = explode('/', $a);
    $ISBack=getsettings('slabelb',$conn);
    $b= explode('/',$ISBack);
    if($b[1] === $a[1]) {
        return 'lrpback_year';
    }else{
        return 'lrpcurrent';
    }

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
    <link rel="stylesheet" href="multidel.css">
     
     
     
    
                      
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
    <form name="search" action="lrpasearch "  method="post">
       
                
                    <label for="">Raised In:</label>
                   <input name="cata" value="<?php echo $term ?>" />
                   <input type="hidden" name="sno" value="<?php echo $usersno ?>" />
                   <input type="hidden" name="user" value="<?php echo $suser ?>" />
                       
                       
                  
              
               &nbsp;&nbsp;
                    <label for="coyname">Choose Register:</label>
                    <select name=catb onchange="this.form.submit();">
                       
        <option value="<?php echo $table ?>"><?php 
			
			if($table=='lrpcurrent'){
				echo 'LRP Current';
            }
            if ($table=='lrpback_year') {
                echo 'LRP Back Year';
            }
            if ($table=='both_self') {
                echo 'Both Registers';
            }
            
				
			
			?> </option>
                       <option value="lrpback_year">LRP Back Year</option>
                       <option value="lrpcurrent">LRP Current</option>
                       <option value="both_self">Both Registers</option>
                       
                       
                               
                                              
                   </select>
              

                   
                        &nbsp;&nbsp;&nbsp;
                        
                        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search </button>&nbsp;&nbsp;&nbsp;
                <font  class="pull-center" color="red"><?php echo $count ?> Record(s) Found</font>
                </form>
       </div>
  <?php



        if($ustatus!='user'){
       echo '<div class="">
                 <form id="delform" action="multidel.php" method="POST" onsubmit="return submitClick();">
                <input type="hidden" name="user" value="'.$suser.'" />
                <input type="hidden" name="usersno" value="'.$usersno.'" />
                <input type="hidden" name="page" value="'.$page.'" />
                <input type="hidden" name="trail" value="'.$trail.'" />
                <input type="hidden" name="selected" id="selected" value="">
                <input  type="submit" id="del" class="btn btn-danger" value="Delete">
               </form>
               
        </div>';

        }

    ?>
        <div class="row">
                            <marquee behavior="alternate">
                                <font color="#FF0000"><?php echo $errormsg2 ?></font>
                            </marquee>
                            <marquee behavior="alternate">
                                <font color="green"><?php echo $errormsg ?></font>
                            </marquee>
                        </div>

       </div>
                      
                 
                <hr>
                        
               
                <div class="row-fluid col-md-12">
                
                <table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
               <th>S/No.</th>
                <th><input type="checkbox" onClick="toggle(this)" /><br/></th>
                <th>Tin</th>
                <th>Company</th>
                <th>Address</th>
                <th>YOA</th>
                <th>Date Raised</th>
                <th>Amount</th>
                <th>Year End</th>
                <th>Filing Due Date</th>
                <th>Date Tax Filed</th>
                <th>Default Month(s)</th>
                <th>Assmt No</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {
            $assmtno  = $row['alabel'].$row['asmtno'].$row['ayear'];
            $ssno = $row['sno'];
            $tin=$row['tinno'];
			$coyname=str_replace("&"," %26 ",$row['coyname']);
            $address= str_replace("&"," %26 ",$row['address']);
            $table = gettab($assmtno,$conn);
                     
            
            echo '<tr>

                
                    <td>'.$no.'</td>
                    <td>&nbsp;&nbsp;<input type="checkbox" id="list" name="list" value='.$ssno.'/'.$table.'/'.$tin.'></td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.urldecode($row['coyname']).'</td>
                    <td>'.urldecode($row['address']).'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['capdate'].'</td>
                    <td>'.$row['amount'].'</td>
                    <td>'.$row['yearend'].'</td>
                    <td>'.$row['duedate'].'</td>
                    <td>'.$row['datefiled'].'</td>
                <td>'.$row['DefaultMonth'].'</td>
                     <td>'.$assmtno.'</td>
                    <td>
                       ';
                    
                 if($ustatus!='user'){
        
                    echo '
                    <form action="asmtlrp" method="post" target="_blank">
                        
               <input type="hidden" value="'.$row['tinno'].'"  id="data1" name="data1"/>
               <input type="hidden" value="'.$coyname.'"  id="data2" name="data2"/>
               <input type="hidden" value="'.$address.'"  id="data3" name="data3"/>
               <input type="hidden" value="'.$row['yoa'].'"  id="data4" name="data4"/>
               <input type="hidden" value="'.$row['capdate'].'"  id="data5" name="data5"/>
               <input type="hidden" value="'.$row['amount'].'"  id="data6" name="data6"/>
               <input type="hidden" value="'.$row['basis'].'"  id="data7" name="data7"/>
               <input type="hidden" value="'.$row['taxtype'].'"  id="data8" name="data8"/>
               <input type="hidden" value="'.$assmtno.'"  id="data9" name="data9"/>
                    <button  id="foo" type="Submit" class ="btn btn-primary" data-toggle="tooltip" title="View Record! ">
                        <span class="glyphicon glyphicon-print" alt="View Records"></span></button>
                    
                    <a data-toggle="tooltip" title="Edit Record!"target="dframe" href="editlrp?user='.$suser.'&usersno='.$usersno.'&tin='.$row['tinno'].'&yrend='.$row['yearend'].'&tab='.$table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-edit" alt="edit Records"></span></a>
                        <a  data-toggle="tooltip" title="Delete Record!"target="dframe" href="deletelrp?user='.$suser.'&usersno='.$usersno.'&tin='.$row['tinno'].'&yrend='.$row['yearend'].'&tab='. $table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-trash" alt="Delete Records"></span></a> </form>';
                 
                    }else {
                   echo'  <form action="asmtlrp" method="post" target="_blank">
                        
               <input type="hidden" value="'.$row['tinno'].'"  id="data1" name="data1"/>
               <input type="hidden" value="'.$coyname.'"  id="data2" name="data2"/>
               <input type="hidden" value="'.$address.'"  id="data3" name="data3"/>
               <input type="hidden" value="'.$row['yoa'].'"  id="data4" name="data4"/>
               <input type="hidden" value="'.$row['capdate'].'"  id="data5" name="data5"/>
               <input type="hidden" value="'.$row['amount'].'"  id="data6" name="data6"/>
               <input type="hidden" value="'.$row['basis'].'"  id="data7" name="data7"/>
               <input type="hidden" value="'.$row['taxtype'].'"  id="data8" name="data8"/>
               <input type="hidden" value="'.$assmtno.'"  id="data9" name="data9"/>
                    <button  type="Submit" class ="btn btn-primary" data-toggle="tooltip" title="View Record! ">
                        <span class="glyphicon glyphicon-print" alt="View Records"></span> View</button>
                        
                        </form>';
                 }   
                   
                    
                    
                echo'    
                        </td>
                </tr>';
            
            $no++;
        }?>
            

        </tbody>
    </table>
  
   
<script src="js/jquery-1.12.4.js"></script>
<script src="multidel.js"></script>
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
   
 <?php
   
 

 ?>
    
</body>
</html>