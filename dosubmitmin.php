<?php 
    
     
    
include_once(dirname(__FILE__) . '/dbconfig/methods.php');

    
    
    $tover=str_replace(',','',$_POST['tover']);
    $gprofit=str_replace(',','',$_POST['gprofit']);
    $nasset=str_replace(',','',$_POST['nassets']);
    $pcap=str_replace(',','',$_POST['pcapital']);
    $yoa=$_POST['yoa'];
    $amt=str_replace(',','',$_POST['amount']);
   
    $asspage="mintax ";
	
   
              	
    header('Location:'.$asspage.'?data1='.$tover.'&data2='.$gprofit.'&data3='.$nasset.'&data4='.$pcap.'&data5='.$yoa.'&data6='.$amt); 
   	        exit();
            
       
    
?>