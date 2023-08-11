<?php

include_once(dirname(__FILE__) . '/dbconfig/config.php');


$tinno1=$_POST['tin'];




if (empty($tinno1)) {
	
   $errormsg="You must enter a Company TIN ";
	header("Location:  delete_file?msg=".$errormsg  ); 
  exit ;
}else{

$query="SELECT * FROM masterlist WHERE tinno='$tinno1'"; 

      $result = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_array($result)){
	          $tinno= $row[2];
	
                             }
    
                   if ($tinno1==$tinno ){
    	 
	                  header("Location: show_delete?checktin=".$tinno);
	     	  	
                          }else {
    	
                    $error="No such Record in the MasterList";
	                header("Location: delete_file?msg=".$error);
                            }
      }  	                                                                                                                    


?>