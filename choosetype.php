<?php
$taxtype=$_POST['cata'];
$table=$_POST['catb'];
    




if($taxtype==""){
    
header("Location: sasearchtype?cata=".$taxtype."&catb=".$table);
    	exit; 
}
if($taxtype=="all"){
    
header("Location: sasearchtype?cata=".$taxtype."&catb=".$table);
    	exit; 
} 

if($taxtype=="cit"){
    
header("Location: citsearchtype?cata=".$taxtype."&catb=".$table);
    	exit; 
}

if($taxtype=="edt"){
    
header("Location: edtsearchtype?cata=".$taxtype."&catb=".$table);
    	exit; 
}













?>
