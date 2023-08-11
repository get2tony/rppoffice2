<?php

/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*'){
	
	$link = mysqli_connect($host,$user,$pass,$name);
	
	//get all of the tables
	if($tables == '*'){
		$tables = array();
		$result = mysqli_query($link,'SHOW TABLES');
		while($row = mysqli_fetch_row($result)){
			$tables[] = $row[0];
		}
	}
	else{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
    $return='';
    $j='';
	foreach($tables as $table){
		$result = mysqli_query($link,'SELECT * FROM `'.$table.'`');
		$num_fields = mysqli_num_fields($result);
		$return.='DROP TABLE `'.$table.'`;';
		$row2 = mysqli_fetch_row(mysqli_query($link,'SHOW CREATE TABLE `'.$table.'`'));
		
		
		for ($i = 0; $i < $num_fields; $i++) {
			while($row = mysqli_fetch_row($result)){
				$return.="INSERT INTO `".$table."` VALUES (";
				for($j=0; $j < $num_fields; $j++) {
                   
					$jfromdb = $row[$j];
					$jfromdb = addslashes($jfromdb);
					$jfromdb = preg_replace("/\n/","\\n",$jfromdb);//'/looking for/', 'replace with', $in this text
					if (isset($jfromdb)) { $return.= "'".$jfromdb."'" ; } else { $return.= "''"; }
					if ($j < ($num_fields-1)) { $return.= ","; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
            //save file
        $filename = "dbbackups/db-backup".date('d-m-Y').".sql";
        $gzfilename = $filename.".gz";
        
        $handle = fopen($filename,'w+');
    
        fwrite($handle,$return);
        fclose($handle);

        $fp = gzopen ($gzfilename, 'w9');
        gzwrite($fp, file_get_contents($filename));
        gzclose($fp);
}
?>
