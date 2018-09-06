<?php
	error_reporting(0);
	include "func.inc.php";
	$id = $_POST['id'];
	$mysql_info = json_decode(file_get_contents("mysql_info.json"));
	$con = mysql_connect($mysql_info->ip,$mysql_info->username,$mysql_info->password);
	mysql_select_db($mysql_info->dbname, $con);
	mysql_query("set names utf8");
	$sql = "SELECT * FROM outbound_record WHERE id =$id ";
	$result = mysql_query($sql,$con);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_free_result($result);
	echo json_encode($row);
	mysql_close($con);