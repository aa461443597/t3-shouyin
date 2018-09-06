<?php
	error_reporting(0);
	include "func.inc.php";
	$id = $_POST['id'];
	$bar_code = $_POST['bar_code'];
	$outbound_count = $_POST['outbound_count'];
	$mysql_info = json_decode(file_get_contents("mysql_info.json"));
	$con = mysql_connect($mysql_info->ip,$mysql_info->username,$mysql_info->password);
	mysql_select_db($mysql_info->dbname, $con);
	mysql_query("set names utf8");
	$sql = "DELETE FROM outbound_record WHERE id ='$id';";
	mysql_query($sql, $con);
	$sql= "update commodity_data set commodity_now_count = commodity_now_count + $outbound_count where bar_code = '$bar_code'";
	try{
		mysql_query($sql, $con);
		//echo $sql;
		echo "1";
	}catch(Exception $e){
		echo "0".$e->getMessage();
		exit();
	}
	mysql_close($con);