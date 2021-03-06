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
    <?php 
	$request = Yii::$app->request->getBaseUrl();
	echo "<form action=".$request."/index.php?r=technarticle/insert method='post' enctype='multipart/form-data'>";
	?>
	<!--
    <form action="/index.php?r=technarticle/insert" method="post" enctype="multipart/form-data">
	-->
	    <ul>
		    <li class="">
			    <span class="label">标题</span>
				<input type="text" class="info_title" name="title" value="" placeholder=请输入标题 >
			</li>
			<li class="">
			    <span class="label">所属分类</span>
				<select class="info_pid" name="pid">
				    <option value='0'>请选择所属分类</option>
					<?php
					foreach ($info as $val) {
						echo "<option value='".$val['id']."'>".$val['catename']."</option>";
					}
					?>
				</select>
			</li>
			<li class="content_area" style="height: 400px; line-height: 400px;">
			    <span class="label">内容</span>
				<textarea class="info_content" name="content"></textarea>
			</li>
			<li class="">
			    <span class="label">上传图片</span>
				<input type="file" class="info_title" name="img" placeholder="请上传权限关联图">
			</li>
			<li class="">
			    <span class="label"></span>
				<input type="submit" class="info_btn" value="添加文章"/>
			</li>
		</ul>
	</form>
</div>