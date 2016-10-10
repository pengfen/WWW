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
			    <span class="label">总市值</span>
				<input type="text" class="info_title" name="total_market_value" value="" placeholder=请输入总市值 >
			</li>
			<li class="">
			    <span class="label">浮动盈亏</span>
				<input type="text" class="info_title" name="float_pl" value="" placeholder=请输入浮动盈亏 >
			</li>
			<li class="">
			    <span class="label">当日盈亏</span>
				<input type="text" class="info_title" name="daily_pl" value="" placeholder=请输入当日盈亏 >
			</li>
			<li class="">
			    <span class="label">可用</span>
				<input type="text" class="info_title" name="advisable" value="" placeholder=请输入可用 >
			</li>
			<li class="">
			    <span class="label">可取</span>
				<input type="text" class="info_title" name="available" value="" placeholder=请输入可取 >
			</li>
			<li class="">
			    <span class="label">总收益</span>
				<input type="text" class="info_title" name="total_revenue" value="" placeholder=请输入总收益 >
			</li>
			
			<!--
			<li class="">
			    <span class="label">权限关联图</span>
				<input type="file" class="info_title" name="img" value="" placeholder=请上传权限关联图 >
			</li>
			-->
			<li class="">
			    <span class="label"></span>
				<input type="submit" class="info_btn" value="添加股票账号收益"/>
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
			
			<!--
			<li class="">
			    <span class="label">权限关联图</span>
				<input type="file" class="info_title" name="img" value="" placeholder=请上传权限关联图 >
			</li>
			-->
			<li class="">
			    <span class="label"></span>
				<input type="submit" class="info_btn" value="添加转入转出金额"/>
			</li>
		</ul>
	</form>
</div>