<?php
	error_reporting(0);
	include "func.inc.php";
	$bar_code = $_POST['bar_code'];
	$commodity_name = $_POST['commodity_name'];
	$commodity_price = $_POST['commodity_price'];
	$commodity_cost_price = $_POST['commodity_cost_price'];
	$commodity_total_count = $_POST['commodity_total_count'];
	$commodity_now_count = $_POST['commodity_now_count'];
	$commodity_pic_url = $_POST['commodity_pic_url'];
	$commodity_remark = $_POST['commodity_remark'];
	$last_operator = $_POST['last_operator'];
	$last_time = $_POST['last_time'];
	$catalog_name = $_POST['catalog_name'];



	$mysql_info = json_decode(file_get_contents("mysql_info.json"));
	$con = mysql_connect($mysql_info->ip,$mysql_info->username,$mysql_info->password);
	mysql_select_db($mysql_info->dbname, $con);
	mysql_query("set names utf8");
	$sql="UPDATE commodity_data SET catalog_name='$catalog_name', commodity_name= '$commodity_name', commodity_price=$commodity_price, commodity_cost_price=$commodity_cost_price, ".
	 " commodity_total_count=$commodity_total_count, commodity_now_count=$commodity_now_count, commodity_pic_url='$commodity_pic_url', commodity_remark='$commodity_remark', ".
	 " last_operator='$last_operator', last_time='$last_time' WHERE bar_code='$bar_code' ";
	try{
		mysql_query($sql, $con);
		echo "1";
		//echo $sql;
	}catch(Exception $e){
		echo "0".$e->getMessage();
		exit();
	}
	mysql_close($con);
