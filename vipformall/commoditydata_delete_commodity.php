<?php
	error_reporting(0);
	include "func.inc.php";
	$bar_code = $_POST['bar_code'];
	$mysql_info = json_decode(file_get_contents("mysql_info.json"));
	$con = mysql_connect($mysql_info->ip,$mysql_info->username,$mysql_info->password);
	mysql_select_db($mysql_info->dbname, $con);
	mysql_query("set names utf8");
	$sql = "DELETE FROM commodity_data WHERE bar_code ='$bar_code';";
	mysql_query($sql, $con);
	$sql = "DELETE FROM discount_commodity WHERE bar_code ='$bar_code';";
	try{
		mysql_query($sql, $con);
	//	echo $sql;
		echo "1";
	}catch(Exception $e){
		echo "0".$e->getMessage();
		exit();
	}
	mysql_close($con);