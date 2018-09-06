<?php
	error_reporting(0);
	include "func.inc.php";

	//销售订单表
	$order_date = $_POST['order_date'];//订单日期
	$order_total_price = $_POST['order_total_price'];//订单总金额
	$order_after_discount_price = $_POST['order_after_discount_price'];//订单折后价格
	$order_remark = $_POST['order_remark'];
	$order_code = $_POST['order_code'];
	$order_operator = $_POST['order_operator'];
	$last_operator = $_POST['last_operator'];
	$last_time = $_POST['last_time'];
	$order_member_code = $_POST['order_member_code'];
	
	$order_address = $_POST['order_address'];
	//订单详情表
	$commodityList = $_POST['commodityList'];//

	//
	//echo $commodityList[0]["code"];
	//
	//exit;

	$mysql_info = json_decode(file_get_contents("mysql_info.json"));
	$con = mysql_connect($mysql_info->ip,$mysql_info->username,$mysql_info->password);
	mysql_select_db($mysql_info->dbname, $con);
	mysql_query("set names utf8");

	$sql="INSERT INTO sales_order (id, order_date, order_total_price,order_after_discount_price,order_remark,order_code,order_member_code,order_operator,last_operator,last_time) ".
	" VALUES (null,'$order_date',$order_total_price, $order_after_discount_price,'$order_remark','$order_code','$order_member_code','$order_operator','$last_operator','$last_time')";
//	echo count($commodityList);
	try{
		mysql_query($sql, $con);

		$sql = "SELECT id FROM sales_order  order by id desc limit 1  ";
		$result = mysql_query($sql,$con);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$order_id = $row["id"];





		for($x=0;$x<count($commodityList);$x++){

			$bar_code = $commodityList[$x]["code"];
			$commodity_name = $commodityList[$x]["name"];
			$outbound_count = $commodityList[$x]["num"];
			$outbound_date = $order_date;
			$outbound_address = $order_address;
			$outbound_remark = $order_remark;

			$commodity_price = $commodityList[$x]["price"];
			$commodity_after_discount_price = $commodityList[$x]["sale_price"];


			$sql="INSERT INTO outbound_record (id,outbound_remark,bar_code, commodity_name, outbound_count,outbound_date,outbound_address,last_operator,last_time) ".
			" VALUES (null,'$outbound_remark','$bar_code','$commodity_name', $outbound_count,'$outbound_date','$outbound_address','$last_operator','$last_time')";
			//echo $sql;
			mysql_query($sql, $con);
			$sql= "update commodity_data set commodity_now_count = commodity_now_count - $outbound_count where bar_code = '$bar_code'";
			mysql_query($sql, $con);

			for($y=0;$y<$outbound_count;$y++){
				$sql="INSERT INTO order_details (order_code,id,order_id,bar_code, commodity_name, commodity_price,commodity_after_discount_price,order_operator,last_operator,last_time) ".
				" VALUES ('$order_code',null,$order_id,'$bar_code','$commodity_name', $commodity_price,$commodity_after_discount_price,'$order_operator','$last_operator','$last_time')";
				mysql_query($sql, $con);
				//echo $sql;
			}
		}


		if($order_member_code !="0"){
			$sql= "update member_info set member_score = member_score + $order_after_discount_price where member_card_no = '$order_member_code'";
			mysql_query($sql, $con);
			$sql="INSERT INTO score_details (id,record_data,member_card_no, remark, updatetime) ".
			" VALUES (null,'+ $order_after_discount_price','$order_member_code','门店消费', '$last_time')";
			//echo $order_after_discount_price;
			mysql_query($sql, $con);
		}



		echo "1"; //插入成功
	}catch(Exception $e){
		echo "0".$e->getMessage();
		exit();
	}
	mysql_close($con);
