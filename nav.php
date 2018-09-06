<html>
<div class="sidebar-menu">
	<div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span>
		<!--<img id="logo" src="" alt="Logo"/>-->
	</a> </div>
	<div class="menu">
		<ul id="menu" >

			<li>
				<a href="index.php"><i class="glyphicon glyphicon-home"></i><span>首页</span></a>
			</li>

			<li>
				<a href="payment.php"><i class="glyphicon glyphicon-euro"></i><span>出单</span></a>
			</li>

			<li>
				<a href="mall_list.php"><i class="glyphicon glyphicon-th-list"></i><span>商品</span><span class="fa fa-angle-right" style="float: right"></span></a>
				<ul>
					<li><a href="mall_list.php">商品列表</a></li>
					<li><a href="mall_add.php">添加商品</a></li>
					<li><a href="sale_mall_list.php">折扣商品</a></li>
					<li><a href="sale_mall_add.php">添加折扣商品</a></li>
					<li><a href="inboundrecord_add.php">商品入库</a></li>
					<li><a href="inboundrecord.php">入库记录</a></li>
					<li><a href="outboundrecord_add.php">商品出库</a></li>
					<li><a href="outboundrecord.php">出库记录</a></li>
				</ul>
			</li>
            
			<li>
				<a href="user_list.php"><i class="glyphicon glyphicon-list-alt"></i><span>会员</span></a>
			</li>

			<li>
				<a href="order_details_list.php"><i class="glyphicon glyphicon-list-alt"></i><span>订单</span><span class="fa fa-angle-right" style="float: right"></span></a>
				<ul>
					<li><a href="order_details_list.php">产品订单</a></li>
					<li><a href="sales_order_list.php">销售订单</a></li>
                    <li><a href="exchange_order.php">换购订单</a></li>
				</ul>
			</li>

			<li>
				<a href="returns_list.php"><i class="glyphicon glyphicon-euro"></i><span>退货</span><span class="fa fa-angle-right" style="float: right"></span></a>
				<ul>
					<li><a href="returns_list.php">退货列表</a></li>
					<li><a href="returns_add.php">申请退货</a></li>
				</ul>
			</li>
			<div class="clearfix"> </div>
		</ul>
	</div>
</div>
<script>
	
	//设置导航最小高度
	$(function(){
		$(".sidebar-menu").css({"min-height":"1020px"});
	
		var toggle = true;
		$(".sidebar-icon").click(function() {
			if (toggle)
			{
				$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
				$("#menu span").css({"position":"absolute"});
			}
			else
			{
				$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
				setTimeout(function() {
					$("#menu span").css({"position":"relative"});
				}, 400);
			}
			toggle = !toggle;
		});
	})

	//权限设置 sales：销售员 admin：门店管理 sys_admin：总管理
	if(user_type == "sales"){
		$("#menu li").eq(2).remove();
		$("#menu li").eq(3).remove();	
	}
</script>
</html>