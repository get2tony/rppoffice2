<?php   

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');

$term = $_REQUEST["q"];

$tin_sign='-0';
if( strpos( $term, $tin_sign ) !== false) {
    
}else {
    $term=$term.'-0001';
}


$data='';
 $data1='';
$data2='';
$data3='';

// $sql="SELECT * FROM current WHERE tinno like '%".$term."%' ORDER BY STR_TO_DATE(capdate,'%d/%m/%Y') DESC LIMIT 1 ";
$sql="SELECT * FROM  back_year  WHERE tinno like '%".$term."%' 
      UNION 
      SELECT * FROM current WHERE tinno like '%".$term."%' ORDER BY STR_TO_DATE(capdate,'%d/%m/%Y') DESC";


// $sql="SELECT tinno,coyname FROM current INNER JOIN back_year ON current.tinno = back_year.tinno
//  WHERE tinno like '%".$term."%'  LIMIT"
    

    $result=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($result);
      

    if ($result){
		while ($row = mysqli_fetch_array($result)){
                 
            $data=$row[1];
			$data1=$row[2];
			$data2=$row[3];
			$data3=$row[4];
			$data4=$row[19];
			$data5=$row['phone'];
            
            
				}
        
		}else{
     die(" Error in second result Page".mysqli_error($conn));
            }

if ($count<1) {

    $sql2="SELECT * FROM adminasreg WHERE tinno like '%".$term."%' ORDER BY STR_TO_DATE(`adminasreg`.`capdate`, '%d-%m-%Y') DESC LIMIT 1 ";
   $result2=mysqli_query($conn,$sql2);
   $count2=mysqli_num_rows($result2);
   if ($result2){
		while ($row = mysqli_fetch_array($result2)){
                 
            $data=$row[1];
			$data1=$row[2];
			$data2=$row[3];
            $data3='December';
            $data4='';
            $data5='';
            
            
            
				}
        
		}else{
        


    die(" Error in second result Page".mysqli_error($conn));
    }
}





if($data==''){



$data1='';
$data2='';
 $data=$term;
 $data3='December';
 $data4='';
 $data5='';
}

$coycount=strlen($data1);
//echo $coycount;
if($coycount>33){

 	$data1=str_replace('INTEGRATED','INTGR',$data1);
	$data1=str_replace('INTERNATIONAL','INTL',$data1);
	$data1=str_replace('LIMITED','LTD',$data1);
	$data1=str_replace('COMMERCIAL','COM',$data1);
	$data1=str_replace('INDUSTRIAL','IND',$data1);
	$data1=str_replace('INDUSTRIES','INDS',$data1);
	$data1=str_replace('PRODUCTION','PROD',$data1);
	$data1=str_replace('PRODUCTS','PROD',$data1);
	$data1=str_replace('PHARMACEUTICAL ','PHARM',$data1);
	$data1=str_replace('PHARMACEUTICALS','PHARM',$data1);
	$data1=str_replace('ENTERPRISES ','ENT',$data1);
	$data1=str_replace('INVESTMENT','INVEST',$data1);
	$data1=str_replace('INVESTMENTS','INVEST',$data1);
	$data1=str_replace('SERVICES','SERV',$data1);
	$data1=str_replace('SERVICE','SERV',$data1);
	$data1=str_replace('NIGERIA','NIG',$data1);
	$data1=str_replace('CONSTRUCTION','CONSTR',$data1);
	$data1=str_replace('CONSULTANCY','CONSULT',$data1);
	$data1=str_replace('PETROLEUM','PET',$data1);
	$data1=str_replace('VENTURES','VEN',$data1);
	$data1=str_replace('MANAGEMENT','MGT',$data1);
	$data1=str_replace('MANAGERS','MGRS',$data1);

}// $myObj->name = 'John';
// $myObj->address = 'am here';
// // $myObj->yearend = $data3;
 $myObj = array(
               "name" => $data1,
               "address" => $data2,
               "yearend" => $data3,
               "remark" => $data4,
               "coytin" => $data,
               "phone" => $data5);


$myJSON = json_encode($myObj);

echo $myJSON;



function checkback($tin,$conn){

   $sql="SELECT * FROM back_year WHERE tinno like '%".$tin."%' ORDER BY STR_TO_DATE(capdate,'%d/%m/%Y') DESC LIMIT 1 ";
    
    $result=mysqli_query($conn,$sql);
    // $count2=mysqli_num_rows($result);
      
    if ($result){
		while ($row = mysqli_fetch_array($result)){
                 
            $data=$row[1];
			$data1=$row[2];
			$data2=$row[3];
			$data3=$row[4];
			$data4=$row[19];
			$data5=$row['phone'];
                    
				}
        $store=array($data,$data1,$data2,$data3,$data4,$data5);
        return $store;
		}else{
        
         die(" Error in getinfo Page".mysqli_error($conn));
        }


}



?>