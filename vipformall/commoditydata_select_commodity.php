<?php
	error_reporting(0);
	include "func.inc.php";
	$bar_code = $_POST['bar_code'];
	$mysql_info = json_decode(file_get_contents("mysql_info.json"));
	$con = mysql_connect($mysql_info->ip,$mysql_info->username,$mysql_info->password);
	mysql_select_db($mysql_info->dbname, $con);
	mysql_query("set names utf8");


	$sql = "SELECT * FROM commodity_data WHERE bar_code ='$bar_code' or   commodity_name like '%$bar_code%' or catalog_name like '%$bar_code%' or commodity_remark like '%$bar_code%' or last_operator like '%$bar_code%'";
	//echo $sql;
	$result = mysql_query($sql,$con);
	$res = array();
	while ( $row = mysql_fetch_array($result, MYSQL_ASSOC) ){
		$res[] = $row;
	}

	mysql_free_result($result);
	echo json_encode($res);
	mysql_close($con);