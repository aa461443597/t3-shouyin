<?php
	error_reporting(0);
	include "func.inc.php";

	$openid = $_POST['openid'];
	$member_name = $_POST['member_name'];
	$member_birthday = $_POST['member_birthday'];
	$member_score = $_POST['member_score'];
	$member_mobile = $_POST['member_mobile'];
	$member_level = $_POST['member_level'];
	$last_operator = $_POST['last_operator'];
	$last_time = $_POST['last_time'];


	$mysql_info = json_decode(file_get_contents("mysql_info.json"));
	$con = mysql_connect($mysql_info->ip,$mysql_info->username,$mysql_info->password);
	mysql_select_db($mysql_info->dbname, $con);
	mysql_query("set names utf8");

	$sql = "SELECT count(*) as ccount FROM member_info WHERE openid ='$openid' ";
	$result = mysql_query($sql,$con);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);

	if($row["ccount"] > 0 ){
		echo "0"; //已有数据
		exit();
	}


	$member_card_no = substr($member_mobile, 7,4).rand(9999);
	$sql="INSERT INTO member_info (id, member_card_no, member_name,member_birthday,member_score,member_mobile,member_level,last_operator,last_time) ".
	" VALUES (null,'$member_card_no','$member_name', '$member_birthday',$member_score,'$member_mobile','$member_level','$last_operator','$last_time')";
	try{
		mysql_query($sql, $con);

		echo "1"; //插入成功
	}catch(Exception $e){
		echo "0".$e->getMessage();
		exit();
	}
	mysql_close($con);
