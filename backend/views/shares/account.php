<style>
    .info {
		width: 90%; margin: 10px auto; 
	}
	.info_add {
		height: 39px; line-height: 39px; text-align: center; font-size 20px; font-weight: bold; margin-bottom: 20px;
	}
	.info_add a {
		padding: 0px 8px; background: #f2f2f2; margin: 10px 10px 10px 0px; float: left;
	}
    .info_title {
		height: 49px; line-height: 49px; background: #f3f3f3; font-size: 18px; font-weight: bold; 
	}
	.info_content {
		height: 49px; line-height: 49px; background: #f9f9f9; font-size: 14px; padding-left: 8px;
	}
	.info_title .number, .info_content .number {
		width: 10%; display: inline-block; text-align: center;
	}
	.info_title .author, .info_content .author {
		width: 10%; display: inline-block; text-align: center;
	}
	.info_title .title, .info_content .title {
		width: 36%; display: inline-block; text-align: center;
	}
	.info_title .date, .info_content .date {
		width: 20%; display: inline-block; text-align: center;
	}
	.info_title .oper, .info_content .oper {
		width: 20%; display: inline-block; text-align: center;
	}
</style>
<div class="info">
    <div class="info_add">
		<a href="/index.php?r=shares/account-add">添加股票账号收益</a>
		<a href="/index.php?r=shares/share">股票列表</a>
		<a href="/index.php?r=shares/revenue">股票收益列表</a>
	</div>
	<ul>
		<li class="info_title">
			<span class="number">编号</span>
			<span class="author">作者</span>
			<span class="title">总金额</span>
			<span class="date">日期</span>
			<span class="oper">总收益</span>
		</li>
		<?php foreach($info as $key => $val) {?> 
		<li class="info_content">
			<span class="number"><?=($key + 1);?></span>
		    <span class="author"><?=$val['uid']?></span>
			<span class="title"><a href="/index.php?r=shares/account-detail&id=<?=$val['id']?>"><?=$val['amount']?></a></span>
			<span class="date"><?=date('Y-m-d H:i:s', $val['addtime']);?></span>
			<span class="oper"><?=$val['total_revenue']?></span>
		</li>
		<?php } ?>
		<!--
		<li class="info_content">
			<span class="number">编号</span>
			<span class="author">作者</span>
			<span class="title">标题</span>
			<span class="date">日期</span>
			<span class="oper">操作</span>
		</li>
		-->
	</ul>
</div>