<?php
include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');

session_start();
if( !isset($_SESSION["username"]) ){
    header("location:logout");
    exit();
}

$user = isset($_REQUEST['user']) ? $_REQUEST['user'] : $_SESSION["username"];
$pw='223344';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application - Settings</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
     <link rel="stylesheet" href="css3/style4.css">
      <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
   
      <div class="panel "><H2>Advance Settings</H2></div>
       <div class="container">
             <div class="row">
             <div class="col-xs-3"><img src="img/icons8-gears-480.gif" alt="settings" width="128px" height="128px"></div>
             <div class="col-xs-3"><img src="img/001-file-1.png" alt="settings" width="128px" height="128px"></div>
             <div class="col-xs-3"><img src="img/icons8-save-archive-96.png" alt="backup" width="128px" height="128px"></div>
             <div class="col-xs-3"><img src="img/icons8-database-restore-64.png" alt="backup" width="128px" height="128px"></div>
             
        
             
           </div>
           
           <div class="row">
               <p></p>
<div class="col-xs-3"><a  class="btn btn-primary" href="setoffice?user=<?php echo $user ?>">Set FIRS Office Details</a></div>
<div class="col-xs-3"><a  class="btn btn-primary" href="audittrail?user=<?php echo $user ?>">Check Records Deleted</a></div>
               
<div class="col-xs-3"><a  class="btn btn-success" href="dobackup2">Click  to Backup Database</a></div>
<div class="col-xs-3">

<form enctype="multipart/form-data" action="" name="upform" method="POST" id="up">
    
    Choose a file to upload: <input name="fileToUpload" type="file" /><br />
    <input type="submit" id="upbut" name="submit" class="btn btn-danger" value="Upload File" />
    
    </form>
<!-- <form method="post" name="myForm" action="getfile.php" enctype="multipart/form-data">
 <div>
   <label for="file">Choose Database backup  to Restore</label>
   <input type="file" name="uploadedfile">
   <input type="hidden" name="MAX_FILE_SIZE" value="25000" />
 </div>
 <br>
 <div>
   <input class="btn btn-primary" type="Submit" value="Upload To Database">
 </div>
</form> -->
       
</div>
        
           </div>
            <hr>
           <div>
            
               
           </div>
        </div> 
        
 <script>
var exitBtn = document.getElementById("upbut");
exitBtn.addEventListener("click",password);

function password() {
    var realPW = "<?php echo $pw ?>";
    var pword = prompt("Please enter the passcode:");
    if (realPW == pword) {
      document.upform.action ="getfile";
       document.upform.submit();
    }else{
      return;
    }
}
</script>
</body>
</html>