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
			    <span class="label">总金额</span>
				<input type="text" class="info_title" name="amount" value="" placeholder=请输入总金额 >
			</li>
			<li class="">
			    <span class="label">今日收益</span>
				<input type="text" class="info_title" name="revenue" value="" placeholder=请输入今日收益 >
			</li>
			<li class="">
			    <span class="label">现价</span>
				<input type="text" class="info_title" name="current_price" value="" placeholder=请输入转入转出说明 >
			</li>

			<!--
			<li class="">
			    <span class="label">权限关联图</span>
				<input type="file" class="info_title" name="img" value="" placeholder=请上传权限关联图 >
			</li>
			-->
			<li class="">
			    <span class="label"></span>
				<input type="submit" class="info_btn" value="添加黄金(存金宝)收益"/>
			</li>
		</ul>
	</form>
	<form action="" method="post">
	    <ul>
		    <li class="">
			    <span class="label">类型(转入转出)</span>
				<input type="radio" name="type" value="0" checked> 转入
				<input type="radio" name="type" value="1"> 转出
			</li>
			<li class="">
			    <span class="label">转入转出金额</span>
				<input type="text" class="info_title" name="money" value="" placeholder=请输入转入转出说明 >
			</li>
			<li class="">
			    <span class="label">转入转出说明</span>
				<input type="text" class="info_title" name="note" value="" placeholder=请输入转入转出说明 >
			</li>
			<li class="">
			    <span class="label"></span>
				<input type="submit" class="info_btn" value="添加买入卖出金额"/>
			</li>
		</ul>
	</form>
</div>