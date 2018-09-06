var alert_id;
var pageURL= window.location.href;//获取url
var pageLocation= window.location.host;//获取域名

function getQueryString(href,name){//获取链接上的属性值
	var reg = new RegExp("(^|&|\\?)" + name + "=([^&]*)(&|$)");
	var args = href.match(reg);
	if(args != null && args.length > 2){
		if(args[2]) return unescape(args[2]);
	}
	return null;   
};

var win_w = $(window).width();
var win_h = $(window).height();

//获取用户信息
var catalog_name = localStorage.getItem("catalog_name");//门店
var user_type = localStorage.getItem("user_type");//账户类型
var operator = localStorage.getItem("username");//账户名

var pagename = $("body").attr("name");
if(pagename != "login"){
	if(operator == null || operator == ""){
		gopage('login.html');
	}
}


///////////////////////////↓↓↓↓↓弹出框↓↓↓↓↓//////////////////////////

var alert2 = function(tit,tit_color,text,but21,but22,callback21,callback22){//双按钮提示框 按钮跳转传函数给callback21,callback22   closeAlert是关闭弹出框
	$("body").append('<div id="alert_black"></div>');	
	$("body").append('<div id="'+ alert_id +'"><h2 class="'+ tit_color +'">'+ tit +'</h2><p>'+ text +'</p><ul><li class="li1" id="but21">'+ but21 +'</li><li class="li2" id="but22">'+ but22 +'</li></ul>');
	$("#alert_black").fadeIn();
	$("#alert_black").css("height",$(window).height());
	$("#"+ alert_id).fadeIn();
	$("#alert_black").click(function(){
		$("#alert_black").fadeOut().remove();
		$("#"+ alert_id).fadeOut().remove();
	});	
	$("#but21").click(function(){
		callback21.call();
	});
	$("#but22").click(function(){
		callback22.call();
	});
}	
//alert22('标题','提示内容','按钮1名称','按钮2名称',按钮1触发事件,按钮2触发事件);
var alert_id = "alert_ios";
var alert1 = function(tit,tit_color,text,but11,callback11){//双按钮提示框 按钮跳转传函数给callback21 closeAlert是关闭弹出框

	$("body").append('<div id="alert_black"></div>');	
	$("body").append('<div id="'+ alert_id +'"><h2 class="'+ tit_color +'">'+ tit +'</h2><p>'+ text +'</p><ul><li class="li11" id="but11">'+ but11 +'</li></ul>');
	$("#alert_black").fadeIn();
	$("#alert_black").css("height",$(window).height());
	$("#"+ alert_id).fadeIn();
	$("#alert_black").click(function(){
		$("#alert_black").fadeOut().remove();
		$("#"+ alert_id).fadeOut().remove();
	});	
	$("#but11").click(function(){
		callback11.call();
	});
}	
//alert1('标题','提示内容','按钮名称',按钮触发事件);')

var closeAlert = function(){//关闭提示框
	$("#alert_black").fadeOut().remove();
	$("#"+ alert_id).fadeOut().remove();
}
///////////////////////////↑↑↑↑↑弹出框↑↑↑↑↑//////////////////////////

/*loading*/
var loadAnimation = function(){//载入动画
	$("body").append('<div id="logo_load"><div class="logo_load"><div class="spinner1"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div></div>');
	$("#logo_load").show();
	$("#logo_load").css("height",$(window).height());
}	
var loadClose = function(){//关闭动画
	$("#logo_load").hide();
	$("#logo_load").remove();
}

//下拉选择框
function dd_list(id,tit,text,callback){
	/*
	id:写入弹出框的id，tit:弹出标题，text:弹出内容的数组，callback回调函数用语接收id和text
	function callback(id,text){
		$("#res_style span").html(text+"--"+id);
	}
	text举例：var dd_list_text = [{"id":"a","text":"aaaaaaaa"},{"id":"b","text":"bbbbbbbbbbbb"}];
	dd_list("choose_box","请选择",dd_list_text,"callback");
	
	如果需要三个参数就直接传 var dd_list_text = [{"id":"a","text":"aaaaaaaa","name":"11111"},{"id":"b","text":"bbbbbbbbbbbb","name":"22222"}]; 回调直接接收callback(id,text,three)
	*/
	
	$("body").append('<div id="'+ id +'" class="dd_list"><h3>title</h3><ul></ul><p>关闭</p></div><div id="maskblack"></div>');	
	
	$("#maskblack").fadeIn();
	
	$.each( text, function(index, content){
		if(content.name != null && content.name != ""){
			$("#"+id+" ul").append('<li name="'+ content.name +'" id="'+content.id+'" onclick='+callback+'("'+content.id+'","'+content.text+'","'+ content.name +'")>'+content.text+'</li>');
		}else{
			$("#"+id+" ul").append('<li id="'+content.id+'" onclick='+callback+'("'+content.id+'","'+content.text+'")>'+content.text+'</li>');
		}
	});
	
	//弹出框高度，标题高度，关闭条高度，页面头条高度，页面底部高度，内容显示高度，未超出高度范围的top，超出高度范围的top
	var box_h = $("#"+id).height();
	var h3_h = $("#"+id+" h3").height();
	var p_h = $("#"+id+" p").height();
	var top_h = $("header").height();
	var bot_h = $("footer").height();
	var body_h = win_h-top_h-bot_h-h3_h-p_h-50;
	var top_pos = (win_h-box_h)/2;
	var top_pos_srcoll = top_h+25;
	
	if(box_h > body_h){
		$("#"+id+" ul").css({"height":body_h});
		$("#"+id).css({"top":top_pos_srcoll});
	}else{
		$("#"+id+" ul").css({"height":"auto"});
		$("#"+id).css({"top":top_pos});		
	}
	
	$("#"+id+" h3").html(tit);
	$("#"+id).fadeIn(function(){
		$("#"+id+" p").click(function(){
			$("#"+id+",#maskblack").fadeOut(function(){
				$("#"+id+",#maskblack").remove();
			});
		});
	});
	
	$("#"+id+" ul li").click(function(){
		$("#"+id+",#maskblack").fadeOut(function(){
			$("#"+id+",#maskblack").remove();
		});
	});
}

//tips
function tips(text,time){
	/*
	text:tips的文字
	time：tips多久后消失
	例：tips("tips",2000);
	*/
	if($("#tips").length>0){
		$("#tips").remove();
	}
	$("body").append('<em id="tips">'+text+'</em>');
	$("#tips").fadeIn();
	var tips_w = $("#tips").width()+20;
	var tips_left = (win_w-tips_w)/2;
	var tips_left = (win_w-tips_w)/2;
	
	if(tips_w < win_w-40){
		$("#tips").css("left",tips_left);
	}else{
		$("#tips").css({"left":"20px","width":win_w-60});
	}
	setTimeout(tips_out,time);
}
function tips_out(){
	$("#tips").fadeOut(function(){
		$("#tips").remove();
	});
}

//时间格式 输出为 2016-00-00 00:00:00的string格式
var diy_time = function(){
	new_time =new Date();
	var y = new_time.getFullYear(); //year 
	var m = new_time.getMonth()+1; //month 
	var d = new_time.getDate(); //day 
	var h = new_time.getHours(); //hour 
	var f = new_time.getMinutes(); //minute 
	var s = new_time.getSeconds();
	m = m.toString();
	d = d.toString();
	h = h.toString();
	f = f.toString();
	s = s.toString();
	if(m.length==1){m="0"+m;}
	if(d.length==1){d="0"+d;}
	if(h.length==1){h="0"+h;}
	if(f.length==1){f="0"+f;}
	if(s.length==1){s="0"+s;}
	var new_timer = y+"-"+m+"-"+d+" "+h+":"+f+":"+s;	
	return new_timer;
};

//时间格式 输出为 2016-00-00的string格式
var diy_data = function(){
	new_time =new Date();
	var y = new_time.getFullYear(); //year 
	var m = new_time.getMonth()+1; //month 
	var d = new_time.getDate(); //day 
	m = m.toString();
	d = d.toString();
	if(m.length==1){m="0"+m;}
	if(d.length==1){d="0"+d;}
	var new_timer = y+"-"+m+"-"+d;	
	return new_timer;
};

//时间格式 输出为 2016-00-00的string格式
var diy_datatime = function(){
	new_time =new Date();
	var y = new_time.getFullYear(); //year
	var m = new_time.getMonth()+1; //month
	var d = new_time.getDate(); //day
	var h = new_time.getHours(); //hour
	var f = new_time.getMinutes(); //minute
	var s = new_time.getSeconds();
	m = m.toString();
	d = d.toString();
	h = h.toString();
	f = f.toString();
	s = s.toString();
	if(m.length==1){m="0"+m;}
	if(d.length==1){d="0"+d;}
	if(h.length==1){h="0"+h;}
	if(f.length==1){f="0"+f;}
	if(s.length==1){s="0"+s;}
	var new_timer = y+""+m+""+d+""+h+""+f+""+s;
	return new_timer;
};

//请求出错时候的处理
function complete_tips(){
	loadClose();
	//超时,status还有success,error等值的情况
	if(status=='timeout'){
		alert1('提示','color1','系统繁忙，请稍后重试！','确定',closeAlert);
	//请求错误
	}else if(status=='error'){
		alert1('提示','color1','系统繁忙，请稍后重试！','确定',closeAlert);
	}	
}

//跳转
function gopage(url){
	window.location.href = url;
}