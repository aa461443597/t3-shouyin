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

	<title>折扣商品添加</title>
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
						商品添加
					</div>
					<div class="inbox-details-body" id="input_box">
						<form class="com-mail info_input">
							<fieldset>
								<label>条形码</label>
								<input id="" type="text"  value="" placeholder="无信息" >
							</fieldset>
							<fieldset>
								<label>商品名称</label>
								<input type="text" id=""  value="" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>商品零售价</label>
								<input type="text" id=""  value="" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>商品折扣价</label>
								<input type="text" id=""  value="" placeholder="无信息">
							</fieldset>
							<input type="button" onClick="data_update()" value="保存" style="margin-left: 12% !important; padding:0.8em 2.5em !important;">
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
<script src="uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script type="text/javascript">

$(function(){
	$("form input").eq(0).change(function(){
		var code = $("form input").eq(0).val();
		mall_data(code);
	});
});

//获取mall显示数据
function mall_data(code){
	$.ajax({
		type:"POST",//接口类型
		url:'vipformall/commoditydata_select_commodity.php',//接口url
		dataType:"json",//请求类型
		async:true,//true异步请求 flase同步请求
		data:{
			bar_code:code
			},
		beforeSend:function(){loadAnimation();},//请求开始时执行
		success: function(request){
			loadClose();
			$("form input").eq(1).val(request.commodity_name);
			$("form input").eq(2).val(request.commodity_price);
		},
		timeout : 20000, //超时时间设置，单位毫秒
		complete : function(XMLHttpRequest,status){
			complete_tips();
		}
	})
}

function data_update(){
	
	var bar_code = $("form input").eq(0).val();
	bar_code = bar_code.replace(/ /g,'');
	var commodity_name = $("form input").eq(1).val();
	var commodity_price = $("form input").eq(2).val();
	var commodity_after_discount_price = $("form input").eq(3).val();

	var mall_data_json = {//$title, $description, $photo, $time, $content
		bar_code:bar_code,
		commodity_name:commodity_name,
		commodity_price:commodity_price,
		commodity_after_discount_price:commodity_after_discount_price,
		last_operator:operator,
		last_time:diy_time
	}
	
	data_mall_update(mall_data_json,"vipformall/discountcommodity_insert_commodity.php");
}

function data_mall_update(data,url){
	$.ajax({
		type:"POST",//接口类型
		url:url,//接口url
		dataType:"json",//请求类型
		async:true,//true异步请求 flase同步请求
		data:data,
		beforeSend:function(){loadAnimation();},//请求开始时执行
		success: function(request){
			loadClose();
			if(request == 1){
				tips("发布成功",2000);
				setTimeout(function(){gopage("sale_mall_list.php");}, 2000); 
			}else{
				tips("发布失败，请稍后重试！",3000);
			}
		},
		timeout : 20000, //超时时间设置，单位毫秒
		complete : function(XMLHttpRequest,status){
			complete_tips();
		}
	})
}
</script>
</html>