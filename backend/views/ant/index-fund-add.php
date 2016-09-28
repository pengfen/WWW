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
		width: 160px; height: 39px; line-height: 39px; font-size: 16px; font-weight: bold; background: red; border-radius: 6px; cursor: pointer;
	}
</style>

<div class="info">
    <form action="" method="post">
	    <input type="hidden" name="flag" value="1">
	    <ul>
		    <li class="">
			    <span class="label">指基名</span>
				<input type="text" class="info_title" name="name" value="" placeholder=请输入指数名 >
			</li>
			<li class="">
			    <span class="label">昨日收益</span>
				<input type="text" class="info_title" name="revenue" value="" placeholder=请输入昨日收益 >
			</li>
			<li class="">
			    <span class="label">总金额</span>
				<input type="text" class="info_title" name="amount" value="" placeholder=请输入总金额 >
			</li>
			<li class="">
			    <span class="label">累计收益</span>
				<input type="text" class="info_title" name="total_revenue" value="" placeholder=请输入累计收益 >
			</li>
			
			<!--
			<li class="">
			    <span class="label">权限关联图</span>
				<input type="file" class="info_title" name="img" value="" placeholder=请上传权限关联图 >
			</li>
			-->
			<li class="">
			    <span class="label"></span>
				<input type="submit" class="info_btn" value="添加支付宝收益"/>
			</li>
		</ul>
	</form>
</div>