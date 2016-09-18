<style>
    .info {
		width: 90%; margin: 10px auto; 
	}
	.info_add {
		width: 100px; height: 39px; line-height: 39px; background: #f2f2f2; margin: 10px 0px; text-align: center; font-size 20px; font-weight: bold;
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
	    <?php 
			echo "<a href='/index.php?r=manager/add'>添加后台管理用户</a>";
		?>
		<!-- <a href="/">添加功能</a> -->
	</div>
	<ul>
		<li class="info_title">
			<span class="number">编号</span>
			<span class="author">用户名</span>
			<span class="title">职位</span>
			<span class="date">日期</span>
			<span class="oper">操作</span>
		</li>
		    <?php
			foreach ($info as $val) {
				echo "<li class='info_content'>";
				echo "<span class='number'>".$val['id']."</span>";
				echo "<span class='author'><a href='/index.php?r=manager/detail&id=".$val['id']."'>".$val['username']."</a></span>";
				echo "<span class='author'>".$val['rid']."</span>";
				echo "<span class='date'>".date('Y-m-d H:i:s', $val['regtime'])."</span>";
				echo "<span class='oper'>";
				echo "<a href='/index.php?r=manager/edit&id=".$val['id']."'>修改</a>&nbsp;";
				echo "<a href='/index.php?r=manager/detail&id=".$val['id']."'>详情</a>&nbsp;";
				echo "<a href='/index.php?r=manager/del&id=".$val['id']."'>删除</a>&nbsp;";
				echo "</span>";
				echo "</li>";
				
				//echo "<span><a href='".$request."/".$val['controller']."/".$val['action']."'>".$val['name']."</a></span>";
			}
			?>
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
