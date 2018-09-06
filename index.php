<!DOCTYPE HTML>
<html>
<head>
	<title>物流支付系统</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/index.js"></script>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/diy.css" rel="stylesheet">
</head>

<body>
<div class="page-container">
	<div class="left-content">
		<div class="mother-grid-inner">

			<!-- 头部信息 -->
			<?php include 'header.php';?>
			<!-- 头部 结束 -->

			<!-- 首页信息统计 -->
			<div class="market-updates" id="home_data">
				<div class="col-md-4 market-update-gd" onClick="gopage('user_list.php')">
					<div class="market-update-block clr-block-1 clr-block-66">
						<div class="col-md-8 market-update-left">
							<h3 id="user_all">Admin1</h3>
							<h4>当前用户</h4>
						</div>
						<div class="col-md-4 market-update-right">
							<i class="fa icon-group"> </i>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="col-md-4 market-update-gd" onClick="gopage('mall_list.php')">
					<div class="market-update-block clr-block-2">
						<div class="col-md-8 market-update-left">
							<h3 id="pro_all"></h3>
							<h4>商品数量</h4>
						</div>
						<div class="col-md-4 market-update-right">
							<i class="fa fa-eye"></i>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="col-md-4 market-update-gd" onClick="gopage('activity_list.php')">
					<div class="market-update-block clr-block-3 clr-block-44">
						<div class="col-md-8 market-update-left">
							<h3 id="act_all"></h3>
							<h4>订单数量</h4>
						</div>
						<div class="col-md-4 market-update-right">
							<i class="fa icon-pencil"> </i>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<!-- 首页信息统计 结束 -->

		</div>
	</div>
	<?php include 'nav.php';?>
	<div class="clearfix"> </div>
</div>
</body>
<script>

	$(function(){
		pro_list();
		order_list();
	})
	
	//指定参数请求
	function pro_list(){
		$.ajax({
			type:"POST",//接口类型
			url:"vipformall/commoditydata_select_commodityListAll.php",//接口url
			dataType:"json",//请求类型
			async:true,//true异步请求 flase同步请求
			beforeSend:function(){loadAnimation();},//请求开始时执行
			//请求成功时执行
			success: function(request){
				loadClose();
				$("#pro_all").html(request.length);
			},
			timeout : 20000, //超时时间设置，单位毫秒
			//请求完成后最终执行参数
			complete : function(XMLHttpRequest,status){
				complete_tips();
			}
		})
	}
	//指定参数请求
	function order_list(){
		$.ajax({
			type:"POST",//接口类型
			url:"vipformall/salesdetails_select_orderList.php",//接口url
			dataType:"json",//请求类型
			async:true,//true异步请求 flase同步请求
			beforeSend:function(){loadAnimation();},//请求开始时执行
			//请求成功时执行
			success: function(request){
				loadClose();
				$("#act_all").html(request.length);
			},
			timeout : 20000, //超时时间设置，单位毫秒
			//请求完成后最终执行参数
			complete : function(XMLHttpRequest,status){
				complete_tips();
			}
		})
	}
</script>
</html>