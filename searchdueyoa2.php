<?php


include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');

//  $term='30 June';
//
//$table="current";




$term = isset($_REQUEST['cata']) ? $_REQUEST['cata'] : "30 June";
$showterm="Taxpayers";

$sqlmain='CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT * FROM current UNION  SELECT * FROM back_year ';   
    $query1 = mysqli_query($conn,$sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query1) {
    die ('SQL Error: ' . mysqli_error($conn));
    }else{

    $sql="SELECT DISTINCT * FROM temp_self WHERE duedate like '%".$term."%' GROUP BY tinno ORDER BY STR_TO_DATE(capdate,'%d/%m/%Y') DESC";

    }



// $sql="SELECT DISTINCT * FROM  current  WHERE duedate like '".$term."' GROUP BY tinno ORDER BY STR_TO_DATE(capdate,'d/m/Y') DESC";

// $sql="SELECT DISTINCT * FROM current AS c WHERE c.duedate like '%".$term."%' GROUP BY c.tinno
//  UNION 
// SELECT DISTINCT * FROM back_year AS b WHERE b.duedate like '%".$term."%' GROUP BY b.tinno ORDER BY capdate ASC";
//  $sql="SELECT * FROM current WHERE duedate like '".$term."' GROUP BY tinno HAVING (COUNT(tinno)=1)ORDER BY capdate ASC";
//SELECT email
//FROM users
//GROUP BY email
//HAVING ( COUNT(email) = 1 )
//select * from customers where customer_id in (select distinct(customer_id) from orders);
//select s.name "Student", c.name "Course"
//from student s, bridge b, course c
//where b.sid = s.sid and b.cid = c.cid 




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
    <title>Report- <?php echo $showterm ?> with <?php echo $term ?> Due Date of Filing</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
<!--    <link rel="stylesheet" href="css3/style4.css">-->
    
    
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
     
     
     
    
                      
   
</head>
<body>
   <div class="container-fluid">
   <div class="row-fluid col-md-12">
   <div id="verify">
    <form name="search" action="searchdueyoa2 "  method="post">
       
                
                    <label for="">Search by Due date:</label>
                 <select name="cata" id="cata" onchange="this.form.submit();">
                       <option value="<?php echo $term; ?>"><?php echo $term; ?></option>
                        <option>31 January</option>
                        <option>28 February </option>
                        <option>31 March </option>
                        <option>30 April </option>
                        <option>31 May </option>
                        <option>30 June </option>
                        <option>31 July </option>
                        <option>31 August </option>
                        <option>30 September </option>
                        <option>31 October </option>
                        <option>30 November </option>
                        <option>31 December</option>
                    </select> 
                   
              
               &nbsp;&nbsp;
<!--
                    <label for="coyname">Select Register:</label>
                    <select name=catb>
                      
                       <option value="Register</option>
                       <option value="current">Current Register</option>
                       <option value="back_year">Back Year Register</option>
                                              
                   </select>
-->
              

                
                        &nbsp;&nbsp;&nbsp;
                        
                        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>&nbsp;Search </button>&nbsp;&nbsp;&nbsp;
                <font  class="pull-center" color="red"><?php echo $count ?> Record(s) Found of <?php echo $showterm ?> with <?php echo $term ?> Due Date of Filing </font>
                </form>
       </div>
       </div>
                <hr>
                <div class="row-fluid col-md-12">
                <table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S/No</th>
                <th>Tin</th>
                <th>Company</th>
                <th>Address</th>
                <th>Year End</th>
                <th>Due Date</th>
               
               
                
            </tr>
        </thead>
        <tbody>
<?php 

        $no     = 1;
         
        while ($row = mysqli_fetch_array($query))
        {
           
            echo '<tr>

                
                    <td>'.$no.'</td>
                    <td>'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                     <td>'.$row[4].'</td>
                     <td>'.$row[5].'</td>
                    
                    
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