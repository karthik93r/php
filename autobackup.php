<?php
// Created by Karthik R
ini_set("display_errors","1");
error_reporting(E_ALL) ;

$MysqlHost = "localhost";
$MysqlUser = "root";
$MysqlPassword = "";
//$MysqlPassword = "1234";
$databasename  = "smartechart";

$todayDate = date("Y_m_d",time());
$backupPath = "/var/www/database_backup/auto_backup/";

$backupName = $backupPath.$databasename."_".$todayDate.".sql.gz";

$dbBackup = "/usr/bin/mysqldump  --opt  -u$MysqlUser -h$MysqlHost --password=$MysqlPassword $databasename | gzip  > $backupName " ;
$dbOutput = shell_exec($dbBackup);

$fileName = $backupPath.$databasename."_".date('Y_m_d',strtotime('-10 days')).".sql.gz";

$check = str_replace('/var/www', '../..',$fileName);
if(is_file($check)) {
	$cmd = "rm -f $fileName";
	exec($cmd,$res,$r);
}

?>
