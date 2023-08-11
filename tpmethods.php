<?php  
include_once(dirname(__FILE__) . '/dbconfig/methods.php');

function gettaxinfo($conn,$tin,$yoa){

        $sqlmain="CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS  SELECT * FROM current  UNION  SELECT * FROM back_year ";   
        $query1 = mysqli_query($conn,$sqlmain);
        //$count1=mysqli_num_rows($query1);
        if (!$query1) {
        die ('SQL Error: ' . mysqli_error($conn));
        }else{

        $sql="SELECT * FROM temp_self WHERE tinno ='$tin' && yoa = '$yoa' ORDER BY sno DESC LIMIT 1";

        }

        $query = mysqli_query($conn, $sql);
        $count=mysqli_num_rows($query);
        if (!$query) {
            die ('SQL Error: gettaxinfo in tpmethods' . mysqli_error($conn));  
        }
        $amount="";
        while ($row = mysqli_fetch_array($query))
        {

        $tax = array("count"=>"$count",
                      "asstype"=>"$row[7]",
                      "assno"=>"$row[20]",
                      "tover"=>number_format($row[9],2),
                      "aprofit"=>number_format($row[11],2),
                      "tprofit"=>number_format($row[10],2),
                      "cit"=>number_format($row[12],2),
                      "edt"=>number_format($row[13],2),
                      "capdate"=>"$row[8]"
                    );
    
        }
if (!$count) {
    $tax=array("count"=>"1",
               "asstype"=>"N/A",
               "assno"=>"NO ASSESSMENT",
               "tover"=>"N/A",
               "aprofit"=>"N/A",
               "tprofit"=>"N/A",
               "cit"=>"N/A",
               "edt"=>"N/A",
               "capdate"=>"-"
                    );
                }
 return $tax;
 mysqli_close($conn);
 exit;
}
function getlrpinfo($conn,$tin,$yoa){

        $sqlmain="CREATE TEMPORARY TABLE IF NOT EXISTS temp_self2 AS  SELECT * FROM lrpcurrent  UNION  SELECT * FROM lrpback_year ";   
        $query1 = mysqli_query($conn,$sqlmain);
        //$count1=mysqli_num_rows($query1);
        if (!$query1) {
        die ('SQL Error: ' . mysqli_error($conn));
        }else{

        $sql="SELECT * FROM temp_self2 WHERE tinno ='$tin' && yoa = '$yoa' && taxtype='LRP' ORDER BY sno DESC ";

        }

        $query = mysqli_query($conn, $sql);
        $count=mysqli_num_rows($query);
        if (!$query) {
            die ('SQL Error: getlrpinfo in tpmethods' . mysqli_error($conn));  
        }
        $amount="";
        $ddate="";
        while ($row = mysqli_fetch_array($query))
        {
            $asmt=$row[8].$row[9].$row[10];
            if (strpos($row[5],'/')) {
               $ddate=$row[5]; # code...
            }else{
            $ddate=date_format(date_create($row[5]),"d/m/Y");
            }
        $tax = array(
                      "count"=>"$count",
                      "taxtype"=>"$row[6]",
                      "amount"=>"$row[7]",
                      "assno"=>"$asmt",
                      "capdate"=>"$ddate",
                      "gov"=>"GOVT ASMT"
                    );
    
        }
if (!$count) {
    $tax= array(      "count"=>"$count",
                      "taxtype"=>"",
                      "amount"=>"",
                      "assno"=>"",
                      "capdate"=>"",
                      "gov"=>""
                    );
                }
 return $tax;
 mysqli_close($conn);
 exit;
}

function getaddsum($conn,$tin,$yoa,$tax,$d){
$sql3="SELECT * FROM adminasreg WHERE tinno ='$tin' && yoa = '$yoa' && taxtype ='$tax' && (`approval`  LIKE 'approved' || `approval` IS NULL) ORDER BY sno DESC ";
     $result3=mysqli_query($conn,$sql3);
      
    if (!$result3){
         die ('SQL Error: getaddsum' . mysqli_error($conn));
    }
     $add=false;
     
     $sum=0;
     $citrate=30;
     $edtrate=2;
		while ($row1 = mysqli_fetch_array($result3)){
                 
           $assno=$row1[8];
          $amount=$row1[7];
          $capdate=$row1[5];
          $taxtype=$row1[6];
          $basis=$row1[9];
          $citrate=$row1[24];
          $edtrate=$row1[25];
          $sum+=str_replace(',','',$amount); 
          $add=true;
              }
         if ($d=="add") {
             return $add;
         }
         if ($d=="rate" && $tax=="CIT") {

            if ($citrate==null || $citrate==0 && $tax=='CIT') {
                $citrate=getSettings('citrate',$conn);
            }
            
             return $citrate;# code...
         }
         if ($d=="rate" && $tax=="EDT") {

            if ($edtrate==null || $edtrate==0 && $tax=='EDT') {
                $edtrate=getSettings('edtrate',$conn);
            }
            
             return $edtrate;# code...
         }
          if ($d=="sum") {
             return $sum;
         }
        mysqli_close($conn);
        exit;
        }


?>