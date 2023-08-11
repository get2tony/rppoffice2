<?php
//	example to do a full database backup

require_once 'danenMysqlBackup.class.php';


$B = new danenMysqlBackup();

$backupSqlFile = $B->backupStart();

if ( $backupSqlFile )
{
	$backupSqlFile = basename( $backupSqlFile );
	echo "Created: $backupSqlFile";
}
else
	echo "ERROR: backup failed.";

