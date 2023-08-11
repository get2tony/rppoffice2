<?php
/*
@docStart
	@author			Gerry Danen - adapted from a class by Hossein Sarlak
	@name			danenMysqlBackup
	@version		2.0.0
	@date			26 February 2015
	@title			Back up data from MySQL database
	@description	Back up one, several, or all tables in a MySQL database.
					Converted to mysqli.
	@example
					$backup = new danenMysqlBackup('tableName');
					$backup = new danenMysqlBackup();
						and
					$tables=array('table1','table2','table3');
					$backup = New danenMysqlBackup($tables);
						then
					$file = $backup->backupStart();

	@note			Look for FIXME in the code to find where customizations are needed.
@docEnd
*/


class danenMysqlBackup
{
	private static $className			= __CLASS__;
	private static $classVersion		= '2.0.0';
	private static $classVersionDate	= '26 February 2015';
	private static $classAuthor			= 'Gerry Danen';
	private static $dataPath			= 'dbbackups/';  // don't put in document root

	private $hostname;
	private $username;
	private $password;
	private $database;
	private $backupTable;
	private $backupDump;
	private $connection;


	public function __construct( $tables=NULL )
	{
		$result = self::getCredentials();  	// get connection credentials - customize for your environment
		$this->hostname		= $result['hostname'];
		$this->username		= $result['username'];
		$this->password		= $result['password'];
		$this->database		= $result['database'];
		$this->backupTable	= $tables;
		if ( strstr(self::$dataPath, '/FIXME/' ) )
			die( 'Please configure private static $dataPath in class '. __CLASS__ . '.<br>'.
				'This is where the backup file will be written, so make sure that folder is writable!' );
	}


	public function backupStart()
	{
		//	the next 3 statements do not really belong here. customize for your environment.  FIXME

		//	do not time out
		set_time_limit(0);
		//	do not restrict memory
		ini_set("memory_limit", -1 );
		//	prevent date warnings about server timezone
		date_default_timezone_set('UTC');

		$this->databaseConnect();
		$MySQLinfo			= $this->backupMySQLinfo();
		$tableList			= $this->backupTableList();
		$host				= $this->hostname;
		$dBase				= $this->database;
		$user				= $MySQLinfo[1];
		$sVersion			= $MySQLinfo[0];
		$stamp				= date("j M Y") .' at '. date("G:ia");
		$className			= self::$className;
		$classVersion		= self::$classVersion;
		$classVersionDate	= self::$classVersionDate;
		$classAuthor		= self::$classAuthor;
		$dasher				= '--------------------------------------------------------';

		$this->backupDump	= <<< EOT
--
-- $dasher
-- "$className" - MySQL Backup by $classAuthor
-- Version $classVersion ($classVersionDate)
--
-- Host:           $host
-- Database:       $dBase
-- User:           $user
--
-- Generated:      $stamp (UTC)
-- Server version: $sVersion
-- $dasher

EOT;
		if ( $this->backupTable )
		{
			foreach ( $this->backupTable as $value )
			{
				$this->backupTableInfo($value);
				$this->backupColumns($value);
			}
		}
		else
		{
			if ( $tableList )
			{
				foreach ( $tableList as $value )
				{
					$this->backupTableInfo($value);
					$this->backupColumns($value);
				}
			}
		}
		$result = $this->backupCreated();
		return $result;
	}


	private function databaseConnect()
	{
		//	create a MySQLi connection based on earlier retrieved credentials
		$this->connection = new mysqli( $this->hostname, $this->username, $this->password, $this->database );
		if ( mysqli_connect_errno() )
		{
			$error = mysqli_connect_error();
			trigger_error( __CLASS__ . ": there was an error connecting to the database - $error\n" );
			die();
		}
		$this->connection->query( "SET character_set_results = 'utf8'" );
	}


	private function backupMySQLinfo()
	{
		$out	= array();
		$out[] 	= $this->connection->server_info;
		$result	= $this->connection->query("SELECT user();");
		$iRow  	= $result->fetch_array(MYSQLI_ASSOC);
		$out[] 	= $iRow['user()'];
		return $out;

	}


	private function backupTableList()
	{
		$out = array();
		$iResult = $this->connection->query("SHOW TABLES ;");
		while( $iRow = $iResult->fetch_array() )
		{
			$out[] = $iRow[0];
		}
		return $out;
	}


	private function backupTableInfo( $TABLE )
	{
		$this->backupDump .= <<< EOT

--
-- -- Structure for `$TABLE`
--

EOT;
		$iResult = $this->connection->query( "SHOW CREATE TABLE $TABLE" );
		$iRow = $iResult->fetch_array();
		$iRow1 = $iRow[1];
		$out = <<< EOT
DROP TABLE IF EXISTS `$TABLE`;
$iRow1

EOT;
		$out = str_replace( 'CREATE TABLE `', 'CREATE TABLE IF NOT EXISTS `', $out);
		$this->backupDump .= $out;
	}


	private function backupColumns( $TABLE )
	{
		$out ='';
		$iResult = $this->connection->query( "Select * From $TABLE" );
		$iResult_iRow = $iResult->num_rows;
		if ( $iResult_iRow )
		{
			$out = <<< EOT

--
-- -- Data for `$TABLE`
--
INSERT INTO `$TABLE` VALUES

EOT;
		}
		$iResult = $this->connection->query( "SHOW COLUMNS FROM $TABLE" );
		$iResult_iRow = $iResult->num_rows;

		$this->backupDump .= $out ;
		$this->backupColumnsValues( $TABLE, $iResult_iRow );
	}


	private function backupColumnsValues( $TABLE, $Tcc )
	{
		$out		= '';
		$iResult	= $this->connection->query( "Select * From $TABLE" );
		$iResult_iRow = $iResult->num_rows;

		for ( $ir=1 ; $ir <= $iResult_iRow ; $ir++ )
		{
			$iRow = $iResult->fetch_array();
			$out .= "(";
			for ( $i=1 ; $i <= $Tcc ; $i++ )
			{
				if ( $i == $Tcc )
					$out .= "'".str_replace("'","''",$iRow[$i-1])."'";
				else
					$out .= "'".str_replace("'","''",$iRow[$i-1])."',";
			}
			if ( $ir == $iResult_iRow )
				$terminator = ';';
			else
				$terminator = ',';
			$out .= ")$terminator\n";
		}
		$this->backupDump .= $out;
	}


	private function backupCreated()
	{
		$this->backupDump .= "\n\n-- End of backup\n";
		$num3		= substr(time(), -3);	//	last 3 digits
		$stamp		= date('ymd_Hi');
		$tableList	= '';
		if ( $this->backupTable )
		{
			foreach ( $this->backupTable as $value )
			{
				$tableList .= "_$value";
			}
		}
		else
		{
			$tableList = "_FULL";
		}
		$fileName 	= $this->database . "{$tableList}_{$stamp}_{$num3}.sql.gz";
		$fileName 	= str_replace( "(-", "_", $fileName );
		$fileName 	= str_replace( "-", "_", $fileName );
		$compressed	= gzencode( $this->backupDump, 9 );
		$filePath	= self::$dataPath . $fileName ;
		$fHandle	= fopen( $filePath, "wb" );
		$success	= fwrite( $fHandle, $compressed );
		fclose( $fHandle );
		if ( $success )
			return $filePath;
		else
			return FALSE;
	}


	private function getCredentials()
	{
		//	adapt to your environment -- FIXME
		$credentials = array();
		$credentials['hostname'] = 'localhost';
		$credentials['username'] = 'root';
		$credentials['password'] = 'root';
		$credentials['database'] = 'rppoffice';
		return $credentials;
	}


}// end of class


