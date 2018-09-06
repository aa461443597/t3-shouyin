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

	<title>会员详情</title>
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
						会员系详情 - 如需修改，直接进行操作后保存
					</div>
					<div class="inbox-details-body">
						<form class="com-mail info_input">
							<fieldset>
								<label>id</label>
								<input type="text"  value="id" placeholder="无信息"  readonly="readonly">
							</fieldset>
							<fieldset>
								<label>openid</label>
								<input type="text"  value="openid" placeholder="无信息"  readonly="readonly">
							</fieldset>
							<fieldset>
								<label>会员卡号</label>
								<input type="text"  value="昵称" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>会员姓名</label>
								<input type="text"  value="用户名" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>会员生日</label>
								<input type="date"  value="生日" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>会员积分</label>
								<input type="text"  value="小区" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>联系电话</label>
								<input type="text"  value="地址" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>会员等级</label>
                                <select class="select_info">
                                	<option>普通会员</option>
                                	<option>铂金会员</option>
                                	<option>黄金会员</option>
                                </select>
							</fieldset>
							<fieldset>
								<label>操作人</label>
								<input type="text"  value="手机" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>更新时间</label>
								<input type="text"  value="时间" placeholder="无信息" readonly="readonly">
							</fieldset>
							<input type="button" onClick="updata_user_info()" value="保存" style="margin-left: 12% !important; padding:0.8em 2.5em !important;">
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
<script>
var member_card_no =getQueryString(pageURL,"member_card_no");

$(function(){
	user_data();	
});

//获取首页显示数据
function user_data(){
	$.ajax({
		type:"POST",//接口类型
		url:'vipformall/memberinfo_select_member.php',//接口url
		dataType:"json",//请求类型
		async:true,//true异步请求 flase同步请求
		data:{
			member_card_no:member_card_no
			},
		beforeSend:function(){loadAnimation();},//请求开始时执行
		success: function(request){
			loadClose();
			$("form input").eq(0).val(request.id);
			$("form input").eq(1).val(request.openid);
			$("form input").eq(2).val(request.member_card_no);
			$("form input").eq(3).val(request.member_name);
			$("form input").eq(4).val(request.member_birthday);
			$("form input").eq(5).val(request.member_score);
			$("form input").eq(6).val(request.member_mobile);
			$("form select").val(request.member_level);
			$("form input").eq(7).val(request.last_operator);
			$("form input").eq(8).val(request.last_time);
		},
		timeout : 20000, //超时时间设置，单位毫秒
		complete : function(XMLHttpRequest,status){
			complete_tips();
		}
	})
}

function updata_user_info(){
	var id = $("form input").eq(0).val();
	var openid = $("form input").eq(1).val();
	var member_card_no = $("form input").eq(2).val();
	var member_name = $("form input").eq(3).val();
	var member_birthday = $("form input").eq(4).val();
	var member_score = $("form input").eq(5).val();
	var member_mobile = $("form input").eq(6).val();
	var member_level = $("form select").val();
	
	$.ajax({
		type:"POST",//接口类型
		url:'vipformall/memberinfo_edit_member.php',//接口url
		dataType:"json",//请求类型
		async:true,//true异步请求 flase同步请求
		data:{
			id:id,
			member_card_no:member_card_no,
			member_name:member_name,
			member_birthday:member_birthday,
			member_score:member_score,
			member_mobile:member_mobile,
			member_level:member_level,
			last_operator:operator,
			last_time:diy_time
			},
		beforeSend:function(){loadAnimation();},//请求开始时执行
		success: function(request){
			loadClose();
			if(request == 1){
				tips("修改成功",3000);
				gopage('user_list.php');
			}else{
				tips("修改失败，请稍后重试！",3000);
				gopage('user_info.php?id='+id+'&openid='+openid);
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