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

	<title>会员列表</title>
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

<link href="table_html/dataTables.bootstrap.css" rel="stylesheet" />
<script src="table_html/jquery.dataTables.js"></script>
<script src="table_html/dataTables.bootstrap.js"></script>

<script>
	var delete_id;
	$(function(){
		condition_user_list("","vipformall/memberinfo_select_memberList.php");//载入会员列表数据
	})

	//载入table框架
	function table_responsive(){
		$(".table-responsive").remove();
		$(".mailbox-border").append('<div class="table-responsive">\
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">\
						<thead>\
							<tr>\
								<th>id</th>\
								<th>openid</th>\
								<th>会员卡号</th>\
								<th>会员姓名</th>\
								<th>会员生日</th>\
								<th>会员积分</th>\
								<th>联系电话</th>\
								<th>会员等级</th>\
								<th>操作人</th>\
								<th>更新时间</th>\
								<th class="center">操作</th>\
							</tr>\
						</thead>\
						<tbody id="content"></tbody>\
					</table>\
				</div>\
			</div>');
	}

	//指定参数请求
	function condition_user_list(condition,url){
		$.ajax({
			type:"POST",//接口类型
			url:url,//接口url
			dataType:"json",//请求类型
			async:true,//true异步请求 flase同步请求
			data:condition,
			beforeSend:function(){loadAnimation();},//请求开始时执行
			//请求成功时执行
			success: function(request){
				loadClose();
				table_responsive();
				$.each(request,function(index,data){
					$("#content").append('\
					<tr class="unread checked">\
						<td>'+data.id+'</td>\
						<td>'+data.openid+'</td>\
						<td>'+data.member_card_no+'</td>\
						<td>'+data.member_name+'</td>\
						<td>'+data.member_birthday+'</td>\
						<td>'+data.member_score+'</td>\
						<td>'+data.member_mobile+'</td>\
						<td>'+data.member_level+'</td>\
						<td>'+data.last_operator+'</td>\
						<td>'+data.last_time+'</td>\
						<td class="center">\
							<a href="#" name="'+data.member_card_no+'">详情</a>\
							<a href="#" name="'+data.id+'">删除</a>\
						</td>\
					</tr>');
				});
				$("#content tr").each(function(i) {
                    $("#content tr").eq(i).children(".center").children("a").eq(0).click(function(){
						var member_card_no=$(this).attr("name");
						gopage('user_info.php?member_card_no='+member_card_no);
					});
                    $("#content tr").eq(i).children(".center").children("a").eq(1).click(function(){
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
	delete_list();
}

//删除
function delete_list(){
	$.ajax({
		type:"POST",//接口类型
		url:"vipformall/memberinfo_delete_member.php",//接口url
		dataType:"json",//请求类型
		async:true,//true异步请求 flase同步请求
		data:{id:delete_id},
		beforeSend:function(){loadAnimation();},//请求开始时执行
		//请求成功时执行
		success: function(request){
			loadClose();
			if(request == 1){
				tips("删除成功",2500);
				setTimeout(function(){gopage("user_list.php")}, 2500);
			}else{
				tips("删除失败，请稍后重试",2500);
				setTimeout(function(){gopage("user_list.php")}, 2500);
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