<?php
	error_reporting(0);
	include "func.inc.php";
	$mysql_info = json_decode(file_get_contents("mysql_info.json"));
	$con = mysql_connect($mysql_info->ip,$mysql_info->username,$mysql_info->password);
	mysql_select_db($mysql_info->dbname, $con);
	mysql_query("set names utf8");

	$now_page=$_POST['now_page'];
	$now_pagecount = $_POST['now_pagecount'];
	$start_column = ($now_page-1) * $now_pagecount;


	$sql = "SELECT count(*) ccount FROM sales_order ";
	$result = mysql_query($sql,$con);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$totalcount = $row["ccount"];


	$sql = "SELECT * FROM sales_order order by id desc limit $start_column,$now_pagecount";
	$result = mysql_query($sql,$con);
	$res = array();
	while ( $row = mysql_fetch_array($result, MYSQL_ASSOC) ){
		$row["totalcount"] = $totalcount;
		$res[] = $row;
	}
	mysql_free_result($result);
	echo json_encode($res);
	mysql_close($con);