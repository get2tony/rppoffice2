<?php 
ini_set("memory_limit", "-1");
include_once(dirname(__FILE__) . '/dbconfig/config.php');

include_once(dirname(__FILE__) . '/dbconfig/methods.php');
include_once('vatmethods.php');

$errormsg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : null;
$errormsg2 = isset($_REQUEST['msg2']) ? $_REQUEST['msg2'] : null;
$suser = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
// $tab = isset($_REQUEST['tab']) ? $_REQUEST['tab'] : null;
$usersno = isset($_REQUEST['sno']) ? $_REQUEST['sno'] : null;
// $ddate=date('Y');
//$tableName="masterlist";	
	define("num",null,true);	
	$targetpage = "tablevat2.php"; 	
	$limit =90; 
	
	$query = "SELECT * FROM `vatlist`";
	$resulta= mysqli_query($conn,$query);
	
	
	$total_pages = mysqli_num_rows($resulta);
	$total_pages = $total_pages +1;
	//isset($total_pages[num])? $total_pages[num]:null;
	
	$stages = 3;
	$dpage=isset($_REQUEST['page'])? $_REQUEST['page']:null;
	$page = mysqli_escape_string($conn,$dpage);
	if($page){
		$start = ($page - 1) * $limit; 
	}else{
		$start = 0;	
		}	
	
    // Get page data
	$query1 = "SELECT * FROM `vatlist` LIMIT $start, $limit";
	
	$result = mysqli_query($conn,$query1);
	$slength=mysqli_num_rows($result); 
	
	// Initial page num setup
	if ($page == 0){$page = 1;}
	$prev = $page - 1;	
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;					
	
	
	$paginate = '';
	if($lastpage > 1)
	{	
	

	
	
		$paginate .= "<div class='paginate'>";
		// Previous
		if ($page > 1){
			$paginate.= "<a href='$targetpage?page=$prev'>previous</a>";
		}else{
			$paginate.= "<span class='disabled'>previous</span>";	}
			

		
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$paginate.= "<span class='current'>$counter</span>";
				}else{
					$paginate.= "<a href='$targetpage?page=$counter&numb=$slength'>$counter</a>";}					
			}
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter&numb=$slength'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage?page=$LastPagem1&numb=$slength'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage?page=$lastpage&numb=$slength'>$lastpage</a>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<a href='$targetpage?page=1&numb=$slength'>1</a>";
				$paginate.= "<a href='$targetpage?page=2&numb=$slength'>2</a>";
				$paginate.= "...";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter&numb=$slength'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage?page=$LastPagem1&numb=$slength'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
			}
			// End only hide early pages
			else
			{
				$paginate.= "<a href='$targetpage?page=1&numb=$slength'>1</a>";
				$paginate.= "<a href='$targetpage?page=2&numb=$slength'>2</a>";
				$paginate.= "...";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter&numb=$slength'>$counter</a>";}					
				}
			}
		}
					
				// Next
		if ($page < $counter - 1){ 
			$paginate.= "<a href='$targetpage?page=$next&numb=$slength'>next</a>";
		}else{
			$paginate.= "<span class='disabled'>next</span>";
			}
			
		$paginate.= "</div>";		
	
	
}
 //echo $total_pages.' Results';
 // pagination
// echo $paginate;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>RPP Office VAT Compliance Register </title>

 <link rel="stylesheet" href="css3/bootstrap.min.css">
   

<style>
.paginate {
font-family:Arial, Helvetica, sans-serif;
	padding: 3px;
	margin: 3px;
}

.paginate a {
	padding:2px 5px 2px 5px;
	margin:2px;
	border:1px solid #999;
	text-decoration:none;
	color: #666;
}
.paginate a:hover, .paginate a:active {
	border: 1px solid #999;
	color: #000;
}
.paginate span.current {
    margin: 2px;
	padding: 2px 5px 2px 5px;
		border: 1px solid #999;
		
		font-weight: bold;
		background-color: #999;
		color: #FFF;
	}
	.paginate span.disabled {
		padding:2px 5px 2px 5px;
		margin:2px;
		border:1px solid #eee;
		color:#DDD;
	}
	
	li{
		padding:4px;
		margin-bottom:3px;
		background-color:#FCC;
		list-style:none;}
		
	ul{margin:6px;
	padding:0px;}	
	
</style>
<script src="jquery.min.js"></script>
	<script src="jquery.table2excel.js"></script>
</head>

<body>
<div >
    <div class="row main">
	<br>
    <!-- <div class="col-lg-4"> </div> -->
	<div id="showcount" class="text-center"><font   color="red" ><?php echo $total_pages ?> Record(s) Found</font></div><br>
    <div class="col-lg-4"><button> Export to Excel</button></div>
    <div class="col-lg-4"> <div class="form-group has-feedback has-search">
    <!-- <span class="glyphicon glyphicon-search form-control-feedback"></span> -->
   <?php echo $paginate; ?>
  </div></div>
    <div class="col-lg-4"></div>

   </div>
    

	</div>
	<div>
		
	<table id="table2excel" class="table table_bordered" width="100%" border="1" bordercolor="#DDDDDD"  >
								<thead>
            <tr>
                <th>S/No.</th>
                <th>Company</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Tin</th>
                <th>NOB</th>
                <th>Category</th>
                <?php 
                $m=date('m');
                for ($i=1; $i <= $m ; $i++) { 
                    echo '
                   <th>'.getFullmonth($i).'</th>
                    <th>Received Date</th>
                     <th>Payment Date</th> 
                     <th>Days Late</th>  
                    
                    ';
                }
                
                ?>
               
               
            </tr>
        </thead>
        <tbody>





<ul>

<?php 

$sno=0;
$ssno=isset($_REQUEST['numb'])? $_REQUEST['numb']: "";

if ($ssno==""){
	$sno=1;
}else{
	$sno= $sno +1;
}

		  while ($row = mysqli_fetch_array($result))
        {
		
		
            echo '<tr>

                
                    <td>'.$row['sno'].'</td>
                    <td>'.$row['coyname'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.$row['tinno'].'</td>
                     <td>'.$row['nob'].'</td>
                    <td>'.ucfirst($row['category']).'</td>';
                    $m=date('m');
                for ($i=1; $i <= $m ; $i++) { 
                    echo '
                   <td>'.getfileinfo($conn,$row['tinno'],getFullmonth($i),'amount').'</td>
                   <td>'.getfileinfo($conn,$row['tinno'],getFullmonth($i),'file').'</td>
                   <td>'.getfileinfo($conn,$row['tinno'],getFullmonth($i),'pay').'</td>
                   <td>'.getfileinfo($conn,$row['tinno'],getFullmonth($i),'day').'</td>
                  
                   
                    
                    ';
                }
     echo '     
                </tr>';
				
			
                       
            
            $sno++;
        }?>
            

        </tbody>
    </table>

									</td>
								</tr>
				</table>
						</div>
						</td>
					</tr>
				</table>
				<p>&nbsp; <font color="Blue"></font></td>
			</tr>
		</table>
		</form>
		<?php echo $paginate ?> 
	</div>
	<div align="center">
		
	</div>
</div>
	
    <script> $("button").click(function(){
	  $("#table2excel").table2excel({
	    // exclude CSS class
	    exclude: ".noExl",
	    name: "Download"
	  });
	});</script>
    
    
    

</body>
</html>
    
    