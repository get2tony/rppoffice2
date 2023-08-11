<?php

include('config.php ');

function getSettings($data,$conn){

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
                }
		
		
}else{
        
        die(" Error in getsettings function".mysqli_error($conn));
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
    }
       

exit;	
	
}


function ResolveVat($amtraised,$amtpaid,$input,$pen){
	
	$inputtax=str_replace(',','',$input);
	$vatpaid=str_replace(',','',$amtpaid);
	$amountray=str_replace(',','',$amtraised);
	
	$totalvat=$amountray-$inputtax-$vatpaid;
	$vatint=$totalvat*0.29;
	
	if($pen=='on'){
		
		$totalsum=$totalvat+$vatint;
	}else{
		$totalsum=$totalvat;
	}
	
	return $totalsum;
}


function getShortmonth($no){

switch ($no){
    case '01':
        return "Jan";
        break;
    case '02':
        return "Feb";
        break;
    case '03':
        return "Mar";
        break;
    case '04':
        return "Apr";
        break;
    case '05':
        return "May";
        break;
    case '06':
        return "Jun";
        break;
    case '07':
        return "Jul";
        break;
    case '08':
        return "Aug";
        break;
     case '09':
        return "Sep";
        break;
     case '10':
        return "Oct";
        break;
     case '11':
        return "Nov";
        break;
     case '12':
        return "Dec";
        break;
    }
}

function getDuedate($yrend){

switch ($yrend){
    case 'January':
        return "31 July";
        break;
    case 'February':
        return "31 August";
        break;
    case 'March':
        return "30 September";
        break;
    case 'April':
        return "31 October";
        break;
    case 'May':
        return "30 November";
        break;
    case 'June':
        return "31 December";
        break;
    case 'July':
        return "31 January";
        break;
    case 'August':
        return "28 February";
        break;
     case 'September':
        return "31 March";
        break;
     case 'October':
        return "30 April";
        break;
     case 'November':
        return "31 May";
        break;
     case 'December':
        return "30 June";
        break;
    }
}
	
function getDuedatevat($yrend,$yoa){
 $year=$yoa;
	 
	
switch ($yrend){
    case 'January':
        return "21 February ".$year;
        break;
    case 'February':
        return "21 March ".$year;
        break;
    case 'March':
        return "21 April ".$year;
        break;
    case 'April':
        return "21 May ".$year;
        break;
    case 'May':
        return "21 June ".$year;
        break;
    case 'June':
        return "21 July ".$year;
        break;
    case 'July':
        return "21 August ".$year;
        break;
    case 'August':
        return "21 September ".$year;
        break;
     case 'September':
        return "21 October ".$year;
        break;
     case 'October':
        return "21 November ".$year;
        break;
     case 'November':
        return "21 December ".$year;
        break;
     case 'December':
		$year=$yoa+1;
        return "21 January ".$year;
        break;
    }
	
}

function getyrend($duedate){
    $w=substr($duedate,0,5);
switch ($w){
    case '31-07':
        return "January";
        break;
    case '31-08':
        return "February";
        break;
    case '30-09':
        return "March";
        break;
    case '31-10':
        return "April";
        break;
    case '30-11':
        return "May";
        break;
    case '31-12':
        return "June";
        break;
    case '31-01':
        return "July";
        break;
    case '28-02':
        return "August";
        break;
     case '31-03':
        return "September";
        break;
     case '30-04':
        return "October";
        break;
     case '31-05':
        return "November";
        break;
     case '30-06':
        return "December";
        break;
    case '31/07':
        return "January";
        break;
    case '31/08':
        return "February";
        break;
    case '30/09':
        return "March";
        break;
    case '31/10':
        return "April";
        break;
    case '30/11':
        return "May";
        break;
    case '31/12':
        return "June";
        break;
    case '31/01':
        return "July";
        break;
    case '28/02':
        return "August";
        break;
     case '31/03':
        return "September";
        break;
     case '30/04':
        return "October";
        break;
     case '31/05':
        return "November";
        break;
     case '30/06':
        return "December";
        break;
    case '31/7':
        return "January";
        break;
    case '31/8':
        return "February";
        break;
    case '30/9':
        return "March";
        break;
    case '31/1':
        return "July";
        break;
    case '28/2':
        return "August";
        break;
     case '31/3':
        return "September";
        break;
     case '30/4':
        return "October";
        break;
     case '31/5':
        return "November";
        break;
     case '30/6':
        return "December";
        break;
    }
}

function checkduplicate($conn,$tin,$asyr,$astype){
    
    $query="SELECT * FROM $astype WHERE `tinno`='$tin' && `yoa`='$asyr' && `assmt_type`='$astype'";
    

	$result=mysqli_query($conn,$query);
       $tinnos='';
			$assmtyr='';
			$assmttype='';
    if ($result){
		while ($row = mysqli_fetch_array($result)){
	               
			$tinnos=$row[1];
			$assmtyr=$row[6];
			$assmttype=$row[7];
				}
        
		}else{
        
        die(" Error in checkduplicate function".mysqli_error($conn));
    }
    
    if ($tinnos==$tin && $assmtyr==$asyr && $assmttype==$astype ){
        
	return true;
  	
	
    }
    return false;
}
function checkduplicateAdmin($conn,$tin,$asyr,$astype,$asno,$basis,$amt){
    
    $query="SELECT * FROM adminasreg WHERE `tinno`='$tin' && `yoa`='$asyr' && `taxtype`='$astype' && `asmtno`='$asno'&& `basis`='$basis' && `amount`='$amt'";
    

	$result=mysqli_query($conn,$query);
       $tinnos='';
       $assmttype='';
       $assno='';
       $assmtyr='';
       $basisp='';
       $amount='';
    if ($result){
		while ($row = mysqli_fetch_array($result)){
	               
			$tinnos=$row[1];
			$assmtyr=$row[4];
			$assmttype=$row[6];
            $assno=$row[8];
            $basisp=$row[9];
            $amount=$row[7];
				}
        
		}else{
        
        die(" Error in checkduplicate function".mysqli_error($conn));
    }
    
    if ($tinnos==$tin && $assmtyr==$asyr && $assmttype==$astype && $assno==$asno && $basisp==$basis && $amount==$amt){
        
	return true;
  	
	
    }
    return false;
}


function getAssmtNum($conn,$astype,$issue){
    
    
    $query="SELECT * FROM `$astype` WHERE capdate like '%".date('Y')."' ORDER BY sno DESC LIMIT 1";
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
    if ($result){
		while ($row = mysqli_fetch_array($result)){
	             $asnumber=$row[15];
                 $ayear=$row[16];
                 $capdate=$row[8];
				 $cdate=explode('/',$capdate);
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

function getADAssmtNum($conn,$astype,$taxtype,$issue){
    
    
    $query="SELECT * FROM $astype WHERE taxtype like '".$taxtype."' && capdate like '%".date('Y')."' ORDER BY sno ";
    $asnumber=0;
    $ayear=0;
    $capdate=0;
    $yeartx=substr(date('Y'),-2);
	$newcap=$issue;
	$ncap=explode('-',$newcap);
	$necap=$ncap[1];
	$necapy=$ncap[2];
    //$capdate=substr($capdate,-2);
	$cdate=0;
	$cadate=0;
	$cayear=0;
    
    $result=mysqli_query($conn,$query);
   $asnumber=mysqli_num_rows($result);
    if ($result){
		while ($row = mysqli_fetch_array($result)){
	             
                 $ayear=substr($row[4],-2);
                 //$capdate=$row[5];
            $capdate=$row[5];
			$cdate=explode('-',$capdate);
		    $cadate=$cdate[1];
			$cayear=$cdate[2];
				}    
        }else{
        
        die(" Error in getADAssmtNum function".mysqli_error($conn));
        }
       
            //$ayear=substr_replace('/','',$ayear);
            //$capdate=substr($capdate,-2);
    
        if($cadate>$necap && $necapy>$cayear){
           
            $asnumber=0;
            return $asnumber+1;
            exit;
        }
            
            return $asnumber+1;
            exit;
        
}

function getAssmtNumLRP($conn,$astype,$issue){
    
    
    
    $asnumber=0;
    $ayear=0;
    $capdate=0;
	$newcap=$issue;
	$ncap=explode('-',$newcap);
	$necap=$ncap[1];
	$necapy=$ncap[2];
    
	$cdate='';
	$cadate='';
	$cayear='';
	
    $query="SELECT * FROM `lrp$astype` WHERE capdate like '%".date('Y')."' && basis like 'LATE FILING' ORDER BY sno DESC LIMIT 1";
    $result=mysqli_query($conn,$query);
    if ($result){
		while ($row = mysqli_fetch_array($result)){
	            // $capdate=$row[5];
                 $asnumber=$row[9];
                 $ayear=$row[10];
                 $capdate=$row[5];
                 $cdate=explode('-',$capdate);
				 $cadate=$cdate[1];
				 $cayear=$cdate[2];
				}    
        }else{
        
        die(" Error in getAssmtNumLRP function".mysqli_error($conn));
        }
       
          //  $ayear=substr_replace('/','',$ayear);
           // $capdate=substr($capdate,-2);
    
       if($cadate>$necap && $necapy>$cayear){
           
            $asnumber=0;
            return $asnumber+1;
            exit;
        }
            
            return $asnumber+1;
            exit;
        
        }

function getAssmtNumLRPvat($conn,$astype,$issue){
    
    
    
    $asnumber=0;
    $ayear=0;
    $capdate=0;
	$newcap=$issue;
	$ncap=explode('-',$newcap);
	$necap=$ncap[1];
	$necapy=$ncap[2];
    
	$cdate='';
	$cadate='';
	$cayear='';
	
    $query="SELECT * FROM `lrp$astype` WHERE capdate like '%".date('Y')."' && tax  like 'VAT' ORDER BY sno DESC LIMIT 1";
    $result=mysqli_query($conn,$query);
    if ($result){
		while ($row = mysqli_fetch_array($result)){
	            // $capdate=$row[5];
                 $asnumber=$row[9];
                 $ayear=$row[10];
                 $capdate=$row[5];
                 $cdate=explode('-',$capdate);
				 $cadate=$cdate[1];
				 $cayear=$cdate[2];
				}    
        }else{
        
        die(" Error in getAssmtNumLRPvat function".mysqli_error($conn));
        }
       
          //  $ayear=substr_replace('/','',$ayear);
           // $capdate=substr($capdate,-2);
    
       if($cadate>$necap && $necapy>$cayear){
           
            $asnumber=0;
            return $asnumber+1;
            exit;
        }
            
            return $asnumber+1;
            exit;
        
        }


function getDueMonth($duedate,$yoa){
    

switch ($duedate){
    case '31 January':
        return "31-01-".$yoa;
        break;
    case '28 February':
        return "28-02-".$yoa;
        break;
    case '31 March':
        return "31-03-".$yoa;
        break;
    case '30 April':
        return "30-04-".$yoa;
        break;
    case '31 May':
        return "31-05-".$yoa;
        break;
    case '30 June':
        return "30-06-".$yoa;
        break;
    case '31 July':
        return "31-07-".$yoa;
        break;
    case '31 August':
        return "31-08-".$yoa;
        break;
     case '30 September':
        return "30-09-".$yoa;
        break;
     case '31 October':
        return "31-10-".$yoa;
        break;
     case '30 November':
        return "30-11-".$yoa;
        break;
     case '31 December':
        return "31-12-".$yoa;
        break;
    }
}

	function getDueMonthvat($duedate){
    $year=substr($duedate,-4);
	$duedate1=chop($duedate,substr($duedate,-5));
//	$duedate1=str_replace($year,'',$duedate);
switch ($duedate1){
    case '21 January':
        return "21-01-".$year;
        break;
    case '21 February':
        return "21-02-".$year;
        break;
    case '21 March':
        return "21-03-".$year;
        break;
    case '21 April':
        return "21-04-".$year;
        break;
    case '21 May':
        return "21-05-".$year;
        break;
    case '21 June':
        return "21-06-".$year;
        break;
    case '21 July':
        return "21-07-".$year;
        break;
    case '21 August':
        return "21-08-".$year;
        break;
     case '21 September':
        return "21-09-".$year;
        break;
     case '21 October':
        return "21-10-".$year;
        break;
     case '21 November':
        return "21-11-".$year;
        break;
     case '21 December':
        return "21-12-".$year;
        break;
    }
}
function checkLRP($duedate,$datecap,$yoa){
    
$duedatenew=date('Y-m-d',strtotime(getDueMonth($duedate,$yoa)));
$datecapnew=date('Y-m-d',strtotime($datecap));
    
$ts1 = strtotime($duedatenew);
$ts2 = strtotime($datecapnew);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
    
return $diff;  
    
}

function checkLRPvat($duedate,$datecap){
    
$duedatenew=date('Y-m-d',strtotime(getDueMonthvat($duedate)));
$datecapnew=date('Y-m-d',strtotime($datecap));
   $today=$datecapnew; 

// $ts1 = strtotime($duedatenew);
// $ts2 = strtotime($datecapnew);

//$year1 = date('Y', $ts1);
//$year2 = date('Y', $ts2);
$duda=explode('-',$duedatenew);
$capda=explode('-',$datecapnew);
	
$year1 = $duda[0];
$year2 = $capda[0];

//$month1 = date('m', $ts1);
//$month2 = date('m', $ts2);
	
$month1 = $duda[1];
$month2 = $capda[1];

$day1 = $duda[2];
$day2 = $capda[2];

$diff = (($year2 - $year1) * 12) + ($month2 - $month1);


$datediff = $datediff = strtotime($datecapnew) - strtotime($duedatenew);

// $ts2 - $ts1;
$defaultdays=$datediff / (60 * 60 * 24);

if($datediff>0){
	
	return $diff+1;
}else{
    
return $diff;  }
    
}


function amountLRP($diff,$conn){
    $lrp=(float)str_replace(',','',getSettings('lrpint',$conn));
    $lrp2=(float)str_replace(',','',getSettings('lrpsub',$conn));
    
    if($diff<1){
        
        return 0;
    }
    
    if ($diff==1){
        
        return $lrp;
        
    }else{
        
        return $lrp+(($diff-1)*$lrp2);
        
    }
}
	
function amountLRPvat($diff,$conn){
    $lsp=(float)str_replace(',','',getSettings('lspint',$conn));
    $lsp2=(float)str_replace(',','',getSettings('lspsub',$conn));
    
    if($diff<1){
        
        return 0;
    }
    
    if ($diff==1){
        
        return $lsp;
        
    }else{
        
        return $lsp+(($diff-1)*$lsp2);
        
    }
}

function checkduplicateLRP($conn,$astype,$tin,$asyr,$amount){
    
   $query="SELECT * FROM $astype WHERE `tinno` like '$tin' && `yoa` like '$asyr' && `amount` like '$amount'";
    

	$result=mysqli_query($conn,$query);
       $tinnos='';
    if ($result){
		while ($row = mysqli_fetch_array($result)){
	               
			$tinnos=$row[1];
			$assmtyr=$row[4];
			$amount1=$row[7];
            $capdate=$row[5];
            
				}
        
		}else{
        
        die(" Error in checkduplicateLRP function".mysqli_error($conn));
    }
    
    if ($tinnos==$tin && $assmtyr==$asyr && $amount1==$amount){
        
	  
        header('Location:duplicatelrp?msg='.$capdate);
  	
	exit;
    }
}
function checkduplicateLRPvat($conn,$astype,$tin,$asyr,$amount,$tax,$monthfiled){
    
   $query="SELECT * FROM $astype WHERE `tinno` = '$tin' && `yoa` = '$asyr' && `tax` = '$tax' && `amount` like '$amount' && `yearend` = '$monthfiled'";
    

	$result=mysqli_query($conn,$query);
       $tinnos='';
    if ($result){
		while ($row = mysqli_fetch_array($result)){
	               
			$tinnos=$row[1];
			$assmtyr=$row[4];
			$amount1=$row[7];
            $capdate=$row[5];
            $tax1=$row[18];
            $monthfiled2=$row[15];
            
				}
        
		}else{
        
        die(" Error in checkduplicateLRP function".mysqli_error($conn));
    }
    
    if ($tinnos==$tin && $assmtyr==$asyr && $amount1==$amount && $tax1==$tax && $monthfiled2==$monthfiled){
        
	  
        header('Location:duplicatelrp?msg='.$capdate);
  	
	exit;
    }
}

function checkNUMMonth($duedate,$datecap){
    
$duedatenew=date('Y-m-d',strtotime($duedate));
$datecapnew=date('Y-m-d',strtotime($datecap));
    
$ts1 = strtotime($duedatenew);
$ts2 = strtotime($datecapnew);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
    
return $diff;  
    
}

function LRPDelete($sno,$table,$coytin,$suser,$conn){
    // $sql="SELECT * FROM `$table` WHERE `tinno` like '$coytin' && `sno` like '$sno' ";
    $sql = "SELECT * FROM $table where `sno`='$sno'&&`tinno`='$coytin'";
     $result=mysqli_query($conn,$sql);
				 $sno='';
                 $coyname='';
                 $coytin='';
                 $yoa='';
                 $taxtype='';
                 $amount='';
                 $asnumber='';
                 $dm='';
                 $capdate='';
                 $tabletype='';
                 $action="";
                 $user='';
                 $taxoffice=getSettings('soname',$conn);
	
	
	
	
	
    if ($result){
		while ($row = mysqli_fetch_array($result)){
	            // $capdate=$row[5];
                 $sno=$row[0];
                 $coyname=trim(preg_replace('/\s\s+/', '', strtoupper(str_replace("'","",$row[2]))));
                 $coytin=$row[1];
                 $yoa=$row[4];
                 $taxtype=$row[6];
                 $amount=$row[7];
                 $asnumber=$row[8].$row[9].$row[10];
                 $dm=$row[14];
                 $capdate=date('d-m-Y h:i:sa');
                 $tabletype=$table;
                 $action="Deleted";
                 $user=$suser;
				}   
        
       $query="INSERT INTO lrpdelete (coyname,tinno,yoa,taxtype,amount,asmno,dmonth,tabletype,action,user,capdate,taxoffice)VALUES ('$coyname','$coytin','$yoa','$taxtype','$amount','$asnumber','$dm','$tabletype','$action','$user','$capdate','$taxoffice')";
    
        $result2 = mysqli_query($conn,$query);

         if(!$result2){ 

             die(" Error in LRPDelete Method function- Insert stmt".mysqli_error($conn));

            }
    
    
}else{
die(" Error in LRPDelete Method function".mysqli_error($conn)); 
    
    }

return true;
exit;

}

function selfDelete($sno,$table,$coytin,$suser,$conn){
    // $sql="SELECT * FROM `$table` WHERE `tinno` like '$coytin' && `sno`like '$sno' ";
    $sql = "SELECT * FROM $table where `sno`='$sno'&&`tinno`='$coytin'";
	
$coytin='';
$coyname='';
$assyr='';
$datecap='';
$capby='';
$citamt='';
$edtamt='';
$asstype='';
$assno='';
$capdate='';
$tabletype='';
$action="";
$user='';
$taxoffice=getSettings('soname',$conn);	
     $result=mysqli_query($conn,$sql);
    if ($result){
        while ($row = mysqli_fetch_array($result)){
                // $capdate=$row[5];
$coytin=$row[1];
$coyname=trim(preg_replace('/\s\s+/', '', strtoupper(str_replace("'","",$row[2]))));
$assyr=$row[6];
$datecap=$row[8];
$capby=$row[22];
$citamt=number_format($row[12],2);
$edtamt=number_format($row[13],2);
$asstype="Self Asmt";
$assno=$row[14].$row[15].$row[16];
$capdate=date('d-m-Y h:i:sa');
$tabletype=$table;
$action="Deleted";
$user=$suser;
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

function assDelete($sno,$table,$coytin,$suser,$conn){
    $sql = "SELECT * FROM $table where `sno`='$sno'&&`tinno`='$coytin'";
	
$coytin='';
$coyname='';
$assyr='';
$datecap='';
$taxtype='';
$amount='';
$asmno='';
$basis='';
$raisedby='';
$capdate='';
$tabletype='';
$actions='';
$user='';	
$taxoffice=getSettings('soname',$conn);
	
     $result=mysqli_query($conn,$sql);
    if ($result){
        while ($row = mysqli_fetch_array($result)){
                // $capdate=$row[5];
$coytin=$row[1] ;
$coyname=trim(preg_replace('/\s\s+/', '', strtoupper(str_replace("'","",$row[2]))));
$assyr=$row[4];
$datecap=$row[5];
$taxtype=$row[6];
$amount=$row[7];
$asmno=$row[8];
$basis=$row[9];
$raisedby=$row[12];
$capdate=date('d-m-Y h:i:sa');
$tabletype="Govt Asmt Register";
$actions="Deleted";
$user=$suser;
                }   
        
$query="INSERT INTO assdelete (tinno,coyname,yoa,datecap,taxtype,amount,asmno,basis,raisedby,capdate,tabletype,`action`,user,taxoffice)VALUES ('$coytin','$coyname','$assyr','$datecap','$taxtype','$amount','$asmno','$basis','$raisedby','$capdate','$tabletype','$actions','$user','$taxoffice')";
    
        $result2 = mysqli_query($conn,$query);

         if(!$result2){ 

             die(" Error in assDelete Method function- Insert stmt".mysqli_error($conn));

            }
    
    
}else{
die(" Error in assDelete Method function".mysqli_error($conn)); 
    
    }

return true;
exit;

}
function checkcomm($yrendyoa,$assyr){
	
	if ($yrendyoa==$assyr){
		$comm="yes";
	}else{
		$comm="no";
	}
	return $comm;
	exit;
}
function checkpen($pen,$amt){
	$nupen=0;
	if($pen=="on"){
		$nupen=$amt*0.29;
	}else{
		
		$nupen=0.00;
	}
	
	return $nupen;
	exit;
}

function checktodisplay($taxtype,$amount,$assprofit,$tprofit){
	 $dp="true";
	if ($taxtype=="CIT" && $tprofit==$amount){
		 $dp="false";
		
	}
	
	if($taxtype=="EDT" && $assprofit==$amount){
		$dp="false";
	}
	
	return $dp;
	exit;
}
 function ifempty($a){
	 
	 if($a==null){
		 $a=0.00;
	 }
	 
	 return $a;
	 exit;
 }

function checkUserstatus($suser,$conn){
	 $table="rppusers";
	 $level="user";
	 $sql="SELECT * FROM `$table` WHERE `user` LIKE '$suser'";
     $result=mysqli_query($conn,$sql);
	
    if ($result){
        while ($row = mysqli_fetch_array($result)){
                
$level=$row[3] ;

              }
	}
	return $level;
	exit;
}

function checkUserstatus2($sno,$conn){
	 $table="rppusers";
	 $level="user";
	 $sql="SELECT * FROM `$table` WHERE `sno` LIKE '$sno'";
     $result=mysqli_query($conn,$sql);
	
    if ($result){
        while ($row = mysqli_fetch_array($result)){
                
$level=$row[3] ;

              }
	}
	return $level;
	exit;
}

function checkApprovalstatus($assno,$sno,$conn){
	$table='adminasreg';
	$status="no";
	$approval="";
	
	
	$sql="SELECT * FROM `$table` WHERE `asmtno` like '$assno' && `sno` like '$sno' ";
     $result=mysqli_query($conn,$sql);
    if ($result){
        while ($row = mysqli_fetch_array($result)){
                // $capdate=$row[5];
			$approval=$row[18] ;	
	
		}
	
	}
	if ($approval=="approved"){
		
		$status="yes";
	}
	if ($approval==null){
		$status="maybe";
	}
	
	
	return $status;
	exit;
	
}
	
function amount_empty($b){
$a=$b;
if($a==''){
    $a=0;
}
return $a;
	exit;
}	


function returnAssvalue($f,$conn){
	$ddate=date('Y');

		$sum=0;
$sql= "SELECT amount FROM `adminasreg` WHERE `user` LIKE '$f' && `capdate`LIKE '%$ddate' ";

$query = mysqli_query($conn,$sql);

   if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
        }

   while ($row = mysqli_fetch_array($query)) {

             $sum += (float)str_replace(',', '', $row['amount']);
                }

                 
    return $sum;
	exit;
}

function returnAssvalue2($f,$taxtype,$conn){
	$ddate=date('Y');

		$sum=0;
		$scope='taxtype';
	
	if($taxtype=='BOJ'){
		$scope='basis';
	}
	
	
$sql= "SELECT amount FROM `adminasreg` WHERE `user` LIKE '".$f."'   && `".$scope."` LIKE '$taxtype' && `capdate` LIKE '%".$ddate."' ";

$query = mysqli_query($conn,$sql);

   if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
        }

   while ($row = mysqli_fetch_array($query)) {

             $sum += (float)str_replace(',', '', $row['amount']);
                }

                 
    return $sum;
	exit;
}

function returnLRPvalue($f,$conn){
	$ddate=date('Y');

		$sum=0;
		$sum2=0;
	$totsum=0;
$sql= "SELECT * FROM `lrpcurrent` WHERE `user` LIKE '$f' && `capdate`LIKE '%$ddate' ";
$sql2= "SELECT * FROM `lrpback_year` WHERE `user` LIKE '$f' && `capdate`LIKE '%$ddate' ";
$query = mysqli_query($conn,$sql);
$query2 = mysqli_query($conn,$sql2);

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
        }

   while ($row = mysqli_fetch_array($query)) {

             $sum += (float)str_replace(',', '', $row['amount']);
                }

if (!$query2) {
    die ('SQL Error: ' . mysqli_error($conn));
        }

   while ($row = mysqli_fetch_array($query2)) {

             $sum2 += (float)str_replace(',', '', $row['amount']);
                }

        $totsum= $sum + $sum2;          
    return $totsum;                 
   exit;
	
    
}

function returnAsscount($f,$conn){
	$ddate=date('Y');

		$num=0;
$sql= "SELECT amount FROM `adminasreg` WHERE `user` LIKE '$f' && `capdate`LIKE '%$ddate' ";
$query = mysqli_query($conn,$sql);
$num= mysqli_num_rows($query);

   return $num;
	exit;
}



function returnLRPcount($f,$conn){
	$ddate=date('Y');

		$num=0;
$sql= "SELECT * FROM `lrpcurrent` WHERE `user` LIKE '$f' && `capdate`LIKE '%$ddate' ";
$sql2= "SELECT * FROM `lrpback_year` WHERE `user` LIKE '$f' && `capdate`LIKE '%$ddate' ";
$query = mysqli_query($conn,$sql);
$query2 = mysqli_query($conn,$sql2);

$num= mysqli_num_rows($query);
$num2= mysqli_num_rows($query2);
$sum=$num + $num2;
   return $sum;
	exit;
    
}


function returnSelfcount($f,$conn){
	$ddate=date('Y');

		$num=0;
$sql= "SELECT * FROM `current` WHERE `user` LIKE '$f' && `capdate`LIKE '%$ddate' ";
$sql2= "SELECT * FROM `back_year` WHERE `user` LIKE '$f' && `capdate`LIKE '%$ddate' ";
$sql3= "SELECT * FROM `vatreg` WHERE `capby` LIKE '$f' && `capdate`LIKE '%$ddate' ";
$query = mysqli_query($conn,$sql);
$query2 = mysqli_query($conn,$sql2);
$query3 = mysqli_query($conn,$sql3);

$num= mysqli_num_rows($query);
$num2= mysqli_num_rows($query2);
$num3= mysqli_num_rows($query3);
$sum=$num + $num2 +$num3;
   return $sum;
	exit;
    
}
    

function returnUsername($sno,$conn){
	
	$name='';
	$sql="SELECT * FROM `rppusers` WHERE `sno` like '$sno' ";
     $result=mysqli_query($conn,$sql);
    if ($result){
        while ($row = mysqli_fetch_array($result)){
                // $capdate=$row[5];
			$name=$row[4].' '.$row[5] ;	
	
		}
	
	}
	
	return $name;
	exit;
}

    ?>