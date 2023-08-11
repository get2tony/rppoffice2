<?php   

include_once(dirname(__FILE__) . '/dbconfig/config.php');
include_once(dirname(__FILE__) . '/dbconfig/methods.php');


$term = $_REQUEST["q"];

$tin_sign='-0';
if( strpos( $term, $tin_sign ) !== false) {
    
}else {
    $term=$term.'-0001';
}


$nameg='';
$coyting='';
$addressg='';
$phoneg='';
$nobg='';
$categoryg='';

$sql="SELECT * FROM vatlist WHERE tinno like '%".$term."%' ORDER BY STR_TO_DATE(capdate,'%d/%m/%Y') DESC LIMIT 1 ";
// $sql="SELECT * FROM  current  WHERE tinno like '%".$term."%'
//   UNION 
//   SELECT * FROM back_year WHERE tinno like '%".$term."%' ORDER BY STR_TO_DATE(capdate,'%d/%m/%Y') ASC LIMIT 1 ";


// $sql="SELECT tinno,coyname FROM current INNER JOIN back_year ON current.tinno = back_year.tinno
//  WHERE tinno like '%".$term."%'  LIMIT 1";
    

    $result=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($result);
      

    if ($result){
		while ($row = mysqli_fetch_array($result)){
                $coyting=$row[1];
            $nameg=$row[2];
			$addressg=$row[3];
			$phoneg=$row[4];
			$nobg=$row[5];
			$categoryg=$row[6];
            
            
				}
        
		}else{
        


    die(" Error in getvatinfo Page".mysqli_error($conn));
    }
if ($count<1) {

    $sql="SELECT * FROM  back_year  WHERE tinno like '%".$term."%' 
      UNION 
      SELECT * FROM current WHERE tinno like '%".$term."%' ORDER BY STR_TO_DATE(capdate,'%d/%m/%Y') DESC LIMIT 1 ";
   $result2=mysqli_query($conn,$sql2);
   $count2=mysqli_num_rows($result2);
   if ($result2){
		while ($row = mysqli_fetch_array($result2)){
            
            $coyting=$row[1]; 
            $nameg=$row[2];
			$addressg=$row[3];
			$phoneg=$row[27];
			$nobg=$row[19];
			$categoryg="Corporate";
            
            
				}
        
		}else{
        
      $shade='yes';
        }
}

// if ($shade=='yes') {

//  $sql2="SELECT * FROM adminasreg WHERE tinno like '%".$term."%' ORDER BY STR_TO_DATE(`adminasreg`.`capdate`, '%d-%m-%Y') DESC LIMIT 1 ";
//    $result2=mysqli_query($conn,$sql2);
//    $count2=mysqli_num_rows($result2);
//    if ($result2){
// 		while ($row = mysqli_fetch_array($result2)){
                 
//             $coyting=$row[1];
// 			$nameg=$row[2];
// 			$addressg=$row[3];
//             $phoneg='';
//             $nobg='';
//             $categoryg='Corporate';
            
            
            
// 				}
        
// 		}else{
        


//     die(" Error in second result Page".mysqli_error($conn));
//     }
// }









if($coyting==''){



$nameg="";
$addressg="";
$phoneg="";
$coyting=$term;
$nobg="";
$categoryg="Corporate";
}
$coycount=strlen($nameg);
//echo $coycount;
if($coycount>33){

 	$nameg=str_replace('INTEGRATED','INTGR',$nameg);
	$nameg=str_replace('INTERNATIONAL','INTL',$nameg);
	$nameg=str_replace('LIMITED','LTD',$nameg);
	$nameg=str_replace('COMMERCIAL','COM',$nameg);
	$nameg=str_replace('INDUSTRIAL','IND',$nameg);
	$nameg=str_replace('INDUSTRIES','INDS',$nameg);
	$nameg=str_replace('PRODUCTION','PROD',$nameg);
	$nameg=str_replace('PRODUCTS','PROD',$nameg);
	$nameg=str_replace('PHARMACEUTICAL ','PHARM',$nameg);
	$nameg=str_replace('PHARMACEUTICALS','PHARM',$nameg);
	$nameg=str_replace('ENTERPRISES ','ENT',$nameg);
	$nameg=str_replace('INVESTMENT','INVEST',$nameg);
	$nameg=str_replace('INVESTMENTS','INVEST',$nameg);
	$nameg=str_replace('SERVICES','SERV',$nameg);
	$nameg=str_replace('SERVICE','SERV',$nameg);
	$nameg=str_replace('NIGERIA','NIG',$nameg);
	$nameg=str_replace('CONSTRUCTION','CONSTR',$nameg);
	$nameg=str_replace('CONSULTANCY','CONSULT',$nameg);
	$nameg=str_replace('PETROLEUM','PET',$nameg);
	$nameg=str_replace('VENTURES','VEN',$nameg);
	$nameg=str_replace('MANAGEMENT','MGT',$nameg);
	$nameg=str_replace('MANAGERS','MGRS',$nameg);

}// $myObj->name = 'John';

// $myObj->name = 'John';
// $myObj->address = 'am here';
// // $myObj->yearend = $data3;
 $myObj = array(
               "name" => $nameg,
               "address" => $addressg,
               "phone" => $phoneg,
               "coytin" => $coyting,
               "nob" => $nobg,
               "category" => $categoryg
            );


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