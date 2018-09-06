<?php
	error_reporting(0);
	include "func.inc.php";
	$id = $_POST['id'];
	$member_card_no = $_POST['member_card_no'];
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
	$sql="UPDATE member_info SET  member_card_no= '$member_card_no', member_name='$member_name', member_birthday='$member_birthday', ".
	 " member_score=$member_score, member_mobile='$member_mobile', member_level='$member_level', ".
	 " last_operator='$last_operator', last_time='$last_time' WHERE id=$id ";
	try{
		mysql_query($sql, $con);
		echo "1";
		//echo $sql;
	}catch(Exception $e){
		echo "0".$e->getMessage();
		exit();
	}
	mysql_close($con);
