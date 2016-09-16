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
	    <ul>
		    <li class="detail">
			    <span class="label">权限名</span>
				<span><?php echo $info['name'];?></span>
			</li>
			<?php if ($info['controller'] != '') { ?>
			<li class="detail">
			    <span class="label">权限控制器</span>
				<span><?php echo $info['controller'];?></span>
			</li>
			<li class="detail">
			    <span class="label">权限操作方法</span>
				<span><?php echo $info['action'];?></span>
			</li>
			<?php } ?>
			<?php if ($info['image'] != '') { ?>
			<li class="">
			    <span class="label">权限关联图</span>
				<img src="<?php echo $info['image']?>"/>
			</li>
			<?php } ?>
		</ul>
	</form>
</div>