<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/diy.css" rel="stylesheet">
	<link href="css/public.css" rel="stylesheet">
	<link href="css/pagination.css" rel="stylesheet"><!-- jq分页器 -->

	<title>销售订单列表</title>
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
							<div class="float-left" style=" width:100%;">
								<div class="btn btn_1 btn-default" style="width: auto; float:left;">
									开始时间:<input type="date" id="begin_date" style=" height:22px;" />
								</div>
								<div class="btn btn_1 btn-default" style="width: auto; margin:0 2%; float:left;">
									结束时间:<input type="date" id="end_date" style=" height:22px;" />
								</div>
								<div class="btn btn_1 btn-default" style="width: auto; float:left;" id="data_search">
									筛选
								</div>
                                <div id="export" class="btn btn_1 btn-default" style=" min-width:90px; float:right" onclick="getExport()">
                                    <a data-type="xls" href="javascript:;">导出excel</a>
                                </div>
								<div class="clearfix"> </div>
							</div>
						 </div>
                         <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>订单日期</th>
                                        <th>总金额</th>
                                        <th>折后价</th>
                                        <th>订单备注</th>
                                        <th>交易编号</th>
                                        <th>销售员</th>
                                        <th>最后操作人</th>
                                        <th>更新时间</th>
                                        <th class="right">操作</th>
                                    </tr>
                                </thead>
                                <tbody id="content"></tbody>
                            </table>
							 <div class="pagination">

							 </div>
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
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/index.js"></script>
<script src="js/underscore.js"></script><!-- jq分页器 -->
<script src="js/jquery.pagination.js"></script><!-- jq分页器 -->
<script src="http://t3china.t3group.cn/Lib/js/JsonExportExcel.min.js"></script><!-- 导出excel插件 -->
<script>
	var delete_id;
	var page_list_num = 20,//每页显示条数
		now_page = 0,//初始页 0 为第一页
		all_data_num;//总数据条数
	var now_data_type = "all";
	var begin_date,end_date;
	
	$(function(){
		mall_list({now_page:1,now_pagecount:page_list_num},"vipformall/salesorder_select_orderListPage.php","list");//载入列表数据
		$("#data_search").click(function(){
			begin_date = $("#begin_date").val();
			end_date = $("#end_date").val();
			if(begin_date == null || begin_date == "" || end_date == null || end_date == ""){
				tips("请先选择开始和结束时间！",2000);
				return;
			}
			now_data_type = "time";
			mall_list(
				{begin_date:begin_date,end_date:end_date,now_page:1,now_pagecount:page_list_num},
				"vipformall/salesorder_select_orderList_time_page.php",
				"list"
			);//日期筛选
		});
	});

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
				$("#content tr").remove();
				if(type == "page"){
					all_data_num = Number(request[0].totalcount);
					$.each(request,function(index,data){
						$("#content").append('\
							<tr class="unread checked" id="'+data.id+'">\
							<td>'+data.id+'</td>\
							<td>'+data.order_date+'</td>\
							<td>'+data.order_total_price+'</td>\
							<td>'+data.order_after_discount_price+'</td>\
							<td>'+data.order_remark+'</td>\
							<td>'+data.order_code+'</td>\
							<td>'+data.order_operator+'</td>\
							<td>'+data.last_operator+'</td>\
							<td>'+data.last_time+'</td>\
							<td class="right">\
								<a href="#" name="'+data.id+'">详情</a>\
							</td>\
						</tr>');
					});
				}else if(type == "list"){
					all_data_num = Number(request[0].totalcount);
					$.each(request,function(index,data){
						$("#content").append('\
							<tr class="unread checked" id="'+data.id+'">\
							<td>'+data.id+'</td>\
							<td>'+data.order_date+'</td>\
							<td>'+data.order_total_price+'</td>\
							<td>'+data.order_after_discount_price+'</td>\
							<td>'+data.order_remark+'</td>\
							<td>'+data.order_code+'</td>\
							<td>'+data.order_operator+'</td>\
							<td>'+data.last_operator+'</td>\
							<td>'+data.last_time+'</td>\
							<td class="right">\
								<a href="#" name="'+data.id+'">详情</a>\
							</td>\
						</tr>');
					});
					loadPage();
				}
				
				$("#content tr").each(function(n) {
					$("#content tr").eq(n).children(".right").children("a").eq(0).click(function(){
						var now_id = $(this).attr("name");
						gopage('sales_order_info.php?name='+now_id);
					});
				});

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

	//分页器
	function loadPage(){
		$(".pagination").html("");
		$(".pagination").pagination(all_data_num, {
			items_per_page:page_list_num,
			num_display_entries:10,
			current_page:0,
			link_to:"",
			prev_text:"&laquo;",
			next_text:"&raquo;",
			callback: pageselectCallback,
		});
	}
	//分页器回调
	function pageselectCallback(page_index){
		if(page_index != 0){
			$("#content tr").remove();
			mall_list({now_page:page_index+1,now_pagecount:page_list_num},"vipformall/salesorder_select_orderListPage.php","page");
		}
	}

	//请求所有数据，进行导出处理
	function getExport(){
		let export_ajax_url;
		let export_ajax_data;
		if(now_data_type == "all"){
			export_ajax_url = "vipformall/salesorder_select_orderList.php";
			export_ajax_data = "";
		}else if(now_data_type == "time"){
			export_ajax_url = "vipformall/salesorder_select_orderList_time.php";
			export_ajax_data = {begin_date:begin_date,end_date:end_date,now_page:1,now_pagecount:page_list_num};
		}
		$.ajax({
			type:"POST",//接口类型
			url:export_ajax_url,//接口url
			dataType:"json",//请求类型
			async:true,//true异步请求 flase同步请求
			data:export_ajax_data,
			beforeSend:function(){loadAnimation();},//请求开始时执行
			//请求成功时执行
			success: function(request){
				loadClose();
				var option={};
				option.fileName = "销售订单-"+diy_datatime();
				option.datas=[
					{
						sheetData:request,//json数据
						sheetName:'sheet',//没啥用
						sheetFilter:[//json内数据的名字 比如{["a":"111","b":"222"]} 那么下面就是a，b
							'id',
							'order_total_price',
							'order_after_discount_price',
							'order_code',
							'order_date',
							'order_operator',
							'order_remark',
							'last_operator',
							'last_time'
						],
						sheetHeader:['ID','总价','折后价','交易编号','订单日期','销售员','订单备注','最后操作人','更新时间']//excel表头名字
					}
				];
				var toExcel=new ExportJsonExcel(option);//创建JsonExportExcel
				toExcel.saveExcel();//保存文件
			},
			timeout : 20000, //超时时间设置，单位毫秒
			//请求完成后最终执行参数
			complete : function(XMLHttpRequest,status){
				complete_tips();
			}
		})
	}
</script>
</body>
</html>