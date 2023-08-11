<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');
$errormsg='';
$errormsg2='';
$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$user = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
$sql = "SELECT * FROM settings";

$query = mysqli_query($conn, $sql);

if (!$query) { 
    die ('SQL Error: here' . mysqli_error($conn));  
}
$sno='';
$officename="";
$soffice="";
$tcname="";
$rppname="";
$oaddress="";
$slabel="";
$slabelb="";
$alabel="";
$alabelb="";
$citrate="";
$edtrate="";
$intrate="";
$penrate="";
$vatrate="";
$modifiedby='';
$whtrate='';
$lrpint='';
$lrpsub='';
$lspint='';
$lspsub='';
$lspapp='';
$lrpapp='';
$polapp='';

while ($row = mysqli_fetch_array($query))
        {
$sno=$row[0];
$officename=$row[1];
$soffice=$row[2];
$tcname=$row[3];
$rppname=$row[4];
$oaddress=$row[5];
$slabel=$row[6];
$slabelb=$row[7];
$alabel=$row[8];
$alabelb=$row[9];
$citrate=$row[10];
$edtrate=$row[11];
$intrate=$row[12];
$penrate=$row[13];
$vatrate=$row[14];
$modifiedby=$user;
$whtrate=$row[16];
$lrpint=number_format($row[17],2);
$lrpsub=number_format($row[18],2);
$lspint=number_format($row[19],2);
$lspsub=number_format($row[20],2);
$lspapp=$row[21];
$lrpapp=$row[22];
$polapp=$row[23];
   
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FIRS RPP Office Settings</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css"/>

<!--     <link rel="stylesheet" href="css/bootstrap-iso.css" />-->
<link rel="stylesheet" href="css/bootstrap-datepicker3.css"/>
<!--  jQuery -->
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>

<style>
#appside{
display:block;
border:1px solid;
height: 40px;
padding:10px;
text-align:center;
border-radius:10px;

/* background: green; */
}
#adv{
width:70%;
text-align:center;

}
#screen{
position:absolute ;
top: 10px;

}
#selfset{
display:none;

}

</style>

  <!--  jQuery -->
  
</head>
<body>
   
    
    <section id= "form">
    <div class="panel "><H2>Advance Settings- 
			Office Profile</H2></div>
     <div class="container-fluid">
       <div class="bootstrap-iso">
        <form  name="returns" action="Process_settings"  method="post">
       <div class="row-fluid col-md-5">
                <div class="form-group" style="display:none">
                    <label for="coytin">Enter Full Office Name:</label>
                    <!-- <textarea class="form-control" id="coytin"  name="oname" placeholder="Office Name" value="" ><?php //echo $officename ?></textarea> -->
                    <input type="text" class="form-control" id="coytin" name="oname" placeholder="Office Name " value="<?php echo $officename ?>" >
                </div>
                <div class="form-group" style="display:none">
                    <label for="coyname">Enter Short Office Name:</label>
                    <input type="text" class="form-control" id="coyname"  name="osname" placeholder="Office Short Name" value="<?php echo $soffice ?>" />
                     </div>                            
                <div class="form-group">
                    <label for="coyname">Tax Controller name:</label>
                    <input type="text" class="form-control" id="coyname"  name="tcname" placeholder="TC Name" value="<?php echo $tcname ?>" />
                </div>
                   <div class="form-group">
                    <label for="coyname">RPP HOD name:</label>
                    <input type="text" class="form-control" id="coyname"  name="rppname" placeholder="Head RPP Name" value="<?php echo $rppname ?>" />
                </div>
                   
                   <div class="form-group">
                    <label for="coyname">Office Address:</label>
					   <textarea class="form-control" id="coyname"  name="address" placeholder="office address" value="" ><?php echo $oaddress ?></textarea>
                </div>
                    </div>
 <div id="selfset"class="row-fluid col-md-3">
                 
                  <div class="form-group">
                    <label for="coyname">Self Asmt Label (Current):</label>
                    <input type="text" class="form-control" id="coyname"  name="slabel" placeholder="Amst No. Format" value="<?php echo $slabel ?>" />
                </div>
                <div class="form-group">
                    <label for="coyname">Self Asmt Label (Back):</label>
                    <input type="text" class="form-control" id="coyname"  name="slabelb" placeholder="Amst No. Format" value="<?php echo $slabelb ?>" />
                </div>
                <div class="form-group">
                    <label for="coyname">Add Asmt Label (Current):</label>
                    <input type="text" class="form-control" id="coyname"  name="alabel" placeholder="Amst No. Format" value="<?php echo $alabel ?>" />
                </div>
                 <div class="form-group">
                    <label for="coyname">Add Asmt Label (back):</label>
                    <input type="text" class="form-control" id="coyname"  name="alabelb" placeholder="Amst No. Format" value="<?php echo $alabelb ?>" />
                </div>
                
                 
			</div>
                
     <div style="display:none" class="row-fluid col-md-2">
                <div class="form-group">
                    <label for="coyname">WHT Rate in %:</label>
                    <input type="text" class="form-control" id="coyname"  name="whtrate" placeholder="Amst No. Format" value="<?php echo $whtrate ?>" />
                </div>
                 <div class="form-group">
                    <label for="coyname">CIT Rate in %:</label>
                    <input type="text" class="form-control" id="coyname"  name="citrate" placeholder="rate " value="<?php echo $citrate ?>" />
                </div>
                 <div class="form-group">
                    <label for="coyname">EDT Rate in %:</label>
                    <input type="text" class="form-control" id="coyname"  name="edtrate" placeholder="rate " value="<?php echo $edtrate ?>" />
                </div>
                 <div class="form-group">
                    <label for="coyname">Interest Rate in %:</label>
                    <input type="text" class="form-control" id="coyname"  name="intrate" placeholder="rate" value="<?php echo $intrate ?>" />
                </div>
                 <div class="form-group">
                    <label for="coyname">Penalty Rate in %:</label>
                    <input type="text" class="form-control" id="coyname"  name="penrate" placeholder="rate" value="<?php echo $penrate ?>" />
                </div>
                 <div class="form-group">
                    <label for="coyname">VAT Rate in % :</label>
                    <input type="text" class="form-control" id="coyname"  name="vatrate" placeholder="rate" value="<?php echo $vatrate ?>" />
                </div>
            </div>
    <div class="row-fluid col-md-2">
                 <div class="form-group">
                    <label for="coyname">LRP First Month(CIT):</label>
                    <input type="text" class="form-control" id="lrpint"  name="lrpint" onchange="makenum('lrpint')" placeholder="lrp initial " value="<?php echo $lrpint ?>" />
                </div>
                 <div class="form-group">
                    <label for="coyname">LRP Subsequent (CIT)</label>
                    <input type="text" class="form-control" id="lrpsub"  name="lrpsub" onchange="makenum('lrpsub')" placeholder="lrp sub  " value="<?php echo $lrpsub ?>" />
                </div>
                 <div class="form-group">
                    <label for="coyname">LSP First Month(VAT):</label>
                    <input type="text" class="form-control" id="lspint"  name="lspint" onchange="makenum('lspint')" placeholder="lsp initial" value="<?php echo $lspint ?>" />
                </div>
                 <div class="form-group">
                    <label for="coyname">LSP Subsequent (VAT):</label>
                    <input type="text" class="form-control" id="lspsub"  name="lspsub" onchange="makenum('lspsub')" placeholder="lsp sub" value="<?php echo $lspsub ?>" />
                </div>


        </div>

        

                <br>
                    <input type="hidden" name="sno" value="<?php echo $sno ?>">
                    <input type="hidden" name="user" value="<?php echo $user ?>">
                    <input type="hidden" name="modifiedby" value="<?php echo $modifiedby ?>">
                    <input type="hidden" name="page" value="setoffice2">
                     <button type="submit" class="btn btn-primary">Update Settings </button>                    
                
            </div>
           </div>
             <div id="adv" class="row-fluid col-ms-12">
        <div id="appside" class="form-group">
                    &nbsp;
                    <label for="coyname">Request Approval for LRP:</label>
                    <select name="lrpapp" id="">
                    <option value="<?php echo $lrpapp?>"><?php echo ucfirst($lrpapp); ?></option>
                    <option value="no">No</option>
                    <option value="yes">Yes</option></select>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="coyname">Request Approval for VAT LSP:</label>
                    <select name="lspapp" id="">
                    <option value="<?php echo $lspapp?>"><?php echo ucfirst($lspapp); ?></option>
                    <option value="no">No</option>
                    <option value="yes">Yes</option></select>
               
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="coyname">Request Approval for POL:</label>
                    <select name="polapp" id="">
                    <option value="<?php echo $polapp?>"><?php echo ucfirst($polapp); ?></option>
                    <option value="no">No</option>
                    <option value="yes">Yes</option></select>
                </div>
                 


        </div>
                 
               <div class="row-fluid col-md-12">
               <!-- <div class="alert-danger" id="screen"><h4> </h4> </div> -->
               
                <?php
                    
                   if ($errormsg==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>
                    
                    
                    ');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg.' </h4> </div>');
                   }
                    
                     if ($errormsg2==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen"><h4>'.$errormsg2.' </h4> </div> ');
                   }
                    ?>
                    
                </div>
               
         </form>
        </div>
        </div>
    </section>
    
    
    
<!--    <script src="js3/jquery-1.12.4.js"></script>-->
    <script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'dd-mm-yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
      };
      date_input.datepicker(options);
    });
    </script>
<script type="text/javascript">
    
function validateForm() {
    var x = document.forms["returns"]["coytin"].value;
    var y = document.forms["returns"]["coyname"].value;
    var z = document.forms["returns"]["address"].value;
    
    
    if (x == "") {
        alert("Company's Tin must be filled ");
        return false;
    }
     if (y == "") {
        alert("Company's Name must be filled ");
        return false;
    }
     if (z == "") {
        alert("Address must be filled out");
        return false;
    }
     
} 

function makenum(d) {                
    var q=document.getElementById(d).value;
	if( isNaN(q.replace(/,/g, ''))){
	   q=0;
	   }
    if(q=="" || q===""){
    q=0;
    document.getElementById(d).value = q.toFixed(2);
    }
          
    var n = Number(parseFloat(q.replace(/,/g, ''))).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
    document.getElementById(d).value = n;

      }   
    
 </script>
</body>
</html>