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

	<title>销售订单详情</title>
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
						销售订单详情
					</div>
					<div class="inbox-details-body" id="input_box">
						<form class="com-mail info_input">
							<fieldset>
								<label>ID</label>
								<input id="id" type="text"  value="1" placeholder="无信息"  readonly>
							</fieldset>
							<fieldset>
								<label>订单日期</label>
								<input type="text" id="order_date"  value="" placeholder="无信息" readonly>
							</fieldset>
							<fieldset>
								<label>总金额</label>
								<input type="text" id="order_total_price"  value="" placeholder="无信息" readonly>
							</fieldset>
							<fieldset>
								<label>折后价</label>
								<input type="text" id="order_after_discount_price"  value="" placeholder="无信息" readonly>
							</fieldset>
							<fieldset>
								<label>订单备注</label>
								<input type="text" id="order_remark"  value="" placeholder="无信息" readonly>
							</fieldset>
							<fieldset>
								<label>交易编号</label>
								<input type="text" id="order_code"  value="" placeholder="无信息" readonly>
							</fieldset>
							<fieldset>
								<label>销售员</label>
								<input type="text" id="order_operator"  value="" placeholder="无信息" readonly>
							</fieldset>
							<fieldset>
								<label>最后操作人</label>
								<input type="text"  id="last_operator" value="" placeholder="无信息" readonly>
							</fieldset>
							<fieldset>
								<label>更新时间</label>
								<input type="text"  id="last_time" value="" placeholder="无信息" readonly>
							</fieldset>
						</form>
                        <div class="clearfix"> </div>	
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
var pro_id = unescape(getQueryString(pageURL,"name"));


$(function(){
	mall_data();
});

//获取mall显示数据
function mall_data(){
	$.ajax({
		type:"POST",//接口类型
		url:'vipformall/salesorder_select_order.php',//接口url
		dataType:"json",//请求类型
		async:true,//true异步请求 flase同步请求
		data:{
			id:pro_id
			},
		beforeSend:function(){loadAnimation();},//请求开始时执行
		success: function(request){
			loadClose();
			$("form input").eq(0).val(request.id);
			$("form input").eq(1).val(request.order_date);
			$("form input").eq(2).val(request.order_total_price);
			$("form input").eq(3).val(request.order_after_discount_price);
			$("form input").eq(4).val(request.order_remark);
			$("form input").eq(5).val(request.order_code);
			$("form input").eq(6).val(request.order_operator);
			$("form input").eq(7).val(request.last_operator);
			$("form input").eq(8).val(request.last_time);
		},
		timeout : 20000, //超时时间设置，单位毫秒
		complete : function(XMLHttpRequest,status){
			complete_tips();
		}
	})
}
</script>
</html>