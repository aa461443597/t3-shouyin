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

	<title>入库记录</title>
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
								<div class="btn btn_1 btn-default mrg5R" style="width: auto" onClick="gopage('inboundrecord_add.php')">
									商品入库
								</div>
								<div class="clearfix"> </div>
							</div>
						</div>
                         <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>条形码</th>
                                        <th>商品名称</th>
                                        <th>入库数量</th>
                                        <th>入库时间</th>
                                        <th>入库门店</th>
                                        <th>最后操作人</th>
                                        <th>更新时间</th>
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
	
	$(function(){
		mall_list();//载入列表数据
	})


	//指定参数请求
	function mall_list(){
		$.ajax({
			type:"POST",//接口类型
			url:"vipformall/inboundrecord_select_recordList.php",//接口url
			dataType:"json",//请求类型
			async:true,//true异步请求 flase同步请求
			beforeSend:function(){loadAnimation();},//请求开始时执行
			//请求成功时执行
			success: function(request){
				loadClose();
				$.each(request,function(index,data){
					$("#content").append('\
					<tr class="unread checked" id="'+data.id+'">\
						<td>'+data.id+'</td>\
						<td>'+data.bar_code+'</td>\
						<td>'+data.commodity_name+'</td>\
						<td>'+data.inbound_count+'</td>\
						<td>'+data.inbound_date+'</td>\
						<td>'+data.inbound_address+'</td>\
						<td>'+data.last_operator+'</td>\
						<td>'+data.last_time+'</td>\
					</tr>');
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
</script>
</html>