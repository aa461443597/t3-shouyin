7 <!DOCTYPE HTML>
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

	<title>订单列表</title>
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
                                <div id="export" class="btn btn_1 btn-default" style=" min-width:90px; float:right">
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
                                        <th>销售ID</th>
                                        <th>销售订单号</th>
                                        <th>条形码</th>
                                        <th>商品名称</th>
                                        <th>零售价</th>
                                        <th>折后价</th>
                                        <th>销售员</th>
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
<table style="display:none" id="daochu_table">
    <thead>
        <tr>
            <th>ID</th>
            <th>销售ID</th>
            <th>销售订单号</th>
            <th>条形码</th>
            <th>商品名称</th>
            <th>零售价</th>
            <th>折后价</th>
            <th>销售员</th>
            <th>最后操作人</th>
            <th>更新时间</th>
        </tr>
    </thead>
    <tbody id="daochu_content"></tbody>
</table>
</body>
<!--table 插件-->
<link href="table_html/dataTables.bootstrap.css" rel="stylesheet" />
<script src="table_html/jquery.dataTables.js"></script>
<script src="table_html/dataTables.bootstrap.js"></script>
<script src="js/fetch.2.0.3.js"></script>
<script>
	var delete_id;
	
	$(function(){
		mall_list("","vipformall/salesdetails_select_orderList.php");//载入列表数据
	})


	//指定参数请求
	function mall_list(data,url){
		loadAnimation();
		/*$.ajax({
			type:"POST",//接口类型
			url:url,//接口url
			dataType:"json",//请求类型
			async:true,//true异步请求 flase同步请求
			data:data,
			beforeSend:function(){loadAnimation();},//请求开始时执行
			//请求成功时执行
			success: function(request){
				loadClose();
				$("#content tr,#daochu_content tr").remove();
				$.each(request,function(index,data){
					$("#content").append('\
					<tr class="unread checked" id="'+data.id+'">\
						<td>'+data.id+'</td>\
						<td>'+data.order_id+'</td>\
						<td>'+data.order_code+'</td>\
						<td>'+data.bar_code+'</td>\
						<td>'+data.commodity_name+'</td>\
						<td>'+data.commodity_price+'</td>\
						<td>'+data.commodity_after_discount_price+'</td>\
						<td>'+data.order_operator+'</td>\
						<td>'+data.last_operator+'</td>\
						<td>'+data.last_time+'</td>\
						<td class="right">\
							<a href="#" name="'+data.id+'">详情</a>\
						</td>\
					</tr>');
					$("#daochu_content").append('\
					<tr class="unread checked" id="'+data.id+'">\
						<td>'+data.id+'</td>\
						<td>'+data.order_id+'</td>\
						<td>'+data.order_code+'</td>\
						<td>'+data.bar_code+'</td>\
						<td>'+data.commodity_name+'</td>\
						<td>'+data.commodity_price+'</td>\
						<td>'+data.commodity_after_discount_price+'</td>\
						<td>'+data.order_operator+'</td>\
						<td>'+data.last_operator+'</td>\
						<td>'+data.last_time+'</td>\
					</tr>');
				});
				
				$("#content tr").each(function(n) {
					$("#content tr").eq(n).children(".right").children("a").eq(0).click(function(){
						var now_id = $(this).attr("name");
						gopage('order_details_info.php?name='+now_id);
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
		});*/


		//let data = 'aaa=bbb&ccc=ddd';  data,url
		fetch(url,{//与服务器交互
			method: "POST",
			headers:{'Content-Type': 'application/x-www-form-urlencoded'},
			//body: data
		}).then((response) => response.json())//取数据
		.then((responseText) => {//处理数据
			loadClose();
			setExcel(responseText);
		})
	}
</script>


<script src="https://cuikangjie.github.io/JsonExportExcel/dist/JsonExportExcel.min.js"></script>
<script>
	function setExcel(excel_data){
		var option={};
		option.fileName = "卓越派活动数据"+diy_data();
		option.datas=[
			{
				sheetData:excel_data,
				sheetName:'sheet',
				sheetFilter:[
					'bar_code',
					'catalog_name',
					'commodity_cost_price',
					'commodity_name',
					'commodity_now_count',
					'commodity_pic_url',
					'commodity_price',
					'commodity_remark',
					'commodity_total_count',
					'last_operator',
					'last_time'
				],
				sheetHeader:['编号','微信ID','微信昵称','微信头像','姓名','手机','地区','校区','课程','更新时间']
			}
		];
		var toExcel=new ExportJsonExcel(option);
		toExcel.saveExcel();
	}
</script>
</html>