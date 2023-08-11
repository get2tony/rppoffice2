<?php


    $suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Computation Tool kits</title>
    <link rel="stylesheet" href="css3/bootstrap.min.css">
     <link rel="stylesheet" href="css3/style4.css">
</head>
<body>
   
      <div class="panel "><H2>Tax Computation Apps</H2></div>
       <div class="container">
             <div class="row">
             <div class="col-xs-3"><img src="img/003-calculator.png" alt="VATLSP" width="128px" height="128px"></div>
             <div class="col-xs-3"></div>
             <div class="col-xs-3"><img src="img/002-file.png" alt="mintax" width="128px" height="128px"></div>
            
             
           </div>
           <div class="row">
               <p></p>
               
        <div class="col-xs-3"><a  class="btn btn-primary" href="vatlrp " target="dframe">Compute VAT LSP</a></div>
        <div class="col-xs-3"> </div>
        <div class="col-xs-3"><a  class="btn btn-primary" href="domintax?user=<?php echo $suser ?>" target="dframe">Compute Minimum Tax </a></div>
        
           </div>
            
           
        </div> 
        
        
    
</body>
</html>