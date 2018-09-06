<?php
	error_reporting(0);
	include "func.inc.php";

	$openid = $_POST['openid'];
	$refund_way = $_POST['refund_way'];
	$refund_remark = $_POST['refund_remark'];
	$order_details_id = $_POST['order_details_id'];
	$refund_operator = $_POST['refund_operator'];
	$last_operator = $_POST['last_operator'];
	$last_time = $_POST['last_time'];


	$mysql_info = json_decode(file_get_contents("mysql_info.json"));
	$con = mysql_connect($mysql_info->ip,$mysql_info->username,$mysql_info->password);
	mysql_select_db($mysql_info->dbname, $con);
	mysql_query("set names utf8");

	$sql="INSERT INTO refund_record (id, refund_status,openid, refund_way,refund_remark,order_details_id,refund_operator,last_operator,last_time) ".
	" VALUES (null,'已提交','$openid','$refund_way', '$refund_remark',$order_details_id,'$refund_operator','$last_operator','$last_time')";
	try{
		mysql_query($sql, $con);
    //echo $sql;
		echo "1"; //插入成功
	}catch(Exception $e){
		echo "0".$e->getMessage();
		exit();
	}
	mysql_close($con);
