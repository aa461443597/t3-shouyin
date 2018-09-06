<?php
	error_reporting(0);
	include "func.inc.php";

	$bar_code = $_POST['bar_code'];
	$commodity_name = $_POST['commodity_name'];
	$outbound_count = $_POST['outbound_count'];
	$outbound_date = $_POST['outbound_date'];
	$outbound_address = $_POST['outbound_address'];
	$last_operator = $_POST['last_operator'];
	$last_time = $_POST['last_time'];
	$outbound_remark = $_POST['outbound_remark'];


	$mysql_info = json_decode(file_get_contents("mysql_info.json"));
	$con = mysql_connect($mysql_info->ip,$mysql_info->username,$mysql_info->password);
	mysql_select_db($mysql_info->dbname, $con);
	mysql_query("set names utf8");

	$sql="INSERT INTO outbound_record (id,outbound_remark,bar_code, commodity_name, outbound_count,outbound_date,outbound_address,last_operator,last_time) ".
	" VALUES (null,'$outbound_remark','$bar_code','$commodity_name', $outbound_count,'$outbound_date','$outbound_address','$last_operator','$last_time')";
	try{
		mysql_query($sql, $con);
		$sql= "update commodity_data set commodity_now_count = commodity_now_count - $outbound_count where bar_code = '$bar_code'";
		mysql_query($sql, $con);
		echo "1"; //插入成功
	}catch(Exception $e){
		echo "0".$e->getMessage();
		exit();
	}
	mysql_close($con);
