<style>
    .info {
		width: 90%; min-height: 800px; margin: 10px auto; background: #f2f2f2;
	}
	.info li {
		height: 49px; margin: 5px;
	}
	.label {
		width: 200px; line-height: 49px; font-size: 20px; font-weight: bold; display: inline-block; padding-left: 8px;
	}
	.info .info_title {
		width: 300px; height: 40px; padding-left: 8px; border-radius: 5px;
	}
	.info .info_pid {
		width: 200px; height: 40px; padding-left: 8px; border-radius: 5px;
	}
	.content_area, .content_area .label {
		height: 400px; line-height: 400px; 
	}
	.info .info_content {
		width: 1000px; height: 390px; padding-left: 8px; border-radius: 5px;
	}
	.info .info_btn {
		width: 160px; height: 39px; line-height: 39px; font-size: 16px; font-weight: bold; background: red; border-radius: 6px;
	}
</style>

<div class="info">
    <form action="" method="post">
	    <ul>
		    <li class="">
			    <span class="label">用户名</span>
				<input type="text" class="info_title" name="username" value="" placeholder=请输入用户名 >
			</li>
			<li class="">
			    <span class="label">email</span>
				<input type="text" class="info_title" name="email" value="" placeholder=请输入用户邮箱 >
			</li>
			<li class="">
			    <span class="label">用户密码</span>
				<input type="text" class="info_title" name="password" value="1234560." placeholder=请输入用户密码 >
			</li>
			<li class="">
			    <span class="label"></span>
				<input type="submit" class="info_btn" value="添加管理用户"/>
			</li>
		</ul>
	</form>
</div>