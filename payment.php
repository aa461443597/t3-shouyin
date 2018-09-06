<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/index.js"></script>
	<script language="javascript" src="js/LodopFuncs.js"></script>
    
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/diy.css" rel="stylesheet">
	<link href="css/public.css" rel="stylesheet">

	<title>买单</title>
</head>

<body>
<a href="index.php" style=" width:150px; height:60px; background-color:#6eb92b;font-family: '微软雅黑'; color:#FFF; text-align:center; line-height:60px; font-size:18px; text-decoration:none; display:block; position:absolute; top:10px; right:10px; z-index:99999;">返回首页</a>
<div class="page-container">
		<div class="mother-grid-inner">
			<div class="col-md-8 mailbox-content  tab-content tab-content-in user_list" style="box-shadow:none !important; border:#bbb solid 1px;">
				<div class="tab-pane active text-style">
					<div class="mailbox-border">
						<div class="mail-toolbar clearfix" style="padding:0 0 1rem 0;">
							<div class="float-left">
								<div class="btn btn_1 btn-default mrg5R" style="width: auto">
									<input type="text" value="" id="change_code" style="border:0;" placeholder="光标放这里扫描商品" />
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="float-left">
								<div class="btn btn_1 btn-default mrg5R" style="width: auto">
									<input type="text" value="" id="user_num" style="border:0;" placeholder="会员编号 非会员可以留空" />
								</div>
								<div class="clearfix"> </div>
							</div>
						</div>
                        <aside id="settlement">
                            <div class="table-responsive" style="width:48%; float:left">
                            	<h5>原价商品</h5>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                    <thead>
                                        <tr>
                                            <th name="code">条形码</th>
                                            <th name="name">商品名称</th>
                                            <th name="price">商品零售价</th>
                                            <th name="sale_price">商品折后价</th>
                                            <th name="num">商品数量</th>
                                            <th name="price_all">原价小计</th>
                                            <th name="sale_price_all">商品折后价</th>
                                            <th class="right"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="content_left"></tbody>
                                </table>
                                <aside>
                                	<!--h4>优惠</h4-->
                                    <figcaption>
                                    	<label>折扣：</label>
                                        <select id="discount">
                                        	<option name="1">无</option>
											<option name="0.95">书签九五折</option>
											<option name="0.98">书签九八折</option>
											<option name="0.85">大宗采购85折</option>
                                        	<!--option name="0.95">春节95折</option>
                                        	<option name="0.9">元旦9折</option>
                                        	<option name="0.85">国庆85折</option>
                                        	<option name="0.8">双十一8折</option>
                                        	<option name="0.75">周年75折</option>
                                        	<option name="0.7">来就打7折</option-->
                                        </select>
                                    	<label>&nbsp;&nbsp;&nbsp;&nbsp;优惠：</label>
                                        <select id="coupon">
                                        	<option name="0">无</option>
                                        	<option name="10">10元抵用券</option>
											<option name="2">书签减两元</option>
                                            <!--option name="15">15元抵用券</option>
                                            <option name="20">20元抵用券</option>
                                            <option name="30">30元抵用券</option>
                                            <option name="40">40元抵用券</option>
                                            <option name="50">50元抵用券</option>
											<option name="100">100元抵用券</option-->
                                        </select>
                                    </figcaption>
                                </aside>
                            </div>
                            <div class="table-responsive" style="width:48%; float:right">
                            	<h5>特价商品</h5>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                    <thead>
                                        <tr>
                                            <th>条形码</th>
                                            <th>商品名称</th>
                                            <th>商品原价</th>
                                            <th>商品折后价</th>
                                            <th>商品数量</th>
                                            <th>原价小计</th>
                                            <th>商品折后价</th>
                                            <th class="right"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="content_right"></tbody>
                                </table>
                            </div>
                            
                            <div class="clearfix"> </div>
                            
                            <ul class="totle_nom">
                            	<li>
                                    <h6>商品原价合计：<span id="totle1">0</span>元</h6>
                                    <h6>商品折后价合计：<span id="totle11">0</span>元</h6>
                                </li>
                                <li>
                                    <h6>商品原价合计：<span id="totle2">0</span>元</h6>
                                    <h6>商品特价合计：<span id="totle22">0</span>元</h6>
                                </li>
                            </ul>
                            
                            <div class="clearfix"> </div>
                            
                            <article class="order_remark">
                                <h4 style=" color:#007238; font-size:16px; font-family:'微软雅黑';">备注：</h4>
                                <textarea id="order_remark" placeholder="订单备注，可不填！"></textarea>
                                <div class="clearfix"> </div>
                            </article>
                            
                            <div class="clearfix"> </div>
                            
                            <div class="foot_box">
                            	<span id="old_price">总计：<b>0</b>元</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="pay_price">折后价：<b>0</b>元</span>
                                <input type="button" onclick="go_pay()" value="确认付款" class="pay_inp">
                                <!--figcaption>
                                    <label>支付方式</label>
                                    <select id="choose_style_pay">
                                    	<option>请选择支付方式</option>
                                    	<option>现金</option>
                                    	<option>网银/手机支付</option>
                                    </select>
                                </figcaption-->
                            </div>
                            <div class="clearfix"> </div>
                        </aside>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>

		</div>
	<div class="clearfix"> </div>
</div>

<div id="print_list" style="display:none;">
    <table id="print_tit" border="0" width="160" cellpadding="0" cellspacing="0" style="margin-bottom:10px; font-size:12px;">
    <thead>
    	<tr><td align="center" style="font-size:20px;"></td></tr>
        <!--tr><td align="center" style="font-size:14px;"></td></tr-->
        <tr><td align="center">&nbsp;</td></tr>
        <tr><td align="center">-------------------------------------</td></tr>
        <tr><td align="center">&nbsp;</td></tr>
    </thead>
    <tbody></tbody>
    <tfoot></tfoot>
    </table>
</div>

</body>
<script>
var mall_list_data;//商品数据
var delete_mall_id;//要删除商品的条形码
var zhekou = 1;//定义折扣
var user_num = "0",user_name = "";//初始会员状态 0位非会员
var pay_style="现金支付";
var coupon = 0;
var order_code;

$(function(){
	mall_list();//获取商品数据
	
	$("#user_num").change(function(){
		user_num_text = $("#user_num").val();
		if(user_num_text != null && user_num_text != ""){
			$.ajax({//会员接口  检索输入的号码是否是合法会员
				type:"POST",//接口类型
				url:"vipformall/memberinfo_select_member.php",//接口url
				dataType:"json",//请求类型
				async:true,//true异步请求 flase同步请求
				data:{member_card_no:user_num_text},
				beforeSend:function(){loadAnimation();},//请求开始时执行
				success: function(request){
					loadClose();
					console.log(request);
					if(request == false){
						tips("此会员不存在",2000);
					}else{
					    user_name = request.member_name;
						user_num = user_num_text;
                        $("#user_num").after('<span>&nbsp;会员名：'+user_name+'</span>')
					}
				},
				timeout : 20000, //超时时间设置，单位毫秒
				complete : function(XMLHttpRequest,status){
					complete_tips();
				}
			})
		}	
	});
	
	$("#change_code").change(function(){//扫描二维码
		
		//重置折扣
		$("#discount").val("无");
		$("#coupon").val("无");
		
		var now_code = 	$("#change_code").val();//获取扫描的二维码
		var code_length;//定义条形码存在值（1：数据库内有此产品）
		$.each(mall_list_data,function(index,data){//订单信息输出
			if(now_code == data.bar_code){//核查此商品数据库有没有 1：有
				code_length = "1";
			}
			if(data.is_discount == "否" && data.commodity_name.indexOf("组合优惠") < 1){//普通商品
				if(now_code == data.bar_code){
					var mall_nom = 1;//商品数量，初始为1
					if($("#content_left").children("#"+now_code).length>0){//如果商品已经存在订单，直接累加数量
						mall_nom = $("#content_left").children("#"+now_code).children(".pro_nom1").children("input").val();
						mall_nom = Number(mall_nom)+1;
						$("#content_left").children("#"+now_code).children(".pro_nom1").children("input").val(mall_nom);//增加数量
						$("#change_code").val("");
					}else{
						if(data.commodity_name.indexOf("时价产品") >= 1){
							$("#content_left").append('\
								<tr class="unread checked sj_pro_tr" id="'+data.bar_code+'">\
									<td>'+data.bar_code+'</td>\
									<td>'+data.commodity_name+'</td>\
									<td class="y_price1 sj_pro"><input type="text" value="'+data.commodity_price+'" /></td>\
									<td class="z_price1">'+data.commodity_price+'</td>\
									<td class="pro_nom1 pro_nom"><input type="text" value="'+mall_nom+'" /></td>\
									<td class="y_t_price1"></td>\
									<td class="z_t_price1"></td>\
									<td class="right">\
										<a href="#" name="'+data.bar_code+'">删除</a>\
									</td></tr>');
							$("#change_code").val("");
						}else{
							$("#content_left").append('\
								<tr class="unread checked sj_pro_tr" id="'+data.bar_code+'">\
									<td>'+data.bar_code+'</td>\
									<td>'+data.commodity_name+'</td>\
									<td class="y_price1 sj_pro"><input type="text" readonly="readonly" style="border:0; background:none;" value="'+data.commodity_price+'" /></td>\
									<td class="z_price1">'+data.commodity_price+'</td>\
									<td class="pro_nom1 pro_nom"><input type="text" value="'+mall_nom+'" /></td>\
									<td class="y_t_price1"></td>\
									<td class="z_t_price1"></td>\
									<td class="right">\
										<a href="#" name="'+data.bar_code+'">删除</a>\
									</td></tr>');
							$("#change_code").val("");
						}
					}
					var totle_price =  Number(mall_nom)*data.after_discount_price;//计算原价小计
					totle_price = Math.round(totle_price*100)/100;
					var sale_totle_price =  totle_price*zhekou;//计算折扣小计
					sale_totle_price = Math.round(sale_totle_price*100)/100;
					$("#content_left").children("#"+now_code).children(".y_t_price1").html(Math.round(totle_price*100)/100);
					$("#content_left").children("#"+now_code).children(".z_t_price1").html(Math.round(sale_totle_price*100)/100);
				}
				//计算总价
				calcTotal(document.getElementById('dataTables-example1'),5,document.getElementById('totle1'));
				calcTotal(document.getElementById('dataTables-example1'),6,document.getElementById('totle11'));
			}else if(data.is_discount == "是" || data.commodity_name.indexOf("组合优惠") >= 1){//特价商品
				if(now_code == data.bar_code){//匹配条形码
					var mall_nom = 1;//初始数量
					if($("#content_right").children("#"+now_code).length>0){//如果已有本商品 直接叠加数量
						mall_nom = $("#content_right").children("#"+now_code).children(".pro_nom2").children("input").val();
						mall_nom = Number(mall_nom)+1;



						$("#content_right").children("#"+now_code).children(".pro_nom2").children("input").val(mall_nom);//增加数量
						$("#change_code").val("");
					}else{//如果没有本商品 生成数据
						$("#content_right").append('\
							<tr class="unread checked" id="'+data.bar_code+'">\
								<td>'+data.bar_code+'</td>\
								<td>'+data.commodity_name+'</td>\
								<td class="y_price2 sj_pro"><input type="text" readonly="readonly" style="border:0; background:none;" value="'+data.commodity_price+'" /></td>\
								<td class="z_price2">'+data.after_discount_price+'</td>\
								<td class="pro_nom2 pro_nom"><input type="text" value="'+mall_nom+'" /></td>\
								<td class="y_t_price2"></td>\
								<td class="z_t_price2"></td>\
								<td class="right">\
									<a href="#" name="'+data.bar_code+'">删除</a>\
								</td></tr>');
						$("#change_code").val("");
					}
					//计算小计价格
					var totle_price =  Number(mall_nom)*data.commodity_price;
					totle_price = Math.round(totle_price*100)/100;
					var sale_totle_price =  Number(mall_nom)*data.after_discount_price;
					sale_totle_price = Math.round(sale_totle_price*100)/100;
					$("#content_right").children("#"+now_code).children(".y_t_price2").html(totle_price);
					$("#content_right").children("#"+now_code).children(".z_t_price2").html(sale_totle_price);
				}
				//计算总价
				calcTotal(document.getElementById('dataTables-example2'),5,document.getElementById('totle2'));
				calcTotal(document.getElementById('dataTables-example2'),6,document.getElementById('totle22'));
			}
		})
		
		if(code_length != "1"){//核查此商品数据库有没有 1：有
			alert1("警告","color2","数据库内无此产品","确定",closeAlert);
			$("#change_code").val("");
		}
		
		$(".table-responsive tr").each(function(n) {
			$(".table-responsive tr").eq(n).children(".right").children("a").click(function(){//删除商品
				delete_mall_id = $(this).attr("name");
				alert2("删除","color2","确定要删除此商品么？","删除","取消",delete_enter,closeAlert);
			});
			
			$(".table-responsive tr").eq(n).children("td.pro_nom").children("input").change(function(){//输入数量计算小计和总价
			
				//重置优惠
				$("#coupon").val("无");
			
				var key_mall_nom = $(this).val();//输入后的数量
				var key_mall_price = $(this).parent().prev().prev().children("input").val();//此商品的原价/折扣
				var key_sale_mall_price = $(this).parent().prev().html();//特价商品的折扣价
				
				var now_mall = $(this).parent().parent().parent().attr("id");//获取当前商品列表是特价商品还是普通商品 然后重新计算总价
				if(now_mall == "content_left"){//重新计算总价 -- 普通商品
				 
					var totle_price =  Number(key_mall_nom)*key_mall_price;
					totle_price = Math.round(totle_price*100)/100;
					$(this).parent().next().html(totle_price);
					$(this).parent().next().next().html(Math.round(totle_price*zhekou*100)/100);
				
					calcTotal(document.getElementById('dataTables-example1'),5,document.getElementById('totle1'));
					calcTotal(document.getElementById('dataTables-example1'),6,document.getElementById('totle11'));
				}else if(now_mall == "content_right"){//重新计算总价 -- 特价商品
				 
					var totle_price =  Number(key_mall_nom)*key_mall_price;
					totle_price = Math.round(totle_price*100)/100;
					var sale_totle_price =  Number(key_mall_nom)*key_sale_mall_price;
					sale_totle_price = Math.round(sale_totle_price*100)/100;
					$(this).parent().next().html(totle_price);
					$(this).parent().next().next().html(Math.round(sale_totle_price*100)/100);
				
					calcTotal(document.getElementById('dataTables-example2'),5,document.getElementById('totle2'));
					calcTotal(document.getElementById('dataTables-example2'),6,document.getElementById('totle22'));
				}
			});
			
			$(".table-responsive tr").eq(n).children("td.sj_pro").children("input").change(function(){//输入时价计算小计和总价
				var key_mall_price = $(this).val();//输入后的价格
				var key_mall_nom = $(this).parent().next().next().children("input").val();//此商品的原价
				
				var totle_price =  Number(key_mall_nom)*key_mall_price;
				totle_price = Math.round(totle_price*100)/100;
				$(this).parent().next().html(key_mall_price);
				$(this).parent().next().next().next().html(totle_price);
				$(this).parent().next().next().next().next().html(Math.round(totle_price*zhekou*100)/100);
			
				calcTotal(document.getElementById('dataTables-example1'),5,document.getElementById('totle1'));
				calcTotal(document.getElementById('dataTables-example1'),6,document.getElementById('totle11'));
			});
		});
			
		
	});
	
	$("#discount").change(function(){//折扣修改

		//重置优惠
		$("#coupon").val("无");

		var discount_nom = $("#discount").find("option:selected").attr("name");//获取折扣
		zhekou = discount_nom;
		var now_totle1 = $("#totle1").html();//
		var discount_totle = Number(discount_nom)*Number(now_totle1);
		discount_totle = Math.round(discount_totle*100)/100;

		$("#content_left tr").each(function(n){//遍历折后价
			var key_mall_nom = $("#content_left tr").eq(n).children(".pro_nom1").children("input").val();//数量
			var key_mall_price = $("#content_left tr").eq(n).children(".y_price1").children("input").val();//原价

			var sale_price_dan =  Number(key_mall_price)*zhekou;//计算折扣单价
			sale_price_dan = Math.round(sale_price_dan*100)/100;
			$("#content_left tr").eq(n).children(".z_price1").html(sale_price_dan);//修改折扣价

			var sale_price_all =  Number(key_mall_nom)*Number(key_mall_price)*zhekou;//计算折扣总价
			sale_price_all = Math.round(sale_price_all*100)/100;
			$("#content_left tr").eq(n).children(".z_t_price1").html(sale_price_all);//修改折扣价

			calcTotal(document.getElementById('dataTables-example1'),5,document.getElementById('totle1'));
			calcTotal(document.getElementById('dataTables-example1'),6,document.getElementById('totle11'));
		});

		var old_price = Number($("#totle1").html())+Number($("#totle2").html());
		old_price = Math.round(old_price*100)/100;
		var pay_price = Number($("#totle11").html())+Number($("#totle22").html());
		pay_price = Math.round(pay_price*100)/100;

		$("#old_price b").html(Math.round(old_price*100)/100);
		$("#pay_price b").html(Math.round(pay_price*100)/100);
	});

	
	
	$("#coupon").change(function(){//优惠修改
        var old_totle = $("#totle1").html();

        $("#discount option").eq(0).attr("selected","selected");//初始折扣
        $("#discount").val("无");
        $("#totle11").html(old_totle)

		var coupon_nom = $("#coupon").find("option:selected").attr("name");//获取折扣
		coupon = coupon_nom;

		var pay_price = Number(old_totle-coupon_nom);
		pay_price = Math.round(pay_price*100)/100;

		$("#pay_price b,#totle11").html(Math.round(pay_price*100)/100);
	});
	
});

var calcTotal=function(table,column,output){//每列总价计算：表格对象，价格计算的列数（第一列位0），总价输出对象
	var trs=table.getElementsByTagName('tr');
	var start=1,//忽略第一行的表头
		end=trs.length;//忽略最后合计的一行
	var total=0;
	for(var i=start;i<end;i++){
		var td=trs[i].getElementsByTagName('td')[column];
		var t=parseFloat(td.innerHTML);
		if(t)total+=t;
	}
	output.innerHTML=total;//总价显示
	total = Math.round(total*100)/100;
	
	var old_price = Number($("#totle1").html())+Number($("#totle2").html());
	old_price = Math.round(old_price*100)/100;
	var pay_price = Number($("#totle11").html())+Number($("#totle22").html());
	pay_price = Math.round(pay_price*100)/100;
	
	$("#old_price b").html(old_price);
	$("#pay_price b").html(pay_price);
	
};

function delete_enter(){//删除商品
	closeAlert();
	
	var now_mall =$("#"+delete_mall_id).parent().attr("id");//获取当前商品列表是特价商品还是普通商品 然后重新计算总价  zhekou
	
	$("#"+delete_mall_id).remove();
	
	if(now_mall == "content_left"){//重新计算总价
		calcTotal(document.getElementById('dataTables-example1'),5,document.getElementById('totle1'));
		calcTotal(document.getElementById('dataTables-example1'),6,document.getElementById('totle11'));
	}else if(now_mall == "content_right"){
		calcTotal(document.getElementById('dataTables-example2'),5,document.getElementById('totle2'));
		calcTotal(document.getElementById('dataTables-example2'),6,document.getElementById('totle22'));
	}
	$("#discount option").eq(0).attr("selected","selected");//初始折扣
	$("#coupon option").eq(0).attr("selected","selected");//初始优惠
}

//指定参数请求
function mall_list(){
	$.ajax({
		type:"POST",//接口类型
		url:"vipformall/v_commodity_price_select_commodityList.php",//接口url
		dataType:"json",//请求类型
		async:true,//true异步请求 flase同步请求
		beforeSend:function(){loadAnimation();},//请求开始时执行
		//请求成功时执行
		success: function(request){
			mall_list_data = request;
			loadClose();
		},
		timeout : 20000, //超时时间设置，单位毫秒
		//请求完成后最终执行参数
		complete : function(XMLHttpRequest,status){
			complete_tips();
		}
	})
}
//付款确认
function go_pay_end1(){
	closeAlert();
	pay_style = "现金支付";
	alert2("付款确认","color1","客户是否付款成功？","付款成功","放弃付款",generate_order,closeAlert);
	$("#alert_black").unbind();
}
function go_pay_end2(){

	closeAlert();
	pay_style = "网银/手机支付";
	alert2("付款确认","color1","客户是否付款成功？","付款成功","放弃付款",generate_order,closeAlert);
	$("#alert_black").unbind();
}
//付款方式确认
function go_pay(){

    //去除当前时间的所有特殊字符转换为纯数字的字符串
    var s_time = diy_time();
    s_time = s_time.replace(/['\t]/g,'').replace(/\s*/g, '') //去空格
    s_time = stripscript(s_time);
    s_time = s_time.substring(8);
    //时间字符串+4为随机数 组成订单编号
    order_code =  s_time+""+parseInt(10*Math.random())+""+parseInt(10*Math.random())+""+parseInt(10*Math.random())+""+parseInt(10*Math.random());

	var mall_1 = $("#content_left tr").length;
	var mall_2 = $("#content_right tr").length;
	if(mall_1 == 0 && mall_2 == 0){
		alert1("结算产品为空","color1","请把光标放入右上角框内扫描商品后操作！","确认",closeAlert);
	}else{
		alert2("付款方式","color1","确认用户选择的付款方式","现金支付","网银/手机支付",go_pay_end1,go_pay_end2);
	}
	$("#alert_black").unbind();
}

var data;
var data_left = [];
var data_right = [];
//整理订单数据
function generate_order(){
    closeAlert();
    loadAnimation();
	var pro_list = [];
	$("#content_left tr").each(function(r){
		var td = $("#content_left tr").eq(r).children("td");
		data_left.push({"code":td.eq(0).html(),"name":td.eq(1).html(),"price":td.eq(2).children("input").val(),"sale_price":td.eq(3).html(),"num":td.eq(4).children("input").val(),"price_all":td.eq(5).html(),"sale_price_all":td.eq(6).html()});
		pro_list.push({"code":td.eq(0).html(),"name":td.eq(1).html(),"price":td.eq(2).children("input").val(),"sale_price":td.eq(3).html(),"num":td.eq(4).children("input").val(),"price_all":td.eq(5).html(),"sale_price_all":td.eq(6).html()});
	});
	$("#content_right tr").each(function(r){
		var td = $("#content_right tr").eq(r).children("td");
		pro_list.push({"code":td.eq(0).html(),"name":td.eq(1).html(),"price":td.eq(2).children("input").val(),"sale_price":td.eq(3).html(),"num":td.eq(4).children("input").val(),"price_all":td.eq(5).html(),"sale_price_all":td.eq(6).html()});
		data_right.push({"code":td.eq(0).html(),"name":td.eq(1).html(),"price":td.eq(2).children("input").val(),"sale_price":td.eq(3).html(),"num":td.eq(4).children("input").val(),"price_all":td.eq(5).html(),"sale_price_all":td.eq(6).html()});
	});
	var old_price_all = $("#old_price b").html();
	var pay_price_all = $("#pay_price b").html();
	var last_date = diy_data;
	var last_time = diy_time;
	var order_remark = $("#order_remark").val()+"   付款方式："+pay_style;

	data = {
		commodityList:pro_list,
		order_date:last_date(),
		order_total_price:old_price_all,
		order_after_discount_price:pay_price_all,
		order_remark:order_remark,
		order_code:order_code,
		order_operator:operator,
		last_operator:operator,
		order_member_code:user_num,
		order_address:catalog_name,
		last_time:diy_time()
	}
	
	payment();
}

function stripscript(s) {//去除特殊字符（空格去不掉）
    var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*--（）——|{}【】‘；：”“'。，、？]") 
    var rs = ""; 
    for (var i = 0; i < s.length; i++) {
        rs = rs+s.substr(i, 1).replace(pattern, ''); 
    } 
    return rs;
}
//生成订单
function payment(){
	if(!navigator.onLine){//网络判断
		closeAlert();
		alert1("提示","color1","网络已断开，请链接网络后重试","确定",closeAlert);
		return;
	} 
	$.ajax({
		type:"POST",//接口类型
		url:"vipformall/salesorder_insert_order.php",//接口url
		dataType:"json",//请求类型
		async:true,//true异步请求 flase同步请求
		data:data,
		//beforeSend:function(){loadAnimation();},//请求开始时执行
		success: function(request){
			console.log(request);
			if(request == 1){
				tips("订单生成成功",2000);
				setTimeout(function(){print_choose();}, 2000);
			}else{
                loadClose();
				tips("订单生成失败，请稍后重试！",3000);
			}
		},
		timeout : 20000, //超时时间设置，单位毫秒
		complete : function(XMLHttpRequest,status){
			complete_tips();
		}
	})
}
//打印选择
function print_choose(){
    loadClose();
	alert2("小票打印","color1","请选择打印类型","打印客户联","打印存根联",print_kh,printttttt);
	$("body").append('<a href="payment.php" style=" width:150px; height:60px; background-color:#6eb92b;font-family:微软雅黑; color:#FFF; text-align:center; line-height:60px; font-size:18px; text-decoration:none; display:block; position:absolute; bottom:10px; right:10px; z-index:99999;">开始下一单</a>');
	$("#alert_black").unbind();
}
function print_kh(){
	print_info("客户联");
}
function printttttt(){
	print_info("存根联");
}
//打印内容
function print_info(text){
		
	//先清空打印内容
	$("#print_list thead td").eq(0).html("");
	$("#print_list thead td").eq(1).html("");
	$("#print_list tbody tr,#print_list tfoot tr").remove();
	//填充打印内容
	$("#print_list thead td").eq(0).html(text);
	//$("#print_list thead td").eq(1).html(data.order_address);
	if(data_left != null && data_left.length != 0){
		$.each(data_left,function(i,print_text){
			$("#print_list tbody").append('\
				<tr><td style="font-size:14px;">'+print_text.num+'&nbsp;&nbsp;x&nbsp;&nbsp;&nbsp;&nbsp;'+print_text.name+'</td></tr>\
				<tr><td style="margin-bottom:10px;" align="right">小计：￥'+print_text.sale_price_all+'</td></tr>\
				<tr><td>&nbsp;</td></tr>\
			');
		});
	}
	if(data_right != null && data_right.length != 0){
		$("#print_list tbody").append('\
			<tr class="add_tj_tit"><td>&nbsp;</td></tr>\
			<tr class="add_tj_tit"><td align="center">特价商品</td></tr>\
			<tr class="add_tj_tit"><td align="center">-------------------------------------</td></tr>\
			<tr class="add_tj_tit"><td>&nbsp;</td></tr>\
		')
		$.each(data_right,function(i,print_text){
			$("#print_list tbody").append('\
				<tr class="add_tj_text"><td style="font-size:14px;">'+print_text.num+'&nbsp;&nbsp;x&nbsp;&nbsp;&nbsp;&nbsp;'+print_text.name+'</td></tr>\
				<tr class="add_tj_text"><td style="margin-bottom:10px;" align="right">小计：￥'+print_text.sale_price_all+'</td></tr>\
				<tr class="add_tj_text"><td>&nbsp;</td></tr>\
			');
		})
	}
	if(data_right != null || data_right != ""){
		$.each(data_right,function(i,print_text){
			if(print_text.name.indexOf("组合优惠") >= 1){//搜索组合商品优惠卷
				//添加组合打印票头
				$("#print_list tbody").append('\
					<tr><td>&nbsp;</td></tr>\
					<tr><td align="center">组合优惠</td></tr>\
					<tr><td align="center">-------------------------------------</td></tr>\
					<tr><td>&nbsp;</td></tr>\
				')
				//从组合商品名中获取产品条形码和优惠价格
				/*var code1 = print_text.name.match(/产品A(\S*)产品B/)[1];	
				var code2 = print_text.name.match(/产品B(\S*)组合优惠/)[1];
				var sale_pice_zuhe = print_text.name.match(/(\S*)E/)[1];
				var sale_name = print_text.name.split("(组合优惠)")[1];*/
				var sale_name = print_text.name.split(")")[1];	
				//渲染小票
				/*var name1,name2,num1,num2,sale_price_all1,sale_price_all2;
				$.each(data_left,function(i,print_text){//搜索到后 提取组合商品信息
					if(print_text.code == code1){
						name1 = print_text.name;
						num1 = print_text.num;
						sale_price_all1 = print_text.sale_price_all;
					}
					if(print_text.code == code2){
						name2 = print_text.name;
						num2 = print_text.num;
						sale_price_all2 = print_text.sale_price_all;
					}
				});*/
				$("#print_list tbody tr td").each(function(i){//删除上面的组合产品信息
					var td_string = $("#print_list tbody tr td").eq(i).html();
					if(/*td_string.indexOf(name1) >= 1 || td_string.indexOf(name2) >= 1 || */td_string.indexOf("组合优惠") >= 1){
						$(this).parent("tr").hide();
						$(this).parent("tr").next("tr").hide();
						$(this).parent("tr").next("tr").next("tr").hide();
						
						/*if($("#content_right tr.add_tj_text").is(":hidden")){
							$(".add_tj_tr").hide();
						}*/
					}
				});
				$("#print_list tbody").append('\
					<tr><td style="font-size:14px;">'+sale_name+'</td></tr>\
					<tr><td>&nbsp;</td></tr>\
				');
			}
		});
	}
	if(coupon != 0){
		var coupon_nomber = $("#coupon").find("option:selected").attr("name");
		var coupon_text = $("#coupon").find("option:selected").html();
		$("#print_list tbody").append('\
			<tr><td>&nbsp;</td></tr>\
			<tr><td align="center">-------------------------------------</td></tr>\
			<tr><td>&nbsp;</td></tr>\
			<tr><td align="left" style="font-weight:bold;font-size:14px;">&nbsp;'+coupon_text+'：&nbsp;&nbsp;&nbsp;&nbsp;-'+coupon_nomber+'元</td></tr>\
		')
		
	}
	$("#print_list tfoot").append('\
        <tr><td>&nbsp;</td></tr>\
        <tr><td align="center">-------------------------------------</td></tr>\
        <tr><td>&nbsp;</td></tr>\
		<tr><td align="right" style="font-size:18px;">总金额：￥'+data.order_after_discount_price+'</td></tr>\
        <tr><td>&nbsp;</td></tr>\
        <tr><td align="center">-------------------------------------</td></tr>\
        <tr><td>&nbsp;</td></tr>\
	');
	if(user_num != ""){
        $("#print_list tfoot").append('\
		<tr><td>会员：'+user_num+'</td></tr>\
        <tr><td>&nbsp;</td></tr>\
	');
    }
    $("#print_list tfoot").append('\
		<tr><td>操作员：'+data.order_operator+'</td></tr>\
		<tr><td>门店：'+data.order_address+'</td></tr>\
		<tr><td>订单号：'+data.order_code+'</td></tr>\
		<tr><td>'+data.last_time+'</td></tr>\
        <tr><td>&nbsp;</td></tr>\
	');
	print_list();
}
function print_cg(){
}
//打印小票
var LODOP; //声明为全局变量
function print_list(){	
	LODOP=getLodop();         
	LODOP.PRINT_INIT("");
	LODOP.ADD_PRINT_TABLE(1,9,"100%","100%",document.getElementById("print_list").innerHTML);
	LODOP.SET_PRINT_PAGESIZE(3,1385,45,"");
	LODOP.PREVIEW(); 
	//LODOP.PRINT();
	$("iframe").parent().parent().css("z-index","999999");
}
/*
var str = "产品A2017030708产品B2017030709组合优惠E10";  
str = str.match(/产品A(\S*)产品B/)[1];  
var sale_data = [];
sale_data.push({"data1":{"code":"1","name":"1"}})
*/
</script>
</html>