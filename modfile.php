<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');
// include_once('vatmethods.php');
//$term="all";
//$table="adminasreg";


$table = isset($_REQUEST['table']) ? $_REQUEST['table'] : null;
//$term = isset($_REQUEST['cata']) ? $_REQUEST['cata'] : 'all';
$soffice=getSettings('soname',$conn);
$tc=getSettings('tcname',$conn);
$appdate=date('d/m/Y');
$errormsg = null;
$errormsg2 = null;
$errormsg3 = null;
$errormsg4 = null;
$errormsg5 = null;
$errormsg6 = null;
$errormsg7 = null;
$errormsg8 = null;
$errormsg9 = null;
$errormsg10 = null;
$errormsg11 = null;
$errormsg12 = null;
$errormsg13 = null;
$errormsg14 = null;
$errormsg15 = null;
$errormsg16 = null;
$errormsg17 = null;
$errormsg18 = null;


if ($table=="settings") {
    $sql="SELECT whtrate FROM $table";
                if (!mysqli_query($conn,$sql)) {
                 //die ('SQL Error: ' . mysqli_error($conn));
                    $query=mysqli_query($conn,"ALTER TABLE $table
                    ADD whtrate VARCHAR(10) DEFAULT '10' AFTER modifiedby,
                    ADD lrpint VARCHAR(10) DEFAULT '25000' AFTER whtrate,
                    ADD lrpsub VARCHAR(10) DEFAULT '5000' AFTER lrpint,
                    ADD lspint VARCHAR(10) DEFAULT '5000' AFTER lrpsub,
                    ADD lspsub VARCHAR(10) DEFAULT '5000' AFTER lspint");
            if($query){
                $errormsg2="Settings has been altered successfully!";
            }else{
                $errormsg="Ooops!! Something went wrong!!".mysqli_error($conn);
            }
     }else{

        $errormsg="Its been altered Already!";
     }
}
if ($table=="current") {
    $sql="SELECT taxoffice FROM $table";
                if (!mysqli_query($conn,$sql)) {
                 //die ('SQL Error: ' . mysqli_error($conn));
                    $query=mysqli_query($conn,"ALTER TABLE current
                    ADD taxoffice VARCHAR(30) DEFAULT '$soffice'");
            if($query){
                $errormsg4="Table altered successfully!";
            }else{
                $errormsg3="Ooops!! Something went wrong!!";
            }
     }else{

        $errormsg3="Its been altered Already!";
     }
}


if ($table=="back_year") {
    $sql="SELECT taxoffice FROM $table";
                if (!mysqli_query($conn,$sql)) {
                 //die ('SQL Error: ' . mysqli_error($conn));
                    $query=mysqli_query($conn,"ALTER TABLE back_year
                    ADD taxoffice VARCHAR(30) DEFAULT '$soffice'");
            if($query){
                $errormsg6="Table altered successfully!";
            }else{
                $errormsg5="Ooops!! Something went wrong!!";
            }
     }else{

        $errormsg5="Its been altered Already!";
     }
}
if ($table=="rppusers") {
    $sql="SELECT taxoffice FROM $table";
                if (!mysqli_query($conn,$sql)) {
                 //die ('SQL Error: ' . mysqli_error($conn));
                    $query=mysqli_query($conn,"ALTER TABLE rppusers
                    ADD taxoffice VARCHAR(30) DEFAULT '$soffice'");
            if($query){
                $errormsg8="Table altered successfully!";
            }else{
                $errormsg7="Ooops!! Something went wrong!!";
            }
     }else{

        $errormsg7="Its been altered Already!";
     }
}
if ($table=="lrpcurrent") {
    $sql="SELECT taxoffice FROM $table";
                if (!mysqli_query($conn,$sql)) {
                 //die ('SQL Error: ' . mysqli_error($conn));
                    $query=mysqli_query($conn,"ALTER TABLE lrpcurrent
                    ADD taxoffice VARCHAR(30) DEFAULT '$soffice'");
            if($query){
                $errormsg10="Table altered successfully!";
            }else{
                $errormsg9="Ooops!! Something went wrong!!";
            }
     }else{

        $errormsg9="Its been altered Already!";
     }
}
if ($table=="lrpback_year") {
    $sql="SELECT taxoffice FROM $table";
                if (!mysqli_query($conn,$sql)) {
                 //die ('SQL Error: ' . mysqli_error($conn));
                    $query=mysqli_query($conn,"ALTER TABLE lrpback_year
                    ADD taxoffice VARCHAR(30) DEFAULT '$soffice'");
            if($query){
                $errormsg12="Table altered successfully!";
            }else{
                $errormsg11="Ooops!! Something went wrong!!";
            }
     }else{

        $errormsg11="Its been altered Already!";
     }
}
if ($table=="vatstuff") {
    $sql1="SELECT taxoffice FROM vatreg";
    $sql2="SELECT taxoffice FROM vatlist";
    $sql3="SELECT taxoffice FROM adminasreg";
                if (!mysqli_query($conn,$sql1)) {
                 //die ('SQL Error: ' . mysqli_error($conn));
                    $query1=mysqli_query($conn,"ALTER TABLE vatreg
                    ADD taxoffice VARCHAR(30) DEFAULT '$soffice'");
                    if($query1){
                    $errormsg14="Table altered successfully!";
                    }else{
                    $errormsg13="Ooops!! Something went wrong!!";
                    }
                }else{

                $errormsg13="Its been altered Already!";
                }
                if (!mysqli_query($conn,$sql2)) {
                 //die ('SQL Error: ' . mysqli_error($conn));
                    $query2=mysqli_query($conn,"ALTER TABLE vatlist
                    ADD taxoffice VARCHAR(30) DEFAULT '$soffice'");
                    if($query2){
                    $errormsg14="Table altered successfully!";
                    }else{
                    $errormsg13="Ooops!! Something went wrong!!";
                    }
                }else{

                $errormsg13="Its been altered Already!";
                }
                if (!mysqli_query($conn,$sql3)) {
                 //die ('SQL Error: ' . mysqli_error($conn));
                    $query3=mysqli_query($conn,"ALTER TABLE adminasreg
                    ADD taxoffice VARCHAR(30) DEFAULT '$soffice'");
                    if($query3){
                    $errormsg14="Table altered successfully!";
                    }else{
                    $errormsg13="Ooops!! Something went wrong!!";
                    }
                }else{

                $errormsg13="Its been altered Already!";
                }
}
if ($table=="deletes") {
    $sql1="SELECT taxoffice FROM selfdelete";
    $sql2="SELECT taxoffice FROM assdelete";
    $sql3="SELECT taxoffice FROM lrpdelete";
                if (!mysqli_query($conn,$sql1)) {
                 //die ('SQL Error: ' . mysqli_error($conn));
                    $query1=mysqli_query($conn,"ALTER TABLE selfdelete
                    ADD taxoffice VARCHAR(30) DEFAULT '$soffice'");
                    if($query1){
                    $errormsg16="Table altered successfully!";
                    }else{
                    $errormsg15="Ooops!! Something went wrong!!";
                    }
                }else{

                $errormsg15="Its been altered Already!";
                }
                if (!mysqli_query($conn,$sql2)) {
                 //die ('SQL Error: ' . mysqli_error($conn));
                    $query2=mysqli_query($conn,"ALTER TABLE assdelete
                    ADD taxoffice VARCHAR(30) DEFAULT '$soffice'");
                    if($query2){
                    $errormsg16="Table altered successfully!";
                    }else{
                    $errormsg15="Ooops!! Something went wrong!!";
                    }
                }else{

                $errormsg15="Its been altered Already!";
                }

                 if (!mysqli_query($conn,$sql3)) {
                 //die ('SQL Error: ' . mysqli_error($conn));
                    $query3=mysqli_query($conn,"ALTER TABLE lrpdelete
                    ADD taxoffice VARCHAR(30) DEFAULT '$soffice'");
                    if($query3){
                    $errormsg16="Table altered successfully!";
                    }else{
                    $errormsg15="Ooops!! Something went wrong!!";
                    }
                }else{

                $errormsg15="Its been altered Already!";
                }
}
if ($table=="lrps") {
    $sql1="SELECT approval FROM lrpcurrent";
    $sql2="SELECT approval FROM lrpback_year";
    
                if (!mysqli_query($conn,$sql1)) {
                 //die ('SQL Error: ' . mysqli_error($conn));
                    $query1=mysqli_query($conn,"ALTER TABLE lrpcurrent
                    ADD approval VARCHAR(30) DEFAULT 'approved'AFTER taxoffice,
                    ADD appby VARCHAR(20) DEFAULT '' AFTER approval,
                    ADD appdate VARCHAR(10) DEFAULT '' AFTER appby");

                    if($query1){
                    $errormsg18="Table altered successfully!";
                    }else{
                    $errormsg17="Ooops!! Something went wrong!!";
                    }
                }else{

                $errormsg17="Its been altered Already!";
                }
                if (!mysqli_query($conn,$sql2)) {
                 //die ('SQL Error: ' . mysqli_error($conn));
                    $query2=mysqli_query($conn,"ALTER TABLE lrpback_year
                   ADD approval VARCHAR(30) DEFAULT 'approved'AFTER taxoffice,
                    ADD appby VARCHAR(20) DEFAULT '' AFTER approval,
                    ADD appdate VARCHAR(10) DEFAULT '' AFTER appby");
                    if($query2){
                    $errormsg18="Table altered successfully!";
                    }else{
                    $errormsg17="Ooops!! Something went wrong!!";
                    }
                }else{

                $errormsg17="Its been altered Already!";
                }

        
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Modify Database Wizard</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
     
<style>
#verifyx{
    display:block;
    width:800px;
}
</style>   
</head>
<body>
   <div class="container-fluid">
   <div class="row-fluid col-md-12">
   <div id="verifyx">
   <h1 style="color:red" id="screen" class="alert-success">Database Alteration Wizard</h1>
   <br>
    <form name="search" action="modfile"  method="post">
            <input type="hidden" name="table" value="settings">

     <div class="form-group">
    <label for="capture"><h3>(1) Press This Button First</h3></label>&nbsp;&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="Modify Settings">
    </div>

    <?php
                    
                   if ($errormsg==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg.' </h4> </div>');
                   }
                    
                     if ($errormsg2==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen" ><h4>'.$errormsg2.' </h4> </div>');
                   }
                    ?>
     </form>          
           <p></p>       
                   <form name="search2" action="modfile"  method="post">
            <input type="hidden" name="table" value="current">
     <div class="form-group">
    <label for="capture"><h3>(2) Press This Button Second</h3></label>&nbsp;&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="Modify Current Register">
    </div>

    <?php
                    
                   if ($errormsg3==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg3.' </h4> </div>');
                   }
                    
                     if ($errormsg4==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen" ><h4>'.$errormsg4.' </h4> </div>');
                   }
                    ?>
     </form> 
      <p></p>            
    <form name="search3" action="modfile"  method="post">
            <input type="hidden" name="table" value="back_year">
     <div class="form-group">
    <label for="capture"><h3>(3) Press This Button Last</h3></label>&nbsp;&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="Modify Back year Register">
    </div>

    <?php
                    
                   if ($errormsg5==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg5.' </h4> </div>');
                   }
                    
                     if ($errormsg6==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen" ><h4>'.$errormsg6.' </h4> </div>');
                   }
                    ?>
     </form>          
    <p></p>
    <form name="search4" action="modfile"  method="post">
            <input type="hidden" name="table" value="rppusers">
     <div class="form-group">
    <label for="capture"><h3>(4) Press This Button Last</h3></label>&nbsp;&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="Modify Users setting">
    </div>

    <?php
                    
                   if ($errormsg7==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg7.' </h4> </div>');
                   }
                    
                     if ($errormsg8==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen" ><h4>'.$errormsg8.' </h4> </div>');
                   }
                    ?>
     </form>          
     <p></p>
     <form name="search5" action="modfile"  method="post">
            <input type="hidden" name="table" value="lrpcurrent">
     <div class="form-group">
    <label for="capture"><h3>(5) Press This Button Last</h3></label>&nbsp;&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="Modify LRP Current">
    </div>

    <?php
                    
                   if ($errormsg9==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg9.' </h4> </div>');
                   }
                    
                     if ($errormsg10==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen" ><h4>'.$errormsg10.' </h4> </div>');
                   }
                    ?>
     </form>          
     <p></p>

     <form name="search6" action="modfile"  method="post">
            <input type="hidden" name="table" value="lrpback_year">
     <div class="form-group">
    <label for="capture"><h3>(6) Press This Button Last</h3></label>&nbsp;&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="Modify LRP Back year">
    </div>

    <?php
                    
                   if ($errormsg11==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg11.' </h4> </div>');
                   }
                    
                     if ($errormsg12==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen" ><h4>'.$errormsg12.' </h4> </div>');
                   }
                    ?>
     </form>    
     <p></p> 
     <form name="search7" action="modfile"  method="post">
            <input type="hidden" name="table" value="vatstuff">
     <div class="form-group">
    <label for="capture"><h3>(7) Press This Button Last</h3></label>&nbsp;&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="Modify VAT Registers">
    </div>

    <?php
                    
                   if ($errormsg13==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg13.' </h4> </div>');
                   }
                    
                     if ($errormsg14==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen" ><h4>'.$errormsg14.' </h4> </div>');
                   }
                    ?>
     </form>               <p></p>

     <form name="search8" action="modfile"  method="post">
            <input type="hidden" name="table" value="deletes">
     <div class="form-group">
    <label for="capture"><h3>(8) Press This Button Last</h3></label>&nbsp;&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="Modify Delete trails">
    </div>

    <?php
                    
                   if ($errormsg15==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg15.' </h4> </div>');
                   }
                    
                     if ($errormsg16==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen" ><h4>'.$errormsg16.' </h4> </div>');
                   }
                    ?>
     </form>               
     <form name="search9" action="modfile"  method="post">
            <input type="hidden" name="table" value="lrps">
     <div class="form-group">
    <label for="capture"><h3>(9) Press This Button for LRPs </h3></label>&nbsp;&nbsp;&nbsp;<input class="btn btn-primary" type="submit" value="Modify Delete trails">
    </div>

    <?php
                    
                   if ($errormsg17==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg17.' </h4> </div>');
                   }
                    
                     if ($errormsg18==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen" ><h4>'.$errormsg18.' </h4> </div>');
                   }
                    ?>
     </form>               
  <a href="index" class="btn btn-success">Exit Wizard</a>
    </div>
    </div>
    </div>
</body>
</html>