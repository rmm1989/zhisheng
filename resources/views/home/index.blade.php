<!DOCTYPE html>
<html lang="en">
<head>
	<title>助听器</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('homes')}}/style/css/ch-ui.admin.css">
	<link rel="stylesheet" href="{{asset('homes')}}/style/font/css/font-awesome.min.css">
	<script type="text/javascript" src="{{asset('homes')}}/style/js/jquery.js"></script>
    <script type="text/javascript" src="{{asset('homes')}}/style/js/ch-ui.admin.js"></script>
</head>
<body>
	<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">亿启听</div>
			<ul>
				<li><a href="#" class="active">首页</a></li>
				<li><a href="#">管理页</a></li>
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>管理员：admin</li>
				<li><a href="pass.html" target="main">修改密码</a></li>
				<li><a href="#">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>

			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>听力测试</h3>
				<ul class="sub_menu">
					<li><a href="{{url('listen/listening_test')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>听力自测</a></li>
					<li><a href="{{url('service/listening_test')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>专业测试</a></li>
					<li><a href="{{url('listen/hearing_sense')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>听力常识</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>预约服务</h3>
				<ul class="sub_menu">
					<li><a href="{{url('service/listening_test')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>预约听力测试</a></li>
					<li><a href="{{url('service/order_maintenance')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>预约设备保养</a></li>
					<li><a href="{{url('service/fault_handling')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>预约故障处理</a></li>
					<li><a href="{{url('service/re_service')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>预约上门服务</a></li>
					<li><a href="{{url('service/se_notice')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>预约服务通知</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>共享助听</h3>
				<ul class="sub_menu">
					<li><a href="{{url('share/ideas')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>共享理念</a></li>
					<li><a href="{{url('share/hearing_aid')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>助听设备</a></li>
					<li><a href="{{url('share/return_equipment')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>退还设备</a></li>
					<li><a href="{{url('share/common_sense')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>使用常识</a></li>
					<li><a href="{{url('share/hearing_map')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>助听地图</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>助力商城</h3>
				<ul class="sub_menu">
					<li><a href="{{url('shop/index')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>商城首页</a></li>
					<li><a href="{{url('shop/submit_address')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>提交收货地址</a></li>
					<li><a href="{{url('shop/detail')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>商品详情</a></li>
					<li><a href="{{url('shop/order')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>提交订单</a></li>
					<li><a href="{{url('shop/pay')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>在线支付</a></li>
				</ul>
			</li>
			<li>

				<h3><i class="fa fa-fw fa-clipboard"></i>个人中心</h3>
				<ul class="sub_menu">
					<li><a href="{{url('announcement')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>平台公告</a></li>
					<li><a href="{{url('center/account')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>账户信息</a></li>
					<li><a href="{{url('center/cash')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>余额提现</a></li>
					<li><a href="{{url('center/record')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>推广记录</a></li>
					<li><a href="{{url('center/cooperation')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>商业合作</a></li>
					<li><a href="{{url('center/free_for')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>免费申领</a></li>
					{{--<li><a href="{{url('center/wallet')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>我的钱包</a></li>
					<li><a href="{{url('center/money')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>资金流水</a></li>
					<li><a href="{{url('center/self_order')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>我的订单</a></li>
					<li><a href="{{url('center/my_device')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>我的设备</a></li>
					<li><a href="{{url('center/get_money')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>推广赚钱</a></li>
					<li><a href="{{url('center/online_service')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>在线客服</a></li>
					--}}
				</ul>
			</li>


        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="{{url('info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight © 2017. Powered By <a href="http://www.abc.com">http://www.abc.com</a>.
	</div>
	<!--底部 结束-->
</body>
</html>