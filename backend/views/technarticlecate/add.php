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
    <form action="" method="post" enctype="multipart/form-data">
	    <ul>
		    <li class="">
			    <span class="label">分类名</span>
				<input type="text" class="info_title" name="catename" value="" placeholder=请输入技术文章分类 >
			</li>
			<li class="">
			    <span class="label">父级分类</span>
				<select class="info_pid" name="pid">
				    <option value='0'>请选择上级分类</option>
				    <?php
					if ($info) {
						foreach ($info as $val) {
							echo "<option value='".$val['id']."'>".$val['catename']."</option>";
						}
					}
				    ?>
				</select>
			</li>
			<li class="">
			    <span class="label">分类关联图</span>
				<input type="file" class="info_title" name="img" value="" placeholder=请上传分类关联图 >
			</li>
			<li class="">
			    <span class="label"></span>
				<input type="submit" class="info_btn" value="添加文章分类"/>
			</li>
		</ul>
	</form>
</div>