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

	<title>商品列表</title>
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
								<div class="btn btn_1 btn-default mrg5R" style="width: auto" onClick="gopage('sale_mall_add.php')">
									发布商品
								</div>
                                
								<div class="btn btn_1 btn-default mrg5R" style="width: auto" id="scan_code_search">
									扫码搜索：<input type='text' placeholder='请把光标放在此处后扫码' style="border:#CCC solid 1px; width:200px; width: 180px; text-align: center;" />
								</div>
								<div class="clearfix"> </div>
							</div>
						</div>
                         <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>条形码</th>
                                        <th>商品名称</th>
                                        <th>商品零售价</th>
                                        <th>商品折后价</th>
                                        <th>商品操作人</th>
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
		mall_list("","vipformall/discountcommodity_select_commodityList.php","list");//载入列表数据
		
		$("#scan_code_search input").change(function(){
			search_code = $("#scan_code_search input").val();
			$("#content tr").remove();
			mall_list("","vipformall/discountcommodity_select_commodityList.php","info");
		});
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
				if(type == "list"){//渲染列表
					$.each(request,function(index,data){
						$("#content").append('\
						<tr class="unread checked" id="'+data.id+'">\
						<td>'+data.id+'</td>\
						<td>'+data.bar_code+'</td>\
						<td>'+data.commodity_name+'</td>\
						<td>'+data.commodity_price+'</td>\
						<td>'+data.commodity_after_discount_price+'</td>\
						<td>'+data.last_operator+'</td>\
						<td>'+data.last_time+'</td>\
							<td class="right">\
								<a href="#" name="'+data.id+'">详情</a>\
								<a href="#" name="'+data.id+'">删除</a>\
							</td>\
						</tr>');
					});
				}else if(type == "info"){//扫码搜索数据输出
					$.each(request,function(index,data){
						if(search_code == data.bar_code){
							$("#content").append('\
							<tr class="unread checked" id="'+data.id+'">\
							<td>'+data.id+'</td>\
							<td>'+data.bar_code+'</td>\
							<td>'+data.commodity_name+'</td>\
							<td>'+data.commodity_price+'</td>\
							<td>'+data.commodity_after_discount_price+'</td>\
							<td>'+data.last_operator+'</td>\
							<td>'+data.last_time+'</td>\
								<td class="right">\
									<a href="#" name="'+data.id+'">详情</a>\
									<a href="#" name="'+data.id+'">删除</a>\
								</td>\
							</tr>');
						}
					});
					$("#scan_code_search input").val("");//扫码框清空
				}
				
				$("#content tr").each(function(n) {
					$("#content tr").eq(n).children(".right").children("a").eq(0).click(function(){
						var now_bar_code = $(this).attr("name");
						gopage('sale_mall_info.php?name='+now_bar_code);
					});
					$("#content tr").eq(n).children(".right").children("a").eq(1).click(function(){
						delete_id = $(this).attr("name");
						alert2("删除","color2","确定要删除此商品么？","删除","取消",delete_enter,closeAlert);
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
	mall_delete({id:delete_id},"vipformall/discountcommodity_delete_commodity.php");
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
				setTimeout(function(){gopage("sale_mall_list.php");}, 2500); 
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