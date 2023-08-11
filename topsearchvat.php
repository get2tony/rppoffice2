<?php
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once(dirname(__FILE__) . '/vatmethods.php');
//$term='';
//$table="current";



$table = isset($_REQUEST['catb']) ? $_REQUEST['catb'] : "vatreg";
$term = isset($_REQUEST['cata']) ? $_REQUEST['cata'] : date('Y');
$showterm="Top Filers";
// $run=0;

// $sqlmain='CREATE TEMPORARY TABLE temp_vatreg(
//     tinno varchar(123) ,
//     coyname varchar(183) ,
//     address varchar(225) ,
//     phone varchar(180) ,
//     month varchar(80) ,
//     yoa varchar(80) ,
//     amount double(80,2) ,
//     capdate varchar(80) ,
//     paydate varchar(80) ,
//     basis varchar(80) ,
//     defaultdays varchar(80) ,
//     remark varchar(123) 
    
// )';

// $query1 = mysqli_query($conn,$sqlmain);
//     //$count1=mysqli_num_rows($query1);
//     if (!$query1) {
//     die ('SQL Error: ' . mysqli_error($conn));
//     }else{

//         $sqlfor=' temp_vatreg(tinno,coyname,address,phone,month,yoa,amount,capdate,paydate,basis,defaultdays,remark)
//         SELECT tinno,coyname,address,phone,month,yoa,IFNULL(amount, 0),capdate,paydate,basis,defaultdays,remark FROM vatreg';

//         $query4 = mysqli_query($conn,$sqlfor);
//     //$count1=mysqli_num_rows($query1);
//         if (!$query4) {
//         die ('SQL Error: ' . mysqli_error($conn));
//         }else{
//             $run=1;
//         }

//     }

if($term==''){
    $table="vatreg";
    
    $term=date('Y');
// $sql="SELECT amount,tinno,coyname,address,phone,month,yoa,capdate,paydate,basis,defaultdays,remark FROM $table WHERE yoa like '".$term."' ORDER BY CAST(amount AS UNSIGNED ) DESC LIMIT 50";
$sql="SELECT DISTINCT * FROM $table WHERE yoa like '".$term."' && amount >1 GROUP BY tinno ORDER BY (amount*1) DESC LIMIT 50";
}else{
    
 $sql="SELECT DISTINCT * FROM $table WHERE yoa like '".$term."' && amount >1 GROUP BY tinno ORDER BY (amount*1) DESC LIMIT 50";
   
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
    <title>Report- <?php echo $showterm ?> From VAT filers Register for <?php echo $term ?> YOA</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
<!--    <link rel="stylesheet" href="css3/style4.css">-->
    
    
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
     
     
     
    
                      
   
</head>
<body>
   <div class="container-fluid">
   <div class="row-fluid col-md-12">
   <div id="verify">
    <form name="search" action="topsearchvat "  method="post">
       
                
                    <label for="">Search by YOA:</label>
                   <input name="cata" value="<?php echo $term ?>" />
                       
                       
                   
              
               &nbsp;&nbsp;
                    <label for="coyname">VAT  Register:</label>
                    <select name=catb>
                      
                       <option value="vatreg">VAT Register</option>
                       
                                              
                   </select>
              

                
                        &nbsp;&nbsp;&nbsp;
                        
                        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search </button>&nbsp;&nbsp;&nbsp;
                <font  class="pull-center" color="red"><?php echo $count ?> Record(s) Found of <?php echo $showterm ?> in <?php echo $term ?> YOA </font>
                </form>
       </div>
       </div>
                <hr>
                <div class="row-fluid col-md-12">
                <table id="example" class="display" width="100%" cellspacing="0" >
        <thead>
            <tr>
              
                <th>Tin</th>
                <th>Company</th>
                <th>Address</th>
                <th>Phone</th>
                <th>NOB</th>
                <th>Total Value Filed</th>
                <th>No.of Returns Filed</th>
                <th>Basis</th>
                
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
        
        while ($row = mysqli_fetch_array($query))
        {

             $amt=(float)$row["amount"];
                if($amt=="") {
                    $amt="Not Filed";
                }
            if (preg_match('#[0-9]#',$amt)) {
             $amt= number_format($amt,2);   # code...
            }
            if (preg_match('#[0-9]#',$amt) && $amt==0) {
               $amt='NIL' ;# code...;
            }


            echo '<tr>

                
                 
                    <td>'.$row['tinno'].'</td>
                    <td>'.$row['coyname'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td>'.$row['remark'].'</td>
                    <td>'.number_format(topvatinfo('sumfiled',$row['tinno'],$conn),2).'</td>
                    <td>'.topvatinfo('numfiled',$row['tinno'],$conn).'</td>
                    <td>'.$row['basis'].'</td>
                 
                </tr>';
            
            $no++;
        }?>
            

        </tbody>
    </table>
       
               
               
                
                </div>
                <!--end of second row-->
            
           
           
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
        order: [4,'desc'],
        buttons: [
            'copyHtml5',
            'csvHtml5',
            'excelHtml5', { extend: 'pdfHtml5', orientation: 'landscape',pageSize: 'LEGAL'}
               
        ]
    } );
} );
   </script>
   
  
    
</body>
</html>