<?php
$errormsg='';
$errormsg2='';

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;

$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Compute Minimum Tax Payable</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
    <link rel="stylesheet" href="css3/style4.css">
    
                      
   
</head>
<body>
   <div class="container-fluid">
           
           <div class="note2" ><h3> &nbsp;Minimum Tax Computation</h3>
            </div>
            <form id="returns" name="returns" action="dosubmitmin " onsubmit="return validateForm()" method="post" target="_blank">
       <div class="row-fluid col-md-4">
                <div class="form-group">
                    <label for="coytin">Turnover:</label>
                    <input type="text" class="form-control" id="tover" name="tover" placeholder="Turnover" value="0.00"  onchange="makenum('tover')">
                </div>
                <div class="form-group">
                    <label for="coyname">Gross Profit:</label>
                    <input type="text" class="form-control" id="gprofit"  name="gprofit" placeholder="Gross Profit" onchange="makenum('gprofit')" value="0.00">
                </div>
						
                <div class="form-group">
                    <label for="coyname">Net Assets:</label>
                    <input type="text" class="form-control" id="nassets"  name="nassets" placeholder="Net Assets" value="0.00" onchange="makenum('nassets')">
                </div>
                
                 <div class="form-group">
                    <label for="coyname">Paid Up Capital:</label>
                    <input type="text" class="form-control" id="pcapital"  name="pcapital" placeholder="Paid up Capital" value="0.00" onchange="makenum('pcapital')">
                </div>
                
                    <div class="form-group">
                    <label for="YOA">Year of Assessment:</label>
                    <input type="text" name="yoa" class="form-control" id="yoa" placeholder="Year of Assessment" value="<?php   echo date('Y');?>" >
                    </div>
                    
                    <div class="form-group">
                    <label for="amnt">CIT Amount paid: &nbsp;</label>
                    <input type="text" class=""  id="amount" name="amount" placeholder="Amount Paid" value="0.00" required size="21" onchange="makenum('amount')">
                    </div>
                    
                    
                    
                    <p></p>
                       <input type="hidden" name="user" value="<?php echo $suser ?>">
                        <button type="submit" class="btn btn-primary" onclick="check('tover','gprofit','nassets','pcapital','amount')">Amount Payable</button>
                    
                    <p></p>
                    
                   
                
                    </div>


               
        
               
                <!--second row-->
                <div class="row-fluid col-md-5">
        
                    

                                
                <?php
                    
                   if ($errormsg2==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-danger" id="screen"><h4>'.$errormsg2.' </h4> </div>');
                   }
                    
                     if ($errormsg==null){
                       
                    echo ('  <div class="" id="screen"><h4> </h4> </div>');  
                   
                   }else{
            
                    echo ('  <div class="alert-success" id="screen"><h4>'.$errormsg.' </h4> </div>');
                   }
                    ?>
               
               
                
                </div>
                <!--end of second row-->
            </form>
           
           
           
   </div>
   <script src="js3/jquery-1.12.4.js"></script>
   <script type="text/javascript">
    
function validateForm() {
    var x = document.forms["returns"]["tover"].value;
    var y = document.forms["returns"]["gprofit"].value;
    var z = document.forms["returns"]["nassets"].value;
    var w = document.forms["returns"]["pcapital"].value;
    
    
   if (w==0 && x==0 && y==0 && z==0 ){
		
		alert('Please Fill atleast one item for the Computation!');
	   return false;
	}
     
} 
    
    
    </script>
    <script>
var taxsAndModels = {};
taxsAndModels['CIT'] = ['Additional Tax', 'Admin Tax', 'BOJ','Re-Assessment','Provisional Tax'];
taxsAndModels['EDT'] = ['Additional Tax', 'Admin Tax', 'BOJ','Re-Assessment','Provisional Tax'];
taxsAndModels['POL'] = ['Admin Tax'];

function ChangetaxList() {
    var taxList = document.getElementById("tax");
    var modelList = document.getElementById(" basis");
    var seltax = taxList.options[taxList.selectedIndex].value;
    while (modelList.options.length) {
        modelList.remove(0);
    }
    var taxs = taxsAndModels[seltax];
    if (taxs) {
        var i;
        for (i = 0; i < taxs.length; i++) {
            var tax = new Option(taxs[i], i);
            modelList.options.add(tax);
        }
    }
} 
</script>

  <script type="text/javascript"> 
     function myVal() {                
var k=document.getElementById("yoa").value;
var m= k-1;
document.getElementById("startdate").value="01-01-"+m;
document.getElementById("enddate").value="31-12-"+m;
      }             
	</script>
    
 <script type="text/javascript"> 
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
function check(a,b,c,d,e){
	var w=document.getElementById(a).value;
	var x=document.getElementById(b).value;
	var y=document.getElementById(c).value;
	var z=document.getElementById(d).value;
	var k=document.getElementById(e).value;
	
	if(w=='NaN'){
	   w=0.00;
		document.getElementById(a).value = w;
	   }
	if(x=='NaN'){
	   x=0.00;
		document.getElementById(b).value = x;
	   }
	if(y=='NaN'){
	   y=0.00;
		document.getElementById(c).value = y;
	   }
	if(z=='NaN'){
	   z=0.00;
		document.getElementById(d).value = z;
	   }
	if(k=='NaN'){
	   k=0.00;
		document.getElementById(e).value = k;
	   }
	
}
</script>
</body>
</html>