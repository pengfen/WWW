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
	<input type="hidden" name="id" value="<?=$info['id']?>">
	    <ul>
		    <li class="">
			    <span class="label">总金额</span>
				<input type="text" class="info_title" name="amount" value="<?=$info['amount']?>" placeholder=请输入总金额 >
			</li>
			<li class="">
			    <span class="label">现价</span>
				<input type="text" class="info_title" name="current_price" value="<?=$info['current_price']?>" placeholder=请输入转入转出说明 >
			</li>
			<li class="">
			    <span class="label">总收益</span>
				<input type="text" class="info_title" name="total_revenue" value="<?=$info['total_revenue']?>" placeholder=请输入总收益 >
			</li>

			<!--
			<li class="">
			    <span class="label">权限关联图</span>
				<input type="file" class="info_title" name="img" value="" placeholder=请上传权限关联图 >
			</li>
			-->
			<li class="">
			    <span class="label"></span>
				<input type="submit" class="info_btn" value="修改黄金(存金宝)收益"/>
			</li>
		</ul>
	</form>
</div>