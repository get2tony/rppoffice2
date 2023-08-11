<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');


$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;


$errormsg = '';
$errormsg2 = '';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$userstatus=checkUserstatus2($usersno,$conn);
$pagem=$_SERVER['PHP_SELF'];
$trail='gov';


$showlabel='<div class="text-center"><h3>GOVERNMENT ASSESSMENT REGISTER</h3></div>';

$table = 'adminasreg';   
$sql="SELECT * FROM adminasreg WHERE `approval`  LIKE 'approved' || `approval` IS NULL ORDER BY sno DESC";


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
    <title>Search Govt Asmt Register</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
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
 <?php echo $showlabel;?>
   <div class="container-fluid">
   <div class="row-fluid col-md-12">
   <div id="verify">
     <div id="showcount" class="text-center"><font   color="red" ><?php echo $count ?> Record(s) Found</font></div><br>
   <div class="row main">
   <?php



if($userstatus!='user'){
echo '<div class="">
         <form id="delform" action="multidel.php" method="POST" onsubmit="return submitClick();">
        <input type="hidden" name="user" value="'.$suser.'" />
        <input type="hidden" name="usersno" value="'.$usersno.'" />
        <input type="hidden" name="page" value="'.$pagem.'" />
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

    <div class="col-lg-4"></div>
    <div class="col-lg-4"> <div class="form-group has-feedback has-search">
    <span class="glyphicon glyphicon-search form-control-feedback"></span>
    <input  id="searchbox" type="text" class="form-control" placeholder="Search">
  </div></div>    
                <div class="row-fluid col-md-12">
                <table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S/No.</th>
                <th><input type="checkbox" onClick="toggle(this)" /><br/></th>
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
            $ssno = $row['sno'];
            $tin=$row['tinno'];
            
			
	    if($userstatus=='user'){
				 echo '<tr>

                    <td>'.$no.'</td>
                    <td>&nbsp;&nbsp;<input type="checkbox" id="list" name="list" value='.$ssno.'/'.$table.'/'.$tin.'></td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$coyname2.'</td>
                    <td>'.$address2.'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['taxtype'].'</td>
                    <td>'.number_format(str_replace(",","",$row['amount']),2).'</td>
                    <td>'.$row['asmtno'].'</td>
                    <td>'.$row['basis'].'</td>
                    <td>'.$row['capdate'].'</td>
                    <td>'.$row['user'].'</td>
                    
                    <td><a class="btn btn-primary" data-toggle="tooltip" title="View Record!"target="_blank" href="'.$page.'?data1='.$row['tinno'].'&data2='.$coyname.'&data3='.$address.'&data4='.$row['yoa'].'&data5='.$row['capdate'].'&data6='.$row['amount'].'&data7='.$row['basis'].'&data8='.$row['taxtype'].'&data9='.$row['asmtno'].'&data10='.$row['startdate'].'&data11='.$row['enddate'].'&data12='.$row['amtpaid'].'&data13='.$row['assprofit'].'&data14='.$row['tprofit'].'&data15='.$row['penalty'].'&data16='.$row['user'].'&data17='.$row['appby'].'&data18='.$row['inputvat'].'&data19='.$row['vatamt'].'&data20='.$row['sno'].'">Print</a>
                    </td>
                    
                </tr>';
            
		}else{
				
				 echo '<tr>

                   <td>'.$no.'</td>
                   <td>&nbsp;&nbsp;<input type="checkbox" id="list" name="list" value='.$ssno.'/'.$table.'/'.$tin.'></td>
                    <td>'.$row['tinno'].'</td>
                    <td>'.$coyname2.'</td>
                    <td>'.$address2.'</td>
                    <td>'.$row['yoa'].'</td>
                    <td>'.$row['taxtype'].'</td>
                  
                    <td>'.number_format(str_replace(",","",$row['amount']),2).'</td>
                    <td>'.$row['asmtno'].'</td>
                    <td>'.$row['basis'].'</td>
                    <td>'.$row['capdate'].'</td>
                    <td>'.$row['user'].'</td>
                     
                    <td>
                    
                   
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
                    <a data-toggle="tooltip" title="Edit Record!"target="dframe" href="'.$editpage.'?tin='.$row['tinno'].'&tab='.$table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-edit" alt="edit Records"></span></a>
                     <a  data-toggle="tooltip" title="Delete Record!"target="dframe" href="deleteass?tin='.$row['tinno'].'&tab='.$table.'&sno='.$row['sno'].'"><span class="glyphicon glyphicon-trash" alt="Delete Records"></span></a>
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
            
           
           
   </div>
   
   
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