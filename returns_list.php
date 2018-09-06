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

	<title>退货列表</title>
</head>

<body>
<div class="page-container">
	<div class="left-content">
		<div class="mother-grid-inner">

			<!-- 头部信息 -->
			<?php include 'header.php';?>
			<!-- 头部 结束 -->

			<!-- 会员列表 -->
			<div class="col-md-8 mailbox-content  tab-content tab-content-in user_list">
				<div class="tab-pane active text-style">
					<div class="mailbox-border">
						<div class="mail-toolbar clearfix" style="padding:0 0 1rem 0;">
							<div class="float-left">
								<div class="btn btn_1 btn-default mrg5R" style="width: auto" onClick="gopage('returns_add.php')">
									退货申请
								</div>
								<div class="clearfix"> </div>
							</div>
						</div>
                         <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>openid</th>
                                        <th>付款方式</th>
                                        <th>退货备注</th>
                                        <th>订单编号</th>
                                        <th>商品条形码</th>
                                        <th>商品名</th>
                                        <th>商品折后价</th>
                                        <th>退货状态</th>
                                        <th>退货操作人</th>
                                        <th>最后操作人</th>
                                        <th>更新时间</th>
                                        <th class="right">操作</th>
                                    </tr>
                                </thead>
                                <tbody id="content"></tbody>
                            </table>
                        </div>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
			<!-- 会员列表 结束 -->

		</div>
	</div>
	<?php include 'nav.php';?>
	<div class="clearfix"> </div>
</div>
</body>
<!--table 插件-->
<link href="table_html/dataTables.bootstrap.css" rel="stylesheet" />
<script src="table_html/jquery.dataTables.js"></script>
<script src="table_html/dataTables.bootstrap.js"></script>
<script>
	var delete_id;
	var search_code;
	
	$(function(){
		mall_list("","vipformall/refundrecord_select_refundList.php");//载入列表数据
	})


	//指定参数请求
	function mall_list(data,url,type){
		$.ajax({
			type:"POST",//接口类型
			url:url,//接口url
			dataType:"json",//请求类型
			async:true,//true异步请求 flase同步请求
			data:data,
			beforeSend:function(){loadAnimation();},//请求开始时执行
			//请求成功时执行
			success: function(request){
				loadClose();
				$.each(request,function(index,data){
					$("#content").append('\
					<tr class="unread checked" id="'+data.id+'">\
						<td>'+data.id+'</td>\
						<td>'+data.openid+'</td>\
						<td>'+data.refund_way+'</td>\
						<td>'+data.refund_remark+'</td>\
						<td>'+data.order_details_id+'</td>\
						<td>'+data.bar_code+'</td>\
						<td>'+data.commodity_name+'</td>\
						<td>'+data.commodity_after_discount_price+'</td>\
						<td>'+data.refund_status+'</td>\
						<td>'+data.refund_operator+'</td>\
						<td>'+data.last_operator+'</td>\
						<td>'+data.last_time+'</td>\
							<td class="right">\
								<a href="#" name="'+data.id+'">详情</a>\
								<a href="#" name="'+data.id+'">删除</a>\
							</td>\
					</tr>');
				});
				
				$("#content tr").each(function(n) {
					$("#content tr").eq(n).children(".right").children("a").eq(0).click(function(){
						var now_bar_code = $(this).attr("name");
						gopage('returns_info.php?name='+now_bar_code);
					});
					$("#content tr").eq(n).children(".right").children("a").eq(1).click(function(){
						delete_id = $(this).attr("name");
						alert2("删除","color2","确定要删除此退货？","删除","取消",delete_enter,closeAlert);
					});
				});
				
				$('#dataTables-example').dataTable();
				
				if($("#content tr").length == 0){
					tips("未查询到结果",2000)
				}
			},
			timeout : 20000, //超时时间设置，单位毫秒
			
			//请求完成后最终执行参数
			complete : function(XMLHttpRequest,status){
				complete_tips();
			}
		})
	}
	
function delete_enter(){
	closeAlert();
	mall_delete({id:delete_id},"vipformall/refundrecord_delete_refund.php");
}

//删除活动
function mall_delete(delete_name,url){
	$.ajax({
		type:"POST",//接口类型
		url:url,//接口url
		dataType:"json",//请求类型
		async:true,//true异步请求 flase同步请求
		data:delete_name,
		beforeSend:function(){loadAnimation();},//请求开始时执行
		//请求成功时执行
		success: function(request){
			loadClose();
			if(request == 1){
				tips("删除成功",3000);
				setTimeout(function(){gopage("returns_list.php");}, 2500); 
			}else{
				tips("删除失败，请稍后重试",3000);
				return;
			}
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