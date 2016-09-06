<!doctype html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>资料管理系统</title>
		
		<style>
		    /* 初始化样式 */
			body,ul,li,p,span,a,h1,h2,h3,input,button{
				margin: 0;
				padding: 0;
			}
			.bg{
				background: -webkit-linear-gradient(top, #169, #069);
				background: -webkit-linear-gradient(top, #2fc0f0, #1ec0e0);
			}
			.bgimg{
				background:#ccc url('../images/bg.png');
			}
			ul,li{
				list-style: none;
			}
			a{
				text-decoration: none;
			}
			input,img{
				border: 0;
				outline: 0;
			}

			/* 预定义样式 */
			h1{
				text-align: center;
				color: red;
				margin-top: 10px;
			}
			h2{
				margin-top: 50px;
				text-align: center;
				color: red;
			}
			h3{
				border: 1px solid #048;
				padding: 5px;
				margin: 10px 10px 5px;
				background: rgba(0, 0, 0, 0.3);
			}
			.fl{
				float: left;
			}
			.fr{
				float: right;
			}
			.mt20{
				margin-top: 20px;
			}
			.mr10{
				margin-right: 10px;
			}
			.ml10{
				margin-left: 10px;
			}
			/* 没有数据时显示样式 */
			.no-data{
				padding:8px;
				color: red;
				font-size: 16px;
				font-weight: bold;
				display: inline-block;
			}
			/* 分布显示样式 */
			.page{
				height: 39px;
				line-height: 39px;
				margin-right: 12px;
				color: #f00;
				font-size: 16px;
				font-weight: bold;
			}
			.page em{
				font-style: normal;
				margin: 0 5px;
				color: #fff;
			}
			a{
				color: #fff;
			}
			a:hover{
				color: #ff4a00;
			}
			/* 后台提示信息(成功失败信息) */
			.admin-mess{
				width:300px;
				margin:0px auto; 
				text-align:center;
				position: relative;
				font-size: 20px;
				text-shadow: 0 0 20px #ccc;
				left: 0;
				top: -100px;
				color: #fff;
				-webkit-animation:posit 2s ease-out;
				animation:posit 2s ease-out;
			}
			@-webkit-keyframes posit{
				0%{opacity:0; left: 0; top:-100px;}
				30%{opacity:0.3; left: 0; top:-80px;}
				50%{opacity:0.7; left: 0; top:-50px;}
				70%{opacity:0.7; left: 0; top:-20px;}
				100%{opacity:1; left: 0; top:-0px;}
			}

			/* 登录界面样式开始 */
			ul.login{
				width: 440px;
				margin: 60px auto;
				box-shadow: 0px 0px 10px #ff4a00;
				padding: 30px;
				background: rgba(0, 0, 0, 0.3);
				/* filter:opacity(0.3); */
				border-radius: 20px;
			}
			ul.login li{
				height: 50px;
				line-height: 50px;
			}
			ul.login .login-text{
				width:80px;
				font-size: 18px;
				font-weight: bold;
				color: #fff;
				display: inline-block;
			}
			ul.login .login-user, ul.login .login-pass, ul.login .login-verify{
				padding: 10px 28px 10px 8px;
				border: 1px solid #ccc;
				box-shadow: 0 0 10px #ff4a00 inset;
			}
			ul.login .login-verify{
				padding: 10px 8px;
				margin: 6px 7px;
			}
			ul.login .verify-img{
				margin-top: 6px;
				width: 98px;
				height: 40px;
				cursor: pointer;
			}
			.admin-error{
				width:300px;
				margin:0px auto; 
				text-align:center;
				position: relative;
				font-size: 20px;
				text-shadow: 0 0 20px #ccc;
				left: 0;
				top: -100px;
				color: #fff;
				-webkit-animation:posit 2s ease-out;
				animation:posit 2s ease-out;
			}
			@-webkit-keyframes posit{
				0%{opacity:0; left: 0; top:-100px;}
				30%{opacity:0.3; left: 0; top:-80px;}
				50%{opacity:0.7; left: 0; top:-50px;}
				70%{opacity:0.7; left: 0; top:-20px;}
				100%{opacity:1; left: 0; top:-0px;}
			}
			.error-text{
				height: 20px;
				font-weight: bold;
				color: #f00;
				margin-left: 10px;
				overflow: hidden;
				-webkit-animation:margin 2s ease-out;
				animation:margin 2s ease-out;
			}
			@-webkit-keyframes margin{
				0%{opacity:0; margin-left: 40px; }
				30%{opacity:0.3; margin-left: 30px; }
				70%{opacity:0.7; margin-left: 20px; }
				100%{opacity:1; margin-left: 10px; }
			}
			ul.login .submitbtn{
				margin-top: 10px;
				width: 188px;
				padding: 12px 0;
				font-size: 16px;
				font-weight: bold;
				background: #ff4a00;
				color: #fff;
				margin-left: 88px;
				cursor: pointer;
				box-shadow: 0 0 10px #ff4a00;
			}
			/* 登录界面样式结束 */

			/* 头部样式开始 */
			.topbar{
				margin-right: 50px;
			}
			.topbar li{
				float: left;
				height: 30px;
				line-height: 30px;
			}
			.topbar li small{
				margin: 0 10px;
				color: #fafafa;
			}
			.topbar li a{
				color: #fff;
			}
			.topbar li a:hover{
				color: #B4E400;
			}
			/* 头部样式结束 */

			/* 导航界面样式开始 */
			.menu{
				margin: 10px;
				padding: 10px;
				background: rgba(0, 0, 0, 0.3);
				border-radius: 6px;
			}
			.menu .block{
				border-bottom: 1px solid #ccc;
			}
			.menu .block:last-child{
				border: none;
			}
			.menu .block a, .menu .block span{
				width: 100%;
				height: 30px;
				line-height: 30px;
				display: block;
			}
			.menu .block span{
				color: #fafafa;
			}
			.menu .block a small, .menu .block span small{
				color: #fafafa;
				margin-right: 8px;
				border-radius: 6px;
				vertical-align: middle;
				text-align: center;
				background: #666;
				border: 1px solid #666;
			}
			.menu .block .hidden{
				display: none;
			}
			.menu .block .box a{
				margin-left: 20px;
				height: 30px;
				line-height: 30px;
				display: block;
			}
			.box{display: none;}

			.menu .block:hover .box{
				display: block;
			}
			.menu .block:hover .show{
				display: none;
			}
			.menu .block:hover .hidden{
				display: inline;
			}
			/* 导航界面样式结果 */
			.main-header{
				margin:10px;
				padding: 8px;
				color: #fff;
				background: rgba(0, 0, 0, 0.3);
			}

			/* 列表显示样式开始 */
			.showlist{
				margin: 10px;
				border: 1px solid #048;
				background: #ccc;
			}
			.showlist span{
				text-align: center;
				width: 20%;
				float: left;
				height: 39px;
				line-height: 39px;
				overflow: hidden;
			}
			.rolelist span{
				width: 33.3%;
			}
			.showlist .header span{
				background: rgba(187,221,238, 0.3);
				color: #fff;
				font-weight: bold;
			}
			.showlist .text span{
				background: rgba(0, 0, 0, 0.3);
			}
			/* 列表显示样式结束 */

			/* 详细列表样式开始 */
			.detail{
				margin:10px;
				padding: 8px;
				color: #fff;
				background: rgba(0, 0, 0, 0.3);
			}
			/* 详细列表样式结束 */

			/* 添加界面样式开始 */
			.exec{
				width:600px;
				margin: 60px auto;
				padding: 20px;
				box-shadow: 0 0 10px #048;
				background: rgba(0, 0, 0, 0.3);
			}
			.exec li{
				height: 50px;
				min-height: 50px;
			}
			.exec .add-text{
				width: 140px;
				display: inline-block;
				font-weight: bold;
				color: #fff;
			}
			.exec li input{
				padding: 8px 32px 8px 8px;
				border-radius: 3px;
			}
			.submitbtn{
				color: #fff;
				padding: 8px 20px;
				width: 190px;
				height: 36px;
				display: inline-block;
				cursor: pointer;
				background: #ff4a00;
				font-weight: bold;
			}
			/* 添加界面样式结束 */

			/* 分配权限样式开始 */
			.distribute{
				margin: 10px;
				padding: 10px;
				background: rgba(0,0,0,0.3);
			}
			.distribute ul:first-child{
				width: 100%;
				overflow: hidden;
			}
			.plist label:first-child{
				height: 39px;
				line-height: 39px;
				color: #fff;
				font-size: 18px;
				font-weight: bold;
			}
			.plist .slist{
				padding-left: 15px;
				height: 39px;
				line-height: 39px;
				display: inline-block;
				color: #fff;
			}
			.plist .slist .tlist{
				padding-left: 15px;
				display: inline-block;
				color: #ff4a00;
			}
			.disbtn{
				margin-left: 10px;
			}
			/* 分配权限样式结束*/

			/* 尾部样式开始 */
			footer{
				text-align: center;
				height: 40px;
				line-height: 40px;
			}
			/* 尾部样式结束 */
		</style>
	</head>
	<body class='bgimg'>
	    <h2>资料管理系统</h2>
	    <!-- <form action="{$smarty.const.__CONTROLLER__}/checklogin" method="post"> -->
	    <form action="" method="post">
	    	<ul class="login">
				<li>
					<span class='login-text'>用户名</span>
					<input class='login-user' type='text' name='username' placeholder='请输入用户名(5-20位字符)'/>
					<span class='error-text'></span>
				</li>
				<li>
					<span class='login-text'>密&nbsp;&nbsp;码</span>
					<input class='login-pass' type='password' name='password' placeholder='请输入密码(6-20位字符)'/>
					<span class='error-text'></span>
				</li>
				<!-- 
				<li>
					<span class='login-text fl'>验证码</span>
					<input class='login-verify fl' name='code' type='text' size="6" placeholder='输入验证码'/>
					<!-- <img class='verify-img fl' src='{$smarty.const.__CONTROLLER__/verify}' onclick="this.src='{$smarty.const.__CONTROLLER__}/verify?time='+Math.random()" />  
					<img class='verify-img fl' src='__CONTROLLER__/verify' onclick="this.src='__CONTROLLER__/verify?time='+Math.random()" /> 
					<span class='error-text ml10'></span>
				</li>-->
				<li>
					<input class="submitbtn" type='submit' value="登 录"/>
				</li>
			</ul>
	    </form>
	</body>
</html>