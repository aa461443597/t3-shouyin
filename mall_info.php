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

	<title>商品详情</title>
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
						商品详情 - 如需修改，直接进行操作后保存
					</div>
					<div class="inbox-details-body" id="input_box">
						<form class="com-mail info_input">
							<fieldset>
								<label>条形码</label>
								<input id="bar_code" type="text"  value="" placeholder="无信息"  readonly="readonly">
							</fieldset>
							<fieldset>
								<label>商品名称</label>
								<input type="text" id="commodity_name"  value="" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>商品零售价</label>
								<input type="text" id="commodity_price"  value="" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>商品进货价</label>
								<input type="text" id="commodity_cost_price"  value="" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>商品总数</label>
								<input type="text" id="commodity_total_count"  value="" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>商品库存</label>
								<input type="text" id="commodity_now_count"  value="" placeholder="无信息">
							</fieldset>
							<fieldset style="position:relative; margin-bottom:40px;">
                                <label>商品图片</label>
                                <style type="text/css">
                                #SWFUpload_0{ z-index:999; left:12%; top:5px;}
								#info_uploadify-queue{ display:none;}
								.choose_img_inp{width:120px; height:30px; background-color:#09C; color:#FFF; font-size:16px; position:absolute; left:12%; top:5px; z-index:1; text-align:center; line-height:30px;}
                                .info_img_show{margin-left: 12%; margin-bottom: 10px; position: absolute; right: 0; top: 0px; height:80px;}
                                </style>
                                <span class="choose_img_inp">选择图片</span>
                                <input type="hidden" class="form-control" id="info_img"  placeholder="图片">
                                <input type="file" name="info_uploadify" id="info_uploadify" />
                                <img class="info_img_show" src="" />
							</fieldset>
							<fieldset>
								<label>商品备注</label>
								<input type="text" id="commodity_remark"  value="" placeholder="无信息">
							</fieldset>
							<fieldset>
								<label>商品操作人</label>
								<input type="text"  id="last_operator" value="" placeholder="无信息" readonly>
							</fieldset>
							<fieldset>
								<label>更新时间</label>
								<input type="text"  id="last_time" value="" placeholder="无信息" readonly>
							</fieldset>
							<input type="button" onClick="data_update()" value="保存" style="margin-left: 12% !important; padding:0.8em 2.5em !important;">
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
<script src="uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script type="text/javascript">
var pro_id = unescape(getQueryString(pageURL,"name"));
var img_name;

//详情图片上传控件方法
$(function(){
  $('#info_uploadify').uploadify({
    'fileDataName':'Filedata',
    'swf':'uploadify/uploadify.swf',//选择文件按钮
    'uploader':'uploadify/uploadify.php',//处理文件上传的php文件
    'removeCompleted':true,
    'width':'120',//选择文件按钮的宽度
    'height':'30',//选择文件按钮的高度
    'buttonText': '',
    'buttonImg': 'uploadify/browse-btn2.png',
    'fileTypeDesc': 'Image Files',
    'fileTypeExts': '*.gif; *.jpg; *.png; *.jpeg',
    'debug':false,
    'multi':false,//设置为true时可以上传多个文件	
    'formData':{'targetFolder':'/LPPM/upload/product/'},
    'method':'post',//方法，服务端可以用$_POST数组获取数据

    'onUploadStart':function(file){//上传前检查图片大小
      if(file.size>2*1024*1014){
        alert("文件超过大小限制2M，请重新选择！");
        $('#uploadify').uploadify('stop');
      }
     },
    'onUploadError':function(file,errorCode,errorMsg){
      alert('上传错误：错误代码：'+obj2string(errorCode)+'错误消息：'+obj2string(errorMsg));
    },
    onUploadSuccess:function(file,data,response){//上传成功，加载图片预览
      document.getElementById('info_img').value=file.name;
	  img_name = "http://t3china.t3group.cn/LPPM/upload/product/"+file.name;
	  $(".info_img_show").attr("src",img_name)
    }
  });
});

$(function(){
	mall_data();
});

//获取mall显示数据
function mall_data(){
	$.ajax({
		type:"POST",//接口类型
		url:'vipformall/commoditydata_select_commodity.php',//接口url
		dataType:"json",//请求类型
		async:true,//true异步请求 flase同步请求
		data:{
			bar_code:pro_id
			},
		beforeSend:function(){loadAnimation();},//请求开始时执行
		success: function(request){
			loadClose();
			$("#bar_code").val(request.bar_code);
			$("#commodity_name").val(request.commodity_name);
			$("#commodity_price").val(request.commodity_price);
			$("#commodity_cost_price").val(request.commodity_cost_price);
			$("#commodity_total_count").val(request.commodity_total_count);
			$("#commodity_now_count").val(request.commodity_now_count);
			$("#commodity_remark").val(request.commodity_remark);
			$("#last_operator").val(request.last_operator);
			$("#last_time").val(request.last_time);
			$(".info_img_show").attr("src",request.commodity_pic_url);
			img_name = request.commodity_pic_url;
		},
		timeout : 20000, //超时时间设置，单位毫秒
		complete : function(XMLHttpRequest,status){
			complete_tips();
		}
	})
}

var bar_code;
var commodity_name;
var commodity_price;
var commodity_cost_price;
var commodity_total_count;
var commodity_now_count;
var commodity_remark;

function data_update(){
	
	var bar_code = $("#bar_code").val();
	var commodity_name = $("#commodity_name").val();
	var commodity_price = $("#commodity_price").val();
	var commodity_cost_price = $("#commodity_cost_price").val();
	var commodity_total_count = $("#commodity_total_count").val();
	var commodity_now_count = $("#commodity_now_count").val();
	var commodity_remark = $("#commodity_remark").val();

	var mall_data_json = {//$title, $description, $photo, $time, $content
		bar_code:bar_code,
		commodity_name:commodity_name,
		commodity_price:commodity_price,
		commodity_cost_price:commodity_cost_price,
		commodity_total_count:commodity_total_count,
		commodity_now_count:commodity_now_count,
		commodity_pic_url:img_name,
		commodity_remark:commodity_remark,
		last_operator:operator,
		last_time:diy_time
	}
	
	data_mall_update(mall_data_json,"vipformall/commoditydata_edit_commodity.php");
}

function data_mall_update(data,url){
	$.ajax({
		type:"POST",//接口类型
		url:url,//接口url
		dataType:"json",//请求类型
		async:true,//true异步请求 flase同步请求
		data:data,
		beforeSend:function(){loadAnimation();},//请求开始时执行
		success: function(request){
			loadClose();
			if(request == 1){
				tips("发布成功",2000);
				setTimeout(function(){gopage("mall_list.php");}, 2000); 
			}else{
				tips("发布失败，请稍后重试！",3000);
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