<?php 


include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');


$search=$_GET['tin'];
$table=$_GET['tab'];
$serial=$_GET['sno'];
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$usersno=isset($_REQUEST['usersno']) ? $_REQUEST['usersno'] : null;
$ustatus = isset($_REQUEST['status']) ? $_REQUEST['status'] : null;

$sql = "SELECT * FROM $table where `sno`='$serial'&&`tinno`='$search'";
        
$query = mysqli_query($conn, $sql);

if (!$query) {
    
    die ('SQL Error: here' . mysqli_error($conn));
    
}
$sno="";
$coytin="";
$coyname="";
$coyadd="";
$assyr="";
$datecap="";
$taxtype="";
$amount="";
$assno="";
$basis="";
$fuser="";

while ($row = mysqli_fetch_array($query))
        {
$sno=$row[0];
$coytin=$row[1];
$coyname=$row[2];
$coyadd=$row[3];
$assyr=$row[4];
$datecap=$row[5];
$taxtype=$row[6];
$amount=$row[7];
$assno=$row[8];
$basis=$row[9];
$fuser=$row[12];
    
}
  
    
    
    
    

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Returns Details</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
    
                     
   
</head>
<body>
   <div id="showArea" class="container-fluid">
          <div id ="printableArea"> 
          <form name="deleteform2" action="dodeleteass2 " method="post">
            <div id="verify">
              <div class="row-fluid col-md-4">
                <div class="form-group">
                    <label for="asno">Assessment No:</label>
                    <input type="text" class="form-control" id="coytin" name="asno" placeholder="Asmt No"  value="<?php  echo $assno ?> " disabled/>
                </div>
                   
                   <div class="form-group">
                    <label for="coytin">Company Tin:</label>
                    <input type="text" class="form-control" id="coytin" name="coytin" placeholder="Tin here" value="<?php echo $coytin ?>" disabled/>
                </div>
                <div class="form-group">
                    <label for="coyname">Company Name:</label>
                    <input type="text" class="form-control" id="coyname"  name="coyname" placeholder="Taxpayer's Name" value="<?php echo $coyname ?>" disabled/>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea  name="address" class="form-control" id="address" placeholder="Taxpayer's Address" disabled><?php echo $coyadd ?></textarea>
                </div>
                                
                    <div class="form-group">
                    <label for="YOA">Year of Assessment:</label>
                    <input type="text" name="yoa" class="form-control" id="yoa" placeholder="Year of Assessment" value="<?php   echo $assyr;?>" disabled/>
                    </div>
                    
                      
                    
                    
                    
                    </div>


               
        
               
                <!--second row-->
                <div class="row-fluid col-md-4">
                    <div class="form-group">
                    <label for="capture">Date  Raised:</label>
                    <select name="capture" id="capture" disabled>
                        <option><?php   echo $datecap;?></option>
                                                
                    </select>
                       </div>
                    <p></p>
                    <div class="form-group">
                    <label for="taxtype">Tax Type:</label>
                    <select name="ttype" id="" disabled>
                        <option ><?php echo $taxtype ?></option>         
                    </select>
                    </div>
                   
                <div class="form-group">
                    <label for="amnt">Amount:</label>
                    <input type="text" class="form-control" name="amount" placeholder="Amount Raised" value="<?php echo $amount;?>" disabled/>
                    </div>
                    
                     <div class="form-group">
                    <label for="cittxt">Basis of Assessment:</label>
                    <select name="basis" id="" disabled>
                        <option ><?php echo $basis ?></option>
                                        
                    </select>
                    </div>
                    
    
                         <div class="row-fluid col-md-4">
                     <p></p>
                     <p></p>
                  </div>    
    
                </div>
                
                 </div>
                
             
                <div class="row-fluid col-md-4">
                <a target="dframe" href="tableapp?sno=<?php echo $usersno ?>&user=<?php echo $suser ?>&status=<?php echo $ustatus ?>" class="btn btn-default"> Go Back</a>
                
                
     
                <input type="button" class="btn btn-danger"  onclick="myAlert();"value= "Delete" />
                
                <p></p>

                
                </div>
                 <input type="hidden" name="sno" value="<?php echo $sno ?> " />
                 <input type="hidden" name="tin" value="<?php echo $coytin ?> " />
                 <input type="hidden" name="table" value="<?php echo $table ?>"
                  />
                  <input type="hidden" name="user" value="<?php echo $suser ?>" />
                  <input type="hidden" name="usersno" value="<?php echo $usersno ?>" />
                  <input type="hidden" name="status" value="<?php echo $ustatus ?>" />
                  </form>      
                
                    
             
                   
               
       </div>
            
                            
           
   </div>
    
   <script src="js3/jquery-1.12.4.js">
   </script>
   <script>
        function myAlert() {
            var conf= confirm("Do you really want to delete?");
    if (conf== true){
       document.deleteform2.action = "dodeleteass2 ";
       document.deleteform2.submit();
    }else{
      return;
    }
        }
        </script>
   
  
  
    
</body>
</html>
       
    

 

