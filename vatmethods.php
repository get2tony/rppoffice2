<?php 

include_once(dirname(__FILE__) . '/dbconfig/config.php');

function getSetting($data,$conn){

    $sql="SELECT * FROM `settings` ";
	
$officename='';
$soffice='';
$tcname='';
$rppname='';
$oaddress='';
$slabel='';
$slabelb='';
$alabel='';
$alabelb='';
$citrate='';
$edtrate='';
$intrate='';
$penrate='';
$vatrate='';
$lastmod='';
$whtrate='';
$lrpint='';
$lrpsub='';
$lspint='';
$lspsub='';
$vatlrp='';
$citlrp='';
$polapp='';
	
	
     $result=mysqli_query($conn,$sql);
    if ($result){
        while ($row = mysqli_fetch_array($result)){
                // $capdate=$row[5];

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
$lastmod=$row[15];
$whtrate=$row[16];
$lrpint=$row[17];
$lrpsub=$row[18];
$lspint=$row[19];
$lspsub=$row[20];
$vatlrp=$row[21];
$citlrp=$row[22];
$polapp=$row[23];
                }
		
		
}else{
        
        die(" Error in getsetting in VAt methods function".mysqli_error($conn));
    }
switch ($data){
    case 'oname':
        return $officename;
        break;
    case 'soname':
        return $soffice;
        break;
    case 'tcname':
        return $tcname;
        break;
    case 'rppname':
        return $rppname;
        break;
    case 'address':
        return $oaddress;
        break;
    case 'slabel':
        return $slabel;
        break;
    case 'slabelb':
        return $slabelb;
        break;
    case 'alabel':
        return $alabel;
        break;
     case 'alabelb':
        return $alabelb;
        break;
     case 'citrate':
        return $citrate;
        break;
     case 'edtrate':
        return $edtrate;
        break;
     case 'intrate':
        return $intrate;
        break;
	case 'penrate':
        return $penrate;
        break;
	case 'vatrate':
        return $vatrate;
        break;
	case 'whtrate':
        return $whtrate;
        break;
	case 'lrpint':
        return $lrpint;
        break;
	case 'lrpsub':
        return $lrpsub;
        break;
	case 'lspint':
        return $lspint;
        break;
	case 'lspsub':
        return $lspsub;
        break;
    
	case 'vatlrp':
        return $vatlrp;
        break;
    
	case 'citlrp':
        return $citlrp;
        break;
    
	case 'polapp':
        return $polapp;
        break;
    }
       

exit;	
	
}




function checkUserirno($sno,$conn){
	 $table="rppusers";
	 $dept=0;
	 $sql="SELECT * FROM `$table` WHERE `sno` LIKE '$sno'";
     $result=mysqli_query($conn,$sql);
	
    if ($result){
        while ($row = mysqli_fetch_array($result)){
                
        $dept=$row[11] ;

              }
	}
	return $dept;
	exit;
}
function checkirnostatus($sno,$conn){
     $table="rppusers";
     $status='yes';
	 $dept="rpp";
	 $sql="SELECT * FROM `$table` WHERE `sno` LIKE '$sno'";
     $result=mysqli_query($conn,$sql);
	
    if ($result){
        while ($row = mysqli_fetch_array($result)){
                
            $dept=$row[11] ;

            if($dept==''){
                $status='no';
            }

              }
	}
	return $status;
	exit;
}

function getusersno($fullname,$conn){
	 $table="rppusers";
     $sno="";
     $name=explode(' ',$fullname);
     $fname=$name[0];
     $sname=$name[1];

	 $sql="SELECT * FROM `$table` WHERE `name` LIKE '$fname' && surname LIKE '$sname' ";
     $result=mysqli_query($conn,$sql);
	
    if ($result){
        while ($row = mysqli_fetch_array($result)){
                
           
            $sno=$row[0];

              }

    }
    
        return $sno;
	
	exit;
}

function getAssuser($fullname,$conn){
	 $table="rppusers";
     $dept="rpp";
     $name=explode(' ',$fullname);
     $fname=$name[0];
     $sname=$name[1];

	 $sql="SELECT * FROM `$table` WHERE `name` LIKE '$fname' && surname LIKE '$sname' ";
     $result=mysqli_query($conn,$sql);
	
    if ($result){
        while ($row = mysqli_fetch_array($result)){
                
           
            $dept=$row[10];

              }

    }
    
        return $dept;
	
	exit;
}
function checkUserdept($sno,$conn){
	 $table="rppusers";
     $dept="rpp";
     

	 $sql="SELECT * FROM `$table` WHERE `sno` = '$sno' ";
     $result=mysqli_query($conn,$sql);
	
    if ($result){
        while ($row = mysqli_fetch_array($result)){
                
           
            $dept=$row[10];

              }

    }
    
        return $dept;
	
	exit;
}


function getuserlevel($fullname,$conn){
	 $table="rppusers";
     $level="user";
     $name=explode(' ',$fullname);
     $fname=$name[0];
     $sname=$name[1];

	 $sql="SELECT * FROM `$table` WHERE `name` LIKE '$fname' && surname LIKE '$sname' ";
     $result=mysqli_query($conn,$sql);
	
    if ($result){
        while ($row = mysqli_fetch_array($result)){
                
           
            $level=$row[3];

              }

    }
    
        return $level;
	
	exit;
}

function getFullmonth($no){

switch ($no){
    case '01':
        return "January";
        break;
    case '02':
        return "February";
        break;
    case '03':
        return "March";
        break;
    case '04':
        return "April";
        break;
    case '05':
        return "May";
        break;
    case '06':
        return "June";
        break;
    case '07':
        return "July";
        break;
    case '08':
        return "August";
        break;
     case '09':
        return "September";
        break;
     case '10':
        return "October";
        break;
     case '11':
        return "November";
        break;
     case '12':
        return "December";
        break;
    }
}
function getNummonth($no){

switch ($no){
    case 'January':
        return "01";
        break;
    case 'February':
        return "02";
        break;
    case 'March':
        return "03";
        break;
    case 'April':
        return "04";
        break;
    case 'May':
        return "05";
        break;
    case 'June':
        return "06";
        break;
    case 'July':
        return "07";
        break;
    case 'August':
        return "08";
        break;
     case 'September':
        return "09";
        break;
     case 'October':
        return "10";
        break;
     case 'November':
        return "11";
        break;
     case 'December':
        return "12";
        break;
    }
}

function isduplicateVAT($conn,$tin,$asyr,$month,$basis,$amt,$name){
    
    $query="SELECT * FROM vatreg WHERE `tinno`='$tin' && `yoa`='$asyr' &&  `coyname`='$name' &&  `month`='$month' && `basis`='$basis' && `amount`='$amt'";
    

	$result=mysqli_query($conn,$query);
       $tinnos='';
       $assmtyr='';
       $coyname='';
       $basisp='';
       $amount='';
       $months='';

    if ($result){
		while ($row = mysqli_fetch_array($result)){
	               
			$tinnos=$row[1];
			$assmtyr=$row[8];
			$coyname=$row[2];
			$months=$row[7];
            $basisp=$row[5];
            $amount=$row[9];
				}
        
		}else{
        
        die(" Error in VATduplicate function".mysqli_error($conn));
    }
    
    if ($tinnos==$tin && $assmtyr==$asyr  && $months==$month && $basisp==$basis && $amount==$amt && $coyname==$name){
        
	return true;
  	
	
    }
    return false;
}
function isVATinlist($conn,$tin,$category){
    
    $query="SELECT * FROM vatlist WHERE `tinno`='$tin'  &&  `category`='$category' ";
    

    $result=mysqli_query($conn,$query);
    
       $tinnos='';
       $categorys='';
       $true='true';
       $false='false';
       

    if ($result){
		while ($row = mysqli_fetch_array($result)){
	               
			$tinnos=$row[1];
			
			$categorys=$row[6];
            
				}
        
		}else{
        
        die(" Error in chect VATlist function".mysqli_error($conn));
    }
    
    if ($tinnos==$tin  && $categorys==$category ){
        
	return $true;
  	
	
    }
    return $false;
}

function getRemark($conn,$tin){
    $sql = "SELECT * FROM vatlist where `tinno`='$tin'";
$query = mysqli_query($conn, $sql);

if (!$query) {
        die ('SQL Error: getRemark' . mysqli_error($conn));
}

$remark="";

while ($row = mysqli_fetch_array($query))
        {
$remark=mysqli_real_escape_string($conn,trim(preg_replace('/\s\s+/', '', strtoupper($row[5]))));
}
 return $remark;
 
}

function getfileinfo($conn, $tin, $month, $d, $y)
{
    $sqlmain = 'CREATE TEMPORARY TABLE IF NOT EXISTS temp_self AS SELECT r.tinno, r.coyname, r.yoa, r.month, r.address, r.phone, r.category,r.amount, r.capdate, r.paydate,r.defaultdays, l.nob
FROM vatreg r, vatlist l WHERE r.tinno = l.tinno';
    $query1 = mysqli_query($conn, $sqlmain);
    //$count1=mysqli_num_rows($query1);
    if (!$query1) {
        die('SQL Error: ' . mysqli_error($conn));
    } else {

        $sql = "SELECT  * FROM temp_self where `tinno` LIKE '%$tin' && `month`='$month' && yoa ='$y' ORDER BY `capdate` ASC";
    }
    $query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);
    if (!$query) {
        die('SQL Error: getfiledate3 in tablevat3' . mysqli_error($conn));
    }
    $filedate = "";
    $paydate = "";
    $vatamt = '';
    $vatamt2 = 0;
    $dayslate = "";
    while ($row = mysqli_fetch_array($query)) {
        $vatamtget = $row['amount'];
        if ($vatamtget == '' || $vatamtget == null) {
            $vatamt = $vatamtget;
        }
        if ($count > 1) {
            $vatamt = 0;
            $vatamt2 += (int)$vatamtget;
            $vatamt = $vatamt2;
        } else {
            $vatamt = $vatamtget;
        }
        $filedate = $row['capdate'];
        $paydate = $row['paydate'];
        $dayslate = $row['defaultdays'];
    }

    if (
        $vatamt == '' || $vatamt == null
    ) {
    } else {
        $vatamt = number_format($vatamt, 2); # code...
    }

    if (
        $vatamt == 0.00 && $vatamt != ''
    ) {
        $vatamt = 'NIL';
    }

    if ($d == "amount") {
        return $vatamt;
    }
    if ($d == "pay") {
        return $paydate;
    }
    if ($d == "file") {
        return $filedate;
    }
    if ($d == "day") {
        return $dayslate;
    }
}

// method test ends here
function checknob($conn,$tin){
    $sql = "SELECT * FROM `vatlist` where `tinno`='$tin' limit 1";
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        die('SQL Error: checknob' . mysqli_error($conn));
    }
    $nob = "";
    while ($row = mysqli_fetch_array($query)) {
        $nob = $row['nob'];
    }
}

function getcurrentinfo($conn,$tin,$yoa){

        $sql = "SELECT * FROM current where `tinno`='$tin' && `yoa`='$yoa'  LIMIT 1";
        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die ('SQL Error: getcompinfo' . mysqli_error($conn));  
        }
        $amount="";
        while ($row = mysqli_fetch_array($query))
        {
        $amount=$row[12];
        }
if ($amount=='' || $amount==null ) {
    $amount=getbackinfo($conn,$tin,$yoa);
}else {
    $amount=number_format($amount,2);# code...
}
 return $amount;
 mysqli_close($conn);
 exit;
}

function getbackinfo($conn,$tin,$yoa){

        $sql = "SELECT * FROM back_year where `tinno`='$tin' && `yoa`='$yoa'  LIMIT 1";
        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die ('SQL Error: getcompinfo' . mysqli_error($conn));  
        }
        $amount="";
        while ($row = mysqli_fetch_array($query))
        {
        $amount=$row[12];
        }
if ($amount=='' || $amount==null ) {
    $amount="N/A"; 
}else {
    $amount=number_format($amount,2);# code...
}
 return $amount;
 mysqli_close($conn);
 exit;
}
function getbackinfo5($conn, $tin, $yoa)
{

    $sql = "SELECT * FROM back_year where `tinno`='$tin' && `yoa`='$yoa'  LIMIT 1";
    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die('SQL Error: getcompinfo5' . mysqli_error($conn));
    }
    $amount = "";
    while ($row = mysqli_fetch_array($query)) {
        $amount = $row[13];
    }
    if ($amount == '' || $amount == null) {
        $amount = "N/A";
    } else {
        $amount = number_format($amount, 2); # code...
    }
    return $amount;
    mysqli_close($conn);
    exit;
}


function getAssmtNumselfvat($conn,$issue){
    
    
    $query="SELECT * FROM vatreg WHERE capdate like '%".date('Y')."' ORDER BY sno ";
    $asnumber=0;
    $ayear=0;
    $capdate=0;
	$newcap=date('d/m/Y',strtotime($issue));
	$ncap=explode('/',$newcap);
	$necap=$ncap[1];
	$necapy=$ncap[2];
	$cdate='';
	$cadate='';
	$cayear='';
	
    //$yeartx=substr(date('Y'),-2);
    //$capdate=substr($capdate,-2);
    
    $result=mysqli_query($conn,$query);
    $asnumber=mysqli_num_rows($result);
    
    if ($result){
		while ($row = mysqli_fetch_array($result)){
	             
                 $ayear=substr($row[16],-2);
                 $capdate=$row[10];
				 $cdate=explode('-',$capdate);
				 $cadate=$cdate[1];
				 $cayear=$cdate[2];
                 //$capdate=date('d/m/Y');
				}    
        }else{
        
        die(" Error in getAssmtNum function".mysqli_error($conn));
        }
       
           // $ayear=substr_replace('/','',$ayear);
           // $capdate=substr($capdate,-2);
    
       if($cadate>$necap && $necapy>$cayear){
		   
            $asnumber=0;
            return $asnumber+1;
            exit;
        }
            
            return $asnumber+1;
            exit;
        
}
function checkback($tin,$conn){

   $sql="SELECT * FROM back_year WHERE tinno like '%".$tin."%' ORDER BY STR_TO_DATE(capdate,'%d/%m/%Y') DESC LIMIT 1 ";
    
    $result=mysqli_query($conn,$sql);
    
      
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

function getSettings2($sno,$data,$conn){

    $sql="SELECT assprofit,tprofit,citrate,edtrate,intrate,penrate,vatrate FROM `adminasreg` WHERE sno='$sno' ";
	
$citrate='';
$edtrate='';
$intrate='';
$penrate='';
$vatrate='';
$assprofit='';
$tprofit='';
	
	
     $result=mysqli_query($conn,$sql);
    if ($result){
        while ($row = mysqli_fetch_array($result)){
                
$citrate=$row['citrate'];
$edtrate=$row['edtrate'];
$intrate=$row['intrate'];
$penrate=$row['penrate'];
$vatrate=$row['vatrate'];
$assprofit=$row['assprofit'];
$tprofit=$row['tprofit'];
                }
		
		
}else{
        
        die(" Error in getsettings2 function".mysqli_error($conn));
    }
switch ($data){
   
     case 'citrate':
     if ($citrate===null || $citrate==" ") {
        $citrate=getSetting('citrate',$conn);
            }
        return $citrate;
        break;
     case 'edtrate':
      if ($edtrate===null || $edtrate==" ") {
        $edtrate=getSetting('edtrate',$conn);
            }   
     return $edtrate;
        break;
     case 'intrate':
      if ($intrate===null || $intrate==" ") {
        $intrate=getSetting('intrate',$conn);
            }
        return $intrate;
        break;
    case 'penrate':
     if ($penrate===null || $penrate==" ") {
        $penrate=getSetting('penrate',$conn);
            }
        return $penrate;
        break;
    case 'assprofit':
     if ($assprofit===null || $assprofit==" ") {
        $assprofit=0;
            }
        return $assprofit;
        break;
    case 'tprofit':
     if ($tprofit===null || $tprofit==" ") {
        $tprofit=0;
            }
        return $tprofit;
        break;
    case 'vatrate':
     if ($vatrate===null || $vatrate==" ") {
        $vatrate=getSetting('vatrate',$conn);
            }
        return $vatrate;
        break;
    }
       

exit;	
	
}

function topvatinfo($data,$tin,$conn){
	$ddate=date('Y');
    $amount=0;
		$num=0;
$sql= "SELECT amount FROM `vatreg` WHERE `tinno` = '$tin' && `basis` = 'Self Asmt' && `yoa`LIKE '%$ddate' && `capdate` LIKE '%$ddate' ";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);

   if ($result){
        while ($row = mysqli_fetch_array($result)){
                
        $amount+=$row['amount'];
    //sumfiled=$row['edtrate'];
         }
    }else{
                die(" Error in topvatinfo function".mysqli_error($conn));
    }
switch ($data){
   
     case 'numfiled':
        return $num;
        break;
     case 'sumfiled':   
     return $amount;
        break;
    
    }
       exit;	
}

function selfDeletevat($sno,$table,$coytin,$suser,$conn){
    // $sql="SELECT * FROM `$table` WHERE `tinno` like '$coytin' && `sno`like '$sno' ";
    $sql = "SELECT * FROM $table where `sno`='$sno' && `tinno`='$coytin'";
	
$coytin='';
$coyname='';
$assyr='';
$datecap='';
$capby='';
$amt='';
$asstype='';
$assno='';
$capdate='';
$tabletype='';
$action="";
$user='';
$taxoffice=getSetting('soname',$conn);
	
     $result=mysqli_query($conn,$sql);
    if ($result){
        while ($row = mysqli_fetch_array($result)){
    if ($table=='vatreg') {
        # code...
              // $capdate=$row[5];
$coytin=$row[1];
$coyname=trim(preg_replace('/\s\s+/', '', strtoupper(str_replace("'","",$row[2]))));
$assyr=$row[8];
$datecap=$row[10];
$capby=$row[13];
$citamt=number_format($row[9],2);
$edtamt=0;
$asstype="VAT Return";
$assno=$row[17];
$capdate=date('d-m-Y h:i:sa');
$tabletype=$table;
$action="Deleted";
$user=$suser;

    }else{

$coytin=$row[1];
$coyname=trim(preg_replace('/\s\s+/', '', strtoupper(str_replace("'","",$row[2]))));
$assyr=date('Y');
$datecap=$row[7];
$capby=$row[8];
$citamt=0;
$edtamt=0;
$asstype="VAT Filer";
$assno='VAT/FILER/'.$sno;
$capdate=date('d-m-Y h:i:sa');
$tabletype=$table;
$action="Deleted";
$user=$suser;

    }
                }   
        
       $query="INSERT INTO selfdelete (tinno,coyname,yoa,datecap,capby,cit,edt,asstype,assno,capdate,tabletype,action,user,taxoffice)VALUES ('$coytin','$coyname','$assyr','$datecap','$capby','$citamt','$edtamt','$asstype','$assno','$capdate','$tabletype','$action','$user','$taxoffice')";
    
        $result2 = mysqli_query($conn,$query);

         if(!$result2){ 

             die(" Error in SelfDelete Method function- Insert stmt".mysqli_error($conn));

            }
    
    
}else{
die(" Error in selfDelete Method function".mysqli_error($conn)); 
    
    }

return true;
exit;

}


function checkapp($d,$conn){
$show='';
$result=getSetting($d,$conn);
if ($result=='yes') {
    $show='pending';
}else{

    $show='approved';
}
return $show;

}


///////////TURNOVER//////////

function getcurrentinfo2($conn,$tin,$yoa){

        $sql = "SELECT * FROM current where `tinno`='$tin' && `yoa`='$yoa'  LIMIT 1";
        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die ('SQL Error: getcompinfo' . mysqli_error($conn));  
        }
        $amount="";
        while ($row = mysqli_fetch_array($query))
        {
        $amount=$row[9];
        }
if ($amount=='' || $amount==null ) {
    $amount=getbackinfo2($conn,$tin,$yoa);
}else {
    $amount=number_format($amount,2);# code...
}
 return $amount;
 mysqli_close($conn);
 exit;
}
function getbackinfo2($conn,$tin,$yoa){

        $sql = "SELECT * FROM back_year where `tinno`='$tin' && `yoa`='$yoa'  LIMIT 1";
        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die ('SQL Error: getcompinfo' . mysqli_error($conn));  
        }
        $amount="";
        while ($row = mysqli_fetch_array($query))
        {
        $amount=$row[9];
        }
if ($amount=='' || $amount==null ) {
    $amount=0; 
}else {
    $amount=number_format($amount,2);# code...
}
 return $amount;
 mysqli_close($conn);
 exit;
}

//////////////////////TURNOVER ENDS HERE////////////////////////////////

///////////ASS PROFIT STARTS//////////

function getcurrentinfo3($conn,$tin,$yoa){

        $sql = "SELECT * FROM current where `tinno`='$tin' && `yoa`='$yoa'  LIMIT 1";
        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die ('SQL Error: getcompinfo' . mysqli_error($conn));  
        }
        $amount="";
        while ($row = mysqli_fetch_array($query))
        {
        $amount=$row[11];
        }
if ($amount=='' || $amount==null ) {
    $amount=getbackinfo3($conn,$tin,$yoa);
}else {
    $amount=number_format($amount,2);# code...
}
 return $amount;
 mysqli_close($conn);
 exit;
}
function getbackinfo3($conn,$tin,$yoa){

        $sql = "SELECT * FROM back_year where `tinno`='$tin' && `yoa`='$yoa'  LIMIT 1";
        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die ('SQL Error: getcompinfo' . mysqli_error($conn));  
        }
        $amount="";
        while ($row = mysqli_fetch_array($query))
        {
        $amount=$row[11];
        }
if ($amount=='' || $amount==null ) {
    $amount=0; 
}else {
    $amount=number_format($amount,2);# code...
}
 return $amount;
 mysqli_close($conn);
 exit;
}

//////////////////////ASS PROFIT ENDS HERE////////////////////////////////



///////////TOTAL PROFIT STARTS//////////

function getcurrentinfo4($conn,$tin,$yoa){

        $sql = "SELECT * FROM current where `tinno`='$tin' && `yoa`='$yoa'  LIMIT 1";
        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die ('SQL Error: getcompinfo' . mysqli_error($conn));  
        }
        $amount="";
        while ($row = mysqli_fetch_array($query))
        {
        $amount=$row[10];
        }
if ($amount=='' || $amount==null ) {
    $amount=getbackinfo4($conn,$tin,$yoa);
}else {
    $amount=number_format($amount,2);# code...
}
 return $amount;
 mysqli_close($conn);
 exit;
}
function getbackinfo4($conn,$tin,$yoa){

        $sql = "SELECT * FROM back_year where `tinno`='$tin' && `yoa`='$yoa'  LIMIT 1";
        $query = mysqli_query($conn, $sql);

        if (!$query) {
            die ('SQL Error: getcompinfo' . mysqli_error($conn));  
        }
        $amount="";
        while ($row = mysqli_fetch_array($query))
        {
        $amount=$row[10];
        }
if ($amount=='' || $amount==null ) {
    $amount=0; 
}else {
    $amount=number_format($amount,2);# code...
}
 return $amount;
 mysqli_close($conn);
 exit;
}






function getcurrentinfo6($conn, $tin, $yoa)
{

    $sql = "SELECT * FROM current where `tinno`='$tin' && `yoa`='$yoa'  LIMIT 1";
    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die('SQL Error: getcompinfo' . mysqli_error($conn));
    }
    $amount = "";
    while ($row = mysqli_fetch_array($query)) {
        $amount = $row[30];
    }
    if ($amount == '' || $amount == null) {
        $amount = getbackinfo6($conn, $tin, $yoa);
    } else {
        $amount = number_format($amount, 2); # code...
    }
    return $amount;
    mysqli_close($conn);
    exit;
}
function getbackinfo6($conn, $tin, $yoa)
{

    $sql = "SELECT * FROM back_year where `tinno`='$tin' && `yoa`='$yoa'  LIMIT 1";
    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die('SQL Error: getcompinfo' . mysqli_error($conn));
    }
    $amount = "";
    while ($row = mysqli_fetch_array($query)) {
        $amount = $row[30];
    }
    if ($amount == '' || $amount == null) {
        $amount = "N/A";
    } else {
        $amount = number_format($amount, 2); # code...
    }
    return $amount;
    mysqli_close($conn);
    exit;
}
function getcurrentinfo7($conn, $tin, $yoa)
{

    $sql = "SELECT * FROM current where `tinno`='$tin' && `yoa`='$yoa'  LIMIT 1";
    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die('SQL Error: getcompinfo' . mysqli_error($conn));
    }
    $amount = "";
    while ($row = mysqli_fetch_array($query)) {
        $amount = $row[31];
    }
    if ($amount == '' || $amount == null) {
        $amount = getbackinfo7($conn, $tin, $yoa);
    } else {
        $amount = number_format($amount, 2); # code...
    }
    return $amount;
    mysqli_close($conn);
    exit;
}
function getbackinfo7($conn, $tin, $yoa)
{

    $sql = "SELECT * FROM back_year where `tinno`='$tin' && `yoa`='$yoa'  LIMIT 1";
    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die('SQL Error: getcompinfo' . mysqli_error($conn));
    }
    $amount = "";
    while ($row = mysqli_fetch_array($query)) {
        $amount = $row[31];
    }
    if ($amount == '' || $amount == null) {
        $amount = "N/A";
    } else {
        $amount = number_format($amount, 2); # code...
    }
    return $amount;
    mysqli_close($conn);
    exit;
}


function getcurrentinfo8($conn,$tin,$yoa)
{
    $sqlmain = 'CREATE TEMPORARY TABLE IF NOT EXISTS temp_self2 AS  SELECT * FROM lrpcurrent UNION  SELECT * FROM lrpback_year ';
    $query1 = mysqli_query($conn, $sqlmain);
    if (!$query1) {
        die('SQL Error: ' . mysqli_error($conn));
    } else {
        $sql = "SELECT * FROM temp_self2 where `tinno`='$tin' && `yoa`='$yoa' LIMIT 1";
    }
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        die('SQL Error: getcompinfo8' . mysqli_error($conn));
    }
    $amount = "";
    while ($row = mysqli_fetch_array($query)) {
        $amount = $row['amount'];
    }
    if ($amount == '' || $amount == null) {
                $amount = "N/A";
    } else {
         $amount = $amount; # code...
    }
    return $amount;
    mysqli_close($conn);
    exit;
}
function getcurrentinfo9($conn,$tin,$yoa)
{
    $sqlmain = 'CREATE TEMPORARY TABLE IF NOT EXISTS temp_self3 AS  SELECT tinno,yoa,capdate FROM current UNION  SELECT tinno,yoa,capdate FROM back_year ';
    $query1 = mysqli_query($conn, $sqlmain);
    if (!$query1) {
        die('SQL Error: ' . mysqli_error($conn));
    } else {
        $sql = "SELECT * FROM temp_self3 where `tinno`='$tin' && `yoa`='$yoa' LIMIT 1";
    }
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        die('SQL Error: getcompinfo9' . mysqli_error($conn));
    }
    $capdate = "";
    while ($row = mysqli_fetch_array($query)) {
        $capdate = $row['capdate'];
    }
    if ($capdate == '' || $capdate == null) {
        $capdate = "N/A";
    } else {
        $capdate = $capdate; # code...
    }
    return $capdate;
    mysqli_close($conn);
    exit;
}
//////////////////////TOTAL PROFIT ENDS HERE////////////////////////////////
function getnob($conn, $tin)
{
    $sqlmain = 'CREATE TEMPORARY TABLE IF NOT EXISTS temp_self3 AS  SELECT tinno,capdate,remark FROM current';
    $query1 = mysqli_query($conn, $sqlmain);
    if (!$query1) {
        die('SQL Error: ' . mysqli_error($conn));
    } else {
        $sql = "SELECT * FROM temp_self3 where `tinno`='$tin' LIMIT 1";
    }
    $query = mysqli_query($conn, $sql);
    if (!$query) {
        die('SQL Error: getnob' . mysqli_error($conn));
    }
    $capdate = "";
    while ($row = mysqli_fetch_array($query)) {
        $capdate = $row['remark'];
    }
    if ($capdate == '' || $capdate == null ) {
        $capdate = "N/A";
    } else {
        $capdate = $capdate; # code...
    }
    return $capdate;
    mysqli_close($conn);
    exit;
}
function checkNUMMonth2 ($var1,$var2) {
    // Creates DateTime objects
    
    // $var1 = '01/01/2021';
    // $var2 = '31/12/2021';
    $date1 = str_replace('/', '-', $var1);
    $date2 = str_replace('/', '-', $var2);
    
    $datetime1 = date_create($date1);
    $datetime2 = date_create($date2);
    
    // Calculates the difference between DateTime objects
    $interval = date_diff($datetime1,$datetime2);
    
    // Printing result in years & months format
    return $interval->format('%m');
    
    }
?>