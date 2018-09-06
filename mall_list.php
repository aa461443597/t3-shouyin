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
							<div class="row">
								<div class="col-md-2">
									<div class="btn btn_1 btn-default mrg5R" style="width: auto" onClick="gopage('mall_add.php')">
										发布商品
									</div>
								</div>

								<div class="col-md-8">
									<div class="btn btn_1 btn-default mrg5R" style="width: auto" id="scan_code_search">
										搜索：<input type='text' placeholder='输入产品名字或者条形码' style="border:#CCC solid 1px; width:200px; width: 180px; text-align: center;" />
									</div>
								</div>

								<div class="col-md-2">
									<div id="export" class="btn btn_1 btn-default mrg5R" style=" min-width:90px;" onClick="getExport()">
										<a data-type="xls" href="javascript:;">导出excel</a>
									</div>
								</div>
							</div>
						</div>
                         <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>条形码</th>
                                        <th>商品名称</th>
                                        <th>商品零售价</th>
                                        <th>商品进货价</th>
                                        <th>商品总数</th>
                                        <th>商品库存</th>
                                        <th>商品图片</th>
                                        <th>商品备注</th>
                                        <th>商品操作人</th>
                                        <th>更新时间</th>
                                        <th class="right">操作</th>
                                    </tr>
                                </thead>
                                <tbody id="content">

								</tbody>
                            </table>

							<div class="pagination">

							 </div>

                        </div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
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
	var delete_id;//删除条目的id
	var page_list_num = 20,//每页显示条数
		now_page = 0,//初始页 0 为第一页
		all_data_num;//总数据条数
	
	$(function(){
		mall_list({now_page:1,now_pagecount:page_list_num},"vipformall/commoditydata_select_commodityList.php","list");//载入列表数据
		
		$("#scan_code_search input").change(function(){
			var search_code = $("#scan_code_search input").val();
			$("#content tr").remove();
			mall_list({bar_code:search_code},"vipformall/commoditydata_select_commodity.php","info");
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

				if(!request){
					tips("未查询到结果",2000);
				}else{
					if(type == "list"){//渲染列表
						all_data_num = Number(request[0].totalcount);
						$.each(request,function(index,data){
							$("#content").append('\
							<tr class="unread checked" id="'+data.id+'">\
								<td>'+data.bar_code+'</td>\
								<td>'+data.commodity_name+'</td>\
								<td>'+data.commodity_price+'</td>\
								<td>'+data.commodity_cost_price+'</td>\
								<td>'+data.commodity_total_count+'</td>\
								<td>'+data.commodity_now_count+'</td>\
								<td><img src="'+data.commodity_pic_url+'" height="30" /></td>\
								<td>'+data.commodity_remark+'</td>\
								<td>'+data.last_operator+'</td>\
								<td>'+data.last_time+'</td>\
								<td class="right">\
									<a href="#" name="'+data.bar_code+'">详情</a>\
									<a href="#" name="'+data.bar_code+'">删除</a>\
								</td>\
							</tr>');
						});
						loadPage();
					}else if(type == "page"){//扫码搜索数据输出
						all_data_num = Number(request[0].totalcount);
						$.each(request,function(index,data){
							$("#content").append('\
							<tr class="unread checked" id="'+data.id+'">\
								<td>'+data.bar_code+'</td>\
								<td>'+data.commodity_name+'</td>\
								<td>'+data.commodity_price+'</td>\
								<td>'+data.commodity_cost_price+'</td>\
								<td>'+data.commodity_total_count+'</td>\
								<td>'+data.commodity_now_count+'</td>\
								<td><img src="'+data.commodity_pic_url+'" height="30" /></td>\
								<td>'+data.commodity_remark+'</td>\
								<td>'+data.last_operator+'</td>\
								<td>'+data.last_time+'</td>\
								<td class="right">\
									<a href="#" name="'+data.bar_code+'">详情</a>\
									<a href="#" name="'+data.bar_code+'">删除</a>\
								</td>\
							</tr>');
						});
					}else if(type == "info"){//扫码搜索数据输出
						//all_data_num = Number(request[0].totalcount);
						$.each(request,function(index,data){
							$("#content").append('\
							<tr class="unread checked" id="'+data.id+'">\
								<td>'+data.bar_code+'</td>\
								<td>'+data.commodity_name+'</td>\
								<td>'+data.commodity_price+'</td>\
								<td>'+data.commodity_cost_price+'</td>\
								<td>'+data.commodity_total_count+'</td>\
								<td>'+data.commodity_now_count+'</td>\
								<td><img src="'+data.commodity_pic_url+'" height="30" /></td>\
								<td>'+data.commodity_remark+'</td>\
								<td>'+data.last_operator+'</td>\
								<td>'+data.last_time+'</td>\
								<td class="right">\
									<a href="#" name="'+data.bar_code+'">详情</a>\
									<a href="#" name="'+data.bar_code+'">删除</a>\
								</td>\
							</tr>');
						});
						$("#scan_code_search input").val("");//扫码框清空
						$(".pagination").html("");
					}
					
					$("#content tr").each(function(n) {
						$("#content tr").eq(n).children(".right").children("a").eq(0).click(function(){
							var now_bar_code = $(this).attr("name");
							gopage('mall_info.php?name='+now_bar_code);
						});
						$("#content tr").eq(n).children(".right").children("a").eq(1).click(function(){
							delete_id = $(this).attr("name");
							alert2("删除","color2","确定要删除此商品么？","删除","取消",delete_enter,closeAlert);
						});
					});

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
	mall_delete({bar_code:delete_id},"vipformall/commoditydata_delete_commodity.php");
}

//分页器
function loadPage(){
	$(".pagination").pagination(all_data_num, {
		items_per_page:page_list_num,
		num_display_entries:5,
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
		mall_list({now_page:page_index+1,now_pagecount:page_list_num},"vipformall/commoditydata_select_commodityList.php","page");
	}
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
				setTimeout(function(){gopage("mall_list.php");}, 2500); 
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

//请求所有数据，进行导出处理
function getExport(){
	$.ajax({
		type:"POST",//接口类型
		url:"vipformall/commoditydata_select_commodityListAll.php",//接口url
		dataType:"json",//请求类型
		async:true,//true异步请求 flase同步请求
		beforeSend:function(){loadAnimation();},//请求开始时执行
		//请求成功时执行
		success: function(request){
			loadClose();
			var option={};
			option.fileName = "产品清单-"+diy_datatime();
			option.datas=[
				{
					sheetData:request,//json数据
					sheetName:'sheet',//没啥用
					sheetFilter:[//json内数据的名字 比如{["a":"111","b":"222"]} 那么下面就是a，b
						'bar_code',
						'commodity_name',
						'commodity_price',
						'commodity_cost_price',
						'commodity_total_count',
						'commodity_now_count',
						'commodity_pic_url',
						'commodity_remark',
						'last_operator',
						'last_time'
					],
					sheetHeader:['条形码','商品名称','商品零售价','商品进货价','商品总数','商品库存','商品图片','商品备注','商品操作人','更新时间']//excel表头名字
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