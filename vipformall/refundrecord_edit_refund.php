<?php
	error_reporting(0);
	include "func.inc.php";
	$id = $_POST['id'];
	$refund_way = $_POST['refund_way'];
	$refund_remark = $_POST['refund_remark'];
	$order_details_id = $_POST['order_details_id'];
	$refund_status = $_POST['refund_status'];
	$refund_operator = $_POST['refund_operator'];
	$last_operator = $_POST['last_operator'];
	$last_time = $_POST['last_time'];



	$mysql_info = json_decode(file_get_contents("mysql_info.json"));
	$con = mysql_connect($mysql_info->ip,$mysql_info->username,$mysql_info->password);
	mysql_select_db($mysql_info->dbname, $con);
	mysql_query("set names utf8");
	$sql="UPDATE refund_record SET  refund_status = '$refund_status' , refund_way= '$refund_way', refund_remark='$refund_remark', order_details_id=$order_details_id, ".
	 "  refund_operator='$refund_operator', ".
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
