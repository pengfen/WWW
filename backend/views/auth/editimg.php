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
    <form action="/index.php?r=auth/updimg" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $info['id'];?>">
	    <ul>
		    <li class="">
			    <span class="label">权限名</span>
				<span><?php echo $info['name'];?></span>
			</li>

			<li class="">
			    <span class="label">权限关联图</span>
				<?php if ($info['image'] != '') { ?>
				<img src="<?php echo $info['image']?>"/>
				<?php } else { ?>
				<span>现在并没有关联图, 请立即上传关联图</span>
				<?php } ?>
			</li>
			<li class="">
			    <span class="label">修改关联图</span>
				<input type="file" class="info_title" name="img" value="" placeholder=请上传权限关联图 >
			</li>
			<li class="">
			    <span class="label"></span>
				<input type="submit" class="info_btn" value="修改权限关联图"/>
			</li>
		</ul>
	</form>
</div>