<style>
    .info {
		width: 90%; min-height: 800px; margin: 10px auto; background: #f2f2f2;
	}
	.info > li {
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
	.info .info_content {
		width: 1000px; height: 390px; padding-left: 8px; border-radius: 5px;
	}
	.info .info_btn {
		width: 160px; height: 39px; line-height: 39px; font-size: 16px; font-weight: bold; background: red; border-radius: 6px;
	}
</style>

<div class="info">
    <ul>
		<li>
		    <span class="label">作者</span>
			<span><?php echo $info['uid']?></span>
		</li>
		<li>
		    <span class="label">添加时间</span>
			<span><?php echo date('Y-m-d H:i:s', $info['rectime']);?></span>
		</li>
		<li>
		    <span class="label">内容</span>
			<div><?php echo nl2br($info['content']);?></div>
		</li>
	</ul>
</div>