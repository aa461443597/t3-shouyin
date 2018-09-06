<html>
			<div class="header-main">
				<div class="header-left">
					<div class="logo-name">
						<h1 id="header_h1"></h1>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="header-right">
					<div class="profile_details">
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">
										<div class="user-name">
											<p></p>
											<p></p>
										</div>
										<i class="fa fa-angle-down lnr"></i>
										<i class="fa fa-angle-up lnr"></i>
										<div class="clearfix"></div>
									</div>
								</a>
								<ul class="dropdown-menu drp-mnu">
									<li id="Logout"><i class="fa fa-sign-out"></i>注销登录</li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/index.js"></script>
<script>
	
	//管理员下拉菜单
	$(function(){
		
		$("#header_h1").html($("title").html());	
		
		$(".user-name p").eq(0).html(operator);
		$(".user-name p").eq(1).html(catalog_name);
		
		$(".profile_img .lnr").eq(0).click(function(){
			$(".profile_img .lnr").eq(0).fadeOut("fast");
			$(".profile_img .lnr").eq(1).fadeIn("fast",function(){
				$(".drp-mnu").show();
			}).click(function(){
				$(".profile_img .lnr").eq(0).fadeIn("fast");
				$(".profile_img .lnr").eq(1).fadeOut("fast",function(){
					$(".drp-mnu").fadeOut("fast");
				});
			});
		});
		
		$("#Logout").click(function(){//catalog_name  user_type   
			localStorage.removeItem("catalog_name");
			localStorage.removeItem("user_type");
			localStorage.removeItem("username");
			
			if($("#tips").length>0){
				$("#tips").remove();
			}
			$("body").append('<em id="tips" style=" font-style:normal; padding:50px 100px; background-color:rgba(0,0,0,0.8); color:#FFF; line-height:1rem; font-size:14px; position:fixed; top:35%; display:block; -moz-border-radius:8px; -webkit-border-radius:8px; border-radius:8px; word-wrap: break-word; word-break: normal; text-align:center; box-shadow:0 0 50px #FFFFFF; -webkit-box-shadow:0 0 50px #FFFFFF; z-index:9999;">注销成功</em>');
			$("#tips").fadeIn();
			var tips_w = $("#tips").width()+20;
			var tips_left = (win_w-tips_w)/2;
			var tips_left = (win_w-tips_w)/2;
			
			if(tips_w < win_w-40){
				$("#tips").css("left",tips_left);
			}else{
				$("#tips").css({"left":"20px","width":win_w-60});
			}
			setTimeout(function(){
				$("#tips").fadeOut(function(){
					$("#tips").remove();
					gopage("login.html");
				});
			},1500);
			
		});
	});
	
</script>
</html>