<?php
	error_reporting(0);
	include "func.inc.php";
	$id = $_POST['id'];
	$bar_code = $_POST['bar_code'];
	$commodity_name = $_POST['commodity_name'];
	$commodity_price = $_POST['commodity_price'];
	$commodity_after_discount_price = $_POST['commodity_after_discount_price'];
	$last_operator = $_POST['last_operator'];
	$last_time = $_POST['last_time'];



	$mysql_info = json_decode(file_get_contents("mysql_info.json"));
	$con = mysql_connect($mysql_info->ip,$mysql_info->username,$mysql_info->password);
	mysql_select_db($mysql_info->dbname, $con);
	mysql_query("set names utf8");
	$sql="UPDATE discount_commodity SET  commodity_name= '$commodity_name', commodity_price=$commodity_price, commodity_after_discount_price=$commodity_after_discount_price, ".
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
