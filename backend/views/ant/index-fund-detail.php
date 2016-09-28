<style>
    .info {
		width: 90%; min-height: 800px; margin: 10px auto; background: #f2f2f2;
	}
	.info li.detail {
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
    <h2>指数收益操作详情</h2>
	<ul>
	    <li class="detail">
			<span class="label">指基名</span>
			<span><?php if($info['name']) echo $info['name']; else echo '统计基金';?></span>
		</li>
		<li class="detail">
			<span class="label">总金额</span>
			<span><?=$info['amount']?></span>
		</li>
		<li class="detail">
			<span class="label">昨日收益</span>
			<span><?=$info['revenue']?></span>
		</li>
		<li class="detail">
			<span class="label">添加时间</span>
			<span><?=date('Y-m-d H:i:s', $info['addtime']);?></span>
		</li>
		<li class="detail">
			<span class="label">所属者</span>
			<span><?=$info['uid']?></span>
		</li>
		<li class="detail">
			<span class="label">总收益</span>
			<span><?=$info['total_revenue']?></span>
		</li>
	</ul>
</div>