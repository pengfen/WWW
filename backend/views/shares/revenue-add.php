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
			    <span class="label">股票</span>
				<select name="sid">
				    <option value="0">请选择股票</option>
					<?php
					foreach($info as $val) {
					    echo "<option value='{$val["id"]}'>".$val['name']."</option>";
					}
					?>
				</select>
			</li>
			<li class="">
			    <span class="label">成交价</span>
				<input type="text" class="info_title" name="current_rate" value="" placeholder=请输入成交价 >
			</li>
			<li class="">
			    <span class="label">成交量</span>
				<input type="text" class="info_title" name="volume" value="" placeholder=请输入成交量 >
			</li>
			<li class="">
			    <span class="label">成交类型</span>
				<input type="radio" name="type" value="0" checked> 买入
				<input type="radio" name="type" value="1"> 加仓
				<input type="radio" name="type" value="2"> 减仓
				<input type="radio" name="type" value="3"> 卖出
			</li>
			<li class="">
			    <span class="label">成交额</span>
				<input type="text" class="info_title" name="money" value="" placeholder=请输入成交额 >
			</li>
			<li class="">
			    <span class="label"></span>
				<input type="submit" class="info_btn" value="添加成交信息"/>
			</li>
		</ul>
	</form>
	<form action="" method="post">
	    <ul>
			<li class="">
			    <span class="label">市值</span>
				<input type="text" class="info_title" name="market_value" value="" placeholder=请输入市值 >
			</li>
			<li class="">
			    <span class="label">盈亏</span>
				<input type="text" class="info_title" name="daily_pl" value="" placeholder=请输入盈亏 >
			</li>
			<li class="">
			    <span class="label">现价</span>
				<input type="text" class="info_title" name="current_price" value="" placeholder=请输入现价 >
			</li>
			
			<!--
			<li class="">
			    <span class="label">权限关联图</span>
				<input type="file" class="info_title" name="img" value="" placeholder=请上传权限关联图 >
			</li>
			-->
			<li class="">
			    <span class="label"></span>
				<input type="submit" class="info_btn" value="添加股票收益"/>
			</li>
		</ul>
	</form>
</div>