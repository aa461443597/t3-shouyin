<?php
	error_reporting(0);
	include "func.inc.php";
	$user_name = $_POST['user_name'];
	$password = $_POST['password'];
	$mysql_info = json_decode(file_get_contents("mysql_info.json"));
	$con = mysql_connect($mysql_info->ip,$mysql_info->username,$mysql_info->password);
	mysql_select_db($mysql_info->dbname, $con);
	mysql_query("set names utf8");
	$sql = "SELECT count(*) ccount FROM login_admin WHERE user_name = '$user_name' and password = '$password' ";
	$result = mysql_query($sql,$con);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);

	if($row["ccount"] == 0){
		echo "0";
		exit;
	}
	$sql = "SELECT * FROM login_admin WHERE user_name = '$user_name' and password = '$password' ";
	$result = mysql_query($sql,$con);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);

	mysql_free_result($result);
	echo json_encode($row);
	mysql_close($con);