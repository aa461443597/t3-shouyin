<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/index.js"></script>

	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/diy.css" rel="stylesheet">
	<link href="css/public.css" rel="stylesheet">

	<title>商品入库</title>
</head>

<body>
<div class="page-container">
	<div class="left-content">
		<div class="mother-grid-inner">

			<!-- 头部信息 -->
			<?php include 'header.php';?>
			<!-- 头部 结束 -->

			<!-- 会员详情 -->
			<div class="col-md-8 compose-right" style="width: 92%; margin: 30px 4%;">
				<div class="inbox-details-default">
					<div class="alert alert-info">
						商品入库
					</div>
					<div class="inbox-details-body" id="input_box">
						<form class="com-mail info_input">
							<fieldset>
								<label>条形码</label>
								<input id="bar_code" type="text"  value="" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>商品名称</label>
								<input type="text" id="commodity_name"  value="" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>入库数量</label>
								<input type="text" id="inbound_count"  value="" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>入库门店</label>
								<input type="text" id="inbound_address"  value="" placeholder="无信息">
							</fieldset>
							<input type="button" onClick="data_mall_update()" value="确认入库" style="margin-left: 12% !important; padding:0.8em 2.5em !important;">
						</form>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
			<!-- 会员详情 结束 -->

		</div>
	</div>
	<?php include 'nav.php';?>
	<div class="clearfix"> </div>
</div>
</body>
<script type="text/javascript">

function data_mall_update(){
	
	var bar_code = $("#bar_code").val();
	var commodity_name = $("#commodity_name").val();
	var inbound_count = $("#inbound_count").val();
	var inbound_address = $("#inbound_address").val();
	
	$.ajax({
		type:"POST",//接口类型
		url:"vipformall/inboundrecord_insert_record.php",//接口url
		dataType:"json",//请求类型
		async:true,//true异步请求 flase同步请求
		data:{//$title, $description, $photo, $time, $content
			bar_code:bar_code,
			commodity_name:commodity_name,
			inbound_count:inbound_count,
			inbound_address:inbound_address,
			inbound_date:diy_data,
			last_operator:operator,
			last_time:diy_time
		},
		beforeSend:function(){loadAnimation();},//请求开始时执行
		success: function(request){
			loadClose();
			if(request == 1){
				tips("入库成功",2000);
				setTimeout(function(){gopage("inboundrecord_add.php");}, 2000); 
			}else{
				tips("入库失败，请稍后重试！",3000);
			}
		},
		timeout : 20000, //超时时间设置，单位毫秒
		complete : function(XMLHttpRequest,status){
			complete_tips();
		}
	})
}

$(function(){
	$("#bar_code").change(function(){
		var now_code = 	$("#bar_code").val();
		$.ajax({
			type:"POST",//接口类型
			url:'vipformall/commoditydata_select_commodity.php',//接口url
			dataType:"json",//请求类型
			async:true,//true异步请求 flase同步请求
			data:{
				bar_code:now_code
				},
			beforeSend:function(){loadAnimation();},//请求开始时执行
			success: function(request){
				loadClose();
				$("#commodity_name").val(request.commodity_name);
			},
			timeout : 20000, //超时时间设置，单位毫秒
			complete : function(XMLHttpRequest,status){
				complete_tips();
			}
		})
	});	
});
</script>
</html>