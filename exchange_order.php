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

	<title>换购订单</title>
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
                                        <th>unionid</th>
                                        <th>产品名</th>
                                        <th>条形码</th>
                                        <th>预留姓名</th>
                                        <th>提货方式</th>
                                        <th>预留手机</th>
                                        <th>预留地址</th>
                                        <th>运单信息</th>
                                        <th>换购积分</th>
                                        <th>状态</th>
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
            <th>unionid</th>
            <th>产品名</th>
            <th>条形码</th>
            <th>预留姓名</th>
            <th>提货方式</th>
            <th>预留手机</th>
            <th>预留地址</th>
            <th>运单信息</th>
            <th>换购积分</th>
            <th>状态</th>
            <th>更新时间</th>
        </tr>
    </thead>
    <tbody id="daochu_content"></tbody>
</table>
<div id="edit_order">
    <h4>修改订单</h4>
    <fieldset>
        <label>状态</label>
        <select></select>
    </fieldset>
    <fieldset>
        <label>运单信息</label>
        <input value="" placeholder="" type="text" />
    </fieldset>
    <span class="sub_inp">确定修改</span>
</div>
</body>
<!--table 插件-->
<link href="table_html/dataTables.bootstrap.css" rel="stylesheet" />
<script src="table_html/jquery.dataTables.js"></script>
<script src="table_html/dataTables.bootstrap.js"></script>
<script>
	var delete_id;
    var edit_order_id,edit_order_way;
	
	$(function(){
		mall_list("","vipformall/exchange_list.php");//载入列表数据

        $("#edit_order").css({"left":(win_w-500)/2});
	})


	//指定参数请求
	function mall_list(data,url){
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
				$("#content tr,#daochu_content tr").remove();
				$.each(request,function(index,data){
					$("#content").append('\
					<tr class="unread checked" id="'+data.id+'">\
						<td>'+data.id+'</td>\
						<td>'+data.unionid+'</td>\
						<td>'+data.commodity_name+'</td>\
						<td>'+data.barcode+'</td>\
						<td>'+data.ex_name+'</td>\
						<td>'+data.ex_way+'</td>\
						<td>'+data.ex_mobile+'</td>\
						<td>'+data.ex_address+'</td>\
						<td>'+data.ex_tracking_number+'</td>\
						<td>'+data.ex_score+'</td>\
						<td>'+data.ex_status+'</td>\
						<td>'+data.ex_time+'</td>\
						<td class="right">\
							<a href="javascript:void(0)" name="'+data.id+'">修改</a>\
						</td>\
					</tr>');
					$("#daochu_content").append('\
					<tr class="unread checked" id="'+data.id+'">\
						<td>'+data.id+'</td>\
						<td>'+data.unionid+'</td>\
						<td>'+data.commodity_name+'</td>\
						<td>'+data.barcode+'</td>\
						<td>'+data.ex_name+'</td>\
						<td>'+data.ex_way+'</td>\
						<td>'+data.ex_mobile+'</td>\
						<td>'+data.ex_address+'</td>\
						<td>'+data.ex_tracking_number+'</td>\
						<td>'+data.ex_score+'</td>\
						<td>'+data.ex_status+'</td>\
					</tr>');
				});
				var type_bg = [
                    { type: "待发货", bg: "#09F" },
                    { type: "待领取", bg: "#09F" },
                    { type: "已发货", bg: "cadetblue" },
                    { type: "已领取", bg: "cadetblue" },
                    { type: "已完成", bg: "#888" }
                ]
                $("#content tr").each(function(i){
                    var status_now = $("#content tr").eq(i).children("td").eq(10).html();
                    for(var n = 0;n<5;n++){
                        if(status_now == type_bg[n].type){
                            $("#content tr").eq(i).children("td").eq(10).css("color",type_bg[n].bg)
                        }
                    }

                    $("#content tr").eq(i).children("td.right").children("a").click(function(){//修改状态/快递
                        edit_order_id =  $(this).attr("name");
                        var edit_order_status = $("#content tr").eq(i).children("td").eq(10).html();
                        var edit_order_tracking_number = $("#content tr").eq(i).children("td").eq(8).html();
                        edit_order_way = $("#content tr").eq(i).children("td").eq(5).html();
                        if(edit_order_way == "快递"){
                            $("#edit_order select").append('<option>待发货</option><option>已发货</option><option>已完成</option>');
                        }else if(edit_order_way == "自取"){
                            $("#edit_order select").append('<option>待领取</option><option>已领取</option><option>已完成</option>');
                        }
                        if(edit_order_tracking_number == "null" || edit_order_tracking_number == "undefined"){
                            $("#edit_order input").attr("placeholder","暂无信息");
                        }else{
                            $("#edit_order input").val(edit_order_tracking_number);
                        }
                        $("#edit_order select").val(edit_order_status);
                        $("#edit_order").show(function(){
                            $(".sub_inp").click(function(){
                                var data_status = $("#edit_order select").val();
                                var data_tracking_number = $("#edit_order input").val();
                                $.ajax({
                                    type:"POST",//接口类型
                                    url:"vipformall/order_status_change.php",//接口url
                                    dataType:"json",//请求类型
                                    async:true,//true异步请求 flase同步请求
                                    data:{
                                        id:edit_order_id,
                                        ex_tracking_number:data_tracking_number,
                                        ex_status:data_status
                                    },
                                    beforeSend:function(){loadAnimation();},//请求开始时执行
                                    success: function(request){
                                        loadClose();
                                        if(request == 1){
                                            tips("修改成功",1000);
                                            setTimeout(function(){gopage(pageURL);}, 1000);
                                        }else{
                                            tips("修改失败，请稍后重试！",2000);
                                        }
                                    },
                                    timeout : 20000, //超时时间设置，单位毫秒
                                    complete : function(XMLHttpRequest,status){
                                        complete_tips();
                                    }
                                })
                            });
                        });
                    });
                });
				
				$('#dataTables-example').dataTable();
                $("#dataTables-example thead th").eq(0).click();
				
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

<!-- 导出 -->
<script src="excel/Blob.js"></script>
<script src="excel/FileSaver.js"></script>
<script src="excel/tableExport.js"></script>
<script>
var excel_name = "订单列表";
var $exportLink = document.getElementById('export');
$exportLink.addEventListener('click', function(e){
	e.preventDefault();
	if(e.target.nodeName === "A"){
		tableExport('daochu_table', excel_name, e.target.getAttribute('data-type'));
	}
}, false);
</script>
</html>